<?php

namespace App\Http\Controllers;

use App\OINV_CCC;
use App\ORDR_CCC;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use PDF;
use App\BirInvoice;
use App\BirInvoiceProduct;
use App\OINV;
use App\INV1;
use App\ODLN;
use App\DLN1;
use App\RDR1;
use App\ORDR;
use App\OHEM;
use App\OCTG;
use App\CRD1;
use App\OITM;
use App\OCRD;
use App\OINV_PBI;
use App\INV_PBI;
use App\ODLN_PBI;
use App\DLN1_PBI;
use App\RDR1_PBI;
use App\ORDR_PBI;
use App\OHEM_PBI;
use App\OCTG_PBI;
use App\CRD1_PBI;
use App\OITM_PBI;
use App\OCRD_PBI;
use App\ODLN_CCC;
use Illuminate\Http\Request;

class CommercialInvoiceController extends Controller
{
    
    function index(Request $request) 
    {

        $search = $request->input('search');
        $model = null;
        $view = '';

        if ($request->is('pbi_bir_invoice')) {
            $model = ODLN_PBI::query();
            $view = 'print_templates.print_lists.pbi.bir_commercial_list';
        } elseif ($request->is('whi_bir_invoice')) {
            $model = ODLN::query();
            $view = 'print_templates.print_lists.whi.bir_commercial_list';
        } elseif ($request->is('ccc_bir_invoice')) {
            $model = ODLN_CCC::query();
            $view = 'print_templates.print_lists.ccc.bir_commercial_list';
        } else {
            abort(404); 
        }

        if ($request->is('whi_bir_invoice')) {
            $model->leftJoin('OCRD as customer', 'ODLN.CardCode', '=', 'customer.CardCode')
                  ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', DB::raw("
                      CASE 
                          WHEN customer.QryGroup1  = 'Y' THEN 'JP-USD'
                          WHEN customer.QryGroup2  = 'Y' THEN 'SBC-WCC-USD1'
                          WHEN customer.QryGroup3  = 'Y' THEN 'BDO-USD'
                          WHEN customer.QryGroup4  = 'Y' THEN 'MBTC-USD'
                          WHEN customer.QryGroup5  = 'Y' THEN 'SBC-WCC-EUR'
                          WHEN customer.QryGroup6  = 'Y' THEN 'SBC-WCC-USD'
                          WHEN customer.QryGroup7  = 'Y' THEN 'SBC-WCC-PHP'
                          WHEN customer.QryGroup8  = 'Y' THEN 'SBC-MARKET-PHP'
                          WHEN customer.QryGroup9  = 'Y' THEN 'SBC-MARKET-USD'
                          WHEN customer.QryGroup10 = 'Y' THEN 'BOA-PO BOX'
                          WHEN customer.QryGroup11 = 'Y' THEN 'BOA-ACH'
                          WHEN customer.QryGroup16 = 'Y' THEN 'BPI-W 5th-EUR'
                      END
                  "));
        } elseif ($request->is('ccc_bir_invoice')) {
            $model->leftJoin('OCRD as customer', 'ODLN.CardCode', '=', 'customer.CardCode')
                  ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', DB::raw("
                      CASE 
                          WHEN customer.QryGroup1  = 'Y' THEN 'SBC-WCC-USD'
                      END
                  "));
        } elseif ($request->is('pbi_bir_invoice')) {
            $model->leftJoin('OCRD as customer', 'ODLN.CardCode', '=', 'customer.CardCode')
                  ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', DB::raw("
                      CASE 
                          WHEN customer.QryGroup1  = 'Y' THEN 'JP-USD'
                          WHEN customer.QryGroup2  = 'Y' THEN 'SBC-WCC-USD'
                          WHEN customer.QryGroup3  = 'Y' THEN 'SBC-WCC-PHP'
                          WHEN customer.QryGroup4  = 'Y' THEN 'SBC-WCC-EUR'
                          WHEN customer.QryGroup5  = 'Y' THEN 'JP-PHP'
                          WHEN customer.QryGroup6  = 'Y' THEN 'BPI-W 5th-EUR'
                      END
                  "));
        }
        $details = $model->select(
            'ODLN.DocEntry',
            'ODLN.U_invNo',
            'ODLN.Address',
            // $request->is('whi_bir_invoice') ? 'ODLN.Address as Billtoaddress' : 'ODLN.Address as Billtoaddress',
            \DB::raw('ODLN.PayToCode + CHAR(13) + ODLN.Address as Billtoaddress'),
            \DB::raw('ODLN.ShipToCode + CHAR(13) + ODLN.Address2 as Shiptoaddress'),
            'ODLN.GroupNum',
            'ODLN.DocDate',
            'ODLN.PayToCode',
            'ODLN.DocNum',
            'ODLN.NumAtCard',
            'ODLN.U_BuyersPO',
            'ODLN.U_Salescontract',
            'ODLN.DocDueDate',
            // 'ODLN.U_BaseDate',
            DB::raw($request->is('whi_bir_invoice') ? 'ODLN.U_BaseDate AS U_BaseDate' : 'NULL AS U_Destinationport'),
            'ODLN.U_PlaceLoading',
            'ODLN.DocCur',
            DB::raw($request->is('whi_bir_invoice') ? 'ODLN.U_PortDestination' : ($request->is('ccc_bir_invoice') ? 'ODLN.U_Destinationport' : 'NULL AS U_Destinationport')),
            // 'ODLN.U_Destinationport',
            'ODLN.U_ModeShip',
            'ODLN.U_Delivery',
            // 'ODLN.U_FeedVessel',
            DB::raw($request->is('whi_bir_invoice') ? 'ODLN.U_FeedVessel' : ($request->is('ccc_bir_invoice') ? 'ODLN.U_Feeder' : 'NULL AS U_FeedVessel')),
            DB::raw($request->is('whi_bir_invoice') ? 'ODLN.U_OceanVessel' : ($request->is('ccc_bir_invoice') ? 'ODLN.U_Ocean' : 'NULL AS U_OceanVessel')),

            'ODLN.U_BillLading',
            'ODLN.U_ContainerNo',
            'ODLN.U_Seal',
            // $request->is('whi_bir_invoice') ? 'ODLN.PymntGroup' : 'ODLN.PymntGroup',
            $request->is('whi_bir_invoice') ? 'ODLN.U_SAODueDate' : ($request->is('ccc_bir_invoice') ? 'ODLN.U_SAODueDate' : ($request->is('pbi_bir_invoice') ? 'ODLN.U_SOADueDate' : 'ODLN.U_SOADueDate')),
            'g.U_T1',
            'g.U_T2',
            'g.U_T3',
            'g.U_T4',
            'g.U_T5',
            'g.U_T6',
        )        
        ->when($search, function ($query) use ($search, $request) {
            $terms = explode(' ', $search);
            foreach ($terms as $term) {
                $query->where(function ($q) use ($term, $request) {
                    
                        $q->where('ODLN.U_invNo', 'LIKE', "%{$term}%")
                        ->orWhere('ODLN.Address', 'LIKE', "%{$term}%")
                        ->orWhere('ODLN.U_BuyersPO', 'LIKE', "%{$term}%")
                        ->orWhere('ODLN.NumAtCard', 'LIKE', "%{$term}%");
                    
                });
            }
        })        
        //   ->orderBy('OINV.DocEntry', 'desc')
          ->where('CANCELED' ,'!=', 'Y' )
          ->paginate(15);
        
        return view($view, 
            array(
                'details' =>$details,
                'search' =>$search,
            )
        );
    }

    function save_as_new_invoice(Request $request) {
        $save_as_new = new BirInvoice;
        $save_as_new->DocNum = $request->DocEntry; 
        $save_as_new->invoice_date = $request->invoice_date;
        $save_as_new->SoldTo = $request->Client; 
        $save_as_new->Address = $request->ClientAddress;
        $save_as_new->Tin = $request->Tin;
        $save_as_new->BusinessStyle = $request->BusinessStyle;
        $save_as_new->BuyersPo = $request->BuyersPo;
        $save_as_new->BuyersRef = $request->BuyersRef;
        $save_as_new->SalesContract = $request->SalesContract;
        $save_as_new->OscaPwd = $request->OscaPwd;
        $save_as_new->ScPwd = $request->ScPwd;
        $save_as_new->ShipTo = $request->ShipTo;
        $save_as_new->InvoiceDueDate = $request->InvoiceDueDate;
        $save_as_new->PaymentInstruction = $request->PaymentInstruction;
        $save_as_new->DateOfShipment = $request->DateOfShipment;
        $save_as_new->PortOfLoading = $request->PortOfLoading;
        $save_as_new->PortOfDestination = $request->PortOfDestination;
        $save_as_new->ModeOfShipment = $request->ModeOfShipment;
        $save_as_new->TermsOfDelivery = $request->TermsOfDelivery;
        $save_as_new->FedderVessel = $request->FedderVessel;
        $save_as_new->OceanVessel = $request->OceanVessel;
        $save_as_new->BillOfLading = $request->BillOfLading;
        $save_as_new->ContainerNo = $request->ContainerNo;
        $save_as_new->SealNo = $request->SealNo;
        $save_as_new->TermsOfPayment = $request->TermsOfPayment;
        $save_as_new->SoNo = $request->SoNo;
        $save_as_new->Remarks = $request->Remarks;
        $save_as_new->RemarksTwo = $request->RemarksTwo;

        $save_as_new->save();
        foreach ($request->Description as $index => $description) {
            // $quantity = (float) str_replace(',', '', $request->Quantity[$index]);
            // $amount = (float) str_replace(',', '', $request->Amount[$index]);
            $quantity = isset($request->Quantity[$index]) && $request->Quantity[$index] !== '' 
                ? (float) str_replace(',', '', $request->Quantity[$index]) 
                : null;

            $amount = isset($request->Amount[$index]) && $request->Amount[$index] !== '' 
                ? (float) str_replace(',', '', $request->Amount[$index]) 
                : null;
            $unit_price = isset($request->UnitPrice[$index]) && $request->UnitPrice[$index] !== '' 
                ? (float) str_replace(',', '', $request->UnitPrice[$index]) 
                : null;
            $save_as_product = new BirInvoiceProduct; 
            $save_as_product->DocNum = $save_as_new->id; 
            $save_as_product->Description = $description ?? null;
            $save_as_product->SupplierCode = $request->SupplierCode[$index] ?? null;
            $save_as_product->DocCur = $request->DocCur[$index] ?? null;
            $save_as_product->ProductCode = $request->ProductCode[$index] ?? null;
            $save_as_product->PbiSiType = $request->PbiSiType[$index] ?? null;
            $save_as_product->Packing = $request->Packing[$index] ?? null;
            $save_as_product->Uom = $request->Uom[$index] ?? null;
            $save_as_product->UnitPrice = $unit_price ?? null;
            $save_as_product->printUom = $request->printUom[$index] ?? null;
            $save_as_product->Quantity = $quantity ?? null;
            $save_as_product->Amount = $amount ?? null;
            $save_as_product->save(); 
        }

        return redirect()->back()->with('success', 'Invoice saved successfully.');
    }

    function edit_new_invoice(Request $request, $id){
        $update_saved_invoice = BirInvoice::find($id);
        $update_saved_invoice->SoldTo = $request->Client; 
        $update_saved_invoice->Address = $request->ClientAddress;
        $update_saved_invoice->Tin = $request->Tin;
        $update_saved_invoice->BusinessStyle = $request->BusinessStyle;
        $update_saved_invoice->BuyersPo = $request->BuyersPo;
        $update_saved_invoice->BuyersRef = $request->BuyersRef;
        $update_saved_invoice->SalesContract = $request->SalesContract;
        $update_saved_invoice->OscaPwd = $request->OscaPwd;
        $update_saved_invoice->ScPwd = $request->ScPwd;
        $update_saved_invoice->ShipTo = $request->ShipTo;
        $update_saved_invoice->InvoiceDueDate = $request->InvoiceDueDate;
        $update_saved_invoice->PaymentInstruction = $request->PaymentInstruction;
        $update_saved_invoice->DateOfShipment = $request->DateOfShipment;
        $update_saved_invoice->PortOfLoading = $request->PortOfLoading;
        $update_saved_invoice->PortOfDestination = $request->PortOfDestination;
        $update_saved_invoice->ModeOfShipment = $request->ModeOfShipment;
        $update_saved_invoice->TermsOfDelivery = $request->TermsOfDelivery;
        $update_saved_invoice->FedderVessel = $request->FedderVessel;
        $update_saved_invoice->OceanVessel = $request->OceanVessel;
        $update_saved_invoice->BillOfLading = $request->BillOfLading;
        $update_saved_invoice->ContainerNo = $request->ContainerNo;
        $update_saved_invoice->SealNo = $request->SealNo;
        $update_saved_invoice->TermsOfPayment = $request->TermsOfPayment;
        $update_saved_invoice->SoNo = $request->SoNo;
        $update_saved_invoice->invoice_date = $request->invoice_date;

        $update_saved_invoice->update();

        foreach ($request->Description as $index => $description) {
            $productId = $request->product_id[$index];
            
            if ($productId) {
                // Update existing product
                $save_as_product = BirInvoiceProduct::find($productId);
            } else {
                // Create a new product if no productId is provided
                $save_as_product = new BirInvoiceProduct();
                $save_as_product->DocNum = $update_saved_invoice->id; // Assuming you need to link the product to the invoice
            }
    
            $save_as_product->Description = $description ?? null;
            $save_as_product->SupplierCode = $request->SupplierCode[$index] ?? null;
            $save_as_product->DocCur = $request->DocCur[$index] ?? null;
            $save_as_product->ProductCode = $request->ProductCode[$index] ?? null;
            $save_as_product->PbiSiType = $request->PbiSiType[$index] ?? null;
            $save_as_product->Packing = $request->Packing[$index] ?? null;
            $save_as_product->Uom = $request->Uom[$index] ?? null;
            $save_as_product->printUom = $request->printUom[$index] ?? null;
    
            // Handling Quantity and Amount
            $save_as_product->Quantity = isset($request->Quantity[$index]) && $request->Quantity[$index] !== '' 
                ? (float) str_replace(',', '', $request->Quantity[$index]) 
                : null;
    
            $save_as_product->Amount = isset($request->Amount[$index]) && $request->Amount[$index] !== '' 
                ? (float) str_replace(',', '', $request->Amount[$index]) 
                : null;
    
            $save_as_product->save(); // Use save() to insert or update
        }
    return redirect()->back()->with('success', 'Invoice edited successfully.');
}

function original_print(Request $request, $invoice_number){
    {
        $customer_ref =$invoice_number;
        $prepared_by = $request->input('prepared_by');

        $details = ODLN::select(
            'b.VisOrder',
            'a.DocNum',
            'a.DocEntry',
            'a.DocDate',
            'a.DocDueDate',
            'a.CardCode',
            'a.CardName',
            'a.Address',
            'a.U_BuyersPO',
            'a.U_HSCode',
            'a.U_Buyersref',
            'a.U_Salescontract',
            'b.ItemCode',
            'b.Dscription',
            'b.text',
            'b.FreeTxt',
            'b.UomCode',
            'b.U_Bagsperlot',
            'b.Price',
            'b.Quantity',
            'b.PackQty',
            \DB::raw("CASE WHEN a.DocCur = 'PHP' THEN b.LineTotal ELSE b.LineTotal / b.Rate END AS Linetotal"),
            // \DB::raw("b.Price * b.Quantity AS Linetotal"),
            'b.Currency',
            'a.DocCur',
            'a.U_Remark1',
            'a.U_Remark2',
            \DB::raw("CASE when a.DocCur = 'PHP' then a.DocTotal else a.DoctotalFC  end AS DocTotal"),
            'b.LineTotal AS Total',
            'b.TotalFrgn',
            'a.U_ShipmentSched',
            'a.U_Loadingport',
            'a.U_Destinationport',
            'a.U_Delivery as DeliveryTerms',
            'a.U_Feeder',
            'a.U_Ocean',
            'a.U_ContainerNo',
            'a.U_SpecialInstruct',
            'a.U_Special',
            'a.U_Seal',
            'a.VatSum',
            'c.LicTradNum',
            'd.PymntGroup',
            'a.DiscPrcnt',
            'a.U_CINo',
            'e.Street',
            'e.Block',
            'e.City',
            'e.ZipCode',
            'e.State',
            'e.Country',
            'a.U_ModeShip',
            'a.U_ApproverName',
            'a.U_BillLading',
            'a.U_Date_LOG',
            'a.U_PayInstText',
            'a.U_PaymentInst',
            'c.AliasName',
            'c.VatIdUnCmp',
            'b.U_Netweight',
            'b.unitMsr',
            'b.U_SupplierCode',
            \DB::raw("CONCAT('Country of Origin: ', a.U_Country) as U_Country"),
            'b.U_packUOM',
            'b.U_printUOM',
            'b.U_MfgDate',
            'b.U_ExpDate',
            'b.U_CBM',
            'b.U_Grade',
            'b.U_Label_as',
            'a.U_FDAReg',
            'a.U_HSTar',
            'a.U_FinalDest',
            \DB::raw("CONCAT(UPPER(f.firstName), ' ', UPPER(f.lastName)) as PrepBy"),
            'd.ExtraDays',
            'a.U_Bank',
            'a.U_InvDueDate',
            'a.U_Departure',
            'a.U_FeedVessel',
            'a.U_OceanVessel',
            'a.U_PortLoad',
            'a.U_PortDestination',
            'a.U_ladenburg',
            'a.GroupNum',
            'a.PayToCode',
            'a.U_Remark3',
            'a.U_Signature',
            'a.U_BaseDate',
            'c.Notes',
            'a.U_SWBuyersRef',
            'l.DocDate as Dated',
            'l.DocDueDate as ArDueDate',
            'l.U_BaseDate as ArShipment',
            'j.ItemName',
            \DB::raw("(SUBSTRING((SELECT DISTINCT ', ' + CONVERT(VARCHAR(20), i.U_BuyersPO) AS [text()]
                    FROM OINV a 
                    LEFT JOIN INV1 b ON a.DocEntry = b.DocEntry
                    LEFT JOIN ODLN c ON b.BaseEntry = c.DocEntry
                    LEFT JOIN DLN1 h ON c.DocEntry = h.DocEntry
                    LEFT JOIN RDR1 g ON h.BaseEntry = g.DocEntry                                
                    LEFT JOIN ORDR i ON g.DocEntry = i.DocEntry
                    WHERE a.DocNum = '$customer_ref'
                    FOR XML PATH(''), ELEMENTS), 2, 200)) AS SO_BuyersPO"),
            \DB::raw("(SUBSTRING((SELECT DISTINCT ', ' + CONVERT(VARCHAR(20), i.NumAtCard) AS [text()]
                    FROM OINV a 
                    LEFT JOIN INV1 b ON a.DocEntry = b.DocEntry
                    LEFT JOIN ODLN c ON b.BaseEntry = c.DocEntry
                    LEFT JOIN DLN1 h ON c.DocEntry = h.DocEntry
                    LEFT JOIN RDR1 g ON h.BaseEntry = g.DocEntry                                
                    LEFT JOIN ORDR i ON g.DocEntry = i.DocEntry
                    WHERE a.DocNum = '$customer_ref'
                    FOR XML PATH(''), ELEMENTS), 2, 200)) AS SO_BuyersRef"),
            \DB::raw("(SUBSTRING((SELECT DISTINCT ', ' + CONVERT(VARCHAR(20), i.U_SalesContract) AS [text()]
                    FROM OINV a 
                    LEFT JOIN INV1 b ON a.DocEntry = b.DocEntry
                    LEFT JOIN ODLN c ON b.BaseEntry = c.DocEntry
                    LEFT JOIN DLN1 h ON c.DocEntry = h.DocEntry
                    LEFT JOIN RDR1 g ON h.BaseEntry = g.DocEntry                                
                    LEFT JOIN ORDR i ON g.DocEntry = i.DocEntry
                    WHERE a.DocNum = '$customer_ref'
                    FOR XML PATH(''), ELEMENTS), 2, 200)) AS U_SalesContract"),
            \DB::raw("CASE 
                        WHEN c.QryGroup1  = 'Y' THEN 'Y' 
                        ELSE 'N'
                    END As SupplierCode"),
            \DB::raw("CASE 
                        WHEN c.QryGroup2  = 'Y' THEN 'SBC-WCC-USD1'
                        WHEN c.QryGroup3  = 'Y' THEN 'BDO-USD'
                        WHEN c.QryGroup4  = 'Y' THEN 'MBTC-USD'
                        WHEN c.QryGroup5  = 'Y' THEN 'SBC-WCC-EUR'
                        WHEN c.QryGroup6  = 'Y' THEN 'SBC-WCC-USD'
                        WHEN c.QryGroup7  = 'Y' THEN 'SBC-WCC-PHP'
                        WHEN c.QryGroup8  = 'Y' THEN 'SBC-MARKET-PHP'
                        WHEN c.QryGroup9  = 'Y' THEN 'SBC-MARKET-USD'
                        WHEN c.QryGroup10  = 'Y' THEN 'BOA-PO BOX'
                        WHEN c.QryGroup11  = 'Y' THEN 'BOA-ACH'
                        WHEN c.QryGroup16  = 'Y' THEN 'BPI-W 5th-EUR'
                    END as BankType"),
            \DB::raw("CASE 
                        WHEN c.QryGroup13  = 'Y' THEN 'Y' 
                        ELSE 'N'
                    END As PETFOODFEEDGRADE"),
            \DB::raw("CASE 
                        WHEN c.QryGroup14  = 'Y' THEN 'Y' 
                        ELSE 'N'
                    END As FEEDGRADE"),
            \DB::raw("CASE 
                        WHEN c.QryGroup15  = 'Y' THEN 'Y' 
                        ELSE 'N'
                    END As ITCBANGKOK"),
            \DB::raw("CASE 
                        WHEN c.QryGroup16  = 'Y' THEN 'Y' 
                        ELSE 'N'
                    END As LABELAS"),
            \DB::raw("CASE 
                        WHEN c.QryGroup16  = 'Y' THEN 'Y' 
                        ELSE 'N'
                    END As BUYERSMARK"),
            'g.U_T1',
            'g.U_T2',
            'g.U_T3',
            'g.U_T4',
            'g.U_T5',
            'g.U_T6'
        )
        ->from('ODLN as a')
        ->leftJoin('DLN1 as b', 'a.docentry', '=', 'b.docentry')
        ->leftJoin('OHEM as f', 'a.OwnerCode', '=', 'f.empID')
        ->leftJoin('OCRD as c', 'a.CardCode', '=', 'c.CardCode')
        ->leftJoin('OCTG as d', 'a.GroupNum', '=', 'd.GroupNum')
        ->leftJoin('CRD1 as e', function($join) {
            $join->on('a.CardCode', '=', 'e.CardCode')
                ->where('e.AdresType', '=', 's');
        })
        ->leftJoin('OINV as l', function($join) {
            $join->on('l.DocEntry', '=', 'b.TrgetEntry');
        })
        ->leftJoin('OITM as j', 'b.ItemCode', '=', 'j.ItemCode')
        ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', \DB::raw("
            CASE 
                WHEN c.QryGroup1  = 'Y' THEN 'JP-USD'
                        WHEN c.QryGroup2  = 'Y' THEN 'SBC-WCC-USD1'
                        WHEN c.QryGroup3  = 'Y' THEN 'BDO-USD'
                        WHEN c.QryGroup4  = 'Y' THEN 'MBTC-USD'
                        WHEN c.QryGroup5  = 'Y' THEN 'SBC-WCC-EUR'
                        WHEN c.QryGroup6  = 'Y' THEN 'SBC-WCC-USD'
                        WHEN c.QryGroup7  = 'Y' THEN 'SBC-WCC-PHP'
                        WHEN c.QryGroup8  = 'Y' THEN 'SBC-MARKET-PHP'
                        WHEN c.QryGroup9  = 'Y' THEN 'SBC-MARKET-USD'
                        WHEN c.QryGroup10  = 'Y' THEN 'BOA-PO BOX'
                        WHEN c.QryGroup11  = 'Y' THEN 'BOA-ACH'
                        WHEN c.QryGroup16  = 'Y' THEN 'BPI-W 5th-EUR'
            END
        "))
        ->where('a.DocEntry', '=', $customer_ref)
        ->orderBy('a.DocNum', 'ASC')
        ->get();
        View::share('details', $details);
        
        if (Route::currentRouteName() === 'bir_original_invoice') {
            $view = 'print_templates.whi.bir.commercial_invoice';
        } elseif (Route::currentRouteName() === 'bir_original_unique_invoice') {
            $view = 'print_templates.whi.bir.commercial_unique_invoice';
        } elseif (Route::currentRouteName() === 'bir_original_vatable_invoice') {
            $view = 'print_templates.whi.bir.commercial_vatable_invoice';
        } elseif (Route::currentRouteName() === 'bir_original_unique_vatable_invoice') {
            $view = 'print_templates.whi.bir.commercial_unique_vatable_invoice';
        } elseif (Route::currentRouteName() === 'bir_original_exempt_invoice') {
            $view = 'print_templates.whi.bir.commercial_exempt_invoice';
        } elseif (Route::currentRouteName() === 'bir_original_unique_exempt_invoice') {
            $view = 'print_templates.whi.bir.commercial_unique_exempt_invoice';
        } else {
            $view = null; 
        }

        $pdf = PDF::loadView($view, [
            array(
                'details' =>$details,
            ),
            'prepared_by' => $prepared_by,
        ])
        ->setPaper([0, 0, 622, 792], 'portrait');

        return $pdf->stream('WHI_BIR_Commercial_Invoice.pdf');
    }
}

function edit_print(Request $request, $id){
    {
        $customer_ref = $id;
        $details = BirInvoice::where('id', '=', $customer_ref)
        ->orderBy('DocNum', 'ASC')
        ->get();
        View::share('details', $details);

        if (Route::currentRouteName() === 'whi_bir_edited_commercial_invoice') {
            $view = 'print_templates.whi.bir.commercial_invoice_edited';
        } elseif (Route::currentRouteName() === 'whi_bir_edited_commercial_vatable_invoice') {
            $view = 'print_templates.whi.bir.commercial_vatable_invoice_edited';
        } elseif (Route::currentRouteName() === 'whi_bir_edited_commercial_exempt_invoice') {
            $view = 'print_templates.whi.bir.commercial_exempt_invoice_edited';
        }elseif (Route::currentRouteName() === 'ccc_bir_edited_invoice') {
            $view = 'print_templates.ccc.bir.commercial_invoice_edited';
        }elseif (Route::currentRouteName() === 'pbi_bir_edited_commercial_invoice') {
            $view = 'print_templates.pbi.bir.commercial_invoice_edited';
        }elseif (Route::currentRouteName() === 'pbi_bir_edited_commercial_vatable_invoice') {
            $view = 'print_templates.pbi.bir.commercial_vatable_invoice_edited';
        }elseif (Route::currentRouteName() === 'pbi_bir_edited_commercial_exempt_invoice') {
            $view = 'print_templates.pbi.bir.commercial_exempt_invoice_edited';
        }  else {
            $view = null; 
        }

        $filename = Route::currentRouteName() === 'bir_edited_invoice_whi'
        ? 'WHI_BIR_Commercial_Invoice_New.pdf'
        : 'CCC_BIR_Commercial_Invoice_New.pdf';
        $pdf = PDF::loadView($view, [
            array(
                'details' =>$details,
            ),
        ])
        ->setPaper([0, 0, 622, 792], 'portrait');

        return $pdf->stream($filename);
    }
}

function pbi_original_print(Request $request, $invoice_number){
    {
        $customer_ref =$invoice_number;
        $prepared_by = $request->input('prepared_by');

        $details = ODLN_PBI::select(
            'T0.DocEntry',
            'T0.DocNum',
            'T0.NumAtCard',
            'T0.DocStatus',
            'T0.CardName',
            'T0.PayToCode',
            'T0.Address as Billtoaddress',
            \DB::raw('T0.ShipToCode + CHAR(13) + T0.Address2 as Shiptoaddress'),
            'T0.U_Salescontract',
            'T0.DocDueDate',
            'T0.U_BuyersPO',
            'T0.U_ModeShip',
            'T0.U_Delivery',
            'T0.DocCur',
            // \DB::raw("CASE WHEN T0.DocCur = 'PHP' THEN T1.LineTotal ELSE T1.LineTotal / T1.Rate END AS Linetotal"),
            'T0.U_Remarks1',
            'T0.U_Remarks2',
            'T0.U_Remarks3',
            'T0.U_SOADueDate',
            'T0.U_PlaceLoading',
            'T0.U_Destinationport',
            // 'T0.SOADueDate',
            'T0.U_TaxID',
            'T0.Address2',
            'T0.ShipToCode',
            'T1.LineTotal',
            'T1.U_label_as',
            'T1.U_Bagsperlot',
            'T1.U_packUOM',
            'T1.U_printUOM',
            'T1.U_Netweight',
            'T1.Quantity',
            // \DB::raw('T1.U_Bagsperlot * T1.U_Netweight as Quantity'),
            'T1.TotalFrgn',
            'T1.Price',
            // 'T0.U_SAODueDate',
            // \DB::raw("CASE 
            //             WHEN T1.U_MetricTon = 1 OR T1.U_MetricTon = '' OR T1.U_MetricTon IS NULL THEN 
            //                 (CASE WHEN T1.U_printUOM = 'lbs' THEN ISNULL(T1.Price, 0.00) / 2.2 ELSE ISNULL(T1.Price, 0.00) END) 
            //             ELSE 
            //                 (CASE WHEN T1.U_printUOM = 'lbs' THEN T1.U_UnitCostMetricTon / 2.2 ELSE T1.U_UnitCostMetricTon END) 
            //         END as Price"),
            'T2.PymntGroup',
            'T2.GroupNum',
            'T0.U_ABill',
            'T0.U_Seal',
            'T0.U_ContainerNo',
            'T3.LicTradNum',
            'T0.U_BillLading',
            'T1.U_SupplierCode',
            'T4.U_invNo as ArInvoiceNo',
            'T4.DocDueDate as ArDueDate',
            'T6.DocEntry as SoaDocEntry',
            'g.U_T1',
            'g.U_T2',
            'g.U_T3',
            'g.U_T4',
            'g.U_T5',
            'g.U_T6'
        )
        ->from('ODLN as T0')
        ->leftJoin('DLN1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        ->leftJoin('OCTG as T2', 'T0.GroupNum', '=', 'T2.GroupNum')
        ->leftJoin('OCRD as T3', 'T0.CardCode', '=', 'T3.CardCode')
        ->leftJoin('OINV as T4', function($join) {
            $join->on('T4.DocEntry', '=', 'T1.TrgetEntry');
        })
        ->leftJoin('OCQG as T5', 'T3.GroupCode', '=', 'T5.GroupCode')
        ->leftJoin('ORDR as T6', function($join) {
            $join->on('T6.DocEntry', '=', 'T1.BaseEntry'); 
        })        
        ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', \DB::raw("
            CASE 
                WHEN T3.QryGroup1  = 'Y' THEN 'JP-USD'
                        WHEN T3.QryGroup2  = 'Y' THEN 'SBC-WCC-USD'
                        WHEN T3.QryGroup3  = 'Y' THEN 'SBC-WCC-PHP'
                        WHEN T3.QryGroup4  = 'Y' THEN 'SBC-WCC-EUR'
                        WHEN T3.QryGroup5  = 'Y' THEN 'JP-PHP'
                        WHEN T3.QryGroup6  = 'Y' THEN 'BPI-W 5th-EUR'
            END
        "))
        ->where('T0.DocEntry', '=', $customer_ref)
        ->orderBy('T0.DocNum', 'ASC')
        ->get();
        View::share('details', $details);
        
        if (Route::currentRouteName() === 'pbi_bir_original_invoice') {
            $view = 'print_templates.pbi.bir.commercial_invoice';
        } elseif (Route::currentRouteName() === 'pbi_bir_original_commercial_vatable_invoice') {
            $view = 'print_templates.pbi.bir.commercial_vatable_invoice';
        } elseif (Route::currentRouteName() === 'pbi_bir_original_commercial_exempt_invoice') {
            $view = 'print_templates.pbi.bir.commercial_exempt_invoice';
        } else {
            $view = null; 
        }
        

        $pdf = PDF::loadView($view, [
            array(
                'details' =>$details,
            ),
            'prepared_by' => $prepared_by,
        ])
        ->setPaper([0, 0, 622, 792], 'portrait');

        return $pdf->stream('PBI_BIR_Commercial_Invoice.pdf');
    }
    
}

function save_as_new_invoice_ccc(Request $request) {
    $save_as_new = new BirInvoice;
    $save_as_new->DocNum = $request->DocEntry; 
    $save_as_new->invoice_date = $request->invoice_date; 
    $save_as_new->SoldTo = $request->Client; 
    $save_as_new->Address = $request->ClientAddress;
    $save_as_new->Tin = $request->Tin;
    $save_as_new->BusinessStyle = $request->BusinessStyle;
    $save_as_new->BuyersPo = $request->BuyersPo;
    $save_as_new->BuyersRef = $request->BuyersRef;
    $save_as_new->SalesContract = $request->SalesContract;
    $save_as_new->OscaPwd = $request->OscaPwd;
    $save_as_new->ScPwd = $request->ScPwd;
    $save_as_new->Remarks = $request->Remarks;
    $save_as_new->PaymentInstruction = $request->PaymentInstruction;
    $save_as_new->DateOfShipment = $request->DateOfShipment;
    $save_as_new->PortOfLoading = $request->PortOfLoading;
    $save_as_new->PortOfDestination = $request->PortOfDestination;
    $save_as_new->ModeOfShipment = $request->ModeOfShipment;
    $save_as_new->TermsOfDelivery = $request->TermsOfDelivery;
    $save_as_new->FedderVessel = $request->FedderVesssel;
    $save_as_new->OceanVessel = $request->OceanVessel;
    $save_as_new->BillOfLading = $request->BillOfLading;
    $save_as_new->ContainerNo = $request->ContainerNo;
    $save_as_new->SealNo = $request->SealNo;
    $save_as_new->TermsOfPayment = $request->TermOfPayment;
    $save_as_new->InvoiceDueDate = $request->InvoiceDueDate;

    $save_as_new->save();
    foreach ($request->Description as $index => $description) {
        $save_as_product = new BirInvoiceProduct; 
        $save_as_product->DocNum = $save_as_new->id; 
        $save_as_product->Description = $description;
        $save_as_product->DocCur = $request->DocCur[$index];
        $save_as_product->Quantity = $request->Quantity[$index];
        $save_as_product->printUom = $request->printUom[$index];
        $save_as_product->UnitPrice = $request->UnitPrice[$index];
        $save_as_product->Amount = $request->Amount[$index];
        $save_as_product->save(); 
    }

    return redirect()->back()->with('success', 'Invoice saved successfully.');
}

function edit_new_invoice_ccc(Request $request, $id){
    $update_saved_invoice = BirInvoice::find($id);
    $update_saved_invoice->invoice_date = $request->invoice_date; 
    $update_saved_invoice->SoldTo = $request->SoldTo; 
    $update_saved_invoice->Address = $request->ClientAddress;
    $update_saved_invoice->Tin = $request->Tin;
    $update_saved_invoice->BusinessStyle = $request->BusinessStyle;
    $update_saved_invoice->BuyersPo = $request->BuyersPo;
    $update_saved_invoice->BuyersRef = $request->BuyersRef;
    $update_saved_invoice->SalesContract = $request->SalesContract;
    $update_saved_invoice->OscaPwd = $request->OscaPwd;
    $update_saved_invoice->ScPwd = $request->ScPwd;
    $update_saved_invoice->Remarks = $request->Remarks;
    $update_saved_invoice->PaymentInstruction = $request->PaymentInstruction;
    $update_saved_invoice->DateOfShipment = $request->DateOfShipment;
    $update_saved_invoice->PortOfLoading = $request->PortOfLoading;
    $update_saved_invoice->PortOfDestination = $request->PortOfDestination;
    $update_saved_invoice->ModeOfShipment = $request->ModeOfShipment;
    $update_saved_invoice->TermsOfDelivery = $request->TermsOfDelivery;
    $update_saved_invoice->FedderVessel = $request->FedderVesssel;
    $update_saved_invoice->OceanVessel = $request->OceanVessel;
    $update_saved_invoice->BillOfLading = $request->BillOfLading;
    $update_saved_invoice->ContainerNo = $request->ContainerNo;
    $update_saved_invoice->SealNo = $request->SealNo;
    $update_saved_invoice->TermsOfPayment = $request->TermOfPayment;
    $update_saved_invoice->InvoiceDueDate = $request->InvoiceDueDate;
    $update_saved_invoice->update();

    foreach ($request->Description as $index => $description) {
        $productId = $request->product_id[$index];
        $save_as_product = BirInvoiceProduct::find($productId);
        $save_as_product->Description = $description;
        $save_as_product->DocCur = $request->DocCur[$index];
        $save_as_product->Quantity = (float) str_replace(',', '', $request->Quantity[$index]);
        $save_as_product->printUom = $request->printUom[$index];
        $save_as_product->UnitPrice = $request->UnitPrice[$index];
        $save_as_product->Amount = (float) str_replace(',', '', $request->Amount[$index]); 
        $save_as_product->update(); 
}
return redirect()->back()->with('success', 'Invoice updated successfully.');

}
function ccc_original_print(Request $request, $invoice_number){
    {
        $customer_ref =$invoice_number;
        $prepared_by = $request->input('prepared_by');

        $details = ODLN_CCC::select(
            'T0.DocEntry',
            'T0.DocNum',
            'T0.NumAtCard',
            'T0.DocStatus',
            'T0.CardName',
            'T0.PayToCode',
            'T0.Address as Billtoaddress',
            \DB::raw('T0.ShipToCode + CHAR(13) + T0.Address2 as Shiptoaddress'),
            'T0.U_Salescontract',
            'T0.DocDueDate',
            'T0.U_BuyersPO',
            'T0.U_ModeShip',
            'T0.U_Delivery',
            'T0.DocCur',
             \DB::raw("CASE WHEN T0.DocCur = 'PHP' THEN T1.LineTotal ELSE T1.LineTotal / T1.Rate END AS Linetotal"),

            // 'T0.U_Remarks1',
            // 'T0.U_Remarks2',
            // 'T0.U_Remarks3',
            // 'T0.U_SOADueDate',
            'T0.U_PlaceLoading',
            'T0.U_Destinationport',
            // 'T0.SOADueDate',
            // 'T0.U_TaxID',
            'T0.Address2',
            'T0.ShipToCode',
            'T1.U_Label_as',
            'T1.U_Bagsperlot',
            'T1.U_packUOM',
            'T1.U_printUOM',
            'T1.U_Netweight',
            \DB::raw('T1.U_Bagsperlot * T1.U_Netweight as Quantity'),
            'T1.TotalFrgn',
            // 'T0.U_SAODueDate',
            \DB::raw("CASE 
                        WHEN T1.U_MetricTon = 1 OR T1.U_MetricTon = '' OR T1.U_MetricTon IS NULL THEN 
                            (CASE WHEN T1.U_printUOM = 'lbs' THEN ISNULL(T1.Price, 0.00) / 2.2 ELSE ISNULL(T1.Price, 0.00) END) 
                        ELSE 
                            (CASE WHEN T1.U_printUOM = 'lbs' THEN T1.U_UnitCostMetricTon / 2.2 ELSE T1.U_UnitCostMetricTon END) 
                    END as Price"),
            'T2.PymntGroup',
            'T2.GroupNum',
            'T0.U_ABill',
            'T0.U_Seal',
            'T0.U_ContainerNo',
            'T3.LicTradNum',
            'T0.U_BillLading',
            'T1.U_SupplierCode',
            \DB::raw("CASE 
                        WHEN T3.QryGroup1  = 'Y' THEN 'JP-USD'
                        WHEN T3.QryGroup2  = 'Y' THEN 'SBC-WCC-USD'
                        WHEN T3.QryGroup3  = 'Y' THEN 'SBC-WCC-PHP'
                        WHEN T3.QryGroup4  = 'Y' THEN 'SBC-WCC-EUR'
                        WHEN T3.QryGroup5  = 'Y' THEN 'JP-PHP'
                        WHEN T3.QryGroup6  = 'Y' THEN 'BPI-W 5th-EUR'
                    END as BankType"),
            'g.U_T1',
            'g.U_T2',
            'g.U_T3',
            'g.U_T4',
            'g.U_T5',
            'g.U_T6'
            // \DB::raw("REPLACE(ISNULL(g.U_T6, ''), N'/', CHAR(13)) as U_T6")
        )
        ->from('ODLN as T0')
        ->leftJoin('DLN1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        ->leftJoin('OCTG as T2', 'T0.GroupNum', '=', 'T2.GroupNum')
        ->leftJoin('OCRD as T3', 'T0.CardCode', '=', 'T3.CardCode')
        ->leftJoin('OINV as T4', 'T0.DocEntry', '=', 'T4.DocEntry')
        ->leftJoin('OCQG as T5', 'T3.GroupCode', '=', 'T5.GroupCode')
        ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', \DB::raw("
            CASE 
                WHEN T3.QryGroup1  = 'Y' THEN 'SBC-WCC-USD'
            END
        "))
        ->where('T0.DocEntry', '=', $customer_ref)
        ->orderBy('T0.DocNum', 'ASC')
        ->get();
        View::share('details', $details);
        
        $view = Route::currentRouteName() === 'ccc_bir_original_invoice'
        ? 'print_templates.ccc.bir.commercial_invoice'
        : 'print_templates.whi.bir.';

        $pdf = PDF::loadView($view, [
            array(
                'details' =>$details,
            ),
            'prepared_by' => $prepared_by,
        ])
        ->setPaper([0, 0, 622, 792], 'portrait');

        return $pdf->stream('PBI_BIR_Commercial_Invoice.pdf');
    }
    
}

function sales_invoice_index(Request $request) 
    {

        $search = $request->input('search');
        $model = null;
        $view = '';

        if ($request->is('ccc_bir_sales_invoice')) {
            $model = ODLN_CCC::query();
            $view = 'print_templates.print_lists.ccc.bir_sales_invoice_list';
        } else {
            abort(404); 
        }

        if ($request->is('ccc_bir_sales_invoice')) {
            $model->leftJoin('OCRD as customer', 'ODLN.CardCode', '=', 'customer.CardCode')
                  ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', DB::raw("
                      CASE 
                          WHEN customer.QryGroup1  = 'Y' THEN 'SBC-WCC-USD'
                      END
                  "));
        } 

        $details = $model->select(
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.DocEntry' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_invNo' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.Address' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.GroupNum' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.DocDate' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.PayToCode' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.DocNum' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.NumAtCard' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_BuyersPO' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_Salescontract' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.DocDueDate' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_PlaceLoading' : null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.DocCur': null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_Destinationport': null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_ModeShip': null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_Delivery': null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_Feeder': null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_Ocean': null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_BillLading': null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_ContainerNo': null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_Seal': null,
            $request->is('ccc_bir_sales_invoice') ? 'ODLN.U_SAODueDate': null,
            'g.U_T1',
            'g.U_T2',
            'g.U_T3',
            'g.U_T4',
            'g.U_T5',
            'g.U_T6',
        )        
        ->when($search, function ($query) use ($search, $request) {
            $terms = explode(' ', $search);
            foreach ($terms as $term) {
                $query->where(function ($q) use ($term, $request) {
                    if ($request->is('ccc_bir_sales_invoice')) {
                        $q->where('ODLN.U_invNo', 'LIKE', "%{$term}%")
                        ->orWhere('ODLN.Address', 'LIKE', "%{$term}%")
                        ->orWhere('ODLN.U_BuyersPO', 'LIKE', "%{$term}%")
                        ->orWhere('ODLN.NumAtCard', 'LIKE', "%{$term}%");
                    }
                });
            }
        })        
          ->orderBy('ODLN.DocEntry', 'desc')
          ->where('CANCELED' ,'!=', 'Y' )
          ->paginate(15);
        
        return view($view, 
            array(
                'details' =>$details,
                'search' =>$search,
            )
        );
    }

    function ccc_original_sales_invoice_print(Request $request, $invoice_number){
        {
            $customer_ref =$invoice_number;
            $prepared_by = $request->input('prepared_by');
    
            $details = ODLN_CCC::select(
                'T0.DocEntry',
                'T0.DocNum',
                'T0.NumAtCard',
                'T0.DocStatus',
                'T0.CardName',
                'T0.PayToCode',
                'T0.Address as Billtoaddress',
                \DB::raw('T0.ShipToCode + CHAR(13) + T0.Address2 as Shiptoaddress'),
                'T0.U_Salescontract',
                'T0.DocDueDate',
                'T0.U_BuyersPO',
                'T0.U_ModeShip',
                'T0.U_Delivery',
                'T0.DocCur',
                 \DB::raw("CASE WHEN T0.DocCur = 'PHP' THEN T1.LineTotal ELSE T1.LineTotal / T1.Rate END AS Linetotal"),
    
                // 'T0.U_Remarks1',
                // 'T0.U_Remarks2',
                // 'T0.U_Remarks3',
                // 'T0.U_SOADueDate',
                'T0.U_PlaceLoading',
                'T0.U_Destinationport',
                // 'T0.SOADueDate',
                // 'T0.U_TaxID',
                'T0.Address2',
                'T0.ShipToCode',
                'T1.U_Label_as',
                'T1.U_Bagsperlot',
                'T1.U_packUOM',
                'T1.U_printUOM',
                'T1.U_Netweight',
                \DB::raw('T1.U_Bagsperlot * T1.U_Netweight as Quantity'),
                'T1.TotalFrgn',
                // 'T0.U_SAODueDate',
                \DB::raw("CASE 
                            WHEN T1.U_MetricTon = 1 OR T1.U_MetricTon = '' OR T1.U_MetricTon IS NULL THEN 
                                (CASE WHEN T1.U_printUOM = 'lbs' THEN ISNULL(T1.Price, 0.00) / 2.2 ELSE ISNULL(T1.Price, 0.00) END) 
                            ELSE 
                                (CASE WHEN T1.U_printUOM = 'lbs' THEN T1.U_UnitCostMetricTon / 2.2 ELSE T1.U_UnitCostMetricTon END) 
                        END as Price"),
                'T2.PymntGroup',
                'T2.GroupNum',
                'T0.U_ABill',
                'T0.U_Seal',
                'T0.U_ContainerNo',
                'T3.LicTradNum',
                'T0.U_BillLading',
                'T1.U_SupplierCode',
                'T4.U_SOANo as ArSoaNo',
                'T4.DocDueDate as ArDueDate',
                \DB::raw("CASE 
                            WHEN T3.QryGroup1  = 'Y' THEN 'JP-USD'
                            WHEN T3.QryGroup2  = 'Y' THEN 'SBC-WCC-USD'
                            WHEN T3.QryGroup3  = 'Y' THEN 'SBC-WCC-PHP'
                            WHEN T3.QryGroup4  = 'Y' THEN 'SBC-WCC-EUR'
                            WHEN T3.QryGroup5  = 'Y' THEN 'JP-PHP'
                            WHEN T3.QryGroup6  = 'Y' THEN 'BPI-W 5th-EUR'
                        END as BankType"),
                'g.U_T1',
                'g.U_T2',
                'g.U_T3',
                'g.U_T4',
                'g.U_T5',
                'g.U_T6'
                // \DB::raw("REPLACE(ISNULL(g.U_T6, ''), N'/', CHAR(13)) as U_T6")
            )
            ->from('ODLN as T0')
            ->leftJoin('DLN1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
            ->leftJoin('OCTG as T2', 'T0.GroupNum', '=', 'T2.GroupNum')
            ->leftJoin('OCRD as T3', 'T0.CardCode', '=', 'T3.CardCode')
            ->leftJoin('OINV as T4', function($join) {
                $join->on('T4.DocEntry', '=', 'T1.TrgetEntry');
            })
            ->leftJoin('OCQG as T5', 'T3.GroupCode', '=', 'T5.GroupCode')
            ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', \DB::raw("
                CASE 
                    WHEN T3.QryGroup1  = 'Y' THEN 'SBC-WCC-USD'
                END
            "))
            ->where('T0.DocEntry', '=', $customer_ref)
            ->orderBy('T0.DocNum', 'ASC')
            ->get();
            View::share('details', $details);
            
            $view = Route::currentRouteName() === 'ccc_bir_original_sales_invoice_vatable'
            ? 'print_templates.ccc.bir.sales_invoice_vatable'
            : 'print_templates.ccc.bir.sales_invoice_zero_rate';
    
            $pdf = PDF::loadView($view, [
                array(
                    'details' =>$details,
                ),
                'prepared_by' => $prepared_by,
            ])
            ->setPaper([0, 0, 622, 792], 'portrait');
    
            return $pdf->stream('CCC_BIR_Sales_Invoice.pdf');
        }
        
    }

}
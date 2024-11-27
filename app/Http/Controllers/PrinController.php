<?php

namespace App\Http\Controllers;

use App\BillingStatement;
use App\BillingStatementProduct;
use App\CreditNote;
use App\CreditNoteItem;
use App\CreditNoteProduct;
use App\CreditNoteProductHeader;
use App\OCRD;
use App\ODLN_CCC;
use App\OINV;
use App\OINV_CCC;
use App\ORDR;
use App\ORDR_PBI;
use App\PbiCreditNote;
use App\PbiCreditNoteItem;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use PDF;

class PrinController extends Controller
{
    public function soa_usa_commercial(Request $request)
    {
        $soa_no = $request->input('soa_no');
        $customer_ref = $request->input('customer_ref');
        $soa_type = $request->input('soa_type');
        $prepared_by = $request->input('prepared_by');

        // Fetch data from the database
        $details = ORDR::select(
            'T0.DocEntry',
            'T0.DocNum',
            'T0.NumAtCard',
            'T0.DocStatus',
            'T0.CardName',
            'T0.PayToCode',
            'T0.Address as Billtoaddress',
            'T0.ShipToCode',
            'T0.Address2 as Shiptoaddress',
            'T0.U_Salescontract',
            'T0.DocDueDate',
            'T0.U_BuyersPO',
            'T0.U_SOANum',
            'T0.U_ModeShip',
            'T0.U_Delivery',
            'T1.U_label_as',
            'T1.U_Bagsperlot',
            'T1.U_packUOM',
            'T1.U_printUOM',
            'T1.U_Netweight',
            \DB::raw('T1.U_Bagsperlot * T1.U_Netweight as Quantity'),
            'T1.TotalFrgn',
            'T0.DocCur',
            'T0.U_SAODueDate',
            \DB::raw("CASE 
                            WHEN T1.U_MetricTon = 1 OR T1.U_MetricTon = '' OR T1.U_Metricton IS NULL THEN 
                                (CASE WHEN T1.U_printUOM = 'lbs' THEN ISNULL(T1.Price, 0.00) / 2.2 ELSE ISNULL(T1.Price, 0.00) END) 
                            ELSE 
                                (CASE WHEN T1.U_printUOM = 'lbs' THEN T1.U_UnitCostMetricTon / 2.2 ELSE T1.U_UnitCostMetricTon END) 
                        END as Price"),
            'T2.PymntGroup',
            'T2.GroupNum',
            DB::raw("CASE WHEN T0.DocCur = 'PHP' THEN T1.LineTotal ELSE T1.TotalFrgn END as LineTotal"),
            'T0.U_PortDestination',
            'T0.U_PortLoad',
            'T0.U_OceanVessel',
            'T0.U_FeedVessel',
            'T0.U_ABill',
            'T0.U_Seal',
            'T0.U_ContainerNo',
            'T0.U_BillLading'
        )
        ->from('ORDR as T0')
        ->leftJoin('RDR1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        ->leftJoin('OCTG as T2', 'T0.GroupNum', '=', 'T2.GroupNum')
        // ->where('T0.U_SOANum', '=', $soa_no)
        ->where('T0.NumAtCard', '=', $customer_ref)
        ->orderBy('T0.DocNum', 'ASC')
        ->get();

        // Share the data with the view
        View::share('details', $details);
        
        // Load the view and generate PDF
        $pdf = PDF::loadView('print_templates.whi.soa.usa_commercial_invoice', [
            array(
                'details' =>$details,
            ),
            'soa_no' => $soa_no,
            'soa_type' => $soa_type,
            'prepared_by' => $prepared_by,
        ])->setPaper('A4', 'portrait');

        // Output PDF as a response
        return $pdf->stream('SOA_USA_Commercial_Invoice.pdf');
    }

    public function soa_eur_commercial(Request $request)
    {
        $soa_no = $request->input('soa_no');
        $customer_ref = $request->input('customer_ref');
        $prepared_by = $request->input('prepared_by');
        $soa_type = $request->input('soa_type');
        // Fetch data from the database
        $details = ORDR::select(
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
            'T0.U_SOANum',
            'T0.U_ModeShip',
            'T0.U_Delivery',
            'T1.U_label_as',
            'T1.U_Bagsperlot',
            'T1.U_packUOM',
            'T1.U_printUOM',
            'T1.U_Netweight',
            \DB::raw('T1.U_Bagsperlot * T1.U_Netweight as Quantity'),
            'T1.TotalFrgn',
            'T0.DocCur',
            'T0.U_SAODueDate',
            \DB::raw("CASE 
                        WHEN T1.U_MetricTon = 1 OR T1.U_MetricTon = '' OR T1.U_MetricTon IS NULL THEN 
                            (CASE WHEN T1.U_printUOM = 'lbs' THEN ISNULL(T1.Price, 0.00) / 2.2 ELSE ISNULL(T1.Price, 0.00) END) 
                        ELSE 
                            (CASE WHEN T1.U_printUOM = 'lbs' THEN T1.U_UnitCostMetricTon / 2.2 ELSE T1.U_UnitCostMetricTon END) 
                    END as Price"),
            'T2.PymntGroup',
            'T2.GroupNum',
            'T0.U_PortDestination',
            'T0.U_PortLoad',
            'T0.U_OceanVessel',
            'T0.U_FeedVessel',
            'T0.U_ABill',
            'T0.U_Seal',
            'T0.U_ContainerNo',
            'T0.U_Remark2',
            'T0.U_TaxID as LicTradNum',
            'T0.U_BillLading',
            'T1.U_SupplierCode',
            \DB::raw("CASE 
                        WHEN T3.QryGroup2  = 'Y' THEN 'SBC-WCC-USD1'
                        WHEN T3.QryGroup3  = 'Y' THEN 'BDO-USD'
                        WHEN T3.QryGroup4  = 'Y' THEN 'MBTC-USD'
                        WHEN T3.QryGroup5  = 'Y' THEN 'SBC-WCC-EUR'
                        WHEN T3.QryGroup6  = 'Y' THEN 'SBC-WCC-USD'
                        WHEN T3.QryGroup7  = 'Y' THEN 'SBC-WCC-PHP'
                        WHEN T3.QryGroup8  = 'Y' THEN 'SBC-MARKET-PHP'
                        WHEN T3.QryGroup9  = 'Y' THEN 'SBC-MARKET-USD'
                        WHEN T3.QryGroup10 = 'Y' THEN 'BOA-PO BOX'
                        WHEN T3.QryGroup11 = 'Y' THEN 'BOA-ACH'
                        WHEN T3.QryGroup16 = 'Y' THEN 'BPI-W 5th-EUR'
                    END as BankType"),
            'g.U_T1',
            'g.U_T2',
            'g.U_T3',
            'g.U_T4',
            'g.U_T5',
            'g.U_T6'
            // \DB::raw("REPLACE(ISNULL(g.U_T6, ''), N'/', CHAR(13)) as U_T6")
        )
        ->from('ORDR as T0')
        ->leftJoin('RDR1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        ->leftJoin('OCTG as T2', 'T0.GroupNum', '=', 'T2.GroupNum')
        ->leftJoin('OCRD as T3', 'T0.CardCode', '=', 'T3.CardCode')
        ->leftJoin('OINV as T4', 'T0.DocEntry', '=', 'T4.DocEntry')
        ->leftJoin('OCQG as T5', 'T3.GroupCode', '=', 'T5.GroupCode')
        ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', \DB::raw("
            CASE 
                WHEN T3.QryGroup2  = 'Y' THEN 'SBC-WCC-USD1'
                WHEN T3.QryGroup3  = 'Y' THEN 'BDO-USD'
                WHEN T3.QryGroup4  = 'Y' THEN 'MBTC-USD'
                WHEN T3.QryGroup5  = 'Y' THEN 'SBC-WCC-EUR'
                WHEN T3.QryGroup6  = 'Y' THEN 'SBC-WCC-USD'
                WHEN T3.QryGroup7  = 'Y' THEN 'SBC-WCC-PHP'
                WHEN T3.QryGroup8  = 'Y' THEN 'SBC-MARKET-PHP'
                WHEN T3.QryGroup9  = 'Y' THEN 'SBC-MARKET-USD'
                WHEN T3.QryGroup10 = 'Y' THEN 'BOA-PO BOX'
                WHEN T3.QryGroup11 = 'Y' THEN 'BOA-ACH'
                WHEN T3.QryGroup16 = 'Y' THEN 'BPI-W 5th-EUR'
            END
        "))
        ->where('T0.NumAtCard', '=', $customer_ref)
        ->orderBy('T0.DocNum', 'ASC')
        ->get();
        View::share('details', $details);
        
        $pdf = PDF::loadView('print_templates.whi.soa.eur_commercial_invoice', [
            array(
                'details' =>$details,
            ),
            'soa_no' => $soa_no,
            'prepared_by' => $prepared_by,
            'soa_type' => $soa_type,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('SOA_EUR_Commercial_Invoice.pdf');
    }

    public function soa_php_commercial(Request $request)
    {
        $soa_no = $request->input('soa_no');
        $customer_ref = $request->input('customer_ref');
        $prepared_by = $request->input('prepared_by');
        $soa_type = $request->input('soa_type');
        // Fetch data from the database
        $details = ORDR::select(
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
            'T0.U_SOANum',
            'T0.U_ModeShip',
            'T0.U_Delivery',
            'T1.U_label_as',
            'T1.U_Bagsperlot',
            'T1.U_packUOM',
            'T1.U_printUOM',
            'T1.U_Netweight',
            \DB::raw('T1.U_Bagsperlot * T1.U_Netweight as Quantity'),
            'T1.TotalFrgn',
            'T0.DocCur',
            'T0.U_SAODueDate',
            \DB::raw("CASE 
                        WHEN T1.U_MetricTon = 1 OR T1.U_MetricTon = '' OR T1.U_MetricTon IS NULL THEN 
                            (CASE WHEN T1.U_printUOM = 'lbs' THEN ISNULL(T1.Price, 0.00) / 2.2 ELSE ISNULL(T1.Price, 0.00) END) 
                        ELSE 
                            (CASE WHEN T1.U_printUOM = 'lbs' THEN T1.U_UnitCostMetricTon / 2.2 ELSE T1.U_UnitCostMetricTon END) 
                    END as Price"),
            'T2.PymntGroup',
            'T2.GroupNum',
            'T0.U_PortDestination',
            'T0.U_PortLoad',
            'T0.U_OceanVessel',
            'T0.U_FeedVessel',
            'T0.U_ABill',
            'T0.U_Seal',
            'T0.U_ContainerNo',
            'T0.U_Remark2',
            'T0.U_TaxID as LicTradNum',
            'T0.U_BillLading',
            'T1.U_SupplierCode',
            \DB::raw("CASE 
                        WHEN T3.QryGroup2  = 'Y' THEN 'SBC-WCC-USD1'
                        WHEN T3.QryGroup3  = 'Y' THEN 'BDO-USD'
                        WHEN T3.QryGroup4  = 'Y' THEN 'MBTC-USD'
                        WHEN T3.QryGroup5  = 'Y' THEN 'SBC-WCC-EUR'
                        WHEN T3.QryGroup6  = 'Y' THEN 'SBC-WCC-USD'
                        WHEN T3.QryGroup7  = 'Y' THEN 'SBC-WCC-PHP'
                        WHEN T3.QryGroup8  = 'Y' THEN 'SBC-MARKET-PHP'
                        WHEN T3.QryGroup9  = 'Y' THEN 'SBC-MARKET-USD'
                        WHEN T3.QryGroup10 = 'Y' THEN 'BOA-PO BOX'
                        WHEN T3.QryGroup11 = 'Y' THEN 'BOA-ACH'
                        WHEN T3.QryGroup16 = 'Y' THEN 'BPI-W 5th-EUR'
                    END as BankType"),
            'g.U_T1',
            'g.U_T2',
            'g.U_T3',
            'g.U_T4',
            'g.U_T5',
            'g.U_T6'
            // \DB::raw("REPLACE(ISNULL(g.U_T6, ''), N'/', CHAR(13)) as U_T6")
        )
        ->from('ORDR as T0')
        ->leftJoin('RDR1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        ->leftJoin('OCTG as T2', 'T0.GroupNum', '=', 'T2.GroupNum')
        ->leftJoin('OCRD as T3', 'T0.CardCode', '=', 'T3.CardCode')
        ->leftJoin('OINV as T4', 'T0.DocEntry', '=', 'T4.DocEntry')
        ->leftJoin('OCQG as T5', 'T3.GroupCode', '=', 'T5.GroupCode')
        ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', \DB::raw("
            CASE 
                WHEN T3.QryGroup2  = 'Y' THEN 'SBC-WCC-USD1'
                WHEN T3.QryGroup3  = 'Y' THEN 'BDO-USD'
                WHEN T3.QryGroup4  = 'Y' THEN 'MBTC-USD'
                WHEN T3.QryGroup5  = 'Y' THEN 'SBC-WCC-EUR'
                WHEN T3.QryGroup6  = 'Y' THEN 'SBC-WCC-USD'
                WHEN T3.QryGroup7  = 'Y' THEN 'SBC-WCC-PHP'
                WHEN T3.QryGroup8  = 'Y' THEN 'SBC-MARKET-PHP'
                WHEN T3.QryGroup9  = 'Y' THEN 'SBC-MARKET-USD'
                WHEN T3.QryGroup10 = 'Y' THEN 'BOA-PO BOX'
                WHEN T3.QryGroup11 = 'Y' THEN 'BOA-ACH'
                WHEN T3.QryGroup16 = 'Y' THEN 'BPI-W 5th-EUR'
            END
        "))
        ->where('T0.NumAtCard', '=', $customer_ref)
        ->orderBy('T0.DocNum', 'ASC')
        ->get();
        View::share('details', $details);
        
        $pdf = PDF::loadView('print_templates.whi.soa.php_commercial_invoice', [
            array(
                'details' =>$details,
            ),
            'soa_no' => $soa_no,
            'prepared_by' => $prepared_by,
            'soa_type' => $soa_type,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('SOA_PHP_Commercial_Invoice.pdf');
    }

    public function billing_statement(Request $request)
    {
        $soa_no = $request->input('soa_no');
        $customer_ref = $request->input('customer_ref');

        $details = OINV::distinct()
        ->select(
            'T0.DocNum',
            'T1.LineNum',
            'T0.U_SOANo as U_XSOANo',
            'T0.DocDate',
            'T0.CardName',
            DB::raw("ISNULL(T0.Address, '') as Address"),
            'T1.Quantity',
            'T1.unitMsr',
            'T1.Dscription',
            'T1.Price',
            'T1.Currency',
            DB::raw("CASE WHEN T0.DocCur = 'PHP' THEN T1.LineTotal ELSE T1.TotalFrgn END as LineTotal"),
            'T0.Comments',
            'T4.PymntGroup',
            'T0.DocDueDate'
        )
        ->from('OINV as T0')
        ->leftJoin('INV1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        ->leftJoin('OCRD as T2', 'T0.CardCode', '=', 'T2.CardCode')
        ->leftJoin('CRD1 as T3', 'T2.CardCode', '=', 'T3.CardCode')
        ->leftJoin('OCTG as T4', 'T0.GroupNum', '=', 'T4.GroupNum')
        // ->where('T0.DocStatus', 'O')
        ->where('T0.Canceled', 'N')
        ->where('T0.U_invNo', '=', $soa_no)
        ->get();


        // Share the data with the view
        View::share('details', $details);
        
        if (Route::currentRouteName() === 'billing_statement_trade') {
            $view = 'print_templates.whi.billing_statement.billing_trade';
        } elseif (Route::currentRouteName() === 'billing_statement_non_trade') {
            $view = 'print_templates.whi.billing_statement.billing_non_trade';
        }
        // Load the view and generate PDF
        $pdf = PDF::loadView($view, [
            array(
                'details' =>$details,
            ),
            'soa_no' => $soa_no,
        ])->setPaper('A4', 'portrait');

        // Output PDF as a response
        return $pdf->stream('Billing_Statement_Trade.pdf');
    }
    public function billing_statement_non_trade_list(Request $request)
        {$search = $request->input('search');

        $details = OINV::select(
            'OINV.DocNum',
            'OINV.U_SOANo as U_XSOANo',
            'OINV.DocDate',
            'OINV.CardName',
            'OINV.U_invNo',
            'OINV.Address',
            'OINV.DocDueDate',
            'OINV.GroupNum',
            'OINV.DocEntry',
            'OINV.DocCur',
            'OINV.CardCode',
            'OINV.Canceled',
            'g.U_T1',
            'g.U_T2',
            'g.U_T3',
            'g.U_T4',
            'g.U_T5',
            'g.U_T6'
        )
        // $details = OINV::distinct()
        // ->select(
        //     'T0.DocNum',
        //     'T1.LineNum',
        //     'T0.U_SOANo as U_XSOANo',
        //     'T0.DocDate',
        //     'T0.CardName',
        //     'T0.U_invNo',
        //     DB::raw("ISNULL(T0.Address, '') as Address"),
        //     'T1.Quantity',
        //     'T1.unitMsr',
        //     'T1.Dscription',
        //     'T1.Price',
        //     'T1.Currency',
        //     DB::raw("CASE WHEN T0.DocCur = 'PHP' THEN T1.LineTotal ELSE T1.TotalFrgn END as LineTotal"),
        //     'T0.Comments',
        //     'T4.PymntGroup',
        //     'T0.DocDueDate'
        // )
        // ->from('OINV as T0')
        // ->leftJoin('INV1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        // ->leftJoin('OCRD as T2', 'T0.CardCode', '=', 'T2.CardCode')
        // ->leftJoin('CRD1 as T3', 'T2.CardCode', '=', 'T3.CardCode')
        // ->leftJoin('OCTG as T4', 'T0.GroupNum', '=', 'T4.GroupNum')
        // ->where('T0.DocStatus', 'O')
        ->when($search, function ($query) use ($search) {
            $terms = explode(' ', $search);
            foreach ($terms as $term) {
                $query->where(function ($q) use ($term) {
                    $q->where('OINV.U_invNo', 'LIKE', "%{$term}%")
                      ->orWhere('OINV.CardName', 'LIKE', "%{$term}%")
                      ->orWhere('OINV.DocDate', 'LIKE', "%{$term}%");
                });
            }
        })
        ->where('OINV.Canceled', 'N')
        ->where('OINV.DocCur', '=', 'PHP')
        ->where('OINV.U_invNo', '!=', '')
        ->leftJoin('OCRD as customer', 'OINV.CardCode', '=', 'customer.CardCode')
                  ->leftJoin('@Payment_Instruction as g', 'g.Code', '=', DB::raw("
                      CASE 
                          WHEN customer.QryGroup1  = 'Y' THEN 'JP-USD'
                          WHEN customer.QryGroup2  = 'Y' THEN 'SBC-WCC-USD'
                          WHEN customer.QryGroup3  = 'Y' THEN 'SBC-WCC-PHP'
                          WHEN customer.QryGroup4  = 'Y' THEN 'SBC-WCC-EUR'
                          WHEN customer.QryGroup5  = 'Y' THEN 'JP-PHP'
                          WHEN customer.QryGroup6  = 'Y' THEN 'BPI-W 5th-EUR'
                      END
                  "))
        ->paginate(15);

        return view('print_templates.whi.billing_statement.billing_non_trade_list', 
            array(
                'details' =>$details,
                'search' =>$search,
            )
        );
    }

    function save_as_new_invoice(Request $request) {
        $save_as_new = new BillingStatement;
        $save_as_new->DocNum = $request->DocEntry; 
        $save_as_new->BilledTo = $request->BilledTo; 
        $save_as_new->Soa = $request->Soa; 
        $save_as_new->Date = $request->InvoiceDate; 
        $save_as_new->Subject = $request->Subject; 
        $save_as_new->Currency = $request->Currency; 
        $save_as_new->TermsOfPayment = $request->TermsOfPayment; 
        $save_as_new->DueDate = $request->DueDate; 
        $save_as_new->AccountName = $request->AccountName; 
        $save_as_new->AccountNumber = $request->AccountNumber; 
        $save_as_new->Bank = $request->Bank; 
        $save_as_new->save();
        foreach ($request->Particulars as $index => $particulars) {
            $amount = isset($request->Amount[$index]) && $request->Amount[$index] !== '' 
                ? (float) str_replace(',', '', $request->Amount[$index]) 
                : null;
            $save_as_product = new BillingStatementProduct; 
            $save_as_product->DocNum = $save_as_new->id; 
            $save_as_product->Particulars = $particulars ?? null;
            $save_as_product->DatePeriod = $request->DatePeriod[$index] ?? null;
            $save_as_product->DocRef = $request->DocRef[$index] ?? null;
            $save_as_product->Amount = $amount ?? null;
            $save_as_product->save(); 
        }

        return redirect()->back()->with('success', 'Invoice saved successfully.');
    }

    function edit_new_invoice(Request $request, $id){
            $update_saved_invoice = BillingStatement::find($id);
            $update_saved_invoice->BilledTo = $request->BilledTo; 
            $update_saved_invoice->Soa = $request->Soa; 
            $update_saved_invoice->Date = $request->InvoiceDate; 
            $update_saved_invoice->Subject = $request->Subject; 
            $update_saved_invoice->Currency = $request->Currency; 
            $update_saved_invoice->TermsOfPayment = $request->TermsOfPayment; 
            $update_saved_invoice->DueDate = $request->DueDate; 
            $update_saved_invoice->AccountName = $request->AccountName; 
            $update_saved_invoice->AccountNumber = $request->AccountNumber; 
            $update_saved_invoice->Bank = $request->Bank; 

            $update_saved_invoice->update();

            foreach ($request->Particulars as $index => $particulars) {
                $productId = $request->product_id[$index];
                
                if ($productId) {
                    $save_as_product = BillingStatementProduct::find($productId);
                } else {
                    // Create a new product if no productId is provided
                    $save_as_product = new BillingStatementProduct();
                    $save_as_product->DocNum = $update_saved_invoice->id; // Assuming you need to link the product to the invoice
                }
        
                $save_as_product->Particulars = $particulars ?? null;
                $save_as_product->DatePeriod = $request->DatePeriod[$index] ?? null;
                $save_as_product->DocRef = $request->DocRef[$index] ?? null;
                $save_as_product->Amount = isset($request->Amount[$index]) && $request->Amount[$index] !== '' 
                    ? (float) str_replace(',', '', $request->Amount[$index]) 
                    : null;
        
                $save_as_product->save(); // Use save() to insert or update
            }
        return redirect()->back()->with('success', 'Invoice edited successfully.');
    }

    public function billing_statement_non_trade_print(Request $request, $id)
    {
        $details = BillingStatement::where('id', '=', $id)
        ->get();
        // Share the data with the view
        View::share('details', $details);
        
        // Load the view and generate PDF
        $pdf = PDF::loadView('print_templates.whi.billing_statement.billing_non_trade', [
            array(
                'details' =>$details,
            ),
        ])->setPaper('A4', 'portrait');

        // Output PDF as a response
        return $pdf->stream('Billing_Statement_Non_Trade.pdf');
    }

    function whi_credit_note_index(Request $request) 
    {
        $search = $request->input('search');

        $details = OINV::with(['warehouse','octgModel'])
        ->select(
            'DocEntry',
            'U_invNo', 
            'Address', 
            'PayToCode',
            'NumAtCard',
            )
            ->when($search, function ($query) use ($search) {
                $terms = explode(' ', $search);
                foreach ($terms as $term) {
                    $query->where(function ($q) use ($term) {
                        $q->where('U_invNo', 'LIKE', "%{$term}%")
                          ->orWhere('Address', 'LIKE', "%{$term}%")
                          ->orWhere('PayToCode', 'LIKE', "%{$term}%");
                    });
                }
            })
            ->where('CANCELED' ,'!=', 'Y' )
            ->orderBy('DocEntry', 'desc')
            ->paginate(15);
        
        return view('print_templates.whi.credit_note.credit_note_list', 
            array(
                'details' =>$details,
                'search' =>$search,
            )
        );
    }

    function save_credit_note(Request $request) {
        $save_new_credit_note = new CreditNote;
        $save_new_credit_note->DocNum = $request->DocEntry; 
        $save_new_credit_note->Date = $request->Date; 
        $save_new_credit_note->Client = $request->SoldTo; 
        $save_new_credit_note->ClientAddress = $request->Address;
        $save_new_credit_note->Tin = $request->Tin;
        $save_new_credit_note->BusinessStyle = $request->BusinessStyle;
        $save_new_credit_note->Reference = $request->Reference;
        $save_new_credit_note->Label1 = $request->Remarks;
        $save_new_credit_note->CreditNoteNumber = $request->CreditNoteNumber;
        $save_new_credit_note->Label2 = $request->SingleLabel;
        $save_new_credit_note->Total = $request->ProductTotal;
        $save_new_credit_note->save();

        $save_product_header = new CreditNoteProductHeader;
        $save_product_header->CreditNoteId = $save_new_credit_note->id; 
        $save_product_header->Header1 = $request->Header1; 
        $save_product_header->Header2 = $request->Header2; 
        $save_product_header->Header3 = $request->Header3;
        $save_product_header->Header4 = $request->Header4;
        $save_product_header->Header5 = $request->Header5;
        $save_product_header->Header6 = $request->Header6;
        $save_product_header->Header7 = $request->Header7;
        $save_product_header->Header8 = $request->Header8;
        $save_product_header->Header9 = $request->Header9;
        $save_product_header->Header10 = $request->Header10;
        $save_product_header->save();

        foreach ($request->Label1 as $index => $label1) {
            $save_as_product = new CreditNoteProduct(); 
            $save_as_product->CreditNoteId = $save_new_credit_note->id; 
            $save_as_product->Label1 = $label1;
            $save_as_product->Label2 = $request->Label2[$index];
            $save_as_product->Label3 = $request->Label3[$index];
            $save_as_product->Label4 = $request->Label4[$index];
            $save_as_product->Label5 = $request->Label5[$index];
            $save_as_product->Label6 = $request->Label6[$index];
            $save_as_product->Label7 = $request->Label7[$index];
            $save_as_product->Label8 = $request->Label8[$index];
            $save_as_product->Label9 = $request->Label9[$index];
            $save_as_product->Label10 = $request->Label10[$index];
            $save_as_product->save(); 
        }

        return redirect()->back()->with('success', 'Invoice saved successfully.');
    }

    function edit_credit_note(Request $request, $id) {
        $update_credit_note = CreditNote::find($id);
        $update_credit_note->Date = $request->Date; 
        $update_credit_note->Client = $request->SoldTo; 
        $update_credit_note->ClientAddress = $request->Address;
        $update_credit_note->Tin = $request->Tin;
        $update_credit_note->BusinessStyle = $request->BusinessStyle;
        $update_credit_note->Reference = $request->Reference;
        $update_credit_note->Label1 = $request->Remarks;
        $update_credit_note->CreditNoteNumber = $request->CreditNoteNumber;
        $update_credit_note->Label2 = $request->SingleLabel;
        $update_credit_note->Total = $request->ProductTotal;
        $update_credit_note->update();

        $edit_header = CreditNoteProductHeader::find($request->headerId);
        $edit_header->Header1 = $request->Header1; 
        $edit_header->Header2 = $request->Header2; 
        $edit_header->Header3 = $request->Header3;
        $edit_header->Header4 = $request->Header4;
        $edit_header->Header5 = $request->Header5;
        $edit_header->Header6 = $request->Header6;
        $edit_header->Header7 = $request->Header7;
        $edit_header->Header8 = $request->Header8;
        $edit_header->Header9 = $request->Header9;
        $edit_header->Header10 = $request->Header10;
        $edit_header->update();

        foreach ($request->Label1 as $index => $label1) {
            $bodyId = $request->bodyId[$index];

            if ($bodyId) {
                $edit_product = CreditNoteProduct::find($bodyId);
            } else {
                $edit_product = new CreditNoteProduct();
                $edit_product->CreditNoteId = $id;
            }
            $edit_product->Label1 = $label1;
            $edit_product->Label2 = $request->Label2[$index];
            $edit_product->Label3 = $request->Label3[$index];
            $edit_product->Label4 = $request->Label4[$index];
            $edit_product->Label5 = $request->Label5[$index];
            $edit_product->Label6 = $request->Label6[$index];
            $edit_product->Label7 = $request->Label7[$index];
            $edit_product->Label8 = $request->Label8[$index];
            $edit_product->Label9 = $request->Label9[$index];
            $edit_product->Label10 = $request->Label10[$index];
            $edit_product->save(); 
        }

        return redirect()->back()->with('success', 'Invoice saved successfully.');
    }

    function credit_note_internal_print(Request $request, $id){
        {
            $customer_ref =$id;
            $details = CreditNote::where('id', '=', $customer_ref)
            ->get();
            View::share('details', $details);
            
            $pdf = PDF::loadView('print_templates.whi.credit_note.credit_note_sharp', [
                array(
                    'details' =>$details,
                ),
            ])
            ->setPaper('letter', 'portrait');
    
            return $pdf->stream('WHI_Credit_Note.pdf');
        }
    }

    function credit_note_bir_print(Request $request, $id){
        {
            $customer_ref =$id;
            $details = CreditNote::where('id', '=', $customer_ref)
            ->get();
            View::share('details', $details);
            
            $pdf = PDF::loadView('print_templates.whi.credit_note.credit_note_bir', [
                array(
                    'details' =>$details,
                ),
            ])
            ->setPaper('letter', 'portrait');
    
            return $pdf->stream('WHI_Credit_Note.pdf');
        }
    }

    function pbi_credit_note_index(Request $request) 
    {
        $details = PbiCreditNote::get();
        
        return view('print_templates.pbi.credit_note.index', 
            array(
                'details' =>$details,
            )
        );
    }
    function pbi_save_credit_note(Request $request) {
        $save_credit_note = new PbiCreditNote();
        $save_credit_note->credit_note_no = $request->CreditNo; 
        $save_credit_note->client = $request->Client; 
        $save_credit_note->client_address = $request->ClientAddress; 
        $save_credit_note->date = $request->credit_date; 
        $save_credit_note->save();


        foreach ($request->Description as $index => $description) {
            $save_as_item = new PbiCreditNoteItem(); 
            $save_as_item->credit_note_id = $save_credit_note->id; 
            $save_as_item->list_no = $request->ListNo[$index];
            $save_as_item->quantity = $request->Quantity[$index];
            $save_as_item->unit = $request->Unit[$index];
            $save_as_item->currency = $request->Currency[$index];
            $save_as_item->description = $description;
            $save_as_item->total = $request->Total[$index];
            $save_as_item->unit_price = $request->UnitPrice[$index];
            $save_as_item->save(); 
        }

        return redirect()->back()->with('success', 'Credit Note saved successfully.');
    }

    function pbi_edit_credit_note(Request $request, $id) {
        $update_credit_note = PbiCreditNote::find($id);
        $update_credit_note->credit_note_no = $request->CreditNo; 
        $update_credit_note->client = $request->Client; 
        $update_credit_note->client_address = $request->ClientAddress;
        $update_credit_note->date = $request->credit_date;
        $update_credit_note->update();

        foreach ($request->Description as $index => $description) {
            $bodyId = $request->bodyId[$index];

            if ($bodyId) {
                $edit_item = PbiCreditNoteItem::find($bodyId);
            } else {
                $edit_item = new PbiCreditNoteItem();
                $edit_item->credit_note_id = $id;
            }
            $edit_item->description = $description;
            $edit_item->total = $request->Total[$index];
            $edit_item->list_no = $request->ListNo[$index];
            $edit_item->quantity = $request->Quantity[$index];
            $edit_item->unit = $request->Unit[$index];
            $edit_item->unit_price = $request->UnitPrice[$index];
            $edit_item->currency = $request->Currency[$index];
            $edit_item->save(); 
        }

        return redirect()->back()->with('success', 'Invoice saved successfully.');
    }

    function pbi_print_credit_note(Request $request, $id){
        $customer_ref =$id;
            $details = PbiCreditNote::where('id', '=', $id)
            ->get();
            View::share('details', $details);
            
            $pdf = PDF::loadView('print_templates.pbi.credit_note.bir_print', [
                array(
                    'details' =>$details,
                ),
            ])
            // ->setPaper([0, 0, 612, 396], 'portrait');
            ->setPaper('letter, portrait');
    
            return $pdf->stream('PBI_Credit_Note.pdf');
    } 

    public function soa_eur_commercial_pbi(Request $request)
    {
        $soa_no = $request->input('soa_no');
        $customer_ref = $request->input('customer_ref');
        $prepared_by = $request->input('prepared_by');
        $soa_type = $request->input('soa_type');
        // Fetch data from the database
        $details = ORDR_PBI::select(
            'T0.DocEntry',
            'T0.DocNum',
            'T0.U_SOADueDate',
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
            'T0.U_Remarks1',
            'T0.U_Remarks2',
            'T0.U_Remarks3',
            'T0.U_PlaceLoading',
            'T0.U_Destinationport',
            'T0.U_TaxID',
            'T0.Address2',
            'T0.ShipToCode',
            'T1.U_label_as',
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
        ->from('ORDR as T0')
        ->leftJoin('RDR1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        ->leftJoin('OCTG as T2', 'T0.GroupNum', '=', 'T2.GroupNum')
        ->leftJoin('OCRD as T3', 'T0.CardCode', '=', 'T3.CardCode')
        ->leftJoin('OINV as T4', 'T0.DocEntry', '=', 'T4.DocEntry')
        ->leftJoin('OCQG as T5', 'T3.GroupCode', '=', 'T5.GroupCode')
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
        ->where('T0.NumAtCard', '=', $customer_ref)
        ->orderBy('T0.DocNum', 'ASC')
        ->get();
        View::share('details', $details);
        
        $pdf = PDF::loadView('print_templates.pbi.soa.eur_commercial_invoice', [
            array(
                'details' =>$details,
            ),
            'soa_no' => $soa_no,
            'prepared_by' => $prepared_by,
            'soa_type' => $soa_type,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('SOA_PBI_EUR_Commercial_Invoice.pdf');
    }

    public function soa_php_commercial_pbi(Request $request)
    {
        $soa_no = $request->input('soa_no');
        $customer_ref = $request->input('customer_ref');
        $soa_type = $request->input('soa_type');
        $details = ORDR_PBI::select(
            'T0.DocEntry',
            'T0.DocNum',
            'T0.U_SOADueDate',
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
            'T0.U_Remarks1',
            'T0.U_Remarks2',
            'T0.U_Remarks3',
            'T0.U_PlaceLoading',
            'T0.U_Destinationport',
            // 'T0.SOADueDate',
            'T0.U_TaxID',
            'T0.Address2',
            'T0.ShipToCode',
            'T1.U_label_as',
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
        ->from('ORDR as T0')
        ->leftJoin('RDR1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        ->leftJoin('OCTG as T2', 'T0.GroupNum', '=', 'T2.GroupNum')
        ->leftJoin('OCRD as T3', 'T0.CardCode', '=', 'T3.CardCode')
        ->leftJoin('OINV as T4', 'T0.DocEntry', '=', 'T4.DocEntry')
        ->leftJoin('OCQG as T5', 'T3.GroupCode', '=', 'T5.GroupCode')
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
        ->where('T0.NumAtCard', '=', $customer_ref)
        ->orderBy('T0.DocNum', 'ASC')
        ->get();
        View::share('details', $details);
        
        $pdf = PDF::loadView('print_templates.pbi.soa.php_commercial_invoice', [
            array(
                'details' =>$details,
            ),
            'soa_no' => $soa_no,
            'soa_type' => $soa_type,
            // 'prepared_by' => $prepared_by,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('SOA_PBI_PHP_Commercial_Invoice.pdf');
    }

    public function whi_bir_commercial_invoice(Request $request)
    {
        $customer_ref = $request->input('customer_ref');
        $prepared_by = $request->input('prepared_by');

        $details = OINV::select(
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
            'c.Notes',
            'a.U_SWBuyersRef',
            'j.ItemName',
            \DB::raw("(SUBSTRING((SELECT DISTINCT ', ' + CONVERT(VARCHAR(20), i.U_BuyersPO) AS [text()]
                    FROM OINV a 
                    LEFT JOIN INV1 b ON a.DocEntry = b.DocEntry
                    LEFT JOIN ODLN c ON b.BaseEntry = c.DocEntry
                    LEFT JOIN DLN1 h ON c.DocEntry = h.DocEntry
                    LEFT JOIN RDR1 g ON h.BaseEntry = g.DocEntry                                
                    LEFT JOIN ORDR i ON g.DocEntry = i.DocEntry
                    WHERE a.U_invNo = '$customer_ref'
                    FOR XML PATH(''), ELEMENTS), 2, 200)) AS SO_BuyersPO"),
            \DB::raw("(SUBSTRING((SELECT DISTINCT ', ' + CONVERT(VARCHAR(20), i.NumAtCard) AS [text()]
                    FROM OINV a 
                    LEFT JOIN INV1 b ON a.DocEntry = b.DocEntry
                    LEFT JOIN ODLN c ON b.BaseEntry = c.DocEntry
                    LEFT JOIN DLN1 h ON c.DocEntry = h.DocEntry
                    LEFT JOIN RDR1 g ON h.BaseEntry = g.DocEntry                                
                    LEFT JOIN ORDR i ON g.DocEntry = i.DocEntry
                    WHERE a.U_invNo = '$customer_ref'
                    FOR XML PATH(''), ELEMENTS), 2, 200)) AS SO_BuyersRef"),
            \DB::raw("(SUBSTRING((SELECT DISTINCT ', ' + CONVERT(VARCHAR(20), i.U_SalesContract) AS [text()]
                    FROM OINV a 
                    LEFT JOIN INV1 b ON a.DocEntry = b.DocEntry
                    LEFT JOIN ODLN c ON b.BaseEntry = c.DocEntry
                    LEFT JOIN DLN1 h ON c.DocEntry = h.DocEntry
                    LEFT JOIN RDR1 g ON h.BaseEntry = g.DocEntry                                
                    LEFT JOIN ORDR i ON g.DocEntry = i.DocEntry
                    WHERE a.U_invNo = '$customer_ref'
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
        ->from('OINV as a')
        ->leftJoin('INV1 as b', 'a.docentry', '=', 'b.docentry')
        ->leftJoin('OHEM as f', 'a.OwnerCode', '=', 'f.empID')
        ->leftJoin('OCRD as c', 'a.CardCode', '=', 'c.CardCode')
        ->leftJoin('OCTG as d', 'a.GroupNum', '=', 'd.GroupNum')
        ->leftJoin('CRD1 as e', function($join) {
            $join->on('a.CardCode', '=', 'e.CardCode')
                ->where('e.AdresType', '=', 's');
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
        ->where('a.U_invNo', '=', $customer_ref)
        ->orderBy('a.DocNum', 'ASC')
        ->get();
        View::share('details', $details);
        
        $pdf = PDF::loadView('print_templates.whi.bir.commercial_invoice', [
            array(
                'details' =>$details,
            ),
            'prepared_by' => $prepared_by,
        ])
        ->setPaper('letter', 'portrait');

        return $pdf->stream('WHI_BIR_Commercial_Invoice.pdf');
    }
    
    function ccc_credit_note_index(Request $request) 
    {
        $search = $request->input('search');

        $details = ODLN_CCC::select(
            'DocEntry',
            'U_invNo', 
            'Address', 
            'PayToCode',
            'NumAtCard',
            'DocDate'
            )
            ->when($search, function ($query) use ($search) {
                $terms = explode(' ', $search);
                foreach ($terms as $term) {
                    $query->where(function ($q) use ($term) {
                        $q->where('NumAtCard', 'LIKE', "%{$term}%")
                          ->orWhere('Address', 'LIKE', "%{$term}%")
                          ->orWhere('PayToCode', 'LIKE', "%{$term}%");
                    });
                }
            })
            ->where('CANCELED' ,'!=', 'Y' )
            ->orderBy('DocEntry', 'desc')
            ->paginate(15);
        
        return view('print_templates.ccc.credit_note.credit_note_list', 
            array(
                'details' =>$details,
                'search' =>$search,
            )
        );
    }

    function ccc_save_credit_note(Request $request) {
        $save_new_credit_note = new CreditNote;
        $save_new_credit_note->DocNum = $request->DocEntry; 
        $save_new_credit_note->Date = $request->Date; 
        $save_new_credit_note->Client = $request->SoldTo; 
        $save_new_credit_note->CreditNoteNumber = $request->CreditNoteNumber;
        $save_new_credit_note->Label2 = $request->SingleLabel;
        $save_new_credit_note->Total = $request->ProductTotal;
        $save_new_credit_note->save();

        foreach ($request->Label1 as $index => $label1) {
            $save_as_product = new CreditNoteProduct(); 
            $save_as_product->CreditNoteId = $save_new_credit_note->id; 
            $save_as_product->Label1 = $label1;
            $save_as_product->Label2 = $request->Label2[$index];
            $save_as_product->Label3 = $request->Label3[$index];
            $save_as_product->Label4 = $request->Label4[$index];
            $save_as_product->Label5 = $request->Label5[$index];
            $save_as_product->Label6 = $request->Label6[$index];
            $save_as_product->Label7 = $request->Label7[$index];
            $save_as_product->Label8 = $request->Label8[$index];
            $save_as_product->save(); 
        }

        return redirect()->back()->with('success', 'Invoice saved successfully.');
    }

    function ccc_edit_credit_note(Request $request, $id) {
        $update_credit_note = CreditNote::find($id);
        $update_credit_note->Date = $request->Date; 
        $update_credit_note->Client = $request->SoldTo; 
        $update_credit_note->CreditNoteNumber = $request->CreditNoteNumber;
        $update_credit_note->Label2 = $request->SingleLabel;
        $update_credit_note->Total = $request->ProductTotal;
        $update_credit_note->update();


        foreach ($request->Label1 as $index => $label1) {
            $bodyId = $request->bodyId[$index];

            if ($bodyId) {
                $edit_product = CreditNoteProduct::find($bodyId);
            } else {
                $edit_product = new CreditNoteProduct();
                $edit_product->CreditNoteId = $id;
            }
            $edit_product->Label1 = $label1;
            $edit_product->Label2 = $request->Label2[$index];
            $edit_product->Label3 = $request->Label3[$index];
            $edit_product->Label4 = $request->Label4[$index];
            $edit_product->Label5 = $request->Label5[$index];
            $edit_product->Label6 = $request->Label6[$index];
            $edit_product->Label7 = $request->Label7[$index];
            $edit_product->Label8 = $request->Label8[$index];
            $edit_product->save(); 
        }

        return redirect()->back()->with('success', 'Invoice saved successfully.');
    }

    function ccc_credit_note_internal_print(Request $request, $id){
        {
            $customer_ref =$id;
            $details = CreditNote::where('id', '=', $customer_ref)
            ->get();
            View::share('details', $details);
            
            $pdf = PDF::loadView('print_templates.ccc.credit_note.credit_note_sharp', [
                array(
                    'details' =>$details,
                ),
            ])
            ->setPaper('letter', 'portrait');
    
            return $pdf->stream('CCC_Credit_Note.pdf');
        }
    }
    public function billing_statement_ccc(Request $request)
    {
        $soa_no = $request->input('soa_no');
        $customer_ref = $request->input('customer_ref');

        $details = ODLN_CCC::select(
            'T0.DocEntry',
            'T0.DocNum',
            'T0.U_Label',
            'T0.DocDate As Date',
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
            'T0.U_PlaceLoading',
            'T0.U_Destinationport',
            'T0.Address2',
            'T0.ShipToCode',
            'T1.U_Label_as',
            'T1.U_Bagsperlot',
            'T1.U_packUOM',
            'T1.U_printUOM',
            'T1.U_Netweight',
            'T1.Quantity',
            // \DB::raw('T1.U_Bagsperlot * T1.U_Netweight as Quantity'),
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
            'T4.DocDueDate as ArDueDate',
            'T4.U_invNo as ArInvoiceNo',
            'T4.NumAtCard as ArNumAtCard'
        )
        ->from('ODLN as T0')
        ->leftJoin('DLN1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
        ->leftJoin('OCTG as T2', 'T0.GroupNum', '=', 'T2.GroupNum')
        ->leftJoin('OCRD as T3', 'T0.CardCode', '=', 'T3.CardCode')
        ->leftJoin('OINV as T4', function($join) {
            $join->on('T4.DocEntry', '=', 'T1.TrgetEntry');
                //  ->where('T1.BaseType', '=', 17); 
        })
        ->leftJoin('OCQG as T5', 'T3.GroupCode', '=', 'T5.GroupCode')
        ->where('T0.NumAtCard', '=', $customer_ref)
        ->get();
        // Share the data with the view
        View::share('details', $details);
        
        // Load the view and generate PDF
        $pdf = PDF::loadView('print_templates.ccc.billing_statement.ccc_billing_print', [
            array(
                'details' =>$details,
            ),
            'soa_no' => $soa_no,
        ])->setPaper('A4', 'portrait');

        // Output PDF as a response
        return $pdf->stream('Billing_Statement_CCC.pdf');
    }

}

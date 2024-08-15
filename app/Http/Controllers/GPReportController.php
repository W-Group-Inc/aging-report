<?php

namespace App\Http\Controllers;
use App\OINV;
use App\OINV_PBI;
use App\OINV_CCC;
use App\PCH1_CCC;
use Illuminate\Http\Request;

class GPReportController extends Controller
{
    //

    public function index(Request $request)
    {
        $invoices = [];
        if($request->from)
        {
            if($request->company == "WHI") 
            {
                $startDate = $request->from; // Replace with actual start date parameter
                $endDate = $request->to;   // Replace with actual end date parameter
                // $last_invoices = OINV::where('DocNum', 10338)->get();
                // $ap = PCH1::with('chart_of_account')->get()->paginate(2);
                // $opch = OPCH::with('items')->where('DocNum','98100')->get();
                // $chart_of_account = OACT::where('AcctCode','_SYS00000000631')->paginate(2);
                // dd($ap);
                $invoices = OINV::select(
                    'T0.DocNum',
                    'T1.U_InvoiceNo',
                    'T0.DocDate as Date_of_Invoice',
                    'T0.U_ExInvoiceNo as Export_Invoice_No',
                    'T0.CardName as Client',
                    'T1.Dscription as PRODUCT_EXPORTED',
                    'T1.Quantity as VOLUME',
                    'T1.Price as UNIT_PRICE',
                    'T1.WhsCode as WhsCode',
                    'T0.CtlAccount as CurrencyType',
                    \DB::raw("CASE WHEN T2.BaseLine = T1.LineNum THEN (COALESCE(T1.TotalFrgn, 0.00) - COALESCE(T2.TotalFrgn, 0.00)) ELSE COALESCE(T1.TotalFrgn, 0.00) END as Dollar_Value"),
                    \DB::raw("CASE WHEN T2.BaseLine = T1.LineNum THEN (COALESCE(T1.LineTotal, 0.00) - COALESCE(T2.LineTotal, 0.00)) ELSE COALESCE(T1.LineTotal, 0.00) END as Php_Value"),
                    \DB::raw("CASE 
                                WHEN T2.BaseLine = T1.LineNum THEN (COALESCE(T1.LineTotal, 0.00) - COALESCE(T2.LineTotal, 0.00) - COALESCE(T1.GrssProfit, 0))
                                ELSE COALESCE(T1.LineTotal, 0.00) - COALESCE(T1.GrssProfit, 0)
                             END as COS_RM"),
                    \DB::raw("COALESCE(T1.GrssProfit, 0) as Gross_Profit_RM"),
                    \DB::raw("CASE 
                                WHEN COALESCE(T1.LineTotal, 0.00) <> 0 THEN CONVERT(VARCHAR(50), CAST((COALESCE(T1.GrssProfit, 0) / COALESCE(T1.LineTotal, 0.00) * 100) AS DECIMAL (19,2))) + '%'
                                ELSE 'N/A'
                             END as GP_percentage"),
                    'T4.ItmsGrpNam as Product_Classification'
                )
                ->from('OINV as T0')
                ->join('INV1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
                ->leftJoin('RIN1 as T2', 'T0.DocNum', '=', 'T2.BaseRef')
                ->join('OITM as T3', 'T1.ItemCode', '=', 'T3.ItemCode')
                ->join('OITB as T4', 'T3.ItmsGrpCod', '=', 'T4.ItmsGrpCod')
                ->where('T0.U_TypeofSale', '=', '2')
                ->where('T1.LineStatus', '=', 'O')
                ->where('T0.DocCur', '<>', 'PHP')
                ->with('ap_whi')
                ->whereBetween('T0.DocDate', [$startDate, $endDate])
                ->get();
           
        
            }
            else if($request->company == "PBI") 
            {
                $startDate = $request->from; // Replace with actual start date parameter
                $endDate = $request->to;   // Replace with actual end date parameter
                // $last_invoices = OINV::where('DocNum', 10338)->get();
                // $ap = PCH1::with('chart_of_account')->get()->paginate(2);
                // $opch = OPCH::with('items')->where('DocNum','98100')->get();
                // $chart_of_account = OACT::where('AcctCode','_SYS00000000631')->paginate(2);
                // dd($ap);
                $invoices = OINV_PBI::select(
                    'T0.DocNum',
                    'T1.U_InvoiceNo',
                    'T0.DocDate as Date_of_Invoice',
                    'T0.U_ExInvoiceNo as Export_Invoice_No',
                    'T0.CardName as Client',
                    'T1.Dscription as PRODUCT_EXPORTED',
                    'T1.Quantity as VOLUME',
                    'T1.Price as UNIT_PRICE',
                    'T1.WhsCode as WhsCode',
                    'T0.CtlAccount as CurrencyType',
                    \DB::raw("CASE WHEN T2.BaseLine = T1.LineNum THEN (COALESCE(T1.TotalFrgn, 0.00) - COALESCE(T2.TotalFrgn, 0.00)) ELSE COALESCE(T1.TotalFrgn, 0.00) END as Dollar_Value"),
                    \DB::raw("CASE WHEN T2.BaseLine = T1.LineNum THEN (COALESCE(T1.LineTotal, 0.00) - COALESCE(T2.LineTotal, 0.00)) ELSE COALESCE(T1.LineTotal, 0.00) END as Php_Value"),
                    \DB::raw("CASE 
                                WHEN T2.BaseLine = T1.LineNum THEN (COALESCE(T1.LineTotal, 0.00) - COALESCE(T2.LineTotal, 0.00) - COALESCE(T1.GrssProfit, 0))
                                ELSE COALESCE(T1.LineTotal, 0.00) - COALESCE(T1.GrssProfit, 0)
                             END as COS_RM"),
                    \DB::raw("COALESCE(T1.GrssProfit, 0) as Gross_Profit_RM"),
                    \DB::raw("CASE 
                                WHEN COALESCE(T1.LineTotal, 0.00) <> 0 THEN CONVERT(VARCHAR(50), CAST((COALESCE(T1.GrssProfit, 0) / COALESCE(T1.LineTotal, 0.00) * 100) AS DECIMAL (19,2))) + '%'
                                ELSE 'N/A'
                             END as GP_percentage"),
                    'T4.ItmsGrpNam as Product_Classification'
                )
                ->from('OINV as T0')
                ->join('INV1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
                ->leftJoin('RIN1 as T2', 'T0.DocNum', '=', 'T2.BaseRef')
                ->join('OITM as T3', 'T1.ItemCode', '=', 'T3.ItemCode')
                ->join('OITB as T4', 'T3.ItmsGrpCod', '=', 'T4.ItmsGrpCod')
                ->where('T0.U_TypeofSale', '=', '2')
                ->where('T1.LineStatus', '=', 'O')
                ->where('T0.DocCur', '<>', 'PHP')
                ->with('ap_whi')
                ->whereBetween('T0.DocDate', [$startDate, $endDate])
                ->get();
           
        
            }
            else if($request->company == "CCC") 
            {
                $startDate = $request->from; // Replace with actual start date parameter
                $endDate = $request->to;   // Replace with actual end date parameter
                // $last_invoices = OINV::where('DocNum', 10338)->get();
                // $ap = PCH1_CCC::with('chart_of_account')->take(2);
                // $opch = OPCH::with('items')->where('DocNum','98100')->get();
                // $chart_of_account = OACT::where('AcctCode','_SYS00000000631')->paginate(2);
                // dd($ap->get());
                $invoices = OINV_CCC::select(
                    'T0.DocNum',
                    'T1.U_InvoiceNo',
                    'T0.DocDate as Date_of_Invoice',
                    'T0.U_ExInvoiceNo as Export_Invoice_No',
                    'T0.CardName as Client',
                    'T1.Dscription as PRODUCT_EXPORTED',
                    'T1.Quantity as VOLUME',
                    'T1.Price as UNIT_PRICE',
                    'T1.WhsCode as WhsCode',
                    'T0.CtlAccount as CurrencyType',
                    \DB::raw("CASE WHEN T2.BaseLine = T1.LineNum THEN (COALESCE(T1.TotalFrgn, 0.00) - COALESCE(T2.TotalFrgn, 0.00)) ELSE COALESCE(T1.TotalFrgn, 0.00) END as Dollar_Value"),
                    \DB::raw("CASE WHEN T2.BaseLine = T1.LineNum THEN (COALESCE(T1.LineTotal, 0.00) - COALESCE(T2.LineTotal, 0.00)) ELSE COALESCE(T1.LineTotal, 0.00) END as Php_Value"),
                    \DB::raw("CASE 
                                WHEN T2.BaseLine = T1.LineNum THEN (COALESCE(T1.LineTotal, 0.00) - COALESCE(T2.LineTotal, 0.00) - COALESCE(T1.GrssProfit, 0))
                                ELSE COALESCE(T1.LineTotal, 0.00) - COALESCE(T1.GrssProfit, 0)
                             END as COS_RM"),
                    \DB::raw("COALESCE(T1.GrssProfit, 0) as Gross_Profit_RM"),
                    \DB::raw("CASE 
                                WHEN COALESCE(T1.LineTotal, 0.00) <> 0 THEN CONVERT(VARCHAR(50), CAST((COALESCE(T1.GrssProfit, 0) / COALESCE(T1.LineTotal, 0.00) * 100) AS DECIMAL (19,2))) + '%'
                                ELSE 'N/A'
                             END as GP_percentage"),
                    'T4.ItmsGrpNam as Product_Classification'
                )
                ->from('OINV as T0')
                ->join('INV1 as T1', 'T0.DocEntry', '=', 'T1.DocEntry')
                ->leftJoin('RIN1 as T2', 'T0.DocNum', '=', 'T2.BaseRef')
                ->join('OITM as T3', 'T1.ItemCode', '=', 'T3.ItemCode')
                ->join('OITB as T4', 'T3.ItmsGrpCod', '=', 'T4.ItmsGrpCod')
                ->where('T0.U_TypeofSale', '=', '2')
                ->where('T1.LineStatus', '=', 'O')
                ->where('T0.DocCur', '<>', 'PHP')
                ->with('ap_whi')
                ->whereBetween('T0.DocDate', [$startDate, $endDate])
                ->get();
           
        
            }
        }   

        return view('gp-report.index',
        array(
            'invoices' =>$invoices,
            'company' => $request->company,
        )
    ); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Aging;
use App\INV1;
use App\OINV;
use App\OINV_CCC;
use App\OINV_PBI;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonthlySalesController extends Controller
{
    public function index(Request $request) {
        $invoices = [];
        $last_invoices = [];
        $aging = [];
        $previous_month = date('Y-m-d', strtotime(date('Y-m')." -1 month"));
        
        if($request->company != null)
        {
        
            $aging = Aging::where('company',$request->company)->whereYear('date',date('Y',strtotime($previous_month)))->whereMonth('date',date('m',strtotime($previous_month)))->orderBy('date','desc')->first();
        }
        if($request->company == "WHI") {
            $last_invoices = OINV::where('DocNum', 10338)->whereRaw("FORMAT(DocDate, 'yyyy-MM') = ?", [$request->year . '-' . $request->month])->get();
            // $query1 = OINV::whereDoesntHave('warehouse', function($query) {
            //     $query->where('WhsCode', 'TRI Whse');
            // })
            $query1 = OINV::with('payments', 'terms', 'manager', 'remark')
            ->where('CardName', '!=', 'Mariel Tan')
            ->where('NumAtCard', '!=', 'WHI20-312L CCC')
            ->where('NumAtCard', '!=', 'WHI20-280L CCC')
            ->where('NumAtCard', '!=', 'WHI20-281L CCC-Mandaue')
            ->where('NumAtCard', '!=', 'WHI20-311L CCC-Mandaue')
            ->where('CardCode', 'not like', 'LR-%')
            ->where('CardCode', 'not like', 'WTT-%')
            ->whereIn('DocStatus', ['C', 'O'])
            ->whereNotIn('CANCELED', ['Y', 'C'])
            ->orderBy('DocDate', 'asc');

            if ($request->filled('year') && $request->filled('month')) {
                $date = $request->year . '-' . $request->month;
            
                $query1->whereRaw("FORMAT(DocDate, 'yyyy-MM') = ?", [$date]);
            }
            
            $invoices1 = $query1->get();

            $matchingDocEntries = INV1::select('DocEntry')
            ->whereIn('WhsCode', ['TRI Whse', 'VAT'])
            ->groupBy('DocEntry')
            ->havingRaw('COUNT(DISTINCT WhsCode) > 1 OR (COUNT(DISTINCT WhsCode) = 1 AND MAX(WhsCode) <> \'TRI Whse\')')
            ->pluck('DocEntry');


            $query2 = OINV::with('payments', 'terms', 'manager', 'remark')
            ->whereIn('DocEntry', $matchingDocEntries)
            ->whereIn('DocStatus', ['C', 'O'])
            ->whereNotIn('CANCELED', ['Y', 'C'])
            ->whereRaw("FORMAT(DocDate, 'yyyy-MM') = ?", [$request->year . '-' . $request->month])
            ->get();

            $invoices = $invoices1;

            foreach ($query2 as $invoice) {
                if (!$invoices1->contains('DocNum', $invoice->DocNum)) {
                    $invoices->push($invoice);
                }
            }
        }
       elseif ($request->company == "PBI") {
            $query = OINV_PBI::with('payments', 'terms', 'manager', 'remark')->where('CardCode', 'not like', 'LL-%')
            ->whereIn('DocStatus', ['C', 'O'])
            ->whereNotIn('CANCELED', ['Y', 'C']);

            if ($request->filled('year') && $request->filled('month')) {
                $year = $request->year;
                $month = str_pad($request->month, 2, '0', STR_PAD_LEFT);
                $query->whereRaw("YEAR(DocDate) = ? AND MONTH(DocDate) = ?", [$year, $month]);
            }

            $invoices = $query->orderBy('DocDate', 'desc')->get();
        }

        elseif($request->company == "CCC")
        {
            $query = OINV_CCC::with('payments','terms','manager', 'remark')
            ->whereIn('DocStatus', ['C', 'O'])
            ->whereNotIn('CANCELED', ['Y', 'C']);
            
            if ($request->filled('year') && $request->filled('month')) {
                $year = $request->year;
                $month = str_pad($request->month, 2, '0', STR_PAD_LEFT);
                $query->whereRaw("YEAR(DocDate) = ? AND MONTH(DocDate) = ?", [$year, $month]);
            }
            $invoices = $query->orderBy('DocDate', 'desc')->get();
        }
        
        return view('whi-report.monthly_sales',
            array(
                'invoices' =>$invoices,
                'company' => $request->company,
                'aging' => $aging,
                'previous_month' => $previous_month,
                'last_invoices' => $last_invoices,
            )
        ); 
    }
}

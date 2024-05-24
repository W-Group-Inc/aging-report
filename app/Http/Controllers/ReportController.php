<?php

namespace App\Http\Controllers;

use App\OINV;
use App\OINV_PBI;
use App\OINV_CCC;
use App\Aging;
use Illuminate\Http\Request;

class ReportController extends Controller
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
            $last_invoices = OINV::where('DocNum', 10338)->get();
        
            // $query = OINV::whereDoesntHave('warehouse', function($query) {
            //         $query->where('WhsCode', 'TRI Whse');
            //     })
            //     ->with('payments', 'terms', 'manager', 'remark')->where('CardName', '!=', 'Mariel Tan')->where('NumAtCard', '!=', 'WHI20-312L CCC')->where('NumAtCard', '!=', 'WHI20-280L CCC')->where('NumAtCard', '!=', 'WHI20-281L CCC-Mandaue')->where('NumAtCard', '!=', 'WHI20-311L CCC-Mandaue')->where('CardCode', 'not like', 'LR-%')->where('CardCode', 'not like', 'WTT-%')->where('DocStatus', 'O')->orderBy('DocDueDate', 'desc');

            // if ($request->filled('end_date')) {
              
            //     // $query->whereBetween('DocDate', [$request->start_date, $request->end_date]);
            //     $query->where('DocDate', '<=', $request->end_date);
            // }
        
            // $invoices = $query->get();
            $query1 = OINV::whereDoesntHave('warehouse', function($query) {
                $query->where('WhsCode', 'TRI Whse');
            })
            ->with('payments', 'terms', 'manager', 'remark')
            ->where('CardName', '!=', 'Mariel Tan')
            ->where('NumAtCard', '!=', 'WHI20-312L CCC')
            ->where('NumAtCard', '!=', 'WHI20-280L CCC')
            ->where('NumAtCard', '!=', 'WHI20-281L CCC-Mandaue')
            ->where('NumAtCard', '!=', 'WHI20-311L CCC-Mandaue')
            ->where('CardCode', 'not like', 'LR-%')
            ->where('CardCode', 'not like', 'WTT-%')
            ->where('DocStatus', 'O')
            ->orderBy('DocDueDate', 'desc');

            if ($request->filled('end_date')) {
                $query1->where('DocDate', '<=', $request->end_date);
            }
            $invoices1 = $query1->get();

            $query2 = OINV::with('payments', 'terms', 'manager', 'remark')
              ->where('DocNum', 18481)
              ->whereHas('warehouse', function($query) {
                  $query->where('WhsCode', 'VAT');
              })
              ->first();

            $invoices = $invoices1;

            if ($query2 && !$invoices1->contains('DocNum', 18481)) {
                $invoices->push($query2);
            }
                    }
        // 5/14/24 JunJihad Apply Date Between Start
       elseif ($request->company == "PBI") {
            $query = OINV_PBI::with('payments', 'terms', 'manager', 'remark')->where('CardCode', 'not like', 'LL-%')->where('DocStatus', 'O');

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('DocDate', [$request->start_date, $request->end_date]);
            }

            $invoices = $query->orderBy('DocDueDate', 'desc')->get();
        }

        elseif($request->company == "CCC")
        {
            // $invoices = OINV_CCC::with('payments','terms','manager', 'remark')->where('DocStatus', 'O')->orderBy('DocDueDate', 'desc')->get();
            $query = OINV_CCC::with('payments','terms','manager', 'remark')->where('DocStatus', 'O');
            
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('DocDate', [$request->start_date, $request->end_date]);
            }
            $invoices = $query->orderBy('DocDueDate', 'desc')->get();
        }
        
        // 5/14/24 JunJihad Apply Date Between End

        // dd($invoices->first());
        return view('whi-report.index',
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



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
        if($request->company == "WHI")
        {
            $last_invoices= OINV::where('DocNum',10338)->get();
            // dd($last_invoices);
            $invoices = OINV::whereDoesntHave('warehouse', function($query) {
                $query->where('WhsCode','TRI Whse');
              })
              ->with('payments','terms')->where('CardName','!=','Mariel Tan')->where('NumAtCard','!=','WHI20-312L CCC')->where('NumAtCard','!=','WHI20-280L CCC')->where('NumAtCard','!=','WHI20-281L CCC-Mandaue')->where('CardCode','not like','LR-%')->where('CardCode','not like','WTT-%')->where('DocStatus', 'O')->orderBy('DocDueDate', 'desc')->get();
            // dd($invoices->first());
        }
        elseif($request->company == "PBI")
        {
            $invoices = OINV_PBI::with('payments','terms')->where('CardCode','not like','LL-%')->where('DocStatus', 'O')->orderBy('DocDueDate', 'desc')->get();
        }
        elseif($request->company == "CCC")
        {
            $invoices = OINV_CCC::with('payments','terms')->where('DocStatus', 'O')->orderBy('DocDueDate', 'desc')->get();
        }
        
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

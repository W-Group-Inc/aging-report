<?php

namespace App\Http\Controllers;

use App\OINV;
use App\OINV_PBI;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request) {
        $invoices = [];
        if($request->company == "WHI")
        {
            $invoices = OINV::with('payments','terms')->where('DocStatus', 'O')->orderBy('DocDueDate', 'desc')->get();
        }
        elseif($request->company == "PBI")
        {
            $invoices = OINV_PBI::with('payments','terms')->where('DocStatus', 'O')->orderBy('DocDueDate', 'desc')->get();
        }
        
        // dd($invoices->first());
        return view('whi-report.index',
            array(
                'invoices' =>$invoices
            )
        ); 
    }
}

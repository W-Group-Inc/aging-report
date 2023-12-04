<?php

namespace App\Http\Controllers;

use App\OINV;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() {
        
        $invoices = OINV::with('payments','terms')->where('DocStatus', 'O')->orderBy('DocDueDate', 'desc')->get();
        // dd($invoices->first());
        return view('whi-report.index',
            array(
                'invoices' =>$invoices
            )
        ); 
    }
}

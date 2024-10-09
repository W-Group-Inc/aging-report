<?php

namespace App\Http\Controllers;

use App\INV1;
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
            ->where('DocStatus', 'O');
           

            if ($request->filled('end_date')) {
                $query1->where('DocDate', '<=', $request->end_date);
            }
            $invoices1 = $query1->get();

            $matchingDocEntries = INV1::select('DocEntry')
            ->whereIn('WhsCode', ['TRI Whse', 'VAT'])
            ->groupBy('DocEntry')
            ->havingRaw('COUNT(DISTINCT WhsCode) > 1 OR (COUNT(DISTINCT WhsCode) = 1 AND MAX(WhsCode) <> \'TRI Whse\')')
            ->get();

            $query2 = OINV::with('payments', 'terms', 'manager', 'remark')
            ->whereIn('DocEntry', $matchingDocEntries)
            ->where('DocStatus', 'O')
            ->get();

            // $invoices = $invoices1->sortBy('U_DueDateAR');

            $invoices = collect();
            foreach ($invoices1 as $invoice) {
                $invoices->push($invoice);
            }

            foreach ($query2 as $invoice) {
                if (!$invoices1->contains('DocNum', $invoice->DocNum)) {
                    $invoices->push($invoice);
                }
            }
            foreach ($last_invoices as $last_invoice) {
                if (!$invoices1->contains('DocNum', $last_invoice->DocNum)) {
                    $invoices->push($last_invoice);
                }
            }

            $invoices = $invoices->map(function ($invoice) use ($request) {
                $end_date = !empty($request->end_date) ? strtotime($request->end_date) : time();
                $due_date = !empty($invoice->U_DueDateAR) ? strtotime($invoice->U_DueDateAR) : null;
        
                if ($due_date !== null) {
                    $datediff = $end_date - $due_date;
                    $days_late = floor($datediff / (60 * 60 * 24)); 
                } else {
                    $days_late = null; 
                }
        
                $invoice->days_late = $days_late; 
                return $invoice;
            });
            $invoices = $invoices->sortByDesc('days_late')->values();
        }
        elseif($request->company == "Triangle Shipments") {
            $query1 = OINV::whereHas('warehouse', function($query) {
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
            ->where('DocStatus', 'O');
            // ->orderBy('U_DueDateAR', 'desc');

            if ($request->filled('end_date')) {
                $query1->where('DocDate', '<=', $request->end_date);
            }
            $invoices1 = $query1->get();

            $matchingDocEntries = INV1::select('DocEntry')
            ->whereIn('WhsCode', ['TRI Whse'])
            ->groupBy('DocEntry')
            ->havingRaw('COUNT(DISTINCT WhsCode) > 1 OR (COUNT(DISTINCT WhsCode) = 1 AND MAX(WhsCode) <> \'TRI Whse\')')
            ->get();

            $query2 = OINV::with('payments', 'terms', 'manager', 'remark')
            ->whereIn('DocEntry', $matchingDocEntries)
            ->where('DocStatus', 'O')
            ->get();

            $invoices = collect();
            foreach ($invoices1 as $invoice) {
                $invoices->push($invoice);
            }

            foreach ($query2 as $invoice) {
                if (!$invoices1->contains('DocNum', $invoice->DocNum)) {
                    $invoices->push($invoice);
                }
            }

            $invoices = $invoices->map(function ($invoice) use ($request) {
                $end_date = !empty($request->end_date) ? strtotime($request->end_date) : time();
                $due_date = !empty($invoice->U_DueDateAR) ? strtotime($invoice->U_DueDateAR) : null;
        
                if ($due_date !== null) {
                    $datediff = $end_date - $due_date;
                    $days_late = floor($datediff / (60 * 60 * 24)); 
                } else {
                    $days_late = null; 
                }
        
                $invoice->days_late = $days_late; 
                return $invoice;
            });
            $invoices = $invoices->sortByDesc('days_late')->values();
        }
        // 5/14/24 JunJihad Apply Date Between Start
       elseif ($request->company == "PBI") {
            $query = OINV_PBI::with('payments', 'terms', 'manager', 'remark')->where('CardCode', 'not like', 'LL-%')->where('DocStatus', 'O');

            if ($request->filled('end_date')) {
                $query->where('DocDate', '<=', $request->end_date);
            }

            
            $invoices = $query->get();

            $invoices = $invoices->map(function ($invoice) use ($request) {
                $end_date = !empty($request->end_date) ? strtotime($request->end_date) : time();
                $due_date = !empty($invoice->U_DueDateAR) ? strtotime($invoice->U_DueDateAR) : null;
        
                if ($due_date !== null) {
                    $datediff = $end_date - $due_date;
                    $days_late = floor($datediff / (60 * 60 * 24)); 
                } else {
                    $days_late = null; 
                }
        
                $invoice->days_late = $days_late; 
                return $invoice;
            });
            $invoices = $invoices->sortByDesc('days_late')->values();
        }

        elseif($request->company == "CCC")
        {
            // $invoices = OINV_CCC::with('payments','terms','manager', 'remark')->where('DocStatus', 'O')->orderBy('DocDueDate', 'desc')->get();
            $query = OINV_CCC::with('payments','terms','manager', 'remark')->where('DocStatus', 'O');
            
            if ($request->filled('end_date')) {
                $query->where('DocDate', '<=', $request->end_date);
            }
            $invoices = $query->get();

            $invoices = $invoices->map(function ($invoice) use ($request) {
                $end_date = !empty($request->end_date) ? strtotime($request->end_date) : time();
                $due_date = !empty($invoice->U_DueDateAR) ? strtotime($invoice->U_DueDateAR) : null;
        
                if ($due_date !== null) {
                    $datediff = $end_date - $due_date;
                    $days_late = floor($datediff / (60 * 60 * 24)); 
                } else {
                    $days_late = null; 
                }
        
                $invoice->days_late = $days_late; 
                return $invoice;
            });
            $invoices = $invoices->sortByDesc('days_late')->values();
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
                // 'matchingDocEntries' => $matchingDocEntries,
            )
        ); 
    }
}



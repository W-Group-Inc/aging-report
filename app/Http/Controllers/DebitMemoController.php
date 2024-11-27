<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\DebitMemo;
use App\DebitMemoItem;
use PDF;

use Illuminate\Http\Request;

class DebitMemoController extends Controller
{
    
    function index(Request $request) 
    {
        $details = DebitMemo::get();
        
        return view('print_templates.pbi.debit_memo.index', 
            array(
                'details' =>$details,
            )
        );
    }

    function pbi_save_debit_memo(Request $request) {
        $save_debit_memo = new DebitMemo();
        $save_debit_memo->debit_memo_no = $request->DebitNo; 
        $save_debit_memo->client = $request->Client; 
        $save_debit_memo->client_address = $request->ClientAddress; 
        $save_debit_memo->date = $request->debit_date; 
        $save_debit_memo->save();


        foreach ($request->Description as $index => $description) {
            $save_as_item = new DebitMemoItem(); 
            $save_as_item->demit_memo_id = $save_debit_memo->id; 
            $save_as_item->description = $description;
            $save_as_item->total = $request->Total[$index];
            $save_as_item->ListNo = $request->ListNo[$index];
            $save_as_item->Quantity = $request->Quantity[$index];
            $save_as_item->Unit = $request->Unit[$index];
            $save_as_item->UnitPrice = $request->UnitPrice[$index];
            $save_as_item->Currency = $request->Currency[$index];
            $save_as_item->save(); 
        }

        return redirect()->back()->with('success', 'Debit Memo saved successfully.');
    }

    function pbi_print_debit_memo(Request $request, $id){
        $customer_ref =$id;
            $details = DebitMemo::where('id', '=', $id)
            ->get();
            View::share('details', $details);
            
            $pdf = PDF::loadView('print_templates.pbi.debit_memo.bir_print', [
                array(
                    'details' =>$details,
                ),
            ])
            // ->setPaper([0, 0, 612, 396], 'portrait');
            ->setPaper('letter, portrait');
    
            return $pdf->stream('PBI_Debit_Memo.pdf');
    } 

    function edit_debit_memo(Request $request, $id) {
        $update_debit_memo = DebitMemo::find($id);
        $update_debit_memo->debit_memo_no = $request->DebitNo; 
        $update_debit_memo->client = $request->Client; 
        $update_debit_memo->client_address = $request->ClientAddress;
        $update_debit_memo->date = $request->debit_date;
        $update_debit_memo->update();

        foreach ($request->Description as $index => $description) {
            $bodyId = $request->bodyId[$index];

            if ($bodyId) {
                $edit_item = DebitMemoItem::find($bodyId);
            } else {
                $edit_item = new DebitMemoItem();
                $edit_item->CreditNoteId = $id;
            }
            $edit_item->description = $description;
            $edit_item->total = $request->Total[$index];
            $edit_item->ListNo = $request->ListNo[$index];
            $edit_item->Quantity = $request->Quantity[$index];
            $edit_item->Unit = $request->Unit[$index];
            $edit_item->UnitPrice = $request->UnitPrice[$index];
            $edit_item->Currency = $request->Currency[$index];
            $edit_item->save(); 
        }

        return redirect()->back()->with('success', 'Invoice saved successfully.');
    }
}

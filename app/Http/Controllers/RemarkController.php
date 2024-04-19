<?php

namespace App\Http\Controllers;
use App\Remark;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RemarkController extends Controller
{
    //
    public function store(Request $request) 
    {
        $request->validate([
            'docentry' => 'required|unique:remarks,docentry',
            'remarks' => 'required',
            'user_id' => 'required',
        ]);

        $new_remarks = new Remark;
        $new_remarks->docentry = $request->docentry;
        $new_remarks->remarks = $request->remarks;
        $new_remarks->user_id = $request->user_id;
        $new_remarks->save();

        Alert::success('Success Title', 'Success Message');
        return back();
    }
}

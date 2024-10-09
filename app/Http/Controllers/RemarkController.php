<?php

namespace App\Http\Controllers;

use App\Notification;
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

        $notificationMessage = $new_remarks->wasRecentlyCreated 
        ? 'Remark added for invoice #' . $new_remarks->docentry 
        : 'Remark updated for invoice #' . $new_remarks->docentry;

        $new_notification = new Notification;
        $new_notification->user_id = auth()->id();
        $new_notification->invoice_id = $new_remarks->docentry;
        $new_notification->action = "Add";
        $new_notification->remarks = $request->remarks;
        $new_notification->invoice_company = $request->invoice_company;
        $new_notification->save();

        // Alert::success('Success', 'Remarks Added Successfully');
        // return back();
        return response()->json([
            'success' => true,
            'docentry' => $new_remarks->docentry,
            'remarks' => $new_remarks->remarks,
            'remark_id' => $new_remarks->id,
            'created_at' => $new_remarks->created_at->format('M. d, Y g:i A'),
            'updated_at' => $new_remarks->updated_at->format('M. d, Y g:i A')
        ]);
    }

    public function update(Request $request, $id) 
    {
        $update_remarks = Remark::find($id);
        $update_remarks->remarks = $request->remarks;
        $update_remarks->user_id = auth()->id();
        $update_remarks->update();

        $new_notification = new Notification;
        $new_notification->user_id = auth()->id();
        $new_notification->invoice_id = $update_remarks->docentry;
        $new_notification->action = "Update";
        $new_notification->remarks = $request->remarks;
        $new_notification->invoice_company = $request->invoice_company;
        $new_notification->save();

        // Alert::success('Success Title', 'Success Message');
        // return back();
        return response()->json([
            'success' => true,
            'docentry' => $update_remarks->docentry,
            'remarks' => $update_remarks->remarks,
            'remark_id' => $update_remarks->id,
            'created_at' => $update_remarks->created_at->format('M. d, Y g:i A'),
            'updated_at' => $update_remarks->updated_at->format('M. d, Y g:i A')
        ]);
    }
}

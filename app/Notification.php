<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'notifications';

    public function notifInvoice()
    {
        return $this->belongsTo(OINV::class, 'invoice_id', 'DocNum');
    }
    public function notifInvoicePBI()
    {
        return $this->belongsTo(OINV_PBI::class, 'invoice_id', 'DocNum');
    }

    public function notifInvoiceCCC()
    {
        return $this->belongsTo(OINV_CCC::class, 'invoice_id', 'DocNum');
    }
    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

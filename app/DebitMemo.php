<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DebitMemo extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'debit_memos';

    public function DebitMemoBody()
    {
        return $this->hasMany(DebitMemoItem::class, 'demit_memo_id', 'id');
    }

}

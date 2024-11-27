<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model
{
    protected $connection = 'mysql';
    protected $table = 'credit_notes';

    public function CreditNoteHeader() 
    {
        return $this->hasOne(CreditNoteProductHeader::class, 'CreditNoteId', 'id');
    }
    public function CreditNoteBody()
    {
        return $this->hasMany(CreditNoteProduct::class, 'CreditNoteId', 'id');
    }
}

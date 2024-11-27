<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PbiCreditNote extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'pbi_credit_notes';

    public function PbiCreditNoteBody()
    {
        return $this->hasMany(PbiCreditNoteItem::class, 'credit_note_id', 'id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OCDR extends Model
{
    protected $table = 'OCRD';

    public function ocrg()
    {
        return $this->belongsTo(OCRG::class, 'GroupCode', 'GroupCode');
    }
}

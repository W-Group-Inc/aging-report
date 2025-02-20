<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class StatementOfAccount extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $connection = 'mysql';

    public function soaProduct()
    {
        return $this->hasMany(SoaProduct::class, 'DocNum', 'id');
    }
    public function auditHistory()
    {
        return $this->morphMany(\OwenIt\Auditing\Models\Audit::class, 'auditable');
    }
}

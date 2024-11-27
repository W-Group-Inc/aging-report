<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ORDR extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'ORDR';
}

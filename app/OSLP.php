<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OSLP extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'OSLP';
}

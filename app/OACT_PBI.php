<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OACT_PBI extends Model
{
    //
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'OACT';
}

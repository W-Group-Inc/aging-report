<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class INV_PBI extends Model
{
    //
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'INV6';
}

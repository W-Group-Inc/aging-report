<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CRD1_PBI extends Model
{
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'CRD1';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OSLP_PBI extends Model
{
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'OSLP';
    
}

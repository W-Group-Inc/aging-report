<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OCRD_PBI extends Model
{
    protected $connection = 'sqlsrv_pbi';
    protected $table = 'OCRD';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OCRD_CCC extends Model
{
    protected $connection = 'sqlsrv_ccc';
    protected $table = 'OCRD';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OHEM extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'OHEM';
}

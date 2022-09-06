<?php

namespace App\Models;

use App\Jobs\GoogleCalendarJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Cuentas extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $connection = "privada";
    // protected $table = "db_".Auth::user()->base_datos."cal_cuentas";

    function __construct(){
        // $this->table = "db_".Auth::user()->base_datos.".cal_cuentas";
        // $this->table = "db_cliente1_1.cal_cuentas";
        $this->table = "db_empresa1_1.cal_cuentas";
    }
}

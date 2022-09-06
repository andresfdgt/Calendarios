<?php

namespace App\Models;

use App\Jobs\GoogleEventsJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendarios extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = "privada";
    protected $table = "cal_calendarios";
    // protected $table = "db_cliente1_1.cal_calendarios";
}

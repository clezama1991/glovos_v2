<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BitacorasCron extends Model
{
   
    protected $table = 'bitacoras_cron';

    protected $fillable = [
		'fecha',
		'hora',
		'estatus',
		'nota'
    ];


}

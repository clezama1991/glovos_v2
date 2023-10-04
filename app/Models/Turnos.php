<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turnos extends Model
{
	
    use SoftDeletes;

    protected $table = 'turnos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'hora_inicio',
        'hora_fin',
    ];

}

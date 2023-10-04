<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfiguracionPlataforma extends Model
{
   
    protected $table = 'configuracion_global_plataforma';

    protected $fillable = [
		'key',
		'tipo',
		'nombre',
		'descripcion',
		'valor',
		'grupo',
		'visible'
    ];


}

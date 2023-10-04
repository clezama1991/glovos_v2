<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formularios extends Model
{
	
    use SoftDeletes;

    protected $table = 'formularios';

    protected $fillable = [
        'padre_id',
        'codigo',
        'nombre',
        'descripcion',
        'tipo',
        'valor',
    ];

    public function secciones_preguntas()
    {
        return $this->hasMany(Formularios::class, "padre_id", "id")->with(["secciones_preguntas"]);
    }

}

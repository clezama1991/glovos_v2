<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PilotosEntrenamientos extends Model
{
	
    use SoftDeletes;

    protected $table = 'pilotos_entrenamientos';

    protected $fillable = [
        'piloto_id',
        'globo_id',
        'formulario_id',
        'modelo_globo',
        'marca_globo',
        'matricula_globo',
        'fecha',
        'responsable',
        'resultados',
        'observaciones',
        'estatus',
        'entrenamiento',
        'fecha_aplicacion',
    ];

    
    
    protected $casts = [        
        'entrenamiento' => 'array',
    ];

    public function globo()
    {
        return $this->belongsTo(Globos::class, 'globo_id', 'id')->withTrashed();
    }
     
    public function formulario()
    {
        return $this->belongsTo(Formularios::class, 'formulario_id', 'id')->with(['secciones_preguntas'])->withTrashed();
    }
    


}

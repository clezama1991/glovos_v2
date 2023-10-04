<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluacionRiesgos extends Model
{
	
    use SoftDeletes;

    protected $table = 'evaluacion_riesgos';

    protected $fillable = [
        'comunicacion_id',
        'origen_metodo',
        'fecha',
        'descripcion',
        'naturaleza',
        'ri_probabilidad',
        'ri_severidad',
        'ri_valor1',
        'medidas_mitigacion',
        'rf_probabilidad',
        'rf_severidad',
        'rf_valor1',
        'fecha_efectividad',
        'fecha_implementacion',
        'fecha_seguimiento_control',
        'ref_documentacion',
        'notas',
        'responsable',
    ];

}

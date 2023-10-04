<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComunicacionRiesgos extends Model
{
	
    use SoftDeletes;

    protected $table = 'comunicacion_riesgos';

    protected $fillable = [
        'codigo',
        'fecha',
        'estado',
        'nombres_notificante',
        'url_firma_notificante',
        'cargo_responsabilidad_notificante',
        'descripción_suceso',
        'medidas_correctivas',
        'nombres_responsable',
        'url_firma_responsable',
        'url_documentos_sucesos',
        'notas',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionRiesgos::class, 'id', 'comunicacion_id');
    }
    
}

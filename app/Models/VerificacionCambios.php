<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerificacionCambios extends Model
{
	
    use SoftDeletes;

    protected $table = 'verificacion_cambios';

    protected $fillable = [
        'comunicacion_id',
        'fecha',
        'nro_informe',
        'nro_referencia',
        'validacion_efectuo_cambio',
        'validacion_impacto_se_mantiene',
        'validacion_comunicacion_cambio',
        'validacion_medida_mitigacion',
        'observaciones',
        'verificado_responsable',
        'verificado_cargo_responsable',
        'fecha_rev_2',
        'nro_informe_rev_2',
        'nro_referencia_rev_2',
        'validacion_efectuo_cambio_rev_2',
        'validacion_impacto_se_mantiene_rev_2',
        'validacion_comunicacion_cambio_rev_2',
        'validacion_medida_mitigacion_rev_2',
        'observaciones_rev_2',
        'verificado_responsable_rev_2',
        'verificado_cargo_responsable_rev_2',
        'notas',
    ];

}

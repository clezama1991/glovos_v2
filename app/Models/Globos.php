<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Globos extends Model
{
	
    use SoftDeletes;

    protected $table = 'globos';

    protected $fillable = [
        'nombre',
        'matricula',
        'logo',
        'fabricante',
        'modelo',
        'mtom',
        'min_mtom',
        'arc',
        'arc_doc',
        'cert_matricula',
        'seguro',
        'peso_cesta',
        'peso_globo',
        'peso_botellas',
        'peso_quemador',
        'notas',
        'activo',
        'horas_iniciales',
        'hora_finales',
        'habilitacion_nivel',
        'certiricado_aeronavegabilidad_doc',
        'modelo_id',
        'bottom_end_id',
        'hora_total_vuelo',
        'volumen',
    ];

    public function getDuracionVueloAttribute($value)
    {
        $value_validate = explode(':',$value);
        if(count($value_validate)>1){
            if(isset($value_validate[2])){
                return substr_replace($value,"",-3);
            }
        }
        return $value;
    }

    public function peso_globo()
    {
        $peso_cesta = ($this->peso_cesta)?$this->peso_cesta:0;
        $peso_globo = ($this->peso_globo)?$this->peso_globo:0;
        $peso_botellas = ($this->peso_botellas)?$this->peso_botellas+10:0;
        $peso_quemador = ($this->peso_quemador)?$this->peso_quemador:0; 

        return $peso_cesta + $peso_globo + $peso_botellas+ $peso_quemador;
    }
    
    public function modeloGlobo()
    { 
        return $this->belongsTo(TablaCarga::class, 'modelo_id', 'id')->withTrashed();
    }
    
    public function bottom_end()
    { 
        return $this->belongsTo(GloboBottomEnd::class, 'bottom_end_id', 'id')->withTrashed();
    }

}

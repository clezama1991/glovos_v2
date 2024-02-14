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
        'x_cuadriculas',
        'y_cuadriculas',
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

    public function cuadriculas()
    { 
        return $this->hasMany(GloboCuadricula::class, 'globo_id', 'id'); 
    }

    public function mapa_cuadricula()
    { 
        $matriz = [];

        foreach ($this->cuadriculas as $key => $cuadricula) {
            $x = $cuadricula['x'];
            if(!in_array($x, $matriz)){
                $matriz[$x] = [] ;
            }
        }     

        foreach ($this->cuadriculas as $key => $cuadricula) {
            $x = $cuadricula['x'];
            $y = $cuadricula['y'];            

            $diferido = GloboDiferidos::where('globo_cuadricula_id',$cuadricula->id)->first();

            $matriz[$x][] = [
                'title'=> $cuadricula->title, 
                'id'=>$cuadricula->id, 
                'fondo'=>$cuadricula->fondo,
                'diferido'=>$diferido ? 1 : 0,
                'detalle'=>($diferido->detalle ?? null).'<img src="'.($diferido->adjunto1 ?? null).'" class="img-fluid mt-5">',
                'rows_reverse'=>$cuadricula->rows_reverse(),
            ];                
        }     

        return $matriz;
    }

}

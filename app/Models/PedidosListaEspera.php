<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class PedidosListaEspera extends Model
{
	
    use SoftDeletes;
 
    protected $table = 'pedidos_lista_espera';

    protected $fillable = [
        'pedido_id',
        'zonas_id',
        'dias',
        'fecha_inicio_disp',
        'fecha_fin_disp',
        'fecha_inicio_nodisp',
        'fecha_fin_nodisp',
    ];
 
    protected $casts = [
        'zonas_id' => 'array',
        'dias' => 'array',
    ];
 
    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'pedido_id', 'id')->withTrashed();
    }
    
    public function zonas(){
        $data = [];        
        if(!is_null($this->zonas_id)){
            $data = Zones::whereIn('id',$this->zonas_id)->get();
        }
        return $data;
    }
}

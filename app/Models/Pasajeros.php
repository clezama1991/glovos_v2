<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasajeros extends Model
{
	
    use SoftDeletes;

    protected $table = 'pasajeros';

    protected $fillable = [
        'nombres',
        'apellidos',
        'dni',
        'telefono',
        'email',
        'notas',
        'peso',
        'activo',
    ];

    
    public function datoscompletos()
    {
        return (!is_null($this->nombres) && !is_null($this->apellidos) && !is_null($this->peso))?true:false;
    }

    public function routeNotificationForWhatsApp()
    {
      return $this->phone_number;
    }
 
    
    public function nro_pedidos()
    {
        // $nro = '';
        // $pedido_pasajero = $this->belongsTo(PedidosPasajeros::class, 'id', 'pasajero_id');
        // if($pedido_pasajero){
        //     $nro = ($pedido_pasajero->pedido)?$pedido_pasajero->pedido->orden_wordpress:'';
        // }

        return $this->belongsTo(PedidosPasajeros::class, 'id', 'pasajero_id')->withTrashed();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidosPasajeros extends Model
{
	
    use SoftDeletes;

    protected $table = 'pedidos_pasajeros';

    protected $fillable = [
        'pedido_id',
        'pasajero_id'
    ];

    
    public function pasajero()
    {
        return $this->belongsTo(Pasajeros::class, 'pasajero_id', 'id')->withTrashed();
    }
    
    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'pedido_id', 'id')->withTrashed();
    }
    

}

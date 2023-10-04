<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PedidosMovimientos extends Model
{
	
    use SoftDeletes;
    use Notifiable;

    protected $table = 'pedidos_movimientos';

    protected $fillable = [
        'pedido_id',
        'vuelo_id',
        'fecha',
        'observacion'
    ];
  
    
    public function vuelo()
    {
        return $this->belongsTo(Vuelos::class, 'vuelo_id', 'id')->withTrashed();
    }
    
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id', 'id')->withTrashed();
    }
    
}

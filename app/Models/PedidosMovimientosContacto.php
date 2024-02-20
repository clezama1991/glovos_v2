<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PedidosMovimientosContacto extends Model
{
	
    use SoftDeletes;
    use Notifiable;

    protected $table = 'pedidos_movimientos_contacto';

    protected $fillable = [
        'pedido_id',
        'fecha', 
        'observacion'
    ];
   
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id', 'id')->withTrashed();
    }
    
}

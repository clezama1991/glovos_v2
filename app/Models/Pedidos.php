<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Pedidos extends Model
{
	
    use SoftDeletes;
    use Notifiable;

    protected $table = 'pedidos';

    protected $fillable = [
        'reembolso',
        'orden_wordpress',
        'parent_id',
        'numpax',
        'numpax_wordpress',
        'hanvolado',
        'vuelo_id',
        'peso_extra',
        'nombre_contacto',
        'ciudad_contacto',
        'email_contacto',
        'telefono_contacto',
        'lenguaje_contacto',
        'estatus',
        'notas',
        'token',
        'multimedia_download_pedidos',
        'multimedia_notification',
        'agrupacion',
        'privado',
        'origen',
        'sinc_google_contacts',
    ];

    protected $appends = ['pasajeros','estatus_pedido','vuelo_name','estatus_agrupacion'];

    protected $casts = [
        'agrupacion' => 'array',
    ];

    public function routeNotificationForWhatsApp()
    {
      return $this->telefono_contacto;
    }
 
    
    public function movimientos()
    {
        return $this->hasMany(PedidosMovimientos::class, 'pedido_id', 'id');
    }

    public function agrupaciones()
    {
        return $this->hasMany(Pedidos::class, 'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Pedidos::class, 'parent_id', 'id')->withTrashed();
    }
    
    public function getestatusAgrupacionAttribute()
    {
        return count($this->agrupaciones)>0 ? 'PADRE' : (!is_null($this->parent_id) ? 'HIJO' : 'NINGUNA');
    }

    public function PedidosPasajeros()
    {
        return $this->hasMany(PedidosPasajeros::class, 'pedido_id', 'id');
    }

    public function getPasajerosAttribute()
    {   
        $pasajeros = [];
        foreach ($this->PedidosPasajeros as $pasajero) {
            $pasajeros[] = $pasajero->pasajero;
        }
        return $pasajeros; 
    }
    
    public function vuelo()
    {
        return $this->belongsTo(Vuelos::class, 'vuelo_id', 'id')->withTrashed();
    }
    
    public function getEstatusPedidoAttribute()
    {
        $estatus  = 'Pendiente';
        $total_registrado = count($this->PedidosPasajeros);
        $total_pasajeros =  $this->numpax;

        if($total_registrado == $total_pasajeros){                    
            $estatus  = 'Completado';
        }else if($total_registrado>0){    
            $estatus  = 'Incompleto';
        }

        return $estatus;
    }
    
    public function getVueloNameAttribute()
    {
        return ($this->vuelo) ? $this->vuelo->only_name_vuelo() : '';
    }

    
    public function lista_espera()
    {
        return $this->belongsTo(PedidosListaEspera::class, 'id', 'pedido_id');
    }
}

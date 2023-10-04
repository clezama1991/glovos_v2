<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservasExternas extends Model
{
    use SoftDeletes;
    
    protected $table = 'reservas_externas';

    protected $fillable = [
        'pedido_id',
        'orden_wordpress',
        'nombre_contacto',
        'email_contacto',
        'telefono_contacto',
        'privado',
        'numpax',
        'fecha_reserva',
        'zona',
        'zona_id',
        'url_cupon',
        'notas',
        'estatus',
        'cerrado',
    ];


    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'pedido_id', 'id')->withTrashed();
    }

    public function zone()
    {
        return $this->belongsTo(Zones::class, 'zona_id', 'id')->withTrashed();
    }
    
    public function id_vuelo()
    {
        return $this->pedido->vuelo->id ?? null;
    }
    
    public function movimientos()
    {
        return $this->hasMany(ReservasExternasBitacora::class, 'reserva_externa_id','id')->orderBy('id','DESC');
    }

    public function cambios_fecha()
    {
        return $this->hasMany(ReservasExternasCambioFechas::class, 'reserva_externa_id','id')->with('zonas')->orderBy('id','DESC');
    }

    
    public function ultimo_comentario($estatus = null)
    {
        $bitatora = $this->movimientos;
        if(!is_null($estatus)){
            $bitatora = $bitatora->where('estatus',$estatus);
        }
        return $bitatora->last();
    }

    public function aceptada_por_cliente()
    {
        return $this->cambios_fecha->where('aceptada_admin',true)->where('aceptada_user',true)->first();
    }

    public function propuesta_por_cliente()
    {
        return $this->cambios_fecha->where('aceptada_admin',false)->where('aceptada_user',true)->first();
    }
 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservasExternasCambioFechas extends Model
{
    protected $table = 'reservas_externas_cambio_fechas';

    protected $fillable = [
        'reserva_externa_id', 
        'fecha', 
        'zona', 
        'aceptada_admin', 
        'aceptada_user',
        'observacion',
    ];
    
    public function zonas()
    {
        return $this->belongsTo(Zones::class, 'zona', 'id')->withTrashed();
    }
    
    public function reserva()
    {
        return $this->belongsTo(ReservasExternas::class, 'reserva_externa_id', 'id')->withTrashed();
    }

}

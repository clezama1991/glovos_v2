<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsistentesDisponibilidad extends Model
{
	
    protected $table = 'asistentes_disponibilidad';

    protected $fillable = [
        'asistente_id',
        'turno_id',
        'fecha'
    ];

    public function asistente()
    {
        return $this->belongsTo(Asistentes::class, 'asistente_id', 'id')->withTrashed();
    }

    public function turno()
    {
        return $this->belongsTo(Turnos::class, 'turno_id', 'id')->withTrashed();
    }
    
}

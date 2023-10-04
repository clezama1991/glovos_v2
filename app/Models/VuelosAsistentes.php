<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VuelosAsistentes extends Model
{

    protected $table = 'vuelos_asistentes';

    protected $fillable = [
        'vuelo_id',
        'asistente_id',
        'fecha'
    ];

    public function vuelo()
    {
        return $this->belongsTo(Vuelos::class, 'vuelo_id', 'id')->withTrashed();
    }

    public function asistente()
    {
        return $this->belongsTo(Asistentes::class, 'asistente_id', 'id')->withTrashed();
    }
    
}

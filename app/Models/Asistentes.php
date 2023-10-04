<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asistentes extends Model
{
	
    use SoftDeletes;

    protected $table = 'asistentes';


    protected $fillable = [
        'dni',
        'nombre_corto',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'pin',
        'activo',
        'notas',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
    
    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->nombres . ' ' . $this->apellidos;
    }
    
    public function calendario_disponible()
    {
        return $this->hasMany(AsistentesDisponibilidad::class, 'asistente_id', 'id')->with('turno'); 
    }
}

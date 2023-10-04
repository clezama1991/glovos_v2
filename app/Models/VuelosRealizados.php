<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VuelosRealizados extends Model
{
	
    use SoftDeletes;

    protected $table = 'vuelos_realizados';
        
    protected $fillable = [
        'zona',
        'piloto',
        'globo',
        'vuelo',
        'pedido',
        'pasajeros',
    ];

    protected $casts = [        
        'zona' => 'array',
        'piloto' => 'array',
        'globo' => 'array',
        'vuelo' => 'array',
        'pedido' => 'array',
        'pasajeros' => 'array'
    ];

}

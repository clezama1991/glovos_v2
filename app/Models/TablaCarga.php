<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TablaCarga extends Model
{
	
    use SoftDeletes;

    protected $table = 'tabla_carga';

    protected $fillable = [
        'modelo_globo',
        'fabricante',
        'mtom',
        'min_mtom',
        'fift_inits_10',
        'fift_inits_11',
        'fift_inits_12',
        'fift_inits_13',
        'fift_inits_14',
        'fift_inits_15',
        'fift_inits_16',
        'fift_inits_17',
        'fift_inits_18',
        'fift_inits_19',
        'fift_inits_20',
        'fift_inits_21',
        'fift_inits_22',
        'fift_inits_23',
        'tabla'
    ];

}

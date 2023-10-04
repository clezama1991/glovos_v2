<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
	
    use SoftDeletes;

    protected $table = 'checklist';

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'activo',
        'orden',
    ];

}

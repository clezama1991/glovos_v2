<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Multimedias extends Model
{
	  
    protected $table = 'multimedias';

    protected $fillable = [
        'vuelo_id',
        'nombre',
        'carpeta',
        'fecha',
        'extension',
    ];
  
}
 
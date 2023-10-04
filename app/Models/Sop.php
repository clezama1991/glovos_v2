<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop extends Model
{
	
    use SoftDeletes;

    protected $table = 'sop';

    protected $fillable = [
        'codigo',
        'fecha',
        'nombre',
        'name_file',
        'url_file',
        'notas'
    ];

}

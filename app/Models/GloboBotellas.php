<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class GloboBotellas extends Model
{
    use SoftDeletes;

    protected $table = 'globo_botellas';

    protected $appends = ['_rowVariant','modelo_name'];

    protected $fillable = [
        'codigo',
        'fabricante',
        'modelo',
        'peso',
        'capacidad',
        'nro_serie',
        'PVR',
        'CRS',
        'observaciones',
        'estatus',
        'variant',
    ];

    public function getModeloNameAttribute()
    {
        return $this->modelo.' '. $this->estatus;
    }

    public function getRowVariantAttribute()
    {
        return $this->variant;    
    } 
 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class GloboQuemadores extends Model
{
    use SoftDeletes;

    protected $table = 'globo_quemadores';

    protected $appends = ['_rowVariant','modelo_name'];

    protected $fillable = [
        'codigo',
        'fabricante',
        'modelo',
        'peso',
        'nro_serie',
        'CRS',
        'fecha_mangueras',
        'observaciones',
    ];

    public function getModeloNameAttribute()
    {
        // $model = $this->modelo;
        $mod = $this->modelo.' '. ((!is_null($this->getRowVariantAttribute())) ? '(Vencido)' : '');
       return $mod;
    }

    public function getRowVariantAttribute()
    {
        $date = date('Y-m-d'); 
        $ago_1_years = Carbon::create($date)->subYears(1);
        
        $validacion = null;

        if(Carbon::parse($this->CRS) < $ago_1_years){
            $validacion = 'danger';
        } 
        
        return $validacion;    
    }

}

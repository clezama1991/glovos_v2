<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Globos;

class GloboBottomEnd extends Model
{
    use SoftDeletes;

    protected $table = 'globo_bottom_ends';

    protected $appends = ['_rowVariant','peso_botellas'];

    protected $fillable = [
        'nombre',
        'bottom_end',
        'compatibilidad_globos_ids',
        'cesta_id',
        'quemador_id',
        'botella_id',
    ];

    protected $casts = [        
        'compatibilidad_globos_ids' => 'array',
        'botella_id' => 'array'
    ];

    
    public function globos(){
        $data = [];        
        if(!is_null($this->compatibilidad_globos_ids)){
            $data = Globos::whereIn('id',$this->compatibilidad_globos_ids)->get();
        }
        return $data;
    }

    public function botellas_pivot()
    {
        return $this->hasMany(GloboBottomEndBotellas::class, "id", "bottom_end_id");
    }
 
    public function cesta()
    {
        return $this->belongsTo(GloboCestas::class, 'cesta_id', 'id')->withTrashed();
    }

    public function quemador()
    {
        return $this->belongsTo(GloboQuemadores::class, 'quemador_id', 'id')->withTrashed();
    }

    public function botella_old()
    {
        return $this->belongsTo(GloboBotellas::class, 'botella_id', 'id')->withTrashed();
    }
    

    public function botellas_d(){
        $data = [];        
        if(!is_null($this->botella_id)){
            $data = GloboBotellas::whereIn('id',$this->botella_id)->get();
        }
        return $data;
    }

    public function botellas_rowVariant(){
        $result = false;        
        if(!is_null($this->botella_id)){
            $data = GloboBotellas::whereIn('id',$this->botella_id)->get();
            foreach ($data as $key => $value) {
                if($value->_rowVariant){
                    $result = true;  
                }
            }
        }
        return $result;
    }

    public function bottom_old()
    {
        return $this->belongsTo(GloboBotellas::class, 'botella_id', 'id')->withTrashed();
    }

    public function getRowVariantAttribute()
    {
        $validacion = null;

        if($this->cesta->_rowVariant || $this->botellas_rowVariant() || $this->quemador->_rowVariant){
            $validacion = 'danger';
        } 
        
        return $validacion;    
    }

    public function getPesoBotellasAttribute()
    {   
        $suma_peso = 0;
        foreach ($this->botellas as $key => $value) {
            $suma_peso += $value->peso;
        }
        return $suma_peso;    
    }

}

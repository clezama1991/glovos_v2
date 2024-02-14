<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class GloboCuadricula extends Model
{
    
    protected $table = 'globo_cuadricula';
 
    protected $appends = ['title'];

    protected $fillable = [
        'globo_id',
        'x',
        'y',
        'fondo'
    ];

    public function globo()
    {
        return $this->belongsTo(Globos::class, 'globo_id', 'id')->withTrashed();
    }
    
    public function diferidos()
    {
        return $this->hasMany(Pedidos::class, 'id','globo_cuadricula_id');
    }
 
    public function rows_reverse()
    {
        $abc = [];
        $limit = $this->globo->x_cuadriculas;
        $rows = 1;
        for($i=65; $i<=90; $i++) {  
            if($rows<=$limit){
                $letra = chr($i);  
                $abc[$rows] = $letra;
            }
            $rows++;
        } 
          
        return array_reverse($abc);
 
    }
 
    public function getTitleAttribute()
    {
        $rows_reverse = $this->rows_reverse();
        return $rows_reverse[$this->x-1].$this->y;
    }
 
 
}

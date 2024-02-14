<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class GloboDiferidos extends Model
{

    protected $table = 'globo_diferido';
 
    protected $appends = ['fondo'];

    protected $fillable = [
        'globo_cuadricula_id', 
        'creado_por', 
        'detalle', 
        'adjunto1', 
        'adjunto2', 
        'adjunto3', 
        'adjunto4', 
        'adjunto5', 
        'gravedad', 
        'solucionado', 
        'solucionado_por', 
        'solucionado_detalle', 
        'solucionadoadjunto1', 
        'solucionadoadjunto2', 
        'solucionadoadjunto3', 
        'solucionadoadjunto4', 
        'solucionadoadjunto5', 
    ];

    public function globo_cuadricula()
    {
        return $this->belongsTo(GloboCuadricula::class, 'globo_cuadricula_id', 'id');
    }
    
    public function user_solucionado_por()
    {
        return $this->belongsTo(User::class, 'solucionado_por', 'id')->withTrashed();
    }
    
    public function getFondoAttribute()
    {


        $fondo = null;

        switch ($this->gravedad) {
            case 'Visual':
                $fondo = '1';
                break;                    
            case 'Leve':
                $fondo = '2 ';
                break;                    
            case 'Grave':
                $fondo = '3 ';
                break;                    
            default:
                # code...
                break;
        }

        return $fondo;
    }
    
}

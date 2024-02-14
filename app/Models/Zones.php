<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zones extends Model
{
	
    use SoftDeletes;

    protected $table = 'zones';

    protected $appends = ['mensaje_personalizado','altura_despegue'];

    protected $fillable = [
        'nombre',
        'nombre_corto',
        'color',
        'color_text',
        'nombre_despegue_1',
        'url_despegue_1',
        'msg_despegue_1',
        'altura_despegue_1',
        'nombre_despegue_2',
        'url_despegue_2',   
        'msg_despegue_2',     
        'altura_despegue_2',     
        'nombre_despegue_3',
        'url_despegue_3',
        'msg_despegue_3',
        'altura_despegue_3',
        'nombre_despegue_4',
        'url_despegue_4',
        'msg_despegue_4',
        'altura_despegue_4',
        'nombre_despegue_5',
        'url_despegue_5',
        'msg_despegue_5',
        'altura_despegue_5',
        'despegue_whatsapp',
        'logo',
        'aerop_cercano',
        'frecuencia',
        'notas',
        'mensaje_personalizado',
        'activo',
        'altura_despegue_global',
        'meteoblue_url',
        'meteoblue_donwload',
        'mensaje_cancelacion_1',
        'mensaje_cancelacion_2',
        'mensaje_cancelacion_3',
        'icao',
    ];

    public function zonas_despegues()
    {   
        $despegues = [];
        if(!is_null($this->nombre_despegue_1)){
            $despegues[] = [
                'id' => 1,
                'nombre' => $this->nombre_despegue_1,
            ];
        }
        if(!is_null($this->nombre_despegue_2)){
            $despegues[] = [
                'id' => 2,
                'nombre' => $this->nombre_despegue_2,
            ];
        }
        if(!is_null($this->nombre_despegue_3)){
            $despegues[] = [
                'id' => 3,
                'nombre' => $this->nombre_despegue_3,
            ];
        }
        if(!is_null($this->nombre_despegue_4)){
            $despegues[] = [
                'id' => 4,
                'nombre' => $this->nombre_despegue_4,
            ];
        }
        if(!is_null($this->nombre_despegue_5)){
            $despegues[] = [
                'id' => 5,
                'nombre' => $this->nombre_despegue_5,
            ];
        } 
        return $despegues;
    }

    public function mensajes_cancelacion()
    {   
        $mensajes = [];

        $mensajes[] = [
            'id' => 1,
            'mensaje' => $this->mensaje_cancelacion_1,
        ];
        
        $mensajes[] = [
            'id' => 2,
            'mensaje' => $this->mensaje_cancelacion_2,
        ];
        
        $mensajes[] = [
            'id' => 3,
            'mensaje' => $this->mensaje_cancelacion_3,
        ];
        
        return $mensajes; 
    }


    public function getMensajePersonalizadoAttribute()
    {   

        $despegue_whatsapp = $this->despegue_whatsapp;

        $msg = 'msg_despegue_'.$despegue_whatsapp;

        return $this->$msg;

    }
    
    public function getAlturaDespegueAttribute()
    {   

        $despegue_whatsapp = $this->despegue_whatsapp;

        $altura = 'altura_despegue_'.$despegue_whatsapp;
 
        return (is_null($this->$altura)) ? $this->altura_despegue_global : $this->$altura;

    }
}

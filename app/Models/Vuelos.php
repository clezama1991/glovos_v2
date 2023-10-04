<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ConfiguracionPlataforma;
use App\Models\Pedidos;
use Carbon\Carbon;
class Vuelos extends Model
{
	
    use SoftDeletes;

    protected $table = 'vuelos';

    protected $appends = ['name','turno'];

    protected $fillable = [
        'zona_id',
        'piloto_id',
        'globo_id',
        'fecha',
        'duracion_estimada',
        'hora',
        'peso_total',
        'temperatura',
        'parte_mateo',
        'tabla_carga',
        'carga_total',
        'gas',
        'notas',
        'activo',
        'estatus',
        'fecha_despegue',
        'hora_despegue',
        'hora_aterrizaje',
        'duracion_vuelo',
        'lugar_despegue',
        'lugar_aterrizaje',
        'cautivo',
        'reserva',
        'tabla_carga_maxima',
        'carga_maxima',
        'multimedia',
        'multimedia_caduca',
        'multimedia_archivos_borrados',
        'multimedia_download_pedidos',
        'multimedia_notification_pedidos',
        'horas_inicial_globo',
        'horas_final_globo',
        'tipo_nubosidad_id',
        'zona_despegue',
        'altura_maxima',
        'viento',
        'notas_cancelacion',
        'meteoblue_donwload',
        'pin',
        'sincronizado_woocommerce',
        'amanecer',
        'anochecer',
        'mediodia',
        'orto',
        'ocaso',
        'qnh',
        'total_peso_disponible',
    ];

    
    protected $casts = [        
        'multimedia_download_pedidos' => 'array'
    ];

    public function getHorasInicialGloboAttribute($value)
    {
        $value_validate = explode(':',$value);
        if(count($value_validate)>1){
            if(isset($value_validate[2])){
                return substr_replace($value,"",-3);
            }
        }
        return $value;
    }

    public function getHoraAttribute($value)
    {
        $value_validate = explode(':',$value);
        if(count($value_validate)>1){
            if(isset($value_validate[2])){
                return substr_replace($value,"",-3);
            }
        }
        return $value;
    }

    public function getHorasFinalGloboAttribute($value)
    {
        $value_validate = explode(':',$value);
        if(count($value_validate)>1){
            if(isset($value_validate[2])){
                return substr_replace($value,"",-3);
            }
        }
        return $value;
    }

    public function getHoraDespegueAttribute($value)
    {
        $value_validate = explode(':',$value);
        if(count($value_validate)>1){
            if(isset($value_validate[2])){
                return substr_replace($value,"",-3);
            }
        }
        return $value;
    }

    public function getHoraAterrizajeAttribute($value)
    {
        $value_validate = explode(':',$value);
        if(count($value_validate)>1){
            if(isset($value_validate[2])){
                return substr_replace($value,"",-3);
            }
        }
        return $value;
    }

    public function getDuracionVueloAttribute($value)
    {
        $value_validate = explode(':',$value);
        if(count($value_validate)>1){
            if(isset($value_validate[2])){
                return substr_replace($value,"",-3);
            }
        }
        return $value;
    }

    public function estado_multimedia()
    {   
        $estado = '';
        $fechas_caducadas = false;
        $pedidos_descargas = (!is_null($this->multimedia_download_pedidos))?count ($this->multimedia_download_pedidos) : 0;;
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date); 
        if($this->multimedia_caduca!=null && $real_now > Carbon::parse($this->multimedia_caduca)){
            $fechas_caducadas = true; 
        } 
        
        if(count($this->multimedias) == 0){
            $estado = 'No se ha registrado Multimedias';
        }else{
 
            if(!$this->multimedia){
                $estado = 'Multimedia No Habilitado';
            }else{ 
                if ($this->cantidad_pedidos()>0 && $this->cantidad_pedidos() == $pedidos_descargas) {
                    // $estado = 'Multimedia Descargado';
                    $estado = 'Multimedia Disponible';
                } else {
                    if($fechas_caducadas){
                        $estado = 'Multimedia Caducado';
                    }else{
                        $estado = 'Multimedia Disponible';
                    } 
                }
            } 
        }
        return $estado;
     }
 

    public function getNameAttribute()
    {
        
        $date = date_format( date_create($this->fecha) ,"d-m-Y");
        $zonas = ($this->zona)?$this->zona->nombre:'Sin Zona'; 

        return $date.' / '.$zonas;
 
    }
    
    public function getTurnoAttribute()    
    {
        
        return date_format( date_create($this->fecha.''.$this->hora) ,"A");      
 
    }
    public function only_name_vuelo()
    {
        
        $date = date_format( date_create($this->fecha) ,"d-m-Y");
        $zonas = ($this->zona)?$this->zona->nombre:'Sin Zona'; 

        return $date.' / '.$zonas;
 
    }

    public function name_vuelo()
    {
        setlocale(LC_TIME,"es_ES");

        $diassemanaN = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

        $numpax = 0;
        
        foreach ($this->Pedidos as $pedido) {    
            $numpax += $pedido->numpax;         
        }

        $date = date_format( date_create($this->fecha) ,"d-m-Y");
        $dia = date_format( date_create($this->fecha) ,"w");
        $zonas = ($this->zona)?$this->zona->nombre:'Sin Zona'; 

        return $date.' '.$diassemanaN[$dia].' / '.$zonas.' / '.$numpax;
 
    }
    
    
    public function cantidad_pedidos()
    {
        $numpax = 0;
        
        foreach ($this->Pedidos as $pedido) {    
            $numpax += 1;         
        }

        return $numpax;
 
    }

    public function cantidad_pasajeros()
    {
        $numpax = 0;
        
        foreach ($this->Pedidos as $pedido) {    
            $numpax += $pedido->numpax;         
        }

        if($this->estatus =='Cancelado'){
            $numpax = $this->PedidosVuelosCancelado();
        }

        return $numpax;
 
    }
    
    public function cantidad_pasajeros_registrados()
    {   
        $numpax = 0;
        foreach ($this->Pedidos as $key => $Pedido) {

            foreach ($Pedido->PedidosPasajeros as $pasajero) {
                $numpax += 1;         
            }
        }
        return $numpax; 
    }

    
    public function zona()
    {
        return $this->belongsTo(Zones::class, 'zona_id', 'id')->withTrashed();
    }
    
    public function piloto()
    {
        return $this->belongsTo(Pilotos::class, 'piloto_id', 'id')->withTrashed();
    }
    
    public function globo()
    {
        return $this->belongsTo(Globos::class, 'globo_id', 'id')->withTrashed();
    }
    
    public function TipoNubosidad()
    {
        return $this->belongsTo(TipoNubosidad::class, 'tipo_nubosidad_id', 'id')->withTrashed();
    }

    public function total_peso_globo()
    {
        return ($this->globo)?$this->globo->peso_globo():0;
    }

    public function total_peso_pasajeros()
    {
        $peso_pasajeros = 0;
        foreach ($this->Pedidos as $pedido) { 
            $peso_extra = ($pedido->peso_extra)?7:0; 
            foreach ($pedido->PedidosPasajeros as $PedidosPasajero) {
                $peso_pasajeros += $PedidosPasajero->pasajero->peso + $peso_extra;
            } 
        }

        return $peso_pasajeros;
    }

    public function total_peso_gas()
    {
        
        return ($this->gas??0) + ($this->reserva??0);

    }

    public function total_carga_actual()
    {
        
        return $this->total_peso_pasajeros() + $this->total_peso_globo() + $this->total_peso_gas();

    }

    public function total_peso_disponible_calc()
    {
        
        return $this->carga_maxima - $this->total_carga_actual();

    }

    public function Pedidos()
    {
        return $this->hasMany(Pedidos::class, 'vuelo_id', 'id'); 
    }

    public function multimedias()
    {
        return $this->hasMany(Multimedias::class, 'vuelo_id', 'id'); 
    }

    public function pasajeros()
    {   
        $pasajeros = [];
        foreach ($this->Pedidos as $key => $Pedido) {
            $peso_extra = ($Pedido->peso_extra)?7:0; 

            foreach ($Pedido->PedidosPasajeros as $pasajero) {
                $pasajero->pasajero->peso_final = $pasajero->pasajero->peso + $peso_extra;
                $pasajeros[] = $pasajero->pasajero;
            }
        }
        return $pasajeros; 
    }

    public function pedidos_pasajeros()
    {   
        $pasajeros = [];
        foreach ($this->Pedidos as $key => $Pedido) {

            foreach ($Pedido->PedidosPasajeros as $pasajero) {
                $pasajeros[] = $pasajero;
            }
        }
        return $pasajeros; 
    }

    public function IsExclisivo()
    {
     
        if(count($this->Pedidos)==0){
            return 'libre';
        }

        foreach ($this->Pedidos as $pedido) { 
            if($pedido->privado){
                return 'exclusivo';
            }
        }
        
        return 'general';
    }

    public function nombre_zona_despegue()
    {
        $zona_des = [
            'nombre' => 'Sin Zona de Despegue',
            'url' => null,
        ]; 

        if(!is_null($this->zona_despegue)){
            $nombre = 'nombre_despegue_'.$this->zona_despegue;
            $url = 'url_despegue_'.$this->zona_despegue;
            $zona_des = [
                'nombre' => ($this->zona)?$this->zona->{$nombre}:'Sin Zona',
                'url' => ($this->zona)?$this->zona->{$url}:'null',  
            ]; 
        }

        return $zona_des;
 
    }


    public function PedidosVuelosCancelado()
    {

        $numpax = 0;
        $vuelo = $this->dataVueloCancelado();

        foreach ($vuelo['pedido'] as $key => $pedido) {
            $numpax += $pedido['numpax'];           
        }

        return $numpax;

    }

    public function dataVueloCancelado()
    {
        if($this->estatus=='Cancelado'){

            $id = $this->id;

            foreach(VuelosCancelados::get() as $vuelos){

                if($vuelos['vuelo']['id'] == $id){

                    return $vuelos;

                }

            }

        }
        
        return false;

    }
    
    public function PedidosAllData()
    {
        return $this->hasMany(Pedidos::class, 'vuelo_id', 'id')->with(['PedidosPasajeros']); 
    }

    public function Asitentes()
    {
        return $this->hasMany(VuelosAsistentes::class, 'vuelo_id', 'id'); 
    }

    public function soguillas()
    {
        return $this->Asitentes->pluck('asistente_id'); 
    }
}

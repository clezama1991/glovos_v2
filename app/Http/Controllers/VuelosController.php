<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VuelosAsistentes;
use App\Models\Asistentes;
use Illuminate\Http\Request;

use App\Models\Vuelos as ModeloPrincipal;
use App\Models\Pedidos;
use App\Models\PedidosMovimientos;
use App\Models\Globos;
use App\Models\VuelosRealizados;
use App\Models\VuelosCancelados;
use App\Models\PedidosPasajeros;
use App\Models\Pilotos;
use App\Models\Zones;
use Automattic\WooCommerce\Client;
use App\User;
use DB;
use Hash;
use Carbon\Carbon;
use PDF;

class VuelosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/vuelos'; 
    }
 

    public function listado_all(){
        
        $records = ModeloPrincipal::with(['zona'])->select('*', DB::raw('CONCAT(id, " (", notas, ")") AS name'))->whereActivo(1)->orderBy('fecha','DESC')->get();
        
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date);

        foreach ($records as $key => $record) {            
            $record->name_vuelo = $record->name_vuelo();
            $record->is_exclisivo = $record->IsExclisivo();
            $record->nombre_zona_despegue = $record->nombre_zona_despegue();
            
            if(Carbon::parse($record->fecha) < $real_now){
                $record->_rowVariant = 'danger';  
            }; 
            if($record->estatus=='Volado'){
                $record->_rowVariant = 'success';  
            }; 

        }


       return response(['records' => $records]);
    
   }

    public function listado_all_disponibles($vuelo_id){
        
        $date = date('Y-m-d'); 
        $records = ModeloPrincipal::where('fecha','>=',$date)->OrWhere('id',$vuelo_id)->with(['zona'])->select('*', DB::raw('CONCAT(id, " (", notas, ")") AS name'))->whereActivo(1)->orderBy('fecha','DESC')->get();
        
        $real_now = Carbon::create($date);

        foreach ($records as $key => $record) {            
            $record->name_vuelo = $record->name_vuelo();
            $record->is_exclisivo = $record->IsExclisivo();
            $record->nombre_zona_despegue = $record->nombre_zona_despegue();
            
            if(Carbon::parse($record->fecha) < $real_now){
                $record->_rowVariant = 'danger';  
            }; 
            if($record->estatus=='Volado'){
                $record->_rowVariant = 'success';  
            }; 

        }


       return response(['records' => $records]);
    
   }

    public function listado(){
        
        $records = ModeloPrincipal::with(['zona'])->select('*', DB::raw('CONCAT(id, " (", notas, ")") AS name'))->whereActivo(1)->where('estatus','!=','Volado')->where('fecha','>=',date('Y-m-d'))->orderBy('fecha','DESC')->get();
        
        foreach ($records as $key => $record) {            
            $record->name_vuelo = $record->name_vuelo();
            $record->is_exclisivo = $record->IsExclisivo();
            $record->nombre_zona_despegue = $record->nombre_zona_despegue();
        }


       return response(['records' => $records]);
    
   }
   
    //CALENDARIO
    public function index(){
        
        $date = date('Y-m-').'01'; 
        $real_now = Carbon::create($date);
        $a_partir = $real_now->subMonth(2);
        $records = ModeloPrincipal::where('fecha','>=',$a_partir)->with(['zona','piloto','globo','Pedidos','multimedias'])->orderBy('fecha','DESC')->get();
        // $records = ModeloPrincipal::with(['zona','piloto','globo','Pedidos.PedidosPasajeros'])->orderBy('fecha','ASC')->get();
        foreach ($records as $key => $record) {
            $soguillas = [];
            $logo = ($record->globo)?$record->globo->logo:'/images/globo.jpg';
            $peso_globo = ($record->globo)?$record->globo->peso_globo():0;
            $gas = ($record->gas)?$record->gas:0;
            $reserva = ($record->reserva)?$record->reserva:0;
            $carga_maxima = ($record->carga_maxima)?$record->carga_maxima:0;
            $peso_pasajeros = 0;

            foreach ($record->Pedidos as $pedido) {
                $pedido->mensaje_cancelacion = null;
                $peso_extra = ($pedido->peso_extra)?7:0; 
                foreach ($pedido->PedidosPasajeros as $PedidosPasajero) {
                    $PedidosPasajero->pasajero->peso = $PedidosPasajero->pasajero->peso + $peso_extra;
                    $peso_pasajeros += $PedidosPasajero->pasajero->peso;
                } 
            }
            
            $record->mensajes_cancelacion_zona = ($record->zona)?$record->zona->mensajes_cancelacion():[];
            $record->cantidad_pasajeros_registrados = $record->cantidad_pasajeros_registrados();
            $record->cantidad_pasajeros = $record->cantidad_pasajeros();
            $record->estado_multimedia = $record->estado_multimedia();
            $record->is_exclisivo = $record->IsExclisivo();
            $record->nombre_zona_despegue = $record->nombre_zona_despegue();
            $record->dataVueloCancelado = $record->dataVueloCancelado();
            $record->logo = $logo;
            $record->peso_globo = $peso_globo;
            $record->peso_pasajeros = $peso_pasajeros;
            $record->carga = $peso_pasajeros + $peso_globo + $gas + $reserva;
            $record->peso_disponible += $carga_maxima - $record->carga;
 
            
            foreach ($record->Asitentes as $asitente) {                
                $soguillas[] = $asitente->asistente->full_name;
            }
            $record->soguillas = $soguillas;

        }
        
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::with('multimedias','zona','piloto','globo','Pedidos')->whereId($id)->first();
        $record->soguillas = $record->soguillas();
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token','file','pedido_id','parte_meteo_meteoblue','soguillas')->toArray(); 
  
      	try {

            DB::beginTransaction();
        
                if (is_file($request->form_parte_mateo)) {
                    $file = $request->form_parte_mateo;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_parte_mateo')->move($path_server, $filename); 
                    $data['parte_mateo'] = $path_file; 
                    $data['meteoblue_donwload'] = 0;
                }else{
                    if(isset($request->parte_meteo_meteoblue)){ 
                        $data['parte_mateo'] = '/uploads/'.$request->parte_meteo_meteoblue; 
                        $data['meteoblue_donwload'] = 1; 
                    }
                }
             
                if (is_file($request->form_tabla_carga)) {
                    $file = $request->form_tabla_carga;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_tabla_carga')->move($path_server, $filename); 
                    $data['tabla_carga'] = $path_file; 
                }
                
               
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   
                $ModeloPrincipal = ModeloPrincipal::create($data);

                if(isset($request->pedido_id)){
                    
                    Pedidos::whereId($request->pedido_id)->update([
                        'vuelo_id' => $ModeloPrincipal->id
                    ]);
                    
                }

                if($ModeloPrincipal->estatus == 'Volado'){
                    if(!is_null($ModeloPrincipal->hora_aterrizaje) && !is_null($ModeloPrincipal->hora_despegue) ){
                        $fecha_desp = $ModeloPrincipal->fecha_despegue.' '.$ModeloPrincipal->hora_despegue;
                        $fecha_ate = $ModeloPrincipal->fecha_despegue.' '.$ModeloPrincipal->hora_aterrizaje;
                        $inicio = Carbon::parse($fecha_desp);
                        $final = Carbon::parse($fecha_ate);
                        
                        $intervaloM= $inicio->diffInMinutes($final);
                        
                        $dt = Carbon::create(2023, 1, 1, 0);
                        $new_time = $dt->addMinutes($intervaloM);
                        $ModeloPrincipal->duracion_vuelo = $new_time->format('H:i');
                        $ModeloPrincipal->save();                
                    }
                }  

                if(!is_null($request->soguillas) || $request->soguillas!=''){
                    foreach (explode(',', $request->soguillas ) as $key => $soguillas) {                    
                        VuelosAsistentes::updateOrCreate([
                            'vuelo_id' => $ModeloPrincipal->id,
                            'asistente_id' => $soguillas,
                            'fecha' => $ModeloPrincipal->fecha
                        ], []);
                    }
                }



            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        
        }

        return response(['result' => true]);

    
    }



    public function update(Request $request, $id)
    {

        $data = collect($request->all())->except('token','file','parte_meteo_meteoblue','soguillas')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
                if (is_file($request->form_parte_mateo)) {
                    $file = $request->form_parte_mateo;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_parte_mateo')->move($path_server, $filename); 
                    $data['parte_mateo'] = $path_file; 
                    $data['meteoblue_donwload'] = 0; 
                }else{
                    if(isset($request->parte_meteo_meteoblue)){ 
                        $data['meteoblue_donwload'] = 1; 
                        $data['parte_mateo'] = '/uploads/'.$request->parte_meteo_meteoblue; 
                    }
                }
            
                if (is_file($request->form_tabla_carga)) {
                    $file = $request->form_tabla_carga;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_tabla_carga')->move($path_server, $filename); 
                    $data['tabla_carga'] = $path_file; 
                }
            


                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }                
                ModeloPrincipal::find($id)->update($data);
                
                $ModeloPrincipal = ModeloPrincipal::find($id);
 
                if($ModeloPrincipal->estatus == 'Volado'){
                    if(!is_null($ModeloPrincipal->hora_aterrizaje) && !is_null($ModeloPrincipal->hora_despegue) ){
                        $fecha_desp = $ModeloPrincipal->fecha_despegue.' '.$ModeloPrincipal->hora_despegue;
                        $fecha_ate = $ModeloPrincipal->fecha_despegue.' '.$ModeloPrincipal->hora_aterrizaje;
                        $inicio = Carbon::parse($fecha_desp);
                        $final = Carbon::parse($fecha_ate);
                        
                        $intervaloM= $inicio->diffInMinutes($final);
                        
                        $dt = Carbon::create(2023, 1, 1, 0);
                        $new_time = $dt->addMinutes($intervaloM);
                        $ModeloPrincipal->duracion_vuelo = $new_time->format('H:i');
                        $ModeloPrincipal->save();                
                    }
                }  

                VuelosAsistentes::where('vuelo_id',$ModeloPrincipal->id)->delete();
                if(!is_null($request->soguillas) || $request->soguillas!=''){
                    foreach (explode(',', $request->soguillas ) as $key => $soguillas) {                    
                        VuelosAsistentes::updateOrCreate([
                            'vuelo_id' => $ModeloPrincipal->id,
                            'asistente_id' => $soguillas,
                            'fecha' => $ModeloPrincipal->fecha
                        ], []);
                    }
                }

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }


	public function CambiarEstado(Request $request) {   
        
        try {

            DB::beginTransaction();

                ModeloPrincipal::where('id',$request->id)->update(['activo'=>$request->activo]);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }
 
        return response(['result' => true]);


    }

	public function destroy($id) {   
        
        try {

            DB::beginTransaction();

                ModeloPrincipal::whereId($id)->delete();

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

    
    public function vuelo_volado(Request $request)
    {


        $data = collect($request->form)->toArray(); 
        
      	try {

            DB::beginTransaction();
 
                $vuelo = ModeloPrincipal::where('id',$request->id)->first();
                
                foreach ($vuelo->Pedidos as $key => $value) {
            
                    $value->hanvolado = $vuelo->fecha;
                    $value->estatus = 'Vuelo Realizado';
                    $value->save();

                    // $data = [
                    //     'status' => 'vuelo-realizado'
                    // ];
                     
                    // $this->woocomerce_update_order($value->orden_wordpress, $data);

                    foreach ($value->agrupaciones as $key_agrupacion => $agrupacion) {                        
                        $agrupacion->hanvolado = $vuelo->fecha;
                        $agrupacion->estatus = 'Vuelo Realizado';
                        // $this->woocomerce_update_order($agrupacion->orden_wordpress, $data);
                        $agrupacion->save();
                    }

                }
                
                 
                Pilotos::whereId($vuelo->piloto_id)->update(['experiencia_reciente'=>$vuelo->fecha]);

                $data['estatus'] = 'Volado';
                $vuelo->update($data);
  
                $ModeloPrincipal = ModeloPrincipal::find($request->id);

                if($ModeloPrincipal->estatus == 'Volado'){
                    if(!is_null($ModeloPrincipal->hora_aterrizaje) && !is_null($ModeloPrincipal->hora_despegue) ){
                        $fecha_desp = $ModeloPrincipal->fecha_despegue.' '.$ModeloPrincipal->hora_despegue;
                        $fecha_ate = $ModeloPrincipal->fecha_despegue.' '.$ModeloPrincipal->hora_aterrizaje;
                        $inicio = Carbon::parse($fecha_desp);
                        $final = Carbon::parse($fecha_ate);
                        
                        $intervaloM= $inicio->diffInMinutes($final);
                        
                        $dt = Carbon::create(2023, 1, 1, 0);
                        $new_time = $dt->addMinutes($intervaloM);
                        $ModeloPrincipal->duracion_vuelo = $new_time->format('H:i');
                  
                        
                        $globos = Globos::whereId($ModeloPrincipal->globo_id)->first();
                        if($globos){
                            
                            $hora_total_vuelo = '00:00';
                            
                            if(!is_null($globos->hora_total_vuelo)){
                                $hora_total_vuelo = $globos->hora_total_vuelo;
                            }

                            $ModeloPrincipal->horas_inicial_globo = $hora_total_vuelo;

                            $array_hora = [$new_time->format('H:i'), $hora_total_vuelo];
                            
                            $total = 0;

                            // Loop the data items
                            foreach($array_hora as $item){
                                $temp = explode(":", $item); // Explode by the seperator :
                                $total+= (int) $temp[0] * 3600; // Convert the hours to seconds and add to our total
                                $total+= (int) $temp[1] * 60;  // Convert the minutes to seconds and add to our total
                                $total+= (int) isset($temp[2]) ? $temp[2] : '00'; // Add the seconds to our total
                            }
                            
                            $formatted = sprintf('%02d:%02d', ($total / 3600),($total / 60 % 60), $total % 60);
                            
                            $globos->update([
                                'hora_total_vuelo' => $formatted
                            ]);

                            $ModeloPrincipal->horas_final_globo = $formatted;
        
                        }

                        $ModeloPrincipal->save();                

                    }

                }  

                $vuelo = ModeloPrincipal::where('id',$request->id)->first();
                if(isset($vuelo->globo) && isset($vuelo->globo->bottom_end)){
                    $vuelo->globo->bottom_end = $vuelo->globo->bottom_end; 
                    $vuelo->globo->bottom_end->cesta = $vuelo->globo->bottom_end->cesta; 
                    $vuelo->globo->bottom_end->botellas = $vuelo->globo->bottom_end->botellas(); 
                    $vuelo->globo->bottom_end->quemador = $vuelo->globo->bottom_end->quemador; 
                }
                $vuelo->TipoNubosidad = $vuelo->TipoNubosidad ?? null; 
                $vuelo->total_peso_disponible = $vuelo->total_peso_disponible_calc() ?? 0; 
                $dataVuelosRealizados = [
                    'zona' => $vuelo->zona,
                    'piloto' => $vuelo->piloto,
                    'globo' => $vuelo->globo,
                    'vuelo' => $vuelo,
                    'pedido' => $vuelo->PedidosAllData,
                    'pasajeros' => $vuelo->pasajeros()
                ];

                VuelosRealizados::Create($dataVuelosRealizados);

            
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }
    
    public function multimedia_vuelos($id, $multimedia)
    {

      	try {

            DB::beginTransaction();
 
                $vuelo = ModeloPrincipal::where('id',$id)->first();
                $vuelo->multimedia = $multimedia;
                if($multimedia){             
                    $date = date('Y-m-d'); 
                    $real_now = Carbon::create($date);
                    $vuelo->multimedia_caduca = Carbon::create($date)->addMonths(encontrar_configuracion('media_expiration'))->format('Y-m-d');
                 }else{
                    $vuelo->multimedia_caduca = null;
                 }
                $vuelo->save();
 
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        } 
        return response(['result' => true, 'mmm' => $vuelo ]);

    }

    public function update_vuelos()
    {
        
        $vuelos = ModeloPrincipal::where('estatus','Volado')->get();

        foreach ($vuelos as $key => $ModeloPrincipal) { 
            if(!is_null($ModeloPrincipal->hora_aterrizaje) && !is_null($ModeloPrincipal->hora_despegue) ){
                $fecha_desp = $ModeloPrincipal->fecha_despegue.' '.$ModeloPrincipal->hora_despegue;
                $fecha_ate = $ModeloPrincipal->fecha_despegue.' '.$ModeloPrincipal->hora_aterrizaje;
                $inicio = Carbon::parse($fecha_desp);
                $final = Carbon::parse($fecha_ate);
                
                $intervaloM= $inicio->diffInMinutes($final);
                
                $dt = Carbon::create(2023, 1, 1, 0);
                $new_time = $dt->addMinutes($intervaloM);
                $ModeloPrincipal->duracion_vuelo = $new_time->format('H:i');
                 
                
                
                $globos = Globos::whereId($ModeloPrincipal->globo_id)->first();
                if($globos){                        
                    $hora_total_vuelo = '00:00';
                    
                    if(!is_null($globos->hora_total_vuelo)){
                        $hora_total_vuelo = $globos->hora_total_vuelo;
                    }
                    
                    $ModeloPrincipal->horas_inicial_globo = $hora_total_vuelo;

                    $array_hora = [$new_time->format('H:i'), $hora_total_vuelo];
                    
                    $total = 0;

                    // Loop the data items
                    foreach($array_hora as $item){
                        $temp = explode(":", $item); // Explode by the seperator :
                        $total+= (int) $temp[0] * 3600; // Convert the hours to seconds and add to our total
                        $total+= (int) $temp[1] * 60;  // Convert the minutes to seconds and add to our total
                        $total+= (int) isset($temp[2]) ? $temp[2] : '00'; // Add the seconds to our total
                    }
                    
                    $formatted = sprintf('%02d:%02d', ($total / 3600),($total / 60 % 60), $total % 60);
                    
                    $globos->update([
                        'hora_total_vuelo' => $formatted
                    ]);
                    
                    $ModeloPrincipal->horas_final_globo = $formatted;

                }
 
                $ModeloPrincipal->save();        
 
            }
        }  
    }

    public function diploma(Request $request)
    {

      	try {
            $pasajeros = [];

            DB::beginTransaction();
                
                if($request->pasajeros==''){
                    $ModeloPrincipal = ModeloPrincipal::whereId($request->vuelo)->first();
                    foreach ($ModeloPrincipal->pedidos_pasajeros() as $key => $value) {
                        $pasajeros[] = $value['id'];
                    }
                }else{
                    $pasajeros = explode(',',$request->pasajeros);
                }

                $records = PedidosPasajeros::whereIn('id',$pasajeros)->get(); 
                $cantidad_pagina = count($records);
                $pdf = PDF::loadView('plataforma.pdfs.diploma', compact('records','cantidad_pagina'));
                $pdf->setPaper('A4', 'landscape');
                // $output = $pdf->output();
                return $pdf->download('diplomas.pdf');
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        } 
        return response(['result' => true, 'mmm' => $vuelo ]);


    }

    public function piloto_enviar_formulario($vuelo_id)
    {

      
          try {

            DB::beginTransaction();
  
                $date = date('Y-m-d');                  
                $Vuelo = ModeloPrincipal::whereId($vuelo_id)->first();
                
                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                    $url = "https://";   
                else  
                    $url = "http://";     
                $url.= $_SERVER['HTTP_HOST'];   
                $url.= '/validate_pin/';   
                
                $formato = encontrar_configuracion('format_notificacion_link_piloto');
                
                $kink = $url.''.\Crypt::encrypt($Vuelo->id);   

                $parte1=explode('{',$formato);
                $parte2=explode('}',$parte1[1]);
                $titulo= $parte2[0];
                $formato = str_replace('{'.$titulo.'}', '', $formato);
                $formato = str_replace('[nombre]', $Vuelo->piloto->full_name, $formato);
                $formato = str_replace('[fecha]', Carbon::create($Vuelo->fecha)->format('d/m/Y'), $formato);
                $formato = str_replace('[zona]', ($Vuelo->zona)?$Vuelo->zona->nombre:'' , $formato);
                $formato = str_replace('[boton_descargar]', $kink , $formato);

 
                $phone_contacto = $telefono_contacto = $Vuelo->piloto->telefono;
                $phone_contacto_end = ''; 
                if($telefono_contacto!=''){       
                    $init =  substr($telefono_contacto, 0 ,1);
                    if($init === '+'){
                        $phone_contacto_end = $phone_contacto;
                    }else{                        
                        $phone_contacto_end = '+34'.$phone_contacto;
                    }
                    $mensaje  = html_entity_decode($formato);
                    return redirect('https://api.whatsapp.com/send?phone='.$phone_contacto_end.'&text='.urlencode(strip_tags($mensaje)));
                }
        
        

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }
        
    }
    public function soguilla_enviar_formulario($vuelo_id, $soguilla_id)
    {

      
          try {

            DB::beginTransaction();
  
                $date = date('Y-m-d');                  
                $Vuelo = ModeloPrincipal::whereId($vuelo_id)->first();
                $asistentes = Asistentes::whereId($soguilla_id)->first();
                
                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                    $url = "https://";   
                else  
                    $url = "http://";     
                $url.= $_SERVER['HTTP_HOST'];   
                $soguilla_id = \Crypt::encrypt($asistentes->id);   
                $url.= '/validate_pin_soguilla';   
                
                $formato = encontrar_configuracion('format_notificacion_link_soguillas');
                
                $kink = $url.'/'.\Crypt::encrypt($Vuelo->id).'/'.$soguilla_id;   

                $parte1=explode('{',$formato);
                $parte2=explode('}',$parte1[1]);
                $titulo= $parte2[0];
                $formato = str_replace('{'.$titulo.'}', '', $formato);
                $formato = str_replace('[nombre]', $asistentes->full_name, $formato);
                $formato = str_replace('[fecha]', Carbon::create($Vuelo->fecha)->format('d/m/Y'), $formato);
                $formato = str_replace('[zona]', ($Vuelo->zona)?$Vuelo->zona->nombre:'' , $formato);
                $formato = str_replace('[boton_descargar]', $kink , $formato);

 
                $phone_contacto = $telefono_contacto = $asistentes->telefono;
                $phone_contacto_end = ''; 
                if($telefono_contacto!=''){       
                    $init =  substr($telefono_contacto, 0 ,1);
                    if($init === '+'){
                        $phone_contacto_end = $phone_contacto;
                    }else{                        
                        $phone_contacto_end = '+34'.$phone_contacto;
                    }
                    $mensaje  = html_entity_decode($formato);
                    return redirect('https://api.whatsapp.com/send?phone='.$phone_contacto_end.'&text='.urlencode(strip_tags($mensaje)));
                }
        
        

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }
        
    }
 
    
    public function cancelar_vuelo_notificar_pasajeros(Request $request)
    {
  
        try {

            DB::beginTransaction();
  
                $date = date('Y-m-d');                  
                $Vuelo = ModeloPrincipal::whereId($request->vuelo_id)->first();
                
                $formato = $request->mensaje;
                                                
                $formato = str_replace('[nombre]', $request->nombre, $formato);
                $formato = str_replace('[fecha]', Carbon::create($Vuelo->fecha)->format('d/m/Y'), $formato);
                $formato = str_replace('[zona]', ($Vuelo->zona)?$Vuelo->zona->nombre:'' , $formato);

 
                $phone_contacto = $telefono_contacto = $request->to;
                $phone_contacto_end = ''; 
                if($telefono_contacto!=''){       
                    $init =  substr($telefono_contacto, 0 ,1);
                    if($init === '+'){
                        $phone_contacto_end = $phone_contacto;
                    }else{                        
                        $phone_contacto_end = '+34'.$phone_contacto;
                    }
                    $formato  = html_entity_decode($formato);
                    $mensaje = TraducirTexto($request->lenguaje_contacto,$formato);
                     return redirect('https://api.whatsapp.com/send?phone='.$phone_contacto_end.'&text='.urlencode(strip_tags($mensaje)));
                }
        
        

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }
         
    }
      
	public function confirmar_cancelacion_vuelo(Request $request) {   
        
        try {

            DB::beginTransaction();

                ModeloPrincipal::whereId($request->id)->update(['estatus'=>'Cancelado','notas_cancelacion'=>$request->mensaje_cancelacion_vuelo]);

                $vuelo = ModeloPrincipal::whereId($request->id)->withTrashed()->first();
                // dd($vuelo->Pedidos);

                if(isset($vuelo->globo) && isset($vuelo->globo->bottom_end)){
                    $vuelo->globo->bottom_end = $vuelo->globo->bottom_end; 
                    $vuelo->globo->bottom_end->cesta = $vuelo->globo->bottom_end->cesta; 
                    $vuelo->globo->bottom_end->botellas = $vuelo->globo->bottom_end->botellas(); 
                    $vuelo->globo->bottom_end->quemador = $vuelo->globo->bottom_end->quemador; 
                }     
                $vuelo->total_peso_disponible = $vuelo->total_peso_disponible_calc() ?? 0; 
                $dataVuelosRealizados = [
                    'zona' => $vuelo->zona,
                    'piloto' => $vuelo->piloto,
                    'globo' => $vuelo->globo,
                    'vuelo' => $vuelo,
                    'pedido' => $vuelo->PedidosAllData,
                    'pasajeros' => $vuelo->pasajeros()
                ];

                VuelosCancelados::Create($dataVuelosRealizados);
                
                foreach ($vuelo->Pedidos as $key => $value) {            
                    $value->hanvolado = null;
                    $value->vuelo_id = null;
                    $value->agrupacion = null;
                    $value->parent_id = null;
                    if($value->estatus_pedido=='Pendiente'){
                        $value->estatus = 'Creado';
                    }else if($value->estatus_pedido=='Completado'){
                        $value->estatus = 'Formulario Completado';
                    }else{
                        $value->estatus = 'Formulario Enviado'; 
                    }
                    $value->save();

                    PedidosMovimientos::create([
                        'pedido_id' => $value->id,
                        'vuelo_id' =>  $vuelo->vuelo_id,
                        'fecha'=>date('Y-m-d'),
                        'observacion'=> (($value->vuelo)?$value->vuelo->name_vuelo():'')." - Vuelo Cancelado"
                    ]);
 
                }
                
                $vuelo->estatus = 'Cancelado';
                $vuelo->save();

                VuelosRealizados::where('vuelo->id', $request->id)->delete();

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }
 
	public function descargar_meteoblue($zona_id) {  

        try {

            DB::beginTransaction();

                $zona = Zones::whereId($zona_id)->first();

                $nombre_zona = $zona->nombre;
                $fecha_documento = date('m_d_Y');
                $time = time();

                $nombre_meteoblue = $nombre_zona.'-'.$fecha_documento.'-'.$time.'.png';

                $records = ConsultarMeteoblue($zona->meteoblue_url, $nombre_meteoblue);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        
        }

        return response(['result' => true, 'records' => $records]);

    }

    public function woocomerce_update_order($orden_wordpress, $data)
    {
          try {
            $woocommerce = new Client(
                'https://volarenasturias.com/', // Your store URL
                'ck_adc18e8aae2d804776a371eac162a6fcc6359412', // Your consumer key
                'cs_8c790773e9d1c51dc6a600385e1a918c3863f315', // Your consumer secret
                [
                    'timeout' => 120, // SET TIMOUT HERE
                    'wp_api' => true, // Enable the WP REST API integration
                    'version' => 'wc/v3' // WooCommerce WP REST API version
                ]
            );

            $woocommerce->put('orders/'.$orden_wordpress, $data);
         
        } catch (\Throwable $e) {
  
        }
 
    }

}

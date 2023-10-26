<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pedidos;
use App\Models\Pasajeros;
use App\Models\PedidosPasajeros;
use App\Models\Multimedias;
use App\Models\Vuelos;
use App\Models\VuelosRealizados;
use App\Models\Pilotos;
use App\Models\Globos;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Automattic\WooCommerce\Client;
use App\Models\Asistentes;
use App\Models\vuelosChecklists;
use Auth;

use DB;

class PedidosExternoController extends Controller
{

    public function __construct() {
        $this->folder = '/uploads/vuelos'; 
    }
 

    public function index($token){

        $pedido = Pedidos::where('token',$token)->first();
        $completado = false;
        $total_registrado = 0;
        $total_pasajeros = 0;
        $check_list = check_list('pasajero');

        if($pedido && !is_null($pedido->vuelo)){
            $total_registrado = count($pedido->PedidosPasajeros);
            $total_pasajeros =  $pedido->numpax;

            if($total_registrado >= $total_pasajeros){                    
                $completado = true;
            }

            

            return view('register',compact('pedido','completado','total_registrado','total_pasajeros','check_list'));

        }else{ 

            return view('layouts.pedido_no_existe');

        }
    
    }

    
    
    public function store(Request $request)
    {
    
      	try {

            DB::beginTransaction();

                $pedido = Pedidos::whereId($request->id)->first();

                if($request->accion=='add_pasajero'){
                    $pasajero = Pasajeros::firstOrCreate([
                        'nombres' => $request->nombre_pasajero,
                        'apellidos' => $request->apellidos_pasajero,
                        'peso' => preg_replace("/[^0-9]/", "", $request->peso_pasajero),
                        'telefono' => NULL,
                        'email' => NULL,
                    ]);   
                    
                    PedidosPasajeros::firstOrCreate([
                        'pedido_id' => $pedido->id,
                        'pasajero_id' => $pasajero->id
                    ]); 

                    if(count($pedido->PedidosPasajeros) == $pedido->numpax){                    
                        $pedido->estatus = 'Formulario Completado';
                    }else{
                        $pedido->estatus = 'Formulario Incompleto';
                    }

                }  

                if($request->accion=='edit_contacto'){
                    $pedido->nombre_contacto =  $request->nombre_contacto;
                    $pedido->ciudad_contacto =  $request->ciudad_contacto;
                    $pedido->email_contacto =  $request->email;
                    $pedido->telefono_contacto = $request->telefono;
                }

                $pedido->save();
                
                
            DB::commit();


        } catch (\Throwable $e) {

            DB::rollback();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
  
        session()->flash('success', $pedido->id);
        return redirect()->back();
     
    }
    
    public function descargar_multimedias($vuelo_id,$pedido_id)
    {
            
        $public_dir=public_path();

        $zipFileName = 'MultimediasVuelo'.$vuelo_id.'.zip';


        $zip = new \ZipArchive;

        $zip_path = $public_dir . '/' . $zipFileName;
        if ($zip->open($zip_path, \ZipArchive::CREATE) === TRUE) {
 
            $vuelo = Vuelos::whereId($vuelo_id)->whereJsonContains('multimedia_download_pedidos', $pedido_id)->first();
            if(!$vuelo){  
                $vuelo = Vuelos::find($vuelo_id); 
                $existen = $vuelo->multimedia_download_pedidos;
                $existen[] = $pedido_id;
                $vuelo->multimedia_download_pedidos = $existen; 
                $vuelo->save();
            }  

            Pedidos::whereId($pedido_id)->update(['multimedia_download_pedidos'=>1]);

            $multimedias = Multimedias::where('vuelo_id',$vuelo_id)->get();
            foreach ($multimedias as $key => $value) {
            
                $invoice_file = $value->carpeta;
                $nombre_files = $value->nombre;

                $zip->addFile($public_dir . '/'.$invoice_file,$nombre_files);
            }

            $zip->close();

        }

        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );

        $filetopath=$public_dir.'/'.$zipFileName;

        if(file_exists($filetopath)){
            return response()->download($filetopath,$zipFileName,$headers);
        }else{
            return redirect()->back();
        }
        unlink($zip_path);
 
    }
    
            
    public function test_correos()
    {
        
        $formato = encontrar_configuracion('media_available_format_1');

        $parte1=explode('{',$formato);
        $parte2=explode('}',$parte1[1]);
        $titulo= $parte2[0];
        $formato = str_replace('{'.$titulo.'}', '', $formato);
        $formato = str_replace('[fecha]', date('d-d-Y'), $formato);
        $formato = str_replace('[zona]', 'MIRAFLORES' , $formato);
       
        
        $data['logo'] = asset('images/logo.png');
        $data['titulo'] = 'TEST DE PRUEBAS'; 
        $formato = str_replace('[nombre]', 'CARLOS LEZAMA', $formato);

        $data['parrafo_1'] = $formato;
        $data['subject'] = 'Multimedias Disponibles para Descargar - Volarenasturias';
        $data['email'] = 'clezama1991@gmail.com';
        $data['name'] = 'carlos lezama';
        Mail::send('plataforma.emails.plantilla_general', $data, function($message) use ($data) {
            $message->from(config('mail.from.address'), config('mail.from.name'))
            ->to($data['email'],$data['name'])->subject($data['subject']);
        });    

    }
    

    public function download_multimedia($multimedia)
    {
        $Multimedias = Multimedias::whereId(\Crypt::decrypt($multimedia))->first();
        return response()->download($Multimedias->carpeta);
    }

    public function validate_pin($vuelo_id, $soguilla_id = null)
    {

        return view('pilotos.pin_enter',compact('vuelo_id','soguilla_id'));

    }

    public function validate_pin_piloto(Request $request)
    {

        $token_piloto = null;
        $soguilla_token = null;

        $Vuelos = Vuelos::whereId(\Crypt::decrypt($request->vuelo_token))->first();

        if(!is_null($request->soguilla_token)){
        
            $Asistente = Asistentes::whereId(\Crypt::decrypt($request->soguilla_token))->first();
       
            if($Asistente->pin == $request->pin){
                
                session(['pin_piloto'=>$request->pin]);
                session(['pin_rol'=>'soguilla']);

                return redirect('flight_details/'.$request->vuelo_token);
            }

        }else{
             
            if($Vuelos){
                $token_piloto = $Vuelos->piloto->pin;
            }

            if($token_piloto == $request->pin){
                
                session(['pin_piloto'=>$request->pin]);
                session(['pin_rol'=>'piloto']);

                return redirect('flight_details/'.$request->vuelo_token);
            }

        }

        $request->session()->flash('alert-danger', 'PIN no valido!!!');
        session(['pin_piloto'=>null]);
        return redirect()->back();

    }

    public function flight_details($vuelo_token)
    {
        $token_piloto = null;

        $vuelo = Vuelos::whereId(\Crypt::decrypt($vuelo_token))->first();
         if($vuelo){
            $token_piloto = $vuelo->piloto->pin;
        }

        // dd($vuelo);
        if($token_piloto != session()->get('pin_piloto')){
            return redirect('validate_pin/'.$vuelo_token);
        }

        $role = session()->get('pin_rol');

        $check_list = check_list('piloto');

        foreach ($check_list as $key => $value) {
            $check_list[$key]['checked'] = vuelosChecklists::
                where('checklist_id',$value->id)
                ->where('vuelo_id',$vuelo->id)
                ->latest()->first()->checked_list ?? 0;
        }
  
        return view('pilotos.flight_details',compact('vuelo','vuelo_token','role','check_list'));

    }

    
    public function update_checklist_piloto_extern(Request $request)
    {
        
        $vuelo = Vuelos::whereId(\Crypt::decrypt($request->vuelo_token))->first();

        vuelosChecklists::create([
            'checklist_id' => $request->check_id,
            'checked_list' => $request->check_list,
            'user_id' => Auth::user()->id,
            'vuelo_id' => $vuelo->id,
        ]);
        
    }
    
    public function update_vuelo_piloto_extern(Request $request)
    {

        $data = collect($request->all())->except('_token','vuelo_token','vuelo_volado')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }                
                $vuelo = Vuelos::whereId(\Crypt::decrypt($request->vuelo_token))->first();

                if (is_file($request->form_parte_mateo)) {
                    $file = $request->form_parte_mateo;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_parte_mateo')->move($path_server, $filename); 
                    $data['parte_mateo'] = $path_file; 
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
                
                
                $vuelo->update($data);
                
                if(isset($request->vuelo_volado) && $request->vuelo_volado=='1'){
                    $this->vuelo_volado($request, \Crypt::decrypt($request->vuelo_token));
                }

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            $request->session()->flash('alert-danger', 'Ocurrio un error al actualizar vuelo!!!');            
            return redirect()->back();
           
        }

        $request->session()->flash('alert-success', 'Vuelo actualizado correctamente!!!');            
        return redirect()->back();
  
        

    }

    
    public function update_vuelo_delete_pasajero_extern(Request $request)
    {

      
          try {

            DB::beginTransaction();
 
               $PedidosPasajeros = PedidosPasajeros::whereId($request->id)->first();               
               $pedido_id = $PedidosPasajeros->pedido_id;               
               $PedidosPasajeros->delete();
               

               $pedido = Pedidos::whereId($pedido_id)->first();               
                $total_registrado = count($pedido->PedidosPasajeros);
                $total_pasajeros =  $pedido->numpax;
                if($total_registrado == $total_pasajeros){                    
                    $pedido->estatus='Formulario Completado';
                }else{
                    $pedido->estatus='Formulario Incompleto';
                } 
                $pedido->save();
  
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            $request->session()->flash('alert-danger', 'Ocurrio un error al actualizar vuelo!!!');            
            return redirect()->back();
           
        }

        $request->session()->flash('alert-success', 'Vuelo actualizado correctamente!!!');            
        return redirect()->back();
  

    }

    public function vuelo_volado($request, $vuelo_id)
    {

      	try {

            DB::beginTransaction();
 
                $vuelo = Vuelos::where('id',$vuelo_id)->first();

                foreach ($vuelo->Pedidos as $key => $value) {
            
                    $value->hanvolado = $vuelo->fecha;
                    $value->estatus = 'Vuelo Realizado';
                    $value->save();
                    
                    // $woocommerce = new Client(
                    //     'https://volarenasturias.com/', // Your store URL
                    //     'ck_adc18e8aae2d804776a371eac162a6fcc6359412', // Your consumer key
                    //     'cs_8c790773e9d1c51dc6a600385e1a918c3863f315', // Your consumer secret
                    //     [
                    //         'timeout' => 120, // SET TIMOUT HERE
                    //         'wp_api' => true, // Enable the WP REST API integration
                    //         'version' => 'wc/v3' // WooCommerce WP REST API version
                    //     ]
                    // );
    
                    // $data_woo = [
                    //     'status' => 'vuelo-realizado'
                    // ];
                     
                    // $woocommerce->put('orders/'.$value->orden_wordpress, $data_woo);
         
                    foreach ($value->agrupaciones as $key_agrupacion => $agrupacion) {                        
                        $agrupacion->hanvolado = $vuelo->fecha;
                        $agrupacion->estatus = 'Vuelo Realizado';
                        // $woocommerce->put('orders/'.$agrupacion->orden_wordpress, $data_woo);
                        $agrupacion->save();
                    }

                }
                
                 
                Pilotos::whereId($vuelo->piloto_id)->update(['experiencia_reciente'=>$vuelo->fecha]);

                $data['lugar_despegue'] = $request->lugar_despegue;
                $data['fecha_despegue'] = $request->fecha_despegue;
                $data['hora_despegue'] = $request->hora_despegue;
                $data['lugar_aterrizaje'] = $request->lugar_aterrizaje;
                $data['hora_aterrizaje'] = $request->hora_aterrizaje;
                $data['notas'] = $request->notas;
                $data['cautivo'] = isset($request->cautivo) ? 1 : 0;
                $data['estatus'] = 'Volado';
                $vuelo->update($data);
  
                $ModeloPrincipal = Vuelos::find($vuelo_id);

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

                $vuelo = Vuelos::where('id',$vuelo_id)->first();
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
        }
   
    }

    
	public function flight_details_load_meteoblue(Request $request, $vuelo_token) {  

        try {

            DB::beginTransaction();

                $vuelo = Vuelos::whereId(\Crypt::decrypt($vuelo_token))->first();
       
                $zona = $vuelo->zona;

                $nombre_zona = $zona->nombre;
                $fecha_documento = date('m_d_Y');
                $time = time();

                $nombre_meteoblue = $nombre_zona.'-'.$fecha_documento.'-'.$time.'.png';

                $records = ConsultarMeteoblue($zona->meteoblue_url, $nombre_meteoblue);

                $vuelo->parte_mateo = '/uploads/'.$records;
                $vuelo->save();
                
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
            
            $request->session()->flash('alert-danger', 'Ocurrio un error al actualizar vuelo!!!');            
            return redirect()->back();
           
        }

        $request->session()->flash('alert-success', 'Vuelo actualizado correctamente!!!');            
        return redirect()->back();
    }

    public function listado_globos_extern(){
        
        $records = Globos::with('modeloGlobo')->whereActivo(1)->orderBy('nombre','ASC')->get();
             
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date);
     
        foreach ($records as $key => $value) {
             
            if(Carbon::parse($value->arc) < $real_now){
                $value->_rowVariant = 'danger';
            }; 
             
        }
        
        return response(['records' => $records]);
     
    }

    
    public function update_data_passanger(Request $request)
    {
    
      	try {

            DB::beginTransaction();
   
                $pasajero = Pasajeros::whereId($request->pasajero_id)->update([
                    'nombres' => $request->nombre_pasajero,
                    'apellidos' => $request->apellidos_pasajero,
                    'peso' => preg_replace("/[^0-9]/", "", $request->peso_pasajero), 
                ]);   
                                     
            DB::commit();


        } catch (\Throwable $e) {

            DB::rollback();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
  
        session()->flash('success', $request->pasajero_id);
        return redirect()->back();
     
    }
    

}

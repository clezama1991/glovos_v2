<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pedidos;
use App\Models\PedidosMovimientos;
use App\Models\ReservasExternas as ModeloPrincipal;
use App\Models\ReservasExternasBitacora;
use App\Models\ReservasExternasCambioFechas;
use App\Models\Vuelos;
use DB;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class ReservasExternasController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }
     
    public function index(){
        
        $records = ModeloPrincipal::orderBy('id','desc')->get();
    
        foreach ($records as $key => $value) {             
            if(is_null($value->pedido_id)){
                $value->_rowVariant = 'danger';                
            };              
        }
        
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::with('movimientos.user')->whereId($id)->first();
        $record->id_vuelo = $record->id_vuelo();
        $record->aceptada_por_cliente = $record->aceptada_por_cliente();
        $record->propuesta_por_cliente = $record->propuesta_por_cliente();
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token')->toArray(); 
  
      	try {

            DB::beginTransaction();
            
                ModeloPrincipal::create($data);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           

        }

        return response(['result' => true]);

    
    }



    public function update(Request $request, $id)
    {
 
          try {

            DB::beginTransaction();
                $observacion = null;    
               $pedido_externo = ModeloPrincipal::whereId($id)->first();               
               $pedido = Pedidos::where('id',$pedido_externo->pedido_id)->first();

               if($request->tipo=='aceptada' || $request->tipo=='aceptada_por_cliente'){
                    $pedido_externo->cerrado = true;
                    $request->tipo = 'aceptada';

                    if(is_null($request->vuelo_id)){
                        $vuelos = Vuelos::create([                    
                            'zona_id' => $request->zona_id,
                            'fecha' => $request->fecha,
                        ]);
                        $request->vuelo_id = $vuelos->id;
                    }
                    $pedido->update(['vuelo_id' => $request->vuelo_id]); 

                    $observacion = 'Aceptada para el vuelo #'.$pedido->vuelo->id.', Información: '.$pedido->vuelo->name_vuelo();

                    PedidosMovimientos::create(['pedido_id' => $pedido->id,'vuelo_id' => $request->vuelo_id,'fecha'=>date('Y-m-d'),'observacion'=>
                    ($pedido->vuelo)?$pedido->vuelo->name_vuelo():'' ]);

                    foreach ($pedido->agrupaciones as $agrupaciones) { 
                        $agrupaciones->update(['vuelo_id' => $request->vuelo_id]);  
                        
                        PedidosMovimientos::create(['pedido_id' => $agrupaciones->id,'vuelo_id' => $request->vuelo_id,'fecha'=>date('Y-m-d'),'observacion'=>
                        ($agrupaciones->vuelo)?$agrupaciones->vuelo->name_vuelo():'' ]);                    
                    }      
                    
                      
                    $formato = encontrar_configuracion('aceptar_reserva');
                    $titulo = 'Gestión de tu Reserva';
                    $name = $pedido->nombre_contacto;
                    $name=explode(' ',$name);
                    $name= $name[0];
                    $data['logo'] = asset('images/logo.png');
                    $data['titulo'] = $titulo; 
                    $formato = str_replace('[nombre]', $name, $formato);
                    $formato = str_replace('[fecha]', Carbon::create($pedido->vuelo->fecha??null)->format('d/m/Y') , $formato);
                    $formato = str_replace('[zona]', $pedido->vuelo->zona->nombre??null, $formato);

                    $data['parrafo_1'] = $formato;
                    $data['subject'] = 'Gestión de Reserva - '.encontrar_configuracion('nombre_empresa');
                    $data['email'] = $pedido->email_contacto;
                    $data['name'] = $name;
                    Mail::send('plataforma.emails.plantilla_general', $data, function($message) use ($data) {
                        $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->to($data['email'],$data['name'])->subject($data['subject']);
                    });   
                    
                        

















                }elseif($request->tipo=='cancelada'){
                    $pedido_externo->cerrado = true;
                    $observacion = $request->observaciones;
                    $pedido->update(['vuelo_id' => $request->vuelo_id]); 
                    
                    PedidosMovimientos::create(['pedido_id' => $pedido->id,'vuelo_id' => $request->vuelo_id,'fecha'=>date('Y-m-d'),'observacion'=>
                    ($pedido->vuelo)?$pedido->vuelo->name_vuelo():'' ]);

                    foreach ($pedido->agrupaciones as $agrupaciones) { 
                        $agrupaciones->update(['vuelo_id' => $request->vuelo_id]);  
                        
                        PedidosMovimientos::create(['pedido_id' => $agrupaciones->id,'vuelo_id' => $request->vuelo_id,'fecha'=>date('Y-m-d'),'observacion'=>
                        ($agrupaciones->vuelo)?$agrupaciones->vuelo->name_vuelo():'' ]);                    
                    }      
                    
                    $formato = encontrar_configuracion('cancelar_reserva');
                    $titulo = 'Gestión de tu Reserva';
                    $name = $pedido->nombre_contacto;
                    $name=explode(' ',$name);
                    $name= $name[0];
                    $data['logo'] = asset('images/logo.png');
                    $data['titulo'] = $titulo; 
                    $formato = str_replace('[nombre]', $name, $formato);
                    $formato = str_replace('[fecha]', Carbon::create($pedido_externo->fecha_reserva??null)->format('d/m/Y') , $formato);
                    $formato = str_replace('[zona]', $pedido_externo->zona??null, $formato);
                    $formato = str_replace('[razon]', $observacion??null, $formato);

                    $data['parrafo_1'] = $formato;
                    $data['subject'] = 'Gestión de Reserva - '.encontrar_configuracion('nombre_empresa');
                    $data['email'] = $pedido->email_contacto;
                    $data['name'] = $name;
                    Mail::send('plataforma.emails.plantilla_general', $data, function($message) use ($data) {
                        $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->to($data['email'],$data['name'])->subject($data['subject']);
                    });   

                }elseif($request->tipo=='cambio fecha'){

                    $comienzo = new \DateTime($request->fecha_inicio_disp);
                    $final = new \DateTime($request->fecha_fin_disp);

                    for($i = $comienzo; $i <= $final; $i->modify('+1 day')){
                        ReservasExternasCambioFechas::create([                    
                            'reserva_externa_id' => $pedido_externo->id,
                            'fecha' => $i->format("Y-m-d"),
                            'zona' => $request->zona_lista_espera,
                            'aceptada_admin' => true,
                        ]);
                    }
   
                    $observacion = $request->observaciones;
                    $pedido->update(['vuelo_id' => $request->vuelo_id]); 



                    
                    $url =  encontrar_configuracion('url_plataforma')."/completed_register_reserve/";

                    $id = \Crypt::encrypt($pedido_externo->id);
                    $kink = $url.''.$id;   

                    $formato = encontrar_configuracion('cambio_fecha_reserva');

                    $link = '<a style="color: #FFFFFF;
                    background-color: #3699FF;
                    border-color: #3699FF;display: inline-block;
                    font-weight: normal;text-align: center;  border: 1px solid transparent;
                    padding: 0.65rem 0.65rem; border-radius:10px; text-decoration: none;
                    " href="'.$kink.'" target="_blank" class="btn btn-sm btn-primary mr-2">
                        Ir a Gestionar
                    </a>'; 
                    $formato = str_replace('[boton_link]', $link , $formato);

                    
                    $titulo = 'Nueva Reserva';
                    $name = $pedido->nombre_contacto;
                    $name=explode(' ',$name);
                    $name= $name[0];
                    $data['logo'] = asset('images/logo.png');
                    $data['titulo'] = $titulo; 
                    $formato = str_replace('[nombre]', $name, $formato);
                    $formato = str_replace('[fecha]', Carbon::create($pedido_externo->fecha_reserva??null)->format('d/m/Y') , $formato);
                    $formato = str_replace('[zona]', $pedido_externo->zona??null, $formato);
                    $formato = str_replace('[razon]', $observacion??null, $formato);

                    $data['parrafo_1'] = $formato;
                    $data['subject'] = 'Nueva Reserva - '.encontrar_configuracion('nombre_empresa');
                    $data['email'] = $pedido->email_contacto;
                    $data['name'] = $name;
                    Mail::send('plataforma.emails.plantilla_general', $data, function($message) use ($data) {
                        $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->to($data['email'],$data['name'])->subject($data['subject']);
                    });   
                    
                    
                }
  
                $pedido_externo->estatus = $request->tipo;
                $pedido_externo->save();

                ReservasExternasBitacora::create([                    
                    'reserva_externa_id' => $pedido_externo->id,
                    'user_id' => Auth::user()->id,
                    'estatus' => $request->tipo,
                    'observacion' => $observacion
                ]);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true ]);


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

    
}

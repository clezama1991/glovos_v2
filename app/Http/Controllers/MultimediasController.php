<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Multimedias as ModeloPrincipal;
use App\User;
use DB;
use Hash;
use App\Models\Vuelos;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Pedidos;

class MultimediasController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = 'uploads/multimedia'; 
        $this->url_plataforma = encontrar_configuracion('url_plataforma'); 
    }
    
    public function index(){
        
        $records = ModeloPrincipal::orderBy('nombre','ASC')->get();
    
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
    
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token','url_file')->toArray(); 
  
      	try {

            DB::beginTransaction();


            
                if($request->hasfile('files'))
                {

                    foreach($request->file('files') as $file)
                    {
                        $name=uniqid() . '-' .$file->getClientOriginalName();
                        
                        $folder = $this->folder.'/vuelo_'.$request->vuelo_id;
                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }

                        $path_file = $folder.'/'.$name;  
                        $path_server = getcwd().'/'.$folder; 
                        // dd($path_server); 
                        $file->move($path_server, $name);  
                        
                        $data['vuelo_id'] = $request->vuelo_id; 
                        $data['carpeta'] = $path_file; 
                        $data['nombre'] = $name; 
                        $data['extension'] = pathinfo($name, PATHINFO_EXTENSION);
                        $data['fecha'] = date('Y-m-d'); 
                        ModeloPrincipal::create($data);
                    }
                }
    
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

                $multimedia = ModeloPrincipal::whereId($id)->first();

                $path_server = getcwd().'/'.$multimedia->carpeta;  
                if (file_exists($path_server)) {
                    unlink($path_server);
                }

                $multimedia->delete();
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

	public function multimedias_borrar_todos($vuelo_id) {   
        
        try {

            DB::beginTransaction();

                $multimedias = ModeloPrincipal::where('vuelo_id',$vuelo_id)->get();

                foreach ($multimedias as $key => $value) {
                    $path_server = getcwd().'/'.$value->carpeta;                      
                    if (file_exists($path_server)) {
                        unlink($path_server);
                    }
                    $value->delete();
                } 

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

	public function multimedias_send_notificatins(Request $request) {   
        
        try {

            DB::beginTransaction();
            
                $date = date('Y-m-d');                  
                $Vuelo = Vuelos::whereId($request->vuelo_id)->first();
                $Vuelo->multimedia_notification_pedidos = 1;
                $Vuelo->multimedia = true;
                $Vuelo->multimedia_caduca = Carbon::create($date)->addMonths(encontrar_configuracion('media_expiration'))->format('Y-m-d');
                $Vuelo->save();
                
                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                    $url = "https://";   
                else  
                    $url = "http://";     
                $url.= $_SERVER['HTTP_HOST'];   
                $url.= '/completed_form/';   
                
                foreach ($Vuelo->Pedidos as $key => $value) {

                    $formato = encontrar_configuracion($request->formato);

                    $parte1=explode('{',$formato);
                    $parte2=explode('}',$parte1[1]);
                    $titulo= $parte2[0];
                    $formato = str_replace('{'.$titulo.'}', '', $formato);
                    $formato = str_replace('[fecha]', Carbon::create($Vuelo->fecha)->format('d/m/Y'), $formato);
                    $formato = str_replace('[zona]', ($Vuelo->zona)?$Vuelo->zona->nombre:'' , $formato);
                       
                    if(in_array($value->id, $request->pedidos_notificaciones) && (!is_null($value->email_contacto)&&$value->email_contacto!='')){
                         
                        $kink = $url.''.$value->token;   
                        
                        $link = '<a style="color: #FFFFFF;
                        background-color: #3699FF;
                        border-color: #3699FF;display: inline-block;
                        font-weight: normal;text-align: center;  border: 1px solid transparent;
                        padding: 0.65rem 0.65rem; border-radius:10px; text-decoration: none;
                        " href="'.$kink.'" target="_blank" class="btn btn-sm btn-primary mr-2">
                        Descarga aquí
                        </a>'; 
                        $formato = str_replace('[boton_descargar]', $link , $formato);
                        $name = $value->nombre_contacto;
                        $name=explode(' ',$name);
                        $name= $name[0];
                        $data['logo'] = asset('images/logo.png');
                        $data['titulo'] = $titulo; 
                        $formato = str_replace('[nombre]', $name, $formato);
    
                        
                        $formato = TraducirTexto($value->lenguaje_contacto,$formato);

                        $data['parrafo_1'] = $formato;
                        $data['subject'] = 'Archivos multimedia disponibles para descargar - '.encontrar_configuracion('nombre_plataforma');
                        $data['email'] = $value->email_contacto;
                        $data['name'] = $name;
                        Mail::send('plataforma.emails.plantilla_general', $data, function($message) use ($data) {
                            $message->from(config('mail.from.address'), config('mail.from.name'))
                            ->to($data['email'],$data['name'])->subject($data['subject']);
                        });    
                        
                        $value->multimedia_notification = true;
                        $value->save();

                    }
                }

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

    

    public function pedidos_enviar_multimedia($pedido_id, $formato_select)
    {

      
          try {

            DB::beginTransaction();
 
                $Pedidos = Pedidos::whereId($pedido_id)->first();

                $Vuelo = Vuelos::whereId($Pedidos->vuelo_id)->first();

                $date = date('Y-m-d');       
                
                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                    $url = "https://";   
                else  
                    $url = "http://";     
                $url.= $_SERVER['HTTP_HOST'];   
                $url.= '/completed_form/';   
                
                $formato = encontrar_configuracion($formato_select);

                $parte1=explode('{',$formato);
                $parte2=explode('}',$parte1[1]);
                $titulo= $parte2[0];
                $formato = str_replace('{'.$titulo.'}', '', $formato);
                $formato = str_replace('[fecha]', Carbon::create($Vuelo->fecha)->format('d/m/Y'), $formato);
                $formato = str_replace('[zona]', ($Vuelo->zona)?$Vuelo->zona->nombre:'' , $formato);
                    
                $kink = $url.''.$Pedidos->token;   
                
                $link = '<a href="'.$kink.'" target="_blank" class="btn btn-sm btn-primary mr-2">'.$kink.'</a>'; 

                $orderUrl = $this->url_plataforma.'/completed_form/'.$Pedidos->token;

                $formato = str_replace('[boton_descargar]', $orderUrl , $formato);
                $name = $Pedidos->nombre_contacto;
                $name=explode(' ',$name);
                $name= $name[0];

                $data['logo'] = asset('images/logo.png');
                $data['titulo'] = $titulo; 
                $formato = str_replace('[nombre]', $name, $formato);


                $phone_contacto = $telefono_contacto = $Pedidos->telefono_contacto;
                $phone_contacto_end = ''; 
                if($telefono_contacto!=''){       
                    $init =  substr($telefono_contacto, 0 ,1);
                    if($init === '+'){
                        $phone_contacto_end = $phone_contacto;
                    }else{                        
                        $phone_contacto_end = '+'.$phone_contacto;
                    }
                }
        

                $Pedidos->multimedia_notification = true;
                $Pedidos->save();

                 
                $Vuelo->multimedia_notification_pedidos = $Vuelo->notificacions_pedidos_sends();
                $Vuelo->save();


            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        $formato = TraducirTexto($Pedidos->lenguaje_contacto,$formato);
        
        return redirect('https://api.whatsapp.com/send?phone='.$phone_contacto_end.'&text='.urlencode(strip_tags($formato)));
                

    }

    public function MessangeToWhatsApp($order)
    {
      // $orderUrl = url("/orders/{$this->order->id}");
      
      $orderUrl = $this->url_plataforma.'/completed_form/'.$order->token;
     
      $company = encontrar_configuracion('nombre_empresa');
      
      $fecha_vuelo = '';    
      if($order->vuelo){ $date = new Carbon($order->vuelo->fecha); $fecha_vuelo = $date->formatLocalized('%d %B de %Y');}
      
      $hora_vuelo = '';    
      if($order->vuelo){ $hour = new Carbon(date('Y-m-d').''.$order->vuelo->hora); $hora_vuelo = $hour->format('H:i');}
   
        $ubicacion = '';    
        if($order->vuelo && $order->vuelo->zona){ 
            switch ($order->vuelo->zona_despegue) {
                case '1':
                    $ubicacion = $order->vuelo->zona->url_despegue_1;
                    break;
                case '2':
                    $ubicacion = $order->vuelo->zona->url_despegue_2;
                    break;
                case '3':
                    $ubicacion = $order->vuelo->zona->url_despegue_3;
                    break;
                case '4':
                    $ubicacion = $order->vuelo->zona->url_despegue_4;
                    break;
                case '5':
                    $ubicacion = $order->vuelo->zona->url_despegue_5;
                    break; 
                default:
                    # code...
                    break;
            }
        }
    
      $nota = '';    
      if($order->vuelo && $order->vuelo->zona){ $nota = $order->vuelo->zona->mensaje_personalizado;}
   
      $zona = 'No Definida';
      if($order->vuelo && $order->vuelo->zona){ $zona = $order->vuelo->zona->nombre;}
  
  
      $message ='Buenas tardes. Para el vuelo de '.$fecha_vuelo.' en '.$zona.' vamos a quedar a las '.$hora_vuelo.' en la siguiente ubicación '.$ubicacion.'
      
      '.$nota.'
  
      En el siguiente formulario tendréis que rellenar los datos y los pesos de los pasajeros '. $orderUrl;
  
      return $message;
          
    }
      
}

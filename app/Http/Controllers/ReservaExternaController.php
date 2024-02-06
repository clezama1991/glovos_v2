<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservasExternas;
use App\Models\ReservasExternasCambioFechas;
use App\Models\Pedidos;
use App\Models\Zones;
use App\User;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class ReservaExternaController extends Controller
{

    public function __construct() {
        $this->folder = '/uploads/pedidos/pedidos_externos_cupones'; 
    }

    
    public function register_reserve(){
        
        $zonas = Zones::where('activo',true)->where('nombre','!=','VUELO ESPECIAL')->get();
     
        return view('reserva_externa', compact('zonas'));

    }

    public function store(Request $request)
    {

        $data = collect($request->all())->except('token','cupon')->toArray(); 
        $orden_wordpress = substr($data['orden_wordpress'], -4);

        $pedido = Pedidos::where('orden_wordpress',$orden_wordpress)->first();

        // if(!$pedido){
        //     return response(['result' => false, 'msg' => 'Nro de Pedido Invalido' ]);
        // }

        if(ReservasExternas::where('orden_wordpress',$data['orden_wordpress'])->exists()){
            return response(['result' => false, 'msg' => 'Este Nro de Pedido ya tiene reserva registrada' ]);
        }


        // if (is_file($request->cupon)) {
        //     $file = $request->cupon;        
        //     $filename = uniqid() . '-' .$file->getClientOriginalName(); 
        //     $path_file = $this->folder.'/'.$filename;  
        //     $path_server = getcwd().$this->folder;  
        //     $request->file('cupon')->move($path_server, $filename); 
        //     $data['url_cupon'] = $path_file;
        // }
      
      	try {

            DB::beginTransaction();
                $data['pedido_id'] = $pedido->id ?? null;
                $data['zona'] = Zones::where('id',$data['zona_id'])->first()->nombre ?? null;
                $data['estatus'] = 'pendiente';
                // $data['privado'] = ($data['privado']=="1") ? true : false;
                $ReservasExternas = ReservasExternas::create($data);   

                

 
                $url = encontrar_configuracion('url_plataforma')."/dashboard#/pedidos-reservas-externas/consultar/";     

                $kink = $url.''.$ReservasExternas->id;   

                $formato = encontrar_configuracion('nueva_reserva');

                $link = '<a style="color: #FFFFFF;
                background-color: #3699FF;
                border-color: #3699FF;display: inline-block;
                font-weight: normal;text-align: center;  border: 1px solid transparent;
                padding: 0.65rem 0.65rem; border-radius:10px; text-decoration: none;
                " href="'.$kink.'" target="_blank" class="btn btn-sm btn-primary mr-2">
                    Ir a Gestionar
                </a>'; 
                $formato = str_replace('[boton_link]', $link , $formato);

                $users = User::permission('recivied_email_reservas')->get(); 

                foreach ($users as $key => $value) { 
                    $titulo = 'Nueva Reserva';
                    $name = $value->name;
                    $name=explode(' ',$name);
                    $name= $name[0];
                    $data['logo'] = asset('images/logo.png');
                    $data['titulo'] = $titulo; 
                    $formato = str_replace('[nombre]', $name, $formato);
                    $formato = str_replace('[fecha]', Carbon::create($ReservasExternas->fecha_reserva??null)->format('d/m/Y') , $formato);
                    $formato = str_replace('[zona]', $ReservasExternas->zona??null, $formato);

                    $data['parrafo_1'] = $formato;
                    $data['subject'] = 'Nueva Reserva - '.encontrar_configuracion('nombre_empresa');
                    $data['email'] = $value->email;
                    $data['name'] = $name;
                    Mail::send('plataforma.emails.plantilla_general', $data, function($message) use ($data) {
                        $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->to($data['email'],$data['name'])->subject($data['subject']);
                    });   
                }


            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true, 'msg'=> 'Reservación Exitosa']);

    
    }

    public function update(Request $request)
    {

        
      	try {

            DB::beginTransaction();
            
                ReservasExternasCambioFechas::whereId($request->acept_date)->update([
                    'aceptada_user' => true
                ]);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true, 'msg'=> 'Reservación Exitosa']);

    
    }
    
    public function edit($id){

         $id = \Crypt::decrypt($id);

        $record = ReservasExternas::whereId($id)->first();
        
        if($record->aceptada_por_cliente() != null){            
            return view('reserva_externa_completed');
        }

        return view('reserva_externa_edit', compact('record'));
    
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pedidos as ModeloPrincipal;
use App\Models\PedidosPasajeros;
use App\Models\PedidosListaEspera;
use App\Models\PedidosMovimientos;
use App\Models\Vuelos;
use App\Models\Zones;
use App\User;
use DB;
use Hash;
use Automattic\WooCommerce\Client;
use Illuminate\Support\Str;
use App\Notifications\OrderProcessed;
// use UltraMsg\WhatsAppApi ;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PedidosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/zonas'; 
    }
 
    public function update_info_pedidos($page){

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

        
        $data = [
            'page' => $page, 
            'per_page' => 100, 
        ];
        
        $pedidos = $woocommerce->get('orders', $data);
        
        
        foreach ($pedidos as $key => $pedido) {
        
            $pedidos_existe = ModeloPrincipal::where('orden_wordpress',$pedido->id)->first();

            if($pedidos_existe){            
                $pedidos_existe->notas = ($pedido->customer_note=='' || $pedido->customer_note == null) ? null : $pedido->customer_note;
                $pedidos_existe->save();
            }
            
        }

        return response(['page' => $page]);

    }

    public function funcion_test(){
        
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
        
        $data = [
            'page' => 1, 
            'per_page' => 100, 
            'status' => ['completed','gls-sent']
        ];
        
        $pedidos = $woocommerce->get('orders', $data);

        dd($pedidos);

    }

    public function index(){
 
        $records = ModeloPrincipal::with(['vuelo','PedidosPasajeros.pasajero','movimientos.vuelo'])->orderBy('orden_wordpress','DESC')->get();
    
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date);
        foreach ($records as $key => $value) {
             

            if($value->vuelo){
                $value->name_vuelo = $value->vuelo->name_vuelo(); 
                $value->_rowVariant = 'verde';

                if(Carbon::parse($value->vuelo->fecha) < $real_now){
                    $value->_rowVariant = 'naranja';                    
                }

            }else{
                $value->name_vuelo = 'Sin Asignar';
            }

            if(!is_null($value->hanvolado)){
                $value->_rowVariant = 'azul';
            } 

            if($value->reembolso){
                $value->_rowVariant = 'danger';
                $value->estatus = $value->estatus.' (Reembolso)';
            } 

        }
        return response(['records' => $records]);
    }

    public function pedidos_listado(){
 
        $records = ModeloPrincipal::where('estatus','!=','Vuelo Realizado')->orderBy('orden_wordpress','DESC')->get();
    
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date);
        foreach ($records as $key => $value) {
             
            if($value->vuelo){
                $value->name_vuelo = $value->orden_wordpress.' / '.$value->vuelo->name_vuelo(); 
            }else{
                $value->name_vuelo = $value->orden_wordpress.' / '.'Sin Asignar a Vuelo';
            } 

            if($value->reembolso){
                $value->_rowVariant = 'danger';
                $value->estatus = $value->estatus.' (Reembolso)';
            } 
        }
        return response(['records' => $records]);
    }

    public function pedidos_listado_historial(){
 
        $records = ModeloPrincipal::where('estatus','Vuelo Realizado')->orderBy('orden_wordpress','DESC')->get();
    
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date);
        foreach ($records as $key => $value) {
             
            if($value->vuelo){
                $value->name_vuelo = $value->orden_wordpress.' / '.$value->vuelo->name_vuelo(); 
            }else{
                $value->name_vuelo = $value->orden_wordpress.' / '.'Sin Asignar a Vuelo';
            } 

        }
        return response(['records' => $records]);
    }



    public function ver($id){
        
        $record = ModeloPrincipal::with(['lista_espera','movimientos','agrupaciones','parent'])->withTrashed()->where('orden_wordpress',$id)->first();
        $zonas = Zones::get();
        $grupo_pedido = array();
        // if(!is_null($record->agrupacion)){
        //     $agrupacion = ModeloPrincipal::whereIn('id',$record->agrupacion)->get();
        //     foreach($agrupacion as $key => $value){
        //         $grupo_pedido[] = $value;
        //     }
        // }
        $record['grupo_pedido'] = $grupo_pedido;
        return response(['record' => $record,'zonas'=>$zonas]);
    
    }
 
    public function show($id){
        
        $record = ModeloPrincipal::withTrashed()->where('orden_wordpress',$id)->exists();
         
        return response(['record' => $record]);
    
    }
 
    public function actualizar_pedidos(){

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

        
        $data = [
            'page' => 1, 
            'per_page' => 100, 
            'status' => ['completed','gls-sent']
        ];
        
        $pedidos = $woocommerce->get('orders', $data);
        
        $pedidos_actuales = ModeloPrincipal::count();

        $pedidos_nuevos = 0;
        $pedidos_actualizados = 0;

        // if(count($pedidos)!=$pedidos_actuales){
            
            foreach ($pedidos as $key => $pedido) {
                
                $numpax = 0;
                $privado = false;
                foreach ($pedido->line_items as $lineitems) {

                    if($lineitems->parent_name=='PAREJA' || $lineitems->parent_name=='PRIVADO'){
                        $numpax = $numpax + 2;  
                    }else if($lineitems->parent_name=='EXCLUSIVO'){

                        $privado = true;
                        $variation = $woocommerce->get('products/'.$lineitems->product_id.'/variations/'.$lineitems->variation_id);
                        
                        $variation_name = $variation->attributes[0];

                        if($variation_name->option=='2 Pasajeros'){
                            $numpax = $numpax + 2;  
                        }else if($variation_name->option=='3 Pasajeros'){
                            $numpax = $numpax + 3;  
                        }else if($variation_name->option=='4 Pasajeros'){
                            $numpax = $numpax + 4;  
                        }else if($variation_name->option=='5 Pasajeros'){
                            $numpax = $numpax + 5;  
                        }else if($variation_name->option=='6 Pasajeros'){
                            $numpax = $numpax + 6;  
                        }else if($variation_name->option=='7 Pasajeros'){
                            $numpax = $numpax + 7;  
                        }else if($variation_name->option=='8 Pasajeros'){
                            $numpax = $numpax + 8;  
                        }

                    } else{
                        $numpax = $numpax + $lineitems->quantity;  
                    }

                }

                $phone_contacto = $telefono_contacto = ($pedido->billing)?$pedido->billing->phone:'';
                $phone_contacto_end = ''; 
                if($telefono_contacto!=''){       
                    $init =  substr($telefono_contacto, 0 ,1);
                    if($init === '+'){
                        $phone_contacto_end = $phone_contacto;
                    }else{                        
                        $phone_contacto_end = '+34'.$phone_contacto;
                    }
                }


                $pedidos_existe = ModeloPrincipal::where('orden_wordpress',$pedido->id)->first();

                if(!$pedidos_existe){
                    
                    ModeloPrincipal::create([
                        'orden_wordpress' => $pedido->id,
                        'numpax' => $numpax, 
                        'numpax_wordpress' => $numpax, 
                        'privado' => $privado,
                        'notas' => ($pedido->customer_note=='' || $pedido->customer_note == null) ? null : $pedido->customer_note,
                        'peso_extra' => 1,
                        'token' => Str::random(30),
                        'nombre_contacto' => ($pedido->billing)?$pedido->billing->first_name.' '.$pedido->billing->last_name:'',
                        'ciudad_contacto' => ($pedido->billing)?$pedido->billing->city:'',
                        'email_contacto' => ($pedido->billing)?$pedido->billing->email:'',
                        'telefono_contacto' => $phone_contacto_end
                    ]);

                    $pedidos_nuevos++;

                }else{

                    if ($pedidos_existe->numpax != $numpax) {
                       
                        $pedidos_existe->numpax = $numpax;
                        $pedidos_existe->numpax_wordpress = $numpax;
                        $pedidos_existe->privado = $privado;
                        $pedidos_existe->notas = ($pedido->customer_note=='' || $pedido->customer_note == null) ? null : $pedido->customer_note;
                        $pedidos_existe->nombre_contacto = ($pedido->billing)?$pedido->billing->first_name.' '.$pedido->billing->last_name:'';
                        $pedidos_existe->ciudad_contacto = ($pedido->billing)?$pedido->billing->city:'';
                        $pedidos_existe->email_contacto = ($pedido->billing)?$pedido->billing->email:'';
                        $pedidos_existe->telefono_contacto = $phone_contacto_end;
                        $pedidos_existe->save();

                        $pedidos_actualizados++;

                    }

                }


            // }

        }

        return response([
            'pedidos_nuevos' => $pedidos_nuevos,
            'pedidos_actualizados' => $pedidos_actualizados,
            'pedidos' => $pedidos
        ]);
     
    }

    public function actualizar_pedidos_by_id($id){


        
        try {

            DB::beginTransaction();
                
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
                
                $pedido = $woocommerce->get('orders/'.$id);
                
                $numpax = 0;
                $privado = false;
                foreach ($pedido->line_items as $lineitems) {

                    if($lineitems->parent_name=='PAREJA' || $lineitems->parent_name=='PRIVADO'){
                        $numpax = $numpax + 2;  
                    }else if($lineitems->parent_name=='EXCLUSIVO'){

                        $privado = true;
                        $variation = $woocommerce->get('products/'.$lineitems->product_id.'/variations/'.$lineitems->variation_id);
                        
                        $variation_name = $variation->attributes[0];

                        if($variation_name->option=='2 Pasajeros'){
                            $numpax = $numpax + 2;  
                        }else if($variation_name->option=='3 Pasajeros'){
                            $numpax = $numpax + 3;  
                        }else if($variation_name->option=='4 Pasajeros'){
                            $numpax = $numpax + 4;  
                        }else if($variation_name->option=='5 Pasajeros'){
                            $numpax = $numpax + 5;  
                        }else if($variation_name->option=='6 Pasajeros'){
                            $numpax = $numpax + 6;  
                        }else if($variation_name->option=='7 Pasajeros'){
                            $numpax = $numpax + 7;  
                        }else if($variation_name->option=='8 Pasajeros'){
                            $numpax = $numpax + 8;  
                        }

                    } else{
                        $numpax = $numpax + $lineitems->quantity;  
                    }

                }

                $phone_contacto = $telefono_contacto = ($pedido->billing)?$pedido->billing->phone:'';
                $phone_contacto_end = ''; 
                if($telefono_contacto!=''){       
                    $init =  substr($telefono_contacto, 0 ,1);
                    if($init === '+'){
                        $phone_contacto_end = $phone_contacto;
                    }else{                        
                        $phone_contacto_end = '+34'.$phone_contacto;
                    }
                }

                $pedidos_existe = ModeloPrincipal::where('orden_wordpress',$pedido->id)->first();

                if(!$pedidos_existe){
                    
                    ModeloPrincipal::create([
                        'orden_wordpress' => $pedido->id,
                        'numpax' => $numpax, 
                        'numpax_wordpress' => $numpax, 
                        'privado' => $privado,
                        'notas' => ($pedido->customer_note=='' || $pedido->customer_note == null) ? null : $pedido->customer_note,
                        'peso_extra' => 1,
                        'token' => Str::random(30),
                        'nombre_contacto' => ($pedido->billing)?$pedido->billing->first_name.' '.$pedido->billing->last_name:'',
                        'ciudad_contacto' => ($pedido->billing)?$pedido->billing->city:'',
                        'email_contacto' => ($pedido->billing)?$pedido->billing->email:'',
                        'telefono_contacto' => $phone_contacto_end,
                    ]);

                }else{

                    if ($pedidos_existe->numpax != $numpax) {
                        
                        $pedidos_existe->numpax = $numpax;
                        $pedidos_existe->numpax_wordpress = $numpax;
                        $pedidos_existe->privado = $privado;
                        $pedidos_existe->notas = ($pedido->customer_note=='' || $pedido->customer_note == null) ? null : $pedido->customer_note;
                        $pedidos_existe->nombre_contacto = ($pedido->billing)?$pedido->billing->first_name.' '.$pedido->billing->last_name:'';
                        $pedidos_existe->ciudad_contacto = ($pedido->billing)?$pedido->billing->city:'';
                        $pedidos_existe->email_contacto = ($pedido->billing)?$pedido->billing->email:'';
                        $pedidos_existe->telefono_contacto = $phone_contacto_end;
                        $pedidos_existe->save();

                    }

                }

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }
         
        return response(['result' => true]);
     
    }

    public function actualizar_telefonos_pedidos($pagina){

 
        try {

            DB::beginTransaction();
                
                $woocommerce = new Client(
                    'https://volarenasturias.com/', // Your store URL
                    'ck_adc18e8aae2d804776a371eac162a6fcc6359412', // Your consumer key
                    'cs_8c790773e9d1c51dc6a600385e1a918c3863f315', // Your consumer secret
                    [
                        'timeout' => 520, // SET TIMOUT HERE
                        'wp_api' => true, // Enable the WP REST API integration
                        'version' => 'wc/v3' // WooCommerce WP REST API version
                    ]
                );
                
                
                $orden_wordpress_array = [];
                
                $data = [
                    'page' => $pagina, 
                    'per_page' => 100, 
                    'status' => ['completed','gls-sent']
                ];

                $pedidos = $woocommerce->get('orders', $data);
                foreach ($pedidos as $key => $value) {
                    $orden_wordpress_array[] = ['orden_wordpress'=>$value->number,'phone'=>($value->billing)?$value->billing->phone:'-'];
                }
                // return dd($orden_wordpress_array);
                foreach ($orden_wordpress_array as $key => $pedido_set) { 
                    
                    if($pedido_set['phone']!='-'){ 
                        $phone_contacto = $telefono_contacto = $pedido_set['phone'];
                        $phone_contacto_end = ''; 
                        if($telefono_contacto!=''){       
                            $init =  substr($telefono_contacto, 0 ,1);
                            if($init === '+'){
                                $phone_contacto_end = $phone_contacto;
                            }else{                        
                                $phone_contacto_end = '+34'.$phone_contacto;
                            }
                        }

                        if(ModeloPrincipal::where('orden_wordpress',$pedido_set['orden_wordpress'])->exists()){
                            $pedidos_existe = ModeloPrincipal::where('orden_wordpress',$pedido_set['orden_wordpress'])->first();
                            $pedidos_existe->telefono_contacto = $phone_contacto_end;
                            $pedidos_existe->save();
                        }
                    }                  
                }

        

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_sserror'=>$e->getMessage()]);
           
        }
         
        return response(['result' => true]);
     
    }

    public function update(Request $request, $id)
    {
 
          try {

            DB::beginTransaction();
 
               $value = ModeloPrincipal::whereId($id)->first();
               if($request->tipo=='vuelo'){

                   $value->update(['vuelo_id' => $request->vuelo_id]);  
                   PedidosMovimientos::create(['pedido_id' => $id,'vuelo_id' => $request->vuelo_id,'fecha'=>date('Y-m-d'),'observacion'=>
                   ($value->vuelo)?$value->vuelo->name_vuelo():'' ]);

                    foreach ($value->agrupaciones as $agrupaciones) { 

                        $agrupaciones->update(['vuelo_id' => $request->vuelo_id]);  
                        
                        PedidosMovimientos::create(['pedido_id' => $agrupaciones->id,'vuelo_id' => $request->vuelo_id,'fecha'=>date('Y-m-d'),'observacion'=>
                        ($agrupaciones->vuelo)?$agrupaciones->vuelo->name_vuelo():'' ]);
                    
                    }       
                }else if($request->tipo=='exclusividad'){
                    $value->update(['privado' => $request->privado]);  
                }else if($request->tipo=='data'){
                    $data = collect($request)->except('_method','tipo','token')->toArray();
                    $value->update($data);  
                }else{
                    $value->update(['parent_id' => $request->parent_id]);  
                }

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true ]);


    }

    public function pedidos_enviar_formulario($pedido_id)
    {

      
          try {

            DB::beginTransaction();
 
                ModeloPrincipal::find($pedido_id)->update(['estatus' => 'Formulario Enviado']);
             
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        $order = ModeloPrincipal::whereId($pedido_id)->first();
        $MessangeToWhatsApp = $this->MessangeToWhatsApp($order);
        
        $phone_contacto = $telefono_contacto = $order->telefono_contacto;
        $phone_contacto_end = ''; 
        if($telefono_contacto!=''){       
            $init =  substr($telefono_contacto, 0 ,1);
            if($init === '+'){
                $phone_contacto_end = $phone_contacto;
            }else{                        
                $phone_contacto_end = '+'.$phone_contacto;
            }
        }

        $mensaje  = html_entity_decode($MessangeToWhatsApp);
        $mensaje = TraducirTexto($order->lenguaje_contacto,$mensaje);

       return redirect('https://api.whatsapp.com/send?phone='.$phone_contacto_end.'&text='.urlencode(strip_tags($mensaje)));

    }

    public function peso_extra_pedidos(Request $request)
    {

      
          try {

            DB::beginTransaction();
 
                ModeloPrincipal::find($request->id)->update(['peso_extra' => $request->peso_extra]);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }

    public function pedidos_fecha_vuelo(Request $request)
    {

      
          try {

            DB::beginTransaction();
 
                $pedido = ModeloPrincipal::whereId($request->pedido_id)->first();                
                $pedido->update(['hanvolado'=>$request->fecha,'estatus'=>'Vuelo Realizado']);

                $data = [
                    'status' => 'vuelo-realizado'
                ];

                $this->woocomerce_update_order($pedido->orden_wordpress, $data);
        
                foreach ($pedido->agrupaciones as $key_agrupacion => $agrupacion) {
                    $agrupacion->hanvolado = $request->fecha;
                    $agrupacion->estatus = 'Vuelo Realizado';
                    $this->woocomerce_update_order($agrupacion->orden_wordpress, $data);
                    $agrupacion->save();
                }
                
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


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

    public function actualizar_contacto(Request $request)
    {

      
          try {

            DB::beginTransaction();
 
                $pedido = ModeloPrincipal::whereId($request->pedido_id)->first();
                $pedido->nombre_contacto= $request->nombre_contacto;
                $pedido->email_contacto= $request->email_contacto;
                $pedido->telefono_contacto= $request->telefono_contacto;
                $pedido->ciudad_contacto= $request->ciudad_contacto;
                $pedido->lenguaje_contacto= $request->lenguaje_contacto;
                
                $pedido->save();
  
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }

    public function pedidos_agregar_pasajero(Request $request)
    {

      
          try {

            DB::beginTransaction();
 
               $pedido = ModeloPrincipal::whereId($request->pedido_id)->first();
               
               $pedido->numpax = $pedido->numpax + 1;
               $pedido->numpax_wordpress = $pedido->numpax_wordpress + 1;
               
               if($pedido->estatus=='Formulario Completado'){
                $pedido->estatus='Formulario Incompleto';
               }
                
               $pedido->save();
  
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }
    public function pedidos_quitar_pasajero(Request $request)
    {

      
          try {

            DB::beginTransaction();
 
               $pedido = ModeloPrincipal::whereId($request->pedido_id)->first();               
               $pedido->numpax = $pedido->numpax - 1;               
               $pedido->numpax_wordpress = $pedido->numpax_wordpress - 1;               
               $pedido->save();
               

               $pedido = ModeloPrincipal::whereId($request->pedido_id)->first();               
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

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }
    public function pedidos_quitar_pasajero_id($id)
    {

      
          try {

            DB::beginTransaction();
 
               $PedidosPasajeros = PedidosPasajeros::whereId($id)->first();               
               $pedido_id = $PedidosPasajeros->pedido_id;               
               $PedidosPasajeros->delete();
               

               $pedido = ModeloPrincipal::whereId($pedido_id)->first();               
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

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }

    
  public function MessangeToWhatsApp($order)
  {
    // $orderUrl = url("/orders/{$this->order->id}");
    
    $orderUrl = 'https://gestion.volarenasturias.com/completed_form/'.$order->token;
   
    $company = 'Volarenasturias';
    
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
    


    public function buscar($id){

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

        
        $data = [
            'per_page' => 100, 
            'status' => ['completed','gls-sent']
        ];
        
        $pedidos = $woocommerce->get('orders');
        
        //  return $pedidos;
        // $pedidos = $woocommerce->get('orders');




        return response(['pedidos' => $pedidos]);
    
    }

    public function store(Request $request)
    {

        $data = $request->formulario;

        try {

            DB::beginTransaction();
                
            
                $record = ModeloPrincipal::withTrashed()->where('orden_wordpress',$data['orden_wordpress'])->exists();
                if($record){                    
                    return response(['result' => false,'mensaje_error'=>'ID Ya existe']);
                }
                
                $data['token'] = Str::random(30);
                $data['origen'] = 'plataforma';
                ModeloPrincipal::create($data);

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


    public function buscardor_numero_nombre_tlf_pedidos(Request $request) {   
            
        try {

            DB::beginTransaction();

                $search = $request->buscar;

                $records = ModeloPrincipal::where('orden_wordpress', 'like', "%$search%")
                ->orWhere('nombre_contacto', 'like', "%$search%")
                ->orWhere('email_contacto', 'like', "%$search%")
                ->orWhere('telefono_contacto', 'like', "%$search%")                
                ->where('estatus','Creado')
                ->get();

                foreach ($records as $key => $value) {
                    
                    
                    if($value->vuelo){
                        $value->name_vuelo = $value->vuelo->name_vuelo();       
                        
                        
                        if($value->vuelo->estatus=='Volado'){
                            $value->_rowVariant = 'success';  
                        }; 
                    

                    }else{
                        $value->name_vuelo = 'Sin Asignar';
                    }              
                }
                
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        
        }

        return response(['result' => true,'records'=>$records]);

    }


    public function agrupar_pedidos(Request $request) {   
            
        try {

            DB::beginTransaction();

                ModeloPrincipal::whereIn('id',$request->agrupacion)->update(['parent_id' => $request->id]);  
                
                $pedido = ModeloPrincipal::where('id',$request->id)->first();
            
                $total = $pedido->numpax_wordpress;
                
                $agrupacion = ModeloPrincipal::where('parent_id',$request->id)->get();
                foreach($agrupacion as $key => $value){
                    $total += $value->numpax;
                }

                $pedido->update(['numpax' => $total]);  

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        
        }

        return response(['result' => true,'asd'=>$agrupacion]);

    }

    public function desagrupar_pedidos(Request $request) {   
            
        try {

            DB::beginTransaction();

                ModeloPrincipal::where('id',$request->pedido)->update(['parent_id' => null]);  
                
                $pedido = ModeloPrincipal::where('id',$request->id)->first();
            
                $total = $pedido->numpax_wordpress;
                
                $agrupacion = ModeloPrincipal::where('parent_id',$request->id)->get();
                foreach($agrupacion as $key => $value){
                    $total += $value->numpax;
                }

                $pedido->update(['numpax' => $total]);  

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        
        }

        return response(['result' => true,'asd'=>$agrupacion]);

    }

 
    public function pedidos_lista_espera($vuelo_id) {   
            
        try {
            
            $weekMap = [
                0 => '7',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
                6 => '6',
            ];

            $vuelo = Vuelos::find($vuelo_id);

            $fecha_vuelo = $vuelo->fecha;
            $date = Carbon::parse($fecha_vuelo);
 
            $dayOfTheWeek = $date->dayOfWeek;
            $weekday = $weekMap[$dayOfTheWeek];

            $records = PedidosListaEspera::
            whereJsonContains('zonas_id', $vuelo->zona_id)
            ->whereJsonContains('dias', $weekday)
            ->with('pedido')
            ->whereHas('pedido', function ($query) { 
                  $query->where('estatus', 'Creado'); 
                  $query->where('vuelo_id', null); 
            }) 
            ->get();
            $pedidos = [];
            $pedidos_ids = [];
            foreach ($records as $key => $value) {                
                 
                $from = $value->fecha_inicio_disp;
                $to = $value->fecha_fin_disp;
                $check = $date;

                if(is_null($value->fecha_inicio_disp) && is_null($value->fecha_inicio_nodisp) ){
                    $pedidos[] = $value;
                    $pedidos_ids[] = $value->id;
                }else{ 
                    if(!is_null($value->fecha_inicio_nodisp)){ 
                        $from_nod = $value->fecha_inicio_nodisp;
                        $to_nod = $value->fecha_fin_nodisp;
                        
                        if(Carbon::parse($check)->between($from_nod,$to_nod)){
                        } else {
                            $pedidos[] = $value;
                            $pedidos_ids[] = $value->id;
                        }
                    }
 
                    if(!is_null($value->fecha_inicio_disp)){ 
                        if(!in_array($value->id, $pedidos_ids)){                    
                            if(Carbon::parse($check)->between($from,$to)){
                                $pedidos[] = $value;
                                $pedidos_ids[] = $value->id;
                            } else {
                            }
                        }
                    }
                }
                
            }
            
        } catch (\Throwable $e) {

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        
        }

        return response([
            'result' => true,
            'weekday' => $weekday,
            'vuelo' => $vuelo,
            'result' => true,
            'records'=>$pedidos
        ]);

    }

 
    public function pedidos_lista_de_espera() {   
            
        try {
             
            $records = PedidosListaEspera::with('pedido')->get();            
            foreach ($records as $key => $value) {
                $value->zonas = $value->zonas();
            }

        } catch (\Throwable $e) {

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        
        }

        return response(['result' => true,'records'=>$records]);

    }

    public function store_pedidos_lista_espera(Request $request)
    {

        $data = $request->formulario;

        try {

            DB::beginTransaction();
                 
                $data['pedido_id'] = $request->pedido_id;
                $data['zonas_id'] = $request->zonas_id;
                $data['dias'] = $request->dias;
                $data['fecha_inicio_disp'] = $request->fecha_inicio_disp;
                $data['fecha_fin_disp'] = $request->fecha_fin_disp;
                $data['fecha_inicio_nodisp'] = $request->fecha_inicio_nodisp;
                $data['fecha_fin_nodisp'] = $request->fecha_fin_nodisp;

                PedidosListaEspera::updateOrCreate([
                    'pedido_id' => $request->pedido_id
                ], $data);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
        
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        

        }

        return response(['result' => true]);


    }

    public function pedidos_lista_espera_update(Request $request, $id)
    {
 
        try {

            DB::beginTransaction();
                 
                $data['pedido_id'] = $id;
                $data['zonas_id'] = $request->zonas_id;
                $data['dias'] = $request->dias;
                $data['fecha_inicio_disp'] = $request->fecha_inicio_disp;
                $data['fecha_fin_disp'] = $request->fecha_fin_disp;
                $data['fecha_inicio_nodisp'] = $request->fecha_inicio_nodisp;
                $data['fecha_fin_nodisp'] = $request->fecha_fin_nodisp;

                PedidosListaEspera::updateOrCreate([
                     'pedido_id' => $id
                 ], $data);
                
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
        
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        

        }

        return response(['result' => true]);


    }

    public function pedidos_lista_espera_delete($id)
    {
 
        try {

            DB::beginTransaction(); 

                PedidosListaEspera::find($id)->delete();

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
        
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
        

        }

        return response(['result' => true]);


    }


    public function sincronizar_plataforma_woocommerce($estatus,$fecha){
        
        $status = null;

        switch ($estatus) {
            case 'vuelo-realizado':
                $status = 'Vuelo Realizado';
                break;
            default:
                # code...
                break;
        }

        $records = ModeloPrincipal::where('hanvolado','>=',$fecha)->where('estatus', $status)->orderBy('orden_wordpress','DESC')->get();
    
        $data = [
            'status' => $estatus
        ];

        foreach ($records as $key => $value) {
         
            $this->woocomerce_update_order($value->orden_wordpress, $data);
    
        }
    
        return response(['records' => $records]);
    
    }

    public function update_sinc_google($id)
    {

      
          try {

            DB::beginTransaction();
 
                ModeloPrincipal::find($id)->update(['sinc_google_contacts' => true]);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }

}

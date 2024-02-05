<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Plataforma\Modulos;
use DB;
use Automattic\WooCommerce\Client;
use Illuminate\Support\Str;
use App\Models\Pedidos as ModeloPrincipal;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

     public function index()
    {
        
        // $api = $this->update_lsit_woocommerces();
        $pedidos_sinc = ModeloPrincipal::where('sinc_google_contacts',false)->select(['id','nombre_contacto','telefono_contacto'])->get();
        $API_KEY = encontrar_configuracion('google_API_KEY');
        $CLIENT_ID = encontrar_configuracion('google_CLIENT_ID');
        $ACCESS_TOKEN = encontrar_configuracion('google_Account_ACCESS_TOKEN');
      
        return view('panel_administrador', compact('CLIENT_ID','API_KEY','ACCESS_TOKEN','pedidos_sinc'));
    
    }

    public function update_lsit_woocommerces(){

        $woocommerce = woocommerceAuth();

        $data = [
            'per_page' => 100,
            'status' => ['completed']
        ];
        
        $pedidos = $woocommerce->get('orders', $data);
        

        $pedidos_actuales = ModeloPrincipal::count();

        if(count($pedidos)!=$pedidos_actuales){
            
            foreach ($pedidos as $key => $pedido) {
                
                $numpax = 0;

                foreach ($pedido->line_items as $lineitems) {

                    if($lineitems->parent_name=='PAREJA' || $lineitems->parent_name=='PRIVADO'){
                        $numpax = $numpax + 2;  
                    }else{
                        $numpax = $numpax + $lineitems->quantity;  
                    }

                }

                $pedidos_existe = ModeloPrincipal::where('orden_wordpress',$pedido->id)->first();

                if(!$pedidos_existe){
                    
                    ModeloPrincipal::create([
                        'orden_wordpress' => $pedido->id,
                        'numpax' => $numpax, 
                        'peso_extra' => 1,
                        'token' => Str::random(30),
                        'nombre_contacto' => ($pedido->billing)?$pedido->billing->first_name.' '.$pedido->billing->last_name:'',
                        'ciudad_contacto' => ($pedido->billing)?$pedido->billing->city:'',
                        'email_contacto' => ($pedido->billing)?$pedido->billing->email:'',
                        'telefono_contacto' => ($pedido->billing)?$pedido->billing->phone:'',
                    ]);
 
                }else{

                    if ($pedidos_existe->numpax != $numpax) {
                       
                        $pedidos_existe->numpax = $numpax;
                        $pedidos_existe->nombre_contacto = ($pedido->billing)?$pedido->billing->first_name.' '.$pedido->billing->last_name:'';
                        $pedidos_existe->ciudad_contacto = ($pedido->billing)?$pedido->billing->city:'';
                        $pedidos_existe->email_contacto = ($pedido->billing)?$pedido->billing->email:'';
                        $pedidos_existe->telefono_contacto = ($pedido->billing)?$pedido->billing->phone:'';
                        $pedidos_existe->save();
 
                    }

                }


            }

        }


        return response(['woocommerce' => $woocommerce->get('orders')]);
     
    }

    public function test()
    {
        return View('test');    
    }

}

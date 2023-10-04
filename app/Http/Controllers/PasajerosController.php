<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pasajeros as ModeloPrincipal;
use App\Models\PedidosPasajeros;
use App\User;
use DB;
use Hash;
use Carbon\Carbon;


class PasajerosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/pilotos'; 
    }


    public function index(){
        
        $records = ModeloPrincipal::
        select('*', DB::raw('CONCAT(nombres, " ", apellidos) AS FullName'))
        ->orderBy('FullName','ASC')
        ->with(['nro_pedidos.pedido'])
        ->get();
        
        // foreach ($records as $key => $value) {
            
        //     $value->nro_pedido = $value->nro_pedidos;

        // }

        return response(['records' => $records]);
    
    
    }

    public function update(Request $request, $id)
    {

        $data = collect($request->formulario)->except('created_at','updated_at','deleted_at')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   
                ModeloPrincipal::find($id)->update($data);
 
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

                PedidosPasajeros::where('pasajero_id',$id)->delete();

                ModeloPrincipal::whereId($id)->delete();

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

}

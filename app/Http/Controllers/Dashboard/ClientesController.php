<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Plataforma\Clientes;
 
use App\Models\UsersDatos;
use App\User;
use DB;
use Hash;
use Input;
use Str;


class ClientesController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }



    public function index(){
        
        $records = Clientes::with(['polizas','empleados.user'])->get();
    
        return response(['records' => $records]);
    
    
    }


    public function ConsultarClientes($id){


        try {

            DB::beginTransaction();
            
                $ListadoMunicipio = array();
        
                $cliente = Clientes::whereId($id)->with(['polizas','empleados.user'])->first();


         DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           

        }
        
        return response(['datos' => $cliente
        ]);
    
    }

    
    

    public function store(Request $request)
    {


    	$data = $request->formulario;

      	try {

            DB::beginTransaction();

                $Clientes = Clientes::create($data);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           

        }

        return response(['result' => true,'record' => $Clientes]);

    
    }



    public function updateOrCreatedClienteInstalacion(Request $request)
    {

            try {

                DB::beginTransaction();

                $data = $request->formulario;
                $data_cliente = collect($data)->except('token')->toArray();

                $Clientes =  Clientes::find($request->id_cliente)->update($data_cliente);

               

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }


	public function CambiarEstadoCliente(Request $request) {   
        
        try {

            DB::beginTransaction();

                $consulta = Clientes::where('id',$request->id_cliente)->update(['id_estatu_cliente'=>$request->id_estatu]);

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

                $consulta = Clientes::whereId($id)->delete();

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

    

}

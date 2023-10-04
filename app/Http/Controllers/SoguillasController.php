<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Asistentes as ModeloPrincipal;
use App\Models\AsistentesDisponibilidad;
use App\User;
use DB;
use Hash;


class SoguillasController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
     
    public function listado(){
        
        $records = ModeloPrincipal::with('calendario_disponible')->where('activo',true)->select('*', DB::raw('CONCAT(nombres, " ", apellidos) AS FullName'))->orderBy('FullName','ASC')->get();
   
       return response(['records' => $records]);
    
   } 
   
    public function index(){
        
        $records = ModeloPrincipal::get();
    
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
    
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token')->toArray(); 
  
      	try {

            DB::beginTransaction();
            $data['activo'] = !isset($data['activo']) ? false : true;
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

        $data = collect($request->all())->except('token')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
                $data['activo'] = !isset($data['activo']) ? false : ( $data['activo'] == 'true' ? 1 : 0);
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

                ModeloPrincipal::whereId($id)->delete();

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

    

}

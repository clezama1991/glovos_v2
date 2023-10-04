<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PilotosEntrenamientos as ModeloPrincipal;
use App\User;
use DB;
use Hash;


class PilotosEntrenamientoController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/zonas'; 
    }
 
  
    // public function index(){
        
    //     $records = ModeloPrincipal::orderBy('activo','DESC')->orderBy('nombre','ASC')->get();
    
    //     return response(['records' => $records]);
     
    // }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->with(['formulario'])->first();
        
        if($record->entrenamiento!=null){
            $cuestionario = $record->entrenamiento;
        }else{
            $cuestionario = $record->formulario->secciones_preguntas;
        }

        return response(['record' => $record,'cuestionario' => $cuestionario]);
    
    }
 
    public function store(Request $request)
    {

        $data = $request->formulario;

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

        $data = collect($request->all())->except('_method','token')->toArray(); 
  
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

 
	// public function ChangeStatus(Request $request) {   
        
    //     try {

    //         DB::beginTransaction();

    //             ModeloPrincipal::where('id',$request->id)->update(['activo'=>$request->activo]);

    //         DB::commit();

    //     } catch (\Throwable $e) {

    //         DB::rollback();

    //         return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
    //     }
 
    //     return response(['result' => true]);


    // }

    
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

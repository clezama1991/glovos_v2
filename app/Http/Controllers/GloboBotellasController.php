<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GloboBotellas as ModeloPrincipal;
use App\Models\Globos;
use DB;
use Carbon\Carbon;

class GloboBotellasController extends Controller
{
    public function __construct() {
        $this->middleware('auth'); 
    }
 

    public function listado(){
        
        $records = ModeloPrincipal::orderBy('fabricante','ASC')->get(); 
  
        return response(['records' => $records]);
    
   }
   
    public function index(){
        
        $records = ModeloPrincipal::orderBy('fabricante','ASC')->get();
           
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
    
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = $request->formulario; 
  
      	try {

            DB::beginTransaction();
  
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   
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

        $data = $request->formulario; 
  
      	try {

            DB::beginTransaction();
  
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   

                ModeloPrincipal::find($id)->update($data);
                

                // $Globos = Globos::with('modeloGlobo')->orderBy('activo','DESC')->orderBy('nombre','ASC')->get();
                // foreach ($Globos as $key => $Globo) {
                //     $Globo->peso_botellas = ($Globo->bottom_end) ? $Globo->bottom_end->getPesoBotellasAttribute() : 0;
                //     $Globo->save();
                // }
 

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

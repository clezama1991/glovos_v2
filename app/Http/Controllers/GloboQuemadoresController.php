<?php

namespace App\Http\Controllers;

use App\GloboQuemadores;
use Illuminate\Http\Request;

use App\Models\GloboQuemadores as ModeloPrincipal;
use DB;

class GloboQuemadoresController extends Controller
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

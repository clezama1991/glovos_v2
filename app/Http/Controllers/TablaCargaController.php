<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TablaCarga as ModeloPrincipal;
use App\User;
use DB;
use Hash;


class TablaCargaController extends Controller
{

    public function __construct() {
        $this->middleware('auth'); 
        $this->folder = '/uploads/pilotos'; 
    }
 

    public function listado(){
        
        $records = ModeloPrincipal::select(['modelo_globo','id','fabricante','mtom','min_mtom'])->get();
   
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

        // $data = $request->form;
        $data = collect($request->all())->except('token','file')->toArray(); 

      	try {

            DB::beginTransaction();
 
                if (is_file($request->tabla)) {
                    $file = $request->tabla;        
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('tabla')->move($path_server, $filename); 
                    $data['tabla'] = $path_file; 
                 }
            
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

        $data = collect($request->all())->except('token','file')->toArray(); 

      	try {

            DB::beginTransaction();

                if (is_file($request->tabla)) {
                    $file = $request->tabla;        
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('tabla')->move($path_server, $filename); 
                    $data['tabla'] = $path_file; 
                }
        
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

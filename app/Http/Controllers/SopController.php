<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sop as ModeloPrincipal;
use App\User;
use DB;
use Hash;


class SopController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/zonas'; 
    }
    
    public function index(){
        
        $records = ModeloPrincipal::orderBy('nombre','ASC')->get();
    
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
    
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token','url_file')->toArray(); 
  
      	try {

            DB::beginTransaction();

                if (is_file($request->url_file)) {
                    $file = $request->url_file;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('url_file')->move($path_server, $filename); 
                    $data['url_file'] = $path_file; 
                    $data['name_file'] = $file_name_original; 
                }
             
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   
                $data['codigo'] = ModeloPrincipal::withTrashed()->count() + 1;  
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

        $data = collect($request->all())->except('token','url_file')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
             
                if (is_file($request->url_file)) {
                    $file = $request->url_file;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('url_file')->move($path_server, $filename); 
                    $data['url_file'] = $path_file; 
                    $data['name_file'] = $file_name_original; 
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

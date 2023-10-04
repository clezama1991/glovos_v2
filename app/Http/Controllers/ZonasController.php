<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Zones as ModeloPrincipal;
use App\User;
use DB;
use Hash;


class ZonasController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/zonas'; 
    }
 

    public function listado(){
        
        $records = ModeloPrincipal::whereActivo(1)->orderBy('nombre','ASC')->get();
   
       return response(['records' => $records]);
    
   }
   
    public function index(){
        
        $records = ModeloPrincipal::orderBy('activo','DESC')->orderBy('nombre','ASC')->get();
    
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
        $record->zonas_despegues = $record->zonas_despegues();
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token','file')->toArray(); 
  
      	try {

            DB::beginTransaction();

                if (is_file($request->form_foto)) {
                    $file = $request->form_foto;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_foto')->move($path_server, $filename); 
                    $data['logo'] = $path_file; 
                }
             
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }else{
                        if(in_array($key, ['mensaje_personalizado','mensaje_cancelacion_1','mensaje_cancelacion_2','mensaje_cancelacion_3'])){
                            $data[$key] = html_entity_decode($value);
                        }
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
 
                if (is_file($request->form_foto)) {
                    $file = $request->form_foto;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_foto')->move($path_server, $filename); 
                    $data['logo'] = $path_file; 
                }
         
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }else{
                        if(in_array($key, ['mensaje_personalizado','mensaje_cancelacion_1','mensaje_cancelacion_2','mensaje_cancelacion_3'])){
                            $data[$key] = html_entity_decode($value);
                        }
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

 
	public function ChangeStatus(Request $request) {   
        
        try {

            DB::beginTransaction();

                ModeloPrincipal::where('id',$request->id)->update(['activo'=>$request->activo]);

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

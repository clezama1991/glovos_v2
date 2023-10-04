<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Formularios as ModeloPrincipal;
use App\User;
use DB;
use Hash;


class FormulariosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/zonas'; 
    }
 

    public function listado(){
        
        $records = ModeloPrincipal::whereTipo('formulario')->orderBy('nombre','ASC')->get();
   
       return response(['records' => $records]);
    
   }
   
    // public function index(){
        
    //     $records = ModeloPrincipal::orderBy('activo','DESC')->orderBy('nombre','ASC')->get();
    
    //     return response(['records' => $records]);
     
    // }


    // public function show($id){
        
    //     $record = ModeloPrincipal::whereId($id)->first();
    
    //     return response(['record' => $record]);
    
    // }


    // public function store(Request $request)
    // {

    //     $data = collect($request->all())->except('token','file')->toArray(); 
  
    //   	try {

    //         DB::beginTransaction();

    //             if (is_file($request->form_foto)) {
    //                 $file = $request->form_foto;        
    //                 $file_name_original = $file->getClientOriginalName();
    //                 $filename = uniqid() . '-' .$file->getClientOriginalName(); 
    //                 $path_file = $this->folder.'/'.$filename;  
    //                 $path_server = getcwd().$this->folder;  
    //                 $request->file('form_foto')->move($path_server, $filename); 
    //                 $data['logo'] = $path_file; 
    //             }
             
    //             foreach ($data as $key => $value) {
    //                 if($value=='null'){
    //                     $data[$key] = NULL;
    //                 }
    //             }   
    //             ModeloPrincipal::create($data);

    //         DB::commit();

    //     } catch (\Throwable $e) {

    //         DB::rollback();
           
    //         return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           

    //     }

    //     return response(['result' => true]);

    
    // }



    // public function update(Request $request, $id)
    // {

    //     $data = collect($request->all())->except('token','file')->toArray(); 
  
    //   	try {

    //         DB::beginTransaction();
 
    //             if (is_file($request->form_foto)) {
    //                 $file = $request->form_foto;        
    //                 $file_name_original = $file->getClientOriginalName();
    //                 $filename = uniqid() . '-' .$file->getClientOriginalName(); 
    //                 $path_file = $this->folder.'/'.$filename;  
    //                 $path_server = getcwd().$this->folder;  
    //                 $request->file('form_foto')->move($path_server, $filename); 
    //                 $data['logo'] = $path_file; 
    //             }
         
    //             foreach ($data as $key => $value) {
    //                 if($value=='null'){
    //                     $data[$key] = NULL;
    //                 }
    //             }   
    //            ModeloPrincipal::find($id)->update($data);
 

    //         DB::commit();

    //     } catch (\Throwable $e) {

    //         DB::rollback();

    //         return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
    //     }

    //     return response(['result' => true]);


    // }

 
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
	// public function destroy($id) {   
        
    //     try {

    //         DB::beginTransaction();

    //             ModeloPrincipal::whereId($id)->delete();

    //         DB::commit();

    //     } catch (\Throwable $e) {

    //         DB::rollback();

    //         return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
    //     }

    //     return response(['result' => true]);

    // }

    

}

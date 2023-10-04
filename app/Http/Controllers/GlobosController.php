<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Globos as ModeloPrincipal;
use App\User;
use DB;
use Hash;
use Carbon\Carbon;
use App\Models\TablaCarga;

class GlobosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/pilotos'; 
    }

    public function listado(){
        
        $records = ModeloPrincipal::with('modeloGlobo')->whereActivo(1)->orderBy('nombre','ASC')->get();
             
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date);
     
        foreach ($records as $key => $value) {
             
            if(Carbon::parse($value->arc) < $real_now){
                $value->_rowVariant = 'danger';
            }; 
             
        }
        
        return response(['records' => $records]);
     
    }

    public function index(){
        
        $records = ModeloPrincipal::with('modeloGlobo')->orderBy('activo','DESC')->orderBy('nombre','ASC')->get();
    
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date);
     
        foreach ($records as $key => $value) {

            $value->peso_botellas = ($value->bottom_end) ? $value->bottom_end->getPesoBotellasAttribute() : 0;
            $value->save();
             
            if(Carbon::parse($value->arc) < $real_now){
                $value->_rowVariant = 'danger';
            }; 
  
        }
        
        return response(['records' => $records ]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
    
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
             
                if (is_file($request->form_arc_doc)) {
                    $file = $request->form_arc_doc;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_arc_doc')->move($path_server, $filename); 
                    $data['arc_doc'] = $path_file; 
                }
             
                if (is_file($request->form_cert_matricula)) {
                    $file = $request->form_cert_matricula;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_cert_matricula')->move($path_server, $filename); 
                    $data['cert_matricula'] = $path_file; 
                }
             
                if (is_file($request->form_seguro)) {
                    $file = $request->form_seguro;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_seguro')->move($path_server, $filename); 
                    $data['seguro'] = $path_file; 
                }
            
             
                if (is_file($request->form_certiricado_aeronavegabilidad_doc)) {
                    $file = $request->form_certiricado_aeronavegabilidad_doc;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_certiricado_aeronavegabilidad_doc')->move($path_server, $filename); 
                    $data['certiricado_aeronavegabilidad_doc'] = $path_file; 
                }
            
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   

                $modelo = TablaCarga::whereId($data['modelo_id'])->first();
                $data['modelo'] = $modelo->modelo_globo;

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
            
            
                if (is_file($request->form_arc_doc)) {
                    $file = $request->form_arc_doc;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_arc_doc')->move($path_server, $filename); 
                    $data['arc_doc'] = $path_file; 
                }
            
                if (is_file($request->form_cert_matricula)) {
                    $file = $request->form_cert_matricula;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_cert_matricula')->move($path_server, $filename); 
                    $data['cert_matricula'] = $path_file; 
                }
            
                if (is_file($request->form_seguro)) {
                    $file = $request->form_seguro;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_seguro')->move($path_server, $filename); 
                    $data['seguro'] = $path_file; 
                }
            
                if (is_file($request->form_certiricado_aeronavegabilidad_doc)) {
                    $file = $request->form_certiricado_aeronavegabilidad_doc;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_certiricado_aeronavegabilidad_doc')->move($path_server, $filename); 
                    $data['certiricado_aeronavegabilidad_doc'] = $path_file; 
                }
            
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   
                
                $modelo = TablaCarga::whereId($data['modelo_id'])->first();
                $data['modelo'] = $modelo->modelo_globo;
               ModeloPrincipal::find($id)->update($data);
 

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


    }
 
	public function ChangeStatus(Request $request) 
    {   
        
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

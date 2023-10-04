<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pilotos as ModeloPrincipal;
use App\Models\Vuelos;
use App\User;
use DB;
use Hash;
use Carbon\Carbon;


class PilotosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/pilotos'; 
    }


    public function listado(){
        
        $records = ModeloPrincipal::whereActivo(1)->select('*', DB::raw('CONCAT(nombres, " ", apellidos) AS FullName'))->orderBy('FullName','ASC')->get();
        foreach ($records as $key => $value) {
            $value->fechas_caducadas = $value->fechas_caducadas();
        }
        return response(['records' => $records]);
     
    }
    
    public function index(){
        
        $records = ModeloPrincipal::
        select('*', DB::raw('CONCAT(nombres, " ", apellidos) AS FullName'))
        ->orderBy('activo','DESC')
        ->orderBy('FullName','ASC')
        ->get();
         
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date);
        $ago_3_years = Carbon::create($date)->subYears(3);
        $ago_4_years = Carbon::create($date)->subYears(4);

        foreach ($records as $key => $value) {
             
            if(Carbon::parse($value->cert_medico) < $real_now){
                $value->_rowVariant = 'danger';
                
            }; 
             
            if(Carbon::parse($value->cert_incendio) < $ago_3_years){
                $value->_rowVariant = 'danger';
            }; 
             
            if(Carbon::parse($value->cert_primeros_auxilios) < $ago_3_years){
                $value->_rowVariant = 'danger';
            }; 
             
            if(Carbon::parse($value->vuelo_if) < $ago_4_years){
                $value->_rowVariant = 'danger';
            }; 
            
            $value->estatus_entrenamientos = (count($value->entrenamientos)==0) ? 'Sin Asignar' : (($value->entrenamientos_pendientes())?'Pendientes':'Al dia');
            
            if($value->estatus_entrenamientos=='Pendientes'){
                $value->_rowVariant = 'danger';
            }; 
            
        }
    
        return response(['records' => $records,'real_now'=>$real_now,'ago_3_years'=>$ago_3_years]);
    
    
    }

    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
    
        return response(['record' => $record]);
    
    }

    public function piloto_con_entrenamineto($id){
        
        $record = ModeloPrincipal::whereId($id)->with(['entrenamientos'])->first();
        foreach ($record->entrenamientos as $key => $value) {
            $detail_globo = null;

            if($value->globo){
                $detail_globo = $value->globo->modelo.' '. $value->globo->fabricante.' '. $value->globo->modelo;
            }else{
                $detail_globo = $value->modelo_globo.' '. $value->marca_globo.' '. $value->matricula_globo;
            }
            $value->detail_globo = $detail_globo;
        }
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token','file')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
                if (is_file($request->form_doc_licencia)) {
                    $file = $request->form_doc_licencia;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_doc_licencia')->move($path_server, $filename); 
                    $data['licencia_doc'] = $file_name_original; 
                    $data['licencia_doc_path'] = $path_file; 
                }
             
                if (is_file($request->form_cert_medico)) {
                    $file = $request->form_cert_medico;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_cert_medico')->move($path_server, $filename); 
                    $data['cert_medico_doc'] = $file_name_original; 
                    $data['cert_medico_doc_path'] = $path_file; 
                }
                
                if (is_file($request->form_cert_incendio)) {
                    $file = $request->form_cert_incendio;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_cert_incendio')->move($path_server, $filename); 
                    $data['cert_incendio_doc'] = $file_name_original; 
                    $data['cert_incendio_doc_path'] = $path_file; 
                }
             
                if (is_file($request->form_cert_primeros_auxilios)) {
                    $file = $request->form_cert_primeros_auxilios;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_cert_primeros_auxilios')->move($path_server, $filename); 
                    $data['cert_primeros_auxilios_doc'] = $file_name_original; 
                    $data['cert_primeros_auxilios_doc_path'] = $path_file; 
                }
            
                if (is_file($request->form_url_firma_digital)) {
                    $file = $request->form_url_firma_digital;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_url_firma_digital')->move($path_server, $filename); 
                    $data['url_firma_digital'] = $path_file; 
                }
            
             
                if (is_file($request->form_vuelo_if)) {
                    $file = $request->form_vuelo_if;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_vuelo_if')->move($path_server, $filename); 
                    $data['vuelo_if_doc'] = $file_name_original; 
                    $data['vuelo_if_doc_path'] = $path_file; 
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

        return response(['result' => true,'mensaje'=>'Piloto Registrado Con Exito']);

    
    }



    public function update(Request $request, $id)
    {

        $data = collect($request->all())->except('token','file')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
                if (is_file($request->form_doc_licencia)) {
                    $file = $request->form_doc_licencia;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_doc_licencia')->move($path_server, $filename); 
                    $data['licencia_doc'] = $file_name_original; 
                    $data['licencia_doc_path'] = $path_file; 
                }
             
                if (is_file($request->form_cert_medico)) {
                    $file = $request->form_cert_medico;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_cert_medico')->move($path_server, $filename); 
                    $data['cert_medico_doc'] = $file_name_original; 
                    $data['cert_medico_doc_path'] = $path_file; 
                }
                
                if (is_file($request->form_cert_incendio)) {
                    $file = $request->form_cert_incendio;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_cert_incendio')->move($path_server, $filename); 
                    $data['cert_incendio_doc'] = $file_name_original; 
                    $data['cert_incendio_doc_path'] = $path_file; 
                }
             
                if (is_file($request->form_cert_primeros_auxilios)) {
                    $file = $request->form_cert_primeros_auxilios;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_cert_primeros_auxilios')->move($path_server, $filename); 
                    $data['cert_primeros_auxilios_doc'] = $file_name_original; 
                    $data['cert_primeros_auxilios_doc_path'] = $path_file; 
                }

                if (is_file($request->form_url_firma_digital)) {
                    $file = $request->form_url_firma_digital;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_url_firma_digital')->move($path_server, $filename); 
                    $data['url_firma_digital'] = $path_file; 
                }
            
                if (is_file($request->form_vuelo_if)) {
                    $file = $request->form_vuelo_if;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('form_vuelo_if')->move($path_server, $filename); 
                    $data['vuelo_if_doc'] = $file_name_original; 
                    $data['vuelo_if_doc_path'] = $path_file; 
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

        return response(['result' => true,'mensaje'=>'Piloto Actualizado Con Exito']);


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
 
        return response(['result' => true,'mensaje'=>'Estado Actualizado Con Exito']);


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

        return response(['result' => true,'mensaje'=>'Piloto Eliminado Con Exito']);

    }

    public function validate_pin_piloto(Request $request)
    {

        $token_piloto = null;

        $Vuelos = Vuelos::whereId($request->id)->first();

        if($Vuelos){
            $token_piloto = $Vuelos->piloto->pin;
        }

        if($token_piloto == $request->pin){            
            return response(['result' => '1']);
         }

         return response(['result' => '0']);

    }
    

}

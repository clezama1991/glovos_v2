<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ComunicacionRiesgos as ModeloPrincipal;
use App\Models\EvaluacionRiesgos;
use App\Models\VerificacionCambios;
use App\User;
use DB;
use Hash;
use Carbon\Carbon;


class RiesgosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/pilotos'; 
    }


    public function listado(){
        
         $records = ModeloPrincipal::whereActivo(1)->select('*', DB::raw('CONCAT(nombres, " ", apellidos) AS FullName'))->orderBy('FullName','ASC')->get();

        
        
        return response(['records' => $records]);
     
    }
    
    public function index(){
        
        $real_now = Carbon::now();
     
        $records = ModeloPrincipal::
        orderBy('codigo','desc')
        ->get();
        foreach ($records as $key => $value) {
            $rowVariant = '';
            switch ($value->estado) {
                case 'Abierto':
                    $rowVariant = 'secondary';
                    break;
                
                case 'Completado':
                    $rowVariant = 'success';
                    break;
            
                case 'Seguimiento':
                    $rowVariant = 'primary';
                    break;
        
                case 'Seguimiento fecha vencida':
                    $rowVariant = 'danger';
                    break;
    
                case 'Cerrado':
                    $rowVariant = 'warning';
                    break;
                            
                default:
                    # code...
                    break;
            } 
             
            $value->_rowVariant = $rowVariant; 
            
            if($value->evaluacion && !is_null($value->evaluacion->fecha_seguimiento_control) && Carbon::parse($value->evaluacion->fecha_seguimiento_control) < $real_now){
                $value->_rowVariant = 'danger';
            }; 
              
        } 
    
        return response(['records' => $records]);
     
    }

    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();

        $eval_form = EvaluacionRiesgos::where('comunicacion_id',$id)->first();

        $verif_form = VerificacionCambios::where('comunicacion_id',$id)->first();

        return response(['record' => $record,'eval_form' => $eval_form,'verif_form' => $verif_form]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->only('fecha','estado','nombres_notificante','cargo_responsabilidad_notificante','descripción_suceso','medidas_correctivas','nombres_responsable')->toArray(); 
      
      	try {

            DB::beginTransaction();
  
                if (is_file($request->url_firma_notificante)) {
                    $file = $request->url_firma_notificante;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('url_firma_notificante')->move($path_server, $filename); 
                    $data['url_firma_notificante'] = $path_file; 
                }
             
  
                if (is_file($request->url_firma_responsable)) {
                    $file = $request->url_firma_responsable;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('url_firma_responsable')->move($path_server, $filename); 
                    $data['url_firma_responsable'] = $path_file; 
                }
             
  
                if (is_file($request->url_documentos_sucesos)) {
                    $file = $request->url_documentos_sucesos;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('url_documentos_sucesos')->move($path_server, $filename); 
                    $data['url_documentos_sucesos'] = $path_file; 
                }
             
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }                
                $data['codigo'] = ModeloPrincipal::withTrashed()->count() + 1;    
                $riesgo = ModeloPrincipal::create($data);
                
                $data_eval_form['comunicacion_id'] = $riesgo->id;                 
                EvaluacionRiesgos::create($data_eval_form);
                
                $data_verif_form['comunicacion_id'] = $riesgo->id; 
                VerificacionCambios::create($data_verif_form);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           

        }

        return response(['result' => true]);

    
    }



    public function update(Request $request, $id)
    {

        $data = collect($request->all())->only('codigo','fecha','estado','nombres_notificante','cargo_responsabilidad_notificante','descripción_suceso','medidas_correctivas','nombres_responsable')->toArray(); 
        $data_eval_form = collect($request->all())->only('origen_metodo','fecha','descripcion','naturaleza','ri_probabilidad','ri_severidad','ri_valor1','medidas_mitigacion','rf_probabilidad','rf_severidad','rf_valor1','fecha_efectividad','fecha_implementacion','fecha_seguimiento_control','responsable','ref_documentacion','notas')->toArray(); 
        $data_verif_form = collect($request->all())->only('fecha','nro_informe','nro_referencia','validacion_efectuo_cambio','validacion_impacto_se_mantiene','validacion_comunicacion_cambio','validacion_medida_mitigacion','observaciones','verificado_responsable','verificado_cargo_responsable','fecha_rev_2','nro_informe_rev_2','nro_referencia_rev_2','validacion_efectuo_cambio_rev_2','validacion_impacto_se_mantiene_rev_2','validacion_comunicacion_cambio_rev_2','validacion_medida_mitigacion_rev_2','observaciones_rev_2','verificado_responsable_rev_2','verificado_cargo_responsable_rev_2')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
              
                if (is_file($request->url_firma_notificante)) {
                    $file = $request->url_firma_notificante;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('url_firma_notificante')->move($path_server, $filename); 
                    $data['url_firma_notificante'] = $path_file; 
                }
             
  
                if (is_file($request->url_firma_responsable)) {
                    $file = $request->url_firma_responsable;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('url_firma_responsable')->move($path_server, $filename); 
                    $data['url_firma_responsable'] = $path_file; 
                }
             
  
                if (is_file($request->url_documentos_sucesos)) {
                    $file = $request->url_documentos_sucesos;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('url_documentos_sucesos')->move($path_server, $filename); 
                    $data['url_documentos_sucesos'] = $path_file; 
                }
             
            
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   
                ModeloPrincipal::find($id)->update($data);
            
                foreach ($data_eval_form as $key => $value) {
                    if($value=='null'){
                        $data_eval_form[$key] = NULL;
                    }
                }   
                EvaluacionRiesgos::where('comunicacion_id',$id)->update($data_eval_form);
            
                foreach ($data_verif_form as $key => $value) {
                    if($value=='null'){
                        $data_verif_form[$key] = NULL;
                    }
                }   
                VerificacionCambios::where('comunicacion_id',$id)->update($data_verif_form);
 

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

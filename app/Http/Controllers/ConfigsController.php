<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracionPlataforma as ModelPrincipal;
use App\Models\BitacorasCron;
use Illuminate\Http\Request;
use DB;

class ConfigsController extends Controller
{
 
    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads'; 
    }
    public function index()
    {
        //
        $records = ModelPrincipal::where('visible',1)->get()->groupBy('grupo')->toArray();
  
        return response(['records' => $records]);

    }
    
    public function configs_by_grupo($grupo)
    { 
        $records = ModelPrincipal::where('grupo',$grupo)->get()->groupBy('grupo')->toArray();  
        return response(['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function show($key)
    {
        $records = ModelPrincipal::where('key',$key)->first();
        return response(['records' => $records]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $data = collect($request->formulario)->toArray();
      	try {

            DB::beginTransaction();

                ModelPrincipal::create($data);
                
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = collect($request->formulario)->except('_method','logo_publicidad')->toArray();

      	try {

            DB::beginTransaction();

                if (is_file($request->logo_publicidad)) {
                    $file = $request->logo_publicidad;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('logo_publicidad')->move($path_server, $filename); 
                    $data['logo_publicidad'] = $path_file; 
                                    
                    $banner = ModelPrincipal::where('key','banner_publicidad')->first();
                    $banner->valor = $path_file;
                    $banner->save();
                }

                $ModelPrincipal = ModelPrincipal::where('id',$id)->first();
                $ModelPrincipal->valor = $request->valor;
                $ModelPrincipal->save();


            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
 
	public function destroy($id) {   
        
        try {

            DB::beginTransaction();

                ModelPrincipal::whereId($id)->delete();

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

    
    public function update_configs(Request $request)
    {
        $data = collect($request->all())->toArray();

      	try {

            DB::beginTransaction();

                $records = ModelPrincipal::get();

                foreach ($records as $key => $value) {
                    if(isset($data[$value->key]))
                    {
                                 
                        if($value->tipo!='file'){

                            $value->valor = ($data[$value->key]=='null')?NULL: html_entity_decode($data[$value->key]);

                        }else{

                            $files_up = $data[$value->key];
                            if (is_file($files_up)) {
                                $file = $files_up;        
                                $file_name_original = $file->getClientOriginalName();
                                $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                                $path_file = $this->folder.'/'.$filename;  
                                $path_server = getcwd().$this->folder;  
                                $request->file($value->key)->move($path_server, $filename); 
                                $value->valor = $path_file; 
                            }
                            
                        }

                        $value->save();

                    }   
                } 

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);

    }

    
    public function crons()
    { 
        $records = BitacorasCron::orderBy('id','DESC')->get();  
        return response(['records' => $records]);
    }
    

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GloboDiferidos as ModeloPrincipal;
use App\Models\GloboCuadricula;
use App\User;
use DB;
use Hash;
use Auth;



class DiferidosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/diferidos'; 
    }
     
   
    public function index($id){
        
        $records = ModeloPrincipal::where('globo_cuadricula_id',$id)->get();
    
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
    
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token')->toArray(); 
  
      	try {

            DB::beginTransaction();
            
                if (is_file($request->adjunto1)) {
                    $file = $request->adjunto1;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('adjunto1')->move($path_server, $filename); 
                    $data['adjunto1'] = $path_file; 
                }
                if (is_file($request->adjunto2)) {
                    $file = $request->adjunto2;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('adjunto2')->move($path_server, $filename); 
                    $data['adjunto2'] = $path_file; 
                } 
                if (is_file($request->adjunto3)) {
                    $file = $request->adjunto3;        
                    $file_name_original = $file->getClientOriginalName();
                    $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                    $path_file = $this->folder.'/'.$filename;  
                    $path_server = getcwd().$this->folder;  
                    $request->file('adjunto3')->move($path_server, $filename); 
                    $data['adjunto3'] = $path_file; 
                }
                
                $data['creado_por'] = Auth::user()->id;
                
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   

                $ModeloPrincipal = ModeloPrincipal::create($data);

                GloboCuadricula::where('id',$ModeloPrincipal->globo_cuadricula_id)->update(
                    [
                        'fondo' => $ModeloPrincipal->fondo
                    ]
                );

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           

        }

        return response(['result' => true]);

    
    }



    public function update(Request $request, $id)
    {

        $data = collect($request->all())->except('token','_method')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
            if (is_file($request->adjunto1)) {
                $file = $request->adjunto1;        
                $file_name_original = $file->getClientOriginalName();
                $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                $path_file = $this->folder.'/'.$filename;  
                $path_server = getcwd().$this->folder;  
                $request->file('adjunto1')->move($path_server, $filename); 
                $data['adjunto1'] = $path_file; 
            }
            if (is_file($request->adjunto2)) {
                $file = $request->adjunto2;        
                $file_name_original = $file->getClientOriginalName();
                $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                $path_file = $this->folder.'/'.$filename;  
                $path_server = getcwd().$this->folder;  
                $request->file('adjunto2')->move($path_server, $filename); 
                $data['adjunto2'] = $path_file; 
            } 
            if (is_file($request->adjunto3)) {
                $file = $request->adjunto3;        
                $file_name_original = $file->getClientOriginalName();
                $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                $path_file = $this->folder.'/'.$filename;  
                $path_server = getcwd().$this->folder;  
                $request->file('adjunto3')->move($path_server, $filename); 
                $data['adjunto3'] = $path_file; 
            }
 
            if (is_file($request->solucionadoadjunto1)) {
                $file = $request->solucionadoadjunto1;        
                $file_name_original = $file->getClientOriginalName();
                $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                $path_file = $this->folder.'/'.$filename;  
                $path_server = getcwd().$this->folder;  
                $request->file('solucionadoadjunto1')->move($path_server, $filename); 
                $data['solucionadoadjunto1'] = $path_file; 
            }
            if (is_file($request->solucionadoadjunto2)) {
                $file = $request->solucionadoadjunto2;        
                $file_name_original = $file->getClientOriginalName();
                $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                $path_file = $this->folder.'/'.$filename;  
                $path_server = getcwd().$this->folder;  
                $request->file('solucionadoadjunto2')->move($path_server, $filename); 
                $data['solucionadoadjunto2'] = $path_file; 
            } 
            if (is_file($request->solucionadoadjunto3)) {
                $file = $request->solucionadoadjunto3;        
                $file_name_original = $file->getClientOriginalName();
                $filename = uniqid() . '-' .$file->getClientOriginalName(); 
                $path_file = $this->folder.'/'.$filename;  
                $path_server = getcwd().$this->folder;  
                $request->file('solucionadoadjunto3')->move($path_server, $filename); 
                $data['solucionadoadjunto3'] = $path_file; 
            }
             
            foreach ($data as $key => $value) {
                if($value=='null'){
                    unset($data[$key]);
                    // $data[$key] = NULL;
                }
            }   

            $ModeloPrincipal = ModeloPrincipal::whereId($id)->first();
            $ModeloPrincipal->update($data);
 
            GloboCuadricula::where('id',$ModeloPrincipal->globo_cuadricula_id)->update(
                [
                    'fondo' => $ModeloPrincipal->fondo
                ]
            );
 
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

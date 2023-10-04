<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Checklist as ModeloPrincipal;
use App\Models\Checklist;
use App\User;
use DB;
use Hash;


class ChecklistsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function listado(){
        
        $ListPasajeros = ModeloPrincipal::
            where('activo',true)
            ->where('tipo','pasajero')
            ->orderBy('orden','ASC')->get();

        $ListPilotos = ModeloPrincipal::
            where('activo',true)            
            ->where('tipo','piloto')
            ->orderBy('orden','ASC')->get();
   
       return response(['ListPasajeros' => $ListPasajeros, 'ListPilotos' => $ListPilotos ]);
    
   }
   
    public function index(){
        
        $ListPasajeros = ModeloPrincipal::
            where('activo',true)
            ->where('tipo','pasajero')
            ->orderBy('orden','ASC')->get();

        $ListPilotos = ModeloPrincipal::
            where('activo',true)            
            ->where('tipo','piloto')
            ->orderBy('orden','ASC')->get();
   
       return response(['ListPasajeros' => $ListPasajeros, 'ListPilotos' => $ListPilotos ]);
    
     
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
                $data['activo'] = ($data['activo']=='true') ? true : false;
                $data['orden'] = ModeloPrincipal::where('tipo',$data['tipo'])->count()+1;
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

        $data = collect($request->all())->except('token')->toArray(); 
  
      	try {

            DB::beginTransaction();
            
            $checklist = ModeloPrincipal::find($id);

            if(isset($data['accion'])){
                
                $orden_old = $checklist->orden;

                if($data['accion']=='up'){

                    $data['orden'] = $checklist->orden - 1;

                }else{

                    $data['orden'] = $checklist->orden + 1;

                }


                ModeloPrincipal::where('tipo', $checklist->tipo)->where('orden',$data['orden'])->update([
                    'orden' => $orden_old
                ]);

            }else{

                $data['activo'] = ($data['activo']=='true') ? true : false;

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

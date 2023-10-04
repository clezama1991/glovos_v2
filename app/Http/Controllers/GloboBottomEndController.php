<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GloboBottomEnd as ModeloPrincipal;
use App\Models\GloboCestas;
use App\Models\GloboQuemadores;
use App\Models\GloboBotellas;
use App\Models\Globos;
use App\Models\GloboBottomEndBotellas;
use DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class GloboBottomEndController extends Controller
{
    public function __construct() {
        $this->middleware('auth'); 
    }
 

    public function listado(){
        
        $records = ModeloPrincipal::get();
        foreach ($records as $key => $value) {
            $value->peso_cesta = $value->cesta->peso;
            $value->peso_quemador = $value->quemador->peso;
        }
       return response(['records' => $records]);
    
   }
   
    public function index(){
        
        $records = ModeloPrincipal::with(['cesta','quemador'])->get(); 
        foreach ($records as $key => $value) {
            $value->globos = $value->globos();
            $value->botellas = $value->botellas();
        }
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
    
        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = $request->formulario; 
  
      	try {

            DB::beginTransaction();
  
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   
 
                $ModeloPrincipal = ModeloPrincipal::create($data);

                foreach ($data['botella_id'] ?? [] as $key => $value) {
                    GloboBottomEndBotellas::create([
                        'bottom_end_id' => $ModeloPrincipal->id,
                        'botella_id' => $value,
                    ]);
                }



            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           

        }

        return response(['result' => true]);

    
    }



    public function update(Request $request, $id)
    {

        $data = $request->formulario; 
  
      	try {

            DB::beginTransaction();
  
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   

                $Cestas = GloboCestas::whereId($data['cesta_id'])->first();
                $Quemadores = GloboQuemadores::whereId($data['quemador_id'])->first();
                $Botellas = GloboBotellas::whereIn('id',$data['botella_id'])->pluck('modelo')->toArray();

                $data['bottom_end'] = $Cestas->modelo.' '.$Quemadores->modelo.' ('.implode(", ", $Botellas).' )';

                ModeloPrincipal::find($id)->update($data);
  
   
                $Globos = Globos::with('modeloGlobo')->orderBy('activo','DESC')->orderBy('nombre','ASC')->get();
                foreach ($Globos as $key => $Globo) {
                    $Globo->peso_botellas = ($Globo->bottom_end) ? $Globo->bottom_end->getPesoBotellasAttribute() : 0;
                    $Globo->save();
                }
                 
                
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

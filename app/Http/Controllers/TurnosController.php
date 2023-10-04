<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Turnos as ModeloPrincipal;
use App\User;
use DB;
use Hash;


class TurnosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function listado(){
        
        $records = ModeloPrincipal::get();
   
       return response(['records' => $records]);
    
   }
   
    public function index(){
        
        $records = ModeloPrincipal::get();
    
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

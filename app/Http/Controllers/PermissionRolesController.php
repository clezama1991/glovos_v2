<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;
use Auth;
use \Spatie\Permission\Models\Role  as ModeloPrincipal;


class PermissionRolesController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function listado(){
        
        $records = ModeloPrincipal::where('active',true)->get();
   
       return response(['records' => $records]);
    
   }
   
    public function index(){

        $records = ModeloPrincipal::get();

        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
        $record['permission'] = $record->getPermissionNames();

        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token','permission')->toArray(); 
  
      	try {

            DB::beginTransaction(); 

                $data['name'] = str_replace(' ', '_' , strtolower($data['title'])).''.rand(0,999);
 
                $role = ModeloPrincipal::create($data);
                $role->syncPermissions( explode(',', $request->permission )); 
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
            $data['active'] = ($data['active'] == 'false') ? false : true;
            $role = ModeloPrincipal::find($id)->update($data); 

            ModeloPrincipal::find($id)->syncPermissions( explode(',', $request->permission )); 

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

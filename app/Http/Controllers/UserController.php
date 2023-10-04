<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User as ModeloPrincipal;
use DB;
use Hash;
use Auth;


class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->folder = '/uploads/zonas'; 
    }

   
    public function index(){

        $records = ModeloPrincipal::get();
        foreach ($records as $key => $value) {
            $value['rol'] = $value->roles->pluck('title');
        }
        return response(['records' => $records]);
     
    }

   
    public function index_old(){

        $id = Auth::user()->id;
        $records = ModeloPrincipal::where('id',$id)->first();
    
        return response(['records' => $records]);
     
    }


    public function show($id){
        
        $record = ModeloPrincipal::whereId($id)->first();
        $record['rol'] = $record->getRoleNames();

        return response(['record' => $record]);
    
    }


    public function store(Request $request)
    {

        $data = collect($request->all())->except('token','rol')->toArray(); 
  
      	try {

            DB::beginTransaction();

                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   
                $data['password'] = Hash::make($data['password']);
                $user = ModeloPrincipal::create($data);
                $user->assignRole( explode(',', $request->rol ) );
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
           
            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           

        }

        return response(['result' => true]);

    
    }



    public function update(Request $request, $id)
    {

        $data = collect($request->all())->except('token','rol')->toArray(); 
  
      	try {

            DB::beginTransaction();
 
                foreach ($data as $key => $value) {
                    if($value=='null'){
                        $data[$key] = NULL;
                    }
                }   
                if(isset($data['password']) && !is_null($data['password']) && $data['password']!=''){
                    $data['password'] = Hash::make($data['password']);
                }

               ModeloPrincipal::find($id)->update($data);
 
               ModeloPrincipal::find($id)->assignRole( explode(',', $request->rol ) );

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);


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

    
    public function actualizar_password(Request $request )
    {
        try {

            DB::beginTransaction();

            $id = Auth::user()->id;
            $user = ModeloPrincipal::whereId($id)->update([
                'password' => Hash::make($request->password)
            ]);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]);
    }


}

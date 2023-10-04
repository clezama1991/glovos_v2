<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class RegistersUsersController extends Controller
{


    use AuthenticatesUsers;
    //
    protected function create(Request $request)
    {




        try {
            DB::beginTransaction();
                $user = User::withTrashed()->where('email',$request->email)->first();
                if($user){
                   if(!is_null($user->deleted_at) ){
                        return response(['return_result' => 'email_existe_no_verificado']);
                    }else{
                        return response(['return_result' => 'email_existe']);
                    }
                }


                $user = User::create([
                    'name' => $request->user,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    // 'import_export' => $import_export,
                    'verification_code' => Str::random(20),
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);

                $data['verification_code']  = $user->verification_code;
                $data['subject'] = 'Verificar Cuenta';
                $data['email'] = $request->email;
                $data['name'] = $request->user;
        


                Mail::send('emails.auth', $data, function($message) use ($data) {
                    $message->from('noreplay@stepbystepl.com', 'Step By Step')->to($data['email'],$data['name'])->subject($data['subject']);
                });
                
                return response(['email' => $request->email, 'return_result' => 'registro_aprovado']);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                dd($th);
                return response(['email' => $request->email, 'return_result' => 'registro_error']);
            }

    }

}

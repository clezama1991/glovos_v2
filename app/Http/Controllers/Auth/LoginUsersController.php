<?php

namespace App\Http\Controllers\Auth;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginUsersController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }



    //
    protected function create(Request $request)
    {

        $user = User::where('email',$request->email)->first();
        if( !$user ){
            return response(['registrado' => false,'verificado' => false]);
        }else{

            if(is_null($user->email_verified_at)){

                return response(['registrado' => true,'verificado' => false]);
            }
            else{
                if(!Hash::check($request->password, $user->password)){
                    return response(['registrado' => false,'verificado' => false]);
                }
            }
            auth()->login($user, true);
			return response(['registrado' => true,'verificado' => true,'usuario' => $user]);
        }


    }

    // public function redirectTo() {
    //     if(Auth::user()->hasRolePermission('super_admin')) {
    //         return 'dashboard';
    //     } else {
    //         return '/dd';
    //     }
    // }

}

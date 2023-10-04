<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UsersDatos;

use Spatie\Permission\Traits\HasRoles;
use LaravelAndVueJS\Traits\LaravelPermissionToVueJS;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;
    use LaravelPermissionToVueJS;


    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
 
    public function Nick()
    {
        return substr($this->name,0,1);
    }
    
    public function datos_personales()
    {
        return $this->belongsTo(UsersDatos::class, 'id', 'id_usuario');
    }


    public function is_client()
    {
        return ($this->datos_personales)?$this->datos_personales->empresa_id?true:false:false;
    }

    public function my_enterprise()
    {
        return ($this->datos_personales)?$this->datos_personales->empresa:false;
    }



    protected $fillable = [
        'rol','name', 'email', 'password','verification_code','email_verified_at','habilitado','deleted_at', 'google_id'
    ];

     
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForWhatsApps()
    {
      return $this->phone_number;
    }
 
}

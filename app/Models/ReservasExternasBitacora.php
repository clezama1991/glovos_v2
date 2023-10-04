<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ReservasExternasBitacora extends Model
{
    protected $table = 'reservas_externas_bitacoras';

    protected $fillable = [
        'reserva_externa_id',
        'user_id',
        'estatus',
        'observacion'
    ];

    public static function last()
    {
        return self::latest()->first();
    }
 
    public function reserva()
    {
        return $this->belongsTo(ReservasExternas::class, 'reserva_externa_id', 'id')->withTrashed();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }
    

}

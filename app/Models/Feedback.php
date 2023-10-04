<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
 
    protected $fillable = [
        'user_id',
        'titulo',
        'status',
        'feedback',
        'notas',
    ];

}
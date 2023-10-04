<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vuelosChecklists extends Model
{
    
    protected $table = 'vuelos_checklists';

    protected $fillable = [
        'checklist_id', 
        'checked_list', 
        'user_id', 
        'vuelo_id', 
    ];

}
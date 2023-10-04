<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Globos;

class GloboBottomEndBotellas extends Model
{
    protected $table = 'globo_bottom_ends_bolletas';


    protected $fillable = [
        'bottom_end_id',
        'botella_id',
    ];

    public function botellas()
    { 
        return $this->belongsTo(GloboBotellas::class, 'id', 'botella_id')->withTrashed();
    }
}

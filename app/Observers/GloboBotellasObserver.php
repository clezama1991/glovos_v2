<?php

namespace App\Observers;

use App\Models\GloboBotellas;
use Carbon\Carbon;

class GloboBotellasObserver
{
    /**
     * Handle the GloboBotellas "created" event.
     */
    public function creating(GloboBotellas $globoBotellas): void
    {
        if(!$this->vigencia_fechas($globoBotellas)){
            $globoBotellas->variant = 'danger';
            $globoBotellas->estatus = 'Vencido';                
        }     
    }

    /**
     * Handle the GloboBotellas "updated" event.
     */
    public function updating(GloboBotellas $globoBotellas): void
    {
        if(!$this->vigencia_fechas($globoBotellas)){
            $globoBotellas->variant = 'danger';
            $globoBotellas->estatus = 'Vencido';
        }else{
            $globoBotellas->variant = null;
            $globoBotellas->estatus = null;
        }
 
    }
   
    public function vigencia_fechas($globoBotellas){
        
        $vigencia = true;

        $date = date('Y-m-d'); 
        $ago_1_years = Carbon::create($date)->subYears(1);
        $ago_10_years = Carbon::create($date)->subYears(10);
          
        if(Carbon::parse($globoBotellas->CRS) < $ago_1_years || Carbon::parse($globoBotellas->PVR) < $ago_10_years){            
            $vigencia = false;
        } 

        return $vigencia;

    }

}

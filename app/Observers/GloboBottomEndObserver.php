<?php

namespace App\Observers;

use App\Models\GloboBottomEnd;

class GloboBottomEndObserver
{
    /**
     * Handle the GloboBottomEnd "created" event.
     */
    public function created(GloboBottomEnd $globoBottomEnd): void
    {

        // $Botellas = $globoBottomEnd->botellas_pivot->botellas->pluck('modelo')->toArray();
        $Botellas = $globoBottomEnd->botellas_pivot;


        dd($Botellas);

        $data['bottom_end'] = $globoBottomEnd->cesta->modelo.' '.$globoBottomEnd->quemador->modelo.' ('.implode(", ", $Botellas).' )';

        



    }

    /**
     * Handle the GloboBottomEnd "updated" event.
     */
    public function updated(GloboBottomEnd $globoBottomEnd): void
    {
        //
    }

    /**
     * Handle the GloboBottomEnd "deleted" event.
     */
    public function deleted(GloboBottomEnd $globoBottomEnd): void
    {
        //
    }

    /**
     * Handle the GloboBottomEnd "restored" event.
     */
    public function restored(GloboBottomEnd $globoBottomEnd): void
    {
        //
    }

    /**
     * Handle the GloboBottomEnd "force deleted" event.
     */
    public function forceDeleted(GloboBottomEnd $globoBottomEnd): void
    {
        //
    }
}

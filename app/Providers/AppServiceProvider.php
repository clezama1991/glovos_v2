<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Models\ComunicacionRiesgos;
use App\Models\Pilotos;
use Carbon\Carbon;
use App\Models\Globos;
use App\Models\Vuelos;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        date_default_timezone_set('America/Caracas');
        Carbon::setUTF8(true);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
        
        Schema::defaultStringLength(191);
        
        view()->composer('*', function ($view) 
        {
            if(Auth::check()) {

                $real_now = Carbon::now();
                $riesgos = ComunicacionRiesgos::
                where('estado','!=','Cerrado')
                ->whereHas('evaluacion',function($query) use ($real_now){
                    $query->where('fecha_seguimiento_control','<',$real_now);
                })
                ->get();
                  
                     
                $date = date('Y-m-d'); 
                $real_now = Carbon::create($date);
                $globos = Globos::whereActivo(1)->where('arc','<', $date)->orderBy('nombre','ASC')->get();

                $pilotos_fechas_caducadas = [];
                $Pilotos = Pilotos::get();
                foreach ($Pilotos as $key => $value) {
                    if($value->fechas_caducadas()){
                        $pilotos_fechas_caducadas[] = $value;
                    }
                }
                
                $multimedias_caducados = Vuelos::whereMultimedia(1)->where('multimedia_caduca','<', $date)->orderBy('multimedia_caduca','ASC')->get();

                $view->with('pilotos_fechas_caducadas', $pilotos_fechas_caducadas);
                $view->with('riesgos', $riesgos);
                $view->with('globos', $globos);
                $view->with('multimedias_caducados', $multimedias_caducados);
            }
        });
    }
}

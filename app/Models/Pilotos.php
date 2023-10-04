<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Pilotos extends Model
{
	
    use SoftDeletes;

    protected $table = 'pilotos';

    protected $fillable = [
        'nombres',
        'apellidos',
        'dni',
        'telefono',
        'email',
        'peso',
        'direccion',
        'licencia',
        'licencia_doc',
        'licencia_doc_path',
        'cert_medico',
        'cert_medico_doc',
        'cert_medico_doc_path',
        'cert_incendio',
        'cert_incendio_doc',
        'cert_incendio_doc_path',
        'cert_primeros_auxilios',
        'cert_primeros_auxilios_doc',
        'cert_primeros_auxilios_doc_path',
        'nota',
        'vuelo_if',
        'vuelo_if_doc',
        'vuelo_if_doc_path',
        'experiencia_reciente',
        'experiencia_reciente_doc',
        'hab_cautivos',
        'hab_nocturnos',
        'habilitacion_nivel',
        'url_firma_digital',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->nombres . ' ' . $this->apellidos;
    }

    public function entrenamientos()
    {
        return $this->hasMany(PilotosEntrenamientos::class, 'piloto_id', 'id')->with(['globo','formulario']);
    }

    public function entrenamientos_pendientes()
    {
        $pendientes = false;
        foreach ($this->entrenamientos as $value) {            
            if($value->estatus=='Asignado'){
                $pendientes = true;
            }
        }
        return $pendientes;
    }

    public function fechas_caducadas()
    {
        $fechas_caducadas = false;
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date);
        $ago_3_years = Carbon::create($date)->subYears(3);
        $ago_4_years = Carbon::create($date)->subYears(4);
         
        if(Carbon::parse($this->cert_medico) < $real_now){
            $fechas_caducadas = true;
            
        }; 
         
        if(Carbon::parse($this->cert_incendio) < $ago_3_years){
            $fechas_caducadas = true;
        }; 
         
        if(Carbon::parse($this->cert_primeros_auxilios) < $ago_3_years){
            $fechas_caducadas = true; 
        }; 
         
        if(Carbon::parse($this->vuelo_if) < $ago_4_years){
            $fechas_caducadas = true;
        }; 

        return $fechas_caducadas;
    }

}

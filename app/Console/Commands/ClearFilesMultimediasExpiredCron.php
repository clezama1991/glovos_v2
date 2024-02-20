<?php

namespace App\Console\Commands;

use App\Models\Multimedias;
use Illuminate\Console\Command;
use App\Models\Vuelos as ModeloPrincipal;
use App\Models\BitacorasCron;
use Carbon\Carbon;

class ClearFilesMultimediasExpiredCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clearfiles:multimediascaducados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {    
        $date = date('Y-m-d'); 
        $real_now = Carbon::create($date); 
 
        try {
            $vuelos = ModeloPrincipal::where('multimedia_caduca','<',$real_now)->where('multimedia_archivos_borrados',false)->get();
            // dd($vuelos[0]->id);
            foreach ($vuelos as $key => $vuelo) { 
    
                foreach ($vuelo->multimedias as $key_multimedias => $multimedia) {
                    $file = $multimedia->carpeta;                
                    if(\File::exists(public_path($file))){
                        \File::delete(public_path($file));
                    }
                }
    
                $folder = 'public/uploads/multimedia/vuelo_'.$vuelo->id; 
                $this->delete_all( $folder );
  

                $zipFileName = 'MultimediasVuelo'.$vuelo->id.'.zip';
                if(\File::exists(public_path($zipFileName))){
                    \File::delete(public_path($zipFileName));
                }
                  
                $vuelo->multimedia = false;
                $vuelo->multimedia_archivos_borrados = true;
                $vuelo->save();

                Multimedias::where('vuelo_id',$vuelo->id)->delete();

                foreach ($vuelo->Pedidos as $key => $Pedido) { 
                    $Pedido->token = $Pedido->token.'-old';
                    $Pedido->save();
                }  
            }  

        } catch (\Throwable $th) {
            BitacorasCron::create([
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i'),
                'estatus' => 'error',
                'tipo' => 'Limpiar Archivos Caducados',
                'nota' => $th->getMessage()
            ]);
        }
        
        BitacorasCron::create([
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i'),
            'estatus' => 'exitoso',
            'tipo' => 'Limpiar Archivos Caducados',
            'nota' => count($vuelos),
        ]);


    }

    
    // Elimina todos los archivos y carpetas dentro del directorio
    public  function delete_all( $dir ) {
        if( is_dir($dir) ) { 
            $objects = array_diff( scandir($dir), array('..', '.') );
            foreach ($objects as $object) { 
              $objectPath = $dir."/".$object;
              if( is_dir($objectPath) )
                $this->delete_all($objectPath);
              else
                unlink($objectPath); 
            } 
            rmdir($dir); 
          } 
    }



}

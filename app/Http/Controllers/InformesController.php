<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VuelosRealizados;
use App\Models\VuelosCancelados;
use App\Models\Vuelos;
use App\Models\GloboBottomEnd;
use App\Models\Globos;
use App\User;
use DB;
use Hash;
use PDF;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class InformesController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
 
    public function vuelos(Request $request){
        
        $columna = $request->columna;
        $orden = $request->orden;
         
        $records = VuelosRealizados::
        when($columna=='fecha', function($querys) use($orden){ 
            $column ='vuelo';
            $campo1 ='fecha';
            $campo2 ='hora';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden)
            ->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo2')"), $orden);
        })
        ->when($columna=='id', function($querys) use($orden){ 
            $column ='vuelo';
            $campo1 ='id';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden);
        })
        ->when($columna=='zona', function($querys) use($orden){ 
            $column ='zona';
            $campo1 ='nombre';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden);
        })
        ->when($columna=='piloto', function($querys) use($orden){ 
            $column ='piloto';
            $campo1 ='nombres';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden);
        })
        ->when($columna=='globo', function($querys) use($orden){ 
            $column ='globo';
            $campo1 ='nombre';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden);
        }) 
        ->get();
              
        return response(['records' => $records]);
     
    }
 
    public function vuelos_cancelados(Request $request){
         
        $columna = $request->columna;
        $orden = $request->orden;
         
        $records = VuelosCancelados::
        when($columna=='fecha', function($querys) use($orden){ 
            $column ='vuelo';
            $campo1 ='fecha';
            $campo2 ='hora';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden)
            ->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo2')"), $orden);
        })
        ->when($columna=='id', function($querys) use($orden){ 
            $column ='vuelo';
            $campo1 ='id';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden);
        })
        ->when($columna=='zona', function($querys) use($orden){ 
            $column ='zona';
            $campo1 ='nombre';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden);
        })
        ->when($columna=='piloto', function($querys) use($orden){ 
            $column ='piloto';
            $campo1 ='nombres';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden);
        })
        ->when($columna=='globo', function($querys) use($orden){ 
            $column ='globo';
            $campo1 ='nombre';
            $querys->orderBy(DB::raw("JSON_EXTRACT($column, '$.$campo1')"), $orden);
        }) 
        ->get();
              
        return response(['records' => $records]);
     
    }
 
    public function edit_vuelos_cancelados($id){
        
        $records = VuelosCancelados::whereId($id)->first();
              
        return response(['records' => $records]);
     
    }
 
    public function edit_vuelos($id){
        
        $records = VuelosRealizados::whereId($id)->first();
              
        return response(['records' => $records]);
     
    }
 
    public function saved_vuelos(Request $request){
        
        try {

            DB::beginTransaction();
 
             
                $records = VuelosRealizados::whereId($request->id)->first();
                $records->zona = $request->zona;
                $records->globo = $request->globo;
                $records->piloto = $request->piloto;
                $records->vuelo = $request->vuelo;
                $records->save();


            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();

            return response(['result' => false,'mensaje_error'=>$e->getMessage()]);
           
        }

        return response(['result' => true]); 
     
    }


    public function generar_EASA(Request $request){
    
        $fontStyle = [
            'font' => [
                'size' => 14
            ]
        ];
        
        $globo_id = $request->globo_id;
        $inicio = $request->inicio;
        $fin = $request->fin;
         
        $records = VuelosRealizados::where('globo->id',$globo_id)
        ->when(!is_null($inicio), function($querys) use($inicio){ 
             $querys->where('vuelo->fecha', '>=' ,$inicio); 
        })->when(!is_null($fin), function($querys) use($fin){ 
             $querys->where('vuelo->fecha', '<=' ,$fin); 
        })
        ->orderBy('vuelo->horas_inicial_globo','ASC')
        ->get();

        $globo = $records[0]->globo;
        $anterior = $records[0]->vuelo['horas_inicial_globo'] ?? '00:00'; 

        $horas = [$anterior];
        $horas_totales = [];
        foreach ($records as $key => $record) {
            # code...
            $horas = array_merge($horas , [$record->vuelo['duracion_vuelo']]);
            $horas_totales = array_merge($horas_totales , [$record->vuelo['duracion_vuelo']]);
            // $array_hora = [$new_time->format('H:i:s'), $anterior];
        }
             
        $total = 0;
        $total_horas = 0;

        // Loop the data items
        foreach($horas as $item){
            $temp = explode(":", $item);
            if(isset($temp[0])){
                $total+= (int) $temp[0] * 3600; // Convert the hours to seconds and add to our total
            }
            if(isset($temp[1])){
                $total+= (int) $temp[1] * 60;  // Convert the minutes to seconds and add to our total
            }
            if(isset($temp[2])){
                $total+= (int) isset($temp[2]) ? $temp[2] : '00'; // Add the seconds to our total
            }
 
        } 
        // Loop the data items
        foreach($horas_totales as $item){
            $temp = explode(":", $item); // Explode by the seperator :
            if(isset($temp[0])){
                $total_horas+= (int) $temp[0] * 3600; // Convert the hours to seconds and add to our total
            }
            if(isset($temp[1])){
                $total_horas+= (int) $temp[1] * 60;  // Convert the minutes to seconds and add to our total
            }
            if(isset($temp[2])){
                $total_horas+= (int) isset($temp[2]) ? $temp[2] : '00'; // Add the seconds to our total
            } 
        }
        
        $total = sprintf('%02d:%02d', ($total / 3600),($total / 60 % 60), $total % 60);
        $total_horas = sprintf('%02d:%02d', ($total_horas / 3600),($total_horas / 60 % 60), $total_horas % 60);
        
  
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setTitle('Registro de vuelos');
                
        
        $IMG = getcwd().'/images/logo_excel.jpeg';  
        $row_num = 1;
        if (isset($IMG) && !empty($IMG)) {
            $imageType = "png";

            if (strpos($IMG, ".png") === false) {
                $imageType = "jpg";
            }

            $drawing = new MemoryDrawing();
            // $sheet->getRowDimension($row_num)->setRowHeight(30);            
            $sheet->getColumnDimension('A')->setWidth(30);
            $sheet->mergeCells('A1:A3');

            $gdImage = ($imageType == 'png') ? imagecreatefrompng($IMG) : imagecreatefromjpeg($IMG);
            $drawing->setName('Company Logo');
            $drawing->setDescription('Company Logo image');
            $drawing->setResizeProportional(true);
            $drawing->setImageResource($gdImage);
            $drawing->setRenderingFunction(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_JPEG);
            $drawing->setMimeType(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_DEFAULT);
            $drawing->setWidth(211);
            $drawing->setHeight(50);
            $drawing->setOffsetX(0);
            $drawing->setOffsetY(0);
            $drawing->setCoordinates('A'.$row_num);
            $drawing->setWorksheet($spreadsheet->getActiveSheet());
            $row_num++;
        }

        $sheet = $spreadsheet->getActiveSheet()->setTitle('Registro de vuelos');
        $sheet->setCellValue('B1', 'EASA Part CAO');
        $sheet->setCellValue('B2', 'Combined Airworthiness Organisation');
        $sheet->setCellValue('B3', 'AESA Approval ES.CAO.002');

        $sheet 
        ->getStyle('A5:Q5')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF');

        $sheet 
        ->getStyle('A7:Q7')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('366092');
        
        $sheet 
        ->getStyle('A8:Q8')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF');
 
        $sheet 
        ->getStyle('A11:Q11')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('366092');

        $sheet 
        ->getStyle('A12:Q12')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF');

        $sheet->setCellValue('A5', 'E.1.13 Parte de vuelo');
        $sheet->setCellValue('E5', 'Edición 2 Revisión 0');
        $sheet->setCellValue('F5', 'Año');
          
        $real_now = Carbon::create($records[0]->vuelo['fecha']);
        $ahio = $real_now->format('Y') ?? date('Y');
        $sheet->setCellValue('G5', $ahio );
        $sheet->setCellValue('H5', $total_horas);        
        $sheet->mergeCells('I5:J5');
        $sheet->setCellValue('I5', 'Anterior');     
        $sheet->mergeCells('K5:L5');
        $sheet->setCellValue('K5', $anterior);   
        $sheet->mergeCells('M5:N5');
        $sheet->setCellValue('M5', 'Total');
        $sheet->mergeCells('O5:P5');
        $sheet->setCellValue('O5', $total);
        $sheet->setCellValue('Q5', 'FR '.$globo['matricula']);
          
        $sheet->setCellValue('A7', 'AERONAVE');
        $sheet->setCellValue('A8', 'Fabricante');
        $sheet->setCellValue('A9',  $globo['fabricante']);

        $sheet->setCellValue('B8', 'Modelo');
        $sheet->setCellValue('B9', $globo['modelo']);

        $sheet->setCellValue('C8', 'Matrícula');
        $sheet->setCellValue('C9', $globo['matricula']);

        $sheet->setCellValue('D8', 'S/N');
        $sheet->setCellValue('D9', '1439');

        $sheet->setCellValue('A11', 'ACTIVIDAD');
        $sheet->setCellValue('A12', 'Piloto - Licencia');
        $sheet->setCellValue('B12', 'Despegue');
        $sheet->setCellValue('C12', 'Día');
        $sheet->setCellValue('D12', 'Hora');
        $sheet->setCellValue('E12', 'Aterrizaje');
        $sheet->setCellValue('F12', 'Día');
        $sheet->setCellValue('G12', 'hora');
        $sheet->setCellValue('H12', 'H Vuelo');
        $sheet->setCellValue('I12', 'BAR');
        $sheet->setCellValue('J12', 'QUE');
        $sheet->setCellValue('K12', 'B1');
        $sheet->setCellValue('L12', 'B2');
        $sheet->setCellValue('M12', 'B3');
        $sheet->setCellValue('N12', 'B4');
        $sheet->setCellValue('O12', 'B5');
        $sheet->setCellValue('P12', 'B6');
        $sheet->setCellValue('Q12', 'Observaciones');


        $i = 13;
  
        foreach ($records as $key => $value){

            
            $bottom_end = '';
            $quemador = '';
            $barquilla_cesta = '';
            $quemador_peso = '';
            $barquilla_cesta_peso = '';
            $BS = [];

            if(isset($value->globo['bottom_end']) && !is_null($value->globo['bottom_end'])){
                $bottom_end = $value->globo['bottom_end'];            
                $quemador = $bottom_end['quemador']['codigo'] ?? null;
                $barquilla_cesta = $bottom_end['cesta']['codigo'] ?? null;            
                $BS = $bottom_end['botellas'] ?? [];
            }
            $fecha = null;

            if(isset($value->vuelo)&&!is_null($value->vuelo)){

                $date=date_create($value->vuelo['fecha_despegue']);
                $fecha = date_format($date,"d-m-Y");
            }

            $sheet->setCellValue('A'.$i, (isset($value->piloto)&&!is_null($value->piloto))?$value->piloto['nombres'].' '.$value->piloto['apellidos']:'');
            $sheet->setCellValue('B'.$i, (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['lugar_despegue']:'');
            $sheet->setCellValue('C'.$i, $fecha);
            $sheet->setCellValue('D'.$i, (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['hora_despegue']:'');
            $sheet->setCellValue('E'.$i, (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['lugar_aterrizaje']:'');
            $sheet->setCellValue('F'.$i, $fecha);
            $sheet->setCellValue('G'.$i, (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['hora_aterrizaje']:'');
            $sheet->setCellValue('H'.$i, (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['duracion_vuelo']:'');
            $sheet->setCellValue('I'.$i, $barquilla_cesta);

            $sheet->setCellValue('J'.$i, $quemador); 
            $sheet->setCellValue('Q'.$i, (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['notas']:'');
            
            $indices = ['K','L','M','N','O','P'];
            foreach ($BS as $key_bs => $value) {
                $sheet->setCellValue($indices[$key_bs].''.$i, $value['codigo'] ?? null);
            }

          $i++;
        }
        

        $fileName = 'FR '.$globo['matricula'].' '.$ahio.'.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. $fileName.'"');
        $writer->save('php://output');

    }
  
    public function generar_pvo(Request $request){
    
        $fontStyle = [
            'font' => [
                'size' => 14
            ]
        ];

        $styleArray = array(
            'font'  => array(
                 'bold'  => true,
                 'color' => array('rgb' => 'FF0000'),
                 'size'  => 15,
                 'name'  => 'Verdana'
             )); 
 
        $globo_id = $request->globo_id;
        $inicio = $request->inicio;
        $fin = $request->fin;
        $vuelos_ids = explode(',',$request->vuelos_ids);
       
        $records = VuelosRealizados::when(!is_null($inicio), function($querys) use($inicio){ 
             $querys->where('vuelo->fecha', '>=' ,$inicio); 
        })->when(!is_null($fin), function($querys) use($fin){ 
             $querys->where('vuelo->fecha', '<=' ,$fin); 
        })->when(!is_null($vuelos_ids) && count($vuelos_ids)>0 , function($querys) use($vuelos_ids){ 
             $querys->whereIn('id',$vuelos_ids); 
        }) 
        ->orderBy('vuelo->horas_inicial_globo','ASC')
        ->get();
 
        $spreadsheet = new Spreadsheet();
        foreach ($records as $key => $value) {
              
        $peso_pespegue = 0;
        $peso_total_globo = 0;

        $bottom_end = '';
        $quemador = '';
        $barquilla_cesta = '';
        $quemador_peso = 0;
        $barquilla_cesta_peso = 0;
        $firma_pvo = encontrar_configuracion('firma_pvo');
        $BS = [];

        if(isset($value->globo['bottom_end']) && !is_null($value->globo['bottom_end'])){
            $bottom_end = $value->globo['bottom_end'];   
            
            $quemador_modelo = $bottom_end['quemador']['modelo'] ?? null;
            $quemador_codigo = $bottom_end['quemador']['codigo'] ?? null;
            $quemador = $quemador_modelo.' '.$quemador_codigo;

            $barquilla_cesta_modelo = $bottom_end['cesta']['modelo'] ?? null;
            $barquilla_cesta_codigo = $bottom_end['cesta']['codigo'] ?? null;
            $barquilla_cesta = $barquilla_cesta_modelo.' '.$barquilla_cesta_codigo;
            

            $quemador_peso = $bottom_end['quemador']['peso'] ?? 0;
            $barquilla_cesta_peso = $bottom_end['cesta']['peso'] ?? 0;
            $BS = $bottom_end['botellas'] ?? [];

        }


        $fecha = null;

        $peso_total_globo = $quemador_peso + $barquilla_cesta_peso;
        $peso_globo = (isset($value->globo)&&!is_null($value->globo))?$value->globo['peso_globo']??0:0;
        $peso_total_globo += (isset($value->globo)&&!is_null($value->globo))?$value->globo['peso_globo']??0:0;

        if(isset($value->vuelo)&&!is_null($value->vuelo)){

            $date=date_create($value->vuelo['fecha_despegue']);
            $fecha = date_format($date,"d-m-Y");
        }
        
             
        $name_vuelo = "Vuelo ".( (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['id']??0:0);
        
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $name_vuelo);

        // Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
        $sheet = $spreadsheet->addSheet($myWorkSheet, 0);
        
        $sheet->getStyle('C:D')->getAlignment()->setHorizontal('right');

        $sheet->mergeCells('A47:C52');
        if(isset($value->piloto['url_firma_digital'])){
            $drawing = new Drawing();
            $drawing->setPath(public_path($value->piloto['url_firma_digital']));
            $drawing->setCoordinates('A47');
            $drawing->setOffsetX(110);
            $drawing->setOffsetY(10);
            $drawing->setHeight(100);
            $drawing->setWorksheet($myWorkSheet);
        }
    
        
        $indices_pasajero = ['7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27'];
        $pasajeros = $value->pasajeros ?? [];
        $peso_total_pasajeros = 0;
        $nro_pasajeros = 0;
        foreach ($pasajeros as $key_pasajeros => $pasajero) {
            $sheet->setCellValue('A'.''.$indices_pasajero[$key_pasajeros], $key_pasajeros+1);
            $sheet->setCellValue('B'.''.$indices_pasajero[$key_pasajeros], $pasajero['nombres'].' '.$pasajero['apellidos']);
            $sheet->setCellValue('C'.''.$indices_pasajero[$key_pasajeros], $pasajero['peso']??null);
            $peso_total_pasajeros += $pasajero['peso_final']??0;
            $nro_pasajeros++;
        }
        $peso_pespegue +=  $peso_total_pasajeros;

        $piloto = (isset($value->piloto)&&!is_null($value->piloto))?$value->piloto['nombres'].' '.$value->piloto['apellidos']:'';        
        $sheet->setCellValue('F7', $piloto);

        $licencia_piloto = (isset($value->piloto)&&!is_null($value->piloto))?$value->piloto['dni']:'';        
        $sheet->setCellValue('F8', $licencia_piloto);

        $clase_licencia = (isset($value->piloto)&&!is_null($value->piloto))?$value->piloto['habilitacion_nivel']:'';
        $sheet->setCellValue('F9', $clase_licencia);
        
        $fecha_desp = null;
        if(isset($value->vuelo)&&!is_null($value->vuelo)){
            $date=date_create($value->vuelo['fecha_despegue']);
            $fecha_desp = date_format($date,"d-m-Y");
        }

        $hora_desp = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['hora_despegue']:'';
        $sheet->setCellValue('F12', $fecha_desp);
        $sheet->setCellValue('G12', $hora_desp);


        $hora_aterrizaje = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['hora_aterrizaje']:'';
        $sheet->setCellValue('F14', $fecha_desp);
        $sheet->setCellValue('G14', $hora_aterrizaje);

        $lugar_despegue = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['lugar_despegue']:'';
        $lugar_aterrizaje = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['lugar_aterrizaje']:'';

        $sheet->setCellValue('F15', $lugar_despegue);
        $sheet->setCellValue('F13', $lugar_aterrizaje); 
        
        $tiempo_vuelo = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['duracion_vuelo']:'';
        $sheet->setCellValue('F16', $tiempo_vuelo);

        $tipo_de_vuelo = (isset($value->vuelo)&&!is_null($value->vuelo) && $value->vuelo['cautivo'])?'CAUTIVO':'COMERCIAL';
        $sheet->setCellValue('F17', $tipo_de_vuelo);
        $sheet->setCellValue('G17', 'CPB');
        

        $fecha_arcglobo = null;
        if(isset($value->globo)&&!is_null($value->globo)){
            $date=date_create($value->globo['arc']);
            $fecha_arcglobo = date_format($date,"d-m-Y");
        }
        $sheet->setCellValue('F20', $fecha_arcglobo);
        
        $dt = Carbon::create($fecha_arcglobo);
        $fecha_next = date_format( $dt->addYears(1),"d-m-Y");
        $sheet->setCellValue('F21', $fecha_next);
        
        $fecha_caducidad = '';
        $sheet->setCellValue('F22', $fecha_caducidad);
        
        if($value->vuelo['meteoblue_donwload']){
            $meteo_modelo = 'Multimodel';
            $meteo_fuente = 'Meteoblue';
        }else{
            $meteo_modelo = 'Ver Archivo';
            $meteo_fuente = 'Subido por piloto';
        }

        $sheet->setCellValue('F29', $meteo_modelo);        
        $sheet->setCellValue('F30', $meteo_fuente);

        $meteo_viento = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['viento']:'';
        $sheet->setCellValue('F31', $meteo_viento);
        
        $meteo_nubes = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['TipoNubosidad']['nombre']??null:'';
        $sheet->setCellValue('F32', $meteo_nubes);
        
        
        $meteo_qnh = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['qnh']??null:'';
        $sheet->setCellValue('F33', $meteo_qnh);

        $meteo_otros_fenomenos = '';
        $sheet->setCellValue('F34', $meteo_otros_fenomenos);
        

        $carga_temperatura = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['temperatura']:'';
        $sheet->setCellValue('F38', $carga_temperatura);
        
        $carga_alt_despegue = (isset($value->zona)&&!is_null($value->zona))?$value->zona['altura_despegue']:'';
        $sheet->setCellValue('F39', $carga_alt_despegue);
        
        $carga_alt_maxima = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['altura_maxima']:'';
        $sheet->setCellValue('F40', $carga_alt_maxima);
        
        $carga_maxima_1000ft = '';
        $sheet->setCellValue('F41', 'No Aplica');
        $sheet->setCellValue('G41', 'kbck');
        
        $carga_volumen = (isset($value->globo)&&!is_null($value->globo))?$value->globo['volumen']??0:0;
        $sheet->setCellValue('F42', $carga_volumen);
        
        $carga_maxima_kg = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['total_peso_disponible']??0:0;
        $sheet->setCellValue('F43', $carga_maxima_kg);
        
        
        $observaciones = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['notas']:'';
        $sheet->setCellValue('E46', $observaciones);
        
        $pasajeros = [];
        $totalpax = $peso_total_pasajeros;
        // $sheet->setCellValue('C26', $totalpax);

        $peso_extra = $nro_pasajeros * 7;
        $sheet->setCellValue('B22', 'Peso Extra '.$nro_pasajeros.' x 7kg');
        $sheet->setCellValue('C22', $peso_extra.' Kgs');



        $sheet->setCellValue('B23', 'Piloto (incluido ropa y equipo)');    
        $peso_piloto = (isset($value->piloto)&&!is_null($value->piloto))?$value->piloto['peso']:0;
        $sheet->setCellValue('C23', $peso_piloto.' Kgs');
        

        $peso_pespegue +=  $peso_piloto;

        $sheet->setCellValue('B24', 'Peso total Ocupantes');
        $sheet->setCellValue('C24', $peso_pespegue.' Kgs');



        $nombre_vela = (isset($value->globo)&&!is_null($value->globo))?$value->globo['modelo']:'';
        $sheet->setCellValue('B29', $nombre_vela);
        $sheet->setCellValue('C29', $peso_globo.' Kgs');
        
        $nombre_cesta = $barquilla_cesta;
        $sheet->setCellValue('B30', $nombre_cesta);
        
        $nombre_quemador = $quemador;
        $sheet->setCellValue('B31', $nombre_quemador);

        $sheet->setCellValue('C30', $barquilla_cesta_peso.' Kgs');
        
        $sheet->setCellValue('C31', $quemador_peso.' Kgs');
        
        $indices = ['32','33','34','35','36','37'];        
        foreach ($BS as $key_bs => $valuex) {                        
            $botella_modelo = $valuex['modelo'] ?? null;
            $botella_codigo = $valuex['codigo'] ?? null;
            $botella = $botella_modelo.' '.$botella_codigo;
            $sheet->setCellValue('B'.''.$indices[$key_bs], $botella);
            $sheet->setCellValue('C'.''.$indices[$key_bs], ($valuex['peso']??0).' Kgs');
            $peso_total_globo += $valuex['peso']??0;
        }
        $peso_pespegue += $peso_total_globo;
                
        $sheet->setCellValue('C38', $peso_total_globo.' Kgs');
        
        $gas = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['gas']??0:0;
        $reserva = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['reserva']??0:0;
        $combustible_peso = $gas + $reserva;
        $sheet->setCellValue('C39', $combustible_peso);
         
        $peso_pespegue += $combustible_peso;
        
        $sheet->setCellValue('C40', $peso_pespegue.' Kgs');
        
        $mtom = (isset($value->globo)&&!is_null($value->globo))?$value->globo['mtom']??0:0;
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun($mtom);
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('C41')->setValue($richText.' Kgs');
        

        $carga = (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['carga_maxima']??0:0;
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun($carga);
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('C42')->setValue($richText.' Kgs');
        
 
        // dd($value->vuelo);
        $mintom = (isset($value->globo)&&!is_null($value->globo))?$value->globo['min_mtom']??0:0;
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun($mintom);
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('C43')->setValue($richText.' Kgs');
        
        
        $sheet 
        ->getStyle('A4:C4')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('D9D9D9');
 
        $sheet 
        ->getStyle('A6:C6')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('8ED0CA');

        $sheet 
        ->getStyle('F4:G4')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('D9D9D9');
    
        $sheet->setCellValue('A4', 'Registro técnico, manifiesto de carga y pasajeros - 1.0');

        $sheet->setCellValue('F4', 'Vuelo #');
        $sheet->setCellValue('G4', (isset($value->vuelo)&&!is_null($value->vuelo))?$value->vuelo['id']:0);
           
        $sheet->setCellValue('A6', '#' );
        $sheet->setCellValue('B6', 'Nombre del pasajero');        
        $sheet->setCellValue('C6', 'Peso');   
        
        




        $sheet 
        ->getStyle('A22:C24')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF'); 
       
        
        $sheet->getColumnDimension('A')->setWidth(32, 'px');
        $sheet->getColumnDimension('B')->setWidth(270, 'px');
        $sheet->getColumnDimension('C')->setWidth(55, 'px');
        $sheet->getColumnDimension('D')->setWidth(15, 'px');
        $sheet->getColumnDimension('E')->setWidth(131, 'px');
        $sheet->getColumnDimension('F')->setWidth(100, 'px');
        $sheet->getColumnDimension('G')->setWidth(100, 'px');
        


        $sheet->setCellValue('A26', '' );
        // $sheet->setCellValue('B26', 'Peso total pasaje, vestimenta y equipaje');        



        $sheet->setCellValue('G38', 'Grados ºC');   
        $sheet->setCellValue('G39', 'Metros');   
        $sheet->setCellValue('G40', 'Metros');   
        $sheet->setCellValue('G42', 'ft3');   
        $sheet->setCellValue('G43', 'Kgs');   



        $sheet 
        ->getStyle('A28:C28')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF');
        $sheet->setCellValue('B28', 'Componentes del globo');   
        
 
        $sheet->setCellValue('A29', 'ENV');   


        $sheet->setCellValue('A30', 'BSK');  

        $sheet->setCellValue('A31', 'BRN');  

        $sheet->setCellValue('A32', 'CYL'); 

        $sheet->setCellValue('A33', 'CYL');  

        $sheet->setCellValue('A34', 'CYL');   

        $sheet->setCellValue('A35', 'CYL');   

        $sheet->setCellValue('A36', 'CYL');   

        $sheet->setCellValue('A37', 'CYL'); 

 
        $sheet 
        ->getStyle('A38:C38')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF');
        $sheet->setCellValue('B38', 'Peso total globo');   



        $sheet->setCellValue('A39', 'FUE');   
        $sheet->setCellValue('B39', 'Combustible (incluye 20%. de reserva)');   
 
        $sheet 
        ->getStyle('A40:C40')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF');
        $sheet->setCellValue('B40', 'Peso total al despegue');   

        $sheet->setCellValue('B41', 'MTOM');   
        $sheet->setCellValue('B42', 'MAX LOAD');   
        $sheet->setCellValue('B43', 'MLM');   





















 
        $sheet 
        ->getStyle('E6:G6')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 


        $sheet 
        ->getStyle('A45:C45')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('D9D9D9'); 
        $sheet 
        ->getStyle('A46:C46')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('D9D9D9'); 
        $sheet 
        ->getStyle('A52:C52')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('D9D9D9'); 

        $sheet->setCellValue('B52', $piloto);
        

        $sheet 
        ->getStyle('A1:G1')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 
        $sheet 
        ->getStyle('A2:G2')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 
        $sheet 
        ->getStyle('A3:G3')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 

        
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('VOLAR EN ASTURIAS');
        $payable->getFont()->setSize(16);
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('B2')->setValue($richText);
        
        
        $matricula_globo = (isset($value->globo)&&!is_null($value->globo))?$value->globo['matricula']??0:0;
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun($matricula_globo);
        $payable->getFont()->setSize(35);
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('F2')->setValue($richText);


        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('Datos del PIC');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('E6')->setValue($richText);
        $sheet 
        ->getStyle('E7:E9')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF'); 

        $sheet->setCellValue('E7', 'Nombre y apellidos');
        $sheet->setCellValue('E8', 'Licencia');
        $sheet->setCellValue('E9', 'Clase/Grupo');

        $sheet->setCellValue('A45', 'Certificación de datos meteo, cálculo de carga, combustible');
        $sheet->setCellValue('A46', 'y chequeos pre-vuelo por el PIC, firmado:');




        $sheet 
        ->getStyle('E11:G11')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 
        
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('Desarrollo del vuelo');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('E11')->setValue($richText);


        $sheet 
        ->getStyle('E12:E17')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF'); 

        $sheet->setCellValue('E12', 'Fecha despegue');
        $sheet->setCellValue('E13', 'Zona despegue');
        $sheet->setCellValue('E14', 'Fecha aterrizaje');
        $sheet->setCellValue('E15', 'Zona aterrizaje');
        $sheet->setCellValue('E16', 'Tiempo de vuelo');
        $sheet->setCellValue('E17', 'Tipo de vuelo');


        
        $sheet 
        ->getStyle('E19:G19')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 

        
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('Registro de aeronavegabilidad');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('E19')->setValue($richText);

        $sheet 
        ->getStyle('E20:E26')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF');  

        $sheet->setCellValue('E20', 'Última inspección');
        $sheet->setCellValue('E21', 'Próxima inspección');
        $sheet->setCellValue('E22', 'Validez ARC');
        
        
        $sheet 
        ->getStyle('E23:G23')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('Calculo de combustible');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('E23')->setValue($richText);

        $sheet->setCellValue('E24', 'Duracion estimada');                
        $duracion_estimada = (isset($value->vuelos)&&!is_null($value->vuelos))?$value->vuelos['duracion_estimada']??0:0;
        $sheet->setCellValue('F24', $duracion_estimada);
        $sheet->setCellValue('G24', 'minutos');

        $sheet->setCellValue('E25', 'Comb. Requerido');
        $sheet->setCellValue('F25', $gas);
        $sheet->setCellValue('G25', 'Kgs');

        $sheet->setCellValue('E26', 'Comb. de reserva');
        $sheet->setCellValue('F26', $reserva);
        $sheet->setCellValue('G26', 'Kgs');


        $sheet 
        ->getStyle('E28:G28')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 
        
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('Datos meteo');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('E28')->setValue($richText);
        
        $sheet 
        ->getStyle('E29:E35')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF'); 

        $sheet->setCellValue('E29', 'Modelo');
        $sheet->setCellValue('E30', 'Fuente');
        $sheet->setCellValue('E31', 'Viento');
        $sheet->setCellValue('E32', 'Nubes');
        $sheet->setCellValue('E33', 'QNH');
        $sheet->setCellValue('E34', 'Otros fenómenos');
        
        $sheet 
        ->getStyle('E37:G37')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 
        
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('Cálculo de carga');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('E37')->setValue($richText);
        
        $sheet 
        ->getStyle('E38:E42')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('BFBFBF'); 
 
        $sheet 
        ->getStyle('E43:E43')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('2F75B5'); 
        $sheet 
        ->getStyle('A41:A43')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('2F75B5'); 
        $sheet 
        ->getStyle('B41:B43')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('2F75B5'); 
        $sheet 
        ->getStyle('C41:C43')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('2F75B5'); 
 
        $sheet->setCellValue('E38', 'Temperatura');
        $sheet->setCellValue('E39', 'Alt. Despegue');
        $sheet->setCellValue('E40', 'Alt. Máxima');
        $sheet->setCellValue('E41', 'Carga máx 1000 ft3');
        $sheet->setCellValue('E42', 'Volúmen');

        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('Carga Disponible');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('E43')->setValue($richText);

        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('MTOM');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('B41')->setValue($richText);

        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('MAX LOAD');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('B42')->setValue($richText);

        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('MLM');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('B43')->setValue($richText);

 



        $sheet 
        ->getStyle('E45:G45')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('000000'); 
        
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('Observaciones, daños y diferidos');
        $payable->getFont()->setBold(true);
        $payable->getFont()->setItalic(true);
        $payable->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
        $sheet->getCell('E45')->setValue($richText);
        
        $sheet->mergeCells('E46:G52');

        $sheet->mergeCells('A54:G54');
        $wizard = new \PhpOffice\PhpSpreadsheet\Helper\Html();
        $richText = $wizard->toRichTextObject($firma_pvo);
        $sheet->setCellValue('A54', $richText);
        
    }

    $sheetIndex = $spreadsheet->getIndex(
        $spreadsheet->getSheetByName('Worksheet')
    );
    $spreadsheet->removeSheetByIndex($sheetIndex);

        $fileName = 'PVO.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. $fileName.'"');
        $writer->save('php://output');
    
    }
  
    public function generar_pvo_old(Request $request){
    
        $ids = explode(',',$request->vuelos_ids);
        $records = VuelosRealizados::whereIn('id',$ids)->get();

        $cantidad_pagina = count($records);
        // dd($records);
        $pdf = PDF::loadView('plataforma.pdfs.pvo', compact('records','cantidad_pagina'));
        // $pdf->setPaper('A5', 'landscape');
        // $output = $pdf->output();
        return $pdf->download('test.pdf');
        // $url_document = storage_path('bienes').'/'.$nombre;
        
        // $pdf->save($url_document);

        // return view('plataforma.pdfs.pvo');
        

    }
  
    public function sincronizar_informacion(Request $request){
    
        $ids = explode(',',$request->vuelos_ids);
        
        $records = VuelosRealizados::whereIn('id',$ids)->get();

        foreach ($records as $key => $record) {
            if(!is_null($record->vuelo)){
                $vuelo = Vuelos::whereId($record->vuelo['id'])->withTrashed()->first();
                if(isset($vuelo->globo) && isset($vuelo->globo->bottom_end)){
                    $vuelo->globo->bottom_end = $vuelo->globo->bottom_end; 
                    $vuelo->globo->bottom_end->cesta = $vuelo->globo->bottom_end->cesta ?? null; 
                    $vuelo->globo->bottom_end->botellas = $vuelo->globo->bottom_end->botellas()  ?? []; 
                    $vuelo->globo->bottom_end->quemador = $vuelo->globo->bottom_end->quemador ?? null; 
                }
                $vuelo->TipoNubosidad = $vuelo->TipoNubosidad ?? null; 
                $vuelo->total_peso_disponible = $vuelo->total_peso_disponible_calc() ?? 0; 
                if($vuelo){ 
                    $record->zona = $vuelo->zona ?? [];
                    $record->piloto = $vuelo->piloto;
                    $record->globo = $vuelo->globo;
                    $record->vuelo = $vuelo;
                    $record->pedido = $vuelo->PedidosAllData;
                    $record->pasajeros = $vuelo->pasajeros();
                    $record->save();
                }
            }
        }  
        
        session()->flash('success', 'Vuelos Actualizados');
        
        return redirect('/dashboard#/informes/vuelos');

    }
  
}

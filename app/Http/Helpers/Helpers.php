<?php
use App\Models\ConfiguracionPlataforma;
use Illuminate\Support\Facades\Cache;
use App\Models\Zones;
use App\Models\TipoNubosidad;
// use rapidweb\googlecontacts\factories\ContactFactory;
use App\Models\Checklist;
use Google\Cloud\Translate\V2\TranslateClient;

if ( !function_exists('encontrar_configuracion') )
{
	function encontrar_configuracion($key){

        $ConfiguracionPlataforma = ConfiguracionPlataforma::where('key',$key)->first();
        if(!$ConfiguracionPlataforma){
            return false;    
        }else{
            return $ConfiguracionPlataforma->valor;
        }
        
	}
}
if ( !function_exists('check_list') )
{
	function check_list($tipo){
        
        return Checklist::where('tipo',$tipo)->where('activo',true)->orderBy('orden','ASC')->get();
        
	}
}

if ( !function_exists('ConsultarMeteoblue') )
{
    function ConsultarMeteoblue($url, $nombre)
    { 

         $ch = curl_init($url);
  
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
         $result = curl_exec($ch);
 
         curl_close($ch);
 
         
         if($result==''){                 
            return false;
         }

        $htmlContent = $result;
        
        $DOM = new \DOMDocument();
        $DOM->loadHTML($htmlContent, LIBXML_NOERROR);
        

        $divs = $DOM->getElementsByTagName( 'div' );
    
        foreach( $divs as $div ){

            if( $div->getAttribute( 'class' ) == 'blooimage img-scrollable ' ){

                $url_result = 'https:'.$div->getAttribute( 'data-href' );

                $url_path = 'vuelos/'.$nombre;

                \Storage::disk('public_public')->put($url_path, file_get_contents($url_result));
 
                return $url_path;

            } 
            
        }
 
    }
}

// if ( !function_exists('AccessGoogle') )
// {
//     function AccessGoogle()
//     { 
//         // $contacts = ContactFactory::getAll();      
//         // var_dump($contacts);
//     }
    
// }

if ( !function_exists('AccessGoogle2') )
{
    function AccessGoogle2()
    { 
 
        $end_point = 'https://accounts.google.com/o/oauth2/v2/auth';
        $client_id = '417049974242-92kd6lc2cpemgha3bkkiedt01jfotgbc.apps.googleusercontent.com';
        $client_secret = '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';
        $redirect_uri = 'https://vuelosglobos.com';   //  http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] or urn:ietf:wg:oauth:2.0:oob
        // $redirect_uri = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];   //  http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] or urn:ietf:wg:oauth:2.0:oob
        $scope = 'https://www.googleapis.com/auth/drive.metadata.readonly';

        $authUrl = $end_point.'?'.http_build_query([
            'client_id'              => $client_id,
            'redirect_uri'           => $redirect_uri,              
            'scope'                  => $scope,
            'access_type'            => 'offline',
            'include_granted_scopes' => 'true',
            'state'                  => 'state_parameter_passthrough_value',
            'response_type'          => 'code',
        ]);

        echo '<a href = "'.$authUrl.'">Authorize</a></br>';

        dd(Cache::get('response_google'));

        // Generate new Access Token and Refresh Token if token.json doesn't exist
        if ( !file_exists('token.json') ){
            
            if ( isset($_GET['code'])){
                $code = $_GET['code'];         // Visit $authUrl and get the authentication code
            }else{
                return;
            } 

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://accounts.google.com/o/oauth2/token");
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/x-www-form-urlencoded']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'code'          => $code,
                'client_id'     => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri'  => $redirect_uri,
                'grant_type'    => 'authorization_code',
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close ($ch);
            
            file_put_contents('token.json', $response);
                
            $token = Cache::remember('response_google', 60, function () {
                return $response;
            });

            dd($token);
            
        }
        else{
            $response = file_get_contents('token.json');
            $array = json_decode($response);
            $access_token = $array->access_token;
            $refresh_token = $array->refresh_token;

            // Check if the access token already expired
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token='.$access_token); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $error_response = curl_exec($ch);
            $array = json_decode($error_response);
            
            if( isset($array->error)){
                
                // Generate new Access Token using old Refresh Token
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"https://accounts.google.com/o/oauth2/token");
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                    'client_id'     => $client_id,
                    'client_secret' => $client_secret,
                    'refresh_token'  => $refresh_token,
                    'grant_type'    => 'refresh_token',
                ]));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close ($ch);
            }  
            
            $token = Cache::remember('response_google', 60, function () {
                return $response;
            });

            dd($token);
        }
        
        
    }
    
}

 
if ( !function_exists('ApiMetar') )
{
    function ApiMetar($zona_id)
    { 
        
        $zona = Zones::whereId($zona_id)->first();

        $icao = $zona->icao;

        $array = [
            'amanecer' => null,
            'anochecer' => null,
            'mediodia' => null,
            'orto' => null,
            'ocaso' => null,
        ];
        
        $metar = [
            'tipo_nubosidad' => null,
            'qnh' => null
        ];
        if(!is_null($icao)){           

            $key = encontrar_configuracion('key_api_metar');

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.checkwx.com/station/'.$icao.'/suntimes',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => ['X-API-Key: '.$key]
            ]);
            
            $response = curl_exec($curl);            
            curl_close($curl);

            if($response){
                $data_response = json_decode($response);
                $data = $data_response->data[0];
                $sunrise_sunset = $data->sunrise_sunset->local;

                $array = [
                    'amanecer' => $sunrise_sunset->dawn,
                    'anochecer' => $sunrise_sunset->dusk,
                    'mediodia' => $sunrise_sunset->noon,
                    'orto' => $sunrise_sunset->sunrise,
                    'ocaso' => $sunrise_sunset->sunset,
                ];

            }    
 
            $curl_metar = curl_init();

            curl_setopt_array($curl_metar, [
                CURLOPT_URL => 'https://api.checkwx.com/metar/'.$icao.'/decoded',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => ['X-API-Key: '.$key]
            ]);
            
            $response_metar = curl_exec($curl_metar);            
            curl_close($curl_metar);

            if($response_metar){
                $data_response_metar = json_decode($response_metar);
                $data_metar = $data_response_metar->data[0];

                $metar = [
                    'tipo_nubosidad' => TipoNubosidad::whereCodigo($data_metar->clouds[0]->code)->first()->id ?? null,
                    'qnh' => $data_metar->barometer->hpa
                ];
            }    
        }


        $data = array_merge($array,$metar);

        return $data;

    }
    
}



if ( !function_exists('TraducirTexto') )
{
    function TraducirTexto($lang, $texto)
    { 
       
        $json = base_path().'/useful-lattice-273612-f7cc8b045d12.json';

        try {

            $translate = new TranslateClient([
                'keyFilePath' => $json
            ]);

 
            $result = $translate->translate($texto, [
                'target' => $lang,
                'format' => 'html'
            ]);

            return str_replace('<p></p>', '<br>' , $result['text']);
            return str_replace('<p style=";text-align:left;direction:ltr"></p>', '<br>' , $result['text']);

        } catch(Exception $e) {

            return $texto;

        }

    }
    
}


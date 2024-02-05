<?php

use Illuminate\Support\Facades\Route;
use Dcblogdev\Dropbox\Models\DropboxToken;

use App\Http\Controllers\Auth\LoginUsersController;
use App\Http\Controllers\Auth\GoogleController;

use App\Http\Controllers\PedidosExternoController;
use App\Http\Controllers\Dashboard\DashboardController;

use App\Http\Controllers\MultimediasController;
use App\Http\Controllers\ConfigsController;
use App\Http\Controllers\PilotosController;
use App\Http\Controllers\GlobosController;
use App\Http\Controllers\TablaCargaController;
use App\Http\Controllers\ZonasController;
use App\Http\Controllers\VuelosController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ReservasExternasController;
use App\Http\Controllers\PasajerosController;
use App\Http\Controllers\RiesgosController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\PilotosEntrenamientoController;
use App\Http\Controllers\GloboBotellasController;
use App\Http\Controllers\GloboBottomEndController;
use App\Http\Controllers\GloboCestasController;
use App\Http\Controllers\GloboQuemadoresController;
use App\Http\Controllers\FormulariosController;
use App\Http\Controllers\TipoNubosidadController;
use App\Http\Controllers\TurnosController;
use App\Http\Controllers\SoguillasController;
use App\Http\Controllers\SoguillasDisponibilidadController;
use App\Http\Controllers\ChecklistsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionRolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservaExternaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// Route::resources([
//     'photos' => PhotoController::class,
//     'posts' => PostController::class,
// ]);


// Route::controller(OrderController::class)->group(function () {
//     Route::get('/orders/{id}', 'show');
//     Route::post('/orders', 'store');
// });



Route::post('/login-user', [LoginUsersController::class, 'create']);
   
Route::get('/login', function () {
	return view('welcome');
})->name('login');


Route::get('/pvo', function () {
	return view('plataforma.pdfs.pvo');
});

Route::get('/check_list/{tipo}', function (string $tipo) {
	return check_list($tipo);
});

Route::get('/encontrar_configuracion/{tipo}', function (string $tipo) {
	return encontrar_configuracion($tipo);
});


Route::get('/buscar_pedido/{id}', [PedidosController::class,'buscar']);


Route::controller(GoogleController::class)->group(function () {
    Route::get('/auth/google', 'redirectToGoogle');
    Route::get('/auth/google/callback', 'handleGoogleCallback');
});
 

Route::controller(PedidosExternoController::class)->group(function () {
    Route::get('/auth/google/callback', 'handleGoogleCallback');
    Route::get('/validate_pin/{token}', 'validate_pin');
    Route::get('/validate_pin_soguilla/{token}/{soguilla_id}', 'validate_pin');
    Route::post('/validate_pin', 'validate_pin_piloto');
    Route::get('/flight_details/{token}', 'flight_details');
    Route::get('/flight_details_load_meteoblue/{token}', 'flight_details_load_meteoblue');
    Route::post('/update_vuelo_piloto_extern', 'update_vuelo_piloto_extern');
    Route::post('/update_checklist_piloto_extern', 'update_checklist_piloto_extern');
    Route::post('/update_vuelo_delete_pasajero_extern', 'update_vuelo_delete_pasajero_extern');
    Route::get('/completed_form/{token}', 'index');
    Route::get('/listado_globos_extern', 'listado_globos_extern');
    Route::post('/saved_completed_form', 'store');
    Route::post('/update_data_passanger', 'update_data_passanger');
    Route::get('/descargar_multimedias/{vuelo_id}/{pedido_id}', 'descargar_multimedias');
    Route::get('/download_multimedia/{vuelo_id}', 'download_multimedia');
    Route::get('/test_correos', 'test_correos');
    Route::get('', '');
});


Route::group([ 'middleware' => 'auth'], function () {

	Route::get('/', function () {
		return redirect('/dashboard');
	});

    
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard/{vue_capture?}', 'index');
        Route::post('/test', 'test');
    });

	Route::get('pedidos_enviar_formulario/{pedido_id}', [PedidosController::class,'pedidos_enviar_formulario']);

 
    Route::prefix('admin')->group(function () {
        
        
        
        Route::resources([
            'cuenta' => UserController::class,
            'multimedias' => MultimediasController::class,
            'configs' => ConfigsController::class,
            'pilotos' => PilotosController::class,
            'globos' => GlobosController::class,
            'tabla_carga' => TablaCargaController::class,
            'zonas' => ZonasController::class,
            'vuelos' => VuelosController::class,
            'pedidos' => PedidosController::class,
            'pedidos_reservas' => ReservasExternasController::class,
            'pasajeros' => PasajerosController::class,
            'riesgos' => RiesgosController::class,
            'sop' => SopController::class,
            'pilotos_entrenamiento' => PilotosEntrenamientoController::class,
            'globo_botellas' => GloboBotellasController::class,
            'globo_bottom_end' => GloboBottomEndController::class,
            'globo_cestas' => GloboCestasController::class,
            'globo_quemadores' => GloboQuemadoresController::class,
            'configuracion/tipo_nubosidad' => TipoNubosidadController::class,
            'configuracion/turnos' => TurnosController::class,
            'configuracion/soguillas' => SoguillasController::class,
            'configuracion/soguillas_disponibilidad' => SoguillasDisponibilidadController::class,
            'checklists' => ChecklistsController::class,
            'feedback' => FeedbackController::class,
            'permission' => PermissionController::class,
            'roles' => PermissionRolesController::class,
            'users' => UserController::class,
        ]);


        Route::controller(UserController::class)->group(function () {
            Route::post('/actualizar_password', 'actualizar_password');
        });
        

        Route::controller(MultimediasController::class)->group(function () {
            Route::post('/multimedias_borrar_todos/{vuelo_id}', 'multimedias_borrar_todos');
            Route::post('/multimedias_send_notificatins', 'multimedias_send_notificatins');
            Route::get('/pedidos_enviar_multimedia/{pedido_id}/{format}', 'pedidos_enviar_multimedia');
        });

        Route::controller(ConfigsController::class)->group(function () {
            Route::get('/configs_by_grupo/{grupo}', 'configs_by_grupo');
            Route::get('/configuracion/crons', 'crons');
            Route::post('/update_configs', 'update_configs');
            Route::post('/update_configs_by_key', 'update_configs_by_key');
        });

        Route::controller(PilotosController::class)->group(function () {
            Route::get('/listado_pilotos', 'listado');
            Route::get('/piloto_con_entrenamineto/{id}', 'piloto_con_entrenamineto');
            Route::post('/status_pilotos', 'ChangeStatus');
            Route::post('/validate_pin', 'validate_pin_piloto');
        });


        Route::controller(GlobosController::class)->group(function () {
            Route::get('/listado_globos', 'listado');
            Route::post('/status_globos', 'ChangeStatus');
        });


        Route::controller(TablaCargaController::class)->group(function () {
            Route::get('/listado_tabla_carga', 'listado');
        });


        Route::controller(ZonasController::class)->group(function () {
            Route::get('/listado_zonas', 'listado');
            Route::post('/status_zonas', 'ChangeStatus');
        });

        Route::controller(VuelosController::class)->group(function () {
            Route::get('/listado_vuelos', 'listado');
            Route::get('/listado_vuelos_all', 'listado_all');
            Route::get('/listado_vuelos_disponibles/{vuelo_id}', 'listado_all_disponibles');
            Route::get('/update_vuelos', 'update_vuelos');
            Route::get('/piloto_enviar_formulario/{vuelo_id}', 'piloto_enviar_formulario');
            Route::get('/soguilla_enviar_formulario/{vuelo_id}/{soguilla_id}', 'soguilla_enviar_formulario');
            Route::get('/descargar_meteoblue/{zona_id}', 'descargar_meteoblue');
            Route::get('/multimedia_vuelos/{id}/{multimedia}', 'multimedia_vuelos');
            Route::post('/vuelo_volado', 'vuelo_volado');
            Route::post('/cancelar_vuelo_notificar_pasajeros', 'cancelar_vuelo_notificar_pasajeros');
            Route::post('/confirmar_cancelacion_vuelo', 'confirmar_cancelacion_vuelo');
            Route::post('/imprimir_diploma', 'diploma');
        });


        Route::controller(PedidosController::class)->group(function () {
            Route::get('/pedidos_listado', 'pedidos_listado');
            Route::get('/pedidos_listado_historial', 'pedidos_listado_historial');
            Route::get('/verpedidos/{orden_wordpress}', 'ver');
            Route::get('/actualizar_pedidos', 'actualizar_pedidos');
            Route::get('/actualizar_pedidos/{id}', 'actualizar_pedidos_by_id');
            Route::get('/actualizar_telefonos_pedidos/{pagina}', 'actualizar_telefonos_pedidos');
            Route::get('/update_info_pedidos/{page}', 'update_info_pedidos');
            Route::get('/update_sinc_google/{id}', 'update_sinc_google');
            Route::get('/funcion_test_google', 'funcion_test_google');
            Route::get('/funcion_test_woocommerce', 'funcion_test');
            Route::get('/sincronizar_plataforma_woocommerce/{estatus}/{fecha}', 'sincronizar_plataforma_woocommerce');
            Route::get('/pedidos_lista_de_espera', 'pedidos_lista_de_espera');
            Route::get('/pedidos_lista_espera/{vuelo}', 'pedidos_lista_espera');
            Route::post('/buscardor_numero_nombre_tlf_pedidos', 'buscardor_numero_nombre_tlf_pedidos');
            Route::post('/actualizar_contacto', 'actualizar_contacto');
            Route::post('/pedidos_agregar_pasajero', 'pedidos_agregar_pasajero');
            Route::post('/pedidos_quitar_pasajero', 'pedidos_quitar_pasajero');
            Route::post('/quitar_pasajero_pedidos/{id}', 'pedidos_quitar_pasajero_id');
            Route::post('/pedidos_fecha_vuelo', 'pedidos_fecha_vuelo');
            Route::post('/peso_extra_pedidos', 'peso_extra_pedidos');
            Route::post('/pedidos_quitar_vuelo', 'quitar_de_vuelo');
            Route::post('/agrupar_pedidos', 'agrupar_pedidos');
            Route::post('/desagrupar_pedidos', 'desagrupar_pedidos');
            Route::post('/pedidos_lista_espera', 'store_pedidos_lista_espera');
            Route::post('/pedidos_lista_espera_delete/{id}', 'pedidos_lista_espera_delete');
            Route::post('/pedidos_lista_espera_update/{id}', 'pedidos_lista_espera_update');
        });


        Route::controller(InformesController::class)->group(function () {
            Route::get('/informes/edit_vuelos_cancelados/{id}', 'edit_vuelos_cancelados');
            Route::get('/informes/edit_vuelos/{id}', 'edit_vuelos');
            Route::post('/informes/vuelos', 'vuelos');
            Route::post('/informes/vuelos_cancelados', 'vuelos_cancelados');
            Route::post('/informes/saved_vuelos', 'saved_vuelos');
            Route::post('/informes/generar_EASA', 'generar_EASA');
            Route::post('/informes/generar_pvo', 'generar_pvo');
            Route::post('/informes/sincronizar_informacion', 'sincronizar_informacion');
        });


        Route::controller(GloboBottomEndController::class)->group(function () {
            Route::get('/listado_globo_bottom_end', 'listado');
        });


        Route::controller(FormulariosController::class)->group(function () {
            Route::get('/listado_formularios', 'listado');
        });


        Route::controller(TipoNubosidadController::class)->group(function () {
            Route::get('/listado_tipo_nubosidad', 'listado');
        });


        Route::controller(SoguillasController::class)->group(function () {
            Route::get('/listado_soguillas', 'listado');
        });


        Route::controller(PermissionController::class)->group(function () {
            Route::get('/listado_permission', 'listado');
        });


        Route::controller(PermissionRolesController::class)->group(function () {
            Route::get('/listado_roles', 'listado');
        });


		Route::get('/horarios/{zona_id}', function (string $zona_id) {
			return ApiMetar($zona_id);
		});
		

    });
 
});

Route::controller(ReservaExternaController::class)->group(function () {
    Route::post('/saved_reserve', 'store'); 
    Route::post('/completed_reserve', 'update'); 
    Route::get('/completed_register_reserve/{id}', 'edit'); 
    Route::get('/register_reserve', 'register_reserve'); 
});
 
Route::get('/reserva_externa_completed', function () {
	return view('reserva_externa_completed');
});
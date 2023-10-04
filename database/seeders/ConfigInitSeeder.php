<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConfiguracionPlataforma;

class ConfigInitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		
 
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'nombre_plataforma',
		],[ 
			'tipo' => 'text',
			'nombre' => 'Nombre plataforma',
			'descripcion' => 'Nombre plataforma',
			'valor' => 'Globos Volar en Asturias',
			'grupo' => 'Plataforma',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'descripcion_plataforma',
		],[ 
			'tipo' => 'textarea',
			'nombre' => 'Descripción plataforma',
			'descripcion' => 'Descripción plataforma',
			'valor' => 'Globos Volar en Asturias',
			'grupo' => 'Plataforma',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'logo_plataforma',
		],[ 
			'tipo' => 'file',
			'nombre' => 'Logo plataforma',
			'descripcion' => 'Logo plataforma',
			'valor' => 'logo_plataforma_1.png',
			'grupo' => 'Plataforma',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'logo_2_plataforma',
		],[ 
			'tipo' => 'file',
			'nombre' => 'Logo secundario plataforma',
			'descripcion' => 'Logo secundario plataforma',
			'valor' => 'logo_plataforma_2.png',
			'grupo' => 'Plataforma',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'color_menu',
		],[ 
			'tipo' => 'color',
			'nombre' => 'Color menu',
			'descripcion' => 'Color menu',
			'valor' => '#000000',
			'grupo' => 'Diseño',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'color_text_menu',
		],[ 
			'tipo' => 'color',
			'nombre' => 'Color Texto menu',
			'descripcion' => 'Color Texto menu',
			'valor' => '#ffffff',
			'grupo' => 'Diseño',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'color_active_menu',
		],[ 
			'tipo' => 'color',
			'nombre' => 'Color Activo menu',
			'descripcion' => 'Color Activo menu',
			'valor' => '#004080',
			'grupo' => 'Diseño',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'color_active_text_menu',
		],[
			'tipo' => 'color',
			'nombre' => 'Color Activo Texto menu',
			'descripcion' => 'Color Activo Texto menu',
			'valor' => '#ff8000',
			'grupo' => 'Diseño',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'nombre_empresa',
		],[ 
			'tipo' => 'text',
			'nombre' => 'Nombre Empresa',
			'descripcion' => 'Nombre Empresa',
			'valor' => 'Volar en Asturias',
			'grupo' => 'Empresa',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'ruc_empresa',
		],[ 
			'tipo' => 'text',
			'nombre' => 'Ruc Empresa',
			'descripcion' => 'Ruc Empresa',
			'valor' => '0000000',
			'grupo' => 'Empresa',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'direccion_empresa',
		],[ 
			'tipo' => 'textarea',
			'nombre' => 'Dirección Empresa',
			'descripcion' => 'Dirección Empresa',
			'valor' => 'España',
			'grupo' => 'Empresa',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'email_empresa',
		],[ 
			'tipo' => 'email',
			'nombre' => 'Email Empresa',
			'descripcion' => 'Email Empresa',
			'valor' => 'volarenasturias@gmail.com',
			'grupo' => 'Empresa',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'telefono_empresa',
		],[ 
			'tipo' => 'test',
			'nombre' => 'Telefono Empresa',
			'descripcion' => 'Telefono Empresa',
			'valor' => '+3400000000',
			'grupo' => 'Empresa',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'nota_empresa',
		],[ 
			'tipo' => 'textarea',
			'nombre' => 'Nota Empresa',
			'descripcion' => 'Nota Empresa',
			'valor' => '',
			'grupo' => 'Empresa',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'banner_publicidad',
		],[
			'tipo' => 'file',
			'nombre' => 'Banner publicidad',
			'descripcion' => 'Banner publicidad',
			'valor' => '',
			'grupo' => 'Publicidad',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'color_bg_header_content',
		],[ 
			'tipo' => 'color',
			'nombre' => 'Color de fondo Cabeceras de secciones',
			'descripcion' => 'Color de fondo Cabeceras de secciones',
			'valor' => '#0780f8',
			'grupo' => 'Diseño',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'color_text_header_content',
		],[ 
			'tipo' => 'color',
			'nombre' => 'Color de Texto Cabeceras de secciones',
			'descripcion' => 'Color de Texto Cabeceras de secciones',
			'valor' => '#fcf8f8',
			'grupo' => 'Diseño',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'color_hover_menu',
		],[ 
			'tipo' => 'color',
			'nombre' => 'Color Hover Texto menu',
			'descripcion' => 'Color Hover Texto menu',
			'valor' => '#248ddb',
			'grupo' => 'Diseño',
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'media_expiration',
		],[ 
			'tipo' => 'number',
			'nombre' => 'Tiempo de caducidad multimedia (expresado en Meses)',
			'descripcion' => 'Tiempo de caducidad multimedia (expresado en Meses)',
			'valor' => '2',
			'grupo' => 'Vuelos',
			'visible' => true,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'media_available_format_1',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje Multimedia Disponible Formato 1',
			'descripcion' => 'Mensaje Multimedia Disponible',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'media_available_format_2',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje Multimedia Disponible Formato 2',
			'descripcion' => 'Mensaje Multimedia Disponible',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'firma_pvo',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Texto de firma de PVO',
			'descripcion' => 'Texto de firma de PVO',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'format_notificacion_link_piloto',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje whatsapp a piloto con datos del vuelo',
			'descripcion' => 'Mensaje whatsapp a piloto con datos del vuelo',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'media_available_format_3',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje Multimedia Disponible Formato Whatsapp',
			'descripcion' => 'Mensaje Multimedia Disponible Formato Whatsapp',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'format_cancel_vuelo_pedido_3',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje whatsapp de cancelacion del vuelo a pasajeros 3',
			'descripcion' => 'Mensaje whatsapp de cancelacion del vuelo a pasajeros 3',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'format_cancel_vuelo_pedido_1',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje whatsapp de cancelacion del vuelo a pasajeros 1',
			'descripcion' => 'Mensaje whatsapp de cancelacion del vuelo a pasajeros 1',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'format_cancel_vuelo_pedido_2',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje whatsapp de cancelacion del vuelo a pasajeros 2',
			'descripcion' => 'Mensaje whatsapp de cancelacion del vuelo a pasajeros 2',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'key_api_metar',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'API Key checkwxapi',
			'descripcion' => 'API Key checkwxapi',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'format_title_checklist_pilotos',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Indicaciones check list para pilotos',
			'descripcion' => 'Indicaciones check list para pilotos',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'format_notificacion_link_soguillas',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje whatsapp a soguillas con datos del vuelo',
			'descripcion' => 'Mensaje whatsapp a soguillas con datos del vuelo',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'format_title_checklist_pasajeros',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Indicaciones check list para pasajeros',
			'descripcion' => 'Indicaciones check list para pasajeros',
			'valor' => '',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'nueva_reserva',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje Administrador Nueva Reserva',
			'descripcion' => 'Mensaje Administrador Nueva Reserva',
			'valor' => '<p> </p>
			<p>Hola [nombre], se ha agregado una nueva reserva para la [fecha] en [zona].</p>
			<p> </p>
			<p>En el siguiente enlace podras acceder a la información detallada.</p>
			<p>[boton_link]</p>
			<p> </p>
			<p>Un saludo del equipo de Volar en Asturias y muchas gracias por confiar en nosotros. </p>',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'aceptar_reserva',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje Aceptar Reserva',
			'descripcion' => 'Mensaje Aceptar Reserva',
			'valor' => '<p> </p>
			<p>Hola [nombre], se ha aceptado tu reserva para la [fecha] en [zona].</p>
			<p> </p>
			<p>Un saludo del equipo de Volar en Asturias y muchas gracias por confiar en nosotros. </p>',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'cancelar_reserva',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje Cancelar Reserva',
			'descripcion' => 'Mensaje Cancelar Reserva',
			'valor' => '<p> </p>
			<p>Hola [nombre], no hemos cancelado la reserva que nos has enviado del dia [fecha] en [zona].</p>
			<p>Por la siguiente razon: [razon]</p>
			<p> </p>
			<p><br />Un saludo del equipo de Volar en Asturias y muchas gracias por confiar en nosotros. </p>',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
		
        ConfiguracionPlataforma::firstOrCreate([
			'key' => 'cambio_fecha_reserva',
		],[ 
			'tipo' => 'enriquecido',
			'nombre' => 'Mensaje Cambios de Fechas Reserva',
			'descripcion' => 'Mensaje Cambios de Fechas Reserva',
			'valor' => '<p>Hola [nombre], no hemos podido aceptar la reserva del día [fecha] en [zona]. Por la siguiente razon: [razon]</p>
			<p>En el siguiente botón podrás ingresar para ver los dias que tenemos disponibles y las zonas, selecciona alguna para cambiar de fecha tu reserva, </p>
			<p>[boton_link]</p>
			<p> </p>
			<p><br />Un saludo del equipo de Volar en Asturias y muchas gracias por confiar en nosotros. </p>',
			'grupo' => 'Correos',
			'visible' => 0,
        ]);
				
	}
}

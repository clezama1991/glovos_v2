<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = \Spatie\Permission\Models\Role::firstOrCreate([
			'name' => 'admin',
			'title' => 'Administrador',
			'description' => 'Administrador',
			'guard_name' => 'web'				
		]);
        
        $modules = [
            [
                'name' => 'flights',
                'title' => 'Vuelos',
                'modulo' => 'Vuelos',
            ],
            [
                'name' => 'orders',
                'title' => 'Pedidos',
                'modulo' => 'Pedidos',
            ],
            [
                'name' => 'passengers',
                'title' => 'Pasajeros',
                'modulo' => 'Pedidos',
            ],
            [
                'name' => 'risk_assessments',
                'title' => 'Evaluaciones de Riesgos',
                'modulo' => 'Evaluaciones de Riesgos',
            ],
            [
                'name' => 'sop',
                'title' => 'SOP',
                'modulo' => 'SOP',
            ],
            [
                'name' => 'pilots',
                'title' => 'Pilotos',
                'modulo' => 'Pilotos',
            ],
            [
                'name' => 'soguillas',
                'title' => 'Soguillas',
                'modulo' => 'Soguillas',
            ],
            [
                'name' => 'balloons',
                'title' => 'Globos',
                'modulo' => 'Globos',
            ],
            [
                'name' => 'balloons_model',
                'title' => 'Modelo de Globos',
                'modulo' => 'Globos',
            ],
            [
                'name' => 'balloons_burners',
                'title' => 'Quemadores',
                'modulo' => 'Globos',
            ],
            [
                'name' => 'balloons_baskets',
                'title' => 'Cestas',
                'modulo' => 'Globos',
            ],
            [
                'name' => 'balloons_bottles',
                'title' => 'Botellas',
                'modulo' => 'Globos',
            ],
            [
                'name' => 'bottom_end',
                'title' => 'Bottom End',
                'modulo' => 'Globos',
            ],
            [
                'name' => 'zones',
                'title' => 'Zonas',
                'modulo' => 'Zonas',
            ],
            [
                'name' => 'checklist',
                'title' => 'Check List',
                'modulo' => 'Check List',
            ],
            [
                'name' => 'types_of_clouds',
                'title' => 'Tipos de Nubosidad',
                'modulo' => 'Tipos de Nubosidad',
            ],
            [
                'name' => 'waiting_list',
                'title' => 'Lista de Espera',
                'modulo' => 'Vuelos',
            ],
            [
                'name' => 'booking',
                'title' => 'Reservas',
                'modulo' => 'Vuelos',
            ],
            [
                'name' => 'users',
                'title' => 'Usuarios',
                'modulo' => 'Accesos',
            ],
            [
                'name' => 'roles',
                'title' => 'Roles',
                'modulo' => 'Accesos',
            ]
        ];
       
        $procesos = [
            [
                'name' => 'calendar',
                'title' => 'Ver Calendario',
                'modulo' => 'Calendario',
            ],
            [
                'name' => 'orders_placed',
                'title' => 'Pedidos Realizados',
                'modulo' => 'Pedidos',
            ],
            [
                'name' => 'synchronize_orders',
                'title' => 'Sincronizar Pedidos',
                'modulo' => 'Pedidos',
            ],
            [
                'name' => 'recivied_email_reservas',
                'title' => 'Recibir correos de gestion de reservas',
                'modulo' => 'Pedidos',
            ],
            [
                'name' => 'report_completed_flights',
                'title' => 'Informe de vuelos Realizados',
                'modulo' => 'Vuelos'
            ],
            [
                'name' => 'report_canceled_flights',
                'title' => 'Informe de vuelos Cancelados',
                'modulo' => 'Vuelos'
            ],
            [
                'name' => 'admin_multimedias',
                'title' => 'Gestionar Multimedias de los vuelos',
                'modulo' => 'Vuelos'
            ],
            [
                'name' => 'configs_plataforma',
                'title' => 'Configuraciones Globales para la plataforma',
                'modulo' => 'Plataforma'
            ],
            [
                'name' => 'configs_redacciones',
                'title' => 'Redacciones Globales para la plataforma',
                'modulo' => 'Plataforma'
            ],
            [
                'name' => 'automated_tasks',
                'title' => 'Ver Tareas Automatizadas',
                'modulo' => 'Plataforma'
            ]
        ];

        $methods = [
            [
                'name' => 'create',
                'title' => 'Crear'
            ],
            [
                'name' => 'read',
                'title' => 'Consultar'
            ],
            [
                'name' => 'update',
                'title' => 'Actualizar'
            ],
            [
                'name' => 'delete',
                'title' => 'Eliminar'
            ]
        ];
        
        
        foreach($modules as $key => $modulo){

            foreach($methods as $key_method => $method){

                $name_permision = $modulo['name'].'-'.$method['name'];
                $name_permision_text = $modulo['title'].' '.$method['title'];

                $permission = \Spatie\Permission\Models\Permission::firstOrCreate([
                    'name' => $name_permision,
                    'description' => $name_permision_text,
                    'modulo' => $modulo['modulo'],
                    'guard_name' => 'web'			
                ]);      

                $roleAdmin->givePermissionTo($permission);   

            }

        }
        
        
        foreach($procesos as $key => $modulo){

            $permission = \Spatie\Permission\Models\Permission::firstOrCreate([
                'name' => $modulo['name'],
                'description' => $modulo['title'],
                'modulo' => $modulo['modulo'],
                'guard_name' => 'web'			
            ]);      

            $roleAdmin->givePermissionTo($permission);   

        }

        $UserAdmin = User::where('email','admin@admin.com')->first();
        $UserAdmin->assignRole('admin');


    }
}

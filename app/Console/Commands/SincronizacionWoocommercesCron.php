<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Automattic\WooCommerce\Client;
use App\Models\Vuelos as ModeloPrincipal;
use App\Models\Pedidos;
use App\Models\BitacorasCron;

class SincronizacionWoocommercesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sincronizacion:woocommerce';

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

        $vuelos = ModeloPrincipal::where('estatus', 'Volado')->where('sincronizado_woocommerce', false)->get();

        $woocommerce = new Client(
            'https://volarenasturias.com/', // Your store URL
            'ck_adc18e8aae2d804776a371eac162a6fcc6359412', // Your consumer key
            'cs_8c790773e9d1c51dc6a600385e1a918c3863f315', // Your consumer secret
            [
                'timeout' => 120, // SET TIMOUT HERE
                'wp_api' => true, // Enable the WP REST API integration
                'version' => 'wc/v3' // WooCommerce WP REST API version
            ]
        );

        try {
            foreach ($vuelos as $key_vuelos => $vuelo) {

                foreach ($vuelo->Pedidos->where('origen','woocommerce') as $key => $value) {

                    $data = [
                        'status' => 'vuelo-realizado'
                    ];
                    
                    $woocommerce->put('orders/' . $value->orden_wordpress, $data);

                    foreach ($value->agrupaciones as $key_agrupacion => $agrupacion) {
                        if($agrupacion->origen == 'woocommerce'){
                            $woocommerce->put('orders/' . $agrupacion->orden_wordpress, $data);
                        }
                    }
                }
                $vuelo->sincronizado_woocommerce = true;
                $vuelo->save();
            }

        } catch (\Throwable $th) {

            BitacorasCron::create([
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i'),
                'estatus' => 'error',
                'tipo' => 'Sincronizar Con Woocommerce',
                'nota' => $th->getMessage()
            ]);

        }

        BitacorasCron::create([
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i'),
            'estatus' => 'exitoso',
            'tipo' => 'Sincronizar Con Woocommerce',
            'nota' => count($vuelos).' pedidos sincronizados',
        ]);

    }
}

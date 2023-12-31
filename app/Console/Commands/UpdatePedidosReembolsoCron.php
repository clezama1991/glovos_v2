<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pedidos;
use App\Models\BitacorasCron;
use Automattic\WooCommerce\Client;

class UpdatePedidosReembolsoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updatepedidos:reembolsoCron';

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

        
        $data = [
            'page' => 1, 
            'per_page' => 100, 
            'status' => ['refunded']
        ];
        
        try {
            $pedidos = $woocommerce->get('orders', $data);
            
            $nro = 0;
            foreach ($pedidos as $key => $pedido) {
            
                $pedidos_existe = Pedidos::where('reembolso',false)->where('orden_wordpress',$pedido->id)->first();

                if($pedidos_existe){            
                    $pedidos_existe->reembolso = true;
                    $pedidos_existe->save();

                    $nro++;
                }
                
            }

        } catch (\Throwable $th) {

            BitacorasCron::create([
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i'),
                'estatus' => 'error',
                'tipo' => 'Pedidos Reembolsados',
                'nota' => $th->getMessage()
            ]);

        }

        BitacorasCron::create([
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i'),
            'estatus' => 'exitoso',
            'tipo' => 'Sincronizar Con Woocommerce',
            'nota' => $nro.' pedidos reembolsados',
        ]);

    }
}

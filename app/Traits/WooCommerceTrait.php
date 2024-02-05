<?php

namespace App\Traits;

use App\Observers\ModelObserver;
use Illuminate\Database\Eloquent\Model;
use App\Models\BitacoraModels\Bitacora;

trait WooCommerceTrait
{
    public function WooCommerce($data, $accion, $retorna)
    {    
        if(encontrar_configuracion('enable_woocommerces')){
            
            $woocommerce_auth = woocommerceAuth();

            if($accion=='list'){                
                $retorna = $woocommerce_auth->get('orders', $data);
            }
            if($accion=='get'){                
                $retorna = $woocommerce_auth->get('orders', $data);
            }
            
        }



        return $retorna;

    }
}
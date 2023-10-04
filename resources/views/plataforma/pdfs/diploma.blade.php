
<html>
<head>
   <style>
    
</style> 
</head>
<body style="font-size:13px"> 
    <?php $i = 1; ?>
    @foreach ($records as  $item)
    

                <table width="100%" style="position: absolute !important"> 
                    <tr width="100%">
                        <td style="padding-top: 387px; padding-left: 365px; font-size: 17px; font-family:Arial, Helvetica, sans-serif">
                            {{$item->pasajero->nombres}} {{$item->pasajero->apellidos}}
                        </td> 
                    </tr>
                </table>
    
                <table width="100%" style="position: absolute !important"> 
                    <tr width="100%">
                        <td style="padding-top: 455px; padding-left: 650px; font-size: 17px; font-family:Arial, Helvetica, sans-serif">
                            {{\Carbon\Carbon::parse($item->pedido->vuelo->fecha)->format('d/m/Y') ?? null}}
                        </td> 
                    </tr>
                </table>

                <table width="100%" style="position: absolute !important"> 
                    <tr width="100%">
                        <td style="padding-top: 660px; padding-left: 870px; font-size: 17px; font-family:Arial, Helvetica, sans-serif">
                            {{$item->pedido->vuelo->piloto->nombres ?? null}} {{$item->pedido->vuelo->piloto->apellidos ?? null}}


                         </td> 
                    </tr>
                </table>
    
                </div>
            </div>
        </div>





    </div>

        </div></td></tr></table>    </div>



</div>

@if ($i < $cantidad_pagina)
    <div style="page-break-before: always;"></div>   
@endif
 
<?php $i++; ?>

@endforeach
</body>
</html>
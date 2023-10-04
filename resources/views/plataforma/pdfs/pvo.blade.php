
<html>
<head>
   <style>
 table.sample {
	border-width: 0px;
	border-spacing: 0px;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
    margin-bottom: 10px;
}
table.sample th {
	border-width: 1px;
	padding: 1px;
	border-style: inset;
	border-color: gray;
	-moz-border-radius: ;
}
table.sample td {
	border-width: 1px;
	padding: 1px;
	border-style: inset;
	border-color: gray;
	-moz-border-radius: ;
}
  td { vertical-align:top;
}
       .bg_color0 {
    background-color: #244395 !important;
    color: #fff !important;
    font-weight: bold !important;
    border-radius: 10px !important;
    padding: 5px !important;
}
       .bg_color1 {
    background-color: #4F81BD !important;
    color: #fff !important;
    font-weight: bold !important;
    border-radius: 10px !important;
    padding: 5px !important;
}
       .bg_color2 {
    background-color: #B8CCE4 !important;
    color: #000 !important;
    font-weight: bold;
    border-radius: 10px;
    padding: 5px;
}
</style> 
</head>
<body style="font-size:13px"> 
    <?php $i = 1; ?>
    @foreach ($records as  $item)
    

    <table width="100%">

        <tr width="100%" class="bg_color0">
            <td align="center" style="padding: 10px">PLAN DE VUELO OPERATIVO 	
            </td> 
        </tr>
    </table>
    <table width="100%" class="sample">
        <tr class="bg_color1">
            <td align="center">MODELO GLOBO</td>
            <td align="center">MATRICULA</td>
            <td align="center">MTOW </td>
            <td align="center">MLW </td>
        </tr>
        <tr> 
             <td align="center"> {{ ($item->globo)?$item->globo['modelo']:'' }} </td>
            <td align="center"> {{ ($item->globo)?$item->globo['matricula']:'' }}</td>
            <td align="center"> {{ ($item->globo)?$item->globo['mtom']:'' }} kg.</td>
            <td align="center"> -0- kg.</td>
        </tr>
    </table>


    <table width="100%">

        <tr width="100%">  
            <td width="33%"  align="center">
                <img src="images/tabla_pvo.png" alt="" width="250px"  align="center">

                        
                    <table  width="100%" class="sample">
                        <tr>
                            <td width="70%">SEGOVIA	</td><td></td>                   
                        </tr>
                        <tr>                        
                            <td>TOLEDO	</td><td></td>
                        </tr>
                        <tr>
                            <td>ARANJUEZ	</td><td></td>
                        </tr>
                        <tr>
                            <td>SALAMANCA	</td><td></td>
                        </tr>
                        <tr>
                            <td>VALLADOLID</td><td></td>
                        </tr>
                        <tr>
                            <td>V.DEL CASTILLO	</td><td></td>
                        </tr>
                        <tr>
                            <td>MERIDA	</td><td></td>
                        </tr>
                        <tr>
                            <td>VALDECAÑAS	</td><td></td>
                        </tr>
                        <tr>
                            <td>*Subiendo hasta 1.500 m/o máx zona	</td><td></td>
                        </tr>
                    </table>


                    <table class="table" style="margin-bottom: 60px">
                        <tr>
                            <td>Observaciones:</td>
                        </tr>
                    </table>
                    
                    
                    <table class="table">
                        <tr>
                            <td>"Por la presente declaro que he descansado las horas que marca el Manual de Operaciones de Siempre en las nubes en su parte E, y que cumplo con lo establecido en la parte C, del mismo manual, en lo referente al consumo de alcohol, narcóticos y drogas.

                                <br><br>
                                <br><br>

                                El Piloto"						
                            </td>
                        </tr>
                    </table>


            </td>
            <td width="33%">
                <table class="table sample" width="100%">
                    <tr  class="bg_color1">
                        <td>Volumen ft3</td>
                        <td>R. Tabla kg</td>
                        <td>/ 1000  </td>
                        <td>ft = Carga <br> disponible kg</td>
                    </tr>                    
                    <tr  class="bg_color2">
                        <td>-0-
                        </td>
                        <td>-0-
                        </td>
                        <td>/1000=
                        </td>
                        <td>-0-
                        </td>
                    </tr>
                </table>

                <table class="table " width="100%">
                    <tr width="100%">
                         <td>
                             <table width="100%" class=" sample">

                    <tr width="100%">
                        <td>Material

                                </td> 
                        <td align="right">
                            Peso en kg.
                        </td>
                    </tr>
                    <tr>
                        <td>Barquilla </td> 
                        <td align="right"> {{ ($item->globo)?$item->globo['peso_cesta']:'' }} </td>
                    </tr> 
                    <tr>
                        <td>Quemador (completo) </td> 
                        <td align="right">	-0-</td>
                    </tr> 
                    <tr>
                       <td> Botella 1 (40) llena </td>
                       <td align="right">	{{ ($item->globo)?$item->globo['peso_botellas']:'' }} </td>
                    </tr> 
                    <tr>
                       <td> Botella 2 (40) llena </td> 
                       <td align="right">	 -0-</td>
                    </tr> 
                    <tr>
                       <td> Botella 3 (40) llena </td>
                        <td align="right">	-0-</td>
                    </tr> 
                    <tr>
                       <td> Botella 4 (40) llena </td> 
                       <td align="right">	-0-/td>
                    </tr> 
                    <tr>
                       <td> Parece buena solución </td> 
                       <td align="right">.	-0-</td>
                    </tr> 
                    <tr>
                       <td> Varios </td> 
                       <td align="right">	-0-</td>
                    </tr> 

                    <tr class="bg_color2">
                        <td> Tara globo+gas </td> 
                        <td align="right">	{{ ($item->globo)?$item->globo['peso_globo']:'' }}    </td>
                    </tr> 
                    
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr class="bg_color1">
                        <td colspan="2"> Pasajeros y tripulación
                        </td>
                    </tr> 
                    
                    <tr class="bg_color1">
                        <td colspan="2"> Equipaje y ropa de nºpax
                        </td>
                    </tr> 
                    <tr>
                        <td > Piloto
                        </td>
                        <td align="right">	{{ ($item->piloto)?$item->piloto['peso']:'' }} </td>
                    </tr> 
                    @foreach ($item->pasajeros as $pass)     
                        <tr>
                            <td> {{ isset($pass['nombres'])?$pass['nombres']:'' }} {{ isset($pass['apellidos'])?$pass['apellidos']:'' }}
                            </td>
                            <td align="right">{{ isset($pass['peso'])?$pass['peso']:'' }}</td>
                        </tr>
                    @endforeach
 
                    <tr>
                        <td > Silla Adaptada1
                        </td>
                        <td align="right">-0-</td>
                    </tr>  
                    <tr>
                        <td > Silla Adaptada2
                        </td>
                        <td align="right">-0-</td>
                    </tr>  
                    <tr>
                        <td > Equipaje
                        </td>
                        <td align="right">-0-</td>
                    </tr>  
                    <tr class="bg_color2">
                        <td > Peso pasajeros y tripulación
                        </td>
                        <td align="right">-0-</td>
                    </tr>  
                    <tr>
                        <td colspan="2"><br></td>
                    </tr>
                    <tr class="bg_color1">
                        <td > Tara globo+personas
                        </td>
                        <td align="right">-0-</td>
                    </tr> 
                </table></td>
                        </tr>   
                </table>
     
            </td>
        
            <td width="33%">
                
                    <table class="table sample" width="100%">
                        <tr class="bg_color1">
                            <td>Zona de vuelo

                                    </td>
                                </tr>
                                
                                <tr>
                            <td>
                                {{ ($item->zona)?$item->zona['nombre']:'' }}
                            </td>
                        </tr>
                    </table>
                    
                    <table class="table sample" width="100%">
                        <tr class="bg_color1">
                            <td>Fecha de vuelo
                                    </td>
                                </tr>
                                
                                <tr>
                            <td>
                                {{ ($item->vuelo)?$item->vuelo['fecha']:'' }}
                            </td>
                        </tr>
                    </table>
                    
                    <table class="table sample" width="100%">
                        <tr class="bg_color1">
                            <td>Temperatura al despegue

                                    </td>
                                </tr>
                                
                                <tr>
                            <td>
                                -0- Grados
                            </td>
                        </tr>
                    </table>
                    
                    <table class="table sample" width="100%">
                        <tr class="bg_color1">
                            <td>Conversor
                                    </td>
                                </tr>
                                
                                <tr class="bg_color2">
                            <td>
                                Metros a pies

                            </td>
                        </tr>
                                <tr class="bg_color2">
                            <td>
                                1 m = 3,2808399 ft

                            </td>
                        </tr>
                        <tr>
                            <td>
                              <hr>

                            </td>
                        </tr> 
                        <tr class="bg_color2"><td>-0-                        </td></tr>
                        <tr class="bg_color2"><td>-0-                        </td></tr>
                        <tr class="bg_color2">
                    <td>
                        Pies a metros


                    </td>
                </tr>
                        <tr class="bg_color2">
                    <td>
                        1 m = 3,2808399 ft

                    </td>
                </tr>
                <tr>
                    <td>
                      <hr>

                    </td>
                </tr> 
                <tr class="bg_color2"><td>-0-                        </td></tr>
                <tr class="bg_color2"><td>-0-                        </td></tr>
                    </table>



                    <table class="table sample" width="100%">
                        <tr class="bg_color1">
                            <td>Peso disponible en kg.


                                    </td>
                                </tr>
                                
                                <tr>
                            <td>
                               -0-

                            </td>
                        </tr>
                    </table>
                    <table class="table sample" width="100%">
                        <tr class="bg_color1">
                            <td>Margen en kg. 19 pax



                                    </td>
                                </tr>
                                
                                <tr>
                            <td>
                                -0-

                            </td>
                        </tr>
                    </table>
                     	




                    <table class="table sample" width="100%">
                        <tr class="bg_color1">
                            <td width="80%">CALCULO 
                                    </td>
                                    <td>
                                        COMBUS.
                                    </td>
                                </tr>
                                
                                <tr>
                            <td >
                                Duración estimada	

                            </td>
                            <td>
                                -0-

                            </td>
                        </tr>
                                <tr>
                            <td>
                                Combustible requerido		

                            </td>
                            <td>
                                -0-

                            </td>
                        </tr>
                    </table>


                    <table class="table sample" width="100%">
                        <tr class="bg_color1">
                            <td colspan="2">METEO AL DESPEGUE
                                    </td>
                                </tr>
                                
                            <tr>
                                <td width="80%"> Fuente</td><td>-0- </td>
                            </tr>
                            <tr>
                                <td> Viento superficie</td><td>-0- </td>
                            </tr>
                            <tr>
                                <td> Viento 100 m</td><td> -0-</td>
                            </tr>
                            <tr>
                                <td> Viento 600 m</td><td>-0- </td>
                            </tr>
                            <tr>
                                <td> Visibilidad	</td><td> -0-</td>
                            </tr>
                    </table>
                     	

                    
                    <table class="table sample" width="100%">
                            <tr class="bg_color1">
                                <td width="80%"> DESPEGUE</td><td> HORA	</td>
                            </tr>
                            <tr>
                                <td> 
                                    {{ ($item->vuelo)?$item->vuelo['lugar_despegue']:'' }} 
                                </td>
                                <td> 
                                    {{ ($item->vuelo)?$item->vuelo['hora_despegue']:'' }}
                                 </td>
                            </tr>
                    </table>
                    <table class="table sample" width="100%">
                        
                            <tr class="bg_color1">
                                <td width="80%"> ATERRIZAJE</td><td> 	HORA	</td>
                            </tr>
                            <tr>
                                <td> 
                                    {{ ($item->vuelo)?$item->vuelo['lugar_aterrizaje']:'' }} 
                                </td>
                                <td> 
                                    {{ ($item->vuelo)?$item->vuelo['hora_aterrizaje']:'' }}
                                 </td>
                            </tr>
                            
                    </table>
                    <table class="table sample" width="100%">
                            <tr class="bg_color1">
                                <td> TOTAL VUELO	</td>
                            </tr>
                            <tr>
                                <td>-0-</td>
                            </tr>
                            
                    </table>
                    <table class="table sample" width="100%">
                            <tr class="bg_color1">
                                <td> TIEMPO TOTAL LIBRO AERONAVE	</td>
                            </tr>
                            <tr>
                                <td>-0- </td>
                            </tr>
                    </table>
                     	 













                    
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
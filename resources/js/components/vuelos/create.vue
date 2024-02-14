<template>

  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

              <i class="fas fa-plane-departure text-dark"></i>                     
              Registrar Vuelo
              </span>
          </h3>

        </div>
  
        <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
            <div class="card-body">
                   
              <div class="row">
                <div class="col-md-4"> 
                  <label for="zona_id" class="requerido">Zona</label>
                  <select class="form-control selectpicker" id="selectpicker_zonas" required data-live-search="true" v-model="form.zona_id" @change="CargarZona">
                    <option value="">Seleccione</option>
                    <option :value="item.id" v-for="(item, index) in Zonas" :key="index">{{item.nombre}}</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="zona_id" class="requerido">Zona Despegue</label>
                    <select class="form-control selectpicker" id="selectpicker_zonas_desp" required data-live-search="true" v-model="form.zona_despegue">
                      <option value="" selected disabled>Seleccione</option>
                      <option v-for="(item, index) in zonas_despegues" :key="index" :value="item.id">{{item.nombre}}</option>
                     </select>
                  </div> 
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="zona_id" class="requerido">Globo  
                      <span class="badge badge-pill" :class="['nivel'+niveldiferido]"  data-toggle="modal" data-target="#Diferidos" v-if="all_diferidos.length>0">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Diferido
                      </span> 
                    </label>
                    <select class="form-control selectpicker" id="selectpicker_globos" required data-live-search="true" v-model="form.globo_id" @change="BuscarDiferdidos()">
                      <option value="" selected disabled>Seleccione</option>
                      <option v-for="(item, index) in Globos" :key="index" :value="item.id" :disabled="item._rowVariant">{{item.nombre}}</option>
                     </select>
                  </div> 
                </div> 
              <div class="col-md-12 mb-3">
                <div class="row bg-light-primary p-2">
                  <div class="col-1 d-none d-md-block mb-3">
                    <img
                      :src="'images/ocaso.webp'"
                      class="img-fluid rounded-lg"
                    />
                  </div>
                  <div class="col-xs-2 col-md-2 col-6 m-0 pt-2">
                    <div class="form-group mb-0">
                      <label for="amanecer">Amanecer</label>
                      <input
                        id="amanecer"
                        type="text"
                        class="form-control input_info"
                        v-model="form.amanecer"
                        readonly
                      />
                    </div>
                  </div>
                  <div class="col-xs-2 col-md-2 col-6 m-0 pt-2">
                    <div class="form-group mb-0">
                      <label for="orto"
                        ><i class="fa fa-sun mr-2" aria-hidden="true"></i>
                        Orto</label
                      >
                      <input
                        id="orto"
                        type="text"
                        class="form-control input_info"
                        v-model="form.orto"
                        readonly
                      />
                    </div>
                  </div>
                  <div class="col-xs-2 col-md-2 col-6 m-0 pt-2">
                    <div class="form-group mb-0">
                      <label for="ocaso">
                        <i class="fa fa-moon mr-2" aria-hidden="true"></i>
                        Ocaso</label
                      >
                      <input
                        id="ocaso"
                        type="text"
                        class="form-control input_info"
                        v-model="form.ocaso"
                        readonly
                      />
                    </div>
                  </div>
                  <div class="col-xs-2 col-md-2 col-6 mb-3 pt-2">
                    <div class="form-group mb-0">
                      <label for="anochecer">Anochecer</label>
                      <input
                        id="anochecer"
                        type="text"
                        class="form-control input_info"
                        v-model="form.anochecer"
                        readonly
                      />
                    </div>
                  </div>
                </div>
              </div>

                <div class="col-md-4 mb-3">
                  <div class="form-group">
                    <label for="piloto_id">Piloto</label>
                    <select class="form-control selectpicker" id="selectpicker_pilotos" required data-live-search="true" v-model="form.piloto_id">
                      <option value="" selected disabled>Seleccione</option>
                      <option v-for="(item, index) in PilotosByNivel" :key="index" :value="item.id" :disabled="item.fechas_caducadas || form.globo_id==''">{{item.FullName}}</option>
                    </select>
                  </div> 
                </div> 
                <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input v-model="form.fecha" id="fecha" type="date" class="form-control" required>
                  </div> 
                </div>
                <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="hora">Hora</label>
                    <input v-model="form.hora" id="hora" type="time" class="form-control">
                  </div> 
                </div>
                <div class="col-md-4 mb-3">
                  <div class="form-group">
                    <label for="duracion_estimada">Duración Est.(Min.)</label>
                    <input v-model="form.duracion_estimada" id="duracion_estimada" type="text" v-numero class="form-control"> 
                  </div> 
                </div>   
                <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="gas">Kg de Gas</label>
                    <input v-model="form.gas" @blur="ValidarCalculo('gas')" id="gas" type="text" v-numero class="form-control"> 
                  </div> 
                </div>   
                <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="reserva">Reserva</label>
                    <input v-model="form.reserva" @blur="ValidarCalculo('reserva')" id="reserva" v-numero type="text" class="form-control">
                  </div> 
                </div> 
                <div class="col-md-4 mb-3">
                  <div class="form-group pb-1 mb-1">
                    <label for="parte_mateo">Parte METEO</label>
                      <b-form-file 
                        id="parte_mateo"
                        ref="form_parte_mateo"
                        placeholder="Buscar PARTE METEO..."
                        drop-placeholder="Suelta el archivo aquí..."
                      ></b-form-file>
                  </div> 
                  <div v-if="url_meteo==null">
                      <a class="btn btn-sm btn-danger disabled" disabled>
                        <i class="fa fa-download" aria-hidden="true"></i> Descargar de Meteoblue</a>
                        <p class="text-muted text-danger">No hay url de meteoblue en la zona</p>
                  </div>
                  <div v-else>  
                    <span v-if="load_meteoblue=='no'">
                      <a @click="DescargarMeteoblue()" class="btn btn-sm btn-danger" :class="{'disabled' : form.zona_id==''}" :disabled="form.zona_id==''">
                      <i class="fa fa-download" aria-hidden="true"></i> Descargar de Meteoblue</a>
                    </span>
                    <span v-else-if="load_meteoblue=='si'">  
                      <a class="btn btn-sm btn-warning"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Descargando</a>
                    </span>
                    <span v-else-if="load_meteoblue=='cargado'">
                      <a :href="'/uploads/'+form.parte_meteo_meteoblue" target="_blank" class="btn btn-sm btn-success">
                      <i class="fa fa-check" aria-hidden="true"></i> Meteoblue Descargado</a>
                    </span>
                  </div>
  
                </div>
                <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="temperatura">Temperatura</label>
                    <input v-model="form.temperatura" id="temperatura" v-numero type="text" class="form-control">
                  </div> 
                </div> 
                
                <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="tipo_nubosidad_id">Tipo Nubosidad</label>
                    <select class="form-control selectpicker" id="selectpicker_tipo_nubosidad" required data-live-search="true" v-model="form.tipo_nubosidad_id">
                      <option value="" selected disabled>Seleccione</option>
                      <option v-for="(item, index) in TipoNubosidad" :key="index" :value="item.id">{{item.nombre}}</option>
                     </select>
                  </div> 
                </div>
                <div class="col-md-4 mb-3">
                  <div class="form-group">
                    <label for="altura_maxima ">Altura max. de vuelo (Metros)</label>
                    <input v-model="form.altura_maxima" id="altura_maxima" v-numero type="text" class="form-control">
                  </div> 
                </div> 
                <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="viento ">Viento</label>
                    <input v-model="form.viento" id="viento" type="text" class="form-control">
                  </div> 
                </div> 
                <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="qnh ">QNH</label>
                    <input v-model="form.qnh" id="qnh" type="text" class="form-control">
                  </div> 
                </div> 
                <div class="col-md-4 mb-3">
                  <div class="form-group">
                    <label for="soguillas">Soguillas</label>
                    <select class="form-control selectpicker" title="Seleccione" multiple id="selectpicker_soguillas" data-live-search="true" v-model="form.soguillas">
                      <option value="" selected disabled>Seleccione</option>
                      <option v-for="(item, index) in Soguillas" :key="index" :value="item.id">{{item.FullName}}  {{ item.turno_a  ? '('+item.turno_a+')' : 'xx' }} ( {{ item.disponible ? 'Disponible' : 'No Disponible'}} ) </option>
                     </select> 
                  </div> 
                </div> 
              </div>
              <div class="row">
                <!-- <div class="col-md-4 mb-3">
                  <div class="form-group">
                    <label for="tabla_carga">Tabla de carga</label>
                      <b-form-file 
                        id="tabla_carga"
                        ref="form_tabla_carga"
                        placeholder="Buscar Tabla de carga..."
                        drop-placeholder="Suelta el archivo aquí..."
                      ></b-form-file>
                  </div> 
                </div> -->
                <!-- <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="tabla_carga_maxima_manual">Valor Tabla Carga</label>                    
                    <input v-model="form.tabla_carga_maxima_manual" id="tabla_carga_maxima_manual" v-numero type="text" class="form-control">

                  </div> 
                </div>  -->

              </div>
              <div class="row">
                <!-- <div class="col-md-2 mb-3">
                  <div class="form-group">
                    <label for="reserva">Valor Tabla Carga</label>                    
                    <input :value="form.tabla_carga_maxima" disabled id="temperatura" v-numero type="text" class="form-control form-control-solid">

                  </div> 
                </div>  -->
                <!-- <div class="col-md-3 mb-3">
                  <div class="form-group">
                    <label for="reserva">Seleccionar Tabla Carga</label>
                    <a
                      class="btn btn-primary"
                      data-toggle="modal"
                      data-target="#VerTabla"
                    >
                      Seleccionar Tabla
                    </a>
                  </div> 
                </div>  -->
                <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <label for="nota">Notas</label>
                    <textarea v-model="form.notas" id="nota" type="text" class="form-control">
                    </textarea>
                  </div> 
                </div> 

                
                <div class="col-12">
 
                  <div class="card mb-5">

                    <header_card icon="fas fa-plane-departure text-dark" titulo="Tabla Carga" tipo="sub"></header_card>

                    <div class="card-body">
                          <div class="form-group mb-8 d-none">
														<div class="alert alert-custom alert-default" role="alert">
															<div class="alert-icon">
																<span class="svg-icon svg-icon-primary svg-icon-xl">
																<i class="fas fa-exclamation-circle text-warning"></i>
																</span>
															</div>
															<div class="alert-text">
                                Puedes cargar la tabla de carga manualmente si lo tienes a papel, o si prefieres puedes utilizar el generador automatico de la tabla de carga presionando el boton <strong>"Generar tabla de Carga"</strong>

                                <br>
                                <br>
                                Intrucciones para la carga manual:
                                <br>
                                1. Presiona el campo de archivo "Tabla de carga"
                                <br>
                                2. Selecciona la imagen de la tabla
                                <br>
                                3. Ingresa el valor de la carga
                                <br>

                                <br>
                                <br>
                                Intrucciones para la carga desde el generador:
                                <br>
                                1. Presiona el boton "Generar tabla de Carga"
                                <br>
                                2. Ubica en la imagen la posicion de la carga
                                <br>
                                3. Confirma el valor que presionaste, si no estas de acuerdo, presiona "no" y intentalo nuevamente.
                                <br>
                                4. El sistema rellena automaticamente el campor "valor de la cagra" en el formulario
                                <br>
                                5. Presiona el campo de archivo "Tabla de carga" y selecciona la imagen que se acaba de descargar
                                <br>

                                <br>
                                <br>
                                <br>
                                <br>

                                
                                Sigue esos pasos para completar el formulario de vuelos.
                                
                              </div>
														</div>
													</div>


                          <div class="row">
                            
                            <div class="col-md-12 mb-15 text-center"> 
                                <a
                                  class="btn btn-danger"
                                  data-toggle="modal"
                                  data-target="#VerTabla"
                                >
                                 Generar tabla de Carga
                                </a> 
                            </div>  
                            <div class="col-md-4 mb-3">
                              <div class="form-group">
                                <label for="tabla_carga">Tabla de carga</label>
                                  <b-form-file 
                                    id="tabla_carga"
                                    ref="form_tabla_carga"
                                    placeholder="Buscar Tabla de carga..."
                                    drop-placeholder="Suelta el archivo aquí..."
                                  ></b-form-file>
                              </div> 
                            </div> 
                            <div class="col-md-2 mb-3">
                              <div class="form-group">
                                <label for="tabla_carga_maxima">Valor Tabla Carga</label>                    
                                <input v-model="form.tabla_carga_maxima" id="tabla_carga_maxima" v-numero type="text" class="form-control"> 
                              </div> 
                            </div> 
                            <div class="col-md-4 mb-3">
                              <div class="form-group">
                                <label for="carga_maxima">CARGA MAXIMA ACTUAL</label>                    
                                <input :value="form.carga_maxima" id="carga_maxima" v-numero type="text" class="form-control form-control-solid">

                              </div> 
                            </div> 
                          </div>
                    </div>
                  </div>
                </div>

              </div> 
                 
            </div>

            
            <div class="card-footer">
              <router-link to="/" class="btn btn-secondary mr-2" v-if="dashboard">
                <i class="fa fa-undo"></i> Volver
              </router-link>
              <router-link to="/vuelos" class="btn btn-secondary mr-2" v-else>
                <i class="fa fa-undo"></i> Volver
              </router-link>

              <button
                type="submit"
                class="btn btn-success mr-3 float-right"
                :disabled="GuardandoCambios"
                @click="action='guardar_cerrar'"
              >
                <span v-if="GuardandoCambios">
                  <i class="fas fa-spinner fa-spin"></i> Guardando...
                </span>
                <span v-else> <i class="fa fa-save"></i> Guardar y Cerrar </span>
              </button>
              
              <button
                type="submit"
                class="btn btn-primary mr-3 float-right"
                :disabled="GuardandoCambios"
                @click="action='guardar'"
              >
                <span v-if="GuardandoCambios">
                  <i class="fas fa-spinner fa-spin"></i> Guardando...
                </span>
                <span v-else> <i class="fa fa-save"></i> Guardar </span>
              </button>

            </div> 
           </form>
 

       
      </div>

    </div>

    <div class="modal fade" id="VerTabla" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Tabla de Carga
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <div class="modal-body modal-body-tabla-carga" id="imgtablacarga">  
                <span id="toolTipBoxNone"></span>    
                <img :src="'images/tabla_carga_imagen_hd_2.jpg'" border="0" style="cursor:crosshair" @click="toolTip()">
              </div>
              <div class="card-footer">                    
                <button type="button" class="btn btn-light-primary font-weight-bold close2" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
      </div>
    </div>


    <div class="modal fade" id="Diferidos" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
      <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Diferidos
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <div class="modal-body " v-if="globo">  
              
                <div class="row">  
                <div class="col-md-5">
                  <div class="card card-info mb-5">  
                    <header_card icon=" " titulo="Cuadriculas" tipo="sub"></header_card> 
                    <div class="card-body">
                      <div class="row">  
                        <div class="col-md-12 d-flex justify-content-center">
                          <table class="table-bordered table-cuadricula">
                            <tbody> 
                              <tr v-for="(x, indexx) in globo.mapa_cuadricula ?? []" :key="indexx">
                                <td  
                                  v-for="(y, indexy) in x" 
                                  :key="indexy" 
                                  @click="BuscarDiferidos(y['id']), cuadricula_title=y['title']"                                    
                                  style="width: 30px; height: 30px;"
                                  v-b-popover.hover.html="y['diferido'] ? y['detalle'] : 'No hay registro'" :title="y['diferido'] ? 'Ultimo Diferido' : 'Sin Diferido'"
                                  >
                                  <span class="round-button" :class="['nivel'+y['fondo']]" >
                                    {{ y['title'] }}
                                  </span>                                    
                                </td>
                              </tr>
                            </tbody>
                          </table> 
                        </div> 
                      </div> 
                    </div> 
                  </div> 
                </div>  


                <div class="col-md-7"> 
                  <div class="card card-info mb-5">  
                    <header_card icon=" " titulo="Todos Los Diferidos del Globo" tipo="sub"></header_card>   <div class="card-body">
                      <table class="table table-bordered table-striped table-bordere table-hover">
                          <thead>
                              <tr>
                                  <th scope="col" class="text-center">Seccion</th>
                                  <th scope="col" class="text-center">Nivel</th>
                                  <th scope="col" class="text-center">Detalle</th>
                                  <th scope="col" class="text-center">Estatus</th>
                                  <th scope="col" class="text-center">Fecha</th>
                              </tr> 
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in all_diferidos" :key="index">
                              <td>
                                <span class="badge badge-pill h6" :class="['nivel'+item.fondo]">
                                {{item.globo_cuadricula.title??null}}
                                </span>
                              </td>
                              <td>
                                <span class="badge" :class="['nivel'+item.fondo]">

                                  {{item.gravedad}}
                                </span>
                              </td>
                              <td>
                                <span v-html="item.detalle"></span>
                              </td>
                              <td>
                                {{ item.solucionado ? 'Solucionado' : 'Reportado' }}
                              </td>
                              <td>
                                {{ item.created_at | formatDate }} 
                              </td>
                            </tr>
                          </tbody>
                      </table>
                    </div> 
                  </div>
                </div>
                
 
              </div> 
               
              </div>
              <div class="card-footer text-right">                    
                <button type="button" class="btn btn-light-danger font-weight-bold close2" data-dismiss="modal"> <i class="fa fa-check-circle" aria-hidden="true"></i> Confirmar  de Enterado</button>
              </div>
          </div>
      </div>
    </div>

  </div>

</template>

<style type="text/css">
    .input_info{
      border: 0;
      padding: 0;
      margin: 0;
      background: transparent;
      height: 15px;
      font-weight: 600;
    }
    .input_info[readonly] {
      background: transparent;
    }

    .modal-body-tabla-carga { 
      overflow-x: auto;
    }
    #toolTipBox {
      display:none;    
      /* border-left: thick solid #000; */
      height:450px;
       left: 50%;
      position: absolute;


      border-top: 5px solid #000;
      border-left: 5px solid #000;
      position: absolute;
      width: 150px !important;
      
    }
    
    </style>
    

<script>
    
    export default {
      props : ['dashboard'],
        data() {
          return {
            GuardandoCambios : false, 
            action : '', 
            Zonas : [],
            Pilotos : [],
            Globos : [],
            TipoNubosidad : [],
            Soguillas : [],
            zonas_despegues : [],
            load_meteoblue: 'no',
            form:{         
              zona_id : '',
              piloto_id : '',
              globo_id : '',
              fecha : '',
              hora : '',
              duracion_estimada : '',
              temperatura : '',
              gas : '',
              notas : '',
              reserva : '',
              tabla_carga_maxima : '',
              tabla_carga_maxima_manual : '',
              carga_maxima : '',
              tipo_nubosidad_id : '',
              altura_maxima : '',
              viento : '',
              zona_despegue : '',
              parte_meteo_meteoblue : '',
              amanecer : '-',
              anochecer : '-',
              orto : '-',
              ocaso : '-',
              qnh : '-',
              soguillas : [],
            },
            decimal_tabla_carga : 0,
            url_meteo : null,
            niveldiferido : null,
            globo : null,
            all_diferidos : [],
          }
        },
        mounted() {
          this.BuscarGlobos();
          this.BuscarZonas();
          this.BuscarPilotos();
          this.BuscarTipoNubosidad();
          this.BuscarSoguillas();
        },
        methods: { 
  
          ValidarCalculo(campo) {
            if(campo=='gas'){
              var value = this.form.gas * 0.20;
              var decimals = 2;
              this.form.reserva = Math.round(value * Math.pow(10, decimals)) / Math.pow(10, decimals)
            }
          },

          BuscarDiferdidos() {
            var url = '/admin/globos/'+this.form.globo_id;
            axios.get(url).then(response=>{
                this.globo = response.data.record; 
                this.niveldiferido = this.globo.niveldiferido; 
                if (this.niveldiferido=='3') {
                  $("#Diferidos").modal('show');
                }
                this.all_diferidos = response.data.record.GloboDiferidos; 
            }).catch(error => {
                this.errors = error.response.data
            });
          },

          toolTip(me) {
     
            var theObj=me
            var posicion_entero="";
            var posicion_decimal=1;
            var rango_decimal=4;
            var rango_entre_enteros=43;
            var tabla_inicial=41;
            var tabla_valor_inicial=22;
            var posicion_inicial=0;
            var coordenada_seleccionada=0;
        
            if(window.event.offsetX < tabla_inicial || window.event.offsetX > 615 || window.event.offsetY < 43){
                alert('fuera de rango'+ window.event.offsetX);
                return false;
            }

            for(var regla=0; regla<=13; regla++){

                if( window.event.offsetX >= tabla_inicial && window.event.offsetX <= tabla_inicial+rango_entre_enteros){

                    posicion_inicial = tabla_inicial;
                    posicion_entero = tabla_valor_inicial;
                    coordenada_seleccionada = window.event.offsetX;
                    
                    for(var i=11; i>=1; i--){

                        if(coordenada_seleccionada >= posicion_inicial && coordenada_seleccionada <= posicion_inicial+rango_decimal){

                            if(i==10){
                              posicion_decimal = 9;
                            }
                            else if(i==11){
                              posicion_decimal = 0;
                              posicion_entero = posicion_entero + 1;
                            }else{
                              posicion_decimal = i;
                            }

                        }

                        posicion_inicial += rango_decimal;

                    }
                    
                }
                
                tabla_valor_inicial--;
                tabla_inicial += rango_entre_enteros;

            }

            var final = posicion_entero+"."+ posicion_decimal;
            this.decimal_tabla_carga = posicion_decimal;
            // document.getElementById('toolTipBox').style.display="block";
            
    
            var ev=arguments[0]?arguments[0]:event;
            var x=ev.clientX - 260;
            var y=ev.clientY - 87;
            var diffX=0;
            var diffY=0;
            // document.getElementById('toolTipBox').style.top = y+document.body.scrollTop+ "px";
            // document.getElementById('toolTipBox').style.left = x+document.body.scrollLeft+"px";

            var _this = this;

            Swal.fire({
              title: "Confirmar valor seleccionado.",
              text: final,
              icon: "warning",
              showCancelButton: true,
              confirmButtonText: "Si, Confirmar!",
              cancelButtonText: "No, Cancelar!",
              reverseButtons: true
            }).then(function(result) {
              if (result.value) {      

                  _this.form.tabla_carga_maxima = final;
     
                  $("#VerTabla .close").click(); 
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();

                  setTimeout(() => {  
                    // html2canvas(document.querySelector("#imgtablacarga")).then(canvas => {
                    //   canvas.toBlob(function(blob) { 
                    //       var d = new Date();
                    //     var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate() + "_" + d.getHours()+":"+ d.getMinutes(); 
                    //     window.saveAs(blob, strDate+'_tabla_carga_'+final+'.jpg');
                    //   });
                    // });  
                  
                  }, 500);
        
              }
            });

          },

         CargarZona() {
            var url = '/admin/zonas/'+this.form.zona_id;
            axios.get(url).then(response=>{
                this.form.zona_despegue = response.data.record.despegue_whatsapp; 
                this.url_meteo = response.data.record.meteoblue_url; 
                this.zonas_despegues = response.data.record.zonas_despegues; 
            }).catch(error => {
              console.log(error.response);
                // this.errors = error.response.data
            });
            
            var url = '/admin/horarios/'+this.form.zona_id;
            axios.get(url).then(response=>{
              this.form.amanecer = response.data.amanecer; 
              this.form.anochecer = response.data.anochecer; 
              this.form.orto = response.data.orto; 
              this.form.ocaso = response.data.ocaso; 
              this.form.tipo_nubosidad_id = response.data.tipo_nubosidad; 
              this.form.qnh = response.data.qnh; 
              console.log(response.data);

            }).catch(error => {
                this.errors = error.response.data
            });

 




        },
          BuscarTipoNubosidad() {
            var url = '/admin/listado_tipo_nubosidad';
                axios.get(url).then(response=>{
                    this.TipoNubosidad = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },

          BuscarGlobos() {
            var url = '/admin/listado_globos';
                axios.get(url).then(response=>{
                    this.Globos = response.data.records;  
                }).catch(error => {
                    this.errors = error.response.data
                });
          },

          BuscarZonas() {
            var url = '/admin/listado_zonas';
                axios.get(url).then(response=>{
                    this.Zonas = response.data.records; 
                    
                }).catch(error => {              
                  console.log(error);

                    // this.errors = error.response.data
                });
          },

          BuscarPilotos() {
            var url = '/admin/listado_pilotos';
                axios.get(url).then(response=>{
                    this.Pilotos = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },

          BuscarSoguillas() {
            var url = '/admin/listado_soguillas';
                axios.get(url).then(response=>{
                    this.Soguillas = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },

          DescargarMeteoblue() {
            this.load_meteoblue = 'si';
            var url = '/admin/descargar_meteoblue/'+this.form.zona_id;
                axios.get(url).then(response=>{
                    this.form.parte_meteo_meteoblue = response.data.records;   
                    this.load_meteoblue = 'cargado';
                }).catch(error => {
                    this.errors = error.response.data
                });
          },

          reset() {
 
            this.form  = {   
              zona_id : '',
              piloto_id : '',
              globo_id : '',
              fecha : '',
              hora : '',
              duracion_estimada : '',
              temperatura : '',
              gas : '',
              notas : '',
              reserva : '',
              tabla_carga_maxima : '',
              carga_maxima : '',
              tipo_nubosidad_id : '',
              altura_maxima : '',
              viento : '',
              zona_despegue : '',
              amanecer : '',
              anochecer : '',
              orto : '',
              ocaso : '',
              qnh : '',
              soguillas : [],
            };

            this.$refs['form_parte_mateo'].reset();
            this.$refs['form_tabla_carga'].reset();

          },
 
 
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var form_parte_mateo = this.$refs.form_parte_mateo.files[0];
              var form_tabla_carga = this.$refs.form_tabla_carga.files[0];

              let formData = new FormData();
  
              formData.append('form_parte_mateo', form_parte_mateo);
              formData.append('form_tabla_carga', form_tabla_carga);
              
              formData.append('zona_id', this.form.zona_id);
              formData.append('piloto_id', this.form.piloto_id);
              formData.append('globo_id', this.form.globo_id);
              formData.append('fecha', this.form.fecha);
              formData.append('hora', this.form.hora);
              formData.append('duracion_estimada', this.form.duracion_estimada);
              formData.append('temperatura', this.form.temperatura);
              formData.append('gas', this.form.gas);
              formData.append('notas', this.form.notas);
              formData.append('reserva', this.form.reserva);
              formData.append('tabla_carga_maxima', this.form.tabla_carga_maxima);
              formData.append('carga_maxima', this.form.carga_maxima);
              formData.append('tipo_nubosidad_id', this.form.tipo_nubosidad_id);
              formData.append('altura_maxima', this.form.altura_maxima);
              formData.append('viento', this.form.viento);
              formData.append('zona_despegue', this.form.zona_despegue);
              formData.append('parte_meteo_meteoblue', this.form.parte_meteo_meteoblue);
              formData.append('amanecer', this.form.amanecer);
              formData.append('anochecer', this.form.anochecer);
              formData.append('orto', this.form.orto);
              formData.append('ocaso', this.form.ocaso);
              formData.append('qnh', this.form.qnh);
              formData.append('soguillas', this.form.soguillas);
  
               var url = '/admin/vuelos';

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar Vuelo', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Vuelo Registrada Correctamente');                  
                  this.reset();

                  if(this.action=='guardar_cerrar'){

                    if(this.dashboard){                      
                      this.$router.push({
                          path: '/'
                      });
                    }else{
                      this.$router.push({
                          path: '/vuelos'
                      });
                    }

                  }





                }      
              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 

      },
      
  
      computed: { 
        
        PilotosByNivel: function () {   
            var Globos = this.Globos;
            var data = this.Pilotos;
            var filtro = this.form.globo_id;
            if(filtro!=''){
              var globo = _.find(Globos, ['id', filtro]);
              var nivel = globo['habilitacion_nivel'];
              
              if(nivel=='A'){
                return data.filter(items => items.habilitacion_nivel=='A'||items.habilitacion_nivel=='B'||items.habilitacion_nivel=='C'||items.habilitacion_nivel=='D');  
              }else if(nivel=='B'){
                return data.filter(items => items.habilitacion_nivel=='B'||items.habilitacion_nivel=='C'||items.habilitacion_nivel=='D');  
              }else if(nivel=='C'){
                return data.filter(items => items.habilitacion_nivel=='C'||items.habilitacion_nivel=='D');  
              }else if(nivel=='D'){
                return data.filter(items => items.habilitacion_nivel=='D');  
              }
              
              console.log(globo['habilitacion_nivel']);

            }
        },

         
          

      },

      watch: { 
        
        Zonas: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_zonas').selectpicker('refresh'); });
        },
        zonas_despegues: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_zonas_desp').selectpicker('refresh'); });
        },
        Globos: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_globos').selectpicker('refresh'); });
        },
        PilotosByNivel: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_pilotos').selectpicker('refresh'); });
        },

        TipoNubosidad: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_tipo_nubosidad').selectpicker('refresh'); });
        },
        'form.tipo_nubosidad_id': function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_tipo_nubosidad').selectpicker('refresh'); });
        },
        Soguillas: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_soguillas').selectpicker('refresh'); });
        },
  
        'form.fecha': function (set) {
          this.form.soguillas = [];
          let _this = this;
          var fecha = this.form.fecha;
          _.forEach(this.Soguillas, function(value, index) {
              var disponible = false;
              var turno = false;
              _.forEach(value.calendario_disponible, function(calendario_disponible) {
                if(fecha == calendario_disponible.fecha){
                  disponible = true;
                  turno = calendario_disponible.turno.nombre;
                }
              });
              _this.Soguillas[index]['turno_a'] = turno;
              _this.Soguillas[index]['disponible'] = disponible;
          });
          console.log(_this.Soguillas);
          this.$nextTick(function(){ $('#selectpicker_soguillas').selectpicker('refresh'); });
        },
        'form.tabla_carga_maxima': function (set) {
            var Globos = this.Globos; 
            var decimal_tabla_carga = this.decimal_tabla_carga; 
            var id = this.form.globo_id; 
            var globo = _.find(Globos, ['id', id]);
            var modelo_globo = globo.modelo_globo; 
            var tabla_carga_maxima = parseInt(this.form.tabla_carga_maxima); 
            var init = 'fift_inits_'+tabla_carga_maxima;
            var end = 'fift_inits_'+(tabla_carga_maxima+1);
            var rango =  modelo_globo[end] - modelo_globo[init];
            var rango_por_uno = rango / 10;
            var carga_maxima_decimal = rango_por_uno * decimal_tabla_carga;
            var total_carga_maxima = modelo_globo[init] + carga_maxima_decimal;
            this.form.carga_maxima  = total_carga_maxima;                
        },
      },


      };
    </script>
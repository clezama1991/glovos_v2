<template>
  <div>
    <div class="card card-custom gutter-b">
      <div class="card-header bg-light-danger">
        <div class="card-title">
          <h3 class="card-label">Vuelos Programados</h3>
        </div>
        <div class="card-toolbar">  
          <div class="modal fade" id="registrarReserva" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Registrar Reserva</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row" v-if="paso_reserva == 'seleccionar_reserva'">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="buscardor_numero_nombre_tlf">Order - ID</label>
                          <div class="input-group">
                            <input v-model="buscardor_numero_nombre_tlf" @blur="ValidarOrder()" id="orden_wordpress" type="text" class="form-control form-control-sm">
                            <div class="input-group-append">
                              <button class="btn btn-sm  btn-secondary" type="button"> <i class="fa fa-search"></i> </button>
                            </div>
                          </div>
                          <!-- <span class="text-danger" v-if="order_ya_existe"> <i class="fa-exclamation"></i>  ID Ya existe </span> -->
                        </div> 
                      </div>  

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">

                      <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordere table-hover">
                          <thead class="bg-primary text-white">
                            <tr>
                              <th class="p-2">Order-ID</th>
                              <th class="p-2">N. Pax</th>
                              <th class="p-2">Contacto</th>
                              <th class="p-2">Vuelo</th>
                              <th class="p-2">Estatus</th>
                              <th class="p-2 font-weight-bolder">Cambiar</th>
                            </tr>
                          </thead>
                          <tbody> 
                            <tr v-if="pedidos.length==0">
                              <td colspan="6" class="text-center">
                                Sin Resultados
                              </td>
                            </tr>
                            <tr
                              v-for="(
                                items, index
                              ) in pedidos"
                              :key="index"
                              :class="{'bg-danger text-white': items.reembolso,'bg-success': items._rowVariant=='success'}"
                            >
                              <td>
                                {{ items.orden_wordpress }}
                                <span v-if="items.notas!=null" data-toggle="modal" data-target="#notaPedido" @click="nota_pedido=items.notas"><i class="fa fa-commenting text-warning" aria-hidden="true"></i></span>
                              </td>
                              <td>
                                {{ items.numpax }}
                              </td>
                              <td>
                                {{ items.nombre_contacto }}
                              </td>
                              <td>
                                {{ items.name_vuelo }}
                              </td>
                              <td nowrap>
                                {{ items.estatus }}  <span v-if="items.reembolso">(Reembolso)</span>
                              </td>
                              <td>
                                  <button class="btn btn-primary btn-sm" @click="SeleccionarPedidoReserva=items, paso_reserva='actualizar_contacto'"><i class="fa fa-check"></i></button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    </div>
                    <div class="row" v-if="paso_reserva=='actualizar_contacto'">
                    <div class="col-md-12">
                       
                <div class="card mt-5">

                  <header_card icon="fa fa-user" :titulo="'Datos de Contacto - Order-ID:'+SeleccionarPedidoReserva.orden_wordpress" tipo="sub"></header_card>

                  <div class="card-body"> 

                <div class="row d-flex justify-content-end">
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="nombres" class="requerido">Nombre</label>
                      <input v-model="SeleccionarPedidoReserva.nombre_contacto" @blur="ActualizarContacto()" id="nombres" type="text" class="form-control" required>
                    </div> 
                  </div> 
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="apellidos" class="requerido">Email</label>
                      <input v-model="SeleccionarPedidoReserva.email_contacto" @blur="ActualizarContacto()" id="apellidos" type="text" class="form-control" required>
                    </div> 
                  </div>
                  <div class="col-md-2 mb-3">
                    <div class="form-group">
                      <label for="telefono" class="requerido">Teléfono</label>
                      <input v-model="SeleccionarPedidoReserva.telefono_contacto" @blur="ActualizarContacto()" id="telefono" type="text" class="form-control" required>
                    </div> 
                  </div>  
                  <div class="col-md-2 mb-3">
                    <div class="form-group">
                      <label for="dni" class="requerido">Ciudad</label>
                      <input v-model="SeleccionarPedidoReserva.ciudad_contacto" @blur="ActualizarContacto()" id="dni" type="text" class="form-control" required>
                    </div> 
                  </div>    
                  <div class="col-md-2 mb-3">
                    <div class="form-group">
                      <label for="lenguaje_contacto" class="requerido">Idioma</label>                      
                      <select class="form-control" v-model="SeleccionarPedidoReserva.lenguaje_contacto" @change="ActualizarContacto()">
                        <option value="es">Español</option>
                        <option value="en">Ingles</option>
                        <option value="fr">Frances</option>
                      </select>
                    </div> 
                  </div>   
                  <!-- <div class="col-md-3 float-right"> 
                      <span @click="ActualizarContacto()"  v-if="form.estatus!='Vuelo Realizado'" class="btn btn-primary float-right text-white" role="button"><span>
                        <i class="fa fa-save text-white mr-2" aria-hidden="true"></i>  Actualizar Datos de contacto
                        </span></span> 
                  </div>             -->
                </div>
                </div>
                </div>
                
                    </div>
                    </div>
                    <div class="row" v-if="paso_reserva=='seleccionar_vuelo'">
                <div class="col-md-12">
                    
                <div class="card mt-5">

                  <header_card icon="fa fa-user" titulo="Proximos Vuelos Disponibles" tipo="sub"></header_card>

                  <div class="card-body"> 
                      <form @submit="RegistarVuelo" method="POST" class="form" id="GuardarServiciosSolucionLimpieza"> 
                          <div class="row"> 
                            <div class="col-md-3 pb-3">
                                <input type="date" class="form-control form-control-sm" v-model="fecha" required>
                            </div>
                            <div class="col-md-3 pb-3">
                                <select class="form-control form-control-sm" v-model="zona_id" required>
                                  <option value="">Zonas</option>
                                  <option :value="item.id" v-for="(item, index_zona) in Zonas" :key="index_zona"> {{item.nombre}} </option>
                                </select>
                            </div>
                            <div class="col-md-3 pb-3"> 
                              <button
                                type="submit"
                                class="btn btn-light-warning btn-block btn-sm"
                                :disabled="GuardandoCambios"
                              >
                                <span v-if="GuardandoCambios">
                                  <i class="fas fa-spinner fa-spin"></i> Guardando...
                                </span>
                                <span v-else> <i class="fa fa-save"></i> Crear Vuelo </span>
                              </button>
                            </div>
                          </div>
                          </form>
                    <div class="table-responsive">
                      <table class="table table-sm table-striped table-bordered table-hover">
                        <thead class="bg-primary text-white">
                          <tr>
                            <th>Fecha</th>
                            <th>Zona</th>
                            <th>Piloto</th>
                            <th>Globo</th>
                            <th>Num.Pax</th>
                            <th>Carga Total</th>
                            <th class="font-weight-bolder">Reservar</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <tr
                            v-for="(
                              items, index
                            ) in ListRecords"
                            :key="index"
                            :class="{'bg-light-warning': formatDay(items.fecha)=='Sat','bg-light-warning': formatDay(items.fecha)=='Sun'}"
                          >
                            <td class="text-center">
                              {{ items.fecha | formatDay }} <br> {{ items.fecha | formatDate }}
                            </td>
                            <td>
                              {{ items.zona.nombre }}
                            </td>
                            <td>
                              {{ (items.piloto!=null) ? items.piloto.nombres + " " + items.piloto.apellidos  : '' }}
                            </td>
                            <td>
                              {{ (items.globo!=null) ? items.globo.nombre : '' }}
                            </td>
                            <td>
                              {{ items.cantidad_pasajeros }}
                            </td>
                            <td>
                              {{ items.carga }}
                            </td>
                            <td>
                              <button class="btn btn-primary btn-sm" @click="ConfirmarActualizarPedido(items.id,SeleccionarPedidoReserva.id)"><i class="fa fa-check"></i></button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>



                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button v-if="paso_reserva=='actualizar_contacto'" class="btn btn-warning float-right" @click="paso_reserva='seleccionar_vuelo'"> <i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar</button>

                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="registrarListaEspera" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Registrar Lista de Espera</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row" v-if="paso_reserva == 'seleccionar_reserva'">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="buscardor_numero_nombre_tlf">Order - ID</label>
                          <div class="input-group">
                            <input v-model="buscardor_numero_nombre_tlf" @blur="ValidarOrder()" id="orden_wordpress" type="text" class="form-control form-control-sm">
                            <div class="input-group-append">
                              <button class="btn btn-sm  btn-secondary" type="button"> <i class="fa fa-search"></i> </button>
                            </div>
                          </div>
                         </div> 
                      </div>  

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">

                      <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordere table-hover">
                          <thead class="bg-primary text-white">
                            <tr>
                              <th class="p-2">Order-ID</th>
                              <th class="p-2">N. Pax</th>
                              <th class="p-2">Contacto</th>                          
                              <th class="p-2">Teléfono</th>
                              <th class="p-2">Vuelo</th>
                              <th class="p-2">Estatus</th>
                              <th class="p-2 font-weight-bolder">Cambiar</th>
                            </tr>
                          </thead>
                          <tbody> 
                            <tr v-if="pedidos.length==0">
                              <td colspan="7" class="text-center">
                                Sin Resultados
                              </td>
                            </tr>
                            <tr
                              v-for="(
                                items, index
                              ) in pedidos"
                              :key="index"
                              :class="{'bg-danger text-white': items.reembolso,'bg-success': items._rowVariant=='success'}"
                            >
                              <td>
                                <a href="#" role="button" @click="IrAPedido(items.orden_wordpress)">{{ items.orden_wordpress }}</a>
                                <span v-if="items.notas!=null" data-toggle="modal" data-target="#notaPedido" @click="nota_pedido=items.notas"><i class="fa fa-commenting text-warning" aria-hidden="true"></i></span>
                              </td>
                              <td>
                                {{ items.numpax }}
                              </td>
                              <td>
                                {{ items.nombre_contacto }}
                              </td>
                              <td>
                                {{ items.telefono_contacto }}
                              </td>
                              <td>
                                {{ items.name_vuelo }}
                              </td>
                              <td nowrap>
                                {{ items.estatus }}  <span v-if="items.reembolso">(Reembolso)</span>
                              </td>
                              <td>
                                  <button class="btn btn-primary btn-sm" @click="SeleccionarPedidoReserva=items, paso_reserva='actualizar_contacto'"><i class="fa fa-check"></i></button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    </div>
                    <div class="row" v-if="paso_reserva=='actualizar_contacto'">
                    <div class="col-md-12">
                       
                <div class="card mt-5">

                  <header_card icon="fa fa-user" :titulo="'Datos de Contacto - Order-ID:'+SeleccionarPedidoReserva.orden_wordpress" tipo="sub"></header_card>

                  <div class="card-body"> 

                <div class="row d-flex justify-content-end">
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="nombres" class="requerido">Nombre</label>
                      <input v-model="SeleccionarPedidoReserva.nombre_contacto" @blur="ActualizarContacto()" id="nombres" type="text" class="form-control" required>
                    </div> 
                  </div> 
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="apellidos" class="requerido">Email</label>
                      <input v-model="SeleccionarPedidoReserva.email_contacto" @blur="ActualizarContacto()" id="apellidos" type="text" class="form-control" required>
                    </div> 
                  </div>
                  <div class="col-md-2 mb-3">
                    <div class="form-group">
                      <label for="telefono" class="requerido">Teléfono</label>
                      <input v-model="SeleccionarPedidoReserva.telefono_contacto" @blur="ActualizarContacto()" id="telefono" type="text" class="form-control" required>
                    </div> 
                  </div>  
                  <div class="col-md-2 mb-3">
                    <div class="form-group">
                      <label for="dni" class="requerido">Ciudad</label>
                      <input v-model="SeleccionarPedidoReserva.ciudad_contacto" @blur="ActualizarContacto()" id="dni" type="text" class="form-control" required>
                    </div> 
                  </div>   
                  <div class="col-md-2 mb-3">
                    <div class="form-group">
                      <label for="dni" class="requerido">Idioma</label>                      
                      <select class="form-control" v-model="SeleccionarPedidoReserva.lenguaje_contacto" @change="ActualizarContacto()">
                        <option value="es">Español</option>
                        <option value="en">Ingles</option>
                        <option value="fr">Frances</option>
                      </select>
                    </div> 
                  </div>    
                  <!-- <div class="col-md-3 float-right"> 
                      <span @click="ActualizarContacto()"  v-if="form.estatus!='Vuelo Realizado'" class="btn btn-primary float-right text-white" role="button"><span>
                        <i class="fa fa-save text-white mr-2" aria-hidden="true"></i>  Actualizar Datos de contacto
                        </span></span> 
                  </div>             -->
                </div>
                 </div>
                </div>
                
                    </div>
                    </div>
                    <div class="row" v-if="paso_reserva=='seleccionar_vuelo'">
                <div class="col-md-12">
                    
                <div class="card mt-5">

                  <header_card icon="fa fa-user" titulo="Datos de Espera" tipo="sub"></header_card>

                  <div class="card-body">  
                    <div class="row pb-3">
                      <div class="col-md-6 pb-3">
                        <label for="">Zona</label> 
                        <v-select 
                          v-model="zona_lista_espera"
                          multiple
                          class="w-100"
                          id="modelo_id"
                          :reduce="nombre => nombre.id"
                          :options="Zonas" 
                          label="nombre">            
                            <template #search="{ attributes, events }">
                                <input
                                class="vs__search"
                                :required="!zona_lista_espera"
                                v-bind="attributes"
                                v-on="events"
                                />
                            </template>
                          </v-select>  
                      </div> 
                    </div> 
                    
                    <div class="row mt-3">
                      <div class="col-md-6 pb-3">
                        <div class="row">
                          <div class="col-6"> 
                        <div class="form-group">
                          <label for="">F. Inicio (Disp.)</label>
                          <input type="date" class="form-control" v-model="fecha_inicio_disp" id="" aria-describedby="helpId" placeholder="">
                        </div>
                          </div>
                          <div class="col-6">
                            
                        <div class="form-group">
                          <label for="">F. Fin (Disp.)</label>
                          <input type="date" class="form-control" v-model="fecha_fin_disp" id="" aria-describedby="helpId" placeholder="">
                        </div>
                          </div>
                        </div>

                      </div>
                      <div class="col-md-6 pb-3">
                        <div class="row">
                          <div class="col-6">

                        <div class="form-group">
                          <label for="">F. Inicio (No Disp.)</label>
                          <input type="date" class="form-control" v-model="fecha_inicio_nodisp" id="" aria-describedby="helpId" placeholder="">
                        </div>
                          </div>
                          <div class="col-6">
                            
                        <div class="form-group">
                          <label for="">F. Fin (No Disp.)</label>
                          <input type="date" class="form-control" v-model="fecha_fin_nodisp" id="" aria-describedby="helpId" placeholder="">
                        </div>
                          </div>
                        </div> 
                      </div>
                      <div class="col-md-12 pb-3">
                        <label for="">Días</label>
                      </div>  
                      <div class="col-md-12 pb-3">
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="1"> Lunes
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="2"> Martes
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="3"> Miercoles
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="4"> Jueves
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="5"> Viernes
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="6"> Sabado
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="7"> Domingo
                          </label>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
 

                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button v-if="paso_reserva=='actualizar_contacto'" class="btn btn-warning float-right" @click="paso_reserva='seleccionar_vuelo'"> <i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar</button>
                  <button v-if="paso_reserva=='seleccionar_vuelo'" class="btn btn-primary float-right" @click="ConfirmarRegistrarListaEspera"> <i class="fa fa-check" aria-hidden="true"></i> Agregar a Lista de Espera</button>

                </div>
              </div>
            </div>
          </div>
          <button
            v-if="can('waiting_list-create')"
            data-toggle="modal" data-target="#registrarListaEspera"
            @click="paso_reserva='seleccionar_reserva',pedidos=[],buscardor_numero_nombre_tlf='',ResetDatosListaReserver()"
            class="btn btn-sm btn-light-info font-weight-bold mr-2"
          >
            <i class="fas fa-user-clock    "></i> Lista de Espera
          </button>   

          <button
            v-if="can('booking-create')"
            data-toggle="modal" data-target="#registrarReserva"
            @click="paso_reserva='seleccionar_reserva',pedidos=[],buscardor_numero_nombre_tlf=''"
            class="btn btn-sm btn-light-warning font-weight-bold mr-2"
          >
            <i class="fa fa-user-plus" aria-hidden="true"></i> Registrar Reserva
          </button>   

          <router-link
            v-if="can('flights-create')"
            :to="'/vuelos/crear/dashboard'"
            class="btn btn-sm btn-light-primary font-weight-bold"
          >
            <i class="flaticon-plus"></i> Registrar Vuelo
          </router-link>

          <button
            class="btn btn-primary d-none BtnVerVuelo"
            data-toggle="modal"
            data-target="#VerVuelo"
            @click="BuscarListaEspera()"
          >
            Ver Vuelo
          </button>
        </div>
      </div>
      <div class="card-body body-calendario">
        <FullCalendar :options="calendarOptions" />
      </div>
    </div>
    <div class="card card-custom gutter-b">
      <div class="card-header bg-light-danger">
        <div class="card-title">
          <h3 class="card-label">Proximos Vuelos</h3>
        </div>
      </div>
      <div class="card-body">
        <tabla-component
          :fields="fields"
          :listado="ListRecords"
          titulo=""
          @onRowClicked="onRowClicked"
        ></tabla-component>
      </div>
    </div>

    <div
      class="modal fade"
      id="VerVuelo"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="staticBackdrop"
      aria-hidden="true"
      ref="vuemodal"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header d-none"> 
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i aria-hidden="true" class="ki ki-close"></i>
              </button>
          </div>

          <div class="modal-body p-0">
            <div class="card card-custom">
              <div
                class="
                  card-header card-header-left
                  ribbon ribbon-clip ribbon-right
                "
              >
                <div class="ribbon-target" style="top: 12px">
                  <span class="ribbon-inner" :class="{'bg-warning':vuelo_seleccionado.estatus=='Creado','bg-success':vuelo_seleccionado.estatus=='Volado'}"></span> {{vuelo_seleccionado.estatus}}
                </div>
                <h3 class="card-title">Detalles del Vuelo</h3>
              </div>

                <div class="card-body" v-if="vista=='vuelo'">
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4" id="kt_profile_aside">
                      <!--begin::Nav Panel Widget 2-->
                      <div
                        class="card card-custom  shadow-lg"
                        v-if="vuelo_seleccionado"
                      >
                        <!--begin::Body-->
                        <div class="card-body">
                          
                          <!--begin::Wrapper-->
                          <div class="d-flex justify-content-between flex-column">
                            <!--begin::Container-->
                            <div class="">
                              <div class="d-flex align-items-center pb-10">
                                <div
                                  class="
                                    symbol symbol-80 symbol-xxl-100
                                    mr-5
                                    align-self-start align-self-xxl-center
                                  "
                                >
                                  <div
                                    class="symbol-label"
                                    :style="
                                      'background-image:url(' +
                                      vuelo_seleccionado.logo +
                                      ')'
                                    "
                                  ></div>
                                </div>
                                <div>
                                  <a
                                    @click="IrEditarEvento()"
                                    class="
                                      font-weight-bold font-size-h5
                                      text-dark-75 text-hover-primary
                                    "
                                    >Vuelo {{ vuelo_seleccionado.id }}</a
                                  >
                                  <div class="text-dark-75">
                                    Zona : {{ vuelo_seleccionado.zona.nombre }}
                                    <br />
                                    Fecha : {{ vuelo_seleccionado.fecha | formatDate('d-m-Y') }}
                                  </div>
                                  <div class="text-dark-75 text-capitalize">
                                    Clas. : {{ vuelo_seleccionado.is_exclisivo }}
                                  </div>
                                </div>
                              </div>
                              <!--begin::Header-->

                              <!--end::Header-->
                              <!--begin::Body-->
                              <div class="pt-1">
                                <!--begin::Text-->

                                <!--end::Text-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                  <!--begin::Symbol-->
                                  <div class="symbol symbol-45 symbol-light mr-4">
                                    <span class="symbol-label">
                                      <i
                                        class="
                                          fas
                                          fa-lightbulb fa-2x
                                          text-primary
                                        "
                                      ></i>
                                      <!--end::Svg Icon-->
                                    </span>
                                  </div>
                                  <!--end::Symbol-->
                                  <!--begin::Text-->
                                   <div class="d-flex flex-column flex-grow-1" v-if="vuelo_seleccionado.globo">
                                    <router-link :to="'/globos/consultar/'+vuelo_seleccionado.globo.id"
                                    data-dismiss="modal"
                                      class="
                                        text-dark-75 text-hover-primary
                                        mb-1
                                        font-size-lg font-weight-bolder
                                      "
                                      >{{ (vuelo_seleccionado.globo) ? vuelo_seleccionado.globo.nombre : '' }}
                                    </router-link>
                                    <span class="text-dark-75 font-weight-bold"
                                      >Matricula
                                      {{ (vuelo_seleccionado.globo) ? vuelo_seleccionado.globo.matricula : '' }}</span
                                    >
                                  </div>
                                  <div class="d-flex flex-column flex-grow-1" v-else>
                                    Sin Globo
                                  </div>
                                  <!--end::Text-->
                                  <!--begin::label-->

                                  <!--end::label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                  <!--begin::Symbol-->
                                  <div class="symbol symbol-45 symbol-light mr-4">
                                    <span class="symbol-label">
                                      <i
                                        class="fas fa-user-tie fa-2x text-warning"
                                      ></i>
                                    </span>
                                  </div>
                                  <!--end::Symbol-->
                                  <!--begin::Text-->
                                  
                                  <div class="d-flex flex-column flex-grow-1" v-if="vuelo_seleccionado.piloto">
                                     <router-link :to="'/pilotos/consultar/'+vuelo_seleccionado.piloto.id"
                                      data-dismiss="modal"  
                                      class="
                                        text-dark-75 text-hover-primary
                                        mb-1
                                        font-size-lg font-weight-bolder
                                      "
                                      >  {{ (vuelo_seleccionado.piloto) ? vuelo_seleccionado.piloto.nombres+' '+ vuelo_seleccionado.piloto.apellidos : ''}}
                                     </router-link>
                                    <span class="text-dark-75 font-weight-bold">{{
                                      (vuelo_seleccionado.piloto) ? vuelo_seleccionado.piloto.telefono : ''
                                    }}</span>

                                    <a :href="'/admin/piloto_enviar_formulario/'+vuelo_seleccionado.id" 
                                      v-if="vuelo_seleccionado.piloto" target="_blank" class=" 
                                      label-inline
                                      float-right
                                      mr-2
                                      label label-primary"
                                    >                                
                                      <i class="fab fa-whatsapp text-white mr-2" aria-hidden="true"></i>
                                      Enviar Link
                                    </a>

                                  </div>
                                  <div class="d-flex flex-column flex-grow-1" v-else>
                                    Sin Piloto
                                  </div> 
                                </div>
                                <div class="d-flex align-items-center pb-9"  v-if="vuelo_seleccionado.asitentes.length>0">
                                  <!--begin::Symbol-->
                                  <div class="symbol symbol-45 symbol-light mr-4">
                                    <span class="symbol-label">
                                      <i
                                        class="fas fa-user fa-2x text-danger"
                                      ></i>
                                    </span>
                                  </div>
                                  <!--end::Symbol-->
                                  <!--begin::Text-->
                                  
                                  <div class="d-flex flex-column flex-grow-1">
                                     <span
                                      class="
                                        text-dark-75 text-hover-primary
                                        mb-1
                                        font-size-lg font-weight-bolder
                                      "
                                      >  Soguillas
                                     </span>
                                     <div class="w-100 mb-3" v-for="(sog, sog_index) in vuelo_seleccionado.asitentes" :key="sog_index">

                                    <span class="text-dark-75 font-weight-bold w-100">
                                      {{sog.asistente.full_name}}
                                    </span>

                                    <a :href="'/admin/soguilla_enviar_formulario/'+vuelo_seleccionado.id+'/'+sog.asistente.id" 
                                      v-if="vuelo_seleccionado.piloto" target="_blank" class=" 
                                      label-inline
                                      float-right
                                      mr-2 w-100
                                      label label-success"
                                    >                                
                                      <i class="fab fa-whatsapp text-white mr-2" aria-hidden="true"></i>
                                      Enviar Link
                                    </a>  
                                     </div>
                                  </div> 
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                  <!--begin::Symbol-->
                                  <div class="symbol symbol-45 symbol-light mr-4">
                                    <span class="symbol-label">
                                      <i
                                        class="
                                          fa fa-balance-scale fa-2x
                                          text-danger
                                        "
                                      ></i>
                                    </span>
                                  </div>
                                  <!--end::Symbol-->
                                  <!--begin::Text-->
                                  <div class="d-flex flex-column flex-grow-1">
                                    <a
                                      href="#"
                                      class="
                                        text-dark-75 text-hover-primary
                                        mb-1
                                        font-size-lg font-weight-bolder
                                      "
                                      >Peso Total :
                                      {{ vuelo_seleccionado.carga }} KGS</a
                                    >
                                    <span class="text-dark-75 font-weight-bold"
                                      >GAS: {{ vuelo_seleccionado.gas  + vuelo_seleccionado.reserva }} KG <br />
                                      PASAJEROS:
                                      {{ vuelo_seleccionado.peso_pasajeros }} KGS
                                      <br />
                                      GLOBO {{ vuelo_seleccionado.peso_globo }} KG
                                      <hr />
                                      CARGA MAXIMA {{ vuelo_seleccionado.carga_maxima }} KG
                                      <br />
                                      CARGA DISP. {{ vuelo_seleccionado.peso_disponible }} KG
                                    </span>
                                  </div>
                                  <!--end::Text-->
                                  <!--begin::label-->

                                  <!--end::label-->
                                </div>
                                <!--end::Item-->
                                <p
                                  class="
                                    text-dark-75
                                    font-weight-nirmal font-size-lg
                                    m-0
                                  "
                                >
                                  Notas: {{ vuelo_seleccionado.notas }}
                                </p>
                              </div>
                              <!--end::Body-->
                            </div>
                            <!--eng::Container-->
                            <!--begin::Footer-->

                            <!--end::Footer-->
                          </div>
                          <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                      </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-8"  v-if="vuelo_seleccionado">

                        <div class="col-md-12 pt-1" v-if="vuelo_seleccionado.is_exclisivo=='exclusivo'">
                            <div role="alert" class="alert alert-custom alert-warning p-1">
                                <div class="alert-icon"><i class="fas fa-star    " aria-hidden="true"></i></div>
                                <div class="alert-text"> Este es un vuelo Exclusivo!</div>
                            </div>
                        </div>
                         <div
                        class="card card-custom  shadow-lg"
                      >
                        <!--begin::Body-->
                        <div class="card-body">
                          
                        <div class="row"  v-if="vuelo_seleccionado.estatus=='Cancelado Bitacora'">
                          <div class="col-md-12">
                            <div class="alert alert-custom alert-danger" role="alert">
                                <div class="alert-icon">
                                  <i class="fa fa-times-circle"></i>
                                </div>
                                <div class="alert-text"> Vuelo Cancelado!</div>
                              </div>
                          </div>
                        </div>
                        <div class="row"  v-if="vuelo_seleccionado.pedidos.length==0">
                          <div class="col-md-8 offset-2 pt-1">
                            <div class="alert alert-custom alert-danger" role="alert">
                                <div class="alert-icon">
                                  <i class="flaticon-questions-circular-button"></i>
                                </div>
                                <div class="alert-text"> No hay pedidos para este vuelo!</div>
                              </div>
                          </div>
                        </div>
                      
                      
                      <div class="timeline timeline-3" v-else>
                        <div class="timeline-items">
                          <div
                            class="timeline-item"
                            v-for="(pedido, index) in vuelo_seleccionado.pedidos"
                            :key="index"
                          >
                            <div class="timeline-media">
                              <span class="btn-link" role="button" @click="IrAPedido(pedido.orden_wordpress)">
                                {{ pedido.orden_wordpress }}
                              </span>
                            </div>
                            <div class="timeline-content">
                              <div>
                                
                                <div class="mr-2 w-100 d-flex justify-content-end">                        
                                  <a :href="'/pedidos_enviar_formulario/'+pedido.id" 
                                    v-if="pedido.estatus!='Vuelo Realizado'" target="_blank" class=" 
                                    label-inline
                                    float-right
                                    mr-2
                                    label" :class="{'label-warning':pedido.estatus=='Creado','label-success':pedido.estatus!='Creado'}"
                                  >                                
                                    <i class="fab fa-whatsapp text-white mr-2" aria-hidden="true"></i>
                                    Enviar Formulario
                                  </a>
                                  
                                  <span
                                    v-if="pedido.estatus!='Vuelo Realizado'"
                                    role="button"
                                    class="
                                      label label-primary
                                      font-weight-bolder
                                      label-inline
                                      float-right
                                    "
                                    @click="cambiar_fecha_vuelo=pedido,vista='cambiar_fecha_vuelo'"
                                    >Cambiar fecha reserva</span
                                  >
                                </div>
                                <div class="mr-2">
                                  <a
                                    href="#"
                                    class="
                                      text-dark-75 text-hover-primary
                                      font-weight-bold
                                    "
                                    ><strong>NumPax</strong>: {{ pedido.numpax }}</a
                                  >

                                  <span class="text-dark-75 ml-2 small"
                                    >({{ pedido.nombre_contacto }} - {{ pedido.telefono_contacto }} -  {{ pedido.ciudad_contacto }})</span
                                  >                              
                                </div>
                                <div class="mr-2">                                
                                  <strong>Estado Pedido</strong> : {{ pedido.estatus }} / <strong>Multimedia</strong>: <i class="fa" :class="{'fa-check text-warning':pedido.multimedia_notification,'fa-times text-danger':!pedido.multimedia_notification}" aria-hidden="true"></i>
                                  <span class="mr-2" v-if="pedido.notas!=null">
                                    / <span data-toggle="modal" data-target="#notaPedido" @click="nota_pedido=pedido.notas"> <i class="fa fa-commenting text-warning" aria-hidden="true"></i> </span>
                                  </span>
                                </div>
                              </div>
                                         

                              <table class="table table-sm mb-0" >
                                <tbody>
                                  <tr>
                                    <td></td>
                                    <td>Pasajeros</td>
                                    <td>Peso</td>
                                  </tr>

                                  <tr
                                    v-for="(
                                      pedidos_pasajeros, index_pedidos_pasajeros
                                    ) in pedido.pedidos_pasajeros"
                                    :key="index_pedidos_pasajeros"
                                  >
                                  <td>            
                                    <b-form-checkbox
                                      v-model="checkedValue" 
                                      :value="parseInt(pedidos_pasajeros.id)"
                                      unchecked-value="0"
                                    >
                                    </b-form-checkbox>
                                  </td>
                                    <td>
                                      {{ pedidos_pasajeros.pasajero.nombres }}
                                      {{ pedidos_pasajeros.pasajero.apellidos }}
                                    </td>
                                    <td>
                                      {{ pedidos_pasajeros.pasajero.peso }} KGS
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-body" v-else-if="vista=='cambiar_fecha_vuelo'">
                <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-3" id="kt_profile_aside">
                    <!--begin::Nav Panel Widget 2-->
                    <h3>Cambiar fecha de Reserva</h3>
                    <div
                      class="card card-custom gutter-b"
                      v-if="cambiar_fecha_vuelo"
                    >
                      <!--begin::Body-->
                      <div class="card-body p-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex justify-content-between flex-column">
                          <!--begin::Container-->
                          <div class="pb-5">
                            <!--begin::Body-->
                            <div class="pt-1">
                              <p
                                class="
                                  text-dark-75
                                  font-weight-nirmal
                                  m-0
                                  pb-7
                                "
                              >
                                Pedido: {{ cambiar_fecha_vuelo.orden_wordpress }} <br>

                                Num de Reservas: {{ cambiar_fecha_vuelo.numpax }} <br>

                                Nombre Contacto: {{ cambiar_fecha_vuelo.nombre_contacto }} <br>
                                Tel Contacto: {{ cambiar_fecha_vuelo.telefono_contacto }} <br>
                                Ciudad:  {{ cambiar_fecha_vuelo.ciudad_contacto }})

                              </p>
                            </div>
                            <!--end::Body-->
                          </div>
                          <!--eng::Container-->
                          <!--begin::Footer-->

                      </div>
                      <!--end::Body-->
                    </div>
                    </div>

<h3>Crear Nuevo Vuelo</h3>

                    <div
                      class="card card-custom gutter-b"
                      v-if="cambiar_fecha_vuelo"
                    >
                      <!--begin::Body-->
                      <div class="card-body p-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex justify-content-between flex-column">
                          <form @submit="RegistarVuelo" method="POST" class="form" id="GuardarServiciosSolucionLimpieza">
      
                          <div class="row">
                            
                            <div class="col-md-12 pb-3">
                                <input type="date" class="form-control form-control-sm" v-model="fecha" required>
                            </div>
                            <div class="col-md-12 pb-3">
                                <select class="form-control form-control-sm" v-model="zona_id" required>
                                  <option value="">Zonas</option>
                                  <option :value="item.id" v-for="(item, index_zona) in Zonas" :key="index_zona"> {{item.nombre}} </option>
                                </select>
                            </div>
                            <div class="col-md-12 pb-3">
                              
                            <button
                              type="submit"
                              class="btn btn-light-warning btn-block btn-sm"
                              :disabled="GuardandoCambios"
                            >
                              <span v-if="GuardandoCambios">
                                <i class="fas fa-spinner fa-spin"></i> Guardando...
                              </span>
                              <span v-else> <i class="fa fa-save"></i> Crear Vuelo </span>
                            </button>
                            </div>
                          </div>
                          </form>
                          <!--end::Footer-->
                        </div>
                        <!--end::Wrapper-->
                      </div>
                      <!--end::Body-->
                    </div>
                  </div>

                  <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                    
                    <h3>Proximos Vuelos Disponibles</h3>
                    <div class="table-responsive">
                      <table class="table table-sm table-striped table-bordered table-hover">
                        <thead class="bg-primary text-white">
                          <tr>
                            <th>Fecha</th>
                            <th>Zona</th>
                            <th>Piloto</th>
                            <th>Globo</th>
                            <th>Num.Pax</th>
                            <th>Carga Total</th>
                            <th class="font-weight-bolder">Cambiar</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <tr
                            v-for="(
                              items, index
                            ) in ListRecords"
                            :key="index"
                            :class="{'bg-light-warning': formatDay(items.fecha)=='Sat','bg-light-warning': formatDay(items.fecha)=='Sun'}"
                          >
                            <td class="text-center">
                              {{ items.fecha | formatDay }} <br> {{ items.fecha | formatDate }}
                            </td>
                            <td>
                              {{ items.zona.nombre }}
                            </td>
                            <td>
                              {{ (items.piloto!=null) ? items.piloto.nombres + " " + items.piloto.apellidos  : '' }}
                            </td>
                            <td>
                              {{ (items.globo!=null) ? items.globo.nombre : '' }}
                            </td>
                            <td>
                              {{ items.cantidad_pasajeros }}
                            </td>
                            <td>
                              {{ items.carga }}
                            </td>
                            <td>
                              <button class="btn btn-primary btn-sm" @click="ConfirmarActualizarPedido(items.id)"><i class="fa fa-check"></i></button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-md-12 pb-3"> 
                      <div class="col-md-12 py-5 text-right">
                        <button class="btn btn-danger btn-sm" @click="borrar_reserva_vuelo(cambiar_fecha_vuelo.orden_wordpress)">
                          Borrar reserva de este Vuelo
                        </button>
                        <button class="btn btn-light-danger btn-sm" @click="cambiar_fecha_vuelo='',vista='vuelo'">
                          Cancelar
                        </button>
                      </div>
                    </div>
                      
                    </div>
                  </div>
                </div>
                <div class="card-body" v-else-if="vista=='pedido'">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="buscardor_numero_nombre_tlf">Order - ID</label>
                        <div class="input-group">
                          <input v-model="buscardor_numero_nombre_tlf" @blur="ValidarOrder()" id="orden_wordpress" type="text" class="form-control form-control-sm">
                          <div class="input-group-append">
                            <button class="btn btn-sm  btn-secondary" type="button"> <i class="fa fa-search"></i> </button>
                          </div>
                        </div>
                        <!-- <span class="text-danger" v-if="order_ya_existe"> <i class="fa-exclamation"></i>  ID Ya existe </span> -->
                      </div> 
                    </div>  

                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordere table-hover">
                      <thead class="bg-primary text-white">
                         <tr>
                          <th class="p-2">Order-ID</th>
                          <th class="p-2">N. Pax</th>
                          <th class="p-2">Contacto</th>
                          <th class="p-2">Teléfono</th>
                          <th class="p-2">Vuelo</th>
                          <th class="p-2">Estatus</th>
                          <th class="p-2 font-weight-bolder">Cambiar</th>
                        </tr>
                      </thead>
                      <tbody> 
                        <tr v-if="pedidos.length==0">
                          <td colspan="7" class="text-center">
                            Sin Resultados
                          </td>
                        </tr>
                        <tr
                          v-for="(
                            items, index
                          ) in pedidos"
                          :key="index"
                          :class="{'bg-danger text-white': items.reembolso,'bg-success': items._rowVariant=='success'}"
                        >
                          <td>
                            <a href="#" role="button" @click="IrAPedido(items.orden_wordpress)">{{ items.orden_wordpress }}</a>
                            <span v-if="items.notas!=null" data-toggle="modal" data-target="#notaPedido" @click="nota_pedido=items.notas"><i class="fa fa-commenting text-warning" aria-hidden="true"></i></span>
                          </td>
                          <td>
                            {{ items.numpax }}
                          </td>
                          <td>
                            {{ items.nombre_contacto }}
                          </td>
                          <td>
                            {{ items.telefono_contacto }}
                          </td>
                          <td>
                            {{ items.name_vuelo }}
                          </td>
                          <td nowrap>
                            {{ items.estatus }}  <span v-if="items.reembolso">(Reembolso)</span>
                          </td>
                          <td>
                            <div class="text-warning" v-if="vuelo_seleccionado.is_exclisivo=='general' && items.privado">
                              <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> Este es un Pedido Privado
                            </div>
                            <div class="" v-else>
                              <button class="btn btn-primary btn-sm" @click="ConfirmarActualizarPedido(vuelo_seleccionado.id,items.id)"><i class="fa fa-check"></i></button>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                    <div class="col-md-12 pb-3"> 
                      <div class="col-md-12 py-5 text-right">
                        <button class="btn btn-light-danger btn-sm" @click="cambiar_fecha_vuelo='',vista='vuelo'">
                          Cancelar
                        </button>
                      </div>
                    </div>
                      
                    </div>
                  </div>
                </div>
                <div class="card-body" v-else-if="vista=='asignar_lista_espera'">
                   <div class="row">                  
                    <div class="col-md-12 mb-3">
                      <h4>Lista de Espera</h4>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordere table-hover">
                          <thead class="bg-primary text-white">
                            <tr>
                              <th class="p-2">Order-ID</th>
                              <th class="p-2">N. Pax</th>
                              <th class="p-2">Contacto</th>                          
                              <th class="p-2">Teléfono</th>
                              <th class="p-2">Fecha</th>
                              <th class="p-2">Estatus</th>
                              <th class="p-2 font-weight-bolder">Agregar</th>
                            </tr>
                          </thead>
                          <tbody> 
                            <tr v-if="pedidos_lista_espera.length==0">
                              <td colspan="7" class="text-center">
                                Sin Resultados
                              </td>
                            </tr>
                            <tr
                              v-for="(
                                items, index
                              ) in pedidos_lista_espera"
                              :key="index"
                              :class="{'bg-danger text-white': items.pedido.reembolso}"
                            >
                              <td>
                                <a href="#" role="button" @click="IrAPedido(items.pedido.orden_wordpress)">{{ items.pedido.orden_wordpress }}</a>
                                <span v-if="items.pedido.notas!=null" data-toggle="modal" data-target="#notaPedido" @click="nota_pedido=items.pedido.notas"><i class="fa fa-commenting text-warning" aria-hidden="true"></i></span>
                              </td>
                              <td>
                                {{ items.pedido.numpax }}
                              </td>
                              <td>
                                {{ items.pedido.nombre_contacto }}
                              </td>
                              <td>
                                {{ items.pedido.telefono_contacto }}
                              </td>
                              <td>
                                {{ items.fecha }}
                              </td>
                              <td nowrap>
                                {{ items.pedido.estatus }} <span v-if="items.pedido.reembolso">(Reembolso)</span>
                              </td>
                              <td>
                                  <button class="btn btn-primary btn-sm"  @click="ConfirmarActualizarPedido(vuelo_seleccionado.id,items.pedido.id)"><i class="fa fa-check"></i></button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">                      
                        <button class="btn btn-light-danger btn-sm float-right" @click="cambiar_fecha_vuelo='',vista='vuelo'">
                          Cancelar
                        </button>
                    </div>
                  </div>

                </div>
                <div class="card-body" v-else-if="vista=='cancelacion'">
                  <div class="row">
                  
                    <div class="col-md-12 mb-3">
                      <h4>Cancelar Vuelo</h4>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="nota">Motivo de Cancelación</label>
                        <textarea  id="nota" v-model="mensaje_cancelacion_vuelo" type="text" class="form-control"></textarea>
                      </div> 
                    </div> 

                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <h3>Notificar a Pedidos</h3>
                    <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordere table-hover">
                      <thead class="bg-primary text-white">
                         <tr>
                          <th>Order-ID</th>
                          <th>N. Pax</th>
                          <th>Contacto</th>
                          <th>Mensaje</th>
                          <th>Texto</th>
                        </tr>
                      </thead>
                      <tbody> 
                        <tr
                          v-for="(items, index) in vuelo_seleccionado.pedidos"
                            :key="index"
                        >
                          <td>
                            {{ items.orden_wordpress }}
                          </td>
                          <td>
                            {{ items.numpax }}
                          </td>
                          <td>
                            {{ items.nombre_contacto }}
                          </td>
                          <td>
                            <select v-model="items.mensaje_cancelacion" name="" id="" class="form-control" style="width:140px">
                              <option value="">Selecciona</option>
                              <option :value="items_msg.mensaje"  v-for="(items_msg, index_mensajes_cancelacion_zona) in vuelo_seleccionado.mensajes_cancelacion_zona" :key="index_mensajes_cancelacion_zona">Mensaje {{items_msg.id}}</option>
                            </select>
                          </td> 
                          <td>
                                  
                            <form action="/admin/cancelar_vuelo_notificar_pasajeros" method="POST" target="_blank" style="display: contents;">
                              <input type="hidden" name="_token" v-bind:value="csrf">
                              <input type="hidden" name="nombre" :value="items.nombre_contacto">
                              <input type="hidden" name="lenguaje_contacto" :value="items.lenguaje_contacto">
                              <input type="hidden" name="to" :value="items.telefono_contacto">
                              <input type="hidden" name="vuelo_id" :value="vuelo_seleccionado.id">
     
                             <editor
                                  :api-key="api_key"
                                  cloud-channel="5-dev"
                                  :init="option"
                                  :value="items.mensaje_cancelacion"
                                  :id="'mensaje'+index"
                                  name="mensaje"
                              /> 
                              <button type="submit"
                              :class="{'disabled':items.telefono_contacto==null}"
                              :disabled="items.telefono_contacto==null"
                               class=" btn
                                    label-inline
                                    float-right
                                    mr-2 mt-1
                                    label label-warning">
                                    <i aria-hidden="true" class="fab fa-whatsapp text-white mr-2"></i>
                                    Enviar Notificación
                                  </button>

                              </form>
                          </td> 

                        </tr>
                      </tbody>
                    </table>
</div>

                    <div class="col-md-12 pb-3"> 
                      <div class="col-md-12 py-5 text-right">
                        <button class="btn btn-danger btn-sm" @click="ConfirmarCancelacionVuelo()">
                          Confirmar Cancelación del vuelo
                        </button>
                        <button class="btn btn-light-danger btn-sm" @click="cambiar_fecha_vuelo='',vista='vuelo'">
                          Cancelar
                        </button>
                      </div>
                    </div>
                      
                    </div>
                  </div>
                </div>
                <div class="card-body" v-else-if="vista=='vuelo_realizado'">
                  <div class="row">                    
                    <div class="col-md-12 mb-3">
                      <h4>Confirmar Vuelo Volado</h4>
                    </div>
                  </div>
                  <form @submit="EnterPin" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
                    <div class="row">
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="lugar_despegue">Lugar Despegue </label>
                          <input v-model="vuelo_seleccionado.lugar_despegue" id="lugar_despegue" type="text" class="form-control" required>
                        </div> 
                      </div> 
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="lugar_aterrizaje">Lugar Aterrizaje </label>
                          <input v-model="vuelo_seleccionado.lugar_aterrizaje" id="lugar_aterrizaje" type="text" class="form-control" required>
                        </div> 
                      </div> 
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="fecha_despegue">Fecha Despegue</label>
                          <input v-model="vuelo_seleccionado.fecha_despegue" id="fecha_despegue" type="date" class="form-control" required>
                        </div> 
                      </div> 
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="fecha_aterrizaje">Fecha Aterrizaje</label>
                          <input v-model="vuelo_seleccionado.fecha_despegue" id="fecha_aterrizaje" type="date" class="form-control" required>
                        </div>
                      </div> 
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="hora_despegue">Hora Despegue</label>
                          <input v-model="vuelo_seleccionado.hora_despegue" id="hora_despegue" type="time" class="form-control" required>
                        </div> 
                      </div>                          
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="hora_aterrizaje">Hora Aterrizaje</label>
                          <input v-model="vuelo_seleccionado.hora_aterrizaje" id="hora_aterrizaje" type="time" class="form-control" required>
                        </div> 
                      </div>   
                      <div class="col-md-3 mb-3">
                          <b-form-checkbox
                            id="checkbox-1"
                            v-model="vuelo_seleccionado.cautivo"
                            name="checkbox-1"
                            value="1"
                            unchecked-value="0"
                          >
                            Cautivo 
                          </b-form-checkbox>                            
                      </div>   

                      <div class="col-12 pt-5 d-none" >
                          <div class="row">
                            <div class="col-md-12">
                              <span v-html="title_checklist"></span>
                            </div>
                          </div>
                          <div class="row mb-2" v-for="(item, index) in check_list" :key="index">
                              <div class="col-md-12">
                                  <input type="checkbox" class="check_list"
                                      name="" id=""
                                      value="checkedValue" @change="validarChecklist()">
                                  <span role="button" data-toggle="modal"
                                      :data-target="'#modelId'+item.id"
                                      class="h4 ml-2"
                                      style="font-weight: 400 !important;">
                                      {{ index + 1 }}.- {{ item.titulo }}
                                      <i class="fa fa-info-circle"
                                          aria-hidden="true"></i>
                                  </span>
                              </div>                                     
                            </div>
                      </div>
                            
                      <div class="col-md-12 pb-3"> 
                        <div class="col-md-12 py-5 text-right">
                          <button type="submit" class="btn btn-danger btn-sm">
                            Confirmar vuelo realizado
                          </button>
                          <button class="btn btn-light-danger btn-sm" @click="cambiar_fecha_vuelo='',vista='vuelo'">
                            Cancelar
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-body" v-else-if="vista=='validate_pin'">
                  <div class="row">                    
                    <div class="col-md-12 mb-3">
                      <h4>Confirmar PIN</h4>
                    </div>
                  </div>
                  <form @submit="ValidatePin" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
                    
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="lugar_despegue">Ingrese PIN </label>
                          <input id="lugar_despegue" v-model="pin" type="text" class="form-control">
                        </div> 
                      </div>         
                    </div>

                    <div class="row d-flex justify-content-center">                    
                      <div class="col-md-2 mb-3 text-center" v-if="PinValidate=='1'">
                        <i class="flaticon-user-ok text-success icon-4x"></i>
                        <span class="d-block"> PIN Verificado </span>
                      </div> 
                      <div class="col-md-2 mb-3 text-center" v-if="PinValidate=='0'">
                        <i class="flaticon-close icon-4x text-warning"></i>
                        <span class="d-block"> PIN no valido </span>
                      </div>
                    </div>

                    <div class="row">                    
                      <div class="col-md-12 pb-3"> 
                        <div class="col-md-12 py-5 text-right">
                          <button  v-if="PinValidate=='0' || PinValidate=='2'" type="submit" class="btn btn-danger btn-sm">
                            Validar PIN
                          </button>
                          <button @click="vista='vuelo_realizado'" v-if="PinValidate=='1'" class="btn btn-success btn-sm">
                            Continuar
                          </button>
                          <button class="btn btn-light-danger btn-sm" @click="cambiar_fecha_vuelo='',vista='vuelo'">
                            Cancelar
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <div class="">
              <ul class="pagination b-pagination text-center float-left">
                <li class="page-item flex-fill" role="button" @click="VuelosNextPrev('next')">
                  <span class="page-link bg-primary text-white">‹</span>
                </li>
                <li class="page-item flex-fill" role="button" @click="VuelosNextPrev('prev')">
                  <span class="page-link bg-primary text-white">›</span>
                </li>
              </ul>
            </div>
            <div class="">
              <button
                v-if="vuelo_seleccionado.estatus=='Creado' && pedidos_lista_espera.length>0 && can('waiting_list-create')"
                @click="vista='asignar_lista_espera'" 
                type="button"
                class="btn font-weight-bold btn-warning btn-xs">
                <span class="label label-danger">{{pedidos_lista_espera.length}}</span> Lista Espera
              </button>
 
              <div class="d-inline-flex" v-if="vuelo_seleccionado.estatus!='Cancelado Bitacora'  && can('flights-update')">
                <form action="/admin/imprimir_diploma" method="POST" target="_blank" style="display: contents;">
                  <input type="hidden" name="_token" v-bind:value="csrf">
                  <input type="hidden" name="pasajeros" v-model="checkedValue">
                  <input type="hidden" name="vuelo" v-model="vuelo_seleccionado.id">
                  <button
                    v-if="checkedValue.length==0"
                    type="submit"
                    class="btn btn-info font-weight-bold btn-xs"
                  >
                    <i class="fa fa-medal"></i> Diplomas (A Todos)
                  </button>
                  <button
                    v-else
                    type="submit"
                    class="btn btn-info font-weight-bold btn-xs"
                  >
                    <i class="fa fa-medal"></i> Diplomas (A Seleccionado)
                  </button>
                </form>
              </div>
              <button
                v-if="vuelo_seleccionado.estatus=='Creado'  && can('flights-update')"
                @click="vista='cancelacion'"
                type="button"
                class="btn btn-danger font-weight-bold btn-xs"
              >
              <i class="fa fa-times" aria-hidden="true"></i>
                Cancelar
              </button>
              <button
                v-if="vuelo_seleccionado.estatus=='Creado' && vuelo_seleccionado.is_exclisivo!='exclusivo' && can('flights-update')"
                @click="vista='pedido',pedidos=[],buscardor_numero_nombre_tlf=''"
                type="button"
                class="btn btn-info font-weight-bold btn-xs"
              >
                Pedidos
              </button>
              <button
                v-if="vuelo_seleccionado.estatus=='Creado' && vuelo_seleccionado.piloto && vuelo_seleccionado.globo && can('flights-update')"
                data-toggle="modal" :data-target="'#VueloRealizadoX'"                
                type="button"
                class="btn btn-success font-weight-bold btn-xs"
                @click="ValidarCamposMarcaComoVoladoAntes(), vista='vuelo_realizado'"          
               
              >
                 Marcar Volado
              </button>
              <button class="d-none" id="OpenVueloRealizado" data-toggle="modal" :data-target="'#VueloRealizado'"></button>
              <button
                v-if="vuelo_seleccionado.estatus=='Creado' && (!vuelo_seleccionado.piloto || !vuelo_seleccionado.globo) && can('flights-update')"
                @click="AlertarFaltaPilotoGlobo()"          
                type="button"
                class="btn btn-success font-weight-bold btn-xs"
              >
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Marcar Volado
              </button> 
               
              <button v-if="vuelo_seleccionado.estatus=='Volado' && can('admin_multimedias')" class="btn btn-info  btn-xs symbol symbol-100 mr-5" :class="{'disabled':(vuelo_seleccionado.multimedias && vuelo_seleccionado.multimedias.length==0)}" @click="IrMultimediaEvento()"
                    :title="vuelo_seleccionado.estado_multimedia"> 
                        <span>
                            <i class="fa fa-picture-o p-0" aria-hidden="true"></i> 
                            <i class="symbol-badge" :class="{
                                'bg-success':(vuelo_seleccionado.estado_multimedia=='No se ha registrado Multimedias' || vuelo_seleccionado.estado_multimedia=='Multimedia No Habilitado'),
                                'bg-info':(vuelo_seleccionado.estado_multimedia=='Multimedia Descargado'),
                                'bg-warning':(vuelo_seleccionado.estado_multimedia=='Multimedia Disponible'),
                                'bg-danger':(vuelo_seleccionado.estado_multimedia=='Multimedia Caducado')}
                            "></i>
                        </span> 
                        <i class="fa fa-envelope" aria-hidden="true" v-if="vuelo_seleccionado.multimedia_notification_pedidos"></i>
                        Multimedia
                    </button>
              <button
                v-if="vuelo_seleccionado.estatus!='Cancelado Bitacora' && can('flights-update')"
                @click="IrEditarEvento()"
                type="button"
                class="btn btn-warning font-weight-bold btn-xs"
                data-dismiss="modal"
              >
                Editar Vuelo
              </button>
              <button
                @click="cambiar_fecha_vuelo='',vista='vuelo'"
                type="button"
                class="btn btn-light-primary font-weight-bold close2 btn-xs"
                data-dismiss="modal"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div v-for="(item, index) in check_list" :key="index" class="modal fade"
        :id="'modelId'+item.id" tabindex="-1"
        role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles</h5>
                    <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- {!! $item->descripcion !!} -->
                    </div>
                </div>
                <div class="modal-footer">
                    <span type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</span>
                </div>
            </div>
        </div>
    </div>

      <div class="modal fade" id="VueloRealizado" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Completar Detalles del vuelo Realizado
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form @submit="ValidarCamposMarcaComoVolado" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
                  <div class="modal-body">      
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="lugar_despegue">Lugar Despegue </label>
                            <input v-model="vuelo_seleccionado.lugar_despegue" id="lugar_despegue" type="text" class="form-control">
                          </div> 
                        </div> 
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="fecha_despegue">Fecha Despegue</label>
                            <input v-model="vuelo_seleccionado.fecha_despegue" id="fecha_despegue" type="date" class="form-control">
                          </div> 
                        </div> 
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="hora_despegue">Hora Despegue</label>
                            <input v-model="vuelo_seleccionado.hora_despegue" id="hora_despegue" type="time" class="form-control">
                          </div> 
                        </div>  
                      </div> 
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="lugar_aterrizaje">Lugar Aterrizaje </label>
                            <input v-model="vuelo_seleccionado.lugar_aterrizaje" id="lugar_aterrizaje" type="text" class="form-control">
                          </div> 
                        </div> 
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="fecha_aterrizaje">Fecha Aterrizaje</label>
                            <input v-model="vuelo_seleccionado.fecha_despegue" id="fecha_aterrizaje" type="date" class="form-control">
                          </div>
                        </div> 
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="hora_aterrizaje">Hora Aterrizaje</label>
                            <input v-model="vuelo_seleccionado.hora_aterrizaje" id="hora_aterrizaje" type="time" class="form-control">
                          </div> 
                        </div>   
                        <div class="col-md-3 mb-3">
                            <b-form-checkbox
                              id="checkbox-1"
                              v-model="vuelo_seleccionado.cautivo"
                              name="checkbox-1"
                              value="1"
                              unchecked-value="0"
                            >
                              Cautivo s
                            </b-form-checkbox>
                            
                        </div>   
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary font-weight-bold">Confirmar Vuelo Realizado</button>
                      <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                  </div>
                </form>
            </div>
        </div>
      </div>
                   
        <!-- Modal -->
        <div class="modal fade" id="notaPedido" role="dialog" aria-labelledby="asdasdasda" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Notal del Pedido</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                {{nota_pedido}}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
  </div>
</template>

<script>
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import esLocale from "@fullcalendar/core/locales/es";

var todayDate = moment().startOf("day");
var YM = todayDate.format("YYYY-MM");
var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
var TODAY = todayDate.format("YYYY-MM-DD");
var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");
 import Editor from '@tinymce/tinymce-vue'

export default {
  components: {
    FullCalendar, // make the <FullCalendar> tag available
                'editor': Editor

  },
  data() {
    return {
      api_key:'4uqg5bfl6an0lmdfdghkap4yfejy8ovqglkfaahssobrd8mv',
      option:{
          height: "150",
          menubar: false,
          plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount'
          ],
          toolbar:
          'undo redo | formatselect | bold italic backcolor'
      }, 
      
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

      paso_reserva: 'seleccionar_reserva',
      nota_pedido: '',
      buscardor_numero_nombre_tlf: '',
      checkedValue: [],
      pedidos: [],
      pedidos_lista_espera: [],
      dias_lista_espera: [],
      zona_lista_espera: [],
      fecha_inicio_disp: '',
      fecha_fin_disp: '',
      fecha_inicio_nodisp: '',
      fecha_fin_nodisp: '',
      vista: 'vuelo',
      GuardandoCambios: false,
      cambiar_fecha_vuelo: '',
      mensaje_cancelacion_vuelo: '',
      fecha: '',
      zona_id: '',
      vuelos: [],
      Zonas: [],
      vuelo_seleccionado: "",
      Records: [],
      SeleccionarPedidoReserva: false,
      PinValidate: 2,
      pin: '',
      title_checklist: '',
      fields: [
        { key: "id", label: "#", sortable: true, sortDirection: "desc" },
        {
          key: "fecha",
          label: "Fecha",
          sortable: true,
          sortDirection: "desc",
          formatter: (value) => {
            return moment(value).format("DD/MM/YYYY");
          },
        },
        {
          key: "zona.nombre",
          label: "Zona",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "piloto",
          label: "Piloto",
          sortable: true,
          sortDirection: "desc",
          formatter: (value) => {
            return (value!=null) ? value.nombres + " " + value.apellidos  : '';
          },
        },
        {
          key: "globo.nombre",
          label: "Globo",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "carga",
          label: "Carga Total",
          sortable: true,
          sortDirection: "desc",
        },
        
      ],
      check_list : []
      // form : {
      //   lugar_despegue : '',
      //   fecha_despegue : '',
      //   hora_despegue : '',
      //   lugar_aterrizaje : '',
      //   hora_aterrizaje : '',
      //   cautivo : 0,
      // } 

    };
  },
  mounted() {
    this.Buscar();
    this.BuscarZonas();
    this.initObs();
    this.BuscarCheckList();
    this.Buscartitle_checklist();
 
  },
  methods: {
    
    Buscar() {
      var vuelos = [];
      var url = "/admin/vuelos";
      axios
        .get(url)
        .then((response) => {
          this.Records = response.data.records;

          this.vuelos = _(response.data.records)
            .map(function (items) {

              var nombre = items.turno+' '+items.zona.nombre+"-"+items.cantidad_pasajeros;
              
              if (screen.width < 1024) {
                var nombre =  items.turno+'<br\> '+ items.zona.nombre_corto+"-"+items.cantidad_pasajeros;
              }
 
              return {
                fullData: items,
                allDay: true,
                title: nombre,
                start: items.fecha,
                backgroundColor: items.zona.color,
                textColor: items.zona.color_text,
                classNames: [(items.estatus=='Volado' && !items.multimedia_notification_pedidos)?'volado d-flex':(items.estatus=='Volado' && items.multimedia_notification_pedidos)?'volado_multimedia d-flex':'', (items.cantidad_pasajeros_registrados>0 && items.cantidad_pasajeros == items.cantidad_pasajeros_registrados && items.estatus!='Cancelado') ? 'pasajeros_completos' : '', (items.estatus=='Volado' && !items.multimedia_notification_pedidos)?'volado d-flex':(items.estatus=='Cancelado')?'cancelado d-flex':'', (items.is_exclisivo=='exclusivo')?'privado d-flex':'']
                // className:'fa fa-home'
              };
            })
            .value();

          console.log(vuelos);
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
        initObs(){
          var that = this;
          window.setInterval(() => {
              that.Buscar();   
          }, 10000)
        },
        formatDay(value) {      
          return moment(value).format('ddd');
        },
    
          ValidarCamposMarcaComoVolado(evt) {
            evt.preventDefault(); 
            var _this = this;
            if(this.vuelo_seleccionado.lugar_despegue=='' || this.vuelo_seleccionado.fecha_despegue=='' || this.vuelo_seleccionado.lugar_aterrizaje=='' || this.vuelo_seleccionado.hora_despegue=='' || this.vuelo_seleccionado.hora_aterrizaje==''){
              Swal.fire({
                title: "Información Incompleta!",
                text: "Desea autocompletar la información que falta?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, autocompletar y continuar!",
                cancelButtonText: "No, Continuar de todas formas!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {   
                  if(_this.vuelo_seleccionado.lugar_despegue==''){
                    _this.vuelo_seleccionado.lugar_despegue = _this.vuelo_seleccionado.zona.nombre;
                  }
                  if(_this.vuelo_seleccionado.lugar_aterrizaje==''){
                    _this.vuelo_seleccionado.lugar_aterrizaje = _this.vuelo_seleccionado.zona.nombre;
                  }
                  if(_this.vuelo_seleccionado.fecha_despegue==''){
                    _this.vuelo_seleccionado.fecha_despegue = _this.vuelo_seleccionado.fecha;
                  }
                  if(_this.vuelo_seleccionado.hora_despegue==''){
                    _this.vuelo_seleccionado.hora_despegue = _this.vuelo_seleccionado.hora;
                  }
                  if(_this.vuelo_seleccionado.hora_aterrizaje==''){
                    _this.vuelo_seleccionado.hora_aterrizaje = _this.vuelo_seleccionado.hora;
                  }  
                  _this.MarcaComoVolado(evt); 
                }else{
                  _this.MarcaComoVolado(evt);
                }
              }); 
            }else{
              _this.MarcaComoVolado(evt);
            }
          },
          ValidarCamposMarcaComoVoladoAntes() { 
            var _this = this;
            if(_this.vuelo_seleccionado.lugar_despegue==null || _this.vuelo_seleccionado.lugar_despegue==''){
              _this.vuelo_seleccionado.lugar_despegue = _this.vuelo_seleccionado.zona.nombre;
            }
            if(_this.vuelo_seleccionado.lugar_aterrizaje==null || _this.vuelo_seleccionado.lugar_aterrizaje==''){
              _this.vuelo_seleccionado.lugar_aterrizaje = _this.vuelo_seleccionado.zona.nombre;
            }
            if(_this.vuelo_seleccionado.fecha_despegue==null || _this.vuelo_seleccionado.fecha_despegue==''){
              _this.vuelo_seleccionado.fecha_despegue = _this.vuelo_seleccionado.fecha;
            }
            if(_this.vuelo_seleccionado.hora_despegue==null || _this.vuelo_seleccionado.hora_despegue==''){
              _this.vuelo_seleccionado.hora_despegue = _this.vuelo_seleccionado.hora;
            }
            if(_this.vuelo_seleccionado.hora_aterrizaje==null || _this.vuelo_seleccionado.hora_aterrizaje==''){
              _this.vuelo_seleccionado.hora_aterrizaje = _this.vuelo_seleccionado.hora;
            }  
            if(_this.vuelo_seleccionado.hora_aterrizaje==null || _this.vuelo_seleccionado.hora_aterrizaje==''){
              _this.vuelo_seleccionado.hora_aterrizaje = _this.vuelo_seleccionado.hora;
            } 
          },
    onRowClicked(data) {
      console.log('myRowClickHandler',data);      
      $(".BtnVerVuelo").click(); 
      this.vuelo_seleccionado = data.data; 




    },

    IrAPedido(id) {
      
      $("#VerVuelo .close").click(); 
      $("#VerVuelo .close2").click(); 
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      
      this.$router.push({
          path: '/pedidos/consultar/'+id+'/dashboard'
      });

    },  
    IrMultimediaEvento() {
      
      $("#VerVuelo .close").click(); 
      $("#VerVuelo .close2").click(); 
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      
      this.$router.push({
          path: '/vuelos/multimedia/'+this.vuelo_seleccionado.id
      });

    },  
    IrEditarEvento() {
      
      $("#VerVuelo .close").click(); 
      $("#VerVuelo .close2").click(); 
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      
      this.$router.push({
          path: '/vuelos/consultar/'+this.vuelo_seleccionado.id+'/dashboard'
      });

    },  

    ValidarOrder() { 
      
      var url = '/admin/buscardor_numero_nombre_tlf_pedidos';

      axios.post(url,{
          buscar: this.buscardor_numero_nombre_tlf,                
          token         :   this.token
      }).then(response=>{
          this.pedidos = response.data.records;   
      }).catch(error => {
          this.errors = error.response.data
      });
    },

    BuscarCheckList() { 
      
      var url = '/check_list/piloto';

      axios.get(url).then(response=>{
          this.check_list = response.data;   
          console.log(this.check_list);
      }).catch(error => {
          this.errors = error.response.data
      });
    },

    BuscarZonas() {
      var url = '/admin/listado_zonas';
          axios.get(url).then(response=>{
              this.Zonas = response.data.records;   
          }).catch(error => {
              this.errors = error.response.data
          });
    },

    
    Buscartitle_checklist() {
      var url = '/encontrar_configuracion/format_title_checklist_pilotos';
          axios.get(url).then(response=>{
              this.title_checklist = response.data;   
          }).catch(error => {
              this.errors = error.response.data
          });
    },

    
          AlertarFaltaPilotoGlobo(evt) {             
            Swal.fire({
              title: "Información Incompleta!",
              text: "Faltan Datos de Piloto y/o Globo, Esta seguro que desea continuar?",
              icon: "warning",
              showCancelButton: true,
              confirmButtonText: "Si, continuar!",
              cancelButtonText: "No, Cancelar!",
              reverseButtons: true
            }).then(function(result) {
              if (result.value) {          
                $("#OpenVueloRealizado").click();     
              }
            });
          },
        borrar_reserva_vuelo(vuelo_id , pedido = null) {
              var _this = this;
              
              var pedido_id = '';
              
              if(pedido==null){
                pedido_id = this.cambiar_fecha_vuelo.id;
              }else{
                pedido_id = pedido;
              }

console.log(pedido_id);
             Swal.fire({
                title: "Confirmar!",
                text: "Confirme que desea borrar este pedido de este vuelo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/pedidos/'+pedido_id;

                    axios.post(url,{
                        _method: 'PUT',                
                        vuelo_id: null,   
                        tipo : 'vuelo',             
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Pedido actualizado Correctamente');
                        _this.Buscar();
                  
                        $("#VerVuelo .close").click(); 
                        $("#VerVuelo .close2").click(); 
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();

                        _this.cambiar_fecha_vuelo = '';
                        _this.vista = 'vuelo';
                      }
   
                    }).catch(error => {
                        console.log(error);
                        this.errors = error.response
                    });
                }
              });

        },  
   
        ConfirmarActualizarPedido(vuelo_id , pedido = null) {
              var _this = this;
              
              var pedido_id = '';
              
              if(pedido==null){
                pedido_id = this.cambiar_fecha_vuelo.id;
              }else{
                pedido_id = pedido;
              }

             Swal.fire({
                title: "Confirmar!",
                text: "Confirme que desea actualizar el pedido para este vuelo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/pedidos/'+pedido_id;

                    axios.post(url,{
                        _method: 'PUT',                
                        vuelo_id: vuelo_id,
                        tipo: 'vuelo',                 
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Pedido actualizado Correctamente');
                        _this.Buscar();
                  
                        // $("#registrarReserva .close").click(); 
                        // $("#VerVuelo .close").click(); 
                        // $("#VerVuelo .close2").click(); 
                        //  $('body').removeClass('modal-open');
                        // $('.modal-backdrop').remove();

                        _this.paso_reserva='seleccionar_reserva';
                        _this.pedidos=[];
                        _this.buscardor_numero_nombre_tlf='';

                        _this.cambiar_fecha_vuelo = '';
                        // _this.vista = 'vuelo';
                      }
   
                    }).catch(error => {
                        console.log(error);
                        this.errors = error.response
                    });
                }
              });

        },  
   
          MarcaComoVolado(evt) {

            evt.preventDefault(); 

            var url = '/admin/vuelo_volado';

            axios.post(url,{          
                id: this.vuelo_seleccionado.id,                
                form: this.vuelo_seleccionado,                
                token         :   this.token
            }).then(response=>{
              
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Vuelo marcado como volado Correctamente');
                this.Buscar();
          
                $("#VueloRealizado .close").click(); 
                $("#VueloRealizado .close2").click(); 
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
          
                $("#VerVuelo .close").click(); 
                $("#VerVuelo .close2").click(); 
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

              }

            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });

          },  

          ConfirmarCancelacionVuelo() {

            var url = '/admin/confirmar_cancelacion_vuelo';

            axios.post(url,{          
                id: this.vuelo_seleccionado.id,                
                form: this.vuelo_seleccionado,                
                mensaje_cancelacion_vuelo: this.mensaje_cancelacion_vuelo,                
                token         :   this.token
            }).then(response=>{
              
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Vuelo cancelado Correctamente');
                this.Buscar();
          
                $("#VueloRealizado .close").click(); 
                $("#VueloRealizado .close2").click(); 
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
          
                $("#VerVuelo .close").click(); 
                $("#VerVuelo .close2").click(); 
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

              }

            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });

          },  

   
        MarcaComoVoladoOld() {
              var _this = this;

             Swal.fire({
                title: "Confirmar!",
                text: "Confirme que desea marcar este vuelo como volado!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/vuelo_volado';

                    axios.post(url,{          
                        id: _this.vuelo_seleccionado.id,                
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Vuelo marcado como volado Correctamente');
                        _this.Buscar();
                  
                        $("#VerVuelo .close").click(); 
                        $("#VerVuelo .close2").click(); 
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
 
                      }
   
                    }).catch(error => {
                        console.log(error);
                        this.errors = error.response
                    });
                }
              });

        },  

        EnterPin(evt) {          
          evt.preventDefault();
          if(this.PinValidate!="1"){
            this.vista = 'validate_pin';
          }else{
            this.ValidarCamposMarcaComoVolado(evt);
          }
        }, 
        ValidatePin(evt) {          
          evt.preventDefault();
          var url = '/admin/validate_pin';
          axios.post(url,{          
              id: this.vuelo_seleccionado.id,                
              pin : this.pin,
              token         :   this.token
          }).then(response=>{            
            this.PinValidate = response.data.result;
          }).catch(error => {
              console.log(error);
              this.errors = error.response
          });
        },
 
        RegistarVuelo(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
                
              let formData = new FormData();
    
              formData.append('zona_id', this.zona_id); 
              formData.append('fecha', this.fecha); 
              formData.append('pedido_id', this.cambiar_fecha_vuelo.id===undefined ? this.SeleccionarPedidoReserva.id : this.cambiar_fecha_vuelo.id); 
  
               var url = '/admin/vuelos';

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar registrar y cambiar fecha de reserva', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Vuelo Registrado y Pedido Actualizado Correctamente');                  
                  this.Buscar();
                  
                  $("#VerVuelo .close").click(); 
                  $("#registrarReserva .close").click(); 
                  $("#VerVuelo .close2").click(); 
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();

                  this.cambiar_fecha_vuelo = '';
                }     


              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 

      VuelosNextPrev(accion) {
        var vuelo_seleccionado = this.vuelo_seleccionado.id;
        var index_now = _.findIndex(this.Records, function(o) { return o.id == vuelo_seleccionado; });
        if(accion=='prev'){
          if(index_now>0){
            var prev = index_now - 1;
            this.vuelo_seleccionado = this.Records[prev];
          }
        }else{
          var next = index_now + 1;  
          if(this.Records[next]!==undefined){
            this.vuelo_seleccionado = this.Records[next];
          } 
        }        
      },

          ActualizarContacto() {
            
            var url = '/admin/actualizar_contacto';

            axios.post(url,{
                pedido_id: this.SeleccionarPedidoReserva.id,    
                nombre_contacto: this.SeleccionarPedidoReserva.nombre_contacto,
                email_contacto: this.SeleccionarPedidoReserva.email_contacto,
                telefono_contacto: this.SeleccionarPedidoReserva.telefono_contacto,
                ciudad_contacto: this.SeleccionarPedidoReserva.ciudad_contacto,
                lenguaje_contacto: this.SeleccionarPedidoReserva.lenguaje_contacto,
                token         :   this.token
            }).then(response=>{
              
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Datos de Contacto Actualizado Correctamente');
                
              }                           
              
            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });
                      

          },  
          BuscarListaEspera() {
            
            var url = '/admin/pedidos_lista_espera/'+this.vuelo_seleccionado.id;

            axios.get(url).then(response=>{                                
               this.pedidos_lista_espera = response.data.records;              
            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });
                      

          },  

          validarChecklist(){
            // var disabled = false;
            // $('input:checkbox.check_list').each(function() {
            //   if (!this.checked) {
            //     disabled = true;
            //     }
            // });
            // if (disabled) {
            //     $('.validar_terminos').attr('disabled', 'disabled');
            //     $('.validar_terminos').addClass('disabled');
            // } else {
            //     $('.validar_terminos').removeAttr('disabled');
            //     $('.validar_terminos').removeClass('disabled');
            // }
          },

          ResetDatosListaReserver(){
            this.pedido_id = '';
            this.zona_lista_espera = [];
            this.dias_lista_espera = [];
            this.fecha_inicio_disp = '';
            this.fecha_fin_disp = '';
            this.fecha_inicio_nodisp = '';
            this.fecha_fin_nodisp = '';
          },
          ConfirmarRegistrarListaEspera() {
            
            var url = '/admin/pedidos_lista_espera';

            axios.post(url,{
                pedido_id: this.SeleccionarPedidoReserva.id,    
                zonas_id: this.zona_lista_espera,
                dias: this.dias_lista_espera,
                fecha_inicio_disp: this.fecha_inicio_disp,
                fecha_fin_disp: this.fecha_fin_disp,
                fecha_inicio_nodisp: this.fecha_inicio_nodisp,
                fecha_fin_nodisp: this.fecha_fin_nodisp,            
                token         :   this.token
            }).then(response=>{                            
 
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Lista de Espera registrada Correctamente');
                
              }     

              this.paso_reserva='seleccionar_reserva';
              this.pedidos=[];
              this.buscardor_numero_nombre_tlf='';
              this.ResetDatosListaReserver();


              // $("#registrarListaEspera .close").click(); 
              // $('body').removeClass('modal-open');
              // $('.modal-backdrop').remove();

            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });
                      

          },  
  },
  computed: {
    ListRecords: function () {
      var data = this.Records;
      return data.filter(
        (items) => items.fecha >= moment().format("YYYY-MM-DD")
      );
    },

    calendarOptions() {
      var _this = this;
      return {
        
        longPressDelay: 0,
        locale: esLocale,
        events: this.vuelos,
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin],
        editable: false,
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        height: 800,
        contentHeight: 780,
        aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

        nowIndicator: true,
        now: TODAY + "T09:25:00", // just for demo

        views: {
          dayGridMonth: { buttonText: "month" },
          timeGridWeek: { buttonText: "week" },
          timeGridDay: { buttonText: "day" },
        },
        displayEventTime: false,
        initialView: "dayGridMonth",
        defaultAllDay: true,
        initialDate: TODAY,
        eventClick: function (info) {
          _this.vuelo_seleccionado = info.event.extendedProps.fullData; 
          $(".BtnVerVuelo").click();   
          info.el.style.borderColor = "red";
        },
        eventContent: function(info) {
          return { html: '<div class="fc-content">' + info.event.title + '</div>' };
        },
      };
    },
  },
  watch: {
    'vuelo_seleccionado': function () {
      console.log(this.vuelo_seleccionado);
      if(this.vuelo_seleccionado.dataVueloCancelado!=false && this.vuelo_seleccionado.estatus != 'Cancelado Bitacora' ){
          this.vuelo_seleccionado = this.vuelo_seleccionado.dataVueloCancelado.vuelo;
          this.vuelo_seleccionado.estatus = 'Cancelado Bitacora';
      }
    },
  },
};

</script>

<style>

.pasajeros_completos>.fc-event-main>.fc-event-main-frame>.fc-event-title-container>.fc-event-title:after {
  font-family: "Font Awesome 5 Free";
  content: "\f4fc";
  display: inline-block;
  padding-right: 1px;
  font-weight: 900;
  color: #000000;
}

.cancelado:before {
  font-family: "Font Awesome 5 Free";
  content: "\f00d";
  display: inline-block;
  padding-right: 1px;
  font-weight: 900;
  color: #F64E60 ;
}

.privado:before {
  font-family: "Font Awesome 5 Free";
  content: "\f005";
  display: inline-block;
  padding-right: 1px;
  font-weight: 900;
  color: #FFA800 ;
}

.volado:before {
  font-family: "Font Awesome 5 Free";
  content: "\f058";
  display: inline-block;
  padding-right: 1px;
  font-weight: 900;
  color: #FFA800;
}

.volado_multimedia:before {
  font-family: "Font Awesome 5 Free";
  content: "\f058";
  display: inline-block;
  padding-right: 1px;
  font-weight: 900;
  color: #187DE4;  
}



@media (max-width:768px) {
  .pasajeros_completos>.fc-event-main>.fc-event-main-frame>.fc-event-title-container>.fc-event-title:after {
    font-size: 9px !important;
  }
  .cancelado:before {
      font-size: 9px !important;
  }
  .privado:before {
      font-size: 9px !important;
  }
  .volado:before {
      font-size: 9px !important;
  }
  .volado_multimedia:before {
      font-size: 9px !important;
  }
  .fc-event-title {
    font-size: 9px !important;
  }
  .body-calendario {
    padding-left: 0px !important;
    padding-right: 0px !important;
  }

}
 
</style>
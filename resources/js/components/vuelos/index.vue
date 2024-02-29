<template>
<div>
  
    <base-loading></base-loading>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
          <h3 class="card-title w-100 d-flex justify-content-between">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-plane-departure text-dark"></i>

              Listado de vuelos
            </span>

            <router-link
              :to="path_principal + '/crear'"
              v-if="can('flights-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar {{ path_principal }} </span>
            </router-link>
          </h3>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <button v-b-toggle.collapse-3 type="button" class="btn btn-primary  float-right">
                <i class="fa fa-filter" aria-hidden="true"></i> Filtros
              </button>
            </div>
          </div>

          <b-collapse id="collapse-3">
            <div class="row pt-5">
              <div class="col-md-12">
                <h3>Filtros</h3>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Globos</label>         
                      <select class="form-control" id="selectpicker_globos" data-live-search="true" v-model="filtro.globo">
                        <option value="" selected disabled>Seleccione</option>
                        <option v-for="(item, index) in filtros.globos" :key="index" :value="item.id">{{item.name}} </option>
                      </select> 
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Pilotos </label>      
                      <select class="form-control" id="selectpicker_pilotos" data-live-search="true" v-model="filtro.piloto">
                        <option v-for="(item, index) in filtros.pilotos" :key="index" :value="item.id">{{item.name}} </option>
                      </select> 
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Zonas</label>   
                      <select class="form-control" id="selectpicker_zonas" data-live-search="true" v-model="filtro.zona">
                        <option v-for="(item, index) in filtros.zonas" :key="index" :value="item.id">{{item.name}} </option>
                      </select> 
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Estados</label>
                      <select class="form-control" id="selectpicker_estados" data-live-search="true" v-model="filtro.estado">
                        <option v-for="(item, index) in filtros.estados" :key="index" :value="item.id">{{item.name}} </option>
                      </select> 
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Rangos de Fechas</label>
                      <div class="row">
                        <div class="col-6">
                          <input
                            type="date"
                            v-model="filtro.inicio"
                            name="gfhfg"
                            id="gdf"
                            class="form-control"
                          />
                          <span class="text-muted">Fecha de Inicio</span>
                        </div>
                        <div class="col-6">
                          <input
                            type="date"
                            v-model="filtro.fin"
                            name="dasd"
                            id="sdf"
                            class="form-control"
                          />
                          <span class="text-muted">Fecha de Fin</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Vuelos Incompletos</label>
                      <b-form-checkbox
                        size="lg"
                        v-model="filtro.informacion_incompleta"
                        name="informacion_incompleta-1"
                        value="1"
                        unchecked-value="0"
                      >
                        Mostrar Solo Vuelos Con Información Incompleta
                      </b-form-checkbox>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <button  type="button" class="btn btn-danger mt-10" @click="RemoverFiltros()">
                      <i class="fa fa-times" aria-hidden="true"></i> Limpiar Filtros
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </b-collapse>

          <div class="row pt-5">
            <div class="col-md-12">
              <tabla-component
                :striped="true"
                :fields="fields"
                :listado="recordsFiltros"
                :can_ver="can('flights-read')"
                :can_editar="can('flights-update')"
                :can_eliminar="can('flights-delete')"
                :can_especial="can('admin_multimedias')"
                titulo="Vuelos"
                exportar_datos="true"
                @ButtonEdit="ButtonEdit"
                @ButtonDelete="ButtonDelete"
                @ButtonGo="ButtonGo"
                @ButtonMultimedia="ButtonMultimedia"
              ></tabla-component>
            </div>
          </div>
          <!-- 
          <tabla-component :striped="true"
            :fields="fieldsEmpleado" 
            :listado="Listado" 
            titulo="Usuario"
            @ButtonDelete="ButtonDelete"
            @ButtonEdit="ButtonEdit"
          ></tabla-component> -->
        </div>
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
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>

          <div class="modal-body p-0">
            <div class="card card-custom">
              <div
                class="card-header card-header-left ribbon ribbon-clip ribbon-right"
              >
                <div class="ribbon-target" style="top: 12px">
                  <span
                    class="ribbon-inner"
                    :class="{
                      'bg-warning': vuelo_seleccionado.estatus == 'Creado',
                      'bg-success': vuelo_seleccionado.estatus == 'Volado',
                    }"
                  ></span>
                  {{ vuelo_seleccionado.estatus }}
                </div>
                <h3 class="card-title">Detalles del Vuelo</h3>
              </div>

              <div class="card-body" v-if="vista == 'vuelo'">
                <div class="row">
                  <div
                    class="col-12 col-sm-12 col-md-12 col-lg-4"
                    id="kt_profile_aside"
                  >
                    <!--begin::Nav Panel Widget 2-->
                    <div
                      class="card card-custom shadow-lg"
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
                                class="symbol symbol-80 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center"
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
                                <router-link
                                  :to="
                                    '/vuelos/consultar/' + vuelo_seleccionado.id
                                  "
                                  data-dismiss="modal"
                                  class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"
                                  >Vuelo {{ vuelo_seleccionado.id }}
                                </router-link>
                                <div class="text-dark-75">
                                  Zona :
                                  {{
                                    vuelo_seleccionado.zona
                                      ? vuelo_seleccionado.zona.nombre
                                      : ""
                                  }}
                                  <br />
                                  Fecha :
                                  {{
                                    vuelo_seleccionado.fecha
                                      | formatDate("d-m-Y")
                                  }}
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
                                      class="fas fa-lightbulb fa-2x text-primary"
                                    ></i>
                                    <!--end::Svg Icon-->
                                  </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div
                                  class="d-flex flex-column flex-grow-1"
                                  v-if="vuelo_seleccionado.globo"
                                >
                                  <router-link
                                    :to="
                                      '/globos/consultar/' +
                                      vuelo_seleccionado.globo.id
                                    "
                                    data-dismiss="modal"
                                    class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"
                                    >{{
                                      vuelo_seleccionado.globo
                                        ? vuelo_seleccionado.globo.nombre
                                        : ""
                                    }}
                                  </router-link>
                                  <span class="text-dark-75 font-weight-bold"
                                    >Matricula
                                    {{
                                      vuelo_seleccionado.globo
                                        ? vuelo_seleccionado.globo.matricula
                                        : ""
                                    }}</span
                                  >
                                </div>
                                <div
                                  class="d-flex flex-column flex-grow-1"
                                  v-else
                                >
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
                                <div
                                  class="d-flex flex-column flex-grow-1"
                                  v-if="vuelo_seleccionado.piloto"
                                >
                                  <router-link
                                    :to="
                                      '/pilotos/consultar/' +
                                      vuelo_seleccionado.piloto.id
                                    "
                                    data-dismiss="modal"
                                    class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"
                                  >
                                    {{
                                      vuelo_seleccionado.piloto
                                        ? vuelo_seleccionado.piloto.nombres +
                                          " " +
                                          vuelo_seleccionado.piloto.apellidos
                                        : ""
                                    }}
                                  </router-link>
                                  <span class="text-dark-75 font-weight-bold">{{
                                    vuelo_seleccionado.piloto
                                      ? vuelo_seleccionado.piloto.telefono
                                      : ""
                                  }}</span>
                                </div>
                                <div
                                  class="d-flex flex-column flex-grow-1"
                                  v-else
                                >
                                  Sin Piloto
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
                                      class="fa fa-balance-scale fa-2x text-danger"
                                    ></i>
                                  </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column flex-grow-1">
                                  <a
                                    href="#"
                                    class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"
                                    >Peso Total :
                                    {{ vuelo_seleccionado.carga }} KGS</a
                                  >
                                  <span class="text-dark-75 font-weight-bold"
                                    >GAS:
                                    {{
                                      vuelo_seleccionado.gas +
                                      vuelo_seleccionado.reserva
                                    }}
                                    KG <br />
                                    PASAJEROS:
                                    {{ vuelo_seleccionado.peso_pasajeros }} KGS
                                    <br />
                                    GLOBO {{ vuelo_seleccionado.peso_globo }} KG
                                  </span>
                                </div>
                                <!--end::Text-->
                                <!--begin::label-->

                                <!--end::label-->
                              </div>
                              <!--end::Item-->
                              <p
                                class="text-dark-75 font-weight-nirmal font-size-lg m-0"
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

                  <div
                    class="col-12 col-sm-12 col-md-12 col-lg-8"
                    v-if="vuelo_seleccionado"
                  >
                    <div class="card card-custom shadow-lg">
                      <!--begin::Body-->
                      <div class="card-body">
                        <div
                          class="row"
                          v-if="
                            !vuelo_seleccionado.pedidos ||
                            (vuelo_seleccionado.pedidos &&
                              vuelo_seleccionado.pedidos.length == 0)
                          "
                        >
                          <div class="col-md-8 offset-2 pt-1">
                            <div
                              class="alert alert-custom alert-danger"
                              role="alert"
                            >
                              <div class="alert-icon">
                                <i
                                  class="flaticon-questions-circular-button"
                                ></i>
                              </div>
                              <div class="alert-text">
                                No hay pedidos para este vuelo!
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="timeline timeline-3" v-else>
                          <div class="timeline-items">
                            <div
                              class="timeline-item"
                              v-for="(
                                pedido, index
                              ) in vuelo_seleccionado.pedidos"
                              :key="index"
                            >
                              <div class="timeline-media">
                                <span
                                  class="btn-link"
                                  role="button"
                                  @click="IrAPedido(pedido.orden_wordpress)"
                                >
                                  {{ pedido.orden_wordpress }}
                                </span>
                              </div>
                              <div class="timeline-content">
                                <div class="mb-10">
                                  <div
                                    class="mr-2 w-100 d-flex justify-content-end"
                                  >
                                    <a
                                      :href="
                                        '/pedidos_enviar_formulario/' +
                                        pedido.id
                                      "
                                      v-if="pedido.estatus != 'Vuelo Realizado'"
                                      target="_blank"
                                      class="label-inline float-right mr-2 label label-warning"
                                    >
                                      <i
                                        class="fab fa-whatsapp text-white mr-2"
                                        aria-hidden="true"
                                      ></i>
                                      Enviar Formulario
                                    </a>

                                    <span
                                      v-if="pedido.estatus != 'Vuelo Realizado'"
                                      role="button"
                                      class="label label-primary font-weight-bolder label-inline float-right"
                                      @click="
                                        (cambiar_fecha_vuelo = pedido),
                                          (vista = 'cambiar_fecha_vuelo')
                                      "
                                      >Cambiar fecha reserva</span
                                    >
                                  </div>

                                  <div class="mr-2">
                                    <a
                                      href="#"
                                      class="text-dark-75 text-hover-primary font-weight-bold"
                                      ><strong>NumPax</strong>:
                                      {{ pedido.numpax }}</a
                                    >

                                    <span class="text-dark-75 ml-2 small"
                                      >({{ pedido.nombre_contacto }} -
                                      {{ pedido.telefono_contacto }} -
                                      {{ pedido.ciudad_contacto }})</span
                                    >
                                  </div>
                                  <div class="mr-2">
                                    <strong>Estado Pedido</strong> :
                                    {{ pedido.estatus }} /
                                    <strong>Multimedia</strong>:
                                    <i
                                      class="fa"
                                      :class="{
                                        'fa-check text-warning':
                                          pedido.multimedia_notification,
                                        'fa-times text-danger':
                                          !pedido.multimedia_notification,
                                      }"
                                      aria-hidden="true"
                                    ></i>
                                  </div>
                                </div>
                                <div class="table-responsive">
                                  <table class="table table-sm">
                                    <tbody>
                                      <tr>
                                        <td>Pasajeros</td>
                                        <td>Peso</td>
                                      </tr>

                                      <tr
                                        v-for="(
                                          pedidos_pasajeros,
                                          index_pedidos_pasajeros
                                        ) in pedido.pedidos_pasajeros"
                                        :key="index_pedidos_pasajeros"
                                      >
                                        <td>
                                          {{
                                            pedidos_pasajeros.pasajero.nombres
                                          }}
                                          {{
                                            pedidos_pasajeros.pasajero.apellidos
                                          }}
                                        </td>
                                        <td>
                                          {{
                                            pedidos_pasajeros.pasajero.peso
                                          }}
                                          KGS
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
              </div>

              <div class="card-body" v-else-if="vista == 'cambiar_fecha_vuelo'">
                <div class="row">
                  <div
                    class="col-12 col-sm-12 col-md-12 col-lg-3"
                    id="kt_profile_aside"
                  >
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
                                class="text-dark-75 font-weight-nirmal m-0 pb-7"
                              >
                                Pedido:
                                {{ cambiar_fecha_vuelo.orden_wordpress }} <br />

                                Num de Reservas:
                                {{ cambiar_fecha_vuelo.numpax }} <br />

                                Nombre Contacto:
                                {{ cambiar_fecha_vuelo.nombre_contacto }} <br />
                                Tel Contacto:
                                {{ cambiar_fecha_vuelo.telefono_contacto }}
                                <br />
                                Ciudad:
                                {{ cambiar_fecha_vuelo.ciudad_contacto }})
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
                          <form
                            @submit="RegistarVuelo"
                            method="POST"
                            class="form"
                            id="GuardarServiciosSolucionLimpieza"
                          >
                            <div class="row">
                              <div class="col-md-12 pb-3">
                                <input
                                  type="date"
                                  class="form-control form-control-sm"
                                  v-model="fecha"
                                  required
                                />
                              </div>
                              <div class="col-md-12 pb-3">
                                <select
                                  class="form-control form-control-sm"
                                  v-model="zona_id"
                                  required
                                >
                                  <option value="">Zonas</option>
                                  <option
                                    :value="item.id"
                                    v-for="(item, index_zona) in Zonas"
                                    :key="index_zona"
                                  >
                                    {{ item.nombre }}
                                  </option>
                                </select>
                              </div>
                              <div class="col-md-12 pb-3">
                                <button
                                  type="submit"
                                  class="btn btn-light-warning btn-block btn-sm"
                                  :disabled="GuardandoCambios"
                                >
                                  <span v-if="GuardandoCambios">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    Guardando...
                                  </span>
                                  <span v-else>
                                    <i class="fa fa-save"></i> Crear Vuelo
                                  </span>
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
                      <table
                        class="table table-sm table-striped table-bordere table-hover"
                      >
                        <thead class="bg-primary text-white">
                          <tr>
                            <th>Fecha</th>
                            <th>Zona</th>
                            <th>Piloto</th>
                            <th>Globo</th>
                            <th>Carga Total</th>
                            <th class="font-weight-bolder">Cambiar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(items, index) in ListRecords"
                            :key="index"
                            :class="{
                              'bg-light-warning':
                                formatDay(items.fecha) == 'Sat',
                              'bg-light-warning':
                                formatDay(items.fecha) == 'Sun',
                            }"
                          >
                            <td class="text-center">
                              {{ items.fecha | formatDay }} <br />
                              {{ items.fecha | formatDate }}
                            </td>
                            <td>
                              {{ items.zona.nombre }}
                            </td>
                            <td>
                              {{
                                items.piloto != null
                                  ? items.piloto.nombres +
                                    " " +
                                    items.piloto.apellidos
                                  : ""
                              }}
                            </td>
                            <td>
                              {{
                                items.globo != null ? items.globo.nombre : ""
                              }}
                            </td>
                            <td>
                              {{ items.carga }}
                            </td>
                            <td>
                              <button
                                class="btn btn-primary btn-sm"
                                @click="ConfirmarActualizarPedido(items.id)"
                              >
                                <i class="fa fa-check"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-md-12 pb-3">
                      <div class="col-md-12 py-5 text-right">
                        <button
                          class="btn btn-light-danger btn-sm"
                          @click="(cambiar_fecha_vuelo = ''), vista == 'vuelo'"
                        >
                          Cancelar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body" v-else-if="vista == 'pedido'">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h4>Datos de Pedido</h4>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="buscardor_numero_nombre_tlf"
                        >Order - ID</label
                      >
                      <div class="input-group">
                        <input
                          v-model="buscardor_numero_nombre_tlf"
                          @blur="ValidarOrder()"
                          id="orden_wordpress"
                          type="text"
                          class="form-control"
                        />
                        <div class="input-group-append">
                          <button class="btn btn-secondary" type="button">
                            <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                      <!-- <span class="text-danger" v-if="order_ya_existe"> <i class="fa-exclamation"></i>  ID Ya existe </span> -->
                    </div>
                  </div>

                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <h3>Pedidos</h3>
                    <div class="table-responsive">
                      <table
                        class="table table-sm table-striped table-bordere table-hover"
                      >
                        <thead class="bg-primary text-white">
                          <tr>
                            <th>Order-ID</th>
                            <th>N. Pax</th>
                            <th>Contacto</th>
                            <th>Vuelo</th>
                            <th>Estatus</th>
                            <th class="font-weight-bolder">Cambiar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(items, index) in pedidos" :key="index">
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
                              {{ items.name_vuelo }}
                            </td>
                            <td>
                              {{ items.estatus }}
                            </td>
                            <td>
                              <button
                                class="btn btn-primary btn-sm"
                                @click="
                                  ConfirmarActualizarPedido(
                                    vuelo_seleccionado.id,
                                    items.id
                                  )
                                "
                              >
                                <i class="fa fa-check"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-md-12 pb-3">
                      <div class="col-md-12 py-5 text-right">
                        <button
                          class="btn btn-danger btn-sm"
                          @click="
                            borrar_reserva_vuelo(
                              cambiar_fecha_vuelo.orden_wordpress
                            )
                          "
                        >
                          Borrar reserva de este Vuelo
                        </button>
                        <button
                          class="btn btn-light-danger btn-sm"
                          @click="(cambiar_fecha_vuelo = ''), (vista = 'vuelo')"
                        >
                          Cancelar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <div class="">
              <ul class="pagination b-pagination text-center float-left">
                <li
                  class="page-item flex-fill"
                  role="button"
                  @click="VuelosNextPrev('prev')"
                >
                  <span class="page-link bg-primary text-white">‹</span>
                </li>
                <li
                  class="page-item flex-fill"
                  role="button"
                  @click="VuelosNextPrev('next')"
                >
                  <span class="page-link bg-primary text-white">›</span>
                </li>
              </ul>
            </div>
            <div class="">
              <button
                v-if="vuelo_seleccionado.estatus == 'Creado'"
                @click="vista = 'pedido'"
                type="button"
                class="btn btn-info font-weight-bold"
              >
                Pedidos
              </button>
              <button
                v-if="
                  vuelo_seleccionado.estatus == 'Creado' &&
                  vuelo_seleccionado.piloto &&
                  vuelo_seleccionado.globo
                "
                data-toggle="modal"
                :data-target="'#VueloRealizado'"
                type="button"
                class="btn btn-success font-weight-bold"
              >
                Marcar Volado
              </button>
              <button
                class="d-none"
                id="OpenVueloRealizado"
                data-toggle="modal"
                :data-target="'#VueloRealizado'"
              ></button>
              <button
                v-if="
                  vuelo_seleccionado.estatus == 'Creado' &&
                  (!vuelo_seleccionado.piloto || !vuelo_seleccionado.globo)
                "
                @click="AlertarFaltaPilotoGlobo()"
                type="button"
                class="btn btn-success font-weight-bold"
              >
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                Marcar Volado
              </button>
              <button
                v-if="vuelo_seleccionado.estatus == 'Volado'"
                class="btn btn-info p-2 symbol symbol-100 mr-5"
                :class="{
                  disabled:
                    vuelo_seleccionado.multimedias &&
                    vuelo_seleccionado.multimedias.length == 0,
                }"
                @click="IrMultimediaEvento()"
                :title="vuelo_seleccionado.estado_multimedia"
              >
                <span>
                  <i class="fa fa-picture-o p-0" aria-hidden="true"></i>
                  <i
                    class="symbol-badge"
                    :class="{
                      'bg-success':
                        vuelo_seleccionado.estado_multimedia ==
                          'No se ha registrado Multimedias' ||
                        vuelo_seleccionado.estado_multimedia ==
                          'Multimedia No Habilitado',
                      'bg-info':
                        vuelo_seleccionado.estado_multimedia ==
                        'Multimedia Descargado',
                      'bg-warning':
                        vuelo_seleccionado.estado_multimedia ==
                        'Multimedia Disponible',
                      'bg-danger':
                        vuelo_seleccionado.estado_multimedia ==
                        'Multimedia Caducado',
                    }"
                  ></i>
                </span>
                <i
                  class="fa fa-envelope"
                  aria-hidden="true"
                  v-if="vuelo_seleccionado.multimedia_notification_pedidos"
                ></i>
                Multimedia
              </button>
              <button
                @click="(cambiar_fecha_vuelo = ''), (vista = 'vuelo')"
                type="button"
                class="btn btn-light-primary font-weight-bold close2"
                data-dismiss="modal"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="VueloRealizado"
      data-backdrop="static"
      tabindex="-1"
      role="dialog"
      aria-labelledby="staticBackdrop"
      aria-hidden="true"
      ref="vuemodal"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Completar Detalles del vuelo Realizado
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <form
            @submit="ValidarCamposMarcaComoVolado"
            method="POST"
            enctype="multipart/form-data"
            class="form"
            id="GuardarServiciosSolucionLimpieza"
          >
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="lugar_despegue">Lugar Despegue </label>
                    <input
                      v-model="form.lugar_despegue"
                      id="lugar_despegue"
                      type="text"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <div class="form-group">
                    <label for="fecha_despegue">Fecha Despegue</label>
                    <input
                      v-model="form.fecha_despegue"
                      id="fecha_despegue"
                      type="date"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <div class="form-group">
                    <label for="hora_despegue">Hora Despegue</label>
                    <input
                      v-model="form.hora_despegue"
                      id="hora_despegue"
                      type="time"
                      class="form-control"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="lugar_aterrizaje">Lugar Aterrizaje </label>
                    <input
                      v-model="form.lugar_aterrizaje"
                      id="lugar_aterrizaje"
                      type="text"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <div class="form-group">
                    <label for="fecha_aterrizaje">Fecha Aterrizaje</label>
                    <input
                      v-model="form.fecha_despegue"
                      id="fecha_aterrizaje"
                      type="date"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <div class="form-group">
                    <label for="hora_aterrizaje">Hora Aterrizaje</label>
                    <input
                      v-model="form.hora_aterrizaje"
                      id="hora_aterrizaje"
                      type="time"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <b-form-checkbox
                    id="checkbox-1"
                    v-model="form.cautivo"
                    name="checkbox-1"
                    value="1"
                    unchecked-value="0"
                  >
                    Cautivo
                  </b-form-checkbox>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary font-weight-bold">
                Confirmar Vuelo Realizado
              </button>
              <button
                type="button"
                class="btn btn-light-primary font-weight-bold"
                data-dismiss="modal"
              >
                Cerrar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
    import BaseLoading from "../../components/BaseLoading";
    
    export default {
      components: {
        BaseLoading,
      },
  data() {
    return {
      buscardor_numero_nombre_tlf: "",
      pedidos: [],
      vista: "vuelo",

      filtro: {
        globo: null,
        piloto: null,
        zona: null,
        estado: null,
        inicio: null,
        fin: null,
        informacion_incompleta: 0,
      },
      GuardandoCambios: false,
      cambiar_fecha_vuelo: "",
      fecha: "",
      zona_id: "",
      vuelos: [],
      Zonas: [],
      vuelo_seleccionado: "",
      Records: [],

      path_principal: "vuelos",
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
            return value != null ? value.nombres + " " + value.apellidos : "";
          },
        },
        {
          key: "globo.nombre",
          label: "Globo",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "carga_total",
          label: "Carga Total",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "cantidad_pasajeros",
          label: "NumPax",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "estatus",
          label: "Estado",
          sortable: true,
          sortDirection: "desc",
        },
        { key: "actions_go_show_gallery", label: "Acciones" },
      ],
      records: [],
      form: {
        lugar_despegue: "",
        fecha_despegue: "",
        hora_despegue: "",
        lugar_aterrizaje: "",
        hora_aterrizaje: "",
        cautivo: 0,
      },
    };
  },
  mounted() {
    this.Buscar();
    this.BuscarZonas();
  },
  methods: {
    SetValoresAnteriores() {
      this.filtro.globo = localStorage.getItem('filtroglobos'); 
      this.filtro.piloto = localStorage.getItem('filtropiloto'); 
      this.filtro.zona = localStorage.getItem('filtrozona'); 
      this.filtro.estado = localStorage.getItem('filtroestado'); 
      this.filtro.inicio = localStorage.getItem('filtroinicio'); 
      this.filtro.fin = localStorage.getItem('filtrofin'); 
    },
    RemoverFiltros() {
      localStorage.clear();
      this.filtro.globo = null;
      this.filtro.piloto = null;
      this.filtro.zona = null;
      this.filtro.estado = null;
      this.filtro.inicio = null;
      this.filtro.fin = null;
    },

    formatDay(value) {
      return moment(value).format("ddd");
    },

    ValidarOrder() {
      var url = "/admin/buscardor_numero_nombre_tlf_pedidos";

      axios
        .post(url, {
          buscar: this.buscardor_numero_nombre_tlf,
          token: this.token,
        })
        .then((response) => {
          this.pedidos = response.data.records;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },

    IrMultimediaEvento() {
      $("#VerVuelo .close").click();
      $("#VerVuelo .close2").click();
      $("body").removeClass("modal-open");
      $(".modal-backdrop").remove();

      this.$router.push({
        path: "/vuelos/multimedia/" + this.vuelo_seleccionado.id,
      });
    },
    IrAPedido(id) {
      $("#VerVuelo .close").click();
      $("#VerVuelo .close2").click();
      $("body").removeClass("modal-open");
      $(".modal-backdrop").remove();

      this.$router.push({
        path: "/pedidos/consultar/" + id,
      });
    },

    VuelosNextPrev(accion) {
      var vuelo_seleccionado = this.vuelo_seleccionado.id;
      var index_now = _.findIndex(this.records, function (o) {
        return o.id == vuelo_seleccionado;
      });
      if (accion == "prev") {
        if (index_now > 0) {
          var prev = index_now - 1;
          this.vuelo_seleccionado = this.records[prev];
        }
      } else {
        var next = index_now + 1;
        if (this.records[next] !== undefined) {
          this.vuelo_seleccionado = this.records[next];
        }
      }
    },

    borrar_reserva_vuelo(vuelo_id, pedido = null) {
      var _this = this;

      var pedido_id = "";

      if (pedido == null) {
        pedido_id = this.cambiar_fecha_vuelo.id;
      } else {
        pedido_id = pedido;
      }

      Swal.fire({
        title: "Confirmar!",
        text: "Confirme que desea borrar este pedido de este vuelo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Confirmar!",
        cancelButtonText: "No, Cancelar!",
        reverseButtons: true,
      }).then(function (result) {
        if (result.value) {
          var url = "/admin/pedidos/" + pedido_id;

          axios
            .post(url, {
              _method: "PUT",
              vuelo_id: null,
              token: _this.token,
            })
            .then((response) => {
              if (!response.data.result) {
                Swal.fire(
                  "Ha ocurrido algún error!",
                  "Se le notificará al equipo de soporte!" +
                    response.data.mensaje_error,
                  "error"
                );
                _this.$toasted.error("Ha ocurrido algún error!");
              } else {
                _this.$toasted.success("Pedido actualizado Correctamente");
                _this.Buscar();

                $("#VerVuelo .close").click();
                $("#VerVuelo .close2").click();
                $("body").removeClass("modal-open");
                $(".modal-backdrop").remove();

                _this.cambiar_fecha_vuelo = "";
                _this.vista = "vuelo";
              }
            })
            .catch((error) => {
              console.log(error);
              this.errors = error.response;
            });
        }
      });
    },

    ConfirmarActualizarPedido(vuelo_id, pedido = null) {
      var _this = this;

      var pedido_id = "";

      if (pedido == null) {
        pedido_id = this.cambiar_fecha_vuelo.id;
      } else {
        pedido_id = pedido;
      }

      Swal.fire({
        title: "Confirmar!",
        text: "Confirme que desea actualizar el pedido para este vuelo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Confirmar!",
        cancelButtonText: "No, Cancelar!",
        reverseButtons: true,
      }).then(function (result) {
        if (result.value) {
          var url = "/admin/pedidos/" + pedido_id;

          axios
            .post(url, {
              _method: "PUT",
              vuelo_id: vuelo_id,
              tipo: "vuelo",
              token: _this.token,
            })
            .then((response) => {
              if (!response.data.result) {
                Swal.fire(
                  "Ha ocurrido algún error!",
                  "Se le notificará al equipo de soporte!" +
                    response.data.mensaje_error,
                  "error"
                );
                _this.$toasted.error("Ha ocurrido algún error!");
              } else {
                _this.$toasted.success("Pedido actualizado Correctamente");
                _this.Buscar();

                $("#VerVuelo .close").click();
                $("#VerVuelo .close2").click();
                $("body").removeClass("modal-open");
                $(".modal-backdrop").remove();

                _this.cambiar_fecha_vuelo = "";
                _this.vista = "vuelo";
              }
            })
            .catch((error) => {
              console.log(error);
              this.errors = error.response;
            });
        }
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
        reverseButtons: true,
      }).then(function (result) {
        if (result.value) {
          $("#OpenVueloRealizado").click();
        }
      });
    },
    ValidarCamposMarcaComoVolado(evt) {
      evt.preventDefault();
      var _this = this;
      if (
        this.form.lugar_despegue == "" ||
        this.form.fecha_despegue == "" ||
        this.form.lugar_aterrizaje == "" ||
        this.form.hora_despegue == "" ||
        this.form.hora_aterrizaje == ""
      ) {
        Swal.fire({
          title: "Información Incompleta!",
          text: "Desea autocompletar la información que falta?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, autocompletar y continuar!",
          cancelButtonText: "No, Continuar de todas formas!",
          reverseButtons: true,
        }).then(function (result) {
          if (result.value) {
            if (_this.form.lugar_despegue == "") {
              _this.form.lugar_despegue = _this.vuelo_seleccionado.zona.nombre;
            }
            if (_this.form.lugar_aterrizaje == "") {
              _this.form.lugar_aterrizaje =
                _this.vuelo_seleccionado.zona.nombre;
            }
            if (_this.form.fecha_despegue == "") {
              _this.form.fecha_despegue = _this.vuelo_seleccionado.fecha;
            }
            if (_this.form.hora_despegue == "") {
              _this.form.hora_despegue = _this.vuelo_seleccionado.hora;
            }
            if (_this.form.hora_aterrizaje == "") {
              _this.form.hora_aterrizaje = _this.vuelo_seleccionado.hora;
            }
            _this.MarcaComoVolado(evt);
          } else {
            _this.MarcaComoVolado(evt);
          }
        });
      } else {
        _this.MarcaComoVolado(evt);
      }
    },
    MarcaComoVolado(evt) {
      evt.preventDefault();

      var url = "/admin/vuelo_volado";

      axios
        .post(url, {
          id: this.vuelo_seleccionado.id,
          form: this.form,
          token: this.token,
        })
        .then((response) => {
          if (!response.data.result) {
            Swal.fire(
              "Ha ocurrido algún error!",
              "Se le notificará al equipo de soporte!" +
                response.data.mensaje_error,
              "error"
            );
            this.$toasted.error("Ha ocurrido algún error!");
          } else {
            this.$toasted.success("Vuelo marcado como volado Correctamente");
            this.Buscar();

            $("#VueloRealizado .close").click();
            $("#VueloRealizado .close2").click();
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();

            $("#VerVuelo .close").click();
            $("#VerVuelo .close2").click();
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();
          }
        })
        .catch((error) => {
          console.log(error);
          this.errors = error.response;
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
        reverseButtons: true,
      }).then(function (result) {
        if (result.value) {
          var url = "/admin/vuelo_volado";

          axios
            .post(url, {
              id: _this.vuelo_seleccionado.id,
              token: _this.token,
            })
            .then((response) => {
              if (!response.data.result) {
                Swal.fire(
                  "Ha ocurrido algún error!",
                  "Se le notificará al equipo de soporte!" +
                    response.data.mensaje_error,
                  "error"
                );
                _this.$toasted.error("Ha ocurrido algún error!");
              } else {
                _this.$toasted.success(
                  "Vuelo marcado como volado Correctamente"
                );
                _this.Buscar();

                $("#VerVuelo .close").click();
                $("#VerVuelo .close2").click();
                $("body").removeClass("modal-open");
                $(".modal-backdrop").remove();
              }
            })
            .catch((error) => {
              console.log(error);
              this.errors = error.response;
            });
        }
      });
    },

    RegistarVuelo(evt) {
      evt.preventDefault();

      this.GuardandoCambios = !this.GuardandoCambios;
      var porc = 0;

      let formData = new FormData();

      formData.append("zona_id", this.zona_id);
      formData.append("fecha", this.fecha);
      formData.append("pedido_id", this.cambiar_fecha_vuelo.id);

      var url = "/admin/vuelos";

      axios
        .post(url, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.GuardandoCambios = !this.GuardandoCambios;
          if (!response.data.result) {
            this.$toastr.error(
              "Ocurrio un error al registrar registrar y cambiar fecha de reserva",
              "Error en Proceso..."
            );
          } else {
            this.$toasted.success(
              "Vuelo Registrado y Fecha Actualizada Correctamente"
            );
            this.Buscar();

            $("#VerVuelo .close").click();
            $("#VerVuelo .close2").click();
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();

            this.cambiar_fecha_vuelo = "";
          }
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },

    BuscarZonas() {
      var url = "/admin/listado_zonas";
      axios
        .get(url)
        .then((response) => {
          this.Zonas = response.data.records;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },

    ButtonGo(data) {
      this.$router.push({
        path: "/" + this.path_principal + "/consultar/" + data.data.id,
      });
    },

    ButtonMultimedia(data) {
      this.$router.push({
        path: "/" + this.path_principal + "/multimedia/" + data.data.id,
      });
    },

    ButtonDelete(data) {
      this.Borrar(data);
    },

    ButtonEdit(data) {
      this.vuelo_seleccionado = data.data;
    },

    Buscar() {
      var url = "/admin/" + this.path_principal;
      axios
        .get(url)
        .then((response) => {
          this.records = response.data.records;
          
          this.SetValoresAnteriores();

        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },

    Borrar(data) {
      var _this = this;
      var registro = data.data;

      Swal.fire({
        title: "Confirmar!",
        text: "Confirme que desea Eliminar el Vuelo N°: " + registro.id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Confirmar!",
        cancelButtonText: "No, Cancelar!",
        reverseButtons: true,
      }).then(function (result) {
        if (result.value) {
          var url = "/admin/vuelos/" + registro.id;

          axios
            .post(url, {
              _method: "delete",
              token: _this.token,
            })
            .then((response) => {
              if (!response.data.result) {
                Swal.fire(
                  "Ha ocurrido algún error!",
                  "Se le notificará al equipo de soporte!" +
                    response.data.mensaje_error,
                  "error"
                );
                _this.$toasted.error("Ha ocurrido algún error!");
              } else {
                _this.$toasted.success(
                  _this.path_principal + " Eliminada Correctamente"
                );
              }

              _this.Buscar();
            })
            .catch((error) => {
              console.log(error);
              this.errors = error.response;
            });
        }
      });
    },
  },

  computed: {
    ListRecords: function () {
      var data = this.records;
      return data.filter(
        (items) => items.fecha >= moment().format("YYYY-MM-DD")
      );
    },

    recordsFiltros: function () {
      var data = this.records;

      /******* GLOBOS  ************/
      var globo = this.filtro.globo;

      if (globo != null) {        
        localStorage.setItem('filtroglobos', this.filtro.globo);
        data = _.filter(data, function (items) {
          if (items.globo) {
            return items.globo_id == globo;
          }

          if (globo == "sin_globos") {
            return items.globo_id == null;
          }
        });
      }
      /******* FIN GLOBOS  ************/

      /******* PILOTOS  ************/
      var piloto = this.filtro.piloto;

      if (piloto != null) {        
        localStorage.setItem('filtropiloto', this.filtro.piloto);
        data = _.filter(data, function (items) {
          if (items.piloto) {
            return items.piloto_id == piloto;
          }

          if (piloto == "sin_pilotos") {
            return items.piloto_id == null;
          }
        });
      }
      /******* FIN PILOTOS  ************/

      /******* PILOTOS  ************/
      var zona = this.filtro.zona;

      if (zona != null) {
        localStorage.setItem('filtrozona', this.filtro.zona);
        data = _.filter(data, function (items) {
          if (items.zona) {
            return items.zona_id == zona;
          }

          if (zona == "sin_zonas") {
            return items.zona_id == null;
          }
        });
      }
      /******* FIN PILOTOS  ************/

      /******* ESTADOS  ************/
      var estado = this.filtro.estado;

      if (estado != null) {
        localStorage.setItem('filtroestado', this.filtro.estado);
        data = _.filter(data, function (items) {
          if (items.estatus) {
            return items.estatus == estado;
          }
        });
      }
      /******* FIN ESTADOS  ************/

      /******* FECHAS  ************/
      var inicio = this.filtro.inicio;
      var fin = this.filtro.fin;

      if (inicio != null && inicio != "") {
        localStorage.setItem('filtroinicio', this.filtro.inicio);
        data = _.filter(data, function (items) {
          return items.fecha >= inicio;
        });
      }

      if (fin != null && fin != "") {
        localStorage.setItem('filtrofin', this.filtro.fin);
        data = _.filter(data, function (items) {
          return items.fecha <= fin;
        });
      }
      /******* FIN FECHAS  ************/

      /******* FALTA INFORMACION  ************/
      var informacion_incompleta = this.filtro.informacion_incompleta;

      if (informacion_incompleta == 1) {
        data = _.filter(data, function (items) {
          if (items.estatus == "Volado") {
            if (
              items.globo_id == null ||
              items.piloto_id == null ||
              items.lugar_despegue == null ||
              items.fecha_despegue == null ||
              items.lugar_aterrizaje == null ||
              items.hora_despegue == null ||
              items.hora_aterrizaje == null
            ) {
              return items;
            }
          }
        });
      }
      /******* FIN FALTA INFORMACION  ************/

      return data;
    },

    filtros: function () {
      var data = this.records;

      /******* GLOBOS  ************/
      var group_globos = _.uniqBy(data, "globo_id").filter(
        (items) => items.globo_id != null
      );

      group_globos = _(group_globos)
        .map(function (items) {
          return { id: items.globo_id, name: items.globo.nombre };
        })
        .value();

      group_globos.push({
        id: null,
        name: "Todos",
      });

      group_globos.push({
        id: "sin_globos",
        name: "Sin Globos",
      });
      /******* FIN GLOBOS  ************/

      /******* PILOTOS  ************/
      var group_pilotos = _.uniqBy(data, "piloto_id").filter(
        (items) => items.piloto_id != null
      );

      group_pilotos = _(group_pilotos)
        .map(function (items) {
          return {
            id: items.piloto_id,
            name: items.piloto.nombres + " " + items.piloto.apellidos,
          };
        })
        .value();

      group_pilotos.push({
        id: null,
        name: "Todos",
      });

      group_pilotos.push({
        id: "sin_pilotos",
        name: "Sin Pilotos",
      });
      /******* FIN PILOTOS  ************/

      /******* ZONAS  ************/
      var group_zonas = _.uniqBy(data, "zona_id").filter(
        (items) => items.zona_id != null
      );

      group_zonas = _(group_zonas)
        .map(function (items) {
          return { id: items.zona_id, name: items.zona.nombre };
        })
        .value();

      group_zonas.push({
        id: null,
        name: "Todos",
      });

      group_zonas.push({
        id: "sin_zonas",
        name: "Sin Zonas",
      });
      /******* FIN ZONAS  ************/

      /******* ESTADOS  ************/
      var group_estados = _.uniqBy(data, "estatus").filter(
        (items) => items.estatus != null
      );

      group_estados = _(group_estados)
        .map(function (items) {
          return { id: items.estatus, name: items.estatus };
        })
        .value();

      group_estados.push({
        id: null,
        name: "Todos",
      });

      /******* FIN ESTADOS  ************/

      return {
        globos: group_globos,
        pilotos: group_pilotos,
        zonas: group_zonas,
        estados: group_estados,
      };
    },
    
  },
  
  watch: { 
    'filtros.globos': function(newValues, oldValues){
      this.$nextTick(function(){ $('#selectpicker_globos').selectpicker('refresh'); });
    },
    'filtros.globos': function(newValues, oldValues){
      this.$nextTick(function(){ $('#selectpicker_globos').selectpicker('refresh'); });
    },
    'filtros.zonas': function(newValues, oldValues){
      this.$nextTick(function(){ $('#selectpicker_zonas').selectpicker('refresh'); });
    },
    'filtros.estados': function(newValues, oldValues){
      this.$nextTick(function(){ $('#selectpicker_estados').selectpicker('refresh'); });
    },
  },
};
</script>
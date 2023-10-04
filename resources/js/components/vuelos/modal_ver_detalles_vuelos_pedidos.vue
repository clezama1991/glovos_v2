<template>
    <div>
        
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
                <h3 class="card-title">Detalles del Vuelos</h3>
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
                                  </div>
                                  <div class="d-flex flex-column flex-grow-1" v-else>
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
                      
                         <div
                        class="card card-custom  shadow-lg"
                      >
                        <!--begin::Body-->
                        <div class="card-body">

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
                              <div class="mb-10">
                                
                                <div class="mr-2 w-100 d-flex justify-content-end">                        
                                  <a :href="'/pedidos_enviar_formulario/'+pedido.id" 
                                    v-if="pedido.estatus!='Vuelo Realizado'" target="_blank" class=" 
                                    label-inline
                                     float-right
                                     mr-2
                                    label label-warning">                                
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
                                    >Num de Pasajeros: {{ pedido.numpax }}</a
                                  >

                                  <span class="text-dark-75 ml-2 small"
                                    >({{ pedido.nombre_contacto }} - {{ pedido.telefono_contacto }} -  {{ pedido.ciudad_contacto }})</span
                                  >                              
                                </div>
                                <div class="mr-2">                                
                                  Estado Pedido : {{ pedido.estatus }}
                                </div>
                              </div>

                              <table class="table table-sm">
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
                                    <input type="checkbox" class="" name="" id="" value="checkedValue" checked>
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
                  <div class="col-12 col-sm-12 col-md-12 col-lg-4" id="kt_profile_aside">
                    <!--begin::Nav Panel Widget 2-->
                    <h3>Cambiar fecha de Reserva</h3>
                    <div
                      class="card card-custom gutter-b"
                      v-if="cambiar_fecha_vuelo"
                    >
                      <!--begin::Body-->
                      <div class="card-body">
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

                                Contacto: ({{ cambiar_fecha_vuelo.nombre_contacto }} - {{ cambiar_fecha_vuelo.telefono_contacto }} -  {{ cambiar_fecha_vuelo.ciudad_contacto }})

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
                      <div class="card-body">
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

                  <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                    
                    <h3>Proximos Vuelos Disponibles</h3>
                    <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordere table-hover">
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
                          v-for="(
                            items, index
                          ) in ListRecords"
                          :key="index"
                        >
                          <td>
                            {{ items.fecha }}
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
                  
                    <div class="col-md-12 mb-3">
                      <h4>Datos de Pedido</h4>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="buscardor_numero_nombre_tlf">Order - ID</label>
                        <div class="input-group">
                          <input v-model="buscardor_numero_nombre_tlf" @blur="ValidarOrder()" id="orden_wordpress" type="text" class="form-control">
                          <div class="input-group-append">
                            <button class="btn btn-secondary" type="button"> <i class="fa fa-search"></i> </button>
                          </div>
                        </div>
                        <!-- <span class="text-danger" v-if="order_ya_existe"> <i class="fa-exclamation"></i>  ID Ya existe </span> -->
                      </div> 
                    </div>  

                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <h3>Pedidos</h3>
                    <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordere table-hover">
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
                        <tr
                          v-for="(
                            items, index
                          ) in pedidos"
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
                            {{ items.name_vuelo }}
                          </td>
                          <td>
                            {{ items.estatus }}
                          </td>
                          <td>
                            <button class="btn btn-primary btn-sm" @click="ConfirmarActualizarPedido(vuelo_seleccionado.id,items.id)"><i class="fa fa-check"></i></button>
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
            </div>
    </div>
</template>


<script>

export default {
    props : ['vuelo_seleccionado'],
    data() {
     return {
        buscardor_numero_nombre_tlf: '',
        pedidos: [],
        vista: 'vuelo',
        GuardandoCambios: false,
        cambiar_fecha_vuelo: '',
        fecha: '',
        zona_id: '',
        vuelos: [],
        Zonas: [],
        Records: [],
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
    };
  },
  mounted() { 
  },
  methods: { 
    IrAPedido(id) {
      
      $("#VerVuelo .close").click(); 
      $("#VerVuelo .close2").click(); 
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      
      this.$router.push({
          path: '/pedidos/consultar/'+id
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
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Pedido actualizado Correctamente');
                  
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
    
        RegistarVuelo(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
                
              let formData = new FormData();
    
              formData.append('zona_id', this.zona_id); 
              formData.append('fecha', this.fecha); 
              formData.append('pedido_id', this.cambiar_fecha_vuelo.id); 
  
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
                  this.$toasted.success('Vuelo Registrado y Fecha Actualizada Correctamente');                  
                  
                  $("#VerVuelo .close").click(); 
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

  },
  computed: {
    ListRecords: function () {
      var data = this.Records;
      return data.filter(
        (items) => items.fecha >= moment().format("YYYY-MM-DD")
      );
    },

  },
};
</script>
 
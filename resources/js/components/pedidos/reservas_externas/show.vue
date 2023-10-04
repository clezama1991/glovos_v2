<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-mail-bulk text-dark"></i>

              Consultar Reservas Externas
            </span>
          </h3>
        </div>

        <form
          @submit="ActualizarForm"
          method="POST"
          enctype="multipart/form-data"
          class="form"
          id="GuardarServiciosSolucionLimpieza"
        >
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="orden_wordpress">Nro de Pedido</label>
                  <input
                    v-model="form.orden_wordpress"
                    id="orden_wordpress"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="privado">Tipo de vuelo</label>
                  <select class="form-control" v-model="form.privado">
                    <option value="">Selecciona</option>
                    <option value="0">Vuelo estándar</option>
                    <option value="1">Vuelo privado</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="zona">Zona</label>
                  <select class="form-control selectpicker" id="selectpicker_zonas" required data-live-search="true" v-model="form.zona_id">
                    <option value="">Seleccione</option>
                    <option :value="item.id" v-for="(item, index) in Zonas" :key="index">{{item.nombre}}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="numpax">Nro de pasajeros</label>
                  <select class="form-control" v-model="form.numpax">
                    <option value="">Seleccione</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">11 o más - Consultar</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="fecha_reserva">Fecha de reserva</label>
                  <input
                    v-model="form.fecha_reserva"
                    id="fecha_reserva"
                    type="date"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="cupon">Cupón de vuelo</label>
                  <input
                    v-model="form.cupon"
                    id="cupon"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="nombre_contacto">Nombre Completo</label>
                  <input
                    v-model="form.nombre_contacto"
                    id="nombre_contacto"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="email_contacto">Email</label>
                  <input
                    v-model="form.email_contacto"
                    id="email_contacto"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="telefono_contacto">Teléfono</label>
                  <input
                    v-model="form.telefono_contacto"
                    id="telefono_contacto"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="notas">Observaciones</label>
                  <editor
                    :api-key="api_key"
                    cloud-channel="5-dev"
                    :init="option"
                    v-model="form.notas"
                  />
                </div>
              </div>
              <div class="col-md-4 mb-3"  v-if="form.cerrado">
                <div class="form-group">
                  <label for="telefono_contacto">Estatus</label>
                  <input
                    v-model="form.estatus"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <router-link
              to="/pedidos-reservas-externas"
              class="btn btn-secondary mr-2"
            >
              <i class="fa fa-undo"></i> Volver
            </router-link>

            <button
              type="submit"
              class="btn btn-warning mr-3 float-right"
              :disabled="GuardandoCambios"
            >
              <span v-if="GuardandoCambios">
                <i class="fas fa-spinner fa-spin"></i> Actualizando...
              </span>
              <span v-else> <i class="fa fa-save"></i> Actualizar </span>
            </button>
          </div>
        </form>
      </div>

      <div class="card card-custom mb-5" v-if="!form.cerrado">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-mail-bulk text-dark"></i>

              Gestionar Reserva
            </span>
          </h3>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="privado">Estatus</label>
                <select class="form-control" v-model="form.estatus">
                  <option value="">Selecciona</option>
                  <option value="pendiente">Pendiente</option>
                  <option value="aceptada">Aceptar</option>
                  <option value="cambio fecha">Cambiar a nuevas fechas</option>
                  <option value="aceptada_por_cliente" v-if="form.aceptada_por_cliente!=null" :selected="form.aceptada_por_cliente!=null">Fecha propuesta aceptada por el cliente</option>
                  <option value="cancelada">Cancelada</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" v-if="form.estatus == 'aceptada' || form.estatus == 'aceptada_por_cliente'">
            <div class="col-md-12">
              <h3 class="font-weight-bolder">Aceptar Reserva</h3>
            </div>
              <div class="col-md-8 offset-2 pt-1 text-center"  v-if="form.aceptada_por_cliente!=null">
                <div class="alert alert-custom alert-danger text-left" role="alert">
                    <div class="alert-icon">
                      <i class="flaticon-questions-circular-button"></i>
                    </div>
                    <div class="alert-text h4"> El usuario a aceptado volar el dia {{form.aceptada_por_cliente.fecha}} para la zona {{(form.aceptada_por_cliente.zonas)?form.aceptada_por_cliente.zonas.nombre:null}} propuesta!</div>
                  </div>  
              </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="h4">Nuevo vuelo</h4>
                </div>
                <div class="col-md-3 pb-3">
                  <input
                    type="date"
                    class="form-control form-control-sm disabled"
                    v-model="form.fecha_reserva"
                    required
                    disabled
                  />
                </div>
                <div class="col-md-3 pb-3">
                  <select
                    class="form-control form-control-sm disabled"
                    v-model="form.zona_id"
                    required
                    disabled
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
                <div class="col-md-3 pb-3">
                  <button
                    type="submit"
                    class="btn btn-light-warning btn-block btn-sm"
                    @click="ConfirmarActualizarPedido()"
                  >
                    Crear Vuelo
                  </button>
                </div>
              </div>
              <table
                class="table table-sm table-striped table-bordered table-hover"
              >
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
                    v-for="(items, index) in ListRecords"
                    :key="index"
                    :class="{
                      'bg-light-warning': formatDay(items.fecha) == 'Sat',
                      'bg-light-warning': formatDay(items.fecha) == 'Sun',
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
                          ? items.piloto.nombres + " " + items.piloto.apellidos
                          : ""
                      }}
                    </td>
                    <td>
                      {{ items.globo != null ? items.globo.nombre : "" }}
                    </td>
                    <td>
                      {{ items.cantidad_pasajeros }}
                    </td>
                    <td>
                      {{ items.carga }}
                    </td>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input
                            type="radio"
                            class="form-check-input"
                            name="vuelo"
                            id=""
                            :checked="form.id_vuelo == items.id"
                            @change="ConfirmarActualizarPedido(items.id)"
                          />
                        </label>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row"  v-if="form.estatus == 'cancelada'">
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="notas">Observaciones</label>
                  <editor
                    :api-key="api_key"
                    cloud-channel="7-dev"
                    :init="option"
                    v-model="observaciones"
                  />
                </div>
              </div>
              
              <div class="col-md-12 mb-3">
                <button 
                  @click="ConfirmarActualizarPedido()"
                  class="btn btn-warning mr-3 float-right">
                  Actualizar
                </button>
              </div>

          </div>
          <div class="row"  v-if="form.estatus == 'cambio fecha'">
            <template>
              <div class="col-md-6 pb-3">
                <div class="row">
                  <div class="col-6"> 
                <div class="form-group">
                  <label for="">F. Inicio</label>
                  <input type="date" class="form-control" v-model="fecha_inicio_disp" id="" aria-describedby="helpId" placeholder="">
                </div>
                  </div>
                  <div class="col-6">
                    
                <div class="form-group">
                  <label for="">F. Fin</label>
                  <input type="date" class="form-control" v-model="fecha_fin_disp" id="" aria-describedby="helpId" placeholder="">
                </div>
                  </div>
                </div> 
              </div>
              <div class="col-md-6 pb-3">
                <label for="">Zona</label>                    
                <select class="form-control" title="Seleccione" id="selectpicker_zona_lista_espera" data-live-search="true" v-model="zona_lista_espera">
                  <option value="" selected disabled>Seleccione</option>
                  <option v-for="(item, index) in Zonas" :key="index" :value="item.id">{{item.nombre}} </option>
                </select>   
              </div> 

              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="notas">Observaciones</label>
                  <editor
                    :api-key="api_key"
                    cloud-channel="7-dev"
                    :init="option"
                    v-model="observaciones"
                  />
                </div>
              </div>
              
              <div class="col-md-12 mb-3">
                <button 
                  @click="ConfirmarActualizarPedido()"
                  class="btn btn-warning mr-3 float-right">
                  Actualizar
                </button>
              </div>
            </template>
          </div>
        </div>
      </div>

      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-mail-bulk text-dark"></i>

              historial de Movimientos
            </span>
          </h3>
        </div>

        <div class="card-body">
          <table class="table table-sm table-bordered">
            <thead class="bg-light-dark">
              <tr>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Estatus</th>
                <th>Observación</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in form.movimientos" :key="index">
                <td>
                  {{ item.user.name }}
                </td>
                <td>
                  {{ item.estatus }}
                </td>
                <td>
                  {{ item.created_at | formatDate }}
                </td>
                <td>
                  <span v-html="item.observacion"></span>  
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Editor from "@tinymce/tinymce-vue";
export default {
  components: {
    editor: Editor,
  },
  props: ["id"],
  data() {
    return {
      api_key: "4uqg5bfl6an0lmdfdghkap4yfejy8ovqglkfaahssobrd8mv",
      option: {
        height: 250,
        menubar: false,
        plugins: [
          "advlist autolink lists link image charmap print preview anchor",
          "searchreplace visualblocks code fullscreen",
          "insertdatetime media table paste code help wordcount",
        ],
        toolbar:
          "undo redo | formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat | help",
      },
      GuardandoCambios: false,
      form: {
        orden_wordpress: "",
        nombre_contacto: "",
        email_contacto: "",
        telefono_contacto: "",
        privado: "",
        numpax: "",
        fecha_reserva: "",
        zona: "",
        url_cupon: "",
        notas: "",
        estatus: "",
        pedido_id: "",
        cerrado: false,
      },
      Zonas: [],
      vuelos: [],
      fecha: "",
      zona_id: "",
      observaciones: "",

      zona_lista_espera: "",
      fecha_inicio_disp: "",
      fecha_fin_disp: "",
    };
  },
  mounted() {
    this.Buscar();
    this.BuscarZonas();
    this.BuscarVuelos();
  },
  methods: {
    reset() {},
    Buscar() {
      var url = "/admin/pedidos_reservas/" + this.$route.params.id;
      axios
        .get(url)
        .then((response) => {
          this.form = response.data.record;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },

    ActualizarForm(evt) {
      evt.preventDefault();

      this.GuardandoCambios = !this.GuardandoCambios;

      let formData = new FormData();

      formData.append("titulo", this.form.titulo);
      formData.append("feedback", this.form.feedback);
      formData.append("status", this.form.status);
      formData.append("_method", "put");

      var url = "/admin/pedidos_reservas/" + this.$route.params.id;

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
              "Ocurrio un error al actualizar Registro",
              "Error en Proceso..."
            );
          } else {
            this.$toasted.success("Registro Actualizado Correctamente");
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
    BuscarVuelos() {
      var vuelos = [];
      var url = "/admin/vuelos";
      axios
        .get(url)
        .then((response) => {
          this.vuelos = response.data.records;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
    formatDay(value) {
      return moment(value).format("ddd");
    },
    reset() {      
      this.fecha = '';
      this.tipo = '';
      this.observaciones = '';
    },
    ConfirmarActualizarPedido(vuelo_id = null) {
      var _this = this;

      Swal.fire({
        title: "Confirmar!",
        text: "Confirme que desea actualizar esta reverva!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Confirmar!",
        cancelButtonText: "No, Cancelar!",
        reverseButtons: true,
      }).then(function (result) {
        if (result.value) {
          var url = "/admin/pedidos_reservas/" + _this.form.id;   
          axios
            .post(url, {
              _method: "PUT",
              vuelo_id: vuelo_id,
              zona_id: _this.form.zona_id,
              fecha: _this.form.fecha_reserva,
              tipo: _this.form.estatus,
              observaciones : _this.observaciones,
              token: _this.token,
              zona_lista_espera: _this.zona_lista_espera,
              fecha_inicio_disp: _this.fecha_inicio_disp,
              fecha_fin_disp: _this.fecha_fin_disp,
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
                _this.BuscarVuelos();
                _this.reset();
              }
            })
            .catch((error) => {
              console.log(error);
              this.errors = error.response;
            });
        } else {
          _this.Buscar();
        }
      });
    },
  },

  computed: {
    ListRecords: function () {
      var data = this.vuelos;
      var fecha = this.form.fecha_reserva;
      var zona_id = this.form.zona_id;
      return data.filter(
        (items) => ((items.fecha == fecha) && (items.zona_id == zona_id))
      );
    },
  },
  
  watch: { 
    
    Zonas: function(newValues, oldValues){
      this.$nextTick(function(){ $('#selectpicker_zonas').selectpicker('refresh'); });
    },
    'form.aceptada_por_cliente': { 
        immediate: true,
        handler(val, oldVal) {
          if(this.form.aceptada_por_cliente!=null && !this.form.cerrado){ 
            this.form.fecha_reserva = this.form.aceptada_por_cliente.fecha;
            this.form.zona_id = this.form.aceptada_por_cliente.zona;
            this.form.estatus = 'aceptada_por_cliente';
          }
        }
    }
  }
};
</script>
<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-plane-departure text-dark"></i>
              Consultar Información del Vuelo Cancelado
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
            <div class="row pb-10">
              <div class="col-md-12 mb-3">
                <h3 class="font-weight-bolder">Información de la Zona</h3>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="nombres">Nombre</label>
                  <input
                    v-model="zona.nombre"
                    id="nombres"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="url_despegue_1">Despegue 1</label>
                  <input
                    v-model="zona.url_despegue_1"
                    id="url_despegue_1"
                    type="text"
                    class="form-control"
                    disabled
                  />
                  <input
                    v-model="zona.despegue_whatsapp"
                    type="radio"
                    name="despegue_whatsapp"
                    id="despegue_whatsapp_1"
                    disabled
                    value="1"
                  />
                  <label for="despegue_whatsapp_1"
                    >Predeterminado para Whatsapp</label
                  >
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="url_despegue_2">Despegue 2</label>
                  <input
                    v-model="zona.url_despegue_2"
                    id="url_despegue_2"
                    type="text"
                    class="form-control"
                    disabled
                  />
                  <input
                    v-model="zona.despegue_whatsapp"
                    type="radio"
                    name="despegue_whatsapp"
                    id="despegue_whatsapp_2"
                    disabled
                    value="2"
                  />
                  <label for="despegue_whatsapp_2"
                    >Predeterminado para Whatsapp</label
                  >
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="aerop_cercano">Aeropuerto Cercano</label>
                  <input
                    v-model="zona.aerop_cercano"
                    id="aerop_cercano"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="frecuencia">Frecuencia</label>
                  <input
                    v-model="zona.frecuencia"
                    id="frecuencia"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="nota">Notas</label>
                  <textarea
                    v-model="zona.notas"
                    id="nota"
                    type="text"
                    class="form-control"
                    disabled
                  >
                  </textarea>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="nota">Mensaje Personalizado</label>
                  <textarea
                    v-model="zona.mensaje_personalizado"
                    id="nota"
                    type="text"
                    class="form-control"
                    disabled
                  >
                  </textarea>
                </div>
              </div>
            </div>

            <div class="row py-10">
              <div class="col-md-12 mb-3">
                <h3 class="font-weight-bolder">Información del Globo</h3>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="nombres">Nombre</label>
                  <input
                    v-model="globo.nombre"
                    id="nombres"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="fabricante">Fabricante</label>
                  <input
                    v-model="globo.fabricante"
                    id="fabricante"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="modelo">Modelo</label>
                  <input
                    v-model="globo.modelo"
                    id="modelo"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="matricula">Matricula</label>
                  <input
                    v-model="globo.matricula"
                    id="matricula"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>

              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="peso_globo">Peso Globo KGS</label>
                  <input
                    v-model="globo.peso_globo"
                    id="peso_globo"
                    type="text"
                    v-numero
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="peso_cesta">Peso Cesta KGS</label>
                  <input
                    v-model="globo.peso_cesta"
                    id="peso_cesta"
                    type="text"
                    v-numero
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="peso_botellas">Peso Botellas KGS</label>
                  <input
                    v-model="globo.peso_botellas"
                    id="peso_botellas"
                    type="text"
                    v-numero
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="mtom">MTOM KGS</label>
                  <input
                    v-model="globo.mtom"
                    v-numero
                    id="mtom"
                    type="tel"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="min_mtom">Min. MTOM KGS</label>
                  <input
                    v-model="globo.min_mtom"
                    id="min_mtom"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-9 mb-3">
                <div class="form-group">
                  <label for="nota">Notas</label>
                  <textarea
                    v-model="globo.notas"
                    id="nota"
                    type="text"
                    class="form-control"
                    disabled
                  >
                  </textarea>
                </div>
              </div>
            </div>

            <div class="row py-10">
              <div class="col-md-12 mb-3">
                <h3 class="font-weight-bolder">Información del Piloto</h3>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="nombres">Nombres</label>
                  <input
                    v-model="piloto.nombres"
                    id="nombres"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="apellidos">Apellidos</label>
                  <input
                    v-model="piloto.apellidos"
                    id="apellidos"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="cedula">Identificación</label>
                  <input
                    v-model="piloto.dni"
                    id="cedula"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input
                    v-model="piloto.telefono"
                    id="telefono"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    v-model="piloto.email"
                    id="email"
                    type="text"
                    class="form-control"
                    disabled
                  />
                  <span class="form-text text-muted" v-if="!isEmailValid"
                    >Debe ingresar un email valido</span
                  >
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="peso">Peso KGS</label>
                  <input
                    v-model="piloto.peso"
                    v-numero
                    id="peso"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="direccion">Dirección</label>
                  <input
                    v-model="piloto.direccion"
                    id="direccion"
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
            </div>

            <div class="row py-10">
              <div class="col-md-12 mb-3">
                <h3 class="font-weight-bolder">Información del Vuelo</h3>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2 mb-3">
                <div class="form-group">
                  <label for="fecha">Fecha</label>
                  <input
                    v-model="vuelo.fecha"
                    id="fecha"
                    type="date"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-2 mb-3">
                <div class="form-group">
                  <label for="hora">Hora</label>
                  <input
                    v-model="vuelo.hora"
                    id="hora"
                    type="time"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-2 mb-3">
                <div class="form-group">
                  <label for="temperatura">Temperatura</label>
                  <input
                    v-model="vuelo.temperatura"
                    id="temperatura"
                    v-numero
                    type="text"
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-2 mb-3">
                <div class="form-group">
                  <label for="gas">Kg de Gas</label>
                  <input
                    v-model="vuelo.gas"
                    id="gas"
                    type="text"
                    v-numero
                    class="form-control"
                    disabled
                  />
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="nota">Notas</label>
                  <textarea
                    v-model="vuelo.notas"
                    id="nota"
                    type="text"
                    class="form-control"
                    disabled
                  >
                  </textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card card-custom gutter-b">
                  <div class="card-header bg-primary" v-b-toggle.collapse-1>
                    <div class="card-title">
                      <h3 class="card-label">Detalles del vuelo</h3>
                    </div>
                    <div class="card-toolbar">
                      <a
                        class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle"
                      >
                        <i class="ki ki-menu"></i>
                      </a>
                    </div>
                  </div>

                  <div class="card-body">
                    <b-collapse visible id="collapse-1">
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="lugar_despegue">Lugar Despegue </label>
                            <input
                              v-model="vuelo.lugar_despegue"
                              id="lugar_despegue"
                              type="text"
                              class="form-control"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="fecha_despegue">Fecha Despegue</label>
                            <input
                              v-model="vuelo.fecha_despegue"
                              id="fecha_despegue"
                              type="date"
                              class="form-control"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="hora_despegue">Hora Despegue</label>
                            <input
                              v-model="vuelo.hora_despegue"
                              id="hora_despegue"
                              type="time"
                              class="form-control"
                              disabled
                            />
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label for="lugar_aterrizaje"
                              >Lugar Aterrizaje
                            </label>
                            <input
                              v-model="vuelo.lugar_aterrizaje"
                              id="lugar_aterrizaje"
                              type="text"
                              class="form-control"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="fecha_aterrizaje"
                              >Fecha Aterrizaje</label
                            >
                            <input
                              v-model="vuelo.fecha_despegue"
                              id="fecha_aterrizaje"
                              type="date"
                              class="form-control"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="hora_aterrizaje">Hora Aterrizaje</label>
                            <input
                              v-model="vuelo.hora_aterrizaje"
                              id="hora_aterrizaje"
                              type="time"
                              class="form-control"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <b-form-checkbox
                            id="checkbox-1"
                            v-model="vuelo.cautivo"
                            name="checkbox-1"
                            value="1"
                            unchecked-value="0"
                            disabled
                          >
                            Cautivo
                          </b-form-checkbox>
                        </div>
                      </div>
                    </b-collapse>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card card-custom gutter-b">
                  <div class="card-header bg-primary" v-b-toggle.collapse-3>
                    <div class="card-title">
                      <h3 class="card-label">Pedidos</h3>
                    </div>
                    <div class="card-toolbar">
                      <a
                        class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle"
                      >
                        <i class="ki ki-menu"></i>
                      </a>
                    </div>
                  </div>

                  <div class="card-body">
                    <b-collapse visible id="collapse-3">
                      <table class="table table-sm table-bordered">
                        <thead class="bg-light-dark">
                          <tr>
                            <th>Order-ID</th>
                            <th>N. Pax</th>
                            <th>Contacto</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(pedidos, index) in vuelo.pedidos" :key="index">
                            <td>{{pedidos.orden_wordpress}}</td>
                            <td>{{pedidos.numpax}}</td>
                            <td>{{pedidos.nombre_contacto}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </b-collapse>
                  </div>
                </div>
              </div>
            </div>

             
          </div>

          <div class="card-footer">
            <router-link
              to="/informes/vuelos_cancelados"
              class="btn btn-secondary mr-2"
            >
              <i class="fa fa-undo"></i> Volver
            </router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["id"],
  data() {
    return {
      GuardandoCambios: false,
      doc_licencia: false,
      Zonas: [],
      Pilotos: [],
      Globos: [],
      zona: false,
      globo: false,
      piloto: false,
      vuelo: false,
      form: {
        zona_id: "",
        piloto_id: null,
        globo_id: "",
        fecha: "",
        hora: "",
        temperatura: "",
        gas: "",
        notas: "",
        lugar_despegue: "",
        fecha_despegue: "",
        hora_despegue: "",
        lugar_aterrizaje: "",
        hora_aterrizaje: "",
        cautivo: 1,
      },
    };
  },
  mounted() {
    this.Buscar();
  },
  methods: {
    Buscar() {
      var url =
        "/admin/informes/edit_vuelos_cancelados/" + this.$route.params.id;
      axios
        .get(url)
        .then((response) => {
          this.zona = response.data.records.zona;
          this.globo = response.data.records.globo;
          this.piloto = response.data.records.piloto;
          this.vuelo = response.data.records.vuelo;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },

    ActualizarForm(evt) {
      evt.preventDefault();

      this.GuardandoCambios = !this.GuardandoCambios;
      var url = "/admin/informes/saved_vuelos";
      axios
        .post(url, {
          id: this.$route.params.id,
          zona: this.zona,
          globo: this.globo,
          piloto: this.piloto,
          vuelo: this.vuelo,
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
            this.$toasted.success("Información Actualizada Correctamente");
          }
          this.GuardandoCambios = !this.GuardandoCambios;
        })
        .catch((error) => {
          console.log(error);
          this.errors = error.response;
        });
    },
  },

  computed: {},
};
</script>
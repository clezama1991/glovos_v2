<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-users text-dark"></i>
              Listado de Pasajeros
            </span>
          </h3>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-12 table-responsive">
              <table
                id="bank"
                class="table table_datatable  table-striped table-bordered w-100 nowrap"
              >
                <thead class="table-primary">
                  <tr>
                    <th>Nombres y Apellidos</th>
                    <th>Nº pedido</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Peso Kgs</th>
                    <th>Activo</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(row, index) in records" :key="index">
                    <td>{{ row.nombres }} {{ row.apellidos }}</td>
                    <td>{{((row.nro_pedidos)&&(row.nro_pedidos.pedido)&&row.nro_pedidos.pedido.orden_wordpress) ? row.nro_pedidos.pedido.orden_wordpress : null}}</td>
                    <td>{{ row.telefono }}</td>
                    <td>{{ row.email }}</td>
                    <td>{{ row.peso }}</td>
                    <td>{{(row.activo==1)?'Activo':'Inactivo'}}</td>
                    <td>
                      <button
                        v-b-tooltip
                        v-if="
                          can('passengers-update') || can('passengers-read')
                        "
                        class="btn btn-sm btn-icon btn-warning"
                        @click="form = row"
                        data-toggle="modal"
                        :data-target="'#EditPasajero'"
                        :title="'Editar Pasajero'"
                      >
                        <i class="flaticon-search"></i>
                      </button>

                      <button
                        v-b-tooltip
                        v-if="can('passengers-delete')"
                        class="btn btn-danger btn-sm btn-icon"
                        @click="Borrar(row)"
                        :title="'Eliminar Pasajero'"
                      >
                        <i class="flaticon-close"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="EditPasajero"
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Pasajero</h5>
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
            @submit="EditarPasajeroForm"
            method="POST"
            enctype="multipart/form-data"
            class="form"
            id="formulario"
          >
            <div class="modal-body" v-if="form">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="nombres">Nombres</label>
                    <input
                      v-model="form.nombres"
                      id="nombres"
                      type="text"
                      class="form-control"
                      required
                      :disabled="!can('passengers-update')"
                    />
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input
                      v-model="form.apellidos"
                      id="apellidos"
                      type="text"
                      class="form-control"
                      required
                      :disabled="!can('passengers-update')"
                    />
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="dni">Identificación</label>
                    <input
                      v-model="form.dni"
                      id="dni"
                      type="text"
                      class="form-control"
                      required
                      :disabled="!can('passengers-update')"
                    />
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input
                      v-model="form.telefono"
                      id="telefono"
                      type="text"
                      class="form-control"
                      required
                      :disabled="!can('passengers-update')"
                    />
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input
                      v-model="form.email"
                      id="email"
                      type="email"
                      class="form-control"
                      required
                      :disabled="!can('passengers-update')"
                    />
                    <span class="form-text text-muted" v-if="!isEmailValid"
                      >Debe ingresar un email valido</span
                    >
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="peso">Peso Kgs</label>
                    <input
                      v-model="form.peso"
                      id="peso"
                      type="text"
                      class="form-control"
                      required
                      :disabled="!can('passengers-update')"
                    />
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="notas">Notas</label>
                    <textarea
                      v-model="form.notas"
                      id="nota"
                      type="text"
                      class="form-control"
                      :disabled="!can('passengers-update')"
                    ></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a
                type="button"
                class="btn btn-light-primary font-weight-bold"
                data-dismiss="modal"
                >Cerrar</a
              >
              <button
                type="submit"
                class="btn btn-warning"
                :disabled="GuardandoCambios || !isEmailValid"
              >
                <span v-if="GuardandoCambios">
                  <i class="fas fa-spinner fa-spin"></i> Actualizando...
                </span>
                <span v-else> Actualizar </span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      records: [],
      GuardandoCambios: false,
      form: false,
    };
  },
  mounted() {
    this.ValidarPermisos("passengers-update");
    this.Buscar();
  },
  methods: {
    ValidarPermisos(permiso) {
      if (!this.can(permiso)) {
        $("#formulario :input").prop("disabled", true);
      }
    },
    Buscar() {
      var url = "/admin/pasajeros";
      axios
        .get(url)
        .then((response) => {
          this.records = response.data.records;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
    EditarPasajeroForm(evt) {
      evt.preventDefault();
      this.GuardandoCambios = !this.GuardandoCambios;
      var url = "/admin/pasajeros/" + this.form.id;
      axios
        .post(url, {
          _method: "put",
          formulario: this.form,
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
            this.$toasted.success("Pasajero Actualizado Correctamente");

            $("#EditPasajero .close").click();
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();
          }
          this.GuardandoCambios = !this.GuardandoCambios;
        })
        .catch((error) => {
          console.log(error);
          this.errors = error.response;
        });
    },
    Borrar(data) {
      var _this = this;
      var registro = data;

      Swal.fire({
        title: "Confirmar!",
        text: "Confirme que desea Eliminar este Pasajero",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Confirmar!",
        cancelButtonText: "No, Cancelar!",
        reverseButtons: true,
      }).then(function (result) {
        if (result.value) {
          var url = "/admin/pasajeros/" + registro.id;

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
                _this.$toasted.success("Pasajero Eliminado Correctamente");
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
    isEmailValid() {
      var email = this.form
        ? this.form.email != null
          ? this.form.email
          : ""
        : "";
      if (email.length > 0) {
        var re =
          /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      } else {
        return true;
      }
    },
  },
  watch: {
    records: function (newValues, oldValues) {
      this.$nextTick(function () {
        $(".table_datatable").DataTable({
          // fixedColumns: true,
          paging: true,
          retrieve: true,
          // pagingType: "numbers",
          scrollX: true,  
           
          scrollY: 300,
          
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ <br>de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 <br>de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        } 
        });
      });
    },
  },
};
</script>
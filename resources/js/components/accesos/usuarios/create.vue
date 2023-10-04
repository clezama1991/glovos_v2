<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-user text-dark"></i>

              Registrar Usuario
            </span>
          </h3>
        </div>

        <form
          @submit="RegistarForm"
          method="POST"
          enctype="multipart/form-data"
          class="form"
          id="GuardarServiciosSolucionLimpieza"
        >
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="name">Nombre y Apellido</label>
                  <input
                    v-model="form.name"
                    id="name"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    v-model="form.email"
                    id="email"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="col-md-2 mb-3">
                <div class="form-group">
                  <label for="password">Clave</label>
                  <input
                    v-model="form.password"
                    id="password"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-3">
                <h4>Roles</h4>
              </div>
              <div class="col-md-12 mb-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th width="10%">Seleccionar</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                      <tr
                        v-for="(items, index_i) in records"
                        :key="index_i"
                      >
                        <td class="text-center">
                          <div class="form-check form-check-inline">
                            <label class="form-check-label">
                              <input
                                v-model="form.rol"
                                class="form-check-input"
                                type="checkbox"
                                name=""
                                :id="items.id"
                                :value="items.name"
                              />
                            </label>
                          </div>
                        </td>
                        <td>
                          <label :for="items.id">
                            {{ items.title }}
                          </label>
                        </td>
                        <td>
                          <label :for="items.id" class="ml-10">
                            {{ items.description }}
                          </label>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <router-link to="/admin-usuarios" class="btn btn-secondary mr-2">
              <i class="fa fa-undo"></i> Volver
            </router-link>

            <button
              type="submit"
              class="btn btn-primary mr-3 float-right"
              :disabled="GuardandoCambios"
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
  </div>
</template>
<script>
export default {
  data() {
    return {
      GuardandoCambios: false,
      form: {
        name: "",
        email: "",
        password: "Globos2023$",
        rol: [],
      },
      records: [],
    };
  },
  mounted() {
    this.BuscarPermisos();
  },
  methods: {
    BuscarPermisos() {
      var url = "/admin/listado_roles";
      axios
        .get(url)
        .then((response) => {
          this.records = response.data.records;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
    reset() {
      this.form = {
        name: "",
        email: "",
        password: "Globos2023$",
      };
    },

    RegistarForm(evt) {
      evt.preventDefault();

      this.GuardandoCambios = !this.GuardandoCambios;

      let formData = new FormData();

      formData.append("name", this.form.name);
      formData.append("email", this.form.email);
      formData.append("password", this.form.password);
      formData.append("rol", this.form.rol);

      var url = "/admin/users";

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
              "Ocurrio un error al registrar",
              "Error en Proceso..."
            );
          } else {
            this.$toasted.success("Información Registrada Correctamente");
            this.reset();
          }
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
  },

  computed: {},
};
</script>
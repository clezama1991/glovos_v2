<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-user-shield text-dark"></i>

              Registrar Rol
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
                  <label for="title">Nombre</label>
                  <input
                    v-model="form.title"
                    id="title"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="col-md-8 mb-3">
                <div class="form-group">
                  <label for="description">Descripción</label>
                  <input
                    v-model="form.description"
                    id="description"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-3">
                <h4>Permisos</h4>
              </div>
              <div class="col-md-12 mb-3">
                <table class="table">
                  <tbody>
                    <template v-for="(record, index) in records">
                      <tr>
                        <td class="bg-primary d-flex justify-content-between text-white h4">
                          {{ index }}
                          <button type="button" class="btn btn-success btn-sm" @click="SelectAll(index)"> Marcar Todas </button>
                        </td>
                      </tr>
                      <tr
                        v-for="(items, index_i) in record"
                        :key="index + '_' + index_i"
                      >
                        <td>
                          <div class="form-check form-check-inline">
                            <label class="form-check-label">
                              <input
                                v-model="form.permission"
                                :class="'form-check-input '+index"
                                type="checkbox"
                                name=""
                                :id="items.id"
                                :value="items.name"
                              />
                            </label>
                          </div>
                          <label :for="items.id" class="ml-10">
                            {{ items.description }}
                          </label>
                        </td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <router-link to="/admin-roles" class="btn btn-secondary mr-2">
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
        title: "",
        description: "",
        permission: [],
      },
      records: [],
    };
  },
  mounted() {
    this.BuscarPermisos();
  },
  methods: {
    SelectAll(index) {       
        let _this = this;
        $("."+index).each(function(){
          _this.form.permission.push( $(this).attr('value') );
        });        
    },
    BuscarPermisos() {
      var url = "/admin/listado_permission";
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
        title: "",
        description: "",
      };
    },

    RegistarForm(evt) {
      evt.preventDefault();

      this.GuardandoCambios = !this.GuardandoCambios;

      let formData = new FormData();

      formData.append("title", this.form.title);
      formData.append("description", this.form.description);
      formData.append("permission", this.form.permission);

      var url = "/admin/roles";

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
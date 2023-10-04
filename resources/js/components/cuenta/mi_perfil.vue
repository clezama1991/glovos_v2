<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-user text-dark"></i>
              Datos de la cuenta
            </span>
          </h3>
        </div>

        <div class="card-body">
          <div class="d-flex flex-column-fluid">
            <div class="container">
              <div class="row">
                <div class="col-xl-12">
                  <div class="card card-custom gutter-b card-stretch">
                    <div class="card-header border-0 pt-5">
                      <div class="card-title">
                        <div class="card-label">
                          <div class="font-weight-bolder"></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body d-flex flex-column p-0">
                      <div class="row d-flex justify-content-center">
                        <div class="col-xl-8">
                          <!--begin::Engage Widget 14-->
                          <div
                            class="
                              card card-custom card-stretch
                              gutter-b
                              shadow-lg
                            "
                          >
                            <div class="card-body pb-20">
                              <form
                                @submit="RegistarFormTracking"
                                method="POST"
                                enctype="multipart/form-data"
                                class="form"
                                id="GuardarServiciosSolucionLimpieza"
                              >
                                <div class="row mb-6">
                                  <!--begin::Info-->
                                  <div class="col-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                      <span
                                        class="text-dark font-weight-bold mb-4"
                                        >Nombres</span
                                      >
                                      <input
                                        class="form-control"
                                        style="font-size: larger"
                                        v-model="form.name"
                                      />
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                      <span
                                        class="text-dark font-weight-bold mb-4"
                                        >Email</span
                                      >
                                      <input
                                        class="form-control"
                                        style="font-size: larger"
                                        v-model="form.email"
                                      />
                                    </div>
                                  </div> 

                                  <div class="col-12 col-md-12">
                                    <div class="mb-8 d-flex flex-column">
                                      <button
                                        type="submit"
                                        class="btn btn-primary"
                                        :disabled="GuardandoCambios"
                                      >
                                        <span v-if="GuardandoCambios">
                                          <i class="fas fa-spinner fa-spin"></i>
                                          Registrando...
                                        </span>
                                        <span v-else> Actualizar Datos </span>
                                      </button>
                                    </div>
                                  </div>

                                  <!--end::Info-->
                                </div>
                              </form>

                              <router-link :to="'/cuenta/cambiar_clave'">
                                Cambiar Contraseña
                              </router-link>
                            </div>
                          </div>
                          <!--end::Engage Widget 14-->
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
      },
    };
  },
  mounted() {
    this.Buscar();
    console.log("mmm");
  },
  methods: {
    Buscar() {
      var url = "/admin/cuenta";
      axios
        .get(url)
        .then((response) => {
          this.form = response.data.records;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },

    isNumber: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;

      if (this.form.dni.length >= 10) {
        evt.preventDefault();
      }
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        charCode !== 46
      ) {
        evt.preventDefault();
      } else {
        return true;
      }
    },

    RegistarFormTracking(evt) {
      evt.preventDefault();

      this.GuardandoCambios = !this.GuardandoCambios;

    //   var soporte_cedula = this.$refs.soporte_cedula.files[0];

      let formData = new FormData();

      formData.append("name", this.form.name);
    //   formData.append("apellidos", this.form.apellidos);
    //   formData.append("dni", this.form.dni);
    //   formData.append("telefono", this.form.telefono);
      formData.append("email", this.form.email);
    //   formData.append("direccion", this.form.direccion);
      formData.append("_method", "put");

      var url = "/admin/cuenta/" + this.form.id;

      axios
        .post(url, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.GuardandoCambios = !this.GuardandoCambios;

          if (!response.data.result) {
            Swal.fire(
              "Ha ocurrido algún error!",
              "Se le notificará al equipo de soporte!" +
                response.data.mensaje_error +
                response.data.mensaje_error,
              "error"
            );
            this.$toasted.error("Ha ocurrido algún error!");
          } else {
            this.$toasted.success("Información Actualizada Correctamente");
            this.Buscar();
          }
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
  },
};
</script>
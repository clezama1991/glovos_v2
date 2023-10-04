<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        
        <header_card icon="fas fa-user-tie" titulo="Registrar Piloto"></header_card>

        <form
          @submit="RegistarForm"
          method="POST"
          enctype="multipart/form-data"
          class="form"
          ref="anyName" 
          id="GuardarServiciosSolucionLimpieza"
        >
          <div class="card-body">

            <info_inputs_required />

            <div class="row">
              <div class="col-md-12">
                <div class="card card-info mb-5">

                  <header_card icon="fas fa-user-tie" titulo="Datos Personales" tipo="sub"></header_card>

                  <div class="card-body"> 
                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="nombres" class="requerido">Nombres</label>
                          <input
                            v-model="form.nombres"
                            id="nombres"
                            type="text"
                            class="form-control form-control-sm"
                            required
                            placeholder="Nombres"
                          />
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="apellidos" class="requerido">Apellidos</label>
                          <input
                            v-model="form.apellidos"
                            id="apellidos"
                            type="text"
                            class="form-control form-control-sm"
                            required
                            placeholder="Apellidos"
                          />
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="cedula" class="requerido">Identificación</label>
                          <input
                            v-model="form.cedula"
                            id="cedula"
                            type="text"
                            class="form-control form-control-sm"
                            required
                            placeholder="Identificación"
                          />
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="peso" class="requerido">Peso KGS</label>
                          <input
                            v-model="form.peso"
                            v-numero
                            id="peso"
                            type="text"
                            class="form-control form-control-sm"
                            required
                            placeholder="Peso KGS"
                          />
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="telefono" class="requerido">Teléfono</label>
                          <input
                            v-model="form.telefono"
                            id="telefono"
                            type="text"
                            class="form-control form-control-sm"
                            required
                            placeholder="Teléfono"
                          />
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="email" class="requerido">Email</label>
                          <input
                            v-model="form.email"
                            id="email"
                            type="text"
                            class="form-control form-control-sm"
                            required
                            placeholder="Email"
                          />
                          <span
                            class="form-text text-muted"
                            v-if="!isEmailValid"
                            >Debe ingresar un email valido</span
                          >
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="direccion" class="requerido">Dirección</label>
                          <input
                            v-model="form.direccion"
                            id="direccion"
                            type="text"
                            class="form-control form-control-sm"
                            required
                            placeholder="Dirección"
                          />
                        </div>
                      </div>

                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="nota">Notas</label>
                          <textarea
                            v-model="form.nota"
                            id="nota"
                            type="text"
                            class="form-control form-control-sm"
                            placeholder="Notas"
                          >
                          </textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="card card-info mb-5">

                  <header_card icon="fa fa-file" titulo="Documentos" tipo="sub"></header_card>

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <div class="form-group">
                              <label for="licencia" class="requerido">Fecha Licencia</label>
                              <input
                                v-model="form.licencia"
                                id="licencia"
                                type="date"
                                class="form-control form-control-sm"
                                required
                              />
                            </div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <div class="form-group">
                              <label for="form_doc_licencia">Licencia</label>
                              <b-form-file
                                id="form_doc_licencia" 
                                ref="form_doc_licencia" 
                                placeholder="Buscar Licencia..."
                                drop-placeholder="Suelta el archivo aquí..."
                              ></b-form-file>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div
                          class="row"
                          :class="{
                            'bg-danger text-white':
                              form.cert_medico != '' &&
                              form.cert_medico < dateNow,
                          }"
                        >
                          <div class="col-md-6 mb-3">
                            <div class="form-group">
                              <label for="peso">Fecha Certificado Medico</label>
                              <input
                                type="date"
                                :min="dateNow"
                                class="form-control form-control-sm"
                                :class="{
                                  'bg-danger':
                                    form.cert_medico != '' &&
                                    form.cert_medico < dateNow,
                                }"
                                v-model="form.cert_medico"
                                name="cert_medico"
                                id="cert_medico"
                              />
                              <span
                                class="form-text text-muted"
                                v-if="
                                  form.cert_medico != '' &&
                                  form.cert_medico < dateNow
                                "
                              >
                                La fecha del certificado esta caducada
                              </span>
                            </div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <div class="form-group">
                              <label for="form_cert_medico"
                                >Certificado Medico</label
                              >
                              <b-form-file
                                id="form_cert_medico"
                                ref="form_cert_medico"
                                placeholder="Buscar Certificado Medico..."
                                drop-placeholder="Suelta el archivo aquí..."
                              ></b-form-file>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    
                    <div class="row">
                      <div class="col-md-6">
                    <div
                      class="row"
                      :class="{
                        'bg-danger text-white':
                          form.cert_incendio != '' &&
                          form.cert_incendio < dateNowAge3Years,
                      }"
                    >
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="peso">Fecha Certificado Incendio </label>
                          <input
                            type="date"
                            :min="dateNowAge3Years"
                            class="form-control form-control-sm"
                            :class="{
                              'bg-danger':
                                form.cert_incendio != '' &&
                                form.cert_incendio < dateNowAge3Years,
                            }"
                            v-model="form.cert_incendio"
                            name="cert_incendio"
                            id="cert_incendio"
                          />
                          <span
                            class="form-text text-muted"
                            v-if="
                              form.cert_incendio != '' &&
                              form.cert_incendio < dateNowAge3Years
                            "
                          >
                            La fecha del certificado esta caducada
                          </span>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="form_cert_incendio"
                            >Certificado Incendio
                          </label>
                          <b-form-file
                            id="form_cert_incendio"
                            v-model="form_cert_incendio"
                            placeholder="Buscar Certificado Incendio..."
                            drop-placeholder="Suelta el archivo aquí..."
                          ></b-form-file>
                        </div>
                      </div>
                    </div>
                      </div>
                      
                      <div class="col-md-6">
                    <div
                      class="row"
                      :class="{
                        'bg-danger text-white':
                          form.cert_primeros_auxilios != '' &&
                          form.cert_primeros_auxilios < dateNowAge3Years,
                      }"
                    >
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="peso"
                            >Fecha Certificado Primeros Auxilios
                          </label>
                          <input
                            type="date"
                            :min="dateNowAge3Years"
                            class="form-control form-control-sm"
                            :class="{
                              'bg-danger':
                                form.cert_primeros_auxilios != '' &&
                                form.cert_primeros_auxilios < dateNowAge3Years,
                            }"
                            v-model="form.cert_primeros_auxilios"
                            name="cert_primeros_auxilios"
                            id="cert_primeros_auxilios"
                          />
                          <span
                            class="form-text text-muted"
                            v-if="
                              form.cert_primeros_auxilios != '' &&
                              form.cert_primeros_auxilios < dateNowAge3Years
                            "
                          >
                            La fecha del certificado esta caducada
                          </span>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="form_cert_primeros_auxilios"
                            >Certificado Primeros Auxilios
                          </label>
                          <b-form-file
                            id="form_cert_primeros_auxilios"
                            v-model="form_cert_primeros_auxilios"
                            placeholder="Buscar Certificado Primeros Auxilios..."
                            drop-placeholder="Suelta el archivo aquí..."
                          ></b-form-file>
                        </div>
                      </div>
                    </div>
                      </div></div>

                      
                  </div>
                </div>
              </div>




              
              <div class="col-md-12">
                <div class="card card-info mb-5">
                  <header_card icon="fas fa-plane-departure" titulo="Datos Sobre Vuelos" tipo="sub"></header_card>
                  <div class="card-body">
                    
                    <div class="row">
                      <div class="col-md-6">

                    <div
                      class="row"
                      :class="{
                        'bg-danger text-white':
                          form.vuelo_if != '' &&
                          form.vuelo_if < dateNowAge4Years,
                      }"
                    >
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="peso">Fecha Vuelo FI </label>
                          <input
                            type="date"
                            :min="dateNowAge4Years"
                            class="form-control form-control-sm"
                            :class="{
                              'bg-danger':
                                form.vuelo_if != '' &&
                                form.vuelo_if < dateNowAge4Years,
                            }"
                            v-model="form.vuelo_if"
                            name="vuelo_if"
                            id="vuelo_if"
                          />
                          <span
                            class="form-text text-muted"
                            v-if="
                              form.vuelo_if != '' &&
                              form.vuelo_if < dateNowAge4Years
                            "
                          >
                            La fecha del certificado esta caducada
                          </span>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="form_vuelo_if"
                            >Certificado Vuelo FI
                          </label>
                          <b-form-file
                            id="form_vuelo_if"
                            v-model="form_vuelo_if"
                            placeholder="Buscar Vuelo FI..."
                            drop-placeholder="Suelta el archivo aquí..."
                          ></b-form-file>
                        </div>
                      </div>
                    </div>
                      </div>
                      
                      <div class="col-md-6">
                    <div
                      class="row"
                      :class="{
                        'bg-danger text-white':
                          form.experiencia_reciente != '' &&
                          form.experiencia_reciente <= dateNowAge6Month,
                      }"
                    >
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="peso">Experiencia reciente</label>
                          <input
                            type="date"
                            class="form-control form-control-sm"
                            :class="{
                              'bg-danger':
                                form.experiencia_reciente != '' &&
                                form.experiencia_reciente <= dateNowAge6Month,
                            }"
                            v-model="form.experiencia_reciente"
                            name="experiencia_reciente"
                            id="experiencia_reciente"
                          />
                          <span
                            class="form-text text-muted"
                            v-if="
                              form.experiencia_reciente != '' &&
                              form.experiencia_reciente <= dateNowAge6Month
                            "
                          >
                            La fecha del certificado esta caducada
                          </span>
                        </div>
                      </div>


                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label for="habilitacion_nivel">Catégorias de Habilitación </label>
                    <v-select 
                    v-model="form.habilitacion_nivel"
                    class="w-100"
                    id="habilitacion_nivel"
                            placeholder="Seleccione..."
                    :options="Habilitacion" >
                         
                      <template #search="{ attributes, events }">
                          <input
                          class="vs__search"
                          :required="!form.habilitacion_nivel"
                          v-bind="attributes"
                          v-on="events"
                          />
                      </template>

                    </v-select>
                  </div> 
                </div> 

                    </div>
                    
                  </div>






                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      
                    <div class="form-group">
                      <input type="checkbox" name="hab_cautivos" id="hab_cautivos" v-model="form.hab_cautivos"> <label for="hab_cautivos"> Habilitación Cautivos </label>
                    </div> 
                  </div> 
                    <div class="col-md-3">
                      
                    <div class="form-group">
                      <input type="checkbox" name="hab_nocturnos" id="hab_nocturnos" v-model="form.hab_nocturnos"> <label for="hab_nocturnos"> Habilitación Nocturnos </label>
                    </div> 
                  </div> 
                  </div>
                  </div>
                </div>
              </div>





            </div>
          </div>

          <div class="card-footer">
            <router-link to="/pilotos" class="btn btn-secondary mr-2">
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
      doc_licencia: false,
      Habilitacion : ['A','B','C','D'],
      form: {
        nombres: "",
        apellidos: "",
        cedula: "",
        telefono: "",
        email: "",
        direccion: "",
        peso: "",
        licencia: "",
        cert_medico: "",
        cert_incendio: "",
        cert_primeros_auxilios: "",
        nota: "",
        vuelo_if: "",
        experiencia_reciente: "",
        habilitacion_nivel: null,
        hab_cautivos: "",
        hab_nocturnos: "",
      },
      files: {
        form_doc_licencia : null, 
        form_cert_medico : null, 
      },
      form_dasoc_licencia: null,
      form_cert_medico: null,
      form_cert_incendio: null,
      form_cert_primeros_auxilios: null,
      form_vuelo_if: null,
      
    };
  },
  mounted() {
    // this.MountFiles();
  },
  methods: {
    MountFiles() {
      
            this.$router.push({
                path: '/pilotos/'
            });

      // this.$refs['form_doc_licencia'].reset();
      // this.$refs['form_cert_medico'].reset();
    },
    reset() {
      this.form = {
        nombres: "",
        apellidos: "",
        cedula: "",
        telefono: "",
        email: "",
        direccion: "",
        peso: "",
        licencia: "",
        cert_medico: "",
        cert_incendio: "",
        cert_primeros_auxilios: "",
        nota: "",
        vuelo_if: "",
        experiencia_reciente: "",
        habilitacion_nivel: "",
        hab_cautivos: "",
        hab_nocturnos: "",
      };

      this.form_doc_licencia = null;
      this.form_cert_medico = null;
      this.form_cert_incendio = null;
      this.form_cert_primeros_auxilios = null;
      this.form_vuelo_if = null;
    },
    
    async RegistarForm(evt) {
      evt.preventDefault();

   
      var form_doc_licencia = this.$refs.form_doc_licencia.files[0];
      var form_cert_medico = this.$refs.form_cert_medico.files[0];
      var form_cert_incendio = this.form_cert_incendio;
      var form_cert_primeros_auxilios = this.form_cert_primeros_auxilios;
      var form_vuelo_if = this.form_vuelo_if;

      let formData = new FormData();
      formData.append("form_doc_licencia", form_doc_licencia);
      formData.append("form_cert_medico", form_cert_medico);
      formData.append("form_cert_incendio", form_cert_incendio);
      formData.append("form_cert_primeros_auxilios",form_cert_primeros_auxilios);
      formData.append("form_vuelo_if", form_vuelo_if);
      formData.append("nombres", this.form.nombres);
      formData.append("apellidos", this.form.apellidos);
      formData.append("dni", this.form.cedula);
      formData.append("telefono", this.form.telefono);
      formData.append("email", this.form.email);
      formData.append("direccion", this.form.direccion);
      formData.append("peso", this.form.peso);
      formData.append("licencia", this.form.licencia);
      formData.append("cert_medico", this.form.cert_medico);
      formData.append("cert_incendio", this.form.cert_incendio);
      formData.append("cert_primeros_auxilios",this.form.cert_primeros_auxilios);
      formData.append("nota", this.form.nota);
      formData.append("vuelo_if", this.form.vuelo_if);
      formData.append("experiencia_reciente", this.form.experiencia_reciente);
      formData.append("habilitacion_nivel", this.form.habilitacion_nivel);
      formData.append("hab_cautivos", (this.form.hab_cautivos)?1:0);
      formData.append("hab_nocturnos", (this.form.hab_nocturnos)?1:0);
  
      var optiones  = {
        'url' : '/admin/pilotos',
        'data' : formData,
        'form' : this.form,
        // 'form_files' : this.files
      }

      await this.AddRegister(optiones); 

    }, 
  },

  computed: {
    isEmailValid() {
      var email = this.form.email;
      if (email.length > 0) {
        var re =
          /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      } else {
        return true;
      }
    },
    dateNow() {
      return moment().format("YYYY-MM-DD");
    },
    // refCPA(){
    //   return (this.$refs.form_cert_primeros_auxilios && this.$refs.form_cert_primeros_auxilios.files.length>0)?true:false;
    // },
    dateNowAge3Years() {
      return moment().subtract(3, "years").format("YYYY-MM-DD");
    },
    dateNowAge4Years() {
      return moment().subtract(4, "years").format("YYYY-MM-DD");
    },
    dateNowAge6Month() {
      return moment().subtract(6, "months").format("YYYY-MM-DD");
    },
  },
};
</script>
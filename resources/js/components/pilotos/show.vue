<template>

<div>
  
    <base-loading></base-loading>

  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-user-tie text-dark"></i>
                Consultar Piloto
              </span>
          </h3>

        </div>
 
    <form @submit="ActualizarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
               
            <info_inputs_required />

        <div class="row">
          <div class="col-md-12">

              <div class="card card-info mb-5">
                  <header_card icon="fas fa-user-tie" titulo="Datos Personales"></header_card>
                <div class="card-body"> 
                      <div class="row">
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="nombres" class="requerido">Nombres</label>
                            <input v-model="form.nombres" id="nombres" type="text" class="form-control" required
                            placeholder="Nombres">
                          </div> 
                        </div> 
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="apellidos" class="requerido">Apellidos</label>
                            <input v-model="form.apellidos" id="apellidos" type="text" class="form-control" required
                            placeholder="Apellidos">
                          </div> 
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="cedula" class="requerido">Nro de Licencia</label>
                            <input v-model="form.dni" id="cedula" type="text" class="form-control" required
                            placeholder="Nro de Licencia">
                          </div> 
                        </div>   
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="peso" class="requerido">Peso KGS</label>
                            <input v-model="form.peso" v-numero id="peso" type="text" class="form-control" required
                            placeholder="Peso KGS">
                          </div> 
                        </div>    
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="telefono" class="requerido">Teléfono</label>
                            <input v-model="form.telefono" id="telefono" type="tel" class="form-control" required
                            placeholder="Teléfono">
                          </div> 
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="email" class="requerido">Email</label>
                            <input v-model="form.email" id="email" type="text" class="form-control" required
                            placeholder="Email"> 
                            <span class="form-text text-muted" v-if="!isEmailValid">Debe ingresar un email valido</span>
                          </div> 
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="pin" class="requerido">PIN</label>
                            <input
                              v-model="form.pin"
                              id="pin"
                              type="text"
                              class="form-control form-control-sm"
                              required
                              placeholder="PIN"
                            />
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="direccion" class="requerido">Dirección</label>
                            <input v-model="form.direccion" id="direccion" type="text" class="form-control" required
                            placeholder="Dirección"> 
                          </div> 
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="nota">Notas</label>
                            <textarea v-model="form.nota" id="nota" type="text" class="form-control"
                            placeholder="Notas">
                            </textarea>
                          </div> 
                        </div> 
                    
                      </div>
                    </div>
              </div>
          </div>
          
          <div class="col-md-12">

              <div class="card card-info mb-5">
                
                  <header_card icon="fa fa-file" titulo="Documentos"></header_card>

                <div class="card-body">       
                
                    <div class="row">
                      <div class="col-md-6">

                 <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="licencia" class="requerido">Fecha Licencia</label>
                          <input v-model="form.licencia" id="licencia" type="date" class="form-control" required>
                        </div> 
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="form_doc_licencia">Licencia</label>
                               <a :href="form.licencia_doc_path" v-if="form.licencia_doc_path!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Certificado de Matricula"> Descargar</a>
                                <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
           
                            <b-form-file 
                              id="form_doc_licencia"
                              v-model="form_doc_licencia"
                              placeholder="Buscar Licencia..."
                              drop-placeholder="Suelta el archivo aquí..."
                            ></b-form-file>
                        </div> 
                      </div>
                      </div>
                      </div>


                      <div class="col-md-6">
                
                    <div class="row" :class="{'bg-danger text-white':form.cert_medico!='' && form.cert_medico<dateNow}">
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="peso">Fecha Certificado Medico</label>
                           <input                    
                                type="date"
                                :min="dateNow" 
                                class="form-control form-control-sm" 
                                :class="{'bg-danger':form.cert_medico!='' && form.cert_medico<dateNow}"
                                v-model="form.cert_medico" 
                                name="cert_medico" 
                                id="cert_medico">
                                <span class="form-text text-muted" v-if="form.cert_medico!='' && form.cert_medico<dateNow">
                                  La fecha del certificado esta caducada
                                </span>
                        </div> 
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="form_cert_medico">Certificado Medico</label>
                               <a :href="form.cert_medico_doc_path" v-if="form.cert_medico_doc_path!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Certificado de Matricula"> Descargar</a>
                                <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                            <b-form-file 
                              id="form_cert_medico"
                              v-model="form_cert_medico"
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
                    <div class="row" :class="{'bg-danger text-white':form.cert_incendio!='' && form.cert_incendio<dateNowAge3Years}">
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="peso">Fecha Certificado Incendio	</label>
                          <input                    
                                type="date"
                                :min="dateNowAge3Years" 
                                class="form-control form-control-sm" 
                                :class="{'bg-danger':form.cert_incendio!='' && form.cert_incendio<dateNowAge3Years}"
                                v-model="form.cert_incendio" 
                                name="cert_incendio" 
                                id="cert_incendio">
                                <span class="form-text text-muted" v-if="form.cert_incendio!='' && form.cert_incendio<dateNowAge3Years">
                                  La fecha del certificado esta caducada
                                </span>
                        </div> 
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="form_cert_incendio">Certificado Incendio	</label>
                               <a :href="form.cert_incendio_doc_path" v-if="form.cert_incendio_doc_path!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Certificado de Matricula"> Descargar</a>
                                <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
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
                    <div class="row" :class="{'bg-danger text-white':form.cert_primeros_auxilios!='' && form.cert_primeros_auxilios<dateNowAge3Years}">
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="peso">Fecha Certificado Primeros Auxilios	</label>
                          <input                      
                            type="date" 
                            :min="dateNowAge3Years"
                            class="form-control form-control-sm" 
                            :class="{'bg-danger':form.cert_primeros_auxilios!='' && form.cert_primeros_auxilios<dateNowAge3Years}"
                            v-model="form.cert_primeros_auxilios" 
                            name="cert_primeros_auxilios" 
                            id="cert_primeros_auxilios">
                            <span class="form-text text-muted" v-if="form.cert_primeros_auxilios!='' && form.cert_primeros_auxilios<dateNowAge3Years">
                              La fecha del certificado esta caducada
                            </span>
                        </div> 
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="form_cert_primeros_auxilios">Certificado Primeros Auxilios	</label>
                               <a :href="form.cert_primeros_auxilios_doc_path" v-if="form.cert_primeros_auxilios_doc_path!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Certificado de Matricula"> Descargar</a>
                                <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                            <b-form-file 
                              id="form_cert_primeros_auxilios"
                              v-model="form_cert_primeros_auxilios"
                              placeholder="Buscar Certificado Primeros Auxilios..."
                              drop-placeholder="Suelta el archivo aquí..."
                            ></b-form-file>
                        </div> 
                      </div>
                      </div>
                      </div>
                    </div>

                    <div class="row">
                      
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="form_url_firma_digital">Firma Digitalizada	</label>
                               <a :href="form.url_firma_digital" v-if="form.url_firma_digital!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Certificado de Matricula"> Descargar</a>
                                <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                            <b-form-file 
                              id="form_url_firma_digital"
                              v-model="form_url_firma_digital"
                              placeholder="Buscar Firma Digitalizada..."
                              drop-placeholder="Suelta el archivo aquí..."
                            ></b-form-file>
                        </div> 
                      </div>
                    </div>
                                    </div>
              </div>
          </div>
          

              
              <div class="col-md-12">
                <div class="card card-info mb-5">
                  
                  <header_card icon="fas fa-plane-departure" titulo="Datos Sobre Vuelos"></header_card>
                  
                  <div class="card-body"> 
                    
                    <div class="row">
                      <div class="col-md-6">
<div class="row" :class="{'bg-danger text-white':form.vuelo_if!='' && form.vuelo_if<dateNowAge4Years}">
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="vuelo_if">Fecha Vuelo FI	</label>
                          <input                      
                            type="date" 
                            :min="dateNowAge4Years"
                            class="form-control form-control-sm" 
                            :class="{'bg-danger':form.vuelo_if!='' && form.vuelo_if<dateNowAge4Years}"
                            v-model="form.vuelo_if" 
                            name="vuelo_if" 
                            id="vuelo_if">
                            <span class="form-text text-muted" v-if="form.vuelo_if!='' && form.vuelo_if<dateNowAge4Years">
                              La fecha del certificado esta caducada
                            </span>
                        </div> 
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="form_vuelo_if">Certificado Vuelo FI	</label>
                             <a :href="form.vuelo_if_doc_path" v-if="form.vuelo_if_doc_path!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Certificado Vuelo FI"> Descargar</a>
                                <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
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
                      
                      <div class="col-md-3">
                        
                      <div class="row" :class="{'bg-danger text-white':form.experiencia_reciente!='' && form.experiencia_reciente<=dateNowAge6Month}">
                        <div class="col-md-12 mb-3">
                          <div class="form-group">
                            <label for="experiencia_reciente">Experiencia reciente</label>
                            <input                      
                              type="date" 
                              class="form-control form-control-sm" 
                              :class="{'bg-danger':form.experiencia_reciente!='' && form.experiencia_reciente<=dateNowAge6Month}"
                              v-model="form.experiencia_reciente" 
                              name="experiencia_reciente" 
                              id="experiencia_reciente">
                              <span class="form-text text-muted" v-if="form.experiencia_reciente!='' && form.experiencia_reciente<=dateNowAge6Month">
                                La fecha del certificado esta caducada
                              </span>
                          </div> 
                        </div>
                      </div>
                      
                    </div>

                <div class="col-md-3 mb-3">
                  <div class="form-group">
                    <label for="habilitacion_nivel" class="requerido">Catégorias de Habilitación </label>
                    <select class="form-control" v-model="form.habilitacion_nivel" required>
                      <option value="" selected disabled></option>
                      <option value="" v-for="(item, index) in Habilitacion" :key="index">{{item}}</option>
                    </select>
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
          v-if="can('pilots-update')"
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
      props : ['id'],
        data() {
          return {
            GuardandoCambios : false,
            doc_licencia:false,
            form:{         
              nombres : '',
              apellidos : '',
              cedula : '',
              telefono : '',
              email : '',
              direccion : '',
              peso : '',
              licencia : '',
              cert_medico : '',
              cert_incendio : '',
              cert_primeros_auxilios : '',
              nota : '',
              vuelo_if : '',
              experiencia_reciente : '',
              habilitacion_nivel: null,
              hab_cautivos: "",
              hab_nocturnos: "",
              pin: "",
            },
            Habilitacion : ['A','B','C','D'],
            form_doc_licencia: null,
            form_cert_medico: null,
            form_cert_incendio: null,
            form_cert_primeros_auxilios: null,
            form_url_firma_digital: null,
            form_vuelo_if: null,


            del_licencia_doc : false,
            del_cert_medico_doc : false,
            del_cert_incendio_doc : false,
            del_cert_primeros_auxilios_doc : false,

          }
        },
        mounted() {
          this.Buscar();
          this.ValidarPermisos('pilots-update');
        },
        methods: { 
 
          ValidarPermisos(permiso) {
            if(!this.can(permiso)){
              $(":input").prop("disabled", true);
            }
          },
         Buscar() {
            var url = '/admin/pilotos/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.form = response.data.record; 

            }).catch(error => {
                this.errors = error.response.data
            });
        },

          ActualizarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              
              var form_doc_licencia = this.form_doc_licencia;
              var form_cert_medico = this.form_cert_medico;
              var form_cert_incendio = this.form_cert_incendio;
              var form_cert_primeros_auxilios = this.form_cert_primeros_auxilios;
              var form_url_firma_digital = this.form_url_firma_digital;
              var form_vuelo_if = this.form_vuelo_if;


              let formData = new FormData();
 
              formData.append('_method', 'put');
              formData.append('form_doc_licencia', form_doc_licencia);
              formData.append('form_cert_medico', form_cert_medico);
              formData.append('form_cert_incendio', form_cert_incendio);
              formData.append('form_cert_primeros_auxilios', form_cert_primeros_auxilios);
              formData.append('form_url_firma_digital', form_url_firma_digital);
              formData.append('form_vuelo_if', form_vuelo_if);
              formData.append('nombres', this.form.nombres);
              formData.append('apellidos', this.form.apellidos);
              formData.append('dni', this.form.dni);
              formData.append('telefono', this.form.telefono);
              formData.append('email', this.form.email);
              formData.append('direccion', this.form.direccion);
              formData.append('peso', this.form.peso);
              formData.append('licencia', this.form.licencia);
              formData.append('cert_medico', this.form.cert_medico);
              formData.append('cert_incendio', this.form.cert_incendio);
              formData.append('cert_primeros_auxilios', this.form.cert_primeros_auxilios);
              formData.append('nota', this.form.nota);
              formData.append('vuelo_if', this.form.vuelo_if);
              formData.append('experiencia_reciente', this.form.experiencia_reciente);
              formData.append("habilitacion_nivel", this.form.habilitacion_nivel);
              formData.append("hab_cautivos", (this.form.hab_cautivos)?1:0);
              formData.append("hab_nocturnos", (this.form.hab_nocturnos)?1:0);
              formData.append("pin", this.form.pin);
          
               var url = '/admin/pilotos/'+this.$route.params.id;

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                this.GuardandoCambios = !this.GuardandoCambios;
                if(!response.data.result){
                  this.$toastr.error('Ocurrio un error al actualizar Piloto', 'Error en Proceso...');       
                }else{       

                  this.$toasted.success('Piloto Actualizado Correctamente');    
                  this.Buscar();
                  
                  this.del_licencia_doc = false;
                  this.del_cert_medico_doc = false;
                  this.del_cert_incendio_doc = false;
                  this.del_cert_primeros_auxilios_doc = false; 
                  window.location.href = '/dashboard#/pilotos';
                }     


              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 

      },
      
  
      computed: { 
        isEmailValid(){
          var email = this.form.email;
          if(email.length>0){
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
          }else{
            return true;
          }
        },  
        dateNow(){
          return moment().format('YYYY-MM-DD');
        },   
        dateNowAge3Years(){
          return moment().subtract(3, 'years').format('YYYY-MM-DD');
        },   
        dateNowAge4Years(){
          return moment().subtract(4, 'years').format('YYYY-MM-DD');
        },  
        dateNowAge6Month(){
          return moment().subtract(6, 'months').format('YYYY-MM-DD');
        },    
    }


      };
    </script>
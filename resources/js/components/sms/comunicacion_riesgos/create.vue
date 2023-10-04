<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-exclamation-triangle text-dark"></i>

                Registrar Riesgo
              </span>
          </h3>

        </div>
 
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
    

          <div class="card card-custom gutter-b">


          <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-primary">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder">
                  Comunicación de riesgos / peligros 
                </span>
            </h3>

          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="formfecha">Fecha</label>
                  <input v-model="form.fecha" id="formfecha" type="date" class="form-control" required>
                </div> 
              </div> 
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="estado">Estado</label>                  
                  <select v-model="form.estado" id="estado"  class="form-control">
                    <option value="Abierto">Abierto</option>
                    <option value="Completado">completado</option>
                    <option value="Seguimiento">Seguimiento</option>
                    <option value="Seguimiento fecha vencida">Seguimiento fecha vencida </option>
                    <option value="Cerrado">Cerrado</option>
                  </select>
                </div> 
              </div> 
            </div>               
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="nombres_notificante">Nombre</label>
                  <input v-model="form.nombres_notificante" id="nombres_notificante" type="text" class="form-control" required>
                </div> 
              </div> 
              
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="cargo_responsabilidad_notificante">Cargo / Responsabilidad</label>
                  <input v-model="form.cargo_responsabilidad_notificante" id="cargo_responsabilidad_notificante" type="text" class="form-control" required>
                </div> 
              </div> 
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="url_firma_notificante">Firma</label>
                    <b-form-file 
                      id="url_firma_notificante"
                      ref="url_firma_notificante"
                      placeholder="Buscar Firma..."
                      drop-placeholder="Suelta el archivo aquí..."
                    ></b-form-file>
                </div> 
              </div>
              
              
              
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="descripción_suceso">Descripción del Suceso</label>
                  <textarea v-model="form.descripción_suceso" id="descripción_suceso" class="form-control">
                  </textarea>
                </div> 
              </div> 
                
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="medidas_correctivas">Medidas Correctoras Aplicables</label>
                  <textarea v-model="form.medidas_correctivas" id="medidas_correctivas" class="form-control">
                  </textarea>
                </div> 
              </div> 
                
            </div>               
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="nombres_responsable">Nombre Responsable</label>
                  <input v-model="form.nombres_responsable" id="nombres_responsable" type="text" class="form-control" required>
                </div> 
              </div> 
               
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="url_firma_responsable">Firma</label>
                    <b-form-file 
                      id="url_firma_responsable"
                      ref="url_firma_responsable"
                      placeholder="Buscar Firma..."
                      drop-placeholder="Suelta el archivo aquí..."
                    ></b-form-file>
                </div> 
              </div>
              
            </div>                
            <div class="row">
              
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label for="url_documentos_sucesos">Otros Documentos</label>
                    <b-form-file 
                      id="url_documentos_sucesos"
                      ref="url_documentos_sucesos"
                      placeholder="Buscar Documentos..."
                      drop-placeholder="Suelta el archivo aquí..."
                    ></b-form-file>
                </div> 
              </div>
            </div>
            
          </div>
        </div>
        </div>

        
        <div class="card-footer">
          <router-link to="/comunicacion_riesgos" class="btn btn-secondary mr-2">
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
            GuardandoCambios : false, 
            // url_firma_notificante : false, 
            url_firma_responsable : false, 
            url_documentos_sucesos : false, 
            form:{         
              fecha : '',
              estado : '',
              nombres_notificante : '',
              cargo_responsabilidad_notificante : '',
              url_firma_notificante : '',
              descripción_suceso : '',
              medidas_correctivas : '',
              nombres_responsable : '',
              url_firma_responsable : '',
              url_documentos_sucesos : '',
            },
   
          }
        },
        mounted() {
          // this.Buscar();
        },
        methods: { 
 
          reset() { 

             this.form = {         
              fecha : '',
              estado : '',
              nombres_notificante : '',
              cargo_responsabilidad_notificante : '',
              url_firma_notificante : '',
              descripción_suceso : '',
              medidas_correctivas : '',
              nombres_responsable : '',
              url_firma_responsable : '',
              url_documentos_sucesos : '',
            };

            this.$refs['url_firma_notificante'].reset();
            this.$refs['url_firma_responsable'].reset();
            this.$refs['url_documentos_sucesos'].reset();

          },
 
 
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var url_firma_notificante = this.$refs.url_firma_notificante.files[0];
              var url_firma_responsable = this.$refs.url_firma_responsable.files[0];
              var url_documentos_sucesos = this.$refs.url_documentos_sucesos.files[0];

              let formData = new FormData();
  
              formData.append('url_firma_notificante', url_firma_notificante);
              formData.append('url_firma_responsable', url_firma_responsable);
              formData.append('url_documentos_sucesos', url_documentos_sucesos);
              
              formData.append('fecha', this.form.fecha);
              formData.append('estado', this.form.estado);
              formData.append('nombres_notificante', this.form.nombres_notificante);
              formData.append('cargo_responsabilidad_notificante', this.form.cargo_responsabilidad_notificante);
              formData.append('descripción_suceso', this.form.descripción_suceso);
              formData.append('medidas_correctivas', this.form.medidas_correctivas);
              formData.append('nombres_responsable', this.form.nombres_responsable);        
                
              var url = '/admin/riesgos';

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Riesgo Registrado Correctamente');                  
                  this.reset();
                }     


              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 

    },
      
    computed: {
 

    }


      };
    </script>
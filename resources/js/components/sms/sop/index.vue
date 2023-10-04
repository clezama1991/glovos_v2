<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-file-upload text-dark"></i>
                Listado de SOP

              </span>

              <button data-toggle="modal" data-target="#AddSop" @click="reset()"
                v-if="can('sop-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar SOP </span>
              </button>
            </h3>
          </div> 


        <div class="card-body">

         <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            titulo="Sop"      
            :can_ver="can('sop-read')"
            :can_editar="can('sop-update') || can('sop-read')"
            :can_eliminar="can('sop-delete')"            
            @ButtonDelete="ButtonDelete"
            @ButtonEdit="ButtonEdit"
          ></tabla-component> 
<!-- 
          <tabla-component :striped="true"
            :fields="fieldsEmpleado" 
            :listado="Listado" 
            titulo="Usuario"
            @ButtonDelete="ButtonDelete"
            @ButtonEdit="ButtonEdit"
          ></tabla-component> -->

        </div>

       
      </div>

    </div>

      <div class="modal fade" id="EditSop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Editar SOP
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
               
    <form @submit="ActualizarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
                <div class="modal-body">
                  <div class="row">
                    
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="codigo">Id</label>
                        <input v-model="form.codigo" id="codigo" type="text" v-numero class="form-control" required :disabled="!can('sop-update')">
                      </div> 
                    </div> 
                    </div> 
                    
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="formfecha">Nombre</label>
                        <input v-model="form.nombre" id="formfecha" type="nombre" class="form-control" required :disabled="!can('sop-update')">
                      </div>  
                            
                
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="formfecha">Fecha</label>
                        <input v-model="form.fecha" id="formfecha" type="date" class="form-control" required :disabled="!can('sop-update')">
                      </div>  
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="documento_up">Documento</label>     
                            <a :href="form.url_file" v-if="form.url_file!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar"> Descargar</a>
                            <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                                   
                          <b-form-file 
                           :disabled="!can('sop-update')"
                            id="documento_up"
                            ref="documento_up"
                            placeholder="Buscar Documento..."
                            drop-placeholder="Suelta el archivo aquí..."
                          ></b-form-file>
                      </div> 
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="descripción_suceso">Notas</label>
                        <textarea v-model="form.notas" id="descripción_suceso" class="form-control" :disabled="!can('sop-update')"></textarea>
                      </div> 
                    </div> 
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                 
                    <button
                      type="submit"
                      class="btn btn-warning mr-3 float-right"
                      :disabled="GuardandoCambios || !can('sop-update')"
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

      <div class="modal fade" id="AddSop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Agragar SOP
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
               
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="formfecha">Nombre</label>
                        <input v-model="form.nombre" id="formfecha" type="nombre" class="form-control" required>
                      </div>  
                            
                
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="formfecha">Fecha</label>
                        <input v-model="form.fecha" id="formfecha" type="date" class="form-control" required>
                      </div>  
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="documento">Documento</label>                        
                          <b-form-file 
                            id="documento"
                            ref="documento"
                            placeholder="Buscar Documento..."
                            drop-placeholder="Suelta el archivo aquí..."
                          ></b-form-file>
                      </div> 
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="descripción_suceso">Notas</label>
                        <textarea v-model="form.notas" id="descripción_suceso" class="form-control">
                        </textarea>
                      </div> 
                    </div> 
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                 
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
  </div>


</template>
<script>
    
    export default {
        data() {
          return {
            GuardandoCambios : false,
            fields: [ 
              { key: 'codigo', label: '#Id', sortable: true, sortDirection: 'ASC' },
              { key: 'nombre', label: 'Nombre', sortable: true, sortDirection: 'desc' },
              { key: 'fecha', label: 'Fecha', sortable: true, sortDirection: 'desc',                
                formatter: value => {
                return moment(value).format('DD/MM/YYYY');
                }
              },   
              { key: 'name_file', label: 'Archivo', sortable: true, sortDirection: 'desc' },
              { key: 'notas', label: 'Notas', sortable: true, sortDirection: 'desc' },
               { key: 'actions', label: 'Acciones' }
            ],  
            records: [],  
            form : {
              codigo : '',
              nombre : '',
              fecha : '',
              notas : '',
            }
          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 
          reset(){
            
            this.form = {
              codigo : '',
              nombre : '',
              fecha : '',
              notas : '',
            };
          },
         ButtonEdit(data) {
             this.form = data.data;
          },    

          ButtonDelete(data) {
            this.Borrar(data);
          },

          Buscar() {
            var url = '/admin/sop';
                axios.get(url).then(response=>{
                    this.records = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
        
          Borrar(data) {
            
              var _this = this;
              var registro = data.data;

              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea Eliminar el SOP?",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/sop/'+registro.id;

                      axios.post(url,{
                          _method: 'delete',                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('SOP Eliminado Correctamente');
                          
                        }

                        _this.Buscar();
                                      
                        
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                });

          },  

          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var documento = this.$refs.documento.files[0];
             
              let formData = new FormData();
  
              formData.append('url_file', documento);
               
              formData.append('fecha', this.form.fecha);
              formData.append('nombre', this.form.nombre);
              formData.append('notas', this.form.notas);
              
               var url = '/admin/sop'; 

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar Globo', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('SOP registrado Correctamente'); 
                  this.Buscar();
                  this.reset();
                }     


              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 

          ActualizarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var documento = this.$refs.documento_up.files[0];
             
              let formData = new FormData();
  
              formData.append('url_file', documento);
               
              formData.append('codigo', this.form.codigo);
              formData.append('fecha', this.form.fecha);
              formData.append('nombre', this.form.nombre);
              formData.append('notas', this.form.notas);
              formData.append('_method', 'put'); 

               var url = '/admin/sop/'+this.form.id; 
                
              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('SOP actualizado Correctamente'); 
                  this.Buscar();
                }     


              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 
      },
      
      computed: { 
        
      },


      };
    </script>
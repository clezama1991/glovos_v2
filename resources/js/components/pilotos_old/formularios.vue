<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-file text-dark"></i>
                Formularios
              </span>
          </h3>

        </div>
 
                <div class="card-body">
  
                  <div class="col-12 text-center pb-5">
                       <button @click="reset()" class="btn btn-primary" data-toggle="modal" :data-target="'#AsignarEntrenamiento'">
                          Asignar Entrenamientos 
                      </button>
 
                  </div>

                    <tabla-component :striped="true"
                        :fields="fields" 
                        :listado="records" 
                        titulo="Entrenamiento"  
                        @ButtonDelete="ButtonDelete"
                        @ButtonGo="ButtonGo"
                      ></tabla-component> 



                      <!-- <div class="row">
                        <div class="col-md-12 mb-3">
                          <h4 class="font-weight-bolder">Datos Personales</h4>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input v-model="form.nombres" id="nombres" type="text" class="form-control" required>
                          </div> 
                        </div> 
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input v-model="form.apellidos" id="apellidos" type="text" class="form-control" required>
                          </div> 
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="cedula">Identificación</label>
                            <input v-model="form.dni" id="cedula" type="text" class="form-control" required>
                          </div> 
                        </div>   
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="peso">Peso KGS</label>
                            <input v-model="form.peso" v-numero id="peso" type="text" class="form-control" required>
                          </div> 
                        </div>    
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input v-model="form.telefono" v-numero id="telefono" type="tel" class="form-control" required>
                          </div> 
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input v-model="form.email" id="email" type="text" class="form-control" required> 
                            <span class="form-text text-muted" v-if="!isEmailValid">Debe ingresar un email valido</span>
                          </div> 
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input v-model="form.direccion" id="direccion" type="text" class="form-control" required> 
                          </div> 
                        </div>
                        <div class="col-md-3 mb-3">
                          <div class="form-group">
                            <label for="nota">Notas</label>
                            <textarea v-model="form.nota" id="nota" type="text" class="form-control">
                            </textarea>
                          </div> 
                        </div> 
                    
                      </div> -->






                    </div>
  
        
        <div class="card-footer">
          <router-link to="/pilotos" class="btn btn-secondary mr-2">
            <i class="fa fa-undo"></i> Volver
          </router-link> 
        </div>

       
      </div>

    </div>

    <div class="modal fade" id="AsignarEntrenamiento" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Asignar Entrenamiento
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <form @submit="CrearEntrenamientoForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
                <div class="modal-body">
                  
                  <div class="row"> 
                        
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="formulario_id">Formularios</label>
                        <v-select 
                        v-model="form.formulario_id"
                        class="w-100"
                        id="formulario_id"
                        :reduce="nombre => nombre.id"
                        :options="Formularios" 
                        label="nombre">
                        </v-select>
                      </div> 
                    </div>   
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="globo_id">Globos</label>
                        <v-select 
                        v-model="form.globo_id"
                        class="w-100"
                        id="globo_id"
                        :reduce="nombre => nombre.id"
                        :options="Globos" 
                        :selectable="(option) => !option._rowVariant"
                        label="nombre">
                        </v-select>
                        <input type="checkbox" name="globo_no_existe" id="globo_no_existe" v-model="globo_no_existe"><label for="globo_no_existe">Globo no Registrado</label>
                      </div> 
                    </div>  
                    <div class="col-md-4" v-if="globo_no_existe">
                      <div class="form-group">
                        <label for="modelo_globo">Modelo Globo</label>
                        <input v-model="form.modelo_globo" id="modelo_globo" type="text" class="form-control">
                      </div> 
                    </div> 
                    <div class="col-md-4" v-if="globo_no_existe">
                      <div class="form-group">
                        <label for="marca_globo">Marca Globo</label>
                        <input v-model="form.marca_globo" id="marca_globo" type="text" class="form-control">
                      </div> 
                    </div>
                    <div class="col-md-4" v-if="globo_no_existe">
                      <div class="form-group">
                        <label for="matricula_globo">Matricula Globo</label>
                        <input v-model="form.matricula_globo" id="matricula_globo" type="text" class="form-control">
                      </div> 
                    </div>   
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="responsable">Responsable</label>
                        <input v-model="form.responsable" id="responsable" type="text" class="form-control">
                      </div> 
                    </div>   
 
                  </div>    
                              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold close2" data-dismiss="modal">Cerrar</button>
                    <button  type="submit" class="btn btn-warning" :disabled="GuardandoCambios">
                      <span v-if="GuardandoCambios">
                        <i class="fas fa-spinner fa-spin"></i> Guardando...
                      </span>
                      <span v-else>
                        Guardar
                      </span>
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
      props : ['id'],
        data() {
          return {
            GuardandoCambios : false,
            doc_licencia:false,
            globo_no_existe:false,
            form:{         
              globo_id : '',
              modelo_globo : '',
              marca_globo : '',
              matricula_globo : '',
              responsable : '',
              formulario_id : '',
              piloto_id : this.$route.params.id,
              estatus : 'Asignado',
              fecha : moment().format('YYYY-MM-DD'),
            },
            Formularios : [],
            Globos : [],
            piloto : '',
            records : [],
            fields: [ 
              { key: 'formulario.nombre', label: 'Formulario', sortable: true, sortDirection: 'desc' },
              { key: 'fecha', label: 'Fecha Asignación', sortable: true, sortDirection: 'desc' },
              { key: 'fecha_aplicacion', label: 'Fecha Aplicacion', sortable: true, sortDirection: 'desc' },
              { key: 'detail_globo', label: 'Globo', sortable: true, sortDirection: 'desc' },
              { key: 'responsable', label: 'Responsable', sortable: true, sortDirection: 'desc' },
              { key: 'estatus', label: 'Estatus', sortable: true, sortDirection: 'desc' },
              { key: 'actions_go', label: 'Acciones' }
            ],  
          }
        },
        mounted() {
          this.Buscar();
          this.BuscarFormularios();
          this.BuscarGlobos();
        },
        methods: { 
          
          
         ButtonGo(data) {
            this.$router.push({
                path: '/pilotos/formularios/'+this.$route.params.id+'/entrenamiento/'+data.data.id
            });
          },    

          ButtonDelete(data) {
            this.Borrar(data);
          },

          Borrar(data) {
          
            var _this = this;
            var registro = data.data;

             Swal.fire({
                title: "Confirmar!",
                text: "Confirme que desea Eliminar este entrenamiento",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/pilotos_entrenamiento/'+registro.id;

                    axios.post(url,{
                        _method: 'delete',                
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Entrenamiento Eliminado Correctamente');
                        
                      }

                      _this.Buscar();
                                    
                      
                    }).catch(error => {
                        console.log(error);
                        this.errors = error.response
                    });
                }
              });

        },  
          reset() {

            this.form = {         
              globo_id : '',
              modelo_globo : '',
              marca_globo : '',
              matricula_globo : '',
              responsable : '',
              formulario_id : '',
              piloto_id : this.$route.params.id,
              estatus : 'Asignado',
              fecha : moment().format('YYYY-MM-DD'),
            };
          },

          BuscarFormularios() {
            var url = '/admin/listado_formularios';
                axios.get(url).then(response=>{
                    this.Formularios = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
 
          BuscarGlobos() {
            var url = '/admin/listado_globos';
                axios.get(url).then(response=>{
                    this.Globos = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },

         Buscar() {
            var url = '/admin/piloto_con_entrenamineto/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.piloto = response.data.record; 
                this.records = response.data.record.entrenamientos; 
            }).catch(error => {
                this.errors = error.response.data
            });
          },

          CrearEntrenamientoForm(evt) {
              evt.preventDefault();            
              this.GuardandoCambios = !this.GuardandoCambios;
              var url = '/admin/pilotos_entrenamiento';
              axios.post(url,{
                formulario        :   this.form, 
                token         :   this.token
              }).then(response=>{              
                if(!response.data.result){
                  Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                  this.$toasted.error('Ha ocurrido algún error!');           
                }else{                 
                  this.$toasted.success('Pedido Creado Correctamente');    
                  
                  $("#AsignarEntrenamiento .close").click();
                  $("#AsignarEntrenamiento .close2").click();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();            

                }
                this.GuardandoCambios = !this.GuardandoCambios; 
                this.Buscar(); 
              }).catch(error => {
                  console.log(error);
                  this.errors = error.response
              });

          },  
    
      },
      
  
      computed: {  
    }


      };
    </script>
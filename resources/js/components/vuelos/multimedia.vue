<template>


  <div class="d-flex flex-column-fluid">
 
    <div class="container px-0"> 
       
      <div class="card card-custom mb-5">

      <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
            <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark"> 
            <i class="fa fa-picture-o text-dark"></i>                       
            Multimedias del Vuelo
            </span>
        </h3>

      </div>
 
        <div class="card-body">
      
          <div class="row">
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="fecha">Fecha</label>
                <input v-model="form.fecha" id="fecha" type="date" class="form-control" disabled>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="fecha">Globo</label>
                <input :value="(form.globo)?form.globo.nombre:''" id="fecha" type="text" class="form-control" disabled>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="fecha">Zona</label>
                <input :value="(form.zona)?form.zona.nombre:''" id="fecha" type="text" class="form-control" disabled>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="fecha">Piloto</label>
                <input :value="(form.piloto)?form.piloto.full_name:''" id="fecha" type="text" class="form-control" disabled>
              </div> 
            </div>
           
          </div> 
          
          <hr>

          <div class="row">
            <div class="col-12 text-center pb-5">
                <button class="btn btn-sm btn-primary mr-2" data-toggle="modal" :data-target="'#AddMult'">                    
                  <i class="flaticon-plus"></i> Añadir Multimedia
                </button>  



            </div>
          </div>
          
<Transition>
          <p v-if="loading"></p>
          <div v-else class="row"> 
            <div class="col-md-3 col-12" v-for="(item, index) in form.multimedias" :key="index">
              <div class="card card-custom gutter-b card-stretch  shadow-none" style="background:none">
                <div class="card-body d-flex flex-column rounded justify-content-between p-5  shadow">
                  <div class="text-center rounded h-100" :style="'background:url('+ ((item.extension!='mp4') ? item.carpeta : 'images/video_multimedia.png') +'); background-size:cover; min-height: 200px; '">
                    <h4 class="text-right p-2">
                      <a role="button" @click="borrar_multimedia(item.id)">
                        <i class="fa fa-times p-1 px-2 bg-secondary rounded-circle" aria-hidden="true"></i>
                        </a>
                    </h4>
                  </div> 
                </div>
              </div>
            </div>  
          </div> 
          
        </Transition>
      </div>
      
        <div class="card-footer">
          <router-link to="/vuelos" class="btn btn-secondary mr-2">
            <i class="fa fa-undo"></i> Volver
          </router-link> 

          <div class="float-right d-block" v-if="form.multimedias && form.multimedias.length>0">

          <button @click="MultimediaVuelo()" class="btn mr-2 float-right" :class="{'btn-success':form.multimedia,'btn-warning':!form.multimedia }">
            <span v-if="form.multimedia">
              <i class="fa fa-eye-slash" aria-hidden="true"></i> Deshabilitar multimedia
            </span>
            <span v-else>
              <i class="fa fa-eye" aria-hidden="true"></i> Habilitar multimedia
            </span>
          </button> <br><br>
          <span class="text-success  float-right"  v-if="form.multimedia">

            <i class="fa fa-calendar" aria-hidden="true"></i> Multimedia disponible hasta <br> el {{form.multimedia_caduca | formatDate}}

          </span>
          </div>


          <button @click="MultimediaLimpiar()"  v-if="form.multimedias && form.multimedias.length>0" class="btn mr-2 float-right btn-danger" >
            <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar todos los multimedias
          </button>

            <div class="float-right d-block">

          <button data-toggle="modal" :data-target="'#SendNotifications'" v-if="form.multimedias && form.multimedias.length>0" class="btn mr-2 float-right btn-info" >
            <i class="fa fa-bell" aria-hidden="true"></i> Enviar Notificaciones
          </button>
           <br><br>
          <span class="text-success"  v-if="form.multimedia_notification_pedidos">

            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Notificaciones Enviadas

          </span>

 
        </div>
        </div>



       
      </div>

    </div>

    <div class="modal fade" id="AddMult" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Carga Multimedias
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <b-overlay :show="show" rounded="sm">
               <div class="modal-body" id="imgtablacarga">  
                <div class="form-group">
                  <label for="">Seleccione uno o varios multimedias</label>
                  <input type="file" ref="file" multiple name="" id="fileMultimedia" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Maximo permitidos a la vez: 10 Multimedias</small>
                </div>  
              </div>
              <div class="card-footer">                    
                <button type="button" class="btn btn-light-primary font-weight-bold close2" data-dismiss="modal">Cerrar</button>
                
              <button
                type="button"  @click="submitFiles()"
                class="btn btn-primary mr-3 float-right"
                :disabled="GuardandoCambios"
              >
                <span v-if="GuardandoCambios">
                  <i class="fas fa-spinner fa-spin"></i> Cargando...
                </span>
                <span v-else> <i class="fa fa-save"></i> Cargar </span>
              </button>


               </div>

               <template #overlay>
                <div class="text-center" style="width: 480px;"> 
                  <i class="fa fa-upload" aria-hidden="true"></i> Subiendo Multimedias...
                  <b-progress class="mt-2"  height="30px"  max="100" show-progress v-if="GuardandoCambios">
                    <b-progress-bar  :label="`${uploadPercentage}%`" :value="uploadPercentage" :variant="uploadPercentageCompleted"  striped="true" animated="true"></b-progress-bar>
                  </b-progress> 
                </div>
              </template>

    </b-overlay>
           </div>
      </div>
    </div>

    <div class="modal fade" id="SendNotifications" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Enviar Notificaciones Por Correo
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
            
        <form @submit="SendNotifications" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
               <div class="modal-body" id="imgtablacarga">  
                <div class="form-group">
                  <label for="">Seleccione el formato del mensaje</label>
                  <select class="form-control form-control-sm" v-model="formato" required :disabled="GuardandoCambiosSend">
                    <option value="media_available_format_1">Formato 1</option>
                    <option value="media_available_format_2">Formato 2</option>
                    <option value="media_available_format_3">Formato 3 - Whatsapp</option>
                   </select>
                </div>  


                <div class="form-group">
                  <label for="">Seleccione los pedidos</label>
                  <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Contactos</th>
                      <th></th>
                    </tr>

                  </thead>
                  <tbody> 
                    <tr
                      v-for="(pedido, index_pedido) in form.pedidos" :key="index_pedido"
                    >
                      <td>
                        <b-form-checkbox
                          :id="pedido.orden_wordpress"
                          v-model="pedidos_notificaciones"
                          name="checkbox-1"
                          :value="pedido.id"
                         >
                         </b-form-checkbox>
                      </td>
                      <td><i class="fa fa-check text-warning" aria-hidden="true" v-if="pedido.multimedia_notification"></i></td>
                      <td>
                        {{ pedido.orden_wordpress }}
                      </td>
                      <td>
                        {{ pedido.nombre_contacto }}
                      </td>
                      <td>
                        {{ pedido.email_contacto }} <br>
                        {{ pedido.telefono_contacto }}
                      </td>
                      <td>
                         <a class=" 
                            label-inline
                            label label-secondary "
                            v-if="formato==''"
                          >                                
                            <i class="fab fa-whatsapp text-white mr-2" aria-hidden="true"></i>
                            Enviar Formulario
                          </a>
                          <p class="text-muted" v-if="formato==''">Seleccione Formato</p>
                         <a :href="'/admin/pedidos_enviar_multimedia/'+pedido.id+'/'+formato" target="_blank" class=" 
                            label-inline
                            label label-primary "
                            v-else
                          >                                
                            <i class="fab fa-whatsapp text-white mr-2" aria-hidden="true"></i>
                            Enviar Formulario
                          </a>
                        </td>
                    </tr>
                  </tbody>
                </table></div>
                </div>
                <div class="text-center" v-if="GuardandoCambiosSend"> 
                  <i class="fa fa-envelop" aria-hidden="true"></i> Enviando Mensajes... 
                  <b-progress :value="100" animated="true" variant="success" height="30px" striped="true" class="mt-2"></b-progress>
                </div>
 
              </div>
              <div class="card-footer">                    
                <button type="button" class="btn btn-light-primary font-weight-bold close2" data-dismiss="modal">Cerrar</button>                
                <button
                  type="submit"
                  class="btn btn-primary mr-3 float-right"
                  :disabled="GuardandoCambiosSend"
                >
                  <span v-if="GuardandoCambiosSend">
                    <i class="fas fa-spinner fa-spin"></i> Cargando...
                  </span>
                  <span v-else> <i class="fa fa-envelope" aria-hidden="true"></i> Enviar Notificaciones por correo </span>
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
            pedidos_notificaciones : [],
            GuardandoCambios : false,
            GuardandoCambiosSend : false,
          show: false,
          uploadPercentageCompleted: 'primary',
            loading : true,
            form:{},
				    uploadPercentage: 0,
				    uploadFile: false,
				    formato: '',
          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 
 
          MultimediaVuelo() {            
            var url = '/admin/multimedia_vuelos/'+this.form.id+'/'+((this.form.multimedia)?0:1);
            axios.get(url).then(response=>{
              this.Buscar();        
              window.location.reload(true); 
            }).catch(error => {
                this.errors = error.response.data
            });
          },
          submitFiles() {
              this.GuardandoCambios = true;
              this.show = true;
              this.uploadPercentage = 0;
              let formData = new FormData();
              formData.append('vuelo_id', this.form.id);
              for( var i = 0; i < this.$refs.file.files.length; i++ ){
                  let file = this.$refs.file.files[i];
                  formData.append('files[' + i + ']', file);
              }


              axios.post('/admin/multimedias', formData, {
                  headers: {
                      'Content-Type': 'multipart/form-data'
                  },
                  onUploadProgress: function( progressEvent ) {
                    this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ) );
                  }.bind(this)
                }).then(response=>{
                      
                      this.uploadPercentageCompleted = 'success';

                      setTimeout(() => {
                        
                        this.Buscar();            
                        $("#AddMult .close").click(); 
                        $("#AddMult .close2").click(); 
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        
                        $("#fileMultimedia").val(null);
                        this.GuardandoCambios = false;
                        this.show = false;

                      }, 3000);



                }).catch(error => {
                    console.log(error);
                    this.errors = error.response
                });
                    
                
          },
 
          reset() {
 
            this.$refs['file'].reset();
            this.$refs['form_tabla_carga'].reset();

          },
          
          
         Buscar() {
            this.loading = true;
            this.form = {};
            var url = '/admin/vuelos/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.form = response.data.record; 
                this.loading = false;
            }).catch(error => {
                this.errors = error.response.data
            });



        },

        borrar_multimedia(id) {

            var _this = this;
              
             Swal.fire({
                title: "Confirmar!",
                text: "Confirme que desea borrar este archivo multimedia!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/multimedias/'+id;

                    axios.post(url,{
                        _method: 'DELETE',                 
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Multimedias actualizados Correctamente');
 
                        if(_this.form.multimedias.length==1){
                          _this.form.multimedia = 1;
                          _this.MultimediaVuelo();
                        }

                        _this.Buscar(); 

                      }
   
                    }).catch(error => {
                        console.log(error);
                        this.errors = error.response
                    });
                }
              });

        },  

        MultimediaLimpiar() {

            var _this = this;
              
             Swal.fire({
                title: "Confirmar!",
                text: "Confirme que desea borrar todos los archivos multimedias!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/multimedias_borrar_todos/'+_this.form.id;

                    axios.post(url,{              
                        token         :   _this.token
                    }).then(response=>{
                      console.log(response);
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Multimedias borrados Correctamente');
                        _this.Buscar(); 
                      }

                      _this.MultimediaVuelo();

                    }).catch(error => {
                        console.log(error);
                        this.errors = error.response
                    });
                }
              });

        },  
   
          SendNotifications(evt) {

            evt.preventDefault();
    
              this.GuardandoCambiosSend = !this.GuardandoCambiosSend;
              
               var url = '/admin/multimedias_send_notificatins';
                axios.post(url,{              
                    formato         :   this.formato,
                    vuelo_id         :   this.form.id,
                    pedidos_notificaciones         :   this.pedidos_notificaciones
                }).then(response=>{ 
                  this.GuardandoCambiosSend = !this.GuardandoCambiosSend;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar Vuelo', 'Error en Proceso...');       
                  }else{                
                    this.$toasted.success('Correos Enviados Correctamente'); 
                     
                    $("#SendNotifications .close").click(); 
                    $("#SendNotifications .close2").click(); 
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    this.pedidos_notificaciones = [];         
                    this.Buscar();         

                    
                  }      
              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 
      },
      
  
      computed: { 
 
         
    },

      watch: {
      },


      };
    </script>
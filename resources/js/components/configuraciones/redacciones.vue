<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-cogs text-dark"></i>
              Redacciones Globales para la plataforma
              </span>
          </h3>

        </div>
 
        <div class="card-body">
           
 
   <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
           <div v-for="(item, title) in records" :key="title">

          <div class="row">

            
          <div class="col-md-12 mb-3">
            <h3 class="font-weight-bolder"> {{title}}</h3>
          </div>

          <div class="col-md-12 mb-3" v-for="(item, index) in item" :key="index">
 
            <label class="h4" :for="item.key">
                {{item.nombre}} 



                <span class="badge badge-primary badge-pill" role="button"  data-toggle="modal" :data-target="'#'+item.key">
                  <i class="fa fa-question text-white" role="button"></i> Ver Detalles
                </span>
            </label>

            <editor
                :api-key="api_key"
                cloud-channel="5-dev"
                :init="option"
                v-model="item.valor"
            /> 
 
 
            <div class="py-5">
            <hr>
            </div>


            <!-- Modal -->
            <div class="modal fade" :id="item.key" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{item.nombre}} </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                     {{item.descripcion}} 
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div> 
          </div> 
          
          
          </div>


        <div class="row" v-if="updated">
          <div class="col-md-12">
            <div class="form-group mb-8">
														<div class="alert alert-custom alert-default text-danger h6" role="alert">
															<div class="alert-icon"> 
    <i class="fas fa-exclamation-triangle text-danger"></i>   
     
															</div>
															<div class="alert-text">
                                Para poder visualizar los cambios debe recargar la plataforma
                                
                                <a href="javascript:location.reload()" class="text-weight-bolder">Recargar aqui!</a>

                                </div>
														</div>
													</div>
          </div>
        </div>

        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold close2" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-warning" :disabled="GuardandoCambios">
                      <span v-if="GuardandoCambios">
                        <i class="fas fa-spinner fa-spin"></i> Registrando...
                      </span>
                      <span v-else>
                        Actualizar
                      </span>
                    </button>
                </div>
       
          </form>
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

  </div>


</template>
<script>
    
 import Editor from '@tinymce/tinymce-vue'
    export default {
        components: {
            'editor': Editor
        },
        data() {
          return {        
            api_key:'4uqg5bfl6an0lmdfdghkap4yfejy8ovqglkfaahssobrd8mv',
            option:{
                height: 250,
                menubar: false,
                plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
                ],
                toolbar:
                'undo redo | formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat | help'
            }, 

            files: [],  
            records: [],  
            GuardandoCambios : false,
            updated : false,
          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 
            Buscar() {
                var url = '/admin/configs_by_grupo/Correos';
                axios.get(url).then(response=>{
                    this.records = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
            }, 
            
            
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.updated = false;
              this.GuardandoCambios = !this.GuardandoCambios;
              
              let formData = new FormData(); 

              var obj = this.records;

                for (const prop in obj) {

                // console.log(`obj.${prop} = ${obj[prop]}`);

                obj[prop].forEach(element => {
                    if(element.tipo=='file'){
                      formData.append(element.key, this.files[element.key]);            
                    }else{
                      formData.append(element.key, element.valor);            
                    }   
                });  

              }

 


              // this.records.forEach(grupo => {        
              // });              

              console.log(formData);


              var url = '/admin/update_configs';

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                    
                  console.log(response.data);
                if(!response.data.result){
                  Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error +response.data.mensaje_error , "error");
                  this.$toasted.error('Ha ocurrido algún error!');           
                }else{           

                  this.$toasted.success('Información Registrada Correctamente');

                }

                this.updated = true;
                this.GuardandoCambios = !this.GuardandoCambios;

              }).catch(error => {
                  this.errors = error.response.data
              });                

        },


      },
      
      computed: { 
        
      },


      };
    </script>
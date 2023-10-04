<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-cogs text-dark"></i>
              Configuraciones Globales para la plataforma
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

          <div class="col-md-4 mb-3" v-for="(item, index) in item" :key="index">
            <div class="form-group">
              <label class="" :for="item.key">
                {{item.nombre}} 
                <i class="fa fa-question text-warning" role="button" :title="item.descripcion"></i>
              </label>
              
                <div v-if="item.tipo=='text' || item.tipo=='color' || item.tipo=='email' || item.tipo=='number' || item.tipo=='date'">
                  <input class="form-control" :type="item.tipo" v-model="item.valor" :id="item.key">
                </div>
                <div v-if="item.tipo=='textarea'">
                  <textarea class="form-control" v-model="item.valor" :id="item.key" rows="2"></textarea>
                </div>
                <div v-if="item.tipo=='file'">
                    <b-form-file 
                      :id="item.key"
                      v-model="files[item.key]"
                      placeholder="Buscar Archivo..."
                      drop-placeholder="Suelta el archivo aquí..."
                    ></b-form-file>
                    <a :href="item.valor" v-if="item.valor!=null" target="_blank" class="ml-2 mt-2 badge badge-primary badge-pill" title="Ver"> Ver</a>
                    <span v-else class="ml-2 mt-2 badge badge-danger badge-pill"> Sin Doc. </span>
                </div>
              <!-- <div class="col-2">
                {{item.descripcion}}
              </div> -->
            </div>
          </div> 
          </div> 
          
          
          <div class="col-md-12 mb-3">
           <hr>
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
    
    export default {
        data() {
          return {
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
                var url = '/admin/configs';
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
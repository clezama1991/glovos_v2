<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-cloud text-dark"></i>

                Registrar Tipo Nubosidad
              </span>
          </h3>

        </div>
 
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
    
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="codigo">Código</label>
                <input v-model="form.codigo" id="codigo" type="text" class="form-control" required>
              </div> 
            </div>    
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="nombres">Nombre</label>
                <input v-model="form.nombre" id="nombres" type="text" class="form-control" required>
              </div> 
            </div>    
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input v-model="form.descripcion" id="descripcion" type="text" class="form-control" required>
              </div> 
            </div>     
          </div> 
          
        </div>

        
        <div class="card-footer">
          <router-link to="/configuraciones/tipo_nubosidad" class="btn btn-secondary mr-2">
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
            form:{         
              codigo : '',
              nombre : '',
              descripcion : '',
            },

          }
        },
        mounted() {
          // this.Buscar();
        },
        methods: { 
 
          reset() { 
            this.form  = {   
              codigo : '',
              nombre : '',
              descripcion : '',
            };
 
          },
 
 
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              
              let formData = new FormData();
  
              formData.append('codigo', this.form.codigo);
              formData.append('nombre', this.form.nombre);
              formData.append('descripcion', this.form.descripcion);

               var url = '/admin/configuracion/tipo_nubosidad';

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Información Registrada Correctamente');                  
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
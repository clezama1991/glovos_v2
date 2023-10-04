<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-cloud text-dark"></i>

                Consultar Tipo Nubosidad
              </span>
          </h3>

        </div>
 
    <form @submit="ActualizarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
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
                <label for="descripcion">Nombre</label>
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
            v-if="can('types_of_clouds-update')"
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


</template>
<script>
    
    export default {
      props : ['id'],
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
          this.Buscar();
          this.ValidarPermisos('types_of_clouds-update');
        },
        methods: { 
 
          ValidarPermisos(permiso) {
            if(!this.can(permiso)){
              $(":input").prop("disabled", true);
            }
          },
          reset() {
 
          },
         Buscar() {
            var url = '/admin/configuracion/tipo_nubosidad/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.form = response.data.record; 

            }).catch(error => {
                this.errors = error.response.data
            });
        },

          ActualizarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
          
              let formData = new FormData();
  
              formData.append('codigo', this.form.codigo);
              formData.append('nombre', this.form.nombre);
              formData.append('descripcion', this.form.descripcion);
              formData.append('_method', 'put'); 

               var url = '/admin/configuracion/tipo_nubosidad/'+this.$route.params.id;

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al actualizar Registro', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Registro Actualizado Correctamente');              
                
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
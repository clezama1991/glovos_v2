<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-user text-dark"></i>

                Registrar Soguillas
              </span>
          </h3>

        </div>
 
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
    
          <div class="row">
            <div class="col-md-4 mb-3 d-none">
              <div class="form-group">
                <label for="dni">Dni</label>
                <input v-model="form.dni" id="dni" type="text" class="form-control">
              </div> 
            </div>    
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="nombres">Nombres</label>
                <input v-model="form.nombres" id="nombres" type="text" class="form-control" required>
              </div> 
            </div>   
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input v-model="form.apellidos" id="apellidos" type="text" class="form-control" required>
              </div> 
            </div>   
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="email">Email</label>
                <input v-model="form.email" id="email" type="email" class="form-control" required>
              </div> 
            </div>   
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input v-model="form.telefono" id="telefono" type="text" class="form-control" required>
              </div> 
            </div>   
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="pin">P.I.N</label>
                <input v-model="form.pin" id="pin" type="text" class="form-control" required>
              </div> 
            </div>   
            <div class="col-md-4 mb-5">
              <div class="form-check">
                <label class="form-check-label">
                  <input  v-model="form.activo" type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                  Activo
                </label>
              </div>
            </div>
            <div class="col-md-12 mb-3">
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

        
        <div class="card-footer">
          <router-link to="/configuraciones/soguillas" class="btn btn-secondary mr-2">
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
              dni : '',
              nombres : '',
              apellidos : '',
              email : '',
              telefono : '',
              pin : '',
              activo : '',
              notas : '',
            },

          }
        },
        mounted() {
          // this.Buscar();
        },
        methods: { 
 
          reset() { 
            this.form  = {   
              dni : '',
              nombres : '',
              apellidos : '',
              email : '',
              telefono : '',
              pin : '',
              activo : '',
              notas : '',
            };
 
          },
 
 
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              
              let formData = new FormData();
  
              formData.append('dni', this.form.dni); 
              formData.append('nombres', this.form.nombres); 
              formData.append('apellidos', this.form.apellidos); 
              formData.append('email', this.form.email); 
              formData.append('telefono', this.form.telefono); 
              formData.append('pin', this.form.pin); 
              formData.append('activo', this.form.activo); 
              formData.append('notas', this.form.notas); 

               var url = '/admin/configuracion/soguillas';

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
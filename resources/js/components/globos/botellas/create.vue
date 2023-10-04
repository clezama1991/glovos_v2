<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-lightbulb text-dark"></i>
              Registrar Botella
              </span>
          </h3>

        </div>
 
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
                    
          <div class="row"> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="codigo">Código</label>
                <input v-model="form.codigo" id="codigo" type="text" class="form-control" required>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="fabricante">Fabricante</label>
                <input v-model="form.fabricante" id="fabricante" type="text" class="form-control" required>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="modelo">Modelo</label> 
                <input v-model="form.modelo" id="modelo" type="text" class="form-control" required>
              </div> 
            </div>   
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="peso">Peso</label>
                <input v-model="form.peso" id="peso" type="text" v-numero class="form-control" required>
              </div> 
            </div>   
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="capacidad">Capacidad</label>
                <input v-model="form.capacidad" id="capacidad" type="text" v-numero class="form-control" required>
              </div> 
            </div>   
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="nro_serie">Nro de serie</label>
                <input v-model="form.nro_serie" id="nro_serie" type="text" class="form-control" required> 
              </div> 
            </div> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="CRS">CRS</label>
                <input v-model="form.CRS" id="CRS" type="date" class="form-control" required> 
              </div> 
            </div> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="PVR">PVR</label>
                <input v-model="form.PVR" id="PVR" type="date" class="form-control" required> 
              </div> 
            </div>  
            <div class="col-md-9 mb-3">
              <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea v-model="form.observaciones" id="observaciones" type="text" class="form-control">
                </textarea>
              </div> 
            </div> 
          </div> 
          
        </div>

        
        <div class="card-footer">
          <router-link to="/globos/botellas" class="btn btn-secondary mr-2">
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
              matricula : '',
              fabricante : '',
              peso : '',
              capacidad : '',
              nro_serie : '',
              CRS : '',
              PVR : '',
              observaciones : '',
            },
          }
        },
        mounted() { 
        },
        methods: { 
  
          reset() {


            this.form  = {         
              codigo : '',
              matricula : '',
              fabricante : '',
              peso : '',
              capacidad : '',
              nro_serie : '',
              CRS : '',
              PVR : '',
              observaciones : '',
            };
  
          },
 
 
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;

              
                var url = '/admin/globo_botellas';
                axios.post(url,{
                    formulario : this.form,                         
                }).then(response=>{ 
                  if(!response.data.result){
                    Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                    this.$toasted.error('Ha ocurrido algún error!');           
                  }else{                 
                    this.$toasted.success('Botella Registrado Correctamente');
                    this.reset();
                  }
                  this.GuardandoCambios = !this.GuardandoCambios;
                }).catch(error => {
                    console.log(error);
                    this.errors = error.response
                });
            

        }, 

      },
      
  
      computed: { 
         
        dateNow(){
          return moment().format('YYYY-MM-DD');
        },   
    }


      };
    </script>
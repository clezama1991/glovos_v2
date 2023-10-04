<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-lightbulb text-dark"></i>
              Consultar Cesta
              </span>
          </h3>

        </div>
 
    <form @submit="ActualizarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
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
                <label for="max_pasajero">Nro Maximo Pasajero</label>
                <input v-model="form.max_pasajero" id="max_pasajero" v-numero class="form-control" required> 
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
          <router-link to="/globos/cestas" class="btn btn-secondary mr-2">
            <i class="fa fa-undo"></i> Volver
          </router-link>

          <button
          v-if="can('balloons_baskets-update')"
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
              matricula : '',
              fabricante : '',
              peso : '',
              nro_serie : '',
              CRS : '',
              max_pasajero : '',
              observaciones : '',
            },        
          } 
        }, 

        mounted() 
        {
          this.Buscar();
          this.ValidarPermisos('balloons_baskets-update');
        },
        methods: { 
  
          ValidarPermisos(permiso) {
            if(!this.can(permiso)){
              $(":input").prop("disabled", true);
            }
          },
         Buscar() {
            var url = '/admin/globo_cestas/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.form = response.data.record;  
            }).catch(error => {
                this.errors = error.response.data
            });
        },

          ActualizarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
            var url = '/admin/globo_cestas/'+this.$route.params.id;; 

            axios.post(url,{
                _method : 'PUT',                         
                formulario : this.form,                         
            }).then(response=>{ 
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Cesta Actualizado Correctamente'); 
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
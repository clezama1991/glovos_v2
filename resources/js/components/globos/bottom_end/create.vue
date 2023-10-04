<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-lightbulb text-dark"></i>
              Registrar Bottom End
              </span>
          </h3>

        </div>
 
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
                    
          <div class="row"> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="form.nombre" id="nombre" type="text" class="form-control" required>
              </div> 
            </div>
           
            <div class="col-md-9 mb-3">
              <div class="form-group">
                <label for="compatibilidad_globos_ids">Globos Compatibles </label>
                <v-select 
                  multiple
                  v-model="form.compatibilidad_globos_ids"
                  class="w-100"
                  id="compatibilidad_globos_ids"
                  :reduce="nombre => nombre.id"
                  :options="globos" 
                  label="nombre">    
                  <template #search="{ attributes, events }">
                      <input
                      class="vs__search"
                      :required="!form.compatibilidad_globos_ids"
                      v-bind="attributes"
                      v-on="events"
                      />
                  </template>

                </v-select>
              </div> 
            </div> 
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="quemador_id">Quemador </label>
                <v-select 
                  v-model="form.quemador_id"
                  class="w-100"
                  id="quemador_id"
                  :reduce="modelo_name => modelo_name.id"
                  :options="quemadores" 
                  :selectable="(option) => !option._rowVariant"
                  label="modelo_name">    
                  <template #option="{ modelo_name, fabricante }">
                    <h6 style="margin: 0">{{ modelo_name }}</h6>
                    <em>{{ fabricante}}</em>
                  </template> 
                  <template #search="{ attributes, events }">
                      <input
                      class="vs__search"
                      :required="!form.quemador_id"
                      v-bind="attributes"
                      v-on="events"
                      />
                  </template>

                </v-select>
              </div> 
            </div> 
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="cesta_id">Cesta </label>
                <v-select 
                  v-model="form.cesta_id"
                  class="w-100"
                  id="cesta_id"
                  :reduce="modelo_name => modelo_name.id"
                  :options="cestas" 
                  :selectable="(option) => !option._rowVariant"
                  label="modelo_name">    
                  <template #option="{ modelo_name, fabricante }">
                    <h6 style="margin: 0">{{ modelo_name }}</h6>
                    <em>{{ fabricante}}</em>
                  </template> 
                  <template #search="{ attributes, events }">
                      <input
                      class="vs__search"
                      :required="!form.cesta_id"
                      v-bind="attributes"
                      v-on="events"
                      />
                  </template>

                </v-select>
              </div> 
            </div> 
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="botella_id">Botella </label>
                <v-select 
                  v-model="form.botella_id"
                  class="w-100"
                  multiple
                  id="botella_id"
                  :reduce="modelo_name => modelo_name.id"
                  :options="botellas" 
                  :selectable="(option) => !option._rowVariant"
                  label="modelo_name">   
                  <template #option="{ modelo_name, fabricante }">
                    <h6 style="margin: 0">{{ modelo_name }}</h6>
                    <em>{{ fabricante}}</em>
                  </template> 
                  <template #search="{ attributes, events }">
                      <input
                      class="vs__search"
                      :required="!form.botella_id"
                      v-bind="attributes"
                      v-on="events"
                      />
                  </template> 
                </v-select>
              </div> 
            </div> 
          </div>  
        </div> 
        <div class="card-footer">
          <router-link to="/globos/bottom_end" class="btn btn-secondary mr-2">
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
              nombre : '',
              compatibilidad_globos_ids : '',
              cesta_id : '',
              quemador_id : '',
              botella_id : []
            },
            globos : [],
            quemadores : [],
            cestas : [],
            botellas : [],
          }
        },
        mounted() { 
          this.BuscarGlobos();
          this.BuscarQuemadores();
          this.BuscarBotellas();
          this.BuscarCestas();
        },
        methods: {   
          BuscarGlobos() {
            var url = '/admin/listado_globos';
                axios.get(url).then(response=>{
                    this.globos = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
 
          BuscarQuemadores() {
            var url = '/admin/globo_quemadores';
                axios.get(url).then(response=>{
                    this.quemadores = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
          BuscarBotellas() {
            var url = '/admin/globo_botellas';
                axios.get(url).then(response=>{
                    this.botellas = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
          BuscarCestas() {
            var url = '/admin/globo_cestas';
                axios.get(url).then(response=>{
                    this.cestas = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          }, 

          RegistarForm(evt) {

            evt.preventDefault(); 
              this.GuardandoCambios = !this.GuardandoCambios; 
                var url = '/admin/globo_bottom_end';
                axios.post(url,{
                    formulario : this.form,                         
                }).then(response=>{ 
                  if(!response.data.result){
                    Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                    this.$toasted.error('Ha ocurrido algún error!');           
                  }else{                 
                    this.$toasted.success('Bottom End Actualizado Correctamente');
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
<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-lightbulb text-dark"></i>
              Consultar Bottom End
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

                <select class="form-control" id="selectpicker_globos" required data-live-search="true" v-model="form.compatibilidad_globos_ids" multiple>
                  <option value="">Seleccione</option>
                  <option :value="item.id" v-for="(item, index) in globos" :key="index">{{item.nombre}}</option>
                </select>
              </div> 
            </div> 
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="quemador_id">Quemador </label>
                <select class="form-control" id="selectpicker_quemadores" required data-live-search="true" v-model="form.quemador_id">
                  <option value="">Seleccione</option>
                  <option :value="item.id" v-for="(item, index) in quemadores" :key="index" :disabled="item._rowVariant">{{item.modelo_name}} {{item.fabricante}} </option>
                </select>
              </div> 
            </div> 
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="cesta_id">Cesta </label>
                <select class="form-control" id="selectpicker_cestas" required data-live-search="true" v-model="form.cesta_id">
                  <option value="">Seleccione</option>
                  <option :value="item.id" v-for="(item, index) in cestas" :key="index" :disabled="item._rowVariant">{{item.modelo_name}} {{item.fabricante}} </option>
                </select>
              </div> 
            </div> 
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="botella_id">Botella </label>
                <select class="form-control" id="selectpicker_botellas" required data-live-search="true" v-model="form.botella_id" multiple>
                  <option value="">Seleccione</option>
                  <option :value="item.id" v-for="(item, index) in botellas" :key="index" :disabled="item._rowVariant">{{item.modelo_name}} {{item.fabricante}} </option>
                </select>
              </div> 
            </div> 
          </div>  
        </div> 
        <div class="card-footer">
          <router-link to="/globos/bottom_end" class="btn btn-secondary mr-2">
            <i class="fa fa-undo"></i> Volver
          </router-link>

          <button
          v-if="can('bottom_end-update')"
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
              nombre : '',
              compatibilidad_globos_ids : [],
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
          this.Buscar();
          this.BuscarGlobos();
          this.BuscarQuemadores();
          this.BuscarBotellas();
          this.BuscarCestas();
          this.ValidarPermisos('bottom_end-update');
        },
        methods: { 
   

          ValidarPermisos(permiso) {
            if(!this.can(permiso)){
              $(":input").prop("disabled", true);
            }
          },
         Buscar() {
            var url = '/admin/globo_bottom_end/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.form = response.data.record;  
            }).catch(error => {
                this.errors = error.response.data
            });
        },
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
              var url = '/admin/globo_bottom_end/'+this.$route.params.id;

              axios.post(url,{
                _method : 'PUT',            
                formulario : this.form,                         
              }).then(response=>{ 
                if(!response.data.result){
                  Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                  this.$toasted.error('Ha ocurrido algún error!');           
                }else{                 
                  this.$toasted.success('Bottom End actualizado Correctamente');
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
    },
      watch: {
        globos: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_globos').selectpicker('refresh'); });
        },
        quemadores: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_quemadores').selectpicker('refresh'); });
        },
        cestas: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_cestas').selectpicker('refresh'); });
        },
        botellas: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_botellas').selectpicker('refresh'); });
        },
      }


      };
    </script>
<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-lightbulb text-dark"></i>
                Listado de Modelos de Globos

              </span>

              <router-link 
                to="/globos/modelos/crear"
                v-if="can('balloons_model-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar Modelos </span>
              </router-link>
            </h3>
          </div> 
 
        <div class="card-body">
          <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            titulo="Modelo de globos"
            :can_ver="can('balloons_model-read')"
            :can_editar="can('balloons_model-update')"
            :can_eliminar="can('balloons_model-delete')"   
            @ButtonSetStatus="ButtonSetStatus"
            @ButtonDelete="ButtonDelete"
            @ButtonGo="ButtonGo"
          ></tabla-component> 
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
            fields: [ 
              { key: 'modelo_globo', label: 'Nombre', sortable: true, sortDirection: 'desc' },
              { key: 'fift_inits_10', label: '10', sortable: false },
              { key: 'fift_inits_11', label: '11', sortable: false },
              { key: 'fift_inits_12', label: '12', sortable: false },
              { key: 'fift_inits_13', label: '13', sortable: false },
              { key: 'fift_inits_14', label: '14', sortable: false },
              { key: 'fift_inits_15', label: '15', sortable: false },
              { key: 'fift_inits_16', label: '16', sortable: false },
              { key: 'fift_inits_17', label: '17', sortable: false },
              { key: 'fift_inits_18', label: '18', sortable: false },
              { key: 'fift_inits_19', label: '19', sortable: false },
              { key: 'fift_inits_20', label: '20', sortable: false },
              { key: 'fift_inits_21', label: '21', sortable: false },
              { key: 'fift_inits_22', label: '22', sortable: false },
              { key: 'fift_inits_23', label: '23', sortable: false },     
              { key: 'actions_go', label: 'Acciones' }
            ],  
            records: [],  
          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 

         ButtonGo(data) {
            this.$router.push({
                path: '/globos/modelos/consultar/'+data.data.id
            });
          },    

          ButtonDelete(data) {
            this.Borrar(data);
          },

          Buscar() {
            var url = '/admin/tabla_carga';
                axios.get(url).then(response=>{
                    this.records = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
        
          Borrar(data) {
            
              var _this = this;
              var registro = data.data;

              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea Eliminar este registro?",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/tabla_carga/'+registro.id;

                      axios.post(url,{
                          _method: 'delete',                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Globo Eliminado Correctamente');
                          
                        }

                        _this.Buscar();
                                      
                        
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                });

          },  

      },
      
      computed: { 
        
      },


      };
    </script>
<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-lightbulb text-dark"></i>
              Listado de Quemadores

              </span>

              <router-link 
                to="/globos/quemadores/crear"
                v-if="can('balloons_burners-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar Quemador </span>
              </router-link>
            </h3>
          </div> 

        <div class="card-body">
          
         <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            titulo="Quemador"
            :can_ver="can('balloons_burners-read')"
            :can_editar="can('balloons_burners-update')"
            :can_eliminar="can('balloons_burners-delete')" 
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
              { key: 'codigo', label: 'Código', sortable: true, sortDirection: 'desc' },
              { key: 'fabricante', label: 'Fabricante', sortable: true, sortDirection: 'desc' },
              { key: 'modelo', label: 'Modelo', sortable: true, sortDirection: 'desc' },
              { key: 'peso', label: 'Peso', sortable: true, sortDirection: 'desc' },
              { key: 'nro_serie', label: 'Nro Serie', sortable: true, sortDirection: 'desc' },
              { key: 'CRS', label: 'CRS', sortable: true, sortDirection: 'desc' },
              { key: 'fecha_mangueras', label: 'F. Mang.', sortable: true, sortDirection: 'desc' },
              { key: 'observaciones', label: 'Observaciones', sortable: true, sortDirection: 'desc' },
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
                path: '/globos/quemadores/consultar/'+data.data.id
            });
          },    

          ButtonDelete(data) {
            this.Borrar(data);
          },

          Buscar() {
            var url = '/admin/globo_quemadores';
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
                  
                    var url = '/admin/globo_quemadores/'+registro.id;

                    axios.post(url,{
                        _method: 'delete',                
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Quemador Eliminado Correctamente');
                        
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
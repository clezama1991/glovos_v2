<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-user text-dark"></i>
                Listado de Soguillas

              </span>

              <router-link 
                to="/configuraciones/soguillas/crear"
                v-if="can('soguillas-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar Soguilla </span>
              </router-link>
            </h3>
          </div> 

        <div class="card-body">
         <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            titulo="Soguillas"     
            :can_ver="can('soguillas-read')"
            :can_editar="can('soguillas-update')"
            :can_eliminar="can('soguillas-delete')"          
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
              { key: 'dni', label: 'Dni', sortable: true, sortDirection: 'desc' },
              { key: 'nombres', label: 'Nombre', sortable: true, sortDirection: 'desc' },
              { key: 'apellidos', label: 'Apellidos', sortable: true, sortDirection: 'desc' },
              { key: 'telefono', label: 'Teléfono', sortable: true, sortDirection: 'desc' },
              { key: 'activo', label: 'Activo', sortable: true, sortDirection: 'desc',
              formatter: (value) => {
                return (value) ? 'Activo'  : 'Inactivo';
              }, },
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
                path: '/configuraciones/soguillas/consultar/'+data.data.id
            });
          },    
          ButtonDelete(data) {
            this.Borrar(data);
          },
          Buscar() {
            var url = '/admin/configuracion/soguillas';
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
                text: "Confirme que desea Eliminar este Registro N°: "+registro.id,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/configuracion/soguillas/'+registro.id;

                    axios.post(url,{
                        _method: 'delete',                
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Registro Eliminado Correctamente');
                        
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
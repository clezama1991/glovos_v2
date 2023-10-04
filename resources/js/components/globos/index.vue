<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-lightbulb text-dark"></i>
                Listado de Globos

              </span>

              <router-link 
                to="/globos/crear"
                v-if="can('balloons-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar Globo </span>
              </router-link>
            </h3>
          </div> 
          
        <div class="card-body">

         <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            titulo="Globos"
            :can_ver="can('balloons-read')"
            :can_editar="can('balloons-update')"
            :can_eliminar="can('balloons-delete')"   
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
              { key: 'img', label: 'Foto', sortable: true, sortDirection: 'desc' },
              { key: 'nombre', label: 'Nombre', sortable: true, sortDirection: 'desc' },
              { key: 'fabricante', label: 'Fabricante', sortable: true, sortDirection: 'desc' },
              { key: 'modelo', label: 'Modelo', sortable: true, sortDirection: 'desc' },
              { key: 'peso_cesta', label: 'P. Cesta', sortable: true, sortDirection: 'desc' },
              { key: 'peso_globo', label: 'P. Globo', sortable: true, sortDirection: 'desc' },
              { key: 'peso_botellas', label: 'P. Botellas', sortable: true, sortDirection: 'desc' },
              { key: 'edit_status', label: 'Activo', sortable: false, sortDirection: 'desc' },
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
                path: '/globos/consultar/'+data.data.id
            });
          },    

          ButtonDelete(data) {
            this.Borrar(data);
          },

          ButtonSetStatus(data) { 
            var url = '/admin/status_globos';
            axios.post(url,{
                id: data.id,                
                activo: data.estatus,                
            }).then(response=>{ 
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Estatus actualizado Correctamente');
                this.Buscar();
              }
                  
            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });
          },
          Buscar() {
            var url = '/admin/globos';
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
                text: "Confirme que desea Eliminar el Globo N°: "+registro.id,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/globos/'+registro.id;

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
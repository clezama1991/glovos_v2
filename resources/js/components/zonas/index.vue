<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">



          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">
                
                
                <i class="fas fa-route text-dark"></i>
                Listado de Zonas

              </span>

              <router-link 
                to="/zonas/crear"
                v-if="can('zones-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar Zona </span>
              </router-link>
            </h3>
          </div> 

        <div class="card-body">
          
         <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            titulo="Zonas"   
            :can_ver="can('zones-read')"
            :can_editar="can('zones-update')"
            :can_eliminar="can('zones-delete')"            
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
              { key: 'nombre_corto', label: 'Nombre Corto', sortable: true, sortDirection: 'desc' },
              { key: 'aerop_cercano', label: 'A. Cercano', sortable: true, sortDirection: 'desc' },
              { key: 'frecuencia', label: 'Frecuencia', sortable: true, sortDirection: 'desc' },
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
                path: '/zonas/consultar/'+data.data.id
            });
          },    

          ButtonDelete(data) {
            this.Borrar(data);
          },

          ButtonSetStatus(data) { 
            var url = '/admin/status_zonas';

            axios.post(url,{
                id: data.id,                
                activo: data.estatus,                
            }).then(response=>{ 
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Estatus actualizado Correctamente');
                
              }

              this.Buscar();
                  
            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });
          },
          Buscar() {
            var url = '/admin/zonas';
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
                text: "Confirme que desea Eliminar la Zona N°: "+registro.id,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Confirmar!",
                cancelButtonText: "No, Cancelar!",
                reverseButtons: true
              }).then(function(result) {
                if (result.value) {          
                  
                    var url = '/admin/zonas/'+registro.id;

                    axios.post(url,{
                        _method: 'delete',                
                        token         :   _this.token
                    }).then(response=>{
                      
                      if(!response.data.result){
                        Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                        _this.$toasted.error('Ha ocurrido algún error!');           
                      }else{                 
                        _this.$toasted.success('Zona Eliminada Correctamente');
                        
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
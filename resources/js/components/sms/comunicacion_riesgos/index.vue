<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">

                  <i class="fas fa-exclamation-triangle text-dark"></i>
                  Listado de Evaluaciones de Riesgos  

              </span>

              <router-link
                to="/comunicacion_riesgos/crear"
                v-if="can('risk_assessments-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar Riesgo </span>
              </router-link>
            </h3>
          </div> 

        <div class="card-body">
          
         <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            :can_ver="can('risk_assessments-read')"
            :can_editar="can('risk_assessments-update')"
            :can_eliminar="can('risk_assessments-delete')"      
            titulo="Evaluaciones de Riesgo"            
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
              { key: 'codigo', label: '#Id', sortable: true, sortDirection: 'asc' },
              { key: 'fecha', label: 'Fecha', sortable: true, sortDirection: 'desc',                
                    formatter: value => {
                    return moment(value).format('DD/MM/YYYY');
                    }
              }, 
              { key: 'descripción_suceso', label: 'Suceso', sortable: true, sortDirection: 'desc' },
              { key: 'medidas_correctivas', label: 'Medidas Correctivas', sortable: true, sortDirection: 'desc' },
              { key: 'nombres_responsable', label: 'Nombre Resp.', sortable: true, sortDirection: 'desc' },
               { key: 'estado', label: 'Estado', sortable: false, sortDirection: 'desc' },
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
                path: '/comunicacion_riesgos/consultar/'+data.data.id
            });
          },    

          ButtonDelete(data) {
            this.Borrar(data);
          },


          Buscar() {
            var url = '/admin/riesgos';
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
                  text: "Confirme que desea Eliminar este Riesgo?",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/riesgos/'+registro.id;

                      axios.post(url,{
                          _method: 'delete',                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Riesgo Eliminada Correctamente');
                          
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
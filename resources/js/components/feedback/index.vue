<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">
                
                
                <i class="fas fa-mail-bulk text-dark"></i>
                Listado de Feedback

              </span>

              <router-link 
                to="/feedback/crear"
                v-if="can('types_of_clouds-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar Feedback </span>
              </router-link>
            </h3>
          </div> 


        <div class="card-body">
         

         <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            titulo="Feedback"     
            :can_ver="true"
            :can_editar="true"
            :can_eliminar="true"        
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
              { key: 'titulo', label: 'Nombre', sortable: true, sortDirection: 'desc' },              
              {
                key: "created_at",
                label: "Fecha",
                sortable: true,
                sortDirection: "desc",
                formatter: (value) => {
                  return moment(value).format("DD/MM/YYYY");
                },
              },{
                key: "status",
                label: "Estatus",
                sortable: true,
                sortDirection: "desc",
                formatter: (value) => {
                  return value.toUpperCase();
                },
              },
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
                path: '/feedback/consultar/'+data.data.id
            });
          },    
          ButtonDelete(data) {
            this.Borrar(data);
          },
          Buscar() {
            var url = '/admin/feedback';
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
                  
                    var url = '/admin/feedback/'+registro.id;

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
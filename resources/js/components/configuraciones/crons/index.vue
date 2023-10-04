<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-route text-dark"></i>
                Registro de Tareas Automatizadas
              </span>
          </h3>

        </div>

        <div class="card-body">
          
         <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            titulo="Tareas Automaticas" 
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
              { key: 'fecha', label: 'Fecha', sortable: true, sortDirection: 'desc' },
              { key: 'hora', label: 'Hora', sortable: true, sortDirection: 'desc' },
              { key: 'estatus', label: 'Estado', sortable: true, sortDirection: 'desc' },
              { key: 'nota', label: 'Observación', sortable: true, sortDirection: 'desc' },
            ],  
            records: [],  
          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 

          Buscar() {
            var url = '/admin/configuracion/crons';
                axios.get(url).then(response=>{
                    this.records = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },

      },
      
      computed: { 
        
      },


      };
    </script>
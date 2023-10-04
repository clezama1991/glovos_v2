<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

              <i class="fas fa-shield text-dark"></i>
                Listado de Permisos
              </span>
          </h3>

        </div>

        <div class="card-body">
           
          <table class="table">
            <thead>
              <tr>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody>
              <template v-for="(record, index) in records">  
                <tr>
                  <td class="bg-primary d-flex justify-content-between text-white h4">{{index}}</td>
                </tr>
                <tr v-for="(items, index_i) in record" :key="index_i">
                  <td> <span class="ml-10"> {{items.description}} </span></td>
                </tr>
              </template> 
            </tbody>
          </table>
          
        </div>

       
      </div>

    </div>

  </div>


</template>

<script>
    
    export default {
        data() {
          return {
            records: [],  
          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 
          Buscar() {
            var url = '/admin/permission';
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
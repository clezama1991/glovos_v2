<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

        <header_card icon="fas fa-user-tie" titulo="Listado de Pilotos"></header_card>
 
        <div class="card-body">
          
          <div class="col-12 text-center pb-5">
            <router-link to="/pilotos/crear" class="btn btn-primary mr-2">                    
              <i class="flaticon-plus"></i> Registrar Piloto 
            </router-link> 
          </div>

         <tabla-component :striped="true"
            :fields="fields" 
            :listado="records" 
            titulo="Pilotos"
            :currentPages="page"
            :totalsRows="totalRows"
            :perPages="perPage"
            @ButtonSetStatus="ButtonSetStatus"
            @ButtonDelete="ButtonDelete"
            @ButtonGo="ButtonGo"
            @ButtonGoForm="ButtonGoForm"

            @UpdateDataPage="UpdateDataPage"
            @handleperPageClick="handleperPageClick"
            @UpdateDataSearch="UpdateDataSearch"
            :isBusy="isBusy"
          ></tabla-component> 
          
        </div>

       
      </div>

    </div>

  </div>


</template>
<script>
    
    export default {
        data() {
          return {
            isBusy:false,
            fields: [ 
              { key: 'nombres', label: 'Nombres y Apellido', sortable: true, sortDirection: 'desc',
                formatter: (value, key, item) => {
                 return value+' '+item.apellidos;
                }
              },
              { key: 'dni', label: 'DNI', sortable: true, sortDirection: 'desc' },
              { key: 'contactos', label: 'Contactos', sortable: true, sortDirection: 'desc',
                formatter: (value, key, item) => {
                 return '<i class="fa fa-envelope small mr-1"></i>'+item.email+'<br> <i class="fa fa-phone small mr-1"></i>'+item.telefono +'';
                }
              },
              // { key: 'apellidos', label: 'Apellidos', sortable: true, sortDirection: 'desc' },
              // { key: 'telefono', label: 'Teléfono', sortable: true, sortDirection: 'desc' },
              // { key: 'email', label: 'Correo', sortable: true, sortDirection: 'desc' },
              { key: 'peso', label: 'Peso Kgs', sortable: true, sortDirection: 'desc' },
              { key: 'edit_status', label: 'Activo', sortable: false, sortDirection: 'desc' },
              { key: 'estatus_entrenamientos', label: 'Entrenamientos', sortable: false, sortDirection: 'desc' },
              { key: 'actions_formularios', label: 'Acciones' }
            ],  
            records: [],  
            isInit:true,
            page:1,
            totalRows:0,
            perPage:10,
            Search:0,
          }
        },
        mounted() {
          // this.Buscar();
          this.infiniteHandler();
          // console.log();
        },
        methods: { 

          setUrl: function() {
            return `/admin/pilotos?page=${this.page}&per_page=${this.perPage}&search=${this.Search}`; 
          },

          async infiniteHandler() {
            this.isBusy = true
            try {
              const response = await axios.get(this.setUrl());
              this.isInit = this.isBusy = false 
              this.records = response.data.data.data;
              this.totalRows = response.data.data.total;
            } catch (error) {
              this.isBusy = false
              return []
            }
          },

          async handleperPageClick(data) {
            this.perPage = data.per_page;
            this.infiniteHandler();
          },

          async UpdateDataPage(data) {
            this.page = data.page;
            this.infiniteHandler();
          },

          async UpdateDataSearch(data) {
            this.Search = data.search;
            this.infiniteHandler();
          },





          async ButtonDelete(data) {
            var optiones  = {
              'url' : '/admin/pilotos/'+data.data.id,
            }
            await this.DeleteRegister(optiones); 
          },

          async ButtonSetStatus(data) {
            var optiones  = {
              'url' : '/admin/status_pilotos',
              'data' : {
                id: data.id,                
                activo: data.estatus, 
              },
            }
            await this.UpdateSetStatus(optiones); 
          },










         ButtonGo(data) {
            this.$router.push({
                path: '/pilotos/consultar/'+data.data.id
            });
          },    

         ButtonGoForm(data) {
            this.$router.push({
                path: '/pilotos/formularios/'+data.data.id
            });
          },    



          ButtonSetStatasdus(data) { 
            var url = '/admin/status_pilotos';

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

          async Buscar() {
            this.isBusy = true
            try {
               var url = '/admin/pilotos';
              const response = await axios.get(url);
              this.isBusy = false
              this.records = response.data.records;
            } catch (error) {
              this.isBusy = false
              return []
            }
          },

      },
      
      computed: { 
        
      },


      };
    </script>
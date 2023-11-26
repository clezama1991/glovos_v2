<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                  
              <i class="fas fa-file-invoice text-dark"></i>                       
                Informe de vuelos Realizados
              </span>
          </h3>

        </div>
 
        <div class="card-body">
          
  <div class="card card-custom">

<div class="card-body">
       <div class="row">
         <div class="col-md-3">
            <div class="form-group">
                <label for="">Globos</label>
                <v-select 
                class="w-100"
                id="vuelo_id"
                v-model="filtro.globo"
                :reduce="name => name.id"
                :options="filtros.globos" 
                label="name">
                </v-select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Pilotos </label>
                <v-select 
                class="w-100"
                id="vuelo_id"
                v-model="filtro.piloto"
                :reduce="name => name.id"
                :options="filtros.pilotos" 
                label="name">
                </v-select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Zonas</label>
                <v-select 
                class="w-100"
                id="vuelo_id"
                v-model="filtro.zona"
                :reduce="name => name.id"
                :options="filtros.zonas" 
                label="name">
                </v-select>
            </div>
        </div>
        <div class="col-md-3">
          <form action="/admin/informes/sincronizar_informacion" method="post">
            <input type="hidden" name="_token" v-bind:value="csrf">
            <input type="hidden" name="vuelos_ids" :value="ListadoSelecciona">
            <div class="form-group" style="display: inline-grid;">
              <label for="">Sincronizar Vuelos</label>
              <button :class="{'disabled':ListadoSelecciona.length==0}" :disabled="ListadoSelecciona.length==0" class="btn btn-primary" type="submit"> 
                <i class="fa fa-refresh"></i> Sincronizar Información </button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Rangos de Fechas</label>
                <div class="row">
                  <div class="col-6">
                    <input type="date" v-model="filtro.inicio" name="gfhfg" id="gdf" class="form-control">
                    <span class="text-muted">Fecha de Inicio</span>
                  </div>
                  <div class="col-6">
                    <input type="date" v-model="filtro.fin" name="dasd" id="sdf" class="form-control">
                    <span class="text-muted">Fecha de Fin</span>
                  </div>
                </div>
            </div>
        </div>
      
        <div class="col-md-3">
          <form target="_blank" action="/admin/informes/generar_EASA" method="post">
            <input type="hidden" name="_token" v-bind:value="csrf">
            <input type="hidden" name="globo_id" :value="filtro.globo">
            <input type="hidden" name="inicio" :value="filtro.inicio">
            <input type="hidden" name="fin" :value="filtro.fin">
            <div class="form-group" style="display: inline-grid;">
              <label for="">Exportar EASA Part CAO</label>
              <button :class="{'disabled':filtro.globo==null||filtro.globo=='sin_globos'||filtro.piloto!=null||filtro.zona!=null}" :disabled="filtro.globo==null||filtro.globo=='sin_globos'||filtro.piloto!=null||filtro.zona!=null" class="btn btn-success" type="submit"> <i class="la la-file-excel-o"></i> Generar  Excel </button>
              <span class="text-muted" v-if="filtro.globo==null||filtro.globo=='sin_globos'">Debes Seleccionar un Globo</span>
              <span class="text-muted" v-else-if="filtro.piloto!=null||filtro.zona!=null">No se puede generar el excel con este filtro</span>
            </div>
          </form>
        </div>
        <div class="col-md-3">
          <form target="_blank" action="/admin/informes/generar_pvo" method="post">
            <input type="hidden" name="_token" v-bind:value="csrf">
            <input type="hidden" name="vuelos_ids" :value="ListadoSelecciona">
            <input type="hidden" name="globo_id" :value="filtro.globo">
            <input type="hidden" name="inicio" :value="filtro.inicio">
            <input type="hidden" name="fin" :value="filtro.fin">
            <div class="form-group" style="display: inline-grid;">
              <label for="">Exportar PVO</label>
              <button class="btn btn-primary" type="submit"> 
                <i class="la la-file-excel-o"></i> Generar  PVO </button>
            </div>
          </form>
        </div>
    </div>
</div>
</div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Ordenar Tabla Por</label>
                <select class="form-control" name="" id="" v-model="columna" @change="Buscar()">
                  <option value="id">Id</option>
                  <option value="fecha">Fechas</option>
                  <option value="zona">Zonas</option>
                  <option value="piloto">Pilotos</option>
                  <option value="globo">Globos</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Orientacion</label>
                <select class="form-control" name="" id="" v-model="orden" @change="Buscar()">
                  <option value="asc">ASC</option>
                  <option value="desc">DESC</option>
                </select>
              </div>
            </div> 
          </div>
          <tabla-component :striped="true"
            :fields="fields" 
            :listado="recordsFiltros" 
            titulo="Vuelo realizado"
            acciones_tabla="sp-view sp-delete"
            selected_tabla=true
            exportar_datos=true
            return_array_id=true
            @returnArrayIds='returnArrayIds'
            @ButtonGo='ButtonGo'
            @ButtonDelete="ButtonDelete"
            @Seleccion='Seleccion'
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
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            filtro:{
              globo : null,
              piloto : null,
              zona : null,
              estado : null,
              inicio : null,
              fin : null,
            },
            columna : 'fecha',
            orden : 'desc',
            fields: [ 
              { key: 'seleccion', label: 'Marcar', variant: 'info' },
              { key: 'vuelo.id', label: '#', sortable: false },
              
              { key: 'pasajeros', label: 'N.Pax', sortable: false,                
                    formatter: value => {
                    return value.length;
                    }
              },
              { key: 'vuelo.fecha', label: 'Fecha', sortable: false,                
                    formatter: value => {
                    return moment(value).format('DD/MM/YYYY');
                    }
              },
              { key: 'vuelo.hora_despegue', label: 'H. Desp', sortable: false },
              { key: 'vuelo.hora_aterrizaje', label: 'H. Ate.', sortable: false },
              { key: 'zona.nombre', label: 'Zona', sortable: false },
              { key: 'piloto', label: 'Piloto', sortable: false,                
                formatter: value => {
                return (value!=null) ? value.nombres+' '+value.apellidos : '';
                }
              },  
              { key: 'globo.nombre', label: 'Globo', sortable: false },              
              { key: 'btn_actions', label: 'Acciones', sortable: false },              
            ],  
            records: [],  
            ListadoSelecciona: [],  
          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 

          Seleccion(data) {
            console.log(data.data);
            this.ListadoSelecciona = data.data;
          },   
         ButtonGo(data) {
            this.$router.push({
                path: '/informes/vuelos/edit/'+data.data.id
            });
          },    
          returnArrayIds(data) {
            
          },
          Buscar() {
            var url = '/admin/informes/vuelos';
                axios.post(url,{
                    columna : this.columna,
                    orden : this.orden,
                }).then(response=>{
                    this.records = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
          
          ButtonDelete(data) {
            console.log(data.data);
            this.Borrar(data);
          },
        
    Borrar(data) {
      var _this = this;
      var registro = data.data;

      Swal.fire({
        title: "Confirmar!",
        text: "Confirme que desea Cancelar el Vuelo N°: " + registro.vuelo.id,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Confirmar!",
        cancelButtonText: "No, Cancelar!",
        reverseButtons: true,
      }).then(function (result) {
        if (result.value) {
          var url = "/admin/confirmar_cancelacion_vuelo";

          axios

          axios.post(url,{
              id: registro.vuelo.id,    
              mensaje_cancelacion_vuelo: 'Vuelo realizado, posteriormente cancelado',             
              token         :   _this.token
          }).then(response=>{

              if (!response.data.result) {
                Swal.fire(
                  "Ha ocurrido algún error!",
                  "Se le notificará al equipo de soporte!" +
                    response.data.mensaje_error,
                  "error"
                );
                _this.$toasted.error("Ha ocurrido algún error!");
              } else {
                _this.$toasted.success(
                  "Vuelo Cancelado Correctamente"
                );
              }

              _this.Buscar();
            })
            .catch((error) => {
              console.log(error);
              this.errors = error.response;
            });
        }
      });
    },
      },
      
      computed: {  
          ListRecords: function () {
            var data = this.records;
            return data.filter(
              (items) => items.fecha >= moment().format("YYYY-MM-DD")
            );
          }, 
          recordsFiltros: function () {
            
            var data = this.records;   

            /******* GLOBOS  ************/
            var globo = this.filtro.globo;       

            if(globo!=null){

              data =_.filter(data, function(items) { 

                if(items.globo){
                  return items.globo.id == globo; 
                }
                
                if(globo=='sin_globos'){
                  return items.globo == null; 
                }

              });  

            }
            /******* FIN GLOBOS  ************/

            /******* PILOTOS  ************/
            var piloto = this.filtro.piloto;       

            if(piloto!=null){

              data =_.filter(data, function(items) { 

                if(items.piloto){
                  return items.piloto.id == piloto; 
                }
                
                if(piloto=='sin_pilotos'){
                  return items.piloto == null; 
                }

              });  

            }
            /******* FIN PILOTOS  ************/

            /******* PILOTOS  ************/
            var zona = this.filtro.zona;       

            if(zona!=null){

              data =_.filter(data, function(items) { 

                if(items.zona){
                  return items.zona.id == zona; 
                }
                
                if(zona=='sin_zonas'){
                  return items.zona == null; 
                }

              });  

            }
            /******* FIN PILOTOS  ************/

            /******* FECHAS  ************/
            var inicio = this.filtro.inicio;       
            var fin = this.filtro.fin;       

            if(inicio!=null && inicio!=''){
              data =_.filter(data, function(items) { 
                  return items.vuelo.fecha >= inicio;  
              });   
            }
            
            if(fin!=null && fin!=''){
              data =_.filter(data, function(items) { 
                  return items.vuelo.fecha <= fin;  
              });   
            }
            /******* FIN FECHAS  ************/
 
            return data;

          },
          

          filtros: function () {

            var data = this.records;       

            /******* GLOBOS  ************/
             var group_globos = _.uniqBy(data,'globo.id').filter((items) => items.globo!=null);
              console.log(group_globos);
            group_globos = _(group_globos)
              .map(function(items) {                 
                return { id: items.globo.id, name: items.globo.nombre };
              })
              .value(); 
   console.log(group_globos);
           
            group_globos.push({
              id: null , name: 'Todos'
            });

            group_globos.push({
              id: 'sin_globos' , name: 'Sin Globos'
            });
            /******* FIN GLOBOS  ************/

            /******* PILOTOS  ************/
            var group_pilotos = _.uniqBy(data,'piloto.id').filter((items) => items.piloto!=null);
          
            group_pilotos = _(group_pilotos)
              .map(function(items) { 
                return { id: items.piloto.id, name: items.piloto.nombres+' '+items.piloto.apellidos };
              })
              .value();           
           
            group_pilotos.push({
              id: null , name: 'Todos'
            });

            group_pilotos.push({
              id: 'sin_pilotos' , name: 'Sin Pilotos'
            });
            /******* FIN PILOTOS  ************/
            
            

            /******* ZONAS  ************/
            var group_zonas = _.uniqBy(data,'zona.id').filter((items) => items.zona!=null);
          
            group_zonas = _(group_zonas)
              .map(function(items) { 
                return { id: items.zona.id, name: items.zona.nombre };
              })
              .value();           
           
            group_zonas.push({
              id: null , name: 'Todos'
            });

            group_zonas.push({
              id: 'sin_zonas' , name: 'Sin Zonas'
            });
            /******* FIN ZONAS  ************/

         
            return {
              globos : group_globos,
              pilotos : group_pilotos,
              zonas : group_zonas
            }

          },
          

      },


      };
    </script>
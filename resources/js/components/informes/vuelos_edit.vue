<template>


  <div class="d-flex flex-column-fluid">
 
    <div class="container px-0"> 
       
      <div class="card card-custom mb-5">

        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

              <i class="fas fa-plane-departure text-dark"></i>                       
              Editar Información del Vuelo Realizado
              </span>
          </h3>

        </div>

        <form @submit="ActualizarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
              
          <div class="card-body">  
          
          
                <div class="card mt-5">

                  <header_card icon="fa fa-user" titulo="Información de la Zona" tipo="sub"></header_card>

                  <div class="card-body"> 

                    <div class="row">

                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="nombres">Nombre</label>
                          <input v-model="zona.nombre" id="nombres" type="text" class="form-control" required>
                        </div> 
                      </div> 
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="url_despegue_1">Despegue 1</label>
                          <input v-model="zona.url_despegue_1" id="url_despegue_1" type="text" class="form-control" required>
                          <input v-model="zona.despegue_whatsapp" type="radio" name="despegue_whatsapp" id="despegue_whatsapp_1" value="1"> <label for="despegue_whatsapp_1">Predeterminado para Whatsapp</label>
                      </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="url_despegue_2">Despegue 2</label>
                          <input v-model="zona.url_despegue_2" id="url_despegue_2" type="text" class="form-control" required>
                          <input v-model="zona.despegue_whatsapp" type="radio" name="despegue_whatsapp" id="despegue_whatsapp_2" value="2"> <label for="despegue_whatsapp_2">Predeterminado para Whatsapp</label>
                    </div> 
                      </div>   
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="aerop_cercano">Aeropuerto Cercano</label>
                          <input v-model="zona.aerop_cercano" id="aerop_cercano" type="text" class="form-control" required>
                        </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="frecuencia">Frecuencia</label>
                          <input v-model="zona.frecuencia" id="frecuencia" type="text" class="form-control" required>
                        </div> 
                      </div>

                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="nota">Notas</label>
                          <textarea v-model="zona.notas" id="nota" type="text" class="form-control">
                          </textarea>
                        </div> 
                      </div> 
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="nota">Mensaje Personalizado</label>
                          <textarea v-model="zona.mensaje_personalizado" id="nota" type="text" class="form-control">
                          </textarea>
                        </div> 
                      </div> 
                    </div>  
                  </div>
                </div>
                  

                <div class="card mt-5">

                  <header_card icon="fa fa-user" titulo="Información del Globo" tipo="sub"></header_card>

                  <div class="card-body"> 
                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="nombres">Nombre</label>
                          <input v-model="globo.nombre" id="nombres" type="text" class="form-control" required>
                        </div> 
                      </div> 
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="fabricante">Fabricante</label>
                          <input v-model="globo.fabricante" id="fabricante" type="text" class="form-control" required>
                        </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="modelo">Modelo</label>
                          <input v-model="globo.modelo" id="modelo" type="text" class="form-control" required>
                        </div> 
                      </div>   
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="matricula">Matricula</label>
                          <input v-model="globo.matricula" id="matricula" type="text" class="form-control" required>
                        </div> 
                      </div> 

                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="peso_globo">Peso Globo KGS</label>
                          <input v-model="globo.peso_globo" id="peso_globo" type="text" v-numero class="form-control" required> 
                        </div> 
                      </div> 
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="peso_cesta">Peso Cesta KGS</label>
                          <input v-model="globo.peso_cesta" id="peso_cesta" type="text" v-numero class="form-control" required> 
                        </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="peso_botellas">Peso Botellas KGS</label>
                          <input v-model="globo.peso_botellas" id="peso_botellas" type="text" v-numero class="form-control" required> 
                        </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="mtom">MTOM KGS</label>
                          <input v-model="globo.mtom" v-numero id="mtom" type="tel" class="form-control" required>
                        </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="min_mtom">Min. MTOM KGS</label>
                          <input v-model="globo.min_mtom" id="min_mtom" type="text" class="form-control" required> 
                        </div> 
                      </div>
                      <div class="col-md-9 mb-3">
                        <div class="form-group">
                          <label for="nota">Notas</label>
                          <textarea v-model="globo.notas" id="nota" type="text" class="form-control">
                          </textarea>
                        </div> 
                      </div> 
                    </div> 
                  </div>
                </div>
          
                <div class="card mt-5">

                  <header_card icon="fa fa-user" titulo="Información del Piloto" tipo="sub"></header_card>

                  <div class="card-body"> 

                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="nombres">Nombres</label>
                          <input v-model="piloto.nombres" id="nombres" type="text" class="form-control" required>
                        </div> 
                      </div> 
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="apellidos">Apellidos</label>
                          <input v-model="piloto.apellidos" id="apellidos" type="text" class="form-control" required>
                        </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="cedula">Identificación</label>
                          <input v-model="piloto.dni" id="cedula" type="text" class="form-control" required>
                        </div> 
                      </div>       
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="telefono">Teléfono</label>
                          <input v-model="piloto.telefono" id="telefono" type="text" class="form-control" required>
                        </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input v-model="piloto.email" id="email" type="text" class="form-control" required> 
                          <span class="form-text text-muted" v-if="!isEmailValid">Debe ingresar un email valido</span>
                        </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="peso">Peso KGS</label>
                          <input v-model="piloto.peso" v-numero id="peso" type="text" class="form-control" required>
                        </div> 
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="direccion">Dirección</label>
                          <input v-model="piloto.direccion" id="direccion" type="text" class="form-control" required> 
                        </div> 
                      </div>
                  
                    </div>
                  </div>
                </div>
          
                <div class="card mt-5">

                  <header_card icon="fa fa-user" titulo="Información del Vuelo" tipo="sub"></header_card>

                  <div class="card-body"> 
                    
                    <div class="row">
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="fecha">Fecha</label>
                          <input v-model="vuelo.fecha" id="fecha" type="date" class="form-control" required>
                        </div> 
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="hora">Hora</label>
                          <input v-model="vuelo.hora" id="hora" type="time" class="form-control">
                        </div> 
                      </div>
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="temperatura">Temperatura</label>
                          <input v-model="vuelo.temperatura" id="temperatura" v-numero type="text" class="form-control">
                        </div> 
                      </div>  
                      <div class="col-md-2 mb-3">
                        <div class="form-group">
                          <label for="gas">Kg de Gas</label>
                          <input v-model="vuelo.gas" id="gas" type="text" v-numero class="form-control"> 
                        </div> 
                      </div>  
                      <div class="col-md-4 mb-3">
                        <div class="form-group">
                          <label for="nota">Notas</label>
                          <textarea v-model="vuelo.notas" id="nota" type="text" class="form-control">
                          </textarea>
                        </div> 
                      </div> 
                    </div> 
                  </div>
                </div>

          
                <div class="card mt-5">

                  <header_card icon="fa fa-user" titulo="Pedidos Y Pasajeros" tipo="sub"></header_card>

                  <div class="card-body"> 
                    <div v-for="(pedido, index) in pedidos" :key="index">
                      <table class="w-100 table-bordered table table-sm">
                        <thead class="text-light bg-dark">
                            <tr>
                                <th colspan="2">PEDIDO: {{pedido.orden_wordpress}}</th>
                                <th>TELEFONO: <a :href="'tel:'+pedido.telefono_contacto"> <i class="fa fa-phone" aria-hidden="true"></i> {{pedido.telefono_contacto}}</a> </th>

                              </tr>
                        </thead>
                        <tbody>                          
                          <tr>
                              <td width="30%">Contacto <i class="fas fa-user-check    "></i></td>
                              <td>{{pedido.nombre_contacto}}</td>
                              <td  width="30%" class="text-center">
                                    <a :href="'https://api.whatsapp.com/send?phone='+pedido.telefono_contacto+'&text=Gracias Por Contactarnos'"
                                        target="_blank" class="btn btn-success btn-icon btn-sm">
                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr v-for="(pedidos_pasajeros, index_pedidos_pasajeros) in pedido.pedidos_pasajeros" :key="index_pedidos_pasajeros">
                              <td></td>
                              <td>{{pedidos_pasajeros.pasajero.nombres}} {{pedidos_pasajeros.pasajero.apellidos}}</td>
                              <td nowrap>{{pedidos_pasajeros.pasajero.peso}} Kg</td>                           
                            </tr> 
                          </tbody>
                      </table>
                    </div>
                  </div>

                </div>

                <div class="card mt-5"> 

                  <header_card icon="fa fa-user" titulo="Detalles del vuelo Realizado" tipo="sub"></header_card>

                  <div class="card-body">
                    
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="lugar_despegue">Lugar Despegue </label>
                          <input v-model="vuelo.lugar_despegue" id="lugar_despegue" type="text" class="form-control">
                        </div> 
                      </div> 
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="fecha_despegue">Fecha Despegue</label>
                          <input v-model="vuelo.fecha_despegue" id="fecha_despegue" type="date" class="form-control">
                        </div> 
                      </div> 
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="hora_despegue">Hora Despegue</label>
                          <input v-model="vuelo.hora_despegue" id="hora_despegue" type="time" class="form-control">
                        </div> 
                      </div> 
                      
                        
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label for="lugar_aterrizaje">Lugar Aterrizaje </label>
                          <input v-model="vuelo.lugar_aterrizaje" id="lugar_aterrizaje" type="text" class="form-control">
                        </div> 
                      </div> 
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="fecha_aterrizaje">Fecha Aterrizaje</label>
                          <input v-model="vuelo.fecha_despegue" id="fecha_aterrizaje" type="date" class="form-control">
                        </div>
                      </div> 
                      <div class="col-md-3 mb-3">
                        <div class="form-group">
                          <label for="hora_aterrizaje">Hora Aterrizaje</label>
                          <input v-model="vuelo.hora_aterrizaje" id="hora_aterrizaje" type="time" class="form-control">
                        </div> 
                      </div>   
                      <div class="col-md-3 mb-3">
                          <b-form-checkbox
                            id="checkbox-1"
                            v-model="vuelo.cautivo"
                            name="checkbox-1"
                            value="1"
                            unchecked-value="0"
                          >
                            Cautivo 
                          </b-form-checkbox>
                          
                      </div>   
                    </div>
                          
                  </div>   
                </div>   

          </div>
        
          <div class="card-footer">
            <router-link to="/informes/vuelos" class="btn btn-secondary mr-2">
              <i class="fa fa-undo"></i> Volver
            </router-link>

            <button
              type="submit"
              class="btn btn-warning mr-3 float-right"
              :disabled="GuardandoCambios"
            >
              <span v-if="GuardandoCambios">
                <i class="fas fa-spinner fa-spin"></i> Actualizando...
              </span>
              <span v-else> <i class="fa fa-save"></i> Actualizar </span>
            </button> 
          </div>


        </form>


       
      </div>

    </div>

  </div>
 
</template>
<script>
    
    export default {
      props : ['id'],
        data() {
          return {
            GuardandoCambios : false,
            doc_licencia:false,
            Zonas : [],
            Pilotos : [],
            Globos : [],
            pedidos : [],
            pasajeros : [],
            zona : false,
            globo : false,
            piloto : false,
            vuelo : false,
            form:{         
              zona_id : '',
              piloto_id : null,
              globo_id : '',
              fecha : '',
              hora : '',
              temperatura : '',
              gas : '',
              notas : '',
              lugar_despegue : '',
              fecha_despegue : '',
              hora_despegue : '',
              lugar_aterrizaje : '',
              hora_aterrizaje : '',
              cautivo : 1,
            },
          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 
 
         Buscar() {
            var url = '/admin/informes/edit_vuelos/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.zona = response.data.records.zona; 
                this.globo = response.data.records.globo; 
                this.piloto = response.data.records.piloto; 
                this.vuelo = response.data.records.vuelo; 
                this.pedidos = response.data.records.pedido; 
                this.pasajeros = response.data.records.pasajeros; 
            }).catch(error => {
                this.errors = error.response.data
            });
          },

          ActualizarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
               var url = '/admin/informes/saved_vuelos';
              axios.post(url,{         
                id:   this.$route.params.id, 
                zona:   this.zona, 
                globo:   this.globo, 
                piloto:   this.piloto, 
                vuelo:   this.vuelo, 
                token:   this.token
              }).then(response=>{              
                if(!response.data.result){
                  Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                  this.$toasted.error('Ha ocurrido algún error!');           
                }else{                 
                  this.$toasted.success('Información Actualizada Correctamente');   
                }
                this.GuardandoCambios = !this.GuardandoCambios;  
              }).catch(error => {
                  console.log(error);
                  this.errors = error.response
              });

        }, 

      },
      
  
      computed: { 
 
    }


      };
    </script>
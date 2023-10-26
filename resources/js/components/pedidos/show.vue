<template>

<div>
  
    <base-loading></base-loading>
  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

        <header_card icon="fas fa-list-check" titulo="Ver Pedido"></header_card>

        <div class="card-body">
            
            <info_inputs_required />
                <div class="card mt-5">

                  <header_card icon="fa fa-file" titulo="Detalle" tipo="sub"></header_card>

                  <div class="card-body"> 

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <h4>Order-ID</h4>
                    <div class="form-group">
                      <input v-model="form.orden_wordpress" disabled class="form-control form-control-solid">
                    </div> 
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <h4>N. Pax</h4>
                    <div class="form-group">
                      <input v-model="form.numpax" disabled class="form-control form-control-solid">
                    </div> 
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <h4>Enlace</h4>
                    
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" v-model="form.token" class="form-control form-control-solid" readonly  @click="copyURL('https://gestion.volarenasturias.com/completed_form/'+form.token)">
                        <div class="input-group-append">
                          <button class="btn btn-secondary" type="button" @click="copyURL('https://gestion.volarenasturias.com/completed_form/'+form.token)"> <i class="fa fa-clipboard" aria-hidden="true"></i> Copiar!</button>
                        </div>
                      </div>
                      <!-- <input v-model="form.token" @click="copyURL('https://gestion.volarenasturias.com/completed_form/'+form.token)" id="nombres" type="text" class="form-control form-control-solid" readonly> -->
                    </div> 
                  </div>
                  
                  <div class="col-md-6">
                    <span class="h4">Pedido Exclusivo?</span>
                    <br>
                    <br>
                    <div class="form-check">
                      <label class="form-check-label h4">
                        <input @change="ConfirmarActualizarExlusividad()" type="checkbox" class="form-check-input" name="" id="" value="1" v-model="form.privado">
                        Sí, es Exclusivo!
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="vuelo_id">Vuelo</label>                      
                      <select class="form-control selectpicker" @change="ConfirmarActualizarPedido()" id="selectpicker_vuelos" data-live-search="true" v-model="form.vuelo_id" :disabled="form.estatus_agrupacion=='HIJO'">
                        <option value="" >Sin Vuelo</option>
                        <option v-for="(item, index) in recordsVuelo" :key="index" :value="item.id">{{item.name_vuelo}} </option>
                      </select> 
                    </div> 
                  </div> 

                  <div class="col-md-6 mb-3">
                    <h4>Fecha realización del Vuelo</h4>
                    <div class="form-group">
                      <input v-model="form.hanvolado" id="hanvolado" :disabled="form.estatus=='Vuelo Realizado' || form.estatus_agrupacion=='HIJO'" type="date" class="form-control" @change="CambiarFechaVuelo()">
                    </div> 
                  </div>
        
                  <div class="col-md-12 pt-1 text-center" v-if="form.estatus_agrupacion=='HIJO'">
                    <div role="alert" class="alert alert-custom alert-danger text-left">
                      <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                      <!-- <div class="alert-text h4"> Este Pedido ya esta agrupado en el Pedido # <router-link :to="'/pedidos/consultar/'+form.parent.orden_wordpress"> {{form.parent.orden_wordpress}} </router-link> </div> -->
                      <div class="alert-text h5"> No puedes Modificar pedidos que perteneces a un grupo, para gestionar el pedido ver al siguiente pedido <u> <router-link :to="'/pedidos/consultar/'+form.parent.orden_wordpress" class="text-white"># {{form.parent.orden_wordpress}} </router-link></u> </div>
                    </div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="nota">Notas</label>
                      <textarea
                        v-model="form.notas"
                        id="nota"
                        type="text"
                        @change="ActualizarPedido()"
                        class="form-control form-control-sm"
                        placeholder="Notas"
                      >
                      </textarea>
                    </div>
                  </div>
                </div> 
                </div> 
                </div> 
                


                <div class="card mt-5">

                  <header_card icon="fa fa-compress" titulo="Pedidos Agrupados" tipo="sub"></header_card>

                  <div class="card-body"> 

                <div class="row d-flex justify-content-end">

                  
                  <div class="col-12 text-center pb-5" v-if="can('orders-update') && form.estatus_agrupacion!='HIJO'">
                    <span data-toggle="modal" :data-target="'#AgruparPedidos'" v-if="form.estatus!='Vuelo Realizado'" class="badge badge-primary badge-pill ml-3 float-right text-white" role="button"><span>
                      <i class="fa fa-compress text-white mr-2" aria-hidden="true"></i>  Agrupar Nuevo Pedido
                      </span>
                    </span>
                  </div>

                  <div class="col-md-12 mb-3" v-if="form.estatus_agrupacion!='HIJO'"> 
                    <table class="table table-sm table-bordered">
                      <thead class="bg-light-dark">
                        <tr>
                          <th>#</th>
                          <th>Order-ID</th>
                          <!-- <th>Dni</th> -->
                          <th>N. Pax</th>
                          <th>Contacto</th> 
                          <th>P. Ext</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(item, index) in form.agrupaciones"
                          :key="index"
                        >
                        <td>
                          {{index+1}}
                        </td>
                          <td>
                            <router-link :to="'/pedidos/consultar/'+item.orden_wordpress">
                            {{ item.orden_wordpress }}
                            </router-link>

                          </td>
                          <td>
                            {{ item.numpax }}
                          </td>
                          <td>
                            {{ item.nombre_contacto }}
                          </td>
                          <td>
                            {{ (item.peso_extra==1) ? 'Si' : 'No'  }}
                          </td>
                          <td>
                            <button v-if="form.estatus!='Vuelo Realizado'" class="btn btn-sm btn-icon btn-danger" @click="DesagruparPedido(item.id)">
                              <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table> 
                  </div>    

                  <div class="col-md-12 pt-1 text-center" v-else>
                    <div role="alert" class="alert alert-custom alert-danger text-left">
                      <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                      <div class="alert-text h4"> Este Pedido ya esta agrupado en el Pedido <u> <router-link :to="'/pedidos/consultar/'+form.parent.orden_wordpress" class="text-white"># {{form.parent.orden_wordpress}} </router-link></u> </div>
                      </div>
                  </div>
                </div>
                </div>
                </div>
                <hr>

                <div class="card mt-5">

                  <header_card icon="fa fa-user" titulo="Datos de Contacto" tipo="sub"></header_card>

                  <div class="card-body"> 

                <div class="row d-flex justify-content-end">
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="nombres" class="requerido">Nombre Completo</label>
                      <input v-model="form.nombre_contacto" @blur="ActualizarContacto()" id="nombres" type="text" class="form-control" required>
                    </div> 
                  </div> 
                  <div class="col-md-3 mb-3">
                    <div class="form-group">
                      <label for="apellidos" class="requerido">Email</label>
                      <input v-model="form.email_contacto" @blur="ActualizarContacto()" id="apellidos" type="text" class="form-control" required>
                    </div> 
                  </div>
                  <div class="col-md-2 mb-3">
                    <div class="form-group">
                      <label for="telefono" class="requerido">Teléfono</label>
                      <input v-model="form.telefono_contacto" @blur="ActualizarContacto()" id="telefono" type="text" class="form-control" required>
                    </div> 
                  </div>  
                  <div class="col-md-2 mb-3">
                    <div class="form-group">
                      <label for="dni" class="requerido">Ciudad</label>
                      <input v-model="form.ciudad_contacto" @blur="ActualizarContacto()" id="dni" type="text" class="form-control" required>
                    </div> 
                  </div>    
                  <div class="col-md-2 mb-3">
                    <div class="form-group">
                      <label for="dni" class="requerido">Idioma</label>                      
                      <select class="form-control" v-model="form.lenguaje_contacto" @change="ActualizarContacto()">
                        <option value="es">Español</option>
                        <option value="en">Ingles</option>
                        <option value="fr">Frances</option>
                      </select>
                    </div> 
                  </div>    
                  <!-- <div class="col-md-3 float-right"> 
                      <span @click="ActualizarContacto()"  v-if="form.estatus!='Vuelo Realizado'" class="btn btn-primary float-right text-white" role="button"><span>
                        <i class="fa fa-save text-white mr-2" aria-hidden="true"></i>  Actualizar Datos de contacto
                        </span></span> 
                  </div>             -->
                </div>
                </div>
                </div>
                <hr>

                
                <div class="card mt-5">

                  <header_card icon="fa fa-user" titulo="Pasajeros" tipo="sub"></header_card>

                  <div class="card-body"> 

                <div class="row">
                  <div class="col-md-12 mb-3">
                      <h6>Pasajeros ({{(form.pedidos_pasajeros)?form.pedidos_pasajeros.length:0}}/{{form.numpax}})
                      
                      <span @click="BorrarPasajero()" v-if="can('orders-update') && form.estatus!='Vuelo Realizado' && form.estatus_pedido!='Completado'" class="badge-sm badge badge-danger badge-pill ml-3 float-right text-white" role="button"><span>
                        <i class="fa fa-user-minus text-white mr-2" aria-hidden="true"></i>  Pasajero
                        </span></span>

                      <span @click="AgregarPasajero()" v-if="can('orders-update') && form.estatus!='Vuelo Realizado'" class="badge badge-primary badge-pill ml-3 float-right text-white" role="button"><span>
                        <i class="fa fa-user-plus text-white mr-2" aria-hidden="true"></i>  Pasajero
                        </span>
                      </span>

                      <a :href="'/pedidos_enviar_formulario/'+form.id" v-if="can('orders-update') && form.estatus!='Vuelo Realizado'" target="_blank" class="badge badge-warning badge-pill float-right text-white" role="button">                                
                        <i class="fab fa-whatsapp text-white mr-2" aria-hidden="true"></i>
                        Enviar Formulario
                      </a>

                    </h6>
                  </div>
                  <div class="col-md-8 offset-2 pt-1 text-center"  v-if="form.estatus=='Creado'">
                    <div class="alert alert-custom alert-danger text-left" role="alert">
                        <div class="alert-icon">
                          <i class="flaticon-questions-circular-button"></i>
                        </div>
                        <div class="alert-text h4"> No has enviado el formulario!</div>
                      </div>  
                  </div>
                  <div class="col-md-8 offset-2 pt-1 text-center"  v-if="form.estatus=='Formulario Enviado'">
                    <div class="alert alert-custom alert-warning text-left" role="alert">
                        <div class="alert-icon">
                          <i class="flaticon-questions-circular-button"></i>
                        </div>
                        <div class="alert-text h4"> Esperando información de los pasajeros!</div>
                      </div> 
                  </div>
                   
                  <div class="col-md-12" v-if="form.estatus!='Creado' && form.estatus!='Formulario Enviado' ">
                
                    <table class="table table-sm table-bordered">
                      <thead class="bg-light-dark">
                        <tr>
                          <th>#</th>
                          <th>Nombres</th>
                          <!-- <th>Dni</th> -->
                          <th>Telefono</th>
                          <th>Email</th> 
                          <th>Peso</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(pedidos_pasajeros, index_pedidos_pasajeros) in form.pedidos_pasajeros"
                          :key="index_pedidos_pasajeros"
                        >
                        <td>
                          {{index_pedidos_pasajeros+1}}
                        </td>
                          <td>
                            {{ pedidos_pasajeros.pasajero.nombres }}
                            {{ pedidos_pasajeros.pasajero.apellidos }}
                          </td>
                          <!-- <td>
                            {{ pedidos_pasajeros.dni }}
                          </td> -->
                          <td>
                            {{ pedidos_pasajeros.pasajero.telefono }}
                          </td>
                          <td>
                            {{ pedidos_pasajeros.pasajero.email }}
                          </td>
                          <td>
                            {{ pedidos_pasajeros.pasajero.peso }} KGS
                          </td>
                          <td>
                            <button v-if="can('orders-update') && form.estatus!='Vuelo Realizado'" class="btn btn-sm btn-icon btn-danger" @click="QuitarPasajero(pedidos_pasajeros.id)">
                              <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                  </div>

                </div>
                </div>
                </div>

                <hr>
                
                <div class="card mt-5">


                  <header_card icon="fa fa-history" titulo="Historial de Movimientos del Pedido" tipo="sub"></header_card>

                  <div class="card-body"> 

                    <table class="table table-sm table-bordered">
                      <thead class="bg-light-dark">
                        <tr>
                          <th>Fecha</th>
                          <th>Vuelo</th>
                        </tr>
                      </thead>
                    <tbody>
                    <tr v-for="(item, index) in form.movimientos" :key="index">
                      <td>
                      {{item.fecha | formatDate}}
                      </td>
                      <td>
                      {{item.observacion}}
                      </td>
                    </tr>
                    </tbody>
                    </table>

                </div>
                </div>
                
                <div class="card mt-5">


                  <header_card icon="fas fa-user-clock" titulo="Lista Espera" tipo="sub"></header_card>

                  <div class="card-body"> 
                  <div class="row pb-3">
                      <div class="col-md-6 pb-3">
                        <label for="">Zona</label>                    
                      <select class="form-control selectpicker" multiple title="Seleccione" id="selectpicker_zona_lista_espera" data-live-search="true" v-model="zona_lista_espera">
                        <option value="" selected disabled>Seleccione</option>
                        <option v-for="(item, index) in Zonas" :key="index" :value="item.id">{{item.nombre}} </option>
                      </select>   
                      </div> 
                    </div> 
                    
                    <div class="row mt-3">
                      <div class="col-md-6 pb-3">
                        <div class="row">
                          <div class="col-6"> 
                        <div class="form-group">
                          <label for="">F. Inicio (Disp.)</label>
                          <input type="date" class="form-control" v-model="fecha_inicio_disp" id="" aria-describedby="helpId" placeholder="">
                        </div>
                          </div>
                          <div class="col-6">
                            
                        <div class="form-group">
                          <label for="">F. Fin (Disp.)</label>
                          <input type="date" class="form-control" v-model="fecha_fin_disp" id="" aria-describedby="helpId" placeholder="">
                        </div>
                          </div>
                        </div>

                      </div>
                      <div class="col-md-6 pb-3">
                        <div class="row">
                          <div class="col-6">

                        <div class="form-group">
                          <label for="">F. Inicio (No Disp.)</label>
                          <input type="date" class="form-control" v-model="fecha_inicio_nodisp" id="" aria-describedby="helpId" placeholder="">
                        </div>
                          </div>
                          <div class="col-6">
                            
                        <div class="form-group">
                          <label for="">F. Fin (No Disp.)</label>
                          <input type="date" class="form-control" v-model="fecha_fin_nodisp" id="" aria-describedby="helpId" placeholder="">
                        </div>
                          </div>
                        </div> 
                      </div>
                      <div class="col-md-12 pb-3">
                        <label for="">Días</label>
                      </div>  
                      <div class="col-md-12 pb-3">
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="1"> Lunes
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="2"> Martes
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="3"> Miercoles
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="4"> Jueves
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="5"> Viernes
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="6"> Sabado
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" v-model="dias_lista_espera" id="" value="7"> Domingo
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 pb-3">
                        <button class="btn btn-primary" v-if="can('orders-update')" @click="ActualizarListaDeEspera()"> Actualizar Información de Espera </button>
                        <button class="btn btn-danger"  v-if="id_lista_espera!='' && can('orders-update')" @click="BorrarListaDeEspera()"> Eliminar Pedido de lista de Espera </button>
                      </div>  
                    </div>
                     
                </div>
                </div>



                </div>
                
                     
          <div class="card-footer">
            <router-link to="/" class="btn btn-secondary mr-2" v-if="dashboard">
              <i class="fa fa-undo"></i> Volver
            </router-link>
            <router-link to="/pedidos" class="btn btn-secondary mr-2" v-else>
              <i class="fa fa-undo"></i> Volver
            </router-link>
 
          </div>

        </div>

       
      </div>

    <div class="modal fade" id="AgruparPedidos" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Agrupar Nuevo Pedido
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <form @submit="ConfirmarAgruparPedido" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
                <div class="modal-body">
                  
                  <div class="row">   

                  <div class="col-md-12 mb-3">

                      <label for="parent_id">Pedidos</label>
                      
                      <div class="form-group">
                        <div class="input-group">
                        <v-select 
                          v-model="agrupacion"
                          class="w-100"
                          id="parent_id"
                          multiple
                          required
                          :reduce="name_vuelo => name_vuelo.id"
                          :options="recordsPedidos" 
                          label="name_vuelo">
                          </v-select>
                        </div>
                      </div> 
                  </div>                
                  </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold close2" data-dismiss="modal">Cerrar</button>
                    <button  type="submit" class="btn btn-warning" :disabled="GuardandoCambios">
                      <span v-if="GuardandoCambios">
                        <i class="fas fa-spinner fa-spin"></i> Guardando...
                      </span>
                      <span v-else>
                        Guardar
                      </span>
                    </button>
                </div>
              </form>
          </div>
      </div>
    </div> 
    </div>
    </div>
  
</template>
<script>
    
    import BaseLoading from "../../components/BaseLoading";
    
    export default {
      components: {
        BaseLoading,
      },
      props : ['id','dashboard'],
        data() {
          return { 
            records: [],  
            recordsVuelo: [],  
            recordsPedidos: [],  
            Zonas: [],  
            id_lista_espera: '',  
            zona_lista_espera: [],  
            dias_lista_espera: [],  
            fecha_inicio_disp: '',  
            fecha_fin_disp: '',  
            fecha_inicio_nodisp: '',  
            fecha_fin_nodisp: '',  
            agrupacion: [],  
            form: false,  
            GuardandoCambios: false,  
            intregacion_completada: false,
            ActualizandoIntregacionCompletada : false, 
            pedidos_nuevos: '',  
            pedidos_actualizados: '',  
            order_ya_existe: false,  
            add_form:{
              orden_wordpress : '',
              numpax : '',
              hanvolado : '',
              peso_extra : 1,
              nombre_contacto : '',
              ciudad_contacto : '',
              email_contacto : '',
              telefono_contacto : '',
              estatus : 'Creado',
            },
          }
        },
        mounted() {
          this.ValidarPermisos('orders-update');
          this.Buscar();
          this.BuscarPedidos();
        },
        methods: { 
          
          ValidarPermisos(permiso) {
            if(!this.can(permiso)){
              $(":input").prop("disabled", true);
            } 
          },

          BuscarPedidos() {
            var url = '/admin/pedidos_listado';
                axios.get(url).then(response=>{
                    this.recordsPedidos = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
          
          Buscar() {
            var url = '/admin/verpedidos/'+this.$route.params.id;;
            axios.get(url).then(response=>{
                this.form = response.data.record;   
                this.Zonas = response.data.zonas;   

              if(response.data.record.lista_espera!=null){                
                this.id_lista_espera = response.data.record.lista_espera.id;   
                this.zona_lista_espera = response.data.record.lista_espera.zonas_id;   
                this.dias_lista_espera = response.data.record.lista_espera.dias;   
                this.fecha_inicio_disp = response.data.record.lista_espera.fecha_inicio_disp;   
                this.fecha_fin_disp = response.data.record.lista_espera.fecha_fin_disp;   
                this.fecha_inicio_nodisp = response.data.record.lista_espera.fecha_inicio_nodisp;   
                this.fecha_fin_nodisp = response.data.record.lista_espera.fecha_fin_nodisp;   
              }else{
                this.id_lista_espera = '';   
                this.zona_lista_espera = [];   
                this.dias_lista_espera = [];              
                this.fecha_inicio_disp = '';              
                this.fecha_fin_disp = '';              
                this.fecha_inicio_nodisp = '';              
                this.fecha_fin_nodisp = '';              
              }

              this.BuscarVuelos();
              
            }).catch(error => {
                this.errors = error.response.data
            });
          },
          
          ActualizarListaDeEspera() {
            
            var url = '/admin/pedidos_lista_espera_update/'+this.form.id;

            axios.post(url,{
                zonas_id: this.zona_lista_espera,    
                fecha_inicio_disp: this.fecha_inicio_disp,    
                fecha_fin_disp: this.fecha_fin_disp,    
                fecha_inicio_nodisp: this.fecha_inicio_nodisp,    
                fecha_fin_nodisp: this.fecha_fin_nodisp,    
                dias: this.dias_lista_espera,    
                token         :   this.token
            }).then(response=>{              
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Datos de Lista de Espera Actualizados Correctamente');                
              } 
              this.Buscar();   
            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });
          },  
          
          BorrarListaDeEspera() {
            
              var _this = this;
              var registro = this.id_lista_espera;

              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea Eliminar este Pedido?",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/pedidos_lista_espera_delete/'+registro;

                      axios.post(url,{
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Pedido Eliminado de Lista de Espera Correctamente');
                          
                        }

                        _this.Buscar();
                                      
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                });

          },  

          async copyURL(mytext) {
            try {
              await navigator.clipboard.writeText(mytext);    
                this.$toasted.success('Enlace copiado Correctamente');   
            } catch($e) {
                this.$toasted.error('Ha ocurrido algún error!');     
            }
          },
          
          BuscarVuelos() {
            var url = '/admin/listado_vuelos_disponibles/'+this.form.vuelo_id;
                axios.get(url).then(response=>{
                    this.recordsVuelo = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },    
   
          ActualizarContacto() {
            
            var url = '/admin/actualizar_contacto';

            axios.post(url,{
                pedido_id: this.form.id,    
                nombre_contacto: this.form.nombre_contacto,
                email_contacto: this.form.email_contacto,
                telefono_contacto: this.form.telefono_contacto,
                ciudad_contacto: this.form.ciudad_contacto,
                lenguaje_contacto: this.form.lenguaje_contacto,
                token         :   this.token
            }).then(response=>{
              
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Datos de Contacto Actualizado Correctamente');
                
              }

              $("#EditPedido .close").click();
              $("#EditPedido .close2").click();
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();   
              this.Buscar();
                            
              
            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });
                      

          },  
            
          CambiarFechaVuelo() {
            
              var _this = this; 

              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea cambiar realización del Vuelo bajo el pedido N°: "+_this.form.orden_wordpress,
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/pedidos_fecha_vuelo';

                      axios.post(url,{
                          pedido_id: _this.form.id,    
                          fecha: _this.form.hanvolado,                
                          orden_wordpress: _this.form.orden_wordpress,                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Fecha de realización del vuelo Actualizado Correctamente');
                          
                        }

                        $("#EditPedido .close").click();
                        $("#EditPedido .close2").click();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();   
                        _this.Buscar();
                        _this.BuscarVuelos();
                                
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }else{
                    _this.form.hanvolado = null;
                  }
                });

          },  
          
          AgregarPasajero() {
            
              var _this = this; 

              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea Añadir un pasajero más para este pedido N°: "+_this.form.orden_wordpress,
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/pedidos_agregar_pasajero';

                      axios.post(url,{
                          pedido_id: _this.form.id,                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Pedido Actualizado Correctamente');
                          
                        }

                        $("#EditPedido .close").click();
                        $("#EditPedido .close2").click();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();   
                        _this.Buscar();
                        _this.BuscarVuelos();
                                      
                        
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                });

          },  

          BorrarPasajero() {
            
              var _this = this; 

              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea Quitar un pasajero de este pedido N°: "+_this.form.orden_wordpress,
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/pedidos_quitar_pasajero';

                      axios.post(url,{
                          pedido_id: _this.form.id,                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Pedido Actualizado Correctamente');
                          
                        }

                        $("#EditPedido .close").click();
                        $("#EditPedido .close2").click();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();   
                        _this.Buscar();
                        _this.BuscarVuelos();
                                      
                        
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                });

          },  
          QuitarPasajero(id) {
            
              var _this = this; 

              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea Quitar esta pasajero de este pedido N°: "+_this.form.orden_wordpress,
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/quitar_pasajero_pedidos/'+id;

                      axios.post(url,{             
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Pedido Actualizado Correctamente');
                          
                        }

                        $("#EditPedido .close").click();
                        $("#EditPedido .close2").click();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();   
                        _this.Buscar();
                        _this.BuscarVuelos();
                                      
                        
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                });

          },  

          ActualizarPedido() {

            var _this = this;

            var url = '/admin/pedidos/'+_this.form.id;

            axios.post(url,{
                _method: 'PUT',              
                tipo: 'data',                  
                notas: _this.form.notas,                
                token         :   _this.token
            }).then(response=>{
              
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                _this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                _this.$toasted.success('Pedido actualizado Correctamente');
                _this.Buscar();
                _this.BuscarVuelos();
          
                $("#EditPedido .close").click(); 
                $("#EditPedido .close2").click(); 
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

              }

            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });
                      
                      

          },  

          ConfirmarActualizarPedido() {
                var _this = this;
              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea actualizar el pedido para este vuelo!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/pedidos/'+_this.form.id;

                      axios.post(url,{
                          _method: 'PUT',              
                          tipo: 'vuelo',                  
                          vuelo_id: _this.form.vuelo_id,                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Pedido actualizado Correctamente');
                          _this.Buscar();
                          _this.BuscarVuelos();
                    
                          $("#EditPedido .close").click(); 
                          $("#EditPedido .close2").click(); 
                          $('body').removeClass('modal-open');
                          $('.modal-backdrop').remove();
  
                        }
    
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                });

          },  

          ConfirmarActualizarExlusividad() {
                var _this = this;
              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea actualizar el pedido para este vuelo!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/pedidos/'+_this.form.id;

                      axios.post(url,{
                          _method: 'PUT',              
                          tipo: 'exclusividad',                  
                          privado: _this.form.privado,                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Pedido actualizado Correctamente');
                          _this.Buscar();
                          _this.BuscarVuelos();
                    
                          $("#EditPedido .close").click(); 
                          $("#EditPedido .close2").click(); 
                          $('body').removeClass('modal-open');
                          $('.modal-backdrop').remove();
  
                        }
    
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }else{
                     _this.Buscar();
                         
                  }



                });

          },  
          ConfirmarAgruparPedido(evt) {
              evt.preventDefault();            
              this.GuardandoCambios = !this.GuardandoCambios;
              var _this = this;
              console.log("🚀 ~ file: show.vue ~ line 731 ~ var", _this.agrupacion);
              
              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea agrupar pedidos!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/agrupar_pedidos';
                      // _.forEach(_this.agrupacion, function(value) {
                      //   _this.form.agrupacion.push(value);
                      // });
 
                      axios.post(url,{               
                          id: _this.form.id,            
                          agrupacion: _this.agrupacion,                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Pedido actualizado Correctamente');
                          _this.Buscar();
                          _this.BuscarVuelos();
                    
                          $("#AgruparPedidos .close").click(); 
                          $("#AgruparPedidos .close2").click(); 
                          $('body').removeClass('modal-open');
                          $('.modal-backdrop').remove();
  
                        }
    
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                  
                  _this.agrupacion = [];
                  _this.GuardandoCambios = !_this.GuardandoCambios;
                });

          },  
          DesagruparPedido(id) {
              this.GuardandoCambios = !this.GuardandoCambios;
              var _this = this;
              Swal.fire({
                  title: "Confirmar!",
                  text: "Confirme que desea desagrupar pedidos!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Si, Confirmar!",
                  cancelButtonText: "No, Cancelar!",
                  reverseButtons: true
                }).then(function(result) {
                  if (result.value) {          
                    
                      var url = '/admin/desagrupar_pedidos';
 
                      // var filtered = _this.form.grupo_pedido.filter(function(value, index, arr){ 
                      //     return value.id != id;
                      // });

                      // var grupo_pedido = _.map(filtered, 'id');

                      axios.post(url,{               
                          id: _this.form.id,            
                          pedido: id,                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Pedido actualizado Correctamente');
                          _this.Buscar();
                          _this.BuscarVuelos();
                    
                          $("#AgruparPedidos .close").click(); 
                          $("#AgruparPedidos .close2").click(); 
                          $('body').removeClass('modal-open');
                          $('.modal-backdrop').remove();
  
                        }
    
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                   
                  _this.GuardandoCambios = !_this.GuardandoCambios;
                });

          },  

      },
      
      computed: { 
        
      },

      watch: {
        id: function(newValues, oldValues){
          this.Buscar();
        },
        recordsVuelo: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_vuelos').selectpicker('refresh'); });
        },
        Zonas: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_zona_lista_espera').selectpicker('refresh'); });
        },
      }



      };
    </script>
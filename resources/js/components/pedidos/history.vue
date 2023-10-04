<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-list-check text-dark"></i>
                  Pedidos Realizados
              </span>
          </h3>

        </div>

        <div class="card-body">
          <tabla-component :striped="false"
            :fields="fields" 
            :listado="records" 
            titulo="Pedido"     
            :can_ver="can('orders-read')"
            :can_editar="can('orders-update')"
            :can_eliminar="can('orders-delete')"
            @ButtonGo="ButtonGo" 
            @ButtonSetStatus="ButtonSetStatus"
            @ButtonChecked="ButtonChecked"
            @ButtonDelete="ButtonDelete"            
          ></tabla-component> 

        </div>

       
      </div>

    </div>

    <div class="modal fade" id="CrearPedido" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Crear Pedido
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <form @submit="CrearPedidosForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
                <div class="modal-body">
                  
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <h4>Datos de Pedido</h4>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="orden_wordpress">Order - ID</label>
                        <div class="input-group">
                          <input v-model="add_form.orden_wordpress" @blur="ValidarOrder()" id="orden_wordpress" type="text" class="form-control">
                          <div class="input-group-append">
                            <button class="btn btn-secondary" type="button"> <i class="fa fa-search"></i> </button>
                          </div>
                        </div>
                        <span class="text-danger" v-if="order_ya_existe"> <i class="fa-exclamation"></i>  ID Ya existe </span>
                      </div> 
                    </div>  
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="numpax">Numpax</label>
                        <input v-model="add_form.numpax" id="numpax" type="text" v-numero class="form-control">
                      </div> 
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="hanvolado">Vuelo Realizado</label>
                        <input v-model="add_form.hanvolado" id="hanvolado" type="date" class="form-control">
                      </div> 
                    </div>                 
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="estatus">Estatus</label>
                        <select v-model="add_form.estatus" id="estatus" class="form-control">                        
                          <option value="Creado"> Creado </option>
                          <option value="Formulario Incompleto"> Formulario Incompleto </option>
                          <option value="Formulario Enviado"> Formulario Enviado </option>
                          <option value="Formulario Completado"> Formulario Completado </option>
                          <option value="Vuelo Realizado"> Vuelo Realizado </option>
                          <option value="Cancelado"> Cancelado </option>
                        </select>
                      </div> 
                    </div>     
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <b-form-checkbox
                          id="checkbox-1"
                          v-model="add_form.peso_extra"
                          name="checkbox-1"
                          value="1"
                          unchecked-value="0"
                        >
                          Peso Extra?
                        </b-form-checkbox>
                      </div> 
                    </div>  
                  </div>    
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <h4>Datos de Contacto</h4>
                    </div>
                    <div class="col-md-3 mb-3">
                      <div class="form-group">
                        <label for="nombres">Nombre Completo</label>
                        <input v-model="add_form.nombre_contacto" id="nombres" type="text" class="form-control">
                        </div> 
                    </div> 
                    <div class="col-md-3 mb-3">
                      <div class="form-group">
                        <label for="apellidos">Email</label>
                        <input v-model="add_form.email_contacto" id="apellidos" type="text" class="form-control">
                      </div> 
                    </div>
                    <div class="col-md-3 mb-3">
                      <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input v-model="add_form.telefono_contacto" id="telefono" type="text" class="form-control">
                      </div> 
                    </div>  
                    <div class="col-md-3 mb-3">
                      <div class="form-group">
                        <label for="dni">Ciudad</label>
                        <input v-model="add_form.ciudad_contacto" id="dni" type="text" class="form-control">
                      </div> 
                    </div>                
                  </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold close2" data-dismiss="modal">Cerrar</button>
                    <button  type="submit" class="btn btn-warning" :disabled="order_ya_existe || GuardandoCambios">
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


</template>
<script>
    
    export default {
        data() {
          return {
            fields: [ 
              { 
                key: 'orden_wordpress', 
                label: 'Order-ID', 
                sortable: true, 
                sortDirection: 'desc',
                formatter: (value, key, item) => {
                  return value+( (item.notas!=null) ? '<span data-toggle="modal" data-target="#notaPedido'+value+'"><i class="fa fa-commenting text-warning" aria-hidden="true"></i> <strong>Ver Notas</strong></span>  <div class="modal fade" id="notaPedido'+value+'" role="dialog" aria-labelledby="asdasdasda" aria-hidden="true">          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">            <div class="modal-content">              <div class="modal-header">                <h5 class="modal-title">Notal del Pedido</h5>                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">                    <span aria-hidden="true">&times;</span>                  </button>              </div>              <div class="modal-body">'+item.notas +'</div>              <div class="modal-footer">                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>              </div>            </div>          </div>        </div>' : '');
                }
              },
              {
                key: "numpax",
                label: "N. Pax",
                sortable: true,
                sortDirection: "desc"
              },      
              {
                key: "nombre_contacto",
                label: "Contacto",
                sortable: true,
                sortDirection: "desc",
                formatter: (value, key, item) => {
                 return value+'<br> <span class=""> Tlf:'+item.telefono_contacto +'</span>';
                }
              },           
              {
                key: "name_vuelo",
                label: "Vuelo",
                sortable: true,
                sortDirection: "desc"
              },
              {
                key: "estatus",
                label: "Estado",
                sortable: true,
                sortDirection: "desc"
              },
              { key: 'checked_show', label: 'Han Volado' }, 
              {
                key: "edit_peso_extra",
                label: "P. Ext",
                sortable: true,
                sortDirection: "desc",
                formatter: (value) => {
                  return (value==1) ? 'Si' : 'No';
                },
                // variant: 'danger'
              }, 
              { key: 'actions_go', label: 'Acciones' }

              // { key: 'actions_go', label: 'Acciones' }
            ],  
            records: [],  
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
            }
          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 
          
         ButtonGo(data) {
            this.$router.push({
                path: '/pedidos/consultar/'+data.data.orden_wordpress
            });
          }, 
          ValidarOrder() { 
            var url = '/admin/pedidos/'+this.add_form.orden_wordpress;
            axios.get(url).then(response=>{
                this.order_ya_existe = response.data.record;   
            }).catch(error => {
                this.errors = error.response.data
            });
          },
          reset() {
            this.add_form = {
              orden_wordpress : '',
              numpax : '',
              hanvolado : '',
              peso_extra : 1,
              nombre_contacto : '',
              ciudad_contacto : '',
              email_contacto : '',
              telefono_contacto : '',
              estatus : 'Creado',
            };
            this.order_ya_existe = false;
          },
          CrearPedidosForm(evt) {
              evt.preventDefault();            
              this.GuardandoCambios = !this.GuardandoCambios;
              var url = '/admin/pedidos';
              axios.post(url,{
                formulario        :   this.add_form, 
                token         :   this.token
              }).then(response=>{              
                if(!response.data.result){
                  Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                  this.$toasted.error('Ha ocurrido algún error!');           
                }else{                 
                  this.$toasted.success('Pedido Creado Correctamente');    
                  
                  $("#CrearPedido .close").click();
                  $("#CrearPedido .close2").click();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();            

                }
                this.GuardandoCambios = !this.GuardandoCambios; 
                this.Buscar(); 
              }).catch(error => {
                  console.log(error);
                  this.errors = error.response
              });

          },  
    
          ButtonDelete(data) {
            this.Borrar(data);
          },

          Borrar(data) {
            
              var _this = this;
              var registro = data.data;

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
                    
                      var url = '/admin/pedidos/'+registro.id;

                      axios.post(url,{
                          _method: 'delete',                
                          token         :   _this.token
                      }).then(response=>{
                        
                        if(!response.data.result){
                          Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                          _this.$toasted.error('Ha ocurrido algún error!');           
                        }else{                 
                          _this.$toasted.success('Pedido Eliminado Correctamente');
                          
                        }

                        _this.Buscar();
                                      
                      }).catch(error => {
                          console.log(error);
                          this.errors = error.response
                      });
                  }
                });

          },  

          ButtonChecked(data) {
            this.form = data.data;
            this.form.hanvolado = data.data.vuelo.fecha;
            // this.form.hanvolado = moment().format('YYYY-MM-DD');
            this.CambiarFechaVuelo();
            console.log(this.form);
          },

          ButtonSetStatus(data) { 
            var url = '/admin/peso_extra_pedidos'; 
            axios.post(url,{
                id: data.id,                
                peso_extra: data.estatus,                
            }).then(response=>{ 
              if(!response.data.result){
                Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                this.$toasted.error('Ha ocurrido algún error!');           
              }else{                 
                this.$toasted.success('Peso Extra actualizado Correctamente');
                
              }

              this.Buscar();
                  
            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });
          },
            
          Buscar() {
            var url = '/admin/pedidos_listado_historial';
                axios.get(url).then(response=>{
                    this.records = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
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
                              
                    }).catch(error => {
                        console.log(error);
                        this.errors = error.response
                    });
                }else{
                  _this.form.hanvolado = null;
                }
              });

        },  
        
      },
      
      computed: { 
        
      },


      };
    </script>
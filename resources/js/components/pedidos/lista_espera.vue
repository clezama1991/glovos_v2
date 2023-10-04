<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-list-check text-dark"></i>
                  Lista de Esperax
              </span>
          </h3>

        </div>

        <div class="card-body">
          <tabla-component :striped="false"
            :fields="fields" 
            :listado="records" 
            :can_ver="can('waiting_list-read')"
            :can_editar="can('waiting_list-update')"
            :can_eliminar="can('waiting_list-delete')"
            titulo="Lista de espera"     
            @ButtonGo="ButtonGo" 
            @ButtonDelete="ButtonDelete" 
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
            fields: [ 
              { 
                key: 'pedido.orden_wordpress', 
                label: 'Order-ID', 
                sortable: true, 
                sortDirection: 'desc',
                formatter: (value, key, item) => {
                  return value+( (item.notas!=null) ? '<span data-toggle="modal" data-target="#notaPedido'+value+'"><i class="fa fa-commenting text-warning" aria-hidden="true"></i></span>  <div class="modal fade" id="notaPedido'+value+'" role="dialog" aria-labelledby="asdasdasda" aria-hidden="true">          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">            <div class="modal-content">              <div class="modal-header">                <h5 class="modal-title">Notal del Pedido</h5>                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">                    <span aria-hidden="true">&times;</span>                  </button>              </div>              <div class="modal-body">'+item.notas +'</div>              <div class="modal-footer">                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>              </div>            </div>          </div>        </div>' : '');
                }
              },
              {
                key: "pedido.numpax",
                label: "N. Pax",
                sortable: true,
                sortDirection: "desc"
              },  
              {
                key: "pedido.privado",
                label: "Excl.",
                sortable: true,
                sortDirection: "desc",
                formatter: (value) => {
                  return (value==1) ? 'Si' : 'No';
                },
                // variant: 'danger'
              },     
              {
                key: "pedido.nombre_contacto",
                label: "Contacto",
                sortable: true,
                sortDirection: "desc",
                formatter: (value, key, item) => {
                 return value;
                }
              },   
              {
                key: "pedido.telefono_contacto",
                label: "Tlf",
                sortable: true,
                sortDirection: "desc",
                formatter: (value, key, item) => {
                 return value;
                }
              }, 
              {
                key: "pedido.estatus",
                label: "Estado",
                sortable: true,
                sortDirection: "desc"
              },
              { 
                key: 'created_at', 
                label: 'Fecha Lista',
                formatter: (value) => {
                  return moment(value).format('DD/MM/YYYY');
                },
              }, 
              { key: 'actions_go', label: 'Acciones' }

              // { key: 'actions_go', label: 'Acciones' }
            ],  
            records: [],  
            nota_pedido: '',  
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
                path: '/pedidos/consultar/'+data.data.pedido.orden_wordpress
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
                    
                      var url = '/admin/pedidos_lista_espera_delete/'+registro.id;

                      axios.post(url,{
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

          Buscar() {
            var url = '/admin/pedidos_lista_de_espera';
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
<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">

        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-file text-dark"></i>
                Aplicar Entrenamiento
              </span>
          </h3>

        </div>
 
        <form
          @submit="RegistarForm"
          method="POST"
          enctype="multipart/form-data"
          class="form"
          id="GuardarServiciosSolucionLimpieza"
        >
                <div class="card-body">
  

                  <h3>Datos del Entrenamiento</h3>
                  <div class="row pb-20"> 
                        
                    <div class="col-md-4  mb-3">
                      <div class="form-group">
                        <label for="formulario_id">Nombre del Formulario</label>
                        <input :value="form.formulario.nombre" disabled readonly id="formulario_id" type="text" class="form-control disabled form-control-solid">
                      </div> 
                    </div>   
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="globo_id">Globo</label>
                        <v-select 
                        v-model="form.globo_id"
                        class="w-100"
                        id="globo_id"
                        :reduce="nombre => nombre.id"
                        :selectable="(option) => !option._rowVariant"
                        :options="Globos" 
                        label="nombre">
                        </v-select>
                        <input type="checkbox" name="globo_no_existe" id="globo_no_existe" v-model="globo_no_existe"><label for="globo_no_existe">Globo no Registrado</label>
                      </div> 
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="responsable">Responsable</label>
                        <input v-model="form.responsable" id="responsable" type="text" class="form-control">
                      </div> 
                    </div>   
   
                    <div class="col-md-4" v-if="globo_no_existe">
                      <div class="form-group">
                        <label for="modelo_globo">Modelo Globo</label>
                        <input v-model="form.modelo_globo" id="modelo_globo" type="text" class="form-control">
                      </div> 
                    </div> 
                    <div class="col-md-4" v-if="globo_no_existe">
                      <div class="form-group">
                        <label for="marca_globo">Marca Globo</label>
                        <input v-model="form.marca_globo" id="marca_globo" type="text" class="form-control">
                      </div> 
                    </div>
                    <div class="col-md-4" v-if="globo_no_existe">
                      <div class="form-group">
                        <label for="matricula_globo">Matricula Globo</label>
                        <input v-model="form.matricula_globo" id="matricula_globo" type="text" class="form-control">
                      </div> 
                    </div>   
                    

                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="fecha">Fecha Asignación</label>
                        <input :value="form.fecha" disabled readonly id="fecha" type="date" class="form-control disabled form-control-solid">
                      </div> 
                    </div>  

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="fecha_aplicacion">Fecha Aplicación</label>
                        <input :value="form.fecha_aplicacion" disabled readonly id="fecha_aplicacion" type="date" class="form-control disabled form-control-solid">
                      </div> 
                    </div>  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="estatus">Estatus</label>
                        <input :value="form.estatus" disabled readonly id="estatus" type="text" class="form-control disabled form-control-solid">
                      </div> 
                    </div>  

                  </div>    
        
        
                  
        <h3>Resultados del Entrenamiento</h3>
        <table width="100%" style="font-size: 13px" class="table table-bordered table-striped">
          <thead style="background-color: #222B64; color:white;">
            <th class="cabeceras-evaluaciones" style="padding: 5px 10px; text-align: center; border: 1px solid white; ">Secciones
            </th>
            <th class="cabeceras-evaluaciones" style="width: 25.5%; padding: 5px 10px; text-align: center; border: 1px solid white;">Valorar
            </th>
          </thead>

          <tbody>

            <tr class="objetivos"  v-for="(item_1,key_1) in secciones" :key="key_1">

              <td style="padding: 5px;" width="20%" class="align-middle text-center font-weight-bolder h4">
                 {{ item_1.nombre  }}
              </td>

              <td colspan="4" style="padding: 5px"  width="80%">
                
                <table class="table mb-0 table-bordered table-striped">

                  <tr v-for="(item_2,key_2) in item_1.secciones_preguntas" :key="key_2">

                    <template v-if="item_2.secciones_preguntas.length==0">
                      <td style="padding: 5px;"  width="90%" class="align-middle text-center">
                      {{ item_2.nombre  }}
                      </td>
                      <td class="text-right align-middle">
                        <input type="checkbox" name="" id="" v-model="item_2.valor">
                      </td>   
                    </template>
                    <template v-else>
                      <td style="padding: 5px;" width="45%" class="align-middle text-center">
                      {{ item_2.nombre  }}
                      </td>
                      <td class="pr-0 align-middle text-center">

                        <table class="table table-bordered table-striped mb-0">

                          <tr v-for="(item_3,key_3) in item_2.secciones_preguntas" :key="key_3">

                            <template v-if="item_3.secciones_preguntas.length==0">
                              <td style="padding: 5px;"  width="90%" class="align-middle text-center">
                              {{ item_3.nombre  }}
                              </td>
                              <td class="text-right align-middle">
                                <input type="checkbox" name="" id="" v-model="item_3.valor">
                              </td>   
                            </template>
                            <template v-else>
                              <td style="padding: 5px;"  width="45%" class="align-middle text-center">
                              {{ item_3.nombre  }} s
                              </td>
                              <td class="px-0 align-middle text-center" >
                                <table class="table mb-0 table-bordered table-striped">

                                  <tr v-for="(item_4,key_4) in item_3.secciones_preguntas" :key="key_4">

                                    <template v-if="item_4.secciones_preguntas.length==0">
                                      <td style="padding: 5px;"  width="90%"  class="align-middle text-center">
                                      {{ item_4.nombre  }}
                                      </td>
                                      <td class="text-right align-middle">
                                        <input type="checkbox" name="" id="" v-model="item_4.valor">
                                      </td>   
                                    </template>
                                    <template v-else>
                                      <td style="padding: 5px;"  width="90%"  class="align-middle text-center">
                                      {{ item_4.nombre  }}
                                      </td>
                                    </template>
                                  </tr>
                                </table>
                                
                              </td>  
                            </template>
                          </tr>
                        </table>
                        
                      </td>  
                    </template>

                    </tr>

                </table>

              </td> 

            </tr>
          </tbody>
            
          </table>
          




                  <div class="row pt-10"> 
                        
                    <div class="col-md-12">
                      <div class="form-group">
                        <h3>Resultados</h3>
                        <textarea v-model="form.resultados" id="resultado" class="form-control">
                        </textarea>
                      </div> 
                    </div>   
                  </div>   
                  <div class="row pt-10"> 
                        
                    <div class="col-md-12">
                      <div class="form-group">
                        <h3>Observaciones</h3>
                        <textarea v-model="form.observaciones" id="observaciones" class="form-control">
                        </textarea>
                      </div> 
                    </div>   
                  </div>   








                    </div>
  
        
        <div class="card-footer">
          <router-link :to="'/pilotos/formularios/'+this.$route.params.id" class="btn btn-secondary mr-2">
            <i class="fa fa-undo"></i> Volver
          </router-link> 
            <button
              type="submit"
              class="btn btn-primary mr-3 float-right"
              :disabled="GuardandoCambios"
            >
              <span v-if="GuardandoCambios">
                <i class="fas fa-spinner fa-spin"></i> Guardando...
              </span>
              <span v-else> <i class="fa fa-save"></i> Guardar </span>
            </button>
        </div>

        </form>
       
      </div>

    </div>

  </div>


</template>
<script>
    
    export default {
      props : ['id','id_formulario'],
        data() {
          return {
              GuardandoCambios:false,
              globo_no_existe:false,
              secciones : [],
              form : '',
              Globos : [], 
          }
        },
        mounted() {
          this.Buscar();
          this.BuscarGlobos();
        },
        methods: { 
          
          BuscarGlobos() {
            var url = '/admin/listado_globos';
                axios.get(url).then(response=>{
                    this.Globos = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
         Buscar() {
            var url = '/admin/pilotos_entrenamiento/'+this.$route.params.id_formulario;
            axios.get(url).then(response=>{
                this.form = response.data.record; 
                this.globo_no_existe = (this.form.globo_id==null)?true:false;
                this.secciones = response.data.cuestionario; 
            }).catch(error => {
                this.errors = error.response.data
            });
          },
    
          RegistarForm(evt) {
              evt.preventDefault();            
              this.GuardandoCambios = !this.GuardandoCambios;
              var url = '/admin/pilotos_entrenamiento/'+this.$route.params.id_formulario;
              axios.post(url,{
                estatus        :   'Formulario Completado', 
                fecha_aplicacion        :   moment().format('YYYY-MM-DD'), 
                entrenamiento        :   this.secciones, 
                globo_id        :   this.form.globo_id,
                modelo_globo        :   this.form.modelo_globo,
                marca_globo        :   this.form.marca_globo,
                matricula_globo        :   this.form.matricula_globo,
                responsable        :   this.form.responsable,
                resultados        :   this.form.resultados,
                observaciones        :   this.form.observaciones,
                _method : 'PUT',
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
      },
      
  
      computed: {  
    }


      };
    </script>
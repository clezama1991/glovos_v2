<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-route text-dark"></i>

                Registrar Zona
              </span>
          </h3>

        </div>
 
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
    
          <div class="row">
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="nombres">Nombre</label>
                <input v-model="form.nombre" id="nombres" type="text" class="form-control" required>
              </div> 
            </div> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="nombre_corto">Nombre Corto</label>
                <input v-model="form.nombre_corto" id="nombre_corto" type="text" class="form-control" required>
              </div> 
            </div>  
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="mtom">Foto</label>
                  <b-form-file 
                    id="foto"
                    ref="form_foto"
                    placeholder="Buscar FOTO..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="color">Color Fondo</label>
                <input v-model="form.color" id="color" type="color" class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="color_text">Color Texto</label>
                <input v-model="form.color_text" id="color_text" type="color" class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="aerop_cercano">Aeropuerto Cercano</label>
                <input v-model="form.aerop_cercano" id="aerop_cercano" type="text" class="form-control" required>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="icao">ICAO</label>
                <input v-model="form.icao" id="icao" type="text" class="form-control">
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="frecuencia">Frecuencia</label>
                <input v-model="form.frecuencia" id="frecuencia" type="text" class="form-control" required>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="altura_despegue_global">Altura Despegue</label>
                <input v-model="form.altura_despegue_global" v-numero id="altura_despegue_global" type="text" class="form-control" required>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="meteoblue_url">URL Meteoblue</label>
                <input v-model="form.meteoblue_url" id="meteoblue_url" type="text" class="form-control">
              </div> 
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="nota">Notas</label>
                <textarea v-model="form.notas" id="nota" type="text" class="form-control">
                </textarea>
              </div> 
            </div> 
            
              <div class="col-md-12">
                <div class="card card-info mb-5"> 

                  <header_card icon="fa fa-envelope" titulo="Zonas de Despegues" tipo="sub"></header_card>

                  <div class="card-body">  
                    <div class="row">
                      
                  
                  <table class="table table-bordered table-striped table-bordere table-hover">
                      <thead>
                          <tr>
                              <th scope="col" class="text-center"># Desp</th>
                              <th scope="col" class="text-center">Nombre</th>
                              <th scope="col" class="text-center">URL Despegue</th>
                              <th scope="col" class="text-center">Altura Despegue</th>
                              <th scope="col" class="text-center">Mensaje</th>
                          </tr> 
                      </thead>
                      <tbody>
                          <tr>
                            <td width="5%">
                              1
                            </td>
                          <td width="15%">
                            <input v-model="form.nombre_despegue_1" id="nombre_despegue_1" type="text" class="form-control" :required="form.despegue_whatsapp=='1'">
                            <input v-model="form.despegue_whatsapp" type="radio" name="despegue_whatsapp" id="despegue_whatsapp_1" value="1" checked> <label for="despegue_whatsapp_1">Pred. para Whatsapp</label>
                          </td>
                          <td width="15%">
                            <input v-model="form.url_despegue_1" id="url_despegue_1" type="text" class="form-control" :required="form.despegue_whatsapp=='1'">
                          </td>
                          <td width="15%">
                            <input v-model="form.altura_despegue_1" v-numero id="altura_despegue_1" type="text" class="form-control" :required="form.despegue_whatsapp=='1'">
                          </td>
                          <td width="40%">
                            <editor
                                :api-key="api_key"
                                cloud-channel="5-dev"
                                :init="option" 
                                v-model="form.msg_despegue_1" id="msg_despegue_1"
                              />                               
                          </td>
                          </tr>
                          <tr>
                            <td>
                              2
                            </td>
                          <td>
                            <input v-model="form.nombre_despegue_2" id="nombre_despegue_2" type="text" class="form-control" :required="form.despegue_whatsapp=='2'">
                            <input v-model="form.despegue_whatsapp" type="radio" name="despegue_whatsapp" id="despegue_whatsapp_2" value="2" checked> <label for="despegue_whatsapp_2">Pred. para Whatsapp</label>
                          </td>
                          <td>
                            <input v-model="form.url_despegue_2" id="url_despegue_2" type="text" class="form-control" :required="form.despegue_whatsapp=='2'">
                          </td>
                          <td>
                            <input v-model="form.altura_despegue_2" v-numero id="altura_despegue_2" type="text" class="form-control" :required="form.despegue_whatsapp=='2'">
                          </td>
                          <td width="50%">
                            <editor
                                :api-key="api_key"
                                cloud-channel="5-dev"
                                :init="option" 
                                v-model="form.msg_despegue_2" id="msg_despegue_2"
                              />                               
                          </td>
                          </tr>
                          <tr>
                            <td>
                              3
                            </td>
                          <td>
                            <input v-model="form.nombre_despegue_3" id="nombre_despegue_3" type="text" class="form-control" :required="form.despegue_whatsapp=='3'">
                            <input v-model="form.despegue_whatsapp" type="radio" name="despegue_whatsapp" id="despegue_whatsapp_3" value="3" checked> <label for="despegue_whatsapp_3">Pred. para Whatsapp</label>
                          </td>
                          <td>
                            <input v-model="form.url_despegue_3" id="url_despegue_3" type="text" class="form-control" :required="form.despegue_whatsapp=='3'">
                          </td>
                          <td>
                            <input v-model="form.altura_despegue_3" v-numero id="altura_despegue_3" type="text" class="form-control" :required="form.despegue_whatsapp=='3'">
                          </td>
                          <td width="50%">
                            <editor
                                :api-key="api_key"
                                cloud-channel="5-dev"
                                :init="option" 
                                v-model="form.msg_despegue_3" id="msg_despegue_3"
                              />                               
                          </td>
                          </tr>
                          <tr>
                            <td>
                              4
                            </td>
                          <td>
                            <input v-model="form.nombre_despegue_4" id="nombre_despegue_4" type="text" class="form-control" :required="form.despegue_whatsapp=='4'">
                            <input v-model="form.despegue_whatsapp" type="radio" name="despegue_whatsapp" id="despegue_whatsapp_4" value="4" checked> <label for="despegue_whatsapp_4">Pred. para Whatsapp</label>
                          </td>
                          <td>
                            <input v-model="form.url_despegue_4" id="url_despegue_4" type="text" class="form-control" :required="form.despegue_whatsapp=='4'">
                          </td>
                          <td>
                            <input v-model="form.altura_despegue_4" v-numero id="altura_despegue_4" type="text" class="form-control" :required="form.despegue_whatsapp=='4'">
                          </td>
                          <td width="50%">
                            <editor
                                :api-key="api_key"
                                cloud-channel="5-dev"
                                :init="option" 
                                v-model="form.msg_despegue_4" id="msg_despegue_4"
                              />                               
                          </td>
                          </tr>
                          <tr>
                            <td>
                              5
                            </td>
                          <td>
                            <input v-model="form.nombre_despegue_5" id="nombre_despegue_5" type="text" class="form-control" :required="form.despegue_whatsapp=='5'">
                            <input v-model="form.despegue_whatsapp" type="radio" name="despegue_whatsapp" id="despegue_whatsapp_5" value="5" checked> <label for="despegue_whatsapp_5">Pred. para Whatsapp</label>
                          </td>
                          <td>
                            <input v-model="form.url_despegue_5" id="url_despegue_5" type="text" class="form-control" :required="form.despegue_whatsapp=='5'">
                          </td>
                          <td>
                            <input v-model="form.altura_despegue_5" v-numero id="altura_despegue_5" type="text" class="form-control" :required="form.despegue_whatsapp=='5'">
                          </td>
                          <td width="50%">
                            <editor
                                :api-key="api_key"
                                cloud-channel="5-dev"
                                :init="option" 
                                v-model="form.msg_despegue_5" id="msg_despegue_5"
                              />                               
                          </td>
                          </tr>
                      </tbody>
                  </table>
                        
                        
                        
                    </div> 
                  </div>
                </div>
              </div>
                      
              <div class="col-md-12">
                <div class="card card-info mb-5"> 

                  <header_card icon="fa fa-envelope" titulo="Mensajes / Notificaciones" tipo="sub"></header_card>

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4 mb-15"> 
                        <label class="" for="mensaje_cancelacion_1">
                            Mensaje de Cancelacion 1
                        </label>
                        <editor
                            :api-key="api_key"
                            cloud-channel="5-dev"
                            :init="option" 
                            v-model="form.mensaje_cancelacion_1" id="mensaje_cancelacion_1"
                         /> 
                      </div>
                      <div class="col-md-4 mb-15"> 
                        <label class="" for="mensaje_cancelacion_2">
                            Mensaje de Cancelacion 2
                        </label>
                        <editor
                            :api-key="api_key"
                            cloud-channel="5-dev"
                            :init="option" 
                            v-model="form.mensaje_cancelacion_2" id="mensaje_cancelacion_2"
                         /> 
                      </div>
                      <div class="col-md-4 mb-15"> 
                        <label class="" for="mensaje_cancelacion_3">
                            Mensaje de Cancelacion 3
                        </label>
                        <editor
                            :api-key="api_key"
                            cloud-channel="5-dev"
                            :init="option" 
                            v-model="form.mensaje_cancelacion_3" id="mensaje_cancelacion_3"
                         /> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div> 
          
        </div>

        
        <div class="card-footer">
          <router-link to="/zonas" class="btn btn-secondary mr-2">
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
    
 import Editor from '@tinymce/tinymce-vue'
    export default {
        components: {
            'editor': Editor
        },
        data() {
          return {    
            api_key:'4uqg5bfl6an0lmdfdghkap4yfejy8ovqglkfaahssobrd8mv',
            option:{
                height: 150,
                menubar: false,
                plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
                ],
                toolbar:
                'undo redo | formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat | help'
            }, 
            GuardandoCambios : false, 
            form:{         
              nombre : '',
              nombre_corto : '',
              color : '',
              color_text : '#FFFFFF',
              nombre_despegue_1 : '',
              url_despegue_1 : '',
              msg_despegue_1 : '',
              altura_despegue_1 : '',
              nombre_despegue_2 : '',
              url_despegue_2 : '',
              msg_despegue_2 : '',
              altura_despegue_2 : '',
              nombre_despegue_3 : '',
              url_despegue_3 : '',
              msg_despegue_3 : '',
              altura_despegue_3 : '',
              nombre_despegue_4 : '',
              url_despegue_4 : '',
              msg_despegue_4 : '',
              altura_despegue_4 : '',
              nombre_despegue_5 : '',
              msg_despegue_5 : '',
              altura_despegue_5 : '',
              aerop_cercano : '',
              frecuencia : '',
              notas : '',
              mensaje_personalizado : '',
              despegue_whatsapp : 1,
              altura_despegue : '',
              meteoblue_url : '',
              mensaje_cancelacion_1 : '',
              mensaje_cancelacion_2 : '',
              mensaje_cancelacion_3 : '',
              icao : '',
            },

          }
        },
        mounted() {
          // this.Buscar();
        },
        methods: { 
 
          reset() {


            this.form  = {   
              nombre : '',
              nombre_corto : '',
              color : '',
              color_text : '#FFFFFF',
              nombre_despegue_1 : '',
              url_despegue_1 : '',
              msg_despegue_1 : '',
              altura_despegue_1 : '',
              nombre_despegue_2 : '',
              url_despegue_2 : '',
              msg_despegue_2 : '',
              altura_despegue_2 : '',
              nombre_despegue_3 : '',
              url_despegue_3 : '',
              msg_despegue_3 : '',
              altura_despegue_3 : '',
              nombre_despegue_4 : '',
              url_despegue_4 : '',
              msg_despegue_4 : '',
              altura_despegue_4 : '',
              nombre_despegue_5 : '',
              msg_despegue_5 : '',
              altura_despegue_5 : '',
              aerop_cercano : '',
              frecuencia : '',
              notas : '',
              mensaje_personalizado : '',
              despegue_whatsapp : 1,
              altura_despegue : '',
              meteoblue_url : '',
              mensaje_cancelacion_1 : '',
              mensaje_cancelacion_2 : '',
              mensaje_cancelacion_3 : '',
              icao : '',
            };
            this.$refs['form_foto'].reset();

          },
 
 
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var form_foto = this.$refs.form_foto.files[0];

              let formData = new FormData();
  
              formData.append('form_foto', form_foto);
              
              formData.append('nombre', this.form.nombre);
              formData.append('nombre_corto', this.form.nombre_corto);
              formData.append('color', this.form.color);
              formData.append('color_text', this.form.color_text);
              formData.append('nombre_despegue_1', this.form.nombre_despegue_1);
              formData.append('url_despegue_1', this.form.url_despegue_1);
              formData.append('msg_despegue_1', this.form.msg_despegue_1);
              formData.append('altura_despegue_1', this.form.altura_despegue_1);
              formData.append('nombre_despegue_2', this.form.nombre_despegue_2);
              formData.append('url_despegue_2', this.form.url_despegue_2);
              formData.append('msg_despegue_2', this.form.msg_despegue_2);
              formData.append('altura_despegue_2', this.form.altura_despegue_2);
              formData.append('nombre_despegue_3', this.form.nombre_despegue_3);
              formData.append('url_despegue_3', this.form.url_despegue_3);
              formData.append('msg_despegue_3', this.form.msg_despegue_3);
              formData.append('altura_despegue_3', this.form.altura_despegue_3);
              formData.append('nombre_despegue_4', this.form.nombre_despegue_4);
              formData.append('url_despegue_4', this.form.url_despegue_4);
              formData.append('msg_despegue_4', this.form.msg_despegue_4);
              formData.append('altura_despegue_4', this.form.altura_despegue_4);
              formData.append('nombre_despegue_5', this.form.nombre_despegue_5);
              formData.append('msg_despegue_5', this.form.msg_despegue_5);
              formData.append('altura_despegue_5', this.form.altura_despegue_5);
              formData.append('aerop_cercano', this.form.aerop_cercano);
              formData.append('frecuencia', this.form.frecuencia);
              formData.append('notas', this.form.notas);
              formData.append('mensaje_personalizado', this.form.mensaje_personalizado);
              formData.append('despegue_whatsapp', this.form.despegue_whatsapp);
              formData.append('altura_despegue', this.form.altura_despegue);
              formData.append('meteoblue_url', this.form.meteoblue_url);
              formData.append('mensaje_cancelacion_1', this.form.mensaje_cancelacion_1);
              formData.append('mensaje_cancelacion_2', this.form.mensaje_cancelacion_2);
              formData.append('mensaje_cancelacion_3', this.form.mensaje_cancelacion_3);
              formData.append('icao', this.form.icao);
  
               var url = '/admin/zonas';

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar Globo', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Zona Registrada Correctamente');                  
                  this.reset();
                }     


              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 

      },
      
  
      computed: { 
         
    }


      };
    </script>
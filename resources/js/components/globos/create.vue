<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-lightbulb text-dark"></i>
              Registrar Globo
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
                <label for="matricula">Matricula</label>
                <input v-model="form.matricula" id="matricula" type="text" class="form-control" required>
              </div> 
            </div>  
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="peso_globo">Peso Globo KGS</label>
                <input v-model="form.peso_globo" id="peso_globo" type="text" v-numero class="form-control" required> 
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
                <label for="modelo_id">Modelo</label>
                  <v-select 
                    v-model="form.modelo_id"
                    class="w-100"
                    id="modelo_id"
                    :reduce="modelo_globo => modelo_globo.id"
                    :options="modelos" 
                    label="modelo_globo">            
                      <template #search="{ attributes, events }">
                          <input
                          class="vs__search"
                          :required="!form.modelo_id"
                          v-bind="attributes"
                          v-on="events"
                          />
                      </template>
                    </v-select> 
               </div> 
            </div>   
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="fabricante">Fabricante</label>
                <input v-model="form.fabricante" disabled id="fabricante" type="text" class="form-control">
              </div> 
            </div> 
            
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="mtom">MTOM KGS</label>
                <input v-model="form.mtom" disabled v-numero id="mtom" type="text" class="form-control" required>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="min_mtom">Min. MTOM KGS</label>
                <input v-model="form.min_mtom" disabled v-numero  id="min_mtom" type="text" class="form-control"> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="hora_total_vuelo">Hora Total Vuelo</label>
                <input v-model="form.hora_total_vuelo" id="hora_total_vuelo" type="text" class="form-control"> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="bottom_end_id">Bottom Ends</label>
                  <v-select 
                    v-model="form.bottom_end_id"
                    class="w-100"
                    disabled
                    id="bottom_end_id"
                    :reduce="bottom_end => bottom_end.id"
                    :options="botom_ends" 
                    label="bottom_end">            
                      <template #search="{ attributes, events }">
                          <input
                          class="vs__search"
                          :required="!form.bottom_end_id"
                          v-bind="attributes"
                          v-on="events"
                          />
                      </template>
                    </v-select> 
               </div> 
            </div> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="peso_cesta">Peso Cesta KGS</label>
                <input v-model="form.peso_cesta" disabled id="peso_cesta" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="peso_botellas">Peso Botellas KGS</label>
                <input v-model="form.peso_botellas" disabled id="peso_botellas" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="peso_quemador">Peso Quemador KGS</label>
                <input v-model="form.peso_quemador" disabled id="peso_quemador" type="text" v-numero class="form-control" required> 
              </div> 
            </div>  
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="cert_matricula">Certificado de Matricula</label>
                  <b-form-file 
                    id="cert_matricula"
                    ref="form_cert_matricula"
                    placeholder="Buscar Certificado..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="seguro">Seguro</label>
                  <b-form-file 
                    id="seguro"
                    ref="form_seguro"
                    placeholder="Buscar Seguro..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="arc_doc">ARC Digital</label>
                  <b-form-file 
                    id="arc_doc"
                    ref="form_arc_doc"
                    placeholder="Buscar ARC..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="arc">ARC</label>
                <input v-model="form.arc" id="arc" type="date" class="form-control" required 
                                :class="{'bg-danger':form.arc!='' && form.arc<dateNow}">                
                <span class="form-text text-muted" v-if="form.arc!='' && form.arc<dateNow">
                  La fecha del arc esta caducada
                </span> 
              </div> 
            </div>
             
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="certiricado_aeronavegabilidad_doc">Certificado de Aeronavegabilidad </label>
                  <b-form-file 
                    required
                    id="certiricado_aeronavegabilidad_doc"
                    ref="form_certiricado_aeronavegabilidad_doc"
                    placeholder="Buscar Certificado de Aeronavegabilidad..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>

            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="habilitacion_nivel">Catégorias de Habilitación </label>
                <v-select 
                v-model="form.habilitacion_nivel"
                class="w-100"
                id="habilitacion_nivel"
                :options="Habilitacion" >
                      
                  <template #search="{ attributes, events }">
                      <input
                      class="vs__search"
                      :required="!form.habilitacion_nivel"
                      v-bind="attributes"
                      v-on="events"
                      />
                  </template>

                </v-select>
              </div> 
            </div> 
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="volumen">Volúmen(ft3)</label>
                <input v-model="form.volumen" id="volumen" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
   

            <div class="col-md-12 mb-3">
              <div class="form-group">
                <label for="nota">Notas</label>
                <textarea v-model="form.notas" id="nota" type="text" class="form-control">
                </textarea>
              </div> 
            </div> 
          </div> 
          
        </div>

        
        <div class="card-footer">
          <router-link to="/globos" class="btn btn-secondary mr-2">
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
        data() {
          return {
            GuardandoCambios : false,
            doc_licencia:false,
            form:{         
              volumen : '',
              nombre : '',
              matricula : '',
              fabricante : '',
              modelo_id : '',
              mtom : '',
              min_mtom : '',
              hora_total_vuelo : '',
              arc : '',
              peso_cesta : '',
              peso_globo : '',
              peso_botellas : '',
              peso_quemador : '',
              notas : '',
              habilitacion_nivel : '',
              bottom_end_id : '',
            },
            Habilitacion : ['A','B','C','D'],
            modelos : [],
            botom_ends : [],

          }
        },
        mounted() {
          this.BuscarModelos();
          this.BuscarBottomEnd();
        },
        methods: { 
 
          BuscarModelos() {
            var url = '/admin/listado_tabla_carga';
                axios.get(url).then(response=>{
                    this.modelos = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
          BuscarBottomEnd() {
            var url = '/admin/listado_globo_bottom_end';
            axios.get(url).then(response=>{
                this.botom_ends = response.data.records;   
            }).catch(error => {
                this.errors = error.response.data
            });
          },
          reset() {


            this.form  = {         
              volumen : '',
              nombre : '',
              matricula : '',
              fabricante : '',
              modelo_id : '',
              mtom : '',
              min_mtom : '',
              arc : '',
              peso_cesta : '',
              peso_globo : '',
              peso_botellas : '',
              hora_total_vuelo : '',
              peso_quemador : '',
              notas : '',
              habilitacion_nivel : '',
              bottom_end_id : '',
            };


            this.$refs['form_arc_doc'].reset();
            this.$refs['form_cert_matricula'].reset();
            this.$refs['form_seguro'].reset();
            this.$refs['form_certiricado_aeronavegabilidad_doc'].reset();

          },
 
 
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var form_arc_doc = this.$refs.form_arc_doc.files[0];
              var form_cert_matricula = this.$refs.form_cert_matricula.files[0];
              var form_seguro = this.$refs.form_seguro.files[0];
              var form_foto = this.$refs.form_foto.files[0];
              var form_certiricado_aeronavegabilidad_doc = this.$refs.form_certiricado_aeronavegabilidad_doc.files[0];

              let formData = new FormData();
  
              formData.append('form_arc_doc', form_arc_doc);
              formData.append('form_cert_matricula', form_cert_matricula);
              formData.append('form_seguro', form_seguro);
              formData.append('form_foto', form_foto);
              formData.append('form_certiricado_aeronavegabilidad_doc', form_certiricado_aeronavegabilidad_doc);
              
              formData.append('volumen', this.form.volumen);
              formData.append('nombre', this.form.nombre);
              formData.append('matricula', this.form.matricula);
              formData.append('fabricante', this.form.fabricante);
              formData.append('modelo_id', this.form.modelo_id);
              formData.append('mtom', this.form.mtom);
              formData.append('min_mtom', this.form.min_mtom);
              formData.append('hora_total_vuelo', this.form.hora_total_vuelo);
              formData.append('arc', this.form.arc);
              formData.append('peso_cesta', this.form.peso_cesta);
              formData.append('peso_globo', this.form.peso_globo);
              formData.append('peso_botellas', this.form.peso_botellas);
              formData.append('peso_quemador', this.form.peso_quemador);
              formData.append('notas', this.form.notas);
              formData.append('habilitacion_nivel', this.form.habilitacion_nivel);
              formData.append('bottom_end_id', this.form.bottom_end_id);
  
               var url = '/admin/globos';

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al registrar Globo', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Globo Registrado Correctamente');                  
                  this.reset();
                }     


              }).catch(error => {
                  this.errors = error.response.data
              });                

        }, 

      },
      
  
      computed: { 
         
        dateNow(){
          return moment().format('YYYY-MM-DD');
        },   
    },

    watch: {
      'form.modelo_id': function (id) {        
          var modelos = this.modelos; 
          var model = _.find(modelos, ['id', id]);
          this.form.fabricante = model['fabricante'];    
          this.form.mtom = model['mtom'];    
          this.form.min_mtom = model['min_mtom'];    
      },
      'form.bottom_end_id': function (id) {        
          var botom_ends = this.botom_ends; 
          var model = _.find(botom_ends, ['id', id]);
          this.form.peso_quemador = model['peso_quemador'];    
          this.form.peso_cesta = model['peso_cesta'];    
          this.form.peso_botellas = model['peso_botellas'];  
      },
    },

      };
    </script>
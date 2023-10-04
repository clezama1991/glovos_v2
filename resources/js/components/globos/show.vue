<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-lightbulb text-dark"></i>
              Consultar Globo
              </span>
          </h3>

        </div>
 
    <form @submit="ActualizarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
               
          <div class="row" v-if="form.logo">
            <div class="col-md-12 mb-3 text-center">
              <div class="form-group">
                  <img :src="form.logo" alt="" style="max-width: 200px;">
              </div> 
            </div> 
            <div class="col-md-12 mb-3">
              <hr>
            </div>
          </div> 
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
                  <a :href="form.logo" v-if="form.logo!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar ARC Digital"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="foto"
                    v-model="form_foto"
                    placeholder="Buscar FOTO..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="modelo_id">Modelo</label>
                <select class="form-control selectpicker" id="selectpicker_modelos" required data-live-search="true" v-model="form.modelo_id">
                  <option value="" selected disabled>Seleccione</option>
                  <option v-for="(item, index) in modelos" :key="index" :value="item.id">{{item.modelo_globo}}</option>
                </select>
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
                <input v-model="form.mtom" disabled v-numero id="mtom" type="tel" class="form-control" required>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="min_mtom">Min. MTOM KGS</label>
                <input v-model="form.min_mtom" disabled id="min_mtom" type="text" class="form-control" required> 
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
                <select class="form-control selectpicker" id="selectpicker_bottom_end" required data-live-search="true" v-model="form.bottom_end_id">
                  <option value="" selected disabled>Seleccione</option>
                  <option v-for="(item, index) in BottomEndCompatibles" :key="index" :value="item.id" :disabled="option._rowVariant">{{item.bottom_end}}</option>
                  </select>
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
                <a :href="form.cert_matricula" v-if="form.cert_matricula!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Certificado de Matricula"> Descargar</a>
                <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="cert_matricula"
                    v-model="form_cert_matricula"
                    placeholder="Buscar Certificado..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="seguro">Seguro</label>
                  <a :href="form.seguro" v-if="form.seguro!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar Seguro"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="seguro"
                    v-model="form_seguro"
                    placeholder="Buscar Seguro..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="arc_doc">ARC Digital</label>
                  <a :href="form.arc_doc" v-if="form.arc_doc!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar ARC Digital"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="arc_doc"
                    v-model="form_arc_doc"
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
                <label for="form_certiricado_aeronavegabilidad_doc">Certificado de Aeronavegabilidad</label>
                  <a :href="form.certiricado_aeronavegabilidad_doc" v-if="form.certiricado_aeronavegabilidad_doc!=null" target="_blank" class="ml-2 badge badge-primary badge-pill" title="Descargar ARC Digital"> Descargar</a>
                  <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span>
                  <b-form-file 
                    id="form_certiricado_aeronavegabilidad_doc"
                    v-model="form_certiricado_aeronavegabilidad_doc"
                    placeholder="Buscar Certificado de Aeronavegabilidad..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>  
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="habilitacion_nivel">Catégorias de Habilitación </label>
                  <select class="form-control selectpicker" id="selectpicker_Habilitacion" title="Seleccione" data-live-search="true" v-model="form.habilitacion_nivel" required>
                    <option value="" selected disabled></option>
                    <option v-for="(item, index) in Habilitacion" :value="item" :key="index">{{item}}</option>
                  </select>
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
            v-if="can('balloons-update')"
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
            form:{          
              volumen : '',
              nombre : '',
              matricula : '',
              fabricante : '',              
              modelo_id : 3,
              modelo : '',
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
            form_arc_doc : null,
            form_cert_matricula : null,
            form_seguro : null,
            form_certiricado_aeronavegabilidad_doc : null,
            form_foto : null,
            Habilitacion : ['A','B','C','D'],
            modelos : [],
            botom_ends : [],

          }




        },




        mounted(){
          this.Buscar();
          this.BuscarModelos();
          this.BuscarBottomEnd();
          this.ValidarPermisos('balloons-update');
        },
        methods: { 
 
          ValidarPermisos(permiso) {
            if(!this.can(permiso)){
              $(":input").prop("disabled", true);
            }
          },
          BuscarBottomEnd() {
            var url = '/admin/listado_globo_bottom_end';
            axios.get(url).then(response=>{
                this.botom_ends = response.data.records;   
            }).catch(error => {
                this.errors = error.response.data
            });
          },
          BuscarModelos() {
            var url = '/admin/listado_tabla_carga';
                axios.get(url).then(response=>{
                    this.modelos = response.data.records;   
                }).catch(error => {
                    this.errors = error.response.data
                });
          },
          reset() { 
            this.form_arc_doc = null;
            this.form_cert_matricula = null;
            this.form_seguro = null;
            this.form_foto = null;
            this.form_certiricado_aeronavegabilidad_doc = null; 
          },
          Buscar() {
            var url = '/admin/globos/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.form = response.data.record; 

            }).catch(error => {
                this.errors = error.response.data
            });
          },

          ActualizarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var form_arc_doc = this.form_arc_doc;
              var form_cert_matricula = this.form_cert_matricula;
              var form_seguro = this.form_seguro;
              var form_foto = this.form_foto;
              var form_certiricado_aeronavegabilidad_doc = this.form_certiricado_aeronavegabilidad_doc;

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
              formData.append('_method', 'put');
  
  
               var url = '/admin/globos/'+this.$route.params.id;

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al actualizar Globo', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Globo Actualizado Correctamente');                  
                  this.reset();
                  this.Buscar();
                  
                  window.location.href = '/dashboard#/globos';
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
          BottomEndCompatibles(){
            var botom_ends = this.botom_ends; 
            var modelo_id = this.form.id; 
            const results = _.filter(botom_ends, (item) => {
              return item.compatibilidad_globos_ids.includes(modelo_id);
            }); 
            return results;
           },   
      }, 
      watch: {
        BottomEndCompatibles: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_bottom_end').selectpicker('refresh'); });
        },
        modelos: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_modelos').selectpicker('refresh'); });
        },
        Habilitacion: function(newValues, oldValues){
          this.$nextTick(function(){ $('#selectpicker_Habilitacion').selectpicker('refresh'); });
        },
        'form.modelo_id': function (id) {        
            var modelos = this.modelos; 
            var model = _.find(modelos, ['id', id]);
            if(model){
              this.form.fabricante = model['fabricante'];     
              this.form.mtom = model['mtom'];    
              this.form.min_mtom = model['min_mtom'];    
            }
        },
        'form.bottom_end_id': function (id) {        
            var botom_ends = this.botom_ends; 
            var model = _.find(botom_ends, ['id', id]);
            if(model){
              this.form.peso_quemador = model['peso_quemador'];    
              this.form.peso_cesta = model['peso_cesta'];    
              this.form.peso_botellas = model['peso_botellas'];  
            }
        },
      },


      };
    </script>
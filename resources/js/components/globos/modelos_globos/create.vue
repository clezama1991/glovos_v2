<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-lightbulb text-dark"></i>
                Registrar Modelo de Globos
              </span>
          </h3>

        </div>
 
    <form @submit="RegistarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">
                    
          <div class="row">
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="modelo_globo">Nombre</label>
                <input v-model="form.modelo_globo" id="modelo_globo" type="text" class="form-control" required>
              </div> 
            </div>  
  
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="fabricante">Fabricante</label>
                <input v-model="form.fabricante" id="fabricante" type="text" class="form-control" required>
              </div> 
            </div>  

            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="mtom">MTOM</label>
                <input v-model="form.mtom" id="mtom" type="text" class="form-control" required>
              </div> 
            </div> 

            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="min_mtom">Min. MTOM</label>
                <input v-model="form.min_mtom" id="min_mtom" type="text" class="form-control" required>
              </div> 
            </div>  
            
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="tabla">Tabla de Carga del Globo</label>
                  <b-form-file 
                    id="tabla"
                    ref="tabla"
                    placeholder="Buscar Tabla de Carga del Globo..."
                    drop-placeholder="Suelta el archivo aquí..."
                  ></b-form-file>
              </div> 
            </div>
          </div>
          <div class="row">
      
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_10">10</label>
                <input v-model="form.fift_inits_10" id="fift_inits_10" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_11">11</label>
                <input v-model="form.fift_inits_11" id="fift_inits_11" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_12">12</label>
                <input v-model="form.fift_inits_12" id="fift_inits_12" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_13">13</label>
                <input v-model="form.fift_inits_13" id="fift_inits_13" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_14">14</label>
                <input v-model="form.fift_inits_14" id="fift_inits_14" type="text" v-numero class="form-control" required> 
              </div> 
            </div>

            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_15">15</label>
                <input v-model="form.fift_inits_15" id="fift_inits_15" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_16">16</label>
                <input v-model="form.fift_inits_16" id="fift_inits_16" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_17">17</label>
                <input v-model="form.fift_inits_17" id="fift_inits_17" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_18">18</label>
                <input v-model="form.fift_inits_18" id="fift_inits_18" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_19">19</label>
                <input v-model="form.fift_inits_19" id="fift_inits_19" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_20">20</label>
                <input v-model="form.fift_inits_20" id="fift_inits_20" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_21">21</label>
                <input v-model="form.fift_inits_21" id="fift_inits_21" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_22">22</label>
                <input v-model="form.fift_inits_22" id="fift_inits_22" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
            <div class="col-md-1 mb-3">
              <div class="form-group">
                <label for="fift_inits_23">23</label>
                <input v-model="form.fift_inits_23" id="fift_inits_23" type="text" v-numero class="form-control" required> 
              </div> 
            </div>
  
          </div> 
          
        </div>

        
        <div class="card-footer">
          <router-link to="/globos/modelos" class="btn btn-secondary mr-2">
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
            form:{         
              modelo_globo : '',
              fabricante : '',
              mtom : '',
              min_mtom : '',
              fift_inits_10 : '',
              fift_inits_11 : '',
              fift_inits_12 : '',
              fift_inits_13 : '',
              fift_inits_14 : '',
              fift_inits_15 : '',
              fift_inits_16 : '',
              fift_inits_17 : '',
              fift_inits_18 : '',
              fift_inits_19 : '',
              fift_inits_20 : '',
              fift_inits_21 : '',
              fift_inits_22 : '',
              fift_inits_23 : '',
            }, 

          }
        },
        mounted() {
          // this.Buscar();
        },
        methods: { 
 
          reset() {


            this.form  = {         
              modelo_globo : '',
              fabricante : '',
              mtom : '',
              min_mtom : '',
              fift_inits_10 : '',
              fift_inits_11 : '',
              fift_inits_12 : '',
              fift_inits_13 : '',
              fift_inits_14 : '',
              fift_inits_15 : '',
              fift_inits_16 : '',
              fift_inits_17 : '',
              fift_inits_18 : '',
              fift_inits_19 : '',
              fift_inits_20 : '',
              fift_inits_21 : '',
              fift_inits_22 : '',
              fift_inits_23 : '',
            };
 
          },
 
 
          RegistarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
              var porc = 0;
              
              var tabla = this.$refs.tabla.files[0];
        
              let formData = new FormData();
  
              formData.append('tabla', tabla);
            
              formData.append('modelo_globo', this.form.modelo_globo);
              formData.append('fabricante', this.form.fabricante);
              formData.append('mtom', this.form.mtom);
              formData.append('min_mtom', this.form.min_mtom);
              formData.append('fift_inits_10', this.form.fift_inits_10);
              formData.append('fift_inits_11', this.form.fift_inits_11);
              formData.append('fift_inits_12', this.form.fift_inits_12);
              formData.append('fift_inits_13', this.form.fift_inits_13);
              formData.append('fift_inits_14', this.form.fift_inits_14);
              formData.append('fift_inits_15', this.form.fift_inits_15);
              formData.append('fift_inits_16', this.form.fift_inits_16);
              formData.append('fift_inits_17', this.form.fift_inits_17);
              formData.append('fift_inits_18', this.form.fift_inits_18);
              formData.append('fift_inits_19', this.form.fift_inits_19);
              formData.append('fift_inits_20', this.form.fift_inits_20);
              formData.append('fift_inits_21', this.form.fift_inits_21);
              formData.append('fift_inits_22', this.form.fift_inits_22);
              formData.append('fift_inits_23', this.form.fift_inits_23);

               var url = '/admin/tabla_carga';

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
         
    }


      };
    </script>
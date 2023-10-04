<template>


  <div class="d-flex flex-column-fluid">

    <div class="container px-0">
      
      <div class="card card-custom mb-5">


        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
              <h3 class="card-title align-items-start flex-column">
              <span class="card-label font-weight-bolder text-dark">

                <i class="fas fa-mail-bulk  text-dark"></i>

                Consultar feedback
              </span>
          </h3>

        </div>
 
    <form @submit="ActualizarForm" method="POST" enctype="multipart/form-data" class="form" id="GuardarServiciosSolucionLimpieza">
       
        <div class="card-body">           
   
          <div class="row"> 
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="titulo">Titulo</label>
                <input v-model="form.titulo" id="titulo" type="text" class="form-control" required>
              </div> 
            </div>    
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="titulo">Estatus</label>
                  <select class="form-control form-control-sm" v-model="form.status">
                    <option value="pendiente">Pendiente</option>
                    <option value="completado">Completado</option>
                    <option value="declinada">Declinado</option>
                    <option value="cancelado">Cancelado</option>
                  </select>
              </div> 
            </div>    
            <div class="col-md-12 mb-3">
              <div class="form-group">
                <label for="descripcion">Descripción</label>                
                <editor
                    :api-key="api_key"
                    cloud-channel="5-dev"
                    :init="option"
                    v-model="form.feedback"
                /> 
              </div> 
            </div>     
          </div> 
        
        </div>

        
        <div class="card-footer">
          <router-link to="/feedback" class="btn btn-secondary mr-2">
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
    
 import Editor from '@tinymce/tinymce-vue'
    export default {
      components: {
          'editor': Editor
      },
      props : ['id'],
        data() {
          return {
            api_key:'4uqg5bfl6an0lmdfdghkap4yfejy8ovqglkfaahssobrd8mv',
            option:{
                height: 250,
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
              titulo : '',
              feedback : '',
              status : '',
            },

          }
        },
        mounted() {
          this.Buscar();
        },
        methods: { 
 
          reset() {
 
          },
         Buscar() {
            var url = '/admin/feedback/'+this.$route.params.id;
            axios.get(url).then(response=>{
                this.form = response.data.record; 

            }).catch(error => {
                this.errors = error.response.data
            });
        },

          ActualizarForm(evt) {

            evt.preventDefault();
    
              this.GuardandoCambios = !this.GuardandoCambios;
          
              let formData = new FormData();
  
              formData.append('titulo', this.form.titulo); 
              formData.append('feedback', this.form.feedback); 
              formData.append('status', this.form.status); 
              formData.append('_method', 'put'); 

               var url = '/admin/feedback/'+this.$route.params.id;

              axios.post(url, formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }, 
              }).then(response=>{ 
                  this.GuardandoCambios = !this.GuardandoCambios;
                  if(!response.data.result){
                    this.$toastr.error('Ocurrio un error al actualizar Registro', 'Error en Proceso...');       
                  }else{                
                  this.$toasted.success('Registro Actualizado Correctamente');              
                
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
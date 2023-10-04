<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">




          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">
                
                
                <i class="fas fa-list text-dark"></i>
                Check List - Pilotos

              </span>

              <div>
               <button v-if="can('checklist-update')" class="btn btn-success btn-sm" v-b-toggle.collapse-0>
                  Editar Indicaciones
                </button>

              <button
                v-if="can('checklist-create')"
                data-toggle="modal"
                data-target="#modelId"
                class="btn btn-primary btn-sm"
                @click="form.tipo='piloto'"
              >
                Agregar CheckList
              </button>
              </div>
            </h3>
          </div> 
    
        <div class="card-body">
          
          <b-collapse id="collapse-0">   
            <div class="row mt-15 mb-15">
              <div class="col-md-12">
                <h4>Editar indicaciones</h4>
              </div>
              <div class="col-md-12">
                    <editor
                      :api-key="api_key"
                      cloud-channel="5-dev"
                      :init="option"
                      v-model="format_title_checklist_pilotos.valor"
                  /> 
              </div>
              <div class="col-md-12 mt-3 text-center">
                <button type="button" class="btn btn-warning" @click="updateConfig('format_title_checklist_pilotos')"> <i class="fas fa-save"></i> Actualizar</button>
              </div>
            </div>
          </b-collapse>
 
          <div class="row">
            <div class="col-12">
              <table class="table">
                <thead>
                  <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Activo</th>
                    <th>Ordenar</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in ListPilotos" :key="index">
                    <td scope="row">{{ item.titulo }}</td>
                    <td> <span v-html="item.descripcion"></span></td>
                    <td>{{ item.activo ? "Activo" : "Inactivo" }}</td>
                    <td>
                      <b-button-group size="sm" v-if="can('checklist-update')">
                        <b-button variant="success" @click="changeOrden(item,'up')" :disabled="index==0"> 
                          <i class="fa fa-arrow-up" aria-hidden="true"></i>
                        </b-button>
                        <b-button variant="info" @click="changeOrden(item, 'down')"  :disabled="index==(ListPilotos.length-1)">
                          <i class="fa fa-arrow-down" aria-hidden="true"></i>
                        </b-button>
                      </b-button-group>
                    </td>
                    <td>
                      <button v-if="can('checklist-delete')" type="button" class="btn btn-danger btn-sm btn-icon" @click="Borrar(item)">
                        <i class="fas fa-trash"></i>
                      </button>
                      <button v-if="can('checklist-update')" type="button" class="btn btn-primary btn-sm btn-icon" 
                        data-toggle="modal" data-target="#modelId" @click="form = item">
                        <i class="fas fa-edit    "></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
      <div class="card card-custom mt-20">




          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
            <h3 class="card-title w-100 d-flex justify-content-between">
              <span class="card-label font-weight-bolder text-dark">
                
                
                <i class="fas fa-list text-dark"></i>
                Check List - Pasajeros

              </span>
              <div>
               <button v-if="can('checklist-update')" class="btn btn-success btn-sm" v-b-toggle.collapse-1>
                  Editar Indicaciones
                </button>

              <button
                v-if="can('checklist-update')"
                data-toggle="modal"
                data-target="#modelId"
                class="btn btn-primary btn-sm"
                @click="form.tipo='pasajero'"
              >
                Agregar CheckList
              </button>
              </div>
            </h3>
          </div> 
          <div class="card-body">
            
          <b-collapse id="collapse-1">  
            <div class="row mt-15 mb-15">
              <div class="col-md-12">
                <h4>Editar indicaciones</h4>
              </div>
              <div class="col-md-12">
                    <editor
                      :api-key="api_key"
                      cloud-channel="5-dev"
                      :init="option"
                      v-model="format_title_checklist_pasajeros.valor"
                  /> 
              </div>
              <div class="col-md-12 mt-3 text-center">
                <button type="button" class="btn btn-warning" @click="updateConfig('format_title_checklist_pasajeros')"> <i class="fas fa-save"></i> Actualizar</button>
              </div>
            </div>
          </b-collapse>
          <div class="row">
            <div class="col-12">
              <table class="table">
                <thead>
                  <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Activo</th>
                    <th>Ordenar</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in ListPasajeros" :key="index">
                    <td scope="row">{{ item.titulo }}</td>
                    <td> <span v-html="item.descripcion"></span></td>
                    <td>{{ item.activo ? "Activo" : "Inactivo" }}</td>
                    <td>
                      <b-button-group size="sm"  v-if="can('checklist-update')">
                        <b-button variant="success" @click="changeOrden(item,'up')" :disabled="index==0"> 
                          <i class="fa fa-arrow-up" aria-hidden="true"></i>
                        </b-button>
                        <b-button variant="info" @click="changeOrden(item, 'down')"  :disabled="index==(ListPasajeros.length-1)">
                          <i class="fa fa-arrow-down" aria-hidden="true"></i>
                        </b-button>
                      </b-button-group>
                    </td>
                    <td>
                      <button v-if="can('checklist-delete')" type="button" class="btn btn-danger btn-sm btn-icon" @click="Borrar(item)">
                        <i class="fas fa-trash"></i>
                      </button>
                      <button v-if="can('checklist-update')" type="button" class="btn btn-primary btn-sm btn-icon" 
                        data-toggle="modal" data-target="#modelId" @click="form = item">
                        <i class="fas fa-edit    "></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="modelId"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{form.id ? 'Actualizar' : 'Crear'}} Check List</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            @submit="RegistarForm"
            method="POST"
            enctype="multipart/form-data"
            class="form"
            id="GuardarServiciosSolucionLimpieza"
          >
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input
                      v-model="form.titulo"
                      id="titulo"
                      type="text"
                      class="form-control"
                      required
                    />
                  </div>
                </div>

                <div class="col-md-12 mb-3">
                  <label class=""> Descipción </label>
                  <editor
                    :api-key="api_key"
                    cloud-channel="5-dev"
                    :init="option"
                    v-model="form.descripcion"
                  />
                </div>
                
                <div class="col-md-12 mb-3">
                  <div class="form-check form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" v-model="form.activo" id="" value="1"> Activo
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="reset()"
              >
                Cancelar
              </button>
              <button type="subtmi" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Editor from "@tinymce/tinymce-vue";
export default {
  components: {
    editor: Editor,
  },
  data() {
    return {
      api_key: "4uqg5bfl6an0lmdfdghkap4yfejy8ovqglkfaahssobrd8mv",
      option: {
        height: 250,
        menubar: false,
        plugins: [
          "advlist autolink lists link image charmap print preview anchor",
          "searchreplace visualblocks code fullscreen",
          "insertdatetime media table paste code help wordcount",
        ],
        toolbar:
          "undo redo | formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat | help",
      },

      ListPasajeros: [],
      ListPilotos: [],
       form:{         
          id: "",
          titulo: "",
          descripcion: "",
          activo: true,
          tipo: "",
        },
        format_title_checklist_pilotos : '',
        format_title_checklist_pasajeros : '',

    };
  },
  mounted() {
    this.Buscar();
    this.BuscarTCPi();
    this.BuscarTCPa();
  },
  methods: {


    reset() {
       this.form = {         
          id: "",
          titulo: "",
          descripcion: "",
          activo: true,
          tipo: "",
        };

        this.Buscar();
        
        $("#modelId .close").click();
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();   

    },

    BuscarTCPi() {
        var url = '/admin/configs/format_title_checklist_pilotos';
        axios.get(url).then(response=>{
            this.format_title_checklist_pilotos = response.data.records;   
        }).catch(error => {
            this.errors = error.response.data
        });
    }, 
    BuscarTCPa() {
        var url = '/admin/configs/format_title_checklist_pasajeros';
        axios.get(url).then(response=>{
            this.format_title_checklist_pasajeros = response.data.records;   
        }).catch(error => {
            this.errors = error.response.data
        });
    }, 
    
    Buscar() {
      var url = "/admin/checklists";
      axios
        .get(url)
        .then((response) => {
          this.ListPasajeros = response.data.ListPasajeros;
          this.ListPilotos = response.data.ListPilotos;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },

    updateConfig(config) {
      let formData = new FormData();

      if(config=='format_title_checklist_pasajeros'){
        formData.append("valor", this.format_title_checklist_pasajeros.valor);
        var url = "/admin/configs/"+this.format_title_checklist_pasajeros.id;
        formData.append('_method', 'put'); 
      }else{
        formData.append("valor", this.format_title_checklist_pilotos.valor);
        var url = "/admin/configs/"+this.format_title_checklist_pilotos.id;
        formData.append('_method', 'put'); 
      }

      axios
        .post(url, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          console.log(response.data);
          if (!response.data.result) {
            Swal.fire(
              "Ha ocurrido algún error!",
              "Se le notificará al equipo de soporte!" +
                response.data.mensaje_error +
                response.data.mensaje_error,
              "error"
            );
            this.$toasted.error("Ha ocurrido algún error!");
          } else {
            this.$toasted.success("Información Registrada Correctamente");
          }

          this.reset();

        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
    
    changeOrden(item,accion) {

      let formData = new FormData();
      
      formData.append("accion", accion);

      var url = "/admin/checklists/"+item.id;
      formData.append('_method', 'put'); 

      axios
        .post(url, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          console.log(response.data);
          if (!response.data.result) {
            Swal.fire(
              "Ha ocurrido algún error!",
              "Se le notificará al equipo de soporte!" +
                response.data.mensaje_error +
                response.data.mensaje_error,
              "error"
            );
            this.$toasted.error("Ha ocurrido algún error!");
          } else {
            this.$toasted.success("Información Registrada Correctamente");
          }

          this.reset();

        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
    
    RegistarForm(evt) {
      evt.preventDefault();

      let formData = new FormData();
      formData.append("titulo", this.form.titulo);
      formData.append("descripcion", this.form.descripcion);
      formData.append("activo", this.form.activo);
      formData.append("tipo", this.form.tipo);

      if(this.form.id){
        var url = "/admin/checklists/"+this.form.id;
        formData.append('_method', 'put'); 
      }else{

        var url = "/admin/checklists";
      }

      axios
        .post(url, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          console.log(response.data);
          if (!response.data.result) {
            Swal.fire(
              "Ha ocurrido algún error!",
              "Se le notificará al equipo de soporte!" +
                response.data.mensaje_error +
                response.data.mensaje_error,
              "error"
            );
            this.$toasted.error("Ha ocurrido algún error!");
          } else {
            this.$toasted.success("Información Registrada Correctamente");
          }
        
          this.reset();
          
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
    
    Borrar(data) {
      
        var _this = this;

          Swal.fire({
            title: "Confirmar!",
            text: "Confirme que desea Eliminar el Checklist: "+data.titulo,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Confirmar!",
            cancelButtonText: "No, Cancelar!",
            reverseButtons: true
          }).then(function(result) {
            if (result.value) {          
              
                var url = '/admin/checklists/'+data.id;

                axios.post(url,{
                    _method: 'delete',                
                    token         :   _this.token
                }).then(response=>{
                  
                  if(!response.data.result){
                    Swal.fire("Ha ocurrido algún error!", "Se le notificará al equipo de soporte!" +response.data.mensaje_error, "error");
                    _this.$toasted.error('Ha ocurrido algún error!');           
                  }else{                 
                    _this.$toasted.success('Registro Eliminado Correctamente');
                    
                  }

                  _this.Buscar();
                                
                  
                }).catch(error => {
                    console.log(error);
                    this.errors = error.response
                });
            }
          });

    },  
  },

  computed: {
  
  },
};
</script>
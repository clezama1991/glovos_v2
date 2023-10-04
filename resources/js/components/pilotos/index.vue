<template>
<div>
  
    <base-loading></base-loading>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
          <div class="card-header flex-wrap border-0 pb-0 bg-light-danger">
          <h3 class="card-title w-100 d-flex justify-content-between">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-user-tie text-dark"></i>

              Listado de Pilotos
            </span>

            <router-link
              to="/pilotos/crear"
              v-if="can('pilots-create')"
              class="btn btn-primary d-flex align-items-center"
            >
              <i class="flaticon-plus"></i> 
              <span class="d-none d-md-block"> Registrar Piloto</span>
            </router-link>
          </h3>
        </div> 

        <div class="card-body"> 
          <tabla-component
            :striped="true"
            :fields="fields"
            :listado="records"
            titulo="Pilotos"
            :can_ver="can('pilots-read')"
            :can_editar="can('pilots-update')"
            :can_eliminar="can('pilots-delete')"   
            @ButtonSetStatus="ButtonSetStatus"
            @ButtonDelete="ButtonDelete"
            @ButtonGo="ButtonGo"
            @ButtonGoForm="ButtonGoForm"
            :isBusy="isBusy"
          ></tabla-component>
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
  data() {
    return {
      isBusy: false,
      fields: [
        {
          key: "nombres",
          label: "Nombres y Apellido",
          sortable: true,
          sortDirection: "desc",
          formatter: (value, key, item) => {
            return value + '<br> <span class="">' + item.apellidos + "</span>";
          },
        },
        { key: "dni", label: "Nro de Licencia", sortable: true, sortDirection: "desc" },
        {
          key: "contactos",
          label: "Contactos",
          sortable: true,
          sortDirection: "desc",
          formatter: (value, key, item) => {
            return (
              '<i class="fa fa-envelope small mr-1"></i>' +
              item.email +
              '<br> <i class="fa fa-phone small mr-1"></i>' +
              item.telefono +
              ""
            );
          },
        },
        // { key: 'apellidos', label: 'Apellidos', sortable: true, sortDirection: 'desc' },
        // { key: 'telefono', label: 'Teléfono', sortable: true, sortDirection: 'desc' },
        // { key: 'email', label: 'Correo', sortable: true, sortDirection: 'desc' },
        {
          key: "peso",
          label: "Peso Kgs",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "edit_status",
          label: "Activo",
          sortable: false,
          sortDirection: "desc",
        },
        {
          key: "estatus_entrenamientos",
          label: "Entrenamientos",
          sortable: false,
          sortDirection: "desc",
        },
        { key: "actions_formularios", label: "Acciones" },
      ],
      records: [],
    };
  },
  mounted() {
    this.Buscar();
    // console.log();
  },
  methods: {
    async ButtonDelete(data) {
      var optiones = {
        url: "/admin/pilotos/" + data.data.id,
      };
      await this.DeleteRegister(optiones);
    },

    async ButtonSetStatus(data) {
      var optiones = {
        url: "/admin/status_pilotos",
        data: {
          id: data.id,
          activo: data.estatus,
        },
      };
      console.log(optiones);
      await this.UpdateSetStatusOnly(optiones);
    },

    async UpdateSetStatusOnly(options) {
      var _this = this;
      var data_form = options.data;
      Swal.fire({
        title: "Confirmar!",
        text: "Confirme que desea Actualizar el Estatus de este Registro?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, Confirmar!",
        cancelButtonText: "No, Cancelar!",
        reverseButtons: true,
      }).then(function (result) {
        if (result.value) {
          axios
            .post(options.url, data_form)
            .then((response) => {
              if (!response.data.result) {
                Swal.fire(
                  "Ha ocurrido algún error!",
                  "Se le notificará al equipo de soporte!" +
                    response.data.mensaje_error,
                  "error"
                );
                _this.$toasted.error("Ha ocurrido algún error!");
              } else {
                // Swal.fire("Proceos Exitoso!", response.data.mensaje , "success");
                _this.$toasted.success(response.data.mensaje);
                // _this.Buscar();
              }
            })
            .catch((error) => {
              console.log(error);
              this.errors = error.response;
            });
        } else {
          _this.Buscar();
        }
      });
    },

    ButtonGo(data) {
      this.$router.push({
        path: "/pilotos/consultar/" + data.data.id,
      });
    },

    ButtonGoForm(data) {
      this.$router.push({
        path: "/pilotos/formularios/" + data.data.id,
      });
    },

    ButtonSetStatasdus(data) {
      var url = "/admin/status_pilotos";

      axios
        .post(url, {
          id: data.id,
          activo: data.estatus,
        })
        .then((response) => {
          if (!response.data.result) {
            Swal.fire(
              "Ha ocurrido algún error!",
              "Se le notificará al equipo de soporte!" +
                response.data.mensaje_error,
              "error"
            );
            this.$toasted.error("Ha ocurrido algún error!");
          } else {
            this.$toasted.success("Estatus actualizado Correctamente");
          }

          this.Buscar();
        })
        .catch((error) => {
          console.log(error);
          this.errors = error.response;
        });
    },

    async Buscar() {
      this.isBusy = true;
      try {
        var url = "/admin/pilotos";
        const response = await axios.get(url);
        this.isBusy = false;
        this.records = response.data.records;
      } catch (error) {
        this.isBusy = false;
        return [];
      }
    },
  },

  computed: {},
};
</script>
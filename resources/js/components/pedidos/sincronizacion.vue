<template>
  <div class="d-flex flex-column-fluid">
    <div class="container px-0">
      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-sync text-dark"></i>
              Sincronizar Pedidos
            </span>
          </h3>
        </div>

        <div class="card-body">
          <div class="col-12 text-center pb-5">
            <button
              @click="UpdatePedidos()"
              class="btn btn-primary"
              :disabled="ActualizandoIntregacionCompletada"
            >
              <span v-if="ActualizandoIntregacionCompletada">
                <i class="fas fa-spinner fa-spin"></i> Espere un momento...
              </span>
              <span v-else> Iniciar Sincronización de Pedidos </span>
            </button>
          </div>

          <div
            class="alert alert-danger mb-5 p-5"
            role="alert"
            v-if="intregacion_completada"
          >
            <h4 class="alert-heading">Sincronización completada!</h4>
            <p></p>
            <div class="alert-text">
              El proceso a concluido satifactoriamente!
            </div>
            <p></p>
            <div class="border-bottom border-white opacity-20 mb-5"></div>
            <p class="mb-0">
              Pedidos Nuevos : {{ pedidos_nuevos }} <br />
              Pedidos Actualizados : {{ pedidos_actualizados }}
            </p>
          </div>
        </div>
      </div>

      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-search text-dark"></i>
              Buscar Pedido en Woocomerce
            </span>
          </h3>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="orden_pedido">Número de Pedido</label>
                <input
                  v-model="orden_pedido"
                  v-numero
                  id="orden_pedido"
                  type="text"
                  class="form-control"
                  required
                />
              </div>
            </div>

            <div class="col-2 text-center pb-5">
              <div class="form-group" style="display: inline-grid">
                <label for="nombres" class="text-white">.</label>

                <button
                  @click="BuscarUpdatePedidos()"
                  class="btn btn-primary"
                  :disabled="
                    orden_pedido == '' || ActualizandoIntregacionCompletadaId
                  "
                >
                  <span v-if="ActualizandoIntregacionCompletadaId">
                    <i class="fas fa-spinner fa-spin"></i> Espere un momento...
                  </span>
                  <span v-else> Buscar Pedido Y Sincronizar </span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-light-danger">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
              <i class="fas fa-search text-dark"></i>
              Actualizar Información de Woocomerce
            </span>
          </h3>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-6 col-sm-5 col-md-3 col-lg-3">
              <ul
                role="menubar"
                aria-disabled="false"
                aria-label="Pagination"
                class="pagination b-pagination text-center"
              >
                <li
                  role="presentation"
                  aria-hidden="true"
                  class="page-item disabled flex-fill"
                  disabled
                >
                  <span
                    role="menuitem"
                    aria-label="Go to previous page"
                    aria-disabled="true"
                    class="page-link"
                    >‹</span
                  >
                </li>
                <!----><!---->
                <li
                  role="presentation"
                  class="page-item active flex-fill d-flex"
                >
                  <button
                    role="menuitemradio"
                    type="button"
                    aria-label="Go to page 1"
                    aria-checked="true"
                    aria-posinset="1"
                    aria-setsize="13"
                    tabindex="0"
                    class="page-link flex-grow-1"
                  >
                  <span v-if="load_response_woocomerce">
                    <i class="fa fa-spinner" aria-hidden="true"></i> Actualizando
                  </span>
                  <span v-else>

                    {{pagina_woocomerce}}
                  </span>
                  </button>
                </li>
                <li role="presentation" class="page-item flex-fill d-flex">
                  <button
                    :disabled="load_response_woocomerce"
                    :class="{'disabled':load_response_woocomerce}"
                    @click="UpdateInfoPedido()"
                    role="menuitem"
                    type="button"
                    tabindex="-1"
                    aria-label="Go to next page"
                    class="page-link flex-grow-1"
                  >
                    ›
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      orden_pedido: "",

      intregacion_completada: false,
      ActualizandoIntregacionCompletada: false,
      ActualizandoIntregacionCompletadaId: false,
      pedidos_nuevos: "",
      pedidos_actualizados: "",

      pagina_woocomerce: 0,
      load_response_woocomerce: false,
    };
  },
  mounted() {},
  methods: {
    UpdatePedidos() {
      this.intregacion_completada = false;
      this.ActualizandoIntregacionCompletada =
        !this.ActualizandoIntregacionCompletada;
      var url = "/admin/actualizar_pedidos";

      axios
        .get(url)
        .then((response) => {
          this.intregacion_completada = true;
          this.pedidos_nuevos = response.data.pedidos_nuevos;
          this.pedidos_actualizados = response.data.pedidos_actualizados;
          this.ActualizandoIntregacionCompletada =
            !this.ActualizandoIntregacionCompletada;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
    BuscarUpdatePedidos() {
      var url = "/admin/actualizar_pedidos/" + this.orden_pedido;
      this.ActualizandoIntregacionCompletadaId =
        !this.ActualizandoIntregacionCompletadaId;

      axios
        .get(url)
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
            this.$toasted.success("Pedido sincronizado Correctamente");
            this.orden_pedido = "";
          }

          this.ActualizandoIntregacionCompletadaId =
            !this.ActualizandoIntregacionCompletadaId;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
    UpdateInfoPedido() {
      var page_next = this.pagina_woocomerce;
      page_next ++;
      var url = "/admin/update_info_pedidos/"+page_next;
      this.load_response_woocomerce = true;
      axios
        .get(url)
        .then((response) => {
          this.pagina_woocomerce = response.data.page;
          this.load_response_woocomerce = false;
        })
        .catch((error) => {
          this.errors = error.response.data;
        });
    },
  },

  computed: {},
};
</script>
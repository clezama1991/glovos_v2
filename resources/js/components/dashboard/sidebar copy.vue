<template>
  <div
    class="aside aside-left aside-fixed d-flex flex-column flex-row-auto"
    id="kt_aside" style="    z-index: 888;"
  >
  <!-- <div
    class="aside aside-left aside-fixed d-flex flex-column flex-row-auto"
    id="kt_aside" style="z-index: 9999 !important "
  > -->
    <div
      class="brand flex-column-auto"
      id="kt_brand"
      kt-hidden-height="65"
      style=""
    >
      <router-link :to="'/'" class="brand-logo">
        <img alt="Logo" src="assets/media/logos/logo-letter-1.png" class="w-75"/>
      </router-link>

      <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
        <span class="svg-icon svg-icon svg-icon-xl">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            width="24px"
            height="24px"
            viewBox="0 0 24 24"
            version="1.1"
          >
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <polygon points="0 0 24 0 24 24 0 24"></polygon>
              <path
                d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                fill="#000000"
                fill-rule="nonzero"
                transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "
              ></path>
              <path
                d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                fill="#000000"
                fill-rule="nonzero"
                opacity="0.3"
                transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "
              ></path>
            </g>
          </svg>
        </span>
      </button>
    </div>

    <div
      class="aside-menu-wrapper flex-column-fluid"
      id="kt_aside_menu_wrapper"
    >
      <!--begin::Menu Container-->
      <div
        id="kt_aside_menu"
        class="aside-menu my-4 scroll ps ps--active-y"
        data-menu-vertical="1"
        data-menu-scroll="1"
        data-menu-dropdown-timeout="500"
        style="height: 544px; overflow: hidden"
        v-if="menu.rol == 'Administrador'"
      >
        <!--begin::Menu Nav-->
        <ul class="menu-nav" style="z-index:99999999">
          <li
            class="menu-item"
            aria-haspopup="true"
            :class="{ 'menu-item-active': this.$route.name == 'dashboard' || this.$route.name == 'dashboard_1' }"
          >
            <router-link :to="'/'" class="menu-link">
              <span class="svg-icon menu-icon"
                ><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg--><svg
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  width="24px"
                  height="24px"
                  viewBox="0 0 24 24"
                  version="1.1"
                >
                  <g
                    stroke="none"
                    stroke-width="1"
                    fill="none"
                    fill-rule="evenodd"
                  >
                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                    <path
                      d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                      fill="#000000"
                      fill-rule="nonzero"
                    ></path>
                    <path
                      d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                      fill="#000000"
                      opacity="0.3"
                    ></path>
                  </g></svg
                ><!--end::Svg Icon--></span
              >

              <span class="menu-text">Dashboard</span>
            </router-link
            >
          </li>

          <li
            class="menu-section"
            v-if="roles == 'Administrador'"
          >
            <h4 class="menu-text">Administrar</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
          </li>


            <li
              aria-haspopup="true"
              data-menu-toggle="hover"
              class="menu-item menu-item-submenu"
              :class="{ 'menu-item-active': this.$route.name == 'vuelos' }"
              v-if="roles == 'Administrador'"
            >
              <router-link
                :to="'/vuelos'"
                aria-current="page"
                class="menu-link menu-toggle active"
              >
              <span class="menu-icon"><i class="fas fa-plane-departure"></i></span>
  
                <span class="menu-text"> Vuelos </span>
              </router-link
              > 
            </li>

            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
            
                <span class="menu-icon">
                    <i class="fas fa-list-check"></i>
                  </span>
										<span class="menu-text">Pedidos</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="240" style="display: none; overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item" aria-haspopup="true">
												<router-link
                            :to="'/pedidos'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
                          <span class="svg-icon menu-icon">
                              <i class="fa fa-list-ul" aria-hidden="true"></i>
                          
                          </span>
                                  
                            <span class="menu-text"> Listado </span>
                          </router-link
                          > 
											</li>
											<li class="menu-item" aria-haspopup="true">
												<router-link
                            :to="'/pedidos-lista-espera'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
                          <span class="svg-icon menu-icon">
                              <i class="fas fa-user-clock    "></i>                          
                          </span>
                                  
                            <span class="menu-text"> Lista de Espera </span>
                          </router-link
                          > 
											</li>
											<li class="menu-item" aria-haspopup="true">
												<router-link
                            :to="'/pedidos-history'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
                          <span class="svg-icon menu-icon">
                                <i class="fas fa-list-check"></i>
                          
                          </span>
                                  
                            <span class="menu-text"> Historial </span>
                          </router-link
                          > 
											</li>
											<li class="menu-item" aria-haspopup="true">
												<router-link
                            :to="'/pedidos/sincronizacion'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
                          <span class="svg-icon menu-icon">
                                <i class="fas fa-sync"></i>
                          
                          </span>
                                  
                            <span class="menu-text"> Sincronizar </span>
                          </router-link
                          > 
											</li>

          <li
            aria-haspopup="true"
            data-menu-toggle="hover"
            class="menu-item menu-item-submenu"
            :class="{ 'menu-item-active': this.$route.name == 'pasajeros' }"
            v-if="roles == 'Administrador'"
          >
            <router-link
              :to="'/pasajeros'"
              aria-current="page"
              class="menu-link menu-toggle active"
            >
             <span class="svg-icon menu-icon">
                  <i class="fas fa-users"></i>
             
             </span>
                    
              <span class="menu-text"> Pasajeros </span>
            </router-link
            > 
          </li>
										</ul>
									</div>
						</li>

  


            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										
                    <span class="menu-icon">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
										<span class="menu-text">SMS</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="240" style="display: none; overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item" aria-haspopup="true">
												 <router-link
                            :to="'/comunicacion_riesgos'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Evaluación de Riesgos</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
											 <router-link
                          :to="'/sop'"
                          aria-current="page"
                          class="menu-link menu-toggle active"
                        >
              		        <i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">SOP</span>
												</router-link>
											</li>
										</ul>
									</div>
						</li>

            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
            
                <span class="menu-icon">
                  <i class="fas fa-file-invoice"></i>
                  </span>
										<span class="menu-text">Informes</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="240" style="display: none; overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item" aria-haspopup="true">
												 <router-link
                            :to="'/informes/vuelos'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Vuelos</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
												 <router-link
                            :to="'/informes/vuelos_cancelados'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Vuelos Cancelados</span>
												</router-link>
											</li>
										</ul>
									</div>
						</li>

            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
            
                <span class="menu-icon">
                  <i class="fas fa-cogs"></i>
                  </span>
										<span class="menu-text">Mantenimiento</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="240" style="display: none; overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">

                      
          <li
            aria-haspopup="true"
            data-menu-toggle="hover"
            class="menu-item menu-item-submenu"
            :class="{ 'menu-item-active': this.$route.name == 'pilotos' || this.$route.name == 'pilotos_1' }"
            v-if="roles == 'Administrador'"
          >
            <router-link
              :to="'/pilotos'"
              aria-current="page"
              class="menu-link menu-toggle active"
            >
            
              <span class="menu-icon">
                <i class="fas fa-user-tie"></i>
              </span>

 
              <span class="menu-text"> Pilotos </span>
            </router-link
            >
            
          </li>



            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										
                    <span class="menu-icon">
                      <i class="fas fa-lightbulb"></i>
                    </span>
										<span class="menu-text">Globos</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="240" style="display: none; overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item" aria-haspopup="true">
												 <router-link
                            :to="'/globos'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Lista de Globos</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
											 <router-link
                          :to="'/globos/modelos'"
                          aria-current="page"
                          class="menu-link menu-toggle active"
                        >
              		        <i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Modelos de Globo</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
											 <router-link
                          :to="'/globos/quemadores'"
                          aria-current="page"
                          class="menu-link menu-toggle active"
                        >
              		        <i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Quemadores</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
											 <router-link
                          :to="'/globos/cestas'"
                          aria-current="page"
                          class="menu-link menu-toggle active"
                        >
              		        <i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Cestas</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
											 <router-link
                          :to="'/globos/botellas'"
                          aria-current="page"
                          class="menu-link menu-toggle active"
                        >
              		        <i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Botellas</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
											 <router-link
                          :to="'/globos/bottom_end'"
                          aria-current="page"
                          class="menu-link menu-toggle active"
                        >
              		        <i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Bottom End</span>
												</router-link>
											</li>
										</ul>
									</div>
						</li>
  

            <li
              aria-haspopup="true"
              data-menu-toggle="hover"
              class="menu-item menu-item-submenu"
              :class="{ 'menu-item-active': this.$route.name == 'zonas'}"
              v-if="roles == 'Administrador'"
            >
              <router-link
                :to="'/zonas'"
                aria-current="page"
                class="menu-link menu-toggle active"
              >
                <span class="menu-icon">
                  <i class="fas fa-route"></i>
                  </span>

          
                <span class="menu-text"> Zonas </span>
              </router-link
              > 
            </li>

											<li class="menu-item" aria-haspopup="true">
												 <router-link
                            :to="'/configuraciones/plataforma'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Plataforma</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
												 <router-link
                            :to="'/configuraciones/redaccion'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Correos / Mensajes</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
												 <router-link
                            :to="'/configuraciones/tipo_nubosidad'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Tipos de Nubosidad</span>
												</router-link>
											</li>
											<li class="menu-item" aria-haspopup="true">
												 <router-link
                            :to="'/configuraciones/crons'"
                            aria-current="page"
                            class="menu-link menu-toggle active"
                          >
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Registro Tareas Automaticas</span>
												</router-link>
											</li>
										</ul>
									</div>
						</li>




        </ul>

        <!--end::Menu Nav-->
        <div class="ps__rail-x" style="left: 0px; bottom: 0px">
          <div
            class="ps__thumb-x"
            tabindex="0"
            style="left: 0px; width: 0px"
          ></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 544px; right: 4px">
          <div
            class="ps__thumb-y"
            tabindex="0"
            style="top: 0px; height: 257px"
          ></div>
        </div>
      </div>
      <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
  </div>
</template>



<script>
export default {
  props: ["menu"],
  mounted() {
    this.$store.rol = this.menu.rol;
  },
  computed: {
    roles() {
      return localStorage.rol ? localStorage.rol : null;
    },
  },
};
</script>
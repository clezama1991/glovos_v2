<template>
  <div>
    <!--begin::Aside-->
    <div
      class="aside aside-left aside-fixed d-flex flex-column flex-row-auto"
      id="kt_aside"
    >
      <!--begin::Brand-->
      <div
        class="brand flex-column-auto"
        id="kt_brand"
        kt-hidden-height="65"
        style=""
      >
        <router-link :to="'/'" class="brand-logo">
          <img
            alt="Logo"
            :src="logo"
            class="w-75"
          />
        </router-link>

        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
          <span class="svg-icon svg-icon svg-icon-xl">
            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Angle-double-left.svg--><svg
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
            <!--end::Svg Icon-->
          </span>
        </button>
        <!--end::Toolbar-->
      </div>
      <!--end::Brand-->

      <!--begin::Aside Menu-->
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
          style="height: 534px; overflow: hidden"
        >
          <!--begin::Menu Nav-->
          <ul class="menu-nav">
            <li v-if="can('calendar')" class="menu-item menu-item-active" aria-haspopup="true">
              <router-link :to="'/'" class="menu-link">
              <span class="svg-icon menu-icon">
                  <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Layers.svg--><svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="24px"
                    height="24px"
                    viewBox="0 0 24 24"
                    version="1.1"
                  >
                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4" rx="1"/>
                        <path d="M5,10 L7,10 C7.55228475,10 8,10.4477153 8,11 L8,13 C8,13.5522847 7.55228475,14 7,14 L5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 L14,7 C14,7.55228475 13.5522847,8 13,8 L11,8 C10.4477153,8 10,7.55228475 10,7 L10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,13 C14,13.5522847 13.5522847,14 13,14 L11,14 C10.4477153,14 10,13.5522847 10,13 L10,11 C10,10.4477153 10.4477153,10 11,10 Z M17,4 L19,4 C19.5522847,4 20,4.44771525 20,5 L20,7 C20,7.55228475 19.5522847,8 19,8 L17,8 C16.4477153,8 16,7.55228475 16,7 L16,5 C16,4.44771525 16.4477153,4 17,4 Z M17,10 L19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 L17,14 C16.4477153,14 16,13.5522847 16,13 L16,11 C16,10.4477153 16.4477153,10 17,10 Z M5,16 L7,16 C7.55228475,16 8,16.4477153 8,17 L8,19 C8,19.5522847 7.55228475,20 7,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,17 C4,16.4477153 4.44771525,16 5,16 Z M11,16 L13,16 C13.5522847,16 14,16.4477153 14,17 L14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 L10,17 C10,16.4477153 10.4477153,16 11,16 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z" fill="#000000"/>
                    </g>
                  </svg>
                  <!--end::Svg Icon--> </span
                ><span class="menu-text">Calendario</span></router-link>
            </li>
          
            <li v-if="can('flights-read')" class="menu-item" aria-haspopup="true">
               <router-link
                :to="'/vuelos'"
                aria-current="page"
                class="menu-link active"
              ><span class="svg-icon menu-icon">
                  <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg--><svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="24px"
                    height="24px"
                    viewBox="0 0 24 24"
                    version="1.1"
                  >
                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"/>
                      <path d="M10.1573188,15.7101991 C10.7319317,15.871464 11.3373672,15.9576401 11.9626774,15.9576401 C12.5879876,15.9576401 13.1934231,15.871464 13.768036,15.7101991 L14.2784001,17.0884863 C14.2961491,17.1364191 14.3052407,17.1871941 14.3052407,17.2383863 C14.3052407,17.4741652 14.1165055,17.6653018 13.8836889,17.6653018 L12.805781,17.6381197 C12.8616756,18.8258731 13.2941654,19.508499 14.4169144,19.8875104 C14.8586529,20.0366301 15.0973861,20.5201716 14.95014,20.9675305 C14.8028938,21.4148895 14.3254274,21.6566602 13.8836889,21.5075406 C12.072317,20.8960676 11.1784281,19.5883144 11.1216188,17.6653018 L10.041666,17.6653018 C9.99111686,17.6653018 9.94097984,17.6560945 9.89364924,17.6381197 C9.67565622,17.5553322 9.56520732,17.309253 9.6469547,17.0884863 L10.1573188,15.7101991 Z" fill="#000000" fill-rule="nonzero"/>
                      <path d="M12,16 C8.13400675,16 5,12.8659932 5,9 C5,5.13400675 8.13400675,2 12,2 C15.8659932,2 19,5.13400675 19,9 C19,12.8659932 15.8659932,16 12,16 Z M8.81595773,8.80077353 C8.79067542,8.43921955 8.47708263,8.16661749 8.11552864,8.19189981 C7.75397465,8.21718213 7.4813726,8.53077492 7.50665492,8.89232891 C7.62279197,10.5531661 8.39667037,11.8635466 9.79502238,12.7671393 C10.099435,12.9638458 10.5056723,12.8765328 10.7023788,12.5721203 C10.8990854,12.2677077 10.8117724,11.8614704 10.5073598,11.6647638 C9.4559885,10.9853845 8.90327706,10.0494981 8.81595773,8.80077353 Z" fill="#000000" opacity="0.3"/>
                  </g>
                  </svg>
                  <!--end::Svg Icon--> </span
                ><span class="menu-text">Vuelos</span></router-link
              >
            </li>
            <li v-if="can('orders-read|orders_placed|synchronize_orders|passengers|waiting_list-read')"
              class="menu-item menu-item-submenu"
              aria-haspopup="true"
              data-menu-toggle="hover"
            >
              <a href="javascript:;" class="menu-link menu-toggle"
                ><span class="svg-icon menu-icon">
                  <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg--><svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="24px"
                    height="24px"
                    viewBox="0 0 24 24"
                    version="1.1"
                  >
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000"/>
                        <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3"/>
                    </g>
                  </svg>
                  <!--end::Svg Icon--> </span
                ><span class="menu-text">Pedidos</span
                ><i class="menu-arrow"></i
              ></a>
              <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                  <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link"
                      ><span class="menu-text">Pedidosx</span></span
                    >
                  </li>
                  
                  <li v-if="can('orders-read')"  class="menu-item" aria-haspopup="true">
                    <router-link :to="'/pedidos'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Listado</span>
                      </router-link>
                  </li>
                  <li v-if="can('waiting_list-read')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/pedidos-lista-espera'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Lista de Espera</span>
                      </router-link>
                  </li>
                  <li  v-if="can('orders_placed')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/pedidos-history'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Historial</span>
                      </router-link>
                  </li>
                  <li v-if="can('synchronize_orders')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/pedidos/sincronizacion'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Sincronizar WooCommerce </span>
                      </router-link>
                  </li>
                  <li  v-if="can('passengers')" class="menu-item" aria-haspopup="true">
                    <router-link  :to="'/pasajeros'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Pasajeros</span>
                      </router-link>
                  </li> 
                  <li  v-if="can('booking-read')" class="menu-item" aria-haspopup="true">
                    <router-link  :to="'/pedidos-reservas-externas'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Reservas Externas</span>
                      </router-link>
                  </li> 
                </ul>
              </div>
            </li>
            <li v-if="can('risk_assessments-read|sop-read')"
              class="menu-item menu-item-submenu"
              aria-haspopup="true"
              data-menu-toggle="hover"
            >
              <a href="javascript:;" class="menu-link menu-toggle"
                ><span class="svg-icon menu-icon">
                  <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg--><svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="24px"
                    height="24px"
                    viewBox="0 0 24 24"
                    version="1.1"
                  >        
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <polygon points="0 0 24 0 24 24 0 24"/>
                          <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                          <rect fill="#000000" x="6" y="11" width="9" height="2" rx="1"/>
                          <rect fill="#000000" x="6" y="15" width="5" height="2" rx="1"/>
                      </g>
                  </svg>
                  <!--end::Svg Icon--> </span
                ><span class="menu-text">SMS</span
                ><i class="menu-arrow"></i
              ></a>
              <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                  <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link"
                      ><span class="menu-text">SMS</span></span
                    >
                  </li>
                  
                  <li v-if="can('risk_assessments-read')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/comunicacion_riesgos'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Evaluación de Riesgos</span>
                      </router-link>
                  </li>
                  <li v-if="can('sop-read')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/sop'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">SOP</span>
                      </router-link>
                  </li>
                </ul>
              </div>
            </li>
            <li v-if="can('report_completed_flights|report_canceled_flights')"
              class="menu-item menu-item-submenu"
              aria-haspopup="true"
              data-menu-toggle="hover"
            >
              <a href="javascript:;" class="menu-link menu-toggle"
                ><span class="svg-icon menu-icon">
                  <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg--><svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="24px"
                    height="24px"
                    viewBox="0 0 24 24"
                    version="1.1"
                  >
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero"/>
                    </g>
                  </svg>
                  <!--end::Svg Icon--> </span
                ><span class="menu-text">Informes</span
                ><i class="menu-arrow"></i
              ></a>
              <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                  <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link"
                      ><span class="menu-text">Informes</span></span
                    >
                  </li>
                  
                  <li v-if="can('report_completed_flights')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/informes/vuelos'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Vuelos Realizados</span>
                      </router-link>
                  </li>
                  <li v-if="can('report_canceled_flights')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/informes/vuelos_cancelados'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Vuelos Cancelados</span>
                      </router-link>
                  </li>
                </ul>
              </div>
            </li>
            <li  v-if="can('pilots-read|soguillas-read|balloons-read|balloons_model-read|balloons_burners-read|balloons_baskets-read|bottom_end-read|zones-read|checklist-read|configs_plataforma|types_of_clouds-read|automated_tasks')"
              class="menu-item menu-item-submenu"
              aria-haspopup="true"
              data-menu-toggle="hover"
            >
              <a href="javascript:;" class="menu-link menu-toggle"
                ><span class="svg-icon menu-icon">
                  <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg--><svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="24px"
                    height="24px"
                    viewBox="0 0 24 24"
                    version="1.1"
                  >
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M15.9497475,3.80761184 L13.0246125,6.73274681 C12.2435639,7.51379539 12.2435639,8.78012535 13.0246125,9.56117394 L14.4388261,10.9753875 C15.2198746,11.7564361 16.4862046,11.7564361 17.2672532,10.9753875 L20.1923882,8.05025253 C20.7341101,10.0447871 20.2295941,12.2556873 18.674559,13.8107223 C16.8453326,15.6399488 14.1085592,16.0155296 11.8839934,14.9444337 L6.75735931,20.0710678 C5.97631073,20.8521164 4.70998077,20.8521164 3.92893219,20.0710678 C3.1478836,19.2900192 3.1478836,18.0236893 3.92893219,17.2426407 L9.05556629,12.1160066 C7.98447038,9.89144078 8.36005124,7.15466739 10.1892777,5.32544095 C11.7443127,3.77040588 13.9552129,3.26588995 15.9497475,3.80761184 Z" fill="#000000"/>
                        <path d="M16.6568542,5.92893219 L18.0710678,7.34314575 C18.4615921,7.73367004 18.4615921,8.36683502 18.0710678,8.75735931 L16.6913928,10.1370344 C16.3008685,10.5275587 15.6677035,10.5275587 15.2771792,10.1370344 L13.8629656,8.7228208 C13.4724413,8.33229651 13.4724413,7.69913153 13.8629656,7.30860724 L15.2426407,5.92893219 C15.633165,5.5384079 16.26633,5.5384079 16.6568542,5.92893219 Z" fill="#000000" opacity="0.3"/>
                    </g>
                  </svg>
                  <!--end::Svg Icon--> </span
                ><span class="menu-text">Mantenimiento</span
                ><i class="menu-arrow"></i
              ></a>
              <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                  <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link"
                      ><span class="menu-text">Mantenimiento</span></span
                    >
                  </li> 
                  <li  v-if="can('pilots-read')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/pilotos'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Pilotos</span>
                      </router-link>
                  </li>
                  <li v-if="can('soguillas-read')"  class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                      <i class="menu-bullet menu-bullet-dot"><span></span></i>
                      <span class="menu-text">Soguillas</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="204" style="display: none; overflow: hidden;">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                        <li class="menu-item " aria-haspopup="true">
                          <router-link :to="'/configuraciones/soguillas_calendario'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Calendario Soguillas</span></router-link>
                        </li>
                        <li class="menu-item " aria-haspopup="true">
                          <router-link :to="'/configuraciones/soguillas'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Lista de Soguillas</span></router-link>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li  v-if="can('balloons-read|balloons_model-read|balloons_burners-read|balloons_baskets-read|bottom_end-read')"  class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                      <i class="menu-bullet menu-bullet-dot"><span></span></i>
                      <span class="menu-text">Globos</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="204" style="display: none; overflow: hidden;">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                        <li  v-if="can('balloons-read')" class="menu-item " aria-haspopup="true">
                          <router-link :to="'/globos'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Lista de Globos</span></router-link>
                        </li>
                        <li v-if="can('balloons_model-read')" class="menu-item " aria-haspopup="true">
                          <router-link :to="'/globos/modelos'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Modelos</span></router-link>
                        </li>
                        <li v-if="can('balloons_burners-read')" class="menu-item " aria-haspopup="true">
                          <router-link :to="'/globos/quemadores'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Quemadores</span></router-link>
                        </li>
                        <li v-if="can('balloons_baskets-read')" class="menu-item " aria-haspopup="true">
                          <router-link :to="'/globos/cestas'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Cestas</span></router-link>
                        </li>
                        <li v-if="can('balloons_bottles-read')" class="menu-item " aria-haspopup="true">
                          <router-link :to="'/globos/botellas'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Botellas</span></router-link>
                        </li>
                        <li v-if="can('bottom_end-read')" class="menu-item " aria-haspopup="true">
                          <router-link :to="'/globos/bottom_end'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Bottom End</span></router-link>
                        </li>
                      </ul>
                    </div>
                  </li>

                  <li v-if="can('users-read|roles-read')" class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                      <i class="menu-bullet menu-bullet-dot"><span></span></i>
                      <span class="menu-text">Accesos</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu " kt-hidden-height="204" style="display: none; overflow: hidden;">
                      <i class="menu-arrow"></i>
                      <ul class="menu-subnav">
                        <li v-if="can('users-read')" class="menu-item " aria-haspopup="true">
                          <router-link :to="'/admin-usuarios'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Usuarios</span></router-link>
                        </li>
                        <li v-if="can('roles-read')" class="menu-item " aria-haspopup="true">
                          <router-link :to="'/admin-roles'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Roles</span></router-link>
                        </li>
                        <li v-if="can('roles-read')" class="menu-item " aria-haspopup="true">
                          <router-link :to="'/admin-permisos'" class="menu-link ">
                          <i class="menu-bullet menu-bullet-dot"><span></span></i>
                          <span class="menu-text">Permisos</span></router-link>
                        </li>
                      </ul>
                    </div>
                  </li>

                  <li v-if="can('zones-read')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/zonas'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Zonas</span>
                      </router-link>
                  </li>
                  <li v-if="can('checklist-read')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/configuraciones/checklist'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Check List</span>
                      </router-link>
                  </li>
                  <li v-if="can('configs_plataforma')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/configuraciones/plataforma'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Plataforma</span>
                      </router-link>
                  </li>
                  <li v-if="can('configs_redacciones')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/configuraciones/redaccion'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Correos / Mensajes</span>
                      </router-link>
                  </li>
                  <li v-if="can('types_of_clouds-read')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/configuraciones/tipo_nubosidad'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Tipos de Nubosidad</span>
                      </router-link>
                  </li>
                  <li v-if="can('automated_tasks')" class="menu-item" aria-haspopup="true">
                    <router-link :to="'/configuraciones/crons'" class="menu-link">
                      <i class="menu-bullet menu-bullet-line"><span></span></i>
                      <span class="menu-text">Tareas Automáticas</span>
                      </router-link>
                  </li> 
                </ul>
              </div>
            </li>
            <li class="menu-item" aria-haspopup="true">
               <router-link
                :to="'/feedback'"
                aria-current="page"
                class="menu-link active"
              ><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Mailbox.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8,6 L20.5,6 C21.3284271,6 22,6.67157288 22,7.5 C22,8.32842712 21.3284271,9 20.5,9 L8,9 L8,19.5 C8,20.3284271 7.32842712,21 6.5,21 C5.67157288,21 5,20.3284271 5,19.5 L5,9 L3.5,9 C2.67157288,9 2,8.32842712 2,7.5 C2,6.67157288 2.67157288,6 3.5,6 L5,6 L5,4.5 C5,3.67157288 5.67157288,3 6.5,3 C7.32842712,3 8,3.67157288 8,4.5 L8,6 Z" fill="#000000"/>
        <path d="M10,11 L20.5,11 C21.3284271,11 22,11.6715729 22,12.5 L22,15 C22,17.209139 20.209139,19 18,19 L11.5,19 C10.6715729,19 10,18.3284271 10,17.5 L10,11 Z M20,12 C19.4477153,12 19,12.4477153 19,13 L19,16 C19,16.5522847 19.4477153,17 20,17 C20.5522847,17 21,16.5522847 21,16 L21,13 C21,12.4477153 20.5522847,12 20,12 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span><span class="menu-text">Feedback</span></router-link
              >
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
          <div class="ps__rail-y" style="top: 0px; height: 534px; right: 4px">
            <div
              class="ps__thumb-y"
              tabindex="0"
              style="top: 0px; height: 247px"
            ></div>
          </div>
        </div>
        <!--end::Menu Container-->
      </div>
      <!--end::Aside Menu-->
    </div>
    <!--end::Aside-->
  </div>
</template>


<script>
export default {
  props: ["logo"],
  mounted() { 
  },
  computed: { 
  },
};
</script>

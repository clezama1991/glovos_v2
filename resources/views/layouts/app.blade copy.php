<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Plataforma | {{encontrar_configuracion('nombre_plataforma')}} -  {{encontrar_configuracion('descripcion_plataforma')}} </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/> -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/plataforma/favico.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/plataforma/favico.ico') }}" type="image/x-icon">

    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>


    {{-- <link href="{{ asset('css/personalido.css')}}" rel="stylesheet" type="text/css"/> --}}
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css"/>
<!-- 
    <link href="{{ asset('assets/css/themes/layout/header/base/dark.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/themes/layout/header/menu/dark.css')}}" rel="stylesheet" type="text/css"/>
 -->
    <link href="{{ asset('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css"/>        

    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <!-- <link href="{{ asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/> -->

    <!-- <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/> -->

    <style type="text/css">
      :root {
      --input-padding-x: 1.5rem;
      --input-padding-y: .75rem;
      }
      .modal-backdrop{
          background-color: #48abc782 !important;
      }

      .hideCalendarTime > div > span.fc-time{
    display:none;
}
.contenedor-select2 {
position: relative;
}
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
      /* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
.component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}
.component-fade-enter, .component-fade-leave-to
/* .component-fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
.cursos-pointer{
      cursor: pointer !important;
}
.ww-75{
  width: 75px !important;
}
.ww-100{
  width: 100px !important;
}
     /* [v-cloak] > * {
        display:none;
      }
      [v-cloak]:before {

          background: url(dist/img/new-loader.gif) no-repeat #fffef2;
          background-position: center center;
          background-size: 13%;
          position: fixed;
          left: 0;
          top: 0;
        width: 100%;
        height: 100vh;
          z-index: 12345;
        content: '';
      }*/

      .custom-file-input:lang(en) ~ .custom-file-label::after {
        content: 'Buscar';
      }
      /* body {
        background: #ecf5fa !important;
      }
      #kt_aside{
        background: #187de4 !important;
      }

      #kt_brand{
        background: #187de4 !important;
      }

      #kt_header_mobile{
        background: #187de4 !important;
      }

      #kt_aside_menu_wrapper{
        background: #187de4 !important;
      }

      #kt_aside_menu{
        background: #187de4 !important;
      }

      #kt_aside_menu > ul > li.menu-item > a > span.menu-text{
        color: #fff !important;
      } 
      #kt_aside_menu > ul > li.menu-item.menu-item-active > a > span.menu-text {
        color: #000 !important;
      }

      #kt_aside_menu > ul > li.menu-section > h4{
        color: #fff !important;
      } 

      #kt_aside_menu > ul > li.menu-item:hover > a > span.menu-text{
        color: #fff !important;
      } 
      #kt_aside_menu > ul > li.menu-item.menu-item-active:hover > a > span.menu-text {
        color: #fff !important;
      }
        
      .menu-heading, .aside-menu .menu-nav > .menu-item:hover > .menu-link {
        background: #121f2cb5 !important;
      }

      .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-active:hover > .menu-link {
        background: #121f2cb5 !important;
      } */

      .table-verde, .table-verde > th, .table-verde > td {
          background-color: #0bb7ae52;
      }
      .table-azul, .table-azul > th, .table-azul > td {
          background-color: #3699FF52;
          color: #fff;
          font-weight: 500;
      }
      .table-naranja, .table-naranja > th, .table-naranja > td {
          background-color: #ee9b0152;
      }

      .toolTipBox{
        border-left: thick solid #000;
        height:100%;
        left: 50%;
        position: absolute;
      }


      .fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0; 
}
table#table-transition-example .flip-list-move {
  transition: transform 1s;
}

.requerido:after {
  content: '*';
  color: red;
  padding-left: 5px;
  font-weight: bolder;
}

.custom-file-input:lang(en) ~ .custom-file-label::after {
  content: 'Buscar';
}.custom-file-input:lang(es) ~ .custom-file-label::after {
  content: 'Buscar';
}
.tox-notifications-container{
  display: none !important;
}
.tox-statusbar{
  display: none !important;
}


.btn-xs{
  font-size: 15px !important;
    padding: 0.6rem !important;
}

    </style>

<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <style>
      body {
          font-family: 'Poppins' !important;
      }
      </style>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>

    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.2.9')}}" rel="stylesheet" type="text/css"/>
   
</head>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>

    <body style="font-size: 16px !important;" id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable aside-minimize p-10">

      	<div id="app" class="d-flex flex-column flex-root">

	         <div class="d-flex flex-row flex-column-fluid page">

	      	    <sidebardashboard :menu="{{ Auth::user() }}"></sidebardashboard>


    	      	<div class="d-flex flex-column flex-row-fluid wrapper pt-15" id="kt_wrapper">
    	      		
    	      		<div id="kt_header" class="header  header-fixed ">
    	      			
                  
<div class=" container-fluid  d-flex align-items-stretch justify-content-between">
  <!--begin::Header Menu Wrapper-->
<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

   
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
		
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center mr-3">
				<!--begin::Aside Mobile Toggle-->
				<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
					<span></span>
				</button>
				<!--end::Aside Mobile Toggle-->
				<!--begin::Header Menu Mobile Toggle-->
		 
				<!--end::Header Menu Mobile Toggle-->
				<!--begin::Topbar Mobile Toggle-->
		
				<!--end::Topbar Mobile Toggle-->
			</div>
			<!--end::Toolbar-->
      <!--begin::Logo-->
			<a href="#" class="w-75">
				<img alt="Logo" src="assets/media/logos/logo-letter-1.png" class="w-75"/>
			</a>
      <button class="btn btn-hover-text-primary p-0 mr-auto" id="kt_header_mobile_topbar_toggle">
        <span class="svg-icon svg-icon-xl">
          <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/User.svg-->
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <polygon points="0 0 24 0 24 24 0 24" />
              <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
              <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
            </g>
          </svg>
          <!--end::Svg Icon-->
        </span>
      </button>
			<!--end::Logo-->
		</div>
		<!--end::Header Mobile-->


















</div>
<!--end::Header Menu Wrapper-->

<!--begin::Topbar-->
<div class="topbar">
  <div class="topbar-item">
    <div class="btn btn-icon btn-clean btn-lg mr-1" id="kt_quick_panel_toggle">
      <span class="svg-icon svg-icon-xl svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Notifications1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
            <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
        </g>
    </svg><!--end::Svg Icon--></span>
    <span class="label label-sm label-warning label-rounded">{{count($multimedias_caducados) +count($riesgos) + count($globos) + count($pilotos_fechas_caducadas) }}</span>
    </div>
  </div> 
        <div class="topbar-item">
            <a href="{{url('/dashboard#/cuenta')}}" class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">

               <span class="symbol symbol-lg-35 symbol-25 symbol-light-success mr-1">
                    <span class="symbol-label font-size-h5 font-weight-bold">
                       @if(Auth::user()->name)
                        {{ Auth::user()->Nick() }}
                       @endif
                    </span>
                </span>
                <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
                  @if(Auth::user()->name)
                    {{Auth::user()->name }}
                  @endif
              </span>
            </a>
        </div>

      <!--begin::Chat-->
<div class="topbar-item">
   <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();window.localStorage.clear();" class="btn btn-icon btn-clean btn-lg mr-1" data-toggle="modal" data-target="#kt_chat_modal">
    <i class="flaticon-lock"> </i>  
  			   </a>
</div>

                </div>


</div>

    		      		{{-- <headerdashb oard :usuario="{{ Auth::user()->datos_personales }}"></headerdashboard> --}}

    	      		</div>

    	      		<div id="kt_content" class="content  d-flex flex-column flex-column-fluid" >


                  @includeIf('component.head_modulo')
    	      		 @yield('content')

    	      		</div>

                @include('layouts.footer')

    	      </div>

    	     </div>
           
        </div>
        
        @include('layouts.notifications')
      
        <div id="kt_scrolltop" class="scrolltop">
          <span class="svg-icon">
            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"></rect>
                <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero"></path>
              </g>
            </svg>
            <!--end::Svg Icon-->
          </span>
        </div>
        
    </body>

</html>




  <script>
            var KTAppSettings = {
    "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
    },
    "colors": {
        "theme": {
            "base": {
                "white": "#ffffff",
                "primary": "#3699FF",
                "secondary": "#E5EAEE",
                "success": "#1BC5BD",
                "info": "#8950FC",
                "warning": "#FFA800",
                "danger": "#F64E60",
                "light": "#E4E6EF",
                "dark": "#181C32"
            },
            "light": {
                "white": "#ffffff",
                "primary": "#E1F0FF",
                "secondary": "#EBEDF3",
                "success": "#C9F7F5",
                "info": "#EEE5FF",
                "warning": "#FFF4DE",
                "danger": "#FFE2E5",
                "light": "#F3F6F9",
                "dark": "#D6D6E0"
            },
            "inverse": {
                "white": "#ffffff",
                "primary": "#ffffff",
                "secondary": "#3F4254",
                "success": "#ffffff",
                "info": "#ffffff",
                "warning": "#ffffff",
                "danger": "#ffffff",
                "light": "#464E5F",
                "dark": "#ffffff"
            }
        },
        "gray": {
            "gray-100": "#F3F6F9",
            "gray-200": "#EBEDF3",
            "gray-300": "#E4E6EF",
            "gray-400": "#D1D3E0",
            "gray-500": "#B5B5C3",
            "gray-600": "#7E8299",
            "gray-700": "#5E6278",
            "gray-800": "#3F4254",
            "gray-900": "#181C32"
        }
    },
    "font-family": "Poppins"
};
        </script>



<script src="https://kit.fontawesome.com/b9a310c037.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/app.js?v=5') }}" defer></script>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css"> -->

  <!-- <script src="{{ asset('assets/js/pages/crud/ktdatatable/api/methods.js?v=7.0.6') }}"></script>  -->

<script src="{{ asset('assets/plugins/global/plugins.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.6') }}"></script>

<!-- 
<script src="{{ asset('assets/js/pages/widgets.js?v=7.0.6') }}"></script>
  -->                
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
 -->
<!-- 
<script type="text/javascript">
    $( document ).ready(function(){
       $('.summernote').summernote({
      height: 150
    });

     

    });
</script>
 -->

 <style>
  @media only screen and (max-width: 768px) {
  /* For mobile phones: */
  .menu-nav{
    margin-top: 36px !important;
  }
}
.aside-menu .menu-nav > .menu-section{
  margin: 0px;
}
 </style>



<script>

$(document).ready(function () {
  $('.modal').on('hidden.bs.modal', function( event ) {
            $(this).removeClass( 'fv-modal-stack' );
            $('body').data( 'fv_open_modals', $('body').data( 'fv_open_modals' ) - 1 );
        });

        $( '.modal' ).on( 'shown.bs.modal', function ( event ) {
            // keep track of the number of open modals
            if ( typeof( $('body').data( 'fv_open_modals' ) ) == 'undefined' )
            {
                $('body').data( 'fv_open_modals', 0 );
            }

            // if the z-index of this modal has been set, ignore.
            if ( $(this).hasClass( 'fv-modal-stack' ) )
            {
                return;
            }

            $(this).addClass( 'fv-modal-stack' );
            $('body').data( 'fv_open_modals', $('body').data( 'fv_open_modals' ) + 1 );
            $(this).css('z-index', 1040 + (10 * $('body').data( 'fv_open_modals' )));
            $( '.modal-backdrop' ).not( '.fv-modal-stack' ).css( 'z-index', 1039 + (10 * $('body').data( 'fv_open_modals' )));
            $( '.modal-backdrop' ).not( 'fv-modal-stack' ).addClass( 'fv-modal-stack' ); 
         });
});

</script>

@yield('script')

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
    {{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/> --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css"/>        

    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <!-- <link href="{{ asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/> -->

    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

    <style type="text/css">

        .custom-file-input:lang(en)~.custom-file-label::after {
            content: 'Buscar';
        }


        .btn-xs {
            font-size: 15px !important;
            padding: 0.6rem !important;
        }
        .tox-statusbar{
            display: none !important;
        }

        .bootstrap-select .dropdown-menu li.disabled a{
            background: rgb(255 133 133 / 67%);
        }
        .bootstrap-select .dropdown-menu.inner > li.disabled:hover > a{
            background: rgb(255 133 133 / 67%);
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

    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.2.9') }}" rel="stylesheet"
        type="text/css" />

</head>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize aside-minimize-hoverable"
    data-scrolltop="on">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center  header-mobile-fixed ">
        <!--begin::Logo-->
        
        <router-link :to="'/'">
          <img alt="Logo" src="{{asset(encontrar_configuracion('logo_2_plataforma'))}}" class="w-50">
        </router-link>
        <!--end::Logo-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->

            <!--begin::Header Menu Mobile Toggle-->
            {{-- <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button> --}}
            <!--end::Header Menu Mobile Toggle-->

            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/User.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero"></path>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span> </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root"  id="app">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
  
          <sidebardashboard :menu="{{ Auth::user() }}" logo="{{encontrar_configuracion('logo_2_plataforma')}}"></sidebardashboard>

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header  header-fixed bg-white ">
                    <!--begin::Container-->
                    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                         
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
                    <!--end::Container-->
                </div>
                <!--end::Header-->

                <!--begin::Content-->
                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                  
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class=" container " >
                            
                          @includeIf('component.head_modulo')
                          @yield('content')
 
                            <!--end::Dashboard-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->

                <!--begin::Footer-->
              

                @include('layouts.footer')
                
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->


    @include('layouts.notifications')
      

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Up-2.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2"
                        height="10" rx="1"></rect>
                    <path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill="#000000" fill-rule="nonzero"></path>
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->

    <script>
        var HOST_URL = "/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
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
    <!--end::Global Config-->
 

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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://kit.fontawesome.com/b9a310c037.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js?v=5') }}" defer></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css"> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/perfect-scrollbar/1.5.5/perfect-scrollbar.min.js" integrity="sha512-X41/A5OSxoi5uqtS6Krhqz8QyyD8E/ZbN7B4IaBSgqPLRbWVuXJXr9UwOujstj71SoVxh5vxgy7kmtd17xrJRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="{{ asset('assets/js/pages/crud/ktdatatable/api/methods.js?v=7.0.6') }}"></script>  -->
{{-- <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!--
<script src="{{ asset('assets/js/pages/widgets.js?v=7.0.6') }}"></script>
  -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

 -->
<!--
<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150
        });



    });
</script>
 -->

 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
 <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" defer></script>
 <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js" defer></script>
 <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" defer></script>
 <style>
  @media only screen and (max-width: 768px) {
  /* For mobile phones: */
  /* .menu-nav{
    margin-top: 36px !important;
  } */
}
.aside-menu .menu-nav > .menu-section{
  /* margin: 0px; */
}
 </style>


<script type="text/javascript">   
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():null !!},
        woocommers: {!! encontrar_configuracion('enable_woocommerces') !!},
        url_plataforma: "{{ encontrar_configuracion('url_plataforma') }}"
    }
</script>

<script>
    $(document).ready(function() {
        $('.modal').on('hidden.bs.modal', function(event) {
            $(this).removeClass('fv-modal-stack');
            $('body').data('fv_open_modals', $('body').data('fv_open_modals') - 1);
        });

        $('.modal').on('shown.bs.modal', function(event) {
            // keep track of the number of open modals
            if (typeof($('body').data('fv_open_modals')) == 'undefined') {
                $('body').data('fv_open_modals', 0);
            }

            // if the z-index of this modal has been set, ignore.
            if ($(this).hasClass('fv-modal-stack')) {
                return;
            }

            $(this).addClass('fv-modal-stack');
            $('body').data('fv_open_modals', $('body').data('fv_open_modals') + 1);
            $(this).css('z-index', 1040 + (10 * $('body').data('fv_open_modals')));
            $('.modal-backdrop').not('.fv-modal-stack').css('z-index', 1039 + (10 * $('body').data(
                'fv_open_modals')));
            $('.modal-backdrop').not('fv-modal-stack').addClass('fv-modal-stack');
        });
        
    $('.check_list').change(function(e) {
        alert('ah pues')
            var disabled = false;
            $('input:checkbox.check_list').each(function() {
                if (!this.checked) {
                    disabled = true;
                }
            });
            if (disabled) {
                $('.validar_terminos').attr('disabled', 'disabled');
                $('.validar_terminos').addClass('disabled');
            } else {
                $('.validar_terminos').removeAttr('disabled');
                $('.validar_terminos').removeClass('disabled');
            }
        });
    });
    
</script>

<script type="text/javascript">
$(document).ready(function () {
    
    var bank = $('.table_datatable_old').DataTable({
        dom: 'Blfrtip',
        buttons: [{
            extend: 'excelHtml5',
            text: 'Exportar a Excel',
            filename: 'Bancos',
            title: '',
            exportOptions: {
                "columns": [0, 1, 2]
            },
        }],
        "bSortCellsTop": true,
        "order": [
            [0, "asc"]
        ],
        "paging": true,
        "pagingType": "numbers",
        "scrollX": true,
        "fixedColumns": {
            "leftColumns": 2,
            "rightColumns": 1
        },
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ <br>de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 <br>de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
 
});
</script>

<style>
    

    .table_datatable thead{
            /* background-color: #3699FF !important; */
        }
        .table_datatable thead tr th{
            /* color: #fff !important; */
        }
</style>






<script src="https://apis.google.com/js/api.js"></script>
<script>
function start() {
  // 2. Initialize the JavaScript client library.
  gapi.client.init({
    'apiKey': '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',
    // clientId and scope are optional if auth is not required.
    'clientId': '17049974242-92kd6lc2cpemgha3bkkiedt01jfotgbc.apps.googleusercontent.com',
    'scope': 'profile',
  }).then(function() {
    // 3. Initialize and make the API request.
    return gapi.client.request({
      'path': 'https://people.googleapis.com/v1/people/me',
    })
  }).then(function(response) {
    console.log(response.result);
  }, function(reason) {
    console.log('Error: ' + reason.result.error.message);
  });
};
// 1. Load the JavaScript client library.
gapi.load('client', start);
</script>

 
@yield('script')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Formulario de Registro | {{encontrar_configuracion('nombre_plataforma')}} -  {{encontrar_configuracion('descripcion_plataforma')}} </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/plataforma/favico.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/plataforma/favico.ico') }}" type="image/x-icon">

    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <script src="https://kit.fontawesome.com/82ac0fb848.js" crossorigin="anonymous" SameSite="pudrete"></script>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->


    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('assets/css/pages/login/classic/login-1.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->

    <link href="{{ asset('assets/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css" />

    <style type="text/css">
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: .75rem;
        }

        .modal-backdrop {
            background-color: #48abc782 !important;
        }

        [v-cloak]>* {
            display: none;
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
            /*
        content: '';
        position: fixed;
        width: 100%;
        height: 100vh;
        background: url(dist/img/new-loader.gif) center;*/
        }

        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{

            background: #343a40 !important;
            color: #fff !important;

        }
    </style>


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 
</head>

<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
 
    <div class="d-flex flex-column flex-root" id="app">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
          
            <div class="container py-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-6">

                        <div class="p-5" style="background: #000; border-radius:10px">
                            <img src="{{asset(encontrar_configuracion('logo_plataforma'))}}" class="w-100" alt="">
        
                        </div>
        
                    </div>
                </div>
                <div class="mt-10">
                    <div class="row justify-content-center">
                     
                        <div class="col-md-6">

                            <div class="flash-message" id="mensaje">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-'.$msg))
                                        <p class="alert alert-{{ $msg }}">{!! Session::get('alert-'.$msg) !!} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                            </div>
                        
                            
                            <div class="card">
                                <div class="card-header">Validar PIN</div>
                
                                <div class="card-body">
                                    <form method="POST" action="{{ url('/validate_pin') }}">
                                        @csrf
                                        <input type="hidden" name="vuelo_token" value="{{$vuelo_id}}">                
                                        <input type="hidden" name="soguilla_token" value="{{$soguilla_id}}">                
                                        <div class="form-group row">
                                            <label for="pin" class="col-md-4 col-form-label text-md-right">PIN</label>                
                                            <div class="col-md-6">
                                                <input id="pin" type="pin" class="form-control" name="pin" required autofocus>
                                            </div>
                                        </div>            
                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                   Validar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
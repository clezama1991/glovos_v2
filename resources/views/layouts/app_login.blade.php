<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Login |  {{encontrar_configuracion('nombre_plataforma')}} -  {{encontrar_configuracion('descripcion_plataforma')}} </title>




    <title> Login |  {{encontrar_configuracion('nombre_plataforma')}} -  {{encontrar_configuracion('descripcion_plataforma')}} </title>
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

    </style>
</head>

<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">



    <!--begin::Main-->
    <div class="d-flex flex-column flex-root" id="app">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10"
                style="background-image: url({{asset(encontrar_configuracion('bg_login1'))}});">
                <!--begin: Aside Container-->
                <div class="d-flex flex-row-fluid flex-column justify-content-between p-10" style="background: #0a0e126b;border-radius: 20px;">
                    <!--begin: Aside header-->
                    <a href="#" class="flex-column-auto mt-5 pb-lg-0 pb-10">
                        <img src="{{asset(encontrar_configuracion('logo_plataforma'))}}" class="w-100" alt="" />
                    </a>
                    <!--end: Aside header-->

                    <!--begin: Aside content-->
                    <div class="flex-column-fluid d-flex flex-column justify-content-center font-weight-bolder h3">
                        {!! encontrar_configuracion('descripcion_login') !!} 
                    </div>
                    <!--end: Aside content-->

                    <!--begin: Aside footer for desktop-->
                    <div class="d-none">
                        <div class="opacity-70 font-weight-bold	text-white">
                            &copy; 2020 Metronic
                        </div>
                        <div class="d-flex">
                            <a href="#" class="text-white">Privacy</a>
                            <a href="#" class="text-white ml-10">Legal</a>
                            <a href="#" class="text-white ml-10">Contact</a>
                        </div>
                    </div>
                    <!--end: Aside footer for desktop-->
                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->

            <!--begin::Content-->
            <div class="flex-row-fluid d-flex flex-column position-relative p-7 overflow-hidden" style="background-image: url({{asset(encontrar_configuracion('bg_login2'))}});">

                {{-- <main v-cloak> --}}

                @yield('content')

                {{-- </main> --}}



                <!--end::Main-->
            </div>
        </div>
    </div>
            <!-- End Footer Area -->

</body>

</html>

<script src="{{ asset('js/app.js') }}" defer></script>

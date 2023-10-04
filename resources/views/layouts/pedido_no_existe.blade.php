<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Formulario de Registro | Volar en Asturias - Viajes en globo aerostatico ¡Vuela en el Paraiso! </title>
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

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {

            background: #343a40 !important;
            color: #fff !important;

        }
    </style>


    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

</head>

<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <div class="d-flex flex-column flex-root" id="app">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
            id="kt_login">
            <!--begin::Aside-->

            <div class="container py-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-6">

                        <div class="p-5" style="background: #000; border-radius:10px">
                            <img src="/assets/media/logos/logo-letter-1.png" class="w-100" alt="">

                        </div>

                    </div>
                </div>
                <div>
                    <img src="/images/no_existe.png" class="w-100" alt="">

                    <a href="https://volarenasturias.com/" class="btn btn-primary btn-pill btn-block text-center">
                        Salir</a>
                </div>

            </div>
        </div>

    </div>
    <!--end::Login-->
    </div>


    <footer>
        <div class="container col-10 bg-dark">
            <div class="row d-flex justify-content-between p-5">
                <div class="col-md-6 col-sm-12">
                    <div class="d-flex flex-row">
                        <p class="text-white h5">
                            Volar en Asturias es una empresa de trabajos aéreos autorizada por AESA, para vuelo con
                            pasajeros, fotografía oblicua, filmación aérea, y publicidad con globos aerostáticos.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 text-md-right text-center text-white mt-sm-5 mt-md-0 mt-sm mt-5">
                    {{-- <h5 class="text-md-right text-sm-center">Nuestras Redes Sociales</h5> --}}
                    <ul class="list-unstyled list-inline text-md-right text-center mt-2">
                        <li class="list-inline-item">
                            <a class="mx-1 text-white" href="https://volarenasturias.com/" target="_blank">
                                Ir a Sitio Web
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="row d-flex align-items-end py-4">
                <div class="col-md-12 text-white text-center">
                    Copyright &reg;{{date('Y')}} by Volarenasturias.com
                </div>
            </div>
        </div>
    </footer>
</body>

</html>

<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
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

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {

            background: #343a40 !important;
            color: #fff !important;

        }
 
        table {
            border-collapse: collapse;
            border-radius: 1em;
            overflow: hidden;
        }
 
    </style>


    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="
        https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js
        "></script>
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
                            <img src="{{asset(encontrar_configuracion('logo_plataforma'))}}" class="w-100" alt="">

                        </div>

                        <div class="flash-message mt-10" id="mensaje">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if (Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg) !!} <a href="#"
                                            class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                {{--
                <div class="p-5" style="background: #000; border-radius:10px">
                    <img src="/assets/media/logos/logo-letter-1.png" class="w-100" alt="">

                </div> --}}

                <ul class="nav nav-tabs  mt-10" id="myTab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link px-3 active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">
                            <i class="fa fa-user-plus mr-1" aria-hidden="true"></i> Datos del vuelo fijos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">
                            <i class="fa fa-user-circle mr-1" aria-hidden="true"></i> Datos del vuelo variables</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">
                            <i class="fa fa-users mr-1" aria-hidden="true"></i> Pasajeros</a>
                    </li>
                    <li class="nav-item {{ $role=='piloto' ? '' : 'd-none' }}" >
                        <a class="nav-link px-3" id="volado-tab" data-toggle="tab" href="#volado" role="tab"
                            aria-controls="volado" aria-selected="false">
                            <i class="fa fa-users mr-1" aria-hidden="true"></i> Vuelo Volado</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" id="checklist-tab" data-toggle="tab" href="#checklist" role="tab"
                            aria-controls="checklist" aria-selected="false">
                            <i class="fa fa-list mr-1" aria-hidden="true"></i> Lista de Tareas</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <input type="hidden" id="globo_id" value="{{ $vuelo->globo->id }}">
                    <input type="hidden" id="tabla_carga_maxima" value="{{ $vuelo->tabla_carga_maxima }}">
                    <input type="hidden" id="carga_maxima" value="{{ $vuelo->carga_maxima }}">
                    <input type="hidden" id="vuelo_token" value="{{ $vuelo_token }}">
                    <div class="tab-pane fade show active p-4" id="home" role="tabpanel"
                        aria-labelledby="home-tab">

                        <form action="/update_vuelo_piloto_extern" method="post" id="guardar_datos_pasajeros">
                            <input type="hidden" name="_token" ref="csrf_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="vuelo_token" value="{{ $vuelo_token }}">
                            <div class="row">
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="viento"> ID </label>
                                        <input type="text" class="form-control" value="Vuelo {{ $vuelo->id }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="fecha"> Fecha Vuelo </label>
                                        <input type="text" class="form-control" name="fecha" id="fecha"
                                            value="{{ $vuelo->fecha }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="zona"> Zona </label>
                                        <input type="text" class="form-control" name="zona" id="zona"
                                            value="{{ $vuelo->zona->nombre }}" disabled>
                                    </div>
                                </div>

                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="globo"> Globo </label>
                                        <input type="text" class="form-control" name="globo" id="globo"
                                            value="{{ $vuelo->globo->nombre }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="globo"> Modelo del Globo </label>
                                        <input type="text" class="form-control" name="modelo" id="modelo"
                                            value="{{ $vuelo->globo->modelo }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="globo"> Fabricante del Globo </label>
                                        <input type="text" class="form-control" name="fabricante" id="fabricante"
                                            value="{{ $vuelo->globo->fabricante }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="row bg-light-primary p-2">
                                        <div class="col-1 d-none d-md-block mb-3">
                                            <img :src="'images/ocaso.webp'" class="img-fluid rounded-lg" />
                                        </div>
                                        <div class="col-xs-2 col-md-2 col-6 m-0 pt-2">
                                            <div class="form-group mb-0">
                                                <label for="amanecer">Amanecer</label>
                                                <input id="amanecer" type="text" class="form-control input_info"
                                                    value="{{ $vuelo->amanecer }}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-md-2 col-6 m-0 pt-2">
                                            <div class="form-group mb-0">
                                                <label for="orto"><i class="fa fa-sun mr-2"
                                                        aria-hidden="true"></i>
                                                    Orto</label>
                                                <input id="orto" type="text" class="form-control input_info"
                                                    value="{{ $vuelo->orto }}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-md-2 col-6 m-0 pt-2">
                                            <div class="form-group mb-0">
                                                <label for="ocaso">
                                                    <i class="fa fa-moon mr-2" aria-hidden="true"></i>
                                                    Ocaso</label>
                                                <input id="ocaso" type="text" class="form-control input_info"
                                                    value="{{ $vuelo->ocaso }}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-md-2 col-6 mb-3 pt-2">
                                            <div class="form-group mb-0">
                                                <label for="anochecer">Anochecer</label>
                                                <input id="anochecer" type="text" class="form-control input_info"
                                                    value="{{ $vuelo->anochecer }}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="globo"> Matricula Globo </label>
                                        <input type="text" class="form-control" name="globo" id="globo"
                                            value="{{ $vuelo->globo->matricula }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="piloto"> Piloto </label>
                                        <input type="text" class="form-control" name="piloto" id="piloto"
                                            value="{{ $vuelo->piloto->full_name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="piloto"> Licencia Piloto </label>
                                        <input type="text" class="form-control" name="piloto" id="piloto"
                                            value="{{ $vuelo->piloto->dni }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="viento"> Peso Total KG </label>
                                        <input type="text" class="form-control" name="viento" id="viento"
                                            value="{{ $vuelo->total_carga_actual() }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="viento"> GAS KG </label>
                                        <input type="text" class="form-control" name="viento" id="viento"
                                            value="{{ $vuelo->total_peso_gas() }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="xxxx"> PASAJEROS KG </label>
                                        <input type="text" class="form-control" name="xxx" id="xxx"
                                            value="{{ $vuelo->total_peso_pasajeros() }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="viento"> GLOBO KG </label>
                                        <input type="text" class="form-control" name="viento" id="viento"
                                            value="{{ $vuelo->total_peso_globo() }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="viento"> CARGA MAXIMA </label>
                                        <input type="text" class="form-control" name="viento" id="viento"
                                            value="{{ $vuelo->carga_maxima }}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="viento"> CARGA DISP. </label>
                                        <input type="text" class="form-control" name="viento" id="viento"
                                            value="{{ $vuelo->total_peso_disponible_calc() }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane fade p-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <form action="/update_vuelo_piloto_extern" method="post" id="guardar_datos_pasajeros"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="vuelo_token" value="{{ $vuelo_token }}">
                            <div class="row">
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="gas"> Kg de Gas {{$role}} </label>
                                        <input type="text" class="form-control" name="gas" id="gas"
                                            @blur="ValidarCalculo('gas')" value="{{ $vuelo->gas }}"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="reserva"> Reserva </label>
                                        <input type="text" class="form-control" id="reserva" name="reserva"
                                            value="{{ $vuelo->reserva }}"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="altura_maxima"> Alt. max. de vuelo (Mts) </label>
                                        <input type="text" class="form-control" id="altura_maxima"
                                            name="altura_maxima" value="{{ $vuelo->altura_maxima }}"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="temperatura"> Temperatura </label>
                                        <input type="text" class="form-control" id="temperatura"
                                            name="temperatura" value="{{ $vuelo->temperatura }}"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="viento"> Viento </label>
                                        <input type="text" class="form-control" id="viento" name="viento"
                                            value="{{ $vuelo->viento }}"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="tabla_carga">Tabla de carga
                                            @if($role=='piloto')
                                            <a class=" badge badge-danger badge-pill text-white" data-toggle="modal"
                                                data-target="#VerTabla" @click="jeje()">
                                                Generar tabla de Carga
                                            </a>
                                            @endif
                                        </label>
                                        {{-- <a :href="tabla_carga" v-if="tabla_carga!=null" target="_blank"
                                            class="ml-2 badge badge-primary badge-pill"
                                            title="Descargar Tabla de carga"> Descargar</a>
                                        <span v-else class="ml-2 badge badge-danger badge-pill"> Sin Doc. </span> --}}
                                        <input type="file" class="form-control-file" ref="form_tabla_carga"
                                            name="form_tabla_carga" id="form_tabla_carga" placeholder=""
                                            aria-describedby="fileHelpId" {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <div class="form-group">
                                        <label for="tabla_carga_maxima">Valor Tabla Carga</label>
                                        <input :value="tabla_carga_maxima" name="tabla_carga_maxima" type="text"
                                            class="form-control"  {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="carga_maxima">CARGA MAXIMA ACTUAL</label>
                                        <input :value="carga_maxima" name="carga_maxima" id="carga_maxima"
                                            type="text" class="form-control form-control-solid"  {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="viento"> Parte METEO
                                            @if ($vuelo->parte_mateo != null)
                                                <a href="{{ $vuelo->parte_mateo }}" target="_blank"
                                                    class="ml-2 btn btn-sm btn-primary btn-pill"
                                                    title="Descargar Parte METEO"> Descargar</a>
                                            @endif
                                        </label>
                                        <input type="file" class="form-control" id=""
                                            name="form_parte_mateo"
                                            {{ $vuelo->estatus != 'Volado'  && $role=='piloto' ? '' : 'disabled' }}>
                                        @if ($vuelo->estatus != 'Volado' && $role=='piloto')
                                            @if ($vuelo->zona->meteoblue_url == null)
                                                <div>
                                                    <a class="btn btn-sm btn-danger disabled mt-2" disabled>
                                                        <i class="fa fa-download" aria-hidden="true"></i> Descargar de
                                                        Meteoblue
                                                    </a>
                                                    <p class="text-muted text-danger">No hay url de meteoblue en la
                                                        zona</p>
                                                </div>
                                            @else
                                                <div>
                                                    @if ($vuelo->parte_mateo != null)
                                                        <span v-if="load_meteoblue=='no'">
                                                            <a data-toggle="modal" data-target="#modelId"
                                                                class="btn btn-sm btn-danger mt-2">
                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                                Descargar de Meteoblue</a>
                                                        </span>
                                                    @else
                                                        <span v-if="load_meteoblue=='no'">
                                                            <a href="/flight_details_load_meteoblue/{{ $vuelo_token }}"
                                                                class="btn btn-sm btn-danger mt-2">
                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                                Descargar de Meteoblue</a>
                                                        </span>
                                                    @endif

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modelId" tabindex="-1"
                                                        role="dialog" aria-labelledby="modelTitleId"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Confirmación</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Esta Seguro que quiere sobreescribir Parte METEO?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <a href="/flight_details_load_meteoblue/{{ $vuelo_token }}"
                                                                        class="btn btn-primary">Sí, Confirmar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="horas_inicial_globo"> Horas de vuelo del Globo al inicial el vuelo
                                        </label>
                                        <input type="text" class="form-control" id="horas_inicial_globo"
                                            name="horas_inicial_globo" value="{{ $vuelo->horas_inicial_globo }}"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="horas_final_globo"> Horas de vuelo del Globo al finalizar el vuelo
                                        </label>
                                        <input type="text" class="form-control" id="horas_final_globo"
                                            name="horas_final_globo" value="{{ $vuelo->horas_final_globo }}"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>
                                    </div>
                                </div>

                            </div>
                            @if ($vuelo->estatus != 'Volado' && $role=='piloto')
                                <div class="col-12">
                                    <button class="btn btn-primary float-right mt-20 guardar_informacion"
                                        name="accion" value="add_pasajero" type="submit"> <i
                                            class="fas fa-save"></i> Actualizar
                                        Vuelo</button>
                                </div>
                            @endif

                        </form>
                    </div>
                    <div class="tab-pane fade p-4" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                        <?php $nro = 1; ?>
                        @foreach ($vuelo->pedidos as $pedido)
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="w-100 table-bordered table table-sm">
                                        <thead class="text-light bg-dark">
                                            <tr>
                                                <th colspan="2">PEDIDO: {{ $pedido->orden_wordpress }}</th>
                                                <th colspan="2">TELEFONO: <a
                                                        href="tel:{{ $pedido->telefono_contacto }}"> <i
                                                            class="fa fa-phone" aria-hidden="true"></i>
                                                        {{ $pedido->telefono_contacto }}</a> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="20%">Contacto <i class="fas fa-user-check    "></i></td>
                                                <td>{{ $pedido->nombre_contacto }}</td>
                                                <td width="20%"></td>
                                                <td width="20%" class="text-center">
                                                    <a href="https://api.whatsapp.com/send?phone={{ $pedido->telefono_contacto }}&text=Gracias Por Contactarnos"
                                                        target="_blank" class="btn btn-success btn-icon btn-sm">
                                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            @foreach ($pedido->PedidosPasajeros as $item)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $item->pasajero->nombres }}
                                                        {{ $item->pasajero->apellidos }}</td>
                                                    <td nowrap>{{ $item->pasajero->peso }} Kg</td>
                                                    <td class="text-center">
                                                        @if ($vuelo->estatus != 'Volado' && $role=='piloto')
                                                            <form action="/update_vuelo_delete_pasajero_extern"
                                                                method="post" id="guardar_datos_pasajeros">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <input type="hidden" name="id"
                                                                    value="{{ $item->id }}">
                                                                <button class="btn btn-sm btn-icon btn-danger">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="text-light bg-secondary">
                                                <td colspan="4">TOTAL {{ count($pedido->PedidosPasajeros) ?? 0 }}
                                                    PAX</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php $nro++; ?>
                        @endforeach

                        <table class="table w-100 table-striped table-bordered d-none">
                            <thead>
                                <tr>
                                    <th width="30">
                                        #
                                    </th>
                                    <th class="bg-light-success">
                                        Order-ID
                                    </th>
                                    <th class="bg-light-success">
                                        Contacto
                                    </th>
                                    <th class="bg-light-success">
                                        Teléfono Contacto
                                    </th>
                                    <th class="bg-light-danger">
                                        Nombres y Apellidos
                                    </th>
                                    <th class="bg-light-danger">
                                        Peso
                                    </th>
                                    @if ($vuelo->estatus != 'Volado' && $role=='piloto')
                                        <th>Eliminar</th>
                                        <th>Mensaje</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nro = 1; ?>
                                @foreach ($vuelo->pedidos as $pedido)
                                    @foreach ($pedido->PedidosPasajeros as $item)
                                        <tr>
                                            <td width="30"> {{ $nro }} </td>
                                            <td class="bg-light-success"> {{ $pedido->orden_wordpress }} </td>
                                            <td class="bg-light-success">
                                                {{ $pedido->nombre_contacto }}
                                            </td>
                                            <td class="bg-light-success">
                                                {{ $pedido->telefono_contacto }}
                                            </td>
                                            <td class="bg-light-danger">
                                                {{ $item->pasajero->nombres }} {{ $item->pasajero->apellidos }}
                                            </td>
                                            <td class="bg-light-danger">
                                                {{ $item->pasajero->peso }}
                                            </td>
                                            @if ($vuelo->estatus != 'Volado' && $role=='piloto')
                                                <td class="text-center">
                                                    <form action="/update_vuelo_delete_pasajero_extern" method="post"
                                                        id="guardar_datos_pasajeros">
                                                        <input type="hidden" name="_token"
                                                            value="{{ csrf_token() }}">
                                                        <input type="hidden" name="id"
                                                            value="{{ $item->id }}">
                                                        <button class="btn btn-sm btn-icon btn-danger">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="https://api.whatsapp.com/send?phone={{ $pedido->telefono_contacto }}&text=Gracias Por Contactarnos"
                                                        target="_blank" class="btn btn-success btn-icon btn-sm">
                                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                        <?php $nro++; ?>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade p-4" id="volado" role="tabpanel" aria-labelledby="volado-tab">

                        <form action="/update_vuelo_piloto_extern" method="post" id="guardar_datos_pasajeros">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="vuelo_token" value="{{ $vuelo_token }}">
                            <input type="hidden" name="vuelo_volado" value="1">
                            <div class="row">
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group"><label for="lugar_despegue">Lugar Despegue </label>
                                        <input id="lugar_despegue" name="lugar_despegue"
                                            value="{{ is_null($vuelo->lugar_despegue) ? $vuelo->zona->nombre ?? null : $vuelo->lugar_despegue }}"
                                            type="text" class="form-control"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? 'required' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6">
                                    <div class="form-group"><label for="lugar_aterrizaje">Lugar Aterrizaje
                                        </label>
                                        <input id="lugar_aterrizaje" name="lugar_aterrizaje"
                                            value="{{ is_null($vuelo->lugar_aterrizaje) ? $vuelo->zona->nombre ?? null : $vuelo->lugar_aterrizaje }}"
                                            type="text" class="form-control"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? 'required' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6 mb-3">
                                    <div class="form-group"><label for="fecha_despegue">Fecha Despegue</label>
                                        <input id="fecha_despegue" name="fecha_despegue"
                                            value="{{ is_null($vuelo->fecha_despegue) ? $vuelo->fecha : $vuelo->fecha_despegue }}"
                                            type="date" class="form-control"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? 'required' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6 mb-3">
                                    <div class="form-group"><label for="fecha_aterrizaje">Fecha
                                            Aterrizaje</label>
                                        <input id="fecha_aterrizaje"
                                            value="{{ is_null($vuelo->fecha_aterrizaje) ? $vuelo->fecha : $vuelo->fecha_aterrizaje }}"
                                            type="date" class="form-control"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? 'required' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6 mb-3">
                                    <div class="form-group"><label for="hora_despegue">Hora Despegue</label>
                                        <input id="hora_despegue" name="hora_despegue"
                                            value="{{ is_null($vuelo->hora_despegue) ? $vuelo->hora : $vuelo->hora_despegue }}"
                                            type="time" class="form-control"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? 'required' : 'disabled' }}>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3 col-6 mb-3">
                                    <div class="form-group"><label for="hora_aterrizaje">Hora Aterrizaje</label>
                                        <input id="hora_aterrizaje" name="hora_aterrizaje"
                                            value="{{ is_null($vuelo->hora_aterrizaje) ? $vuelo->hora : $vuelo->hora_aterrizaje }}"
                                            type="time" class="form-control"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? 'required' : 'disabled' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3 col-md-3 col-6 mb-3">
                                    <div class="custom-control custom-checkbox"><input id="checkbox-1"
                                            type="checkbox" name="cautivo"
                                            {{ $vuelo->cautivo == 1 ? 'checked' : '' }} class="custom-control-input"
                                            value="1" {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}><label
                                            for="checkbox-1" class="custom-control-label">
                                            Cautivo
                                        </label></div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="notas">Notas</label>
                                        <textarea class="form-control" name="notas" id="notas" rows="3"
                                            {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }}>{{ $vuelo->notas }}</textarea>
                                    </div>
                                </div>
                            </div>

                            @if ($vuelo->estatus != 'Volado' && $role=='piloto')
                                <div class="col-12">
                                    <button class="btn btn-primary float-right mt-20 guardar_informacion"
                                        name="accion" value="add_pasajero" type="submit"> <i class="fa fa-check"
                                            aria-hidden="true"></i> Finalizar Vuelo</button>
                                </div>
                            @endif

                        </form>
                    </div>
                    <div class="tab-pane fade p-4" id="checklist" role="tabpanel" aria-labelledby="checklist-tab">
                        <div class="row">
                            
                            @if (count($check_list) > 0)
                            <div class="col-md-12">
                                {!!encontrar_configuracion('format_title_checklist_pilotos')!!}
                            </div>
                                <div class="col-12">
                                    @foreach ($check_list as $key => $item)
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <input type="checkbox" class="check_list"
                                                    name="" id="{{$item->id}}"
                                                    {{ $vuelo->estatus != 'Volado' && $role=='piloto' ? '' : 'disabled' }} 
                                                    value="{{$item->id}}" {{$item->checked == '1' ? 'checked' : '' }} >

                                                <span role="button" data-toggle="modal"
                                                    data-target="#modelId{{ $item->id }}"
                                                    class="h4 ml-2"
                                                    style="font-weight: 400 !important;">
                                                    {{ $key + 1 }}.- {{ $item->titulo }}
                                                    <i class="fa fa-info-circle"
                                                        aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade"
                                            id="modelId{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detalles</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span
                                                                aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            {!! $item->descripcion !!}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                    </div>
                </div>

                @if (Session::has('success'))
                    <script>
                        $(document).ready(function() {
                            swal({
                                title: "Registro Exitoso",
                                text: "Los Datos del pasajero han sido guardados correctamente!",
                                type: "success"
                            });
                        });
                    </script>
                    {{-- <div class="alert alert-warning" role="alert">
                    Los Datos del pasajero del Pedido han sido completados correctamente!
                </div> --}}
                @elseif (Session::has('error'))
                    @if (Session::has('error'))
                        {{ Session::get('error') }}
                    @endif
                    <script>
                        $(document).ready(function() {
                            swal({
                                title: "Registro Con Errores",
                                text: " Ha ocurrido un error durante la ejecución del proceso, intente nuevamente! ",
                                type: "error"
                            });
                        });
                    </script>
                    {{-- <div class="alert alert-danger" role="alert">
                    Ha ocurrido un error durante la ejecución del proceso, intente nuevamente!
                </div> --}}
                @endif

            </div>
        </div>

        <div class="modal fade" id="VerTabla" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdrop" aria-hidden="true" ref="vuemodal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Tabla de Carga
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body modal-body-tabla-carga" id="imgtablacarga">
                        <span id="toolTipBox"></span>
                        <img src="{{ asset('images/tabla_carga_imagen_hd_2.jpg') }}" border="0"
                            style="cursor:crosshair" @click="toolTip()">
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold close2"
                            data-dismiss="modal">Cerrar</button>
                    </div>
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
                            {{encontrar_configuracion('nota_empresa')}} 
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 text-md-right text-center text-white mt-sm-5 mt-md-0 mt-sm mt-5">
                    {{-- <h5 class="text-md-right text-sm-center">Nuestras Redes Sociales</h5> --}}
                    <ul class="list-unstyled list-inline text-md-right text-center mt-2">
                        <li class="list-inline-item">
                            <a class="mx-1 text-white" href="{{encontrar_configuracion('url_empresa')}}" target="_blank">
                                Ir a Sitio Web
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="row d-flex align-items-end py-4">
                <div class="col-md-12 text-white text-center">
                    Copyright &reg;{{ date('Y') }} by {{encontrar_configuracion('nombre_empresa')}}
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
<style>
    .input_info {
        border: 0;
        padding: 0;
        margin: 0;
        background: transparent;
        height: 15px;
        font-weight: 600;
    }

    .input_info[readonly] {
        background: transparent;
    }
    
  .modal-body-tabla-carga { 
    overflow-x: auto;
  }
</style>
<script type="text/javascript">
    jQuery(document).ready(function() {

        $('.check_list').change(function (e) { 
            
            var check_id = $(this).attr('id');
            var check_list = $(this).is(':checked');
            var vuelo_token = $('#vuelo_token').val();

            axios.post('/update_checklist_piloto_extern',{
                check_id: check_id,
                check_list: check_list,
                vuelo_token: vuelo_token,
             }).then(response=>{                 
              
            }).catch(error => {
                console.log(error);
                this.errors = error.response
            });

        });


        $('.float-number').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event
                    .which > 57)) {
                event.preventDefault();
            }
        });
    });
    // $(document).ready(function(){
    //     const formulario = document.querySelector("#guardar_datos_pasajeros");    
    //     formulario.onsubmit = e => {
    //         divs = document.getElementsByClassName("nuevopasajero").length;
    //         vacios = 0;
    //         $('.nuevopasajero').each(function(){
    //             if($(this).val()==''){
    //                 vacios++;
    //             }
    //         });
    //         if (vacios ==  divs) {
    //             e.preventDefault();
    //             swal({
    //                 title: "Formulario Incompleto",
    //                 text: "Debes ingresar al menos un pasajero...",
    //                 type: "error"
    //             });
    //         }
    //     }
    // });

    // $('.nuevopasajero').change(function() {
    //     var id = 'form_'+$(this).data('id_pass');
    //     passajero = true;
    //     $('.'+id).each(function(){
    //         if($(this).val()==''){
    //             passajero = false;
    //         }
    //     });
    //     if (passajero) {
    //         $('.'+id).attr('required', false); 
    //     }else{
    //         $('.'+id).attr('required', true);
    //     }
    // });


    $('.peso').keyup(function(e) {
        if (/\D/g.test(this.value)) {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });
</script>


<script>
    new Vue({
        el: '#app',
        data: {
            load_meteoblue: 'no',
            tabla_carga: 0,
            tabla_carga_maxima: $('#tabla_carga_maxima').val(),
            carga_maxima: $('#carga_maxima').val(),
            Globos: []
        },
        mounted() {
            // console.log('VUEJS');

            this.BuscarGlobos();
        },


        methods: {

            ValidarCalculo(campo) {
                if (campo == 'gas') {
                    $('#reserva').val($('#gas').val() * 0.20);
                }
            },
            jeje() {
                $(".modal-body").scrollLeft(300);
            },
            toolTip(me) {

                // console.log('ah pues');
                var theObj = me
                var posicion_entero = "";
                var posicion_decimal = 1;
                var rango_decimal = 4;
                var rango_entre_enteros = 43;
                var tabla_inicial = 41;
                var tabla_valor_inicial = 22;
                var posicion_inicial = 0;
                var coordenada_seleccionada = 0;
                if (window.event.offsetX < tabla_inicial || window.event.offsetX > 615 || window.event.offsetY <
                    43) {
                    alert('fuera de rango' + window.event.offsetX);
                    return false;
                }

                for (var regla = 0; regla <= 13; regla++) {

                    if (window.event.offsetX >= tabla_inicial && window.event.offsetX <= tabla_inicial +
                        rango_entre_enteros) {

                        posicion_inicial = tabla_inicial;
                        posicion_entero = tabla_valor_inicial;
                        coordenada_seleccionada = window.event.offsetX;

                        for (var i = 11; i >= 1; i--) {

                            if (coordenada_seleccionada >= posicion_inicial && coordenada_seleccionada <=
                                posicion_inicial + rango_decimal) {

                                if (i == 10) {
                                    posicion_decimal = 9;
                                } else if (i == 11) {
                                    posicion_decimal = 0;
                                    posicion_entero = posicion_entero + 1;
                                } else {
                                    posicion_decimal = i;
                                }

                            }

                            posicion_inicial += rango_decimal;

                        }

                    }

                    tabla_valor_inicial--;
                    tabla_inicial += rango_entre_enteros;

                }

                var final = posicion_entero + "." + posicion_decimal;
                this.decimal_tabla_carga = posicion_decimal;
                /* document.getElementById('toolTipBox').innerHTML=window.event.offsetX +" - "+ window.event.offsetY; */
                /* document.getElementById('toolTipBox').innerHTML=window.event.offsetX +" - "+ posicion_entero+" - "+ posicion_decimal; */
                // document.getElementById('toolTipBox').innerHTML=posicion_entero+"."+ posicion_decimal;
                document.getElementById('toolTipBox').style.display = "block";


                var ev = arguments[0] ? arguments[0] : event;
                var x = ev.clientX - 260;
                var y = ev.clientY - 87;
                var diffX = 0;
                var diffY = 0;
                document.getElementById('toolTipBox').style.top = y + document.body.scrollTop + "px";
                document.getElementById('toolTipBox').style.left = x + document.body.scrollLeft + "px";

                var _this = this;
                this.tabla_carga_maxima = final;

                let text;
                if (confirm("Confirmar valor seleccionado: " + final) == true) {



                    $("#VerTabla .close").click();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                } else {

                }


            },

            BuscarGlobos() {
                var url = '/admin/globos';
                axios.get(url).then(response => {
                    this.Globos = response.data.records;
                    // console.log(this.Globos);
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
        },
        created: function() {

        },

        watch: {
            'tabla_carga_maxima': function(set) {
                var Globos = this.Globos;
                var decimal_tabla_carga = this.decimal_tabla_carga;
                var id = parseInt($('#globo_id').val());
                var globo = _.find(Globos, ['id', id]);
                // console.log(Globos, id, globo);
                if (globo) {
                    var modelo_globo = globo.modelo_globo;
                    var tabla_carga_maxima = parseInt(this.tabla_carga_maxima);
                    var init = 'fift_inits_' + tabla_carga_maxima;
                    var end = 'fift_inits_' + (tabla_carga_maxima + 1);
                    var rango = modelo_globo[end] - modelo_globo[init];
                    var rango_por_uno = rango / 10;
                    var carga_maxima_decimal = rango_por_uno * decimal_tabla_carga;
                    var total_carga_maxima = modelo_globo[init] + carga_maxima_decimal;
                    this.carga_maxima = total_carga_maxima;
                }
            },
        },
    });
</script>

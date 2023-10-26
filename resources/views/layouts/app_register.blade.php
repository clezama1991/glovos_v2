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
                {{--                 
                <div class="p-5" style="background: #000; border-radius:10px">
                    <img src="/assets/media/logos/logo-letter-1.png" class="w-100" alt="">

                </div> --}}

                <ul class="nav nav-tabs  mt-10" id="myTab" role="tablist">
                    @if ($pedido->vuelo && $pedido->vuelo->multimedia)
                        <li class="nav-item">
                            <a class="nav-link px-3 active" id="multimedia-tab" data-toggle="tab" href="#multimedia"
                                role="tab" aria-controls="multimedia" aria-selected="false">
                                <i class="fa fa-users mr-1" aria-hidden="true"></i> Multimedia
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ !$pedido->vuelo || !$pedido->vuelo->multimedia ? 'active' : '' }}"
                            id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                            aria-selected="true">
                            <i class="fa fa-user-plus mr-1" aria-hidden="true"></i> Pasajero</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">
                            <i class="fa fa-user-circle mr-1" aria-hidden="true"></i> Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">
                            <i class="fa fa-users mr-1" aria-hidden="true"></i> Pasajeros
                            ({{ $total_registrado }}/{{ $total_pasajeros }})</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    @if ($pedido->vuelo && $pedido->vuelo->multimedia)

                        <div class="tab-pane fade show active" id="multimedia" role="tabpanel"
                            aria-labelledby="multimedia-tab">

                            <div class="p-3">
                                <div class="card card-custom bg-light-dark gutter-b w-100">
                                    @if ($pedido->vuelo->estado_multimedia() == 'Multimedia Disponible')
                                        <div class="card-body">

                                            <h3 class=" font-weight-bolder mb-3"><i
                                                    class="fa fa-exclamation-triangle mr-2 fa-1x"
                                                    aria-hidden="true"></i>Multimedia Disponible</h3>
                                            <div class="row bg-white py-10">
                                                <div class="col-md-12 text-center">

                                                    <i class="fa fa-picture-o fa-2x text-warning"
                                                        aria-hidden="true"></i> <span style="font-size: large;">
                                                        Archivos multimedia disponibles para descargar... </span>
                                                    <br><br><a class="btn btn-primary"
                                                        href="/descargar_multimedias/{{ $pedido->vuelo->id }}/{{ $pedido->id }}"
                                                        target="_blank"> Descarga Archivo Comprimido (.ZIP) aquí</a>


                                                </div>
                                            </div>

                                            <div class="row bg-white py-10">
                                                @foreach ($pedido->vuelo->multimedias as $multimedias)
                                                    <div class="col-md-3 col-12"
                                                        v-for="(item, index) in form.multimedias"
                                                        :key="index">
                                                        <div class="card card-custom gutter-b card-stretch  shadow-none"
                                                            style="background:none">
                                                            <div
                                                                class="card-body d-flex flex-column rounded justify-content-between p-2  shadow">
                                                                <div class="text-center rounded h-100"
                                                                    style="background:url('{{ $multimedias->extension != 'mp4' && $multimedias->extension != 'MP4' ? asset($multimedias->carpeta) : asset('images/video_multimedia.png') }}'); background-size:cover; min-height: 200px;">

                                                                </div>
                                                            </div>
                                                            <div class="card-footer d-flex justify-content-end">
                                                                <a href="/download_multimedia/{{ Crypt::encrypt($multimedias->id) }}"
                                                                    target="_blank"
                                                                    class="btn btn-primary btn-icon btn-sm">
                                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    @else
                                        <div class="card-body">

                                            <h3 class=" font-weight-bolder mb-3"><i
                                                    class="fa fa-exclamation-triangle mr-2 fa-1x"
                                                    aria-hidden="true"></i>{{ $pedido->vuelo->estado_multimedia() }}
                                            </h3>
                                            <div class="row bg-white py-10">
                                                <div class="col-md-12 text-center">

                                                    {{ $pedido->vuelo->estado_multimedia() }}

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                    @endif
                    <div class="tab-pane fade show  {{ !$pedido->vuelo || !$pedido->vuelo->multimedia ? 'active' : '' }}"
                        id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if ($completado)

                            <div class="p-3">
                                <div class="card card-custom bg-light-dark gutter-b w-100">
                                    <div class="card-body">

                                        <h3 class=" font-weight-bolder mb-3"><i
                                                class="fa fa-exclamation-triangle mr-2 fa-1x"
                                                aria-hidden="true"></i>Información Completa</h3>
                                        <div class="row bg-white py-10">
                                            <div class="col-md-12">

                                                <i class="fa fa-exclamation-triangle fa-2x text-warning"
                                                    aria-hidden="true"></i> Todos los pasajeros han registrado su
                                                información personal.

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-3">
                                <form action="/saved_completed_form" method="post" id="guardar_datos_pasajeros">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{ $pedido->id }}">

                                    <div class="card card-custom bg-light-dark gutter-b w-100">
                                        <div class="card-body">
                                            <div>
                                                <h3 class=" font-weight-bolder mb-3"><i
                                                        class="fa fa-user-plus mr-2 fa-1x"
                                                        aria-hidden="true"></i>Registrar Pasajero</h3>
                                                <div class="row bg-white py-10">
                                                    <div class="col-md-3">
                                                        <div class="form-group ">
                                                            <label for="">Nombre *</label>
                                                            <input type="text" name="nombre_pasajero"
                                                                class="form-control" placeholder="Nombre" required
                                                                {{ $pedido->vuelo->estatus != 'Volado' ? '' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group ">
                                                            <label for="">Apellido *</label>
                                                            <input type="text" name="apellidos_pasajero"
                                                                class="form-control" placeholder="Apellido" required
                                                                {{ $pedido->vuelo->estatus != 'Volado' ? '' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group ">
                                                            <label for="">Peso Kgs *</label>
                                                            <input type="text" name="peso_pasajero"
                                                                class="form-control float-number" placeholder="Peso"
                                                                required
                                                                {{ $pedido->vuelo->estatus != 'Volado' ? '' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                    @if (count($check_list) > 0)
                                                    <div class="col-md-12">
                                                        {!!encontrar_configuracion('format_title_checklist_pasajeros')!!}
                                                    </div>
                                                        <div class="col-12">
                                                            @foreach ($check_list as $key => $item)
                                                                <div class="row mb-2">
                                                                    <div class="col-md-12">
                                                                        <input type="checkbox" class="check_list"
                                                                            name="" id=""
                                                                            value="checkedValue">

                                                                        <span role="button" data-toggle="modal"
                                                                            data-target="#modelId{{ $item->id }}"
                                                                            class="h4 ml-2"
                                                                            style="font-weight: 400 !important;">
                                                                            {{ $key + 1 }}.- {{ $item->titulo }}
                                                                            
                                                                            <span class="badge badge-primary badge-pill">

                                                                                <i class="fa fa-info-circle text-warning"
                                                                                    aria-hidden="true"></i>

                                                                                Pulsa aquí para leer

                                                                            </span>
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
                                                    @if ($pedido->vuelo->estatus != 'Volado')
                                                        <div class="col-12">
                                                            @if (count($check_list) > 0)
                                                                <button
                                                                    class="btn btn-primary float-right mt-20 guardar_informacion validar_terminos disabled"
                                                                    disabled name="accion" value="add_pasajero"
                                                                    type="submit">
                                                                    <i class="fas fa-save"></i> Registrar Pasajero</button>
                                                            @else
                                                                <button
                                                                    class="btn btn-primary float-right mt-20 guardar_informacion" name="accion" value="add_pasajero"
                                                                    type="submit">
                                                                    <i class="fas fa-save"></i> Registrar Pasajero</button>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </form>
                            </div>

                        @endif
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="p-3">
                            <form action="/saved_completed_form" method="post" id="guardar_datos_pasajeros">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $pedido->id }}">
                                <div class="card card-custom bg-light-dark gutter-b w-100">
                                    <div class="card-body">
                                        <div>
                                            <h3 class=" font-weight-bolder mb-3"><i
                                                    class="fa fa-user-circle mr-2 fa-1x" aria-hidden="true"></i>Datos
                                                de Contacto</h3>
                                            <div class="row bg-white py-10">
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label for="">Nombre *</label>
                                                        <input type="text" name="nombre_contacto"
                                                            class="form-control" placeholder="Nombre"
                                                            value="{{ $pedido->nombre_contacto }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label for="">Ciudad *</label>
                                                        <input type="text" name="ciudad_contacto"
                                                            class="form-control" placeholder="Ciudad"
                                                            value="{{ $pedido->ciudad_contacto }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label for="">Teléfono *</label>
                                                        <input type="text" name="telefono" v-numero
                                                            class="form-control" placeholder="Teléfono"
                                                            value="{{ $pedido->telefono_contacto }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group ">
                                                        <label for="">Email *</label>
                                                        <input type="email" name="email" class="form-control"
                                                            placeholder="Email" value="{{ $pedido->email_contacto }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button
                                                        class="btn btn-primary float-right mt-20 guardar_informacion"
                                                        name="accion" value="edit_contacto" type="submit"> <i
                                                            class="fa fa-refresh" aria-hidden="true"></i> Actualizar
                                                        Contacto</button>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                        <div class="p-3">
                            <div class="card card-custom bg-light-dark gutter-b w-100">
                                <div class="card-body">

                                    <h3 class=" font-weight-bolder mb-3"><i class="fa fa-users mr-2 fa-1x"
                                            aria-hidden="true"></i>Pasajeros</h3>
                                    <div class="row bg-white py-10">
                                        <div class="col-md-12">
                                            <table class="table w-100 table-striped table-bordered">
                                                <thead class="bg-light-primary">
                                                    <tr>
                                                        <th width="30">
                                                            #
                                                        </th>
                                                        <th>
                                                            Nombre y Apellido
                                                        </th>
                                                        <th>
                                                            Peso
                                                        </th>
                                                        @if ($pedido->vuelo->estatus != 'Volado')
                                                            <td>Editar</td>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nro = 1; ?>
                                                    @foreach ($pedido->PedidosPasajeros as $item)
                                                        <tr>
                                                            <td width="30"> {{ $nro }} </td>
                                                            <td>
                                                                {{ $item->pasajero->nombres }}
                                                                {{ $item->pasajero->apellidos }}
                                                            </td>
                                                            <td>
                                                                {{ $item->pasajero->peso }}
                                                            </td>
                                                            
                                                            @if ($pedido->vuelo->estatus != 'Volado')
                                                                <td>
                                                                    <!-- Button trigger modal -->
                                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId{{$item->pasajero->id}}">
                                                                    Editar
                                                                    </button>
                                                                    
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="modelId{{$item->pasajero->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId{{$item->pasajero->id}}" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Actualizar Datos</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                </div>
                                                                                <form action="/update_data_passanger" method="post" id="update_data_passanger">
                                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                    <input type="hidden" name="pasajero_id" value="{{ $item->pasajero->id }}">

                                                                                    <div class="modal-body"> 
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group ">
                                                                                                    <label for="">Nombre *</label>
                                                                                                    <input type="text" name="nombre_pasajero"
                                                                                                        class="form-control" placeholder="Nombre" required value="{{ $item->pasajero->nombres }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group ">
                                                                                                    <label for="">Apellido *</label>
                                                                                                    <input type="text" name="apellidos_pasajero"
                                                                                                        class="form-control" placeholder="Apellido" required value="{{ $item->pasajero->apellidos }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group ">
                                                                                                    <label for="">Peso Kgs *</label>
                                                                                                    <input type="text" name="peso_pasajero"
                                                                                                        class="form-control float-number" placeholder="Peso"
                                                                                                        required value="{{ $item->pasajero->peso }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                        <button type="submit" class="btn btn-warning">Actualizar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            @endif

                                                        </tr>
                                                        <?php $nro++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    Copyright &reg;{{ date('Y') }} by Volarenasturias.com
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

<script type="text/javascript">
    jQuery(document).ready(function() {
        $('.float-number').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event
                    .which > 57)) {
                event.preventDefault();
            }
        });


        $('.check_list').change(function(e) {
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

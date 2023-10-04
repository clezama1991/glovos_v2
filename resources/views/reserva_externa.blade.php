<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reverva Externa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

</head>

<body>
    <div class="container shadow p-3 mb-5 bg-body rounded">


        <div class="row">
            <div class="col-md-12 mb-2">
                <h4>Formulario de reservas para vuelos</h4>
                <p class="fw-normal">Los campos identificados con <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> son obligatorios</p>

            </div>
        </div>
        <form action="" method="post" id="form" enctype="multipart/form-data">
            <meta name="_token" content="{!! csrf_token() !!}" />
            @csrf
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="orden_wordpress"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Nro de Pedido</label>                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-upc"></i>                            </span>
                            <input type="text" class="form-control" name="orden_wordpress" id="orden_wordpress"
                            aria-describedby="helpId" placeholder="Nro de Pedido" required>                         
                        </div>
                    </div>
                </div> 
                <div class="col-md-4 mb-2"> 
                    <label for="privado"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Tipo de vuelo</label>                     
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-exclamation-octagon"></i></span>
                        <select class="form-control" name="privado" id="privado" required>
                            <option value="">Selecciona</option>
                            <option value="0">Vuelo estándar</option>
                            <option value="1">Vuelo privado</option>
                        </select>            
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="zona_id"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Zona</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-geo-alt-fill"></i></span>
                        <select class="form-control" name="zona_id" id="zona_id" required>
                            <option value="">Selecciona</option>
                            @foreach ($zonas as $zona)                                
                                <option value="{{$zona->id}}">{{$zona->nombre}}</option>
                            @endforeach
                        </select>    
                    </div>                  
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="numpax"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Nro de pasajeros</label>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-lines-fill"></i></span>
                            <select class="form-control" name="numpax" id="numpax" required>
                                <option value="">Selecciona</option>
                                @for ($i = 1; $i <= 11; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                <option value="12">11 o más - Consultar</option>
                            </select>                  
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="fecha_reserva"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Fecha de reserva</label>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-event"></i></span>
                            <input type="date" class="form-control" name="fecha_reserva" id="fecha_reserva"
                                aria-describedby="helpId" placeholder="" required>                   
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="fecha_reserva">Cupón de vuelo</label>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-ticket-perforated"></i></span>
                            <input class="form-control" type="file" id="formFile" name="cupon">                
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="nombre_contacto"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Nombre Completo</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-badge"></i></span>
                            <input type="text" class="form-control" placeholder="Nombre Completo" name="nombre_contacto" aria-describedby="basic-addon1">
                          </div>
                          
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="email_contacto"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Email</label>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                            <input type="text" class="form-control" name="email_contacto" id="email_contacto"
                                aria-describedby="helpId" placeholder="Email" required>               
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="telefono_contacto">Teléfono</label>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-phone"></i></span>
                            <input type="text" class="form-control" name="telefono_contacto" id="telefono_contacto"
                                aria-describedby="helpId" placeholder="Teléfono">                     
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="notas"> <i class="bi bi-chat-left-dots"></i>  Observaciones</label>
                        <textarea class="form-control" name="notas" id="notas" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <label for=""><i class="bi bi-info-circle-fill"></i> Términos y Condiciones</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input check_list" name="" id=""
                                value="checkedValue">
                            Acepto <a href="https://volarenasturias.com/condiciones" target="_blank">condiciones generales </a>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-3 d-grid gap-2 mb-2">
                    <button type="button" class="btn btn-danger btn-block"> <i class="bi bi-x-circle"></i> Cancelar </button>
                </div>
                <div class="col-md-3 d-grid gap-2 mb-2">
                    <button type="submit" class="btn btn-primary btn-block validar_terminos disabled" id="guardar" disabled > <i class="bi bi-check-circle"></i> Reservar </button>
                    <button type="submit" class="btn btn-primary btn-block validar_terminos disabled d-none" id="guardando" disabled >
                        <div class="spinner-border text-white" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </button>
                </div>
            </div>

        </form>

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
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

    $("#form").on('submit', (function(e) {
        e.preventDefault();
        $('#guardando').removeClass('d-none');
        $('#guardar').addClass('d-none');
        $.ajax({
            url: "/saved_reserve",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {  
                if(!data.result){
                    alert(data.msg);
                }else{
                    window.location.href = 'https://volarenasturias.com/formulario-completado';
                } 
            },
            error: function(e) {
                $("#err").html(e).fadeIn();
            }
        });
    }));
</script>

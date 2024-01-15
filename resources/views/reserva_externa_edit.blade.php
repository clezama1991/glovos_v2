<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Completar Reserva Externa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

</head>

<body>
    <div class="container shadow p-3 mb-5 bg-body rounded">


        <div class="row">
            <div class="col-md-12 mb-2">
                <h4>Nuevas fechas para el pedido</h4>
                <p class="fw-normal">{!!$record->cambios_fecha[0]->reserva->ultimo_comentario('cambio fecha')->observacion!!}
                </p>

            </div>
        </div>
        <form action="" method="post" id="form" enctype="multipart/form-data">
            <meta name="_token" content="{!! csrf_token() !!}" />
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4>Tu información</h4>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="orden_wordpress"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Nro de Pedido</label>                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-upc"></i></span>
                            <input type="text" class="form-control id="orden_wordpress"
                            aria-describedby="helpId" placeholder="Nro de Pedido" disabled value="{{$record->orden_wordpress}}">                         
                        </div>
                    </div>
                </div> 
                <div class="col-md-4 mb-2">
                    <label for="zona"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Zona</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-geo-alt-fill"></i></span>
                        <select class="form-control" id="zona" disabled>
                            <option value="">Selecciona</option>
                            <option value="Gijón" {{$record->zona == 'Gijón' ? 'selected' : ''}}>Costa - Gijón</option>
                            <option value="Oviedo" {{$record->zona == 'Oviedo' ? 'selected' : ''}}>Interior - Oviedo</option>
                            <option value="Sariego" {{$record->zona == 'Sariego' ? 'selected' : ''}}>Interior - Sariego</option>
                            <option value="Piloña" {{$record->zona == 'Piloña' ? 'selected' : ''}}>Interior - Piloña</option>
                        </select>    
                    </div>                  
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="fecha_reserva"> <i class="bi bi-asterisk" style="font-size: .8rem; color:red;"></i> Fecha de reserva</label>                     
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-event"></i></span>
                            <input type="date" class="form-control" id="fecha_reserva"
                                aria-describedby="helpId" placeholder="" disabled value="{{$record->fecha_reserva}}">                   
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                
                <div class="col-md-12 mb-2">
                    <h4>Fechas Disponibles</h4>
                </div>
                
                <div class="col-md-12 mb-2">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Fechas</th>
                            <th>Zona</th>
                            <th class="text-center">Seleccionar</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($record->cambios_fecha as $cambio)
                                
                            <tr>
                                <td scope="row">{{$cambio->fecha}}</td>
                                <td scope="row">{{$cambio->zonas->nombre ?? null}}</td>
                                <td class="text-center">
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="acept_date" value="{{$cambio->id}}" id="" value="checkedValue">
                                      </label>
                                    </div>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                </table>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-3 d-grid gap-2 mb-2">
                    <button type="button" class="btn btn-danger btn-block"> <i class="bi bi-x-circle"></i> Cancelar </button>
                </div>
                <div class="col-md-3 d-grid gap-2 mb-2">
                    <button type="submit" class="btn btn-primary btn-block"> <i class="bi bi-check-circle"></i> Continuar </button>
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
    });

    $("#form").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "/completed_reserve",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                //$("#preview").fadeOut();
                $("#err").fadeOut();
            },
            success: function(data) { 
                console.log(data);
                if(!data.result){ 
                    alert(data.msg); 
                } 
            },
            error: function(e) {
                $("#err").html(e).fadeIn();
            }
        });
    }));
</script>

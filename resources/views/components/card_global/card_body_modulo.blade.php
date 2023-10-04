@if(ShowConfigGlobal('disenho_metronic'))
    
@else

<div class="row justify-content-center">
    <div class="col col-md-4 text-center">
        <a href="{{ url($url) }}"
            class="btn btn-success btn-block mx-1 deleteBtn card-1">
            <i class="fas fa-plus-circle"></i> {{trans('plataforma.buttons.create')}} {{$name_modulo_singular}}
        </a>
    </div>
</div>

@endif
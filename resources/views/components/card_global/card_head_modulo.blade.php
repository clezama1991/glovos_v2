    <div class="card-header flex-wrap pb-0" style="display: flex; align-items: center; min-height: 50px;">
        <div class="card-title">
            <h3 class="card-label font-weight-bolder">
                {{$name_modulo}}
                @if(isset($info_modulo))
                <span class="text-muted pt-2 font-size-sm d-block">
                    {{$info_modulo ?? null}}
                </span>
                @endif
            </h3>
        </div>
        <div class="card-toolbar">
            @if(isset($filter))
                <button class="btn btn-success btn-block" type="button" data-toggle="collapse"
                                    data-target="#{{$filter}}" aria-expanded="true" aria-controls="{{$filter}}">
                    <i class="fas fa-filter"></i>
                    Filtros
                </button>
            @endif
            @if($action=='create')
                <a href="{{ url($url) }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-plus-circle"></i>	{{trans('plataforma.buttons.create')}}
                    {{$name_modulo_singular}}
                </a>
            @endif
        </div>
    </div>
<div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
    <!--begin::Header-->
    <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5" kt-hidden-height="46" style="">
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_vuelos" title="Vuelos"><i class="fas fa-plane-departure"></i> <span class="label label-sm label-rounded label-warning">{{count($multimedias_caducados)}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_logs" title="Riesgos"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span class="label label-sm label-rounded label-warning">{{count($riesgos)}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_notifications" title="Globos"> <i class="fas fa-lightbulb"></i> <span class="label label-sm label-rounded label-warning">{{count($globos)}}</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_settings" title="Pilotos"> <i class="fas fa-user-tie"></i>  <span class="label label-sm label-rounded label-warning">{{count($pilotos_fechas_caducadas)}}</span></a>
            </li>
        </ul>
        <div class="offcanvas-close mt-n1 pr-5">
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content px-10">
        <div class="tab-content">
            <!--begin::Tabpane-->
            <div class="tab-pane fade pt-3 pr-5 mr-n5 scroll ps active show ps--active-y" id="kt_quick_panel_vuelos" role="tabpanel" style="height: 582px; overflow: hidden;">
                <div class="mb-15">
                    <h5 class="font-weight-bold mb-5">Multimedias Caducados</h5>               
                    @foreach ($multimedias_caducados as $item) 
                    <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-5">
                      <span class="svg-icon svg-icon-warning mr-5">
                        <span class="svg-icon svg-icon-lg">
                          <i class="fas fa-exclamation-triangle"></i>                        
                        </span>
                      </span>
                      <div class="d-flex flex-column flex-grow-1 mr-2">
                        <a href="/dashboard#/vuelos/multimedia/{{$item->id}}" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">
                          {!! \Illuminate\Support\Str::words($item->name, 20, '...') !!}
                        </a>
                        <span class="text-muted font-size-sm">Fecha Caducidad: {{ Carbon\Carbon::parse($item->multimedia_caduca)->format('d-m-Y') }}</span>
                      </div>
                    </div>
                  @endforeach
                </div>
          </div>
          <div class="tab-pane fade pt-3 pr-5 mr-n5 scroll ps show ps--active-y" id="kt_quick_panel_logs" role="tabpanel" style="height: 582px; overflow: hidden;">
              <div class="mb-15">
                  <h5 class="font-weight-bold mb-5">Riesgos</h5>               
                  @foreach ($riesgos as $item)                      
                  <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-5">
                    <span class="svg-icon svg-icon-warning mr-5">
                      <span class="svg-icon svg-icon-lg">
                        <i class="fas fa-exclamation-triangle"></i>                        
                      </span>
                    </span>
                    <div class="d-flex flex-column flex-grow-1 mr-2">
                      <a href="/dashboard#/comunicacion_riesgos/consultar/{{$item->id}}" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">
                        {!! \Illuminate\Support\Str::words($item->descripción_suceso, 20, '...') !!}
                      </a>
                      <span class="text-muted font-size-sm">Fecha Seguimiento/control: {{ Carbon\Carbon::parse($item->evaluacion->fecha_seguimiento_control)->format('d-m-Y') }}</span>
                    </div>
                  </div>                    
                @endforeach                  
              </div>                
          </div> 
          <div class="tab-pane fade pt-2 pr-5 mr-n5 scroll ps" id="kt_quick_panel_notifications" role="tabpanel" style="height: 582px; overflow: hidden;">
            <div class="mb-15">
              <h5 class="font-weight-bold mb-5">Globos Con Fechas caducadas</h5>               
              @foreach ($globos as $item)                      
              <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-5">
                <span class="svg-icon svg-icon-warning mr-5">
                  <span class="svg-icon svg-icon-lg">
                    <i class="fas fa-exclamation-triangle"></i>                        
                  </span>
                </span>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="/dashboard#/globos/consultar/{{$item->id}}" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">
                    {!! \Illuminate\Support\Str::words($item->nombre, 20, '...') !!}
                  </a>
                  <span class="text-muted font-size-sm">Fecha ARC: {{ Carbon\Carbon::parse($item->arc)->format('d-m-Y') }}</span>
                </div>
              </div>                    
            @endforeach
          </div>
        </div>
        <div class="tab-pane fade pt-3 pr-5 mr-n5 scroll ps" id="kt_quick_panel_settings" role="tabpanel" style="height: 582px; overflow: hidden;">
          <div class="mb-15">
            <h5 class="font-weight-bold mb-5">Pilotos Con Fechas caducadas</h5>               
            @foreach ($pilotos_fechas_caducadas as $item)                      
              <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-5">
                <span class="svg-icon svg-icon-warning mr-5">
                  <span class="svg-icon svg-icon-lg">
                    <i class="fas fa-exclamation-triangle"></i>                        
                  </span>
                </span>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <a href="/dashboard#/pilotos/consultar/{{$item->id}}" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">
                    {!! \Illuminate\Support\Str::words($item->FullName, 20, '...') !!}
                  </a>
                  <span class="text-muted font-size-sm"> Piloto Posee alguna fecha caducada</span>
                </div>
              </div>                
            @endforeach
          </div>
      </div>
    </div>
  </div>
    <!--end::Content-->
</div>
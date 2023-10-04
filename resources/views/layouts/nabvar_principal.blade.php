 <!--================ Header Menu Area start =================-->
  <header class="header_area bg-white">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <a class="navbar-brand logo_h" href="{{ url('/') }}"><img src="{{ asset('images/plataforma/logo.png')}}" alt="" style="width: 200px"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-end p-3">

              <li class="nav-item pb-3">
                <a class="button button-outline button-small button_nav button_navbar" href="{{ url('/') }}">Inicio</a>
              </li> 
              <li class="nav-item pb-3">
                <a class="button button-outline button-small button_nav button_navbar" href="{{ url('/step-by-step') }}">Plataforma Step by Step</a>
              </li> 
              <li class="nav-item pb-3">
                <a class="button button-outline button-small button_nav button_navbar" href="{{ url('/sobre-nosotros') }}">Sobre nosotros</a>
              </li> 
              <li class="nav-item pb-3">
                <a class="button button-outline button-small button_nav button_navbar" href="{{ url('/contacto') }}">Contacto</a>
              </li> 
              <li class="nav-item pb-3">
                @if(auth()->check())
                  <a href="{{ url('/dashboard') }}" class="button button-outline button-small button_nav button_navbar"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                @else
                  <a href="#"  v-b-modal.modal-1 class="button button-outline button-small button_nav button_navbar"><i class="fa fa-user"></i> Iniciar Sesión</a>
                @endif
              </li> 

            </ul>

          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->

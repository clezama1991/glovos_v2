@extends('layouts.app_login')

@section('content')

	<login instrucciones_login="{{encontrar_configuracion('instrucciones_login')}}" logo_login="{{encontrar_configuracion('logo_plataforma')}}" enable_google_login="{{encontrar_configuracion('enable_google_login')}}"> </login>

@endsection

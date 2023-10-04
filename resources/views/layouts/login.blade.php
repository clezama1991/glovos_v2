<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Soysepanka') }}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.ico') }}"/>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}"></script>

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/60bfba9e65b7290ac634db91/1f7mf1vbv';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
  <!--End of Tawk.to Script-->
</head>
<body>
  <div class="bg d-flex justify-content-center align-items-center">
    @yield('content')
  </div>
</body>
@yield('scripts')
</html>

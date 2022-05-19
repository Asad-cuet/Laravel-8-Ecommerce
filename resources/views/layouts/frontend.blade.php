<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
    <!-- Styles -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/owl/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/owl/owl.theme.default.min.css')}}">
   <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">    
   <!-- font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">


</head>
<body>

@include('layouts.front_inc.front_navbar')


<div class="content">
  @yield('content')
</div>






  <!--   Custome JS Files   -->
  <script src="{{asset('js/custom.js')}}"></script>
    <!--   Checkout JS Files   -->
  <script src="{{asset('js/checkout.js')}}"></script>
  <!--   Bootstrap JS Files   -->
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>  
  <!--   owl JS Files   -->
  <script src="{{asset('frontend/owl/owl.carousel.min.js')}}"></script>
  <!--   Sweet alert JS Files   -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  @if(session('status'))
        <script>
         swal("{{ session('status') }}");
        </script>    
  @endif   
  @yield('scripts')
 

     
</body>
</html>

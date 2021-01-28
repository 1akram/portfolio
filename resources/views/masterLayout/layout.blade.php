<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($setting!=null){{ $setting->siteTitle }} |@endif @yield('pageTitle')</title>
    <meta name="keywords" content="@if($setting!=null){{$setting->keyWord}}@endif">
    <meta name="author" content="Akram Ayeb">
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    @yield("head")  
</head>

<body>
 
 
 
 <!-- body -->
 

    @yield('content')

 


    <!-- include js  -->
    <div>
    
        <script src="{{asset('js/jquery3.5.1.min.js')}}"></script>
        @yield("extr") 
     
    </div>
</body>
<!-- end body -->

</html>
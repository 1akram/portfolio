<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($setting!=null){{ $setting->siteTitle }} |@endif @yield('pageTitle')</title>
    <meta name="keywords" content="@if($setting!=null){{$setting->keyWord}}@endif">
    <link rel="icon" type="image/png" href="@if($setting!=null){{asset(Storage::url($setting->logo))}}@endif" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    @yield("head")  

    <!-- 
        Name: portfoil-io
        URI: https://dz-themes.com/
        Author: dz-themes
        Author URI: https://dz-themes.com/
        Version: 1.0.0
        Last Update:19/04/2021 
    -->

</head>

<body>
 
 
 
 {{-- <!-- body --> --}}
 

    @yield('content')

 


    {{-- <!-- include js  --> --}}
    <div>
    
        <script src="{{asset('js/jquery3.5.1.min.js')}}"></script>
        @yield("extr") 
     
    </div>
</body>
{{-- <!-- end body --> --}}

</html>
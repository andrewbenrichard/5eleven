<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="My Empire Homes Handymen">
    <meta name="keywords" content="My Empire Homes Handymen">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">  

    <meta name="author" content="My Empire Homes">
    @if(strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false)


    @include('layouts.dev.back_header')
    
  
    @else
    @include('layouts.dev.front_header')
    
      @endif
   
</head>
<body>
    <div id="app" class="page-wrapper">
      
        {{-- <div id="ht-preloader">
          <div class="loader clear-loader"> <img class="img-fluid" src="assets/images/loader.gif" alt=""> </div>
        </div> --}}
        
            @yield('content')
            
    </div>

    @if(strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false)


    @include('layouts.dev.back_extras')
    
  
    @else
    
    @include('layouts.dev.front_extras')
      @endif
   
      
</body>
</html>

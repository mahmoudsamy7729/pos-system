<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/libs/fontawesome-icons.css')}}"> 
    @if (Config::get('app.locale')   == 'en')
        <link rel="stylesheet" href="{{asset('assets/css/dashlite.css')}}">
    @elseif(Config::get('app.locale')  == 'ar')
        <link rel="stylesheet" href="{{asset('assets/css/dashlite.rtl.css')}}">
    @endif
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/css/theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
    
    
    @yield('css-files')
    @livewireStyles
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            @livewire('offline-modal')
            @yield('content')
            
        </div>
        <!-- main @e -->
    </div>
    

    <script src="{{asset('assets/js/bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/charts/chart-hotel.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.js')}}"></script>
    @yield('js-files')
    
    @livewireScripts
</body>

</html>
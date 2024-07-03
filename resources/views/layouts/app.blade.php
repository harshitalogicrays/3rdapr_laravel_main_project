<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="{{asset('exzoom/jquery.exzoom.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>

   @livewireStyles
</head>
<body>
    <div id="app">
        @include('frontend.includes.fnavbar',['categories'=>App\Models\Admin\Category::where('status','0')->get()])
        <main>
            @yield('content')
        </main>
    </div>

    @livewireScripts

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
        <script src="{{asset('exzoom/jquery.exzoom.js')}}"></script>
   <script src="{{asset('js/bootstrap.js')}}"></script>

   <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
   @stack('zoomscript')
   @stack('paypalscript')
   <script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('message', (event) => {
        // console.log(event[0])
        alertify.set('notifier','position', 'top-left');
        alertify.notify(event[0].text, event[0].type, 2);
       });
    });
   </script>
</body>
</html>

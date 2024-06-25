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

      <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('Admin/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('Admin/vendors/base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('Admin/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('Admin/images/favicon.png')}}" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   @livewireStyles
</head>
<body>
    <div class="container-scroller">
          @include('admin.includes.navbar')
        <div class="container-fluid page-body-wrapper">
          @include('admin.includes.sidebar')
          <div class="main-panel">
            <main class="py-4 m-2">
              @yield('content')
          </main>
            @include('admin.includes.footer')
          </div>
        </div>
      </div>

    @livewireScripts
    
    <!-- Scripts -->
    <!-- plugins:js -->
  <script src="{{asset('Admin/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('Admin/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('Admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('Admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('Admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('Admin/js/template.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('Admin/js/dashboard.js')}}"></script>
  <script src="{{asset('Admin/js/data-table.js')}}"></script>
  <script src="{{asset('Admin/js/jquery.dataTables.js')}}"></script>
  <script src="{{asset('Admin/js/dataTables.bootstrap4.js')}}"></script>
  <!-- End custom js for this page-->

  <script src="{{asset('Admin/js/jquery.cookie.js')}}" type="text/javascript"></script>

</body>
</html>

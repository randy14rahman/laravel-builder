<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">

{{-- Title --}}
<title>
    @yield('title_prefix', '')
    @yield('title', 'SIAKSI')
    @yield('title_postfix', '')
</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="/assets/plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">
@section("stylesheets")
@show
<!-- Custom styles for this template -->
<link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">
    
    @include('layouts.partials.header')
    @include('layouts.partials.sidebar')

    <main class="content-wrapper">
      {{-- Content Header --}}
      @hasSection('content_header')
          <div class="content-header">
              <div class="container-fluid">
                  <h1 class="m-0">@yield('content_header')</h1>
              </div>
          </div>
      @endif

      {{-- Main Content --}}
      <div class="content">
          <div class="container-fluid">
              @yield('content')
          </div>
      </div>
    </main>
    <!-- /.content-wrapper -->
  </div>

<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="/assets/plugins/toastr/toastr.min.js"></script>
@section("scripts")
@show
<script src="/assets/adminlte/dist/js/adminlte.min.js?v=3.2.0"></script>
  </body>
</html>
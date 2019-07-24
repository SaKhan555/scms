<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SCMS - @yield('title')</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custome.css') }}" rel="stylesheet">
    <!-- Select2 Stylesheets -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top">
    <!-- Navbar / Header -->
    @include('template.partials.header')
    <div id="wrapper">
        <!-- Sidebar -->
        @include('template.partials.sidebar')
        <div id="content-wrapper">
            <div class="container-fluid">
             <div id="success_msg" style="display: none;">
                 
             </div>
        @if (session('status'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('status') }}
            </div>
        @endif
            @yield('content')
          <div class="container">
             <div id="errors">
                 
             </div>
          @if($errors->all())
          <ul class="text-danger bg-light">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif
      </div>
            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            @include('template.partials.footer')
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
    <!-- master Modal-->

    @include('template.partials.modal')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin.min.js') }}"></script>
    <!-- Demo scripts for this page-->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('template/js/demo/chart-area-demo.js') }}"></script>
<!-- Select2 JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Master Javascript -->
<script src="{{ asset('js/master/master.js') }}" type="text/javascript" charset="utf-8" async defer></script>
<!-- Master Javascript -->

<!--Modul scripts-->
    <!--Modul scripts-->
<script>
$(document).ready(function() {
    $('.select2me').select2();
});
    </script>
        @yield('script')
</body>
</html>

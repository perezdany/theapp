
<!doctype html>
<html lang="en">
  <!--begin::Head-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The App</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
      <!--begin::Header-->
      @include('layouts.components.header')
      <!--end::Header-->
      <!--begin::Sidebar-->
      @include('layouts.components.menu')
        
      <!--begin::App Wrapper-->
      <div class="content-wrapper">
    
        <!--end::Sidebar-->
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success col-md-12">
                      {{session('success')}}
                    </div>
                  @endif

                  @if(isset($success))
                    <div class="alert alert-success col-md-12">
                      {{$success}}
                    </div>
                  @endif

                  @if(session('warn'))
                    <div class="alert alert-warning col-md-12">
                      {{session('warn')}}
                    </div>
                  @endif

                  @if(session('error'))
                    <div class="alert alert-danger col-md-12">
                      {{session('error')}}
                    </div>
                  @endif
              </div>
            </div>
              @yield('content')
          </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
        
      </div>
      
      <!--begin::Footer-->
        <footer class="main-footer">
          <!--begin::To the end-->
          <div class="float-right d-none d-sm-inline-block">Version 1.0</div>
          <!--end::To the end-->
          <!--begin::Copyright-->
          <strong>
            Copyright &copy; 2025 &nbsp;
          
          </strong>
  
          <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
  <!-- REQUIRED SCRIPTS -->

  <!--  Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>

  <!--ion icon-->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!--full calendar-->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <!--<script src="dist/js/demo.js"></script>-->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!--<script src="dist/js/pages/dashboard2.js"></script>-->
</body>
<!--end::Body-->
</html>

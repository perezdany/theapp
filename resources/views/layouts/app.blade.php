
<!doctype html>
<html lang="fr">
  <!--begin::Head-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The App</title>
  <meta name="_token" content="{!! csrf_token() !!}" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <!--full calendar-->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
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

                   @if(isset($error))
                    <div class="alert alert-danger col-md-12">
                      {{$error}}
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
  <!--<script src="plugins/chart.js/Chart.min.js"></script>-->

                    
  <!--moment js-->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/moment/locale/fr.js"></script>

  <!--ion icon-->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <!--<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>-->

  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <!-- AdminLTE for demo purposes -->
  <!--<script src="dist/js/demo.js"></script>-->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!--<script src="dist/js/pages/dashboard2.js"></script>-->
</body>
<!--end::Body-->
</html>

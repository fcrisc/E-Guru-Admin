<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   {{-- <!-- App - CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- App - Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script> --}}

  <title>E-Guru | Admin</title>

  <!-- Tab icon -->
  <link rel="shortcut icon" href="{{asset('dist/img/logo/e-guru-icon-bar.ico')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light navbar-white ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/home" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/profile" class="nav-link">Profile</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-power-off"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('Logout') }}
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>
        </div>
       </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary  elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link bg-light">
      <img src="{{asset('/dist/img/logo/e-guru-icon.png')}}" alt="E-Guru Logo" class="brand-image img-circle ">
      <span class="brand-text font-weight-normal" style="color:rgb(0, 0, 0)"><small><b>EGURU MANAGEMENT</b></small></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @if(Auth::user()->avatar)
          <img src="{{asset('/storage/image/'. Auth::user()->avatar)}}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{asset('/storage/image/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
            @endif
        </div>
        <div class="info">
          <a href="/home" class="d-block">{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
        <a href="/home" class="nav-link">
            <i class="fas fa-chart-pie nav-icon"></i>
            <p>
                Dashboard
            </p>
        </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
              <p>
                User management
                <i class="fas fa-angle-left right">

                </i>
                <span class="right badge badge-primary" >10</span>
              </p>

        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
                <a href="/roles" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                  <p>
                    Roles
                  </p>
                </a>
            </li>
          <li class="nav-item">
            <a href="/users" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/teachers" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>
                Teachers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/students" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>
                Students
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/courses" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>
                Subject
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/batches" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>
                Years
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/days" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>
                Days
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/class_rooms" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>
                Classrooms
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/semesters" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>
                Levels
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/classes" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
              <p>
                Classroom Venue
              </p>
            </a>
          </li>
        </ul>
        </li>

        <li class="nav-item">
            <a href="/class_rooms" class="nav-link">
                <i class="fas fa-chalkboard nav-icon"></i>
                <p>
                    Manage Classroom
                </p>
            </a>
            </li>

        {{-- <li class="nav-item">
            <a href="/students" class="nav-link">
                <i class="fas fa-qrcode nav-icon"></i>
                <p>
                    QR Code <span class="right badge badge-danger">Ongoing</span>
                </p>
            </a>
            </li> --}}

            <li class="nav-item">
                <a href="/class_rooms" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>
                        Manage Attendance
                    </p>
                </a>
                </li>

            <li class="nav-item">
                    <a href="/timetables" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Teacher Schedule
                        </p>
                    </a>
                </li>
            {{-- <li class="nav-item">
                <a href="/all-notifications" class="nav-link">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>
                        Post Announcement
                    </p>
                </a>
            </li> --}}

            <li class="nav-item">
                <a href="https://app.onesignal.com/apps/4df855c4-7e77-4558-8083-658361606d31#outcomes=os__click__count" target="_blank" class="nav-link">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>
                        Announcement <span class="right badge badge-info" bg-sm>One Signal</span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/complaints" class="nav-link">
                    <i class="nav-icon far fa-comments"></i>
                    <p>
                        User Feedback
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/acknowledgements" class="nav-link">
                    <i class="nav-icon fas fa-user-check"></i>
                    <p>
                        Acknowledgement
                    </p>
                </a>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer ">
    <p style="text-align:center; color:rgb(0, 0, 0)"><strong>FYP Project 2020</strong></p>

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./jsApp -->
<script src="{{ asset('js/app.js') }}" defer></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
<!-- Page specific script -->
<!-- AdminLTE App -->
{{-- <script src="{{asset('dist/js/adminlte.min.js')}}"></script> --}}
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print"]
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

        //Date range picker
        $('#reservationdate').datetimepicker({
        format: 'L'
    });



  </script>
</body>
</html>

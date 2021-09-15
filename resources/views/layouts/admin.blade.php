<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if(session('level')<2)
            پنل مدیریت
        @else
            پنل کاربری
        @endif
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap-rtl.min.css')}}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{asset('dist/css/custom-style.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap4.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <link rel="stylesheet" href="{{asset('dist/css/persian-datepicker.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>

    <link rel="stylesheet" href="{{asset('plugins/select2theme/bootstrap.select2.css')}}">

    <link rel="icon" type="image/png" href="{{asset('loginAsset/images/icons/favicon.ico')}}"/>
    <link rel="stylesheet" href="{{asset('plugins/newdatatable/datatables.css')}}">


    <style>
        .paging {
            float: left;
        }

        .table td {
            border-top: 0 !important;
        }

        #some-textarea {
            border: 1px solid #ced4da;
            border-radius: 3px;
            outline: none;
        }

        #some-textarea:focus {
            border: 2px solid #c1c4c7;
            border-radius: 3px;
            outline: none;
        }

        .some-textarea {
            border: 1px solid #ced4da;
            border-radius: 3px;
            outline: none;
        }

        .some-textarea:focus {
            border: 2px solid #c1c4c7;
            border-radius: 3px;
            outline: none;
        }

        .inike-mojtabagoft {
            font-weight: bold;
            line-height: 33px;
        }

        .edit {
            color: #ff8f00;
        }

        .look {
            color: #43a047;
        }

        .file-in {
            background: #eaeaea;
            padding: 4px;

        }

        .action-up {
            position: relative;
            top: 7px;
            color: #fffcf7;
            padding: 5px;
            background: #d48534;
            border-radius: 5px;
            box-shadow: -8px 6px 10px 1px rgba(212, 133, 52, 0.31);
            cursor: pointer;
        }

        .bootstrap-wysihtml5-insert-image-modal .modal-dialog {
            z-index: 3002 !important;
        }

        .modal-backdrop {
            z-index: 3001 !important;
        }

        .modal {
            top: 60px;
        }

        .modal-backdrop {
            display: none;
        }

        .btn-group {
            padding: 10px;
        }

        .btn-group > button {
            border-radius: 5px !important;
            margin-left: 2px !important;
            font-size: 1em;
        }

        #posts_filter {
            float: left;
        }

        #posts_info {
            float: right;
        }

        #posts_paginate {
            margin: 0 3px;
            float: left;
        }

        #myTable_filter {
            float: left;
            display: inline-block;
            padding: 10px;
        }

        #myTable_wrapper {
            overflow: hidden;
        }

        #akbari {
            position: fixed;
            background: white;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            z-index: 9999999;
        }

        #preloader {
            z-index: 100000;
            position: relative !important;
            transform: translate(48%, 68%);
            top: 350px;
        }

        #preloader span {
            display: block;
            bottom: 0px;
            width: 9px;
            height: 5px;
            background: #9b59b6;
            position: absolute;
            animation: preloader 1.5s infinite ease-in-out;
        }

        #preloader span:nth-child(2) {
            left: 11px;
            animation-delay: .2s;

        }

        #preloader span:nth-child(3) {
            left: 22px;
            animation-delay: .4s;
        }

        #preloader span:nth-child(4) {
            left: 33px;
            animation-delay: .6s;
        }

        #preloader span:nth-child(5) {
            left: 44px;
            animation-delay: .8s;
        }

        @keyframes preloader {
            0% {
                height: 5px;
                transform: translateY(0px);
                background: #9b59b6;
            }
            25% {
                height: 30px;
                transform: translateY(15px);
                background: #3498db;
            }
            50% {
                height: 5px;
                transform: translateY(0px);
                background: #9b59b6;
            }
            100% {
                height: 5px;
                transform: translateY(0px);
                background: #9b59b6;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div id="akbari">
    <div id="preloader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('panel')}}" class="nav-link">خانه</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->

                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">

                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->

                        <!-- Message End -->
                    </a>

                </div>
            </li>
            <!-- Notifications Dropdown Menu -->

        </ul>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit" class="text-left" style="background:#f1f1f16b;border:0;cursor: pointer;">
              <span>
                    خروج
              </span>
                <i class="fa fa-sign-out" aria-hidden="true"></i>

            </button>

        </form>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('panel')}}" class="brand-link">
            <img src="{{asset('dist/img/logo.jpeg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">
                        @if(session('level')<2)
                    پنل مدیریت
                @else
                    پنل کاربری
                @endif
            </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr">
            <div style="direction: rtl">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('dist/img/avatar3.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            {{auth()->user()->name}}

                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class=" nav-icon fa fa-th"></i>
                                <p>
                                    تغییر دوره پنج ساله
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('panel.plan',3)}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دوره اول </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('panel.plan',2)}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دوره دوم</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('panel.plan',1)}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دوره سوم</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('panel.plan',4)}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دوره چهارم</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('panel')}}" class="nav-link ">
                                <i class="nav-icon fa fa-dashboard "></i>
                                <p>داشبورد </p>
                            </a>
                        </li>

                        {{--                        <li class="nav-item has-treeview">--}}
                        {{--                            <a href="#" class="nav-link">--}}
                        {{--                                <i class="nav-icon fa fa-tree"></i>--}}
                        {{--                                <p>--}}
                        {{--                                    مدیریت برنامه ها--}}
                        {{--                                    <i class="fa fa-angle-left right"></i>--}}
                        {{--                                </p>--}}
                        {{--                            </a>--}}
                        {{--                            <ul class="nav nav-treeview">--}}


                        <li class="nav-item">
                            <a href="{{route('goal.index')}}" class="nav-link">
                                <i class="fa fa-bullseye nav-icon"></i>
                                <p>هدف ها</p>
                            </a>
                        </li>
                        @if(session('level')<2)
                            <li class="nav-item">
                                <a href="{{route('category.index')}}" class="nav-link">
                                    <i class="fa fa-superpowers nav-icon"></i>
                                    <p>طبقه ها</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{route('strategy.index')}}" class="nav-link">
                                <i class="fa fa-adjust nav-icon"></i>
                                <p>راهبرد ها</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('program.index')}}" class="nav-link">
                                <i class="fa fa-book nav-icon"></i>
                                <p>برنامه ها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('action.index')}}" class="nav-link">
                                <i class="fa fa-check-square-o nav-icon"></i>
                                <p>اقدامات</p>
                            </a>
                        </li>
                        @if(session('level')!=4)

                            <li class="nav-item">
                                <a href="{{route('submit.index')}}" class="nav-link">
                                    <i class="nav-icon fa  fa-exclamation"></i>
                                    <p>تاییدیه</p>
                                </a>
                            </li>
                        @endif
                        @if(session('level')==1)
                            <li class="nav-item">
                                <a href="{{route('report.index')}}" class="nav-link">
                                    <i class="nav-icon fa fa-pie-chart"></i>
                                    <p>گزارشات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('total.report')}}" class="nav-link">
                                    <i class="nav-icon fa fa-pie-chart"></i>
                                    <p>گزارش سالانه </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('user.index')}}" class="nav-link">
                                    <i class="nav-icon fa fa-user-circle"></i>
                                    <p>کاربران</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('problemType.index')}}" class="nav-link">
                                    <i class="nav-icon fa fa-gittip"></i>
                                    <p>نوع موانع </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('settings')}}" class="nav-link">
                                    <i class="nav-icon fa fa-wrench"></i>
                                    <p>تنظیمات </p>
                                </a>
                            </li>



                        @endif

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @yield('crump')

            <div class="container-fluid">

                <section class="content">

                    <!-- Default box -->
                    <div class="card animate__animated animate__zoomInDown">

                    @yield('top_main')
                    <!-- /.card-body -->

                        <!-- /.card-footer-->
                    </div>
                    <div class="card animate__animated animate__zoomInDown">

                    @yield('main')
                    <!-- /.card-body -->

                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->

                </section>

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong> توسعه و طراحی توسط <a href="https://daneshjooyar.com">دانشجویار</a>.</strong>
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('dist/js/persian-date.min.js')}}"></script>
<script src="{{asset('dist/js/persian-datepicker.min.js')}}"></script>
<script src="{{asset('plugins/swalert/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>
<script>
    $('a').tooltip()
</script>
@yield('script')

{{--    jgh uploader--}}
<script src="{{asset('plugins/jgh-uploader/uploader.min.js')}}"></script>
<script>
    $(document).ready(function () {

        $('#preloader').remove();
        $('#akbari').css('display', 'none');
    });

</script>
</body>
</html>

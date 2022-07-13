<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/AdminLTE/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/AdminLTE/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/AdminLTE/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Datetime picker -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/AdminLTE/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
    <!-- Toastr v4.0.2 -->
    <link rel="stylesheet" href="{{ asset('backend/lib/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/ToastrAwesome.css') }}">
    <!-- Datatables-->
    <link rel="stylesheet" href="{{ asset('backend/lib/DataTables/datatables.min.css') }}">
    <!-- Datatables Checkboxes 1.2.11 -->
    <link rel="stylesheet" href="{{ asset('backend/lib/DatatablesCheckboxes/css/dataTables.checkboxes.css') }}">
    <!-- Datatables rowgroup-->
    <link rel="stylesheet" href="{{ asset('backend/lib/DataTables/RowGroup-1.1.1/css/rowGroup.dataTables.css') }}">


    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/AdminLTE/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/AdminLTE/dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div id="dashboard-app">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">{{ config('app.name') }}</b></span>
                </a>
                <!-- End Logo -->
                @include('layouts.backend.navbar')
            </header>
            @include('layouts.backend.sidebar')

            <main class="py-4">
                @yield('content')

                <footer class="main-footer">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> 2.4.0
                    </div>
                    <strong>Copyright &copy; 2018-2019 <a
                            href="https://soccertipstar.com/terms">{{ config('app.name') }}</a>.</strong> All rights
                    reserved.
                </footer>
            </main>
        </div>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery 3 -->
<script src="{{ asset('backend/AdminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('backend/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/AdminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('backend/AdminLTE/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('backend/AdminLTE/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('backend/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('backend/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/AdminLTE/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('backend/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!--datetimepicker-->
<script
    src="{{ asset('backend/AdminLTE/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}">
</script>
<!-- datepicker -->
<script src="{{ asset('backend/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
</script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('backend/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('backend/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('backend/AdminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/AdminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- Jquery Validate plugin-->
<script src="{{ asset('backend/lib/validate/jquery.validate.js') }}"></script>
<!-- Toastr v4.0.2 -->
<script src="{{ asset('backend/lib/toastr/toastr.min.js') }}"></script>
<!-- Datatables-->
<script src="{{ asset('backend/lib/DataTables/datatables.min.js') }}"></script>
<!-- Datatables Checkboxes 1.2.11 -->
<script src="{{ asset('backend/lib/DatatablesCheckboxes/js/dataTables.checkboxes.min.js') }}"></script>
<!-- Datatables rowgroup-->
<script src="{{ asset('backend/lib/DataTables/RowGroup-1.1.1/js/dataTables.rowGroup.min.js') }}"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    (function (document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function () {

            /* Toastr messages */
            toastr.options.closeButton = true;
            toastr.options.timeOut = 5000;
            @if(session()->has('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session()->has('error'))
                toastr.error("{{ session('error') }}");
            @endif
            @if(session()->has('info'))
                toastr.info("{{ session('info') }}");
            @endif
        });
    })(document, window, jQuery);

</script>

@yield('javascript')

</html>

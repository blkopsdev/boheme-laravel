<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
    {{-- <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" /> --}}
    <link href="{{ asset('assets/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.minicolors.css') }}">
    <link href="{{asset('assets/css/gijgo.min.css')}}" rel="stylesheet" type="text/css" />
    @yield('page-css')
    @if (auth()->check() && auth()->user()->company_id)
    @include('components.dynamic_css')
    @endif
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.page_templates.auth')
        @endauth
        @guest()
            @include('layouts.page_templates.guest')
        @endguest
        <div id="loader"></div>
        <!--   Core JS Files   -->
        <script src="{{ asset('material/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('assets/js/bootstrap4-toggle.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
        <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Plugin for the momentJs  -->
        <script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
        
        <script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
        
        <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        {{-- <script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script> --}}
       
        <script src="{{ asset('assets/js/core.js') }}"></script>

        <!--  Notifications Plugin    -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
        <script src="{{ asset('assets/js/gijgo.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('material/js/plugins/fullcalendar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
        <script src="{{ asset('assets/js/jquery.minicolors.min.js')}}"></script>
        <script src="{{ asset('material') }}/demo/demo.js"></script>
        <script src="{{ asset('material') }}/js/settings.js"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script>
            var toastr_options = {closeButton : true};
            var spinner = $('#loader');
        </script>
        @stack('js')
    </body>
</html>
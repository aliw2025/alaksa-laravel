<!doctype html>
<html lang="en">

<head>
    <title>Alpha Digital</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/vendors/css/vendors.min.css') }}">
    <!-- added for calender -->
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/pages/app-calendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/vendors/css/calendars/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/themes/semi-dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/pages/dashboard-ecommerce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/plugins/charts/chart-apex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/plugins/extensions/ext-component-toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/style.css') }}">
    

   
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  

    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/plugins/forms/form-validation.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">
        @if(Auth::user())
            @include('template.main-header')
            @include('template.sidebar')
        @endif
    

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @yield('section')
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('template.footer')

</body>

</html>
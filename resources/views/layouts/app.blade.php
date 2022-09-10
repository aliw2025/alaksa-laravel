<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
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
    <link rel="stylesheet" type="text/css"
        href="{{ url('/resources/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/pages/dashboard-ecommerce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/plugins/charts/chart-apex.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/resources/css/plugins/extensions/ext-component-toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/resources/css/style.css') }}">
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">       
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a   class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a   id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"  aria-expanded="true" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item " 
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<script src="{{ url('/resources/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ url('/resources/vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ url('/resources/vendors/js/extensions/toastr.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ url('/resources/js/core/app-menu.min.js') }}"></script>
<script src="{{ url('/resources/js/core/app.min.js') }}"></script>
<script src="{{ url('/resources/js/scripts/customizer.min.js') }}"></script>
<script src="{{ url('/resources/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ url('/resources/vendors/js/calendar/fullcalendar.min.js') }}"></script>
<script src="{{ url('/resources/js/scripts/pages/app-calendar-events.min.js') }}"></script>
<script src="{{ url('/resources/js/scripts/pages/app-calendar.min.js') }}"></script>
<script src="{{ url('/resources/vendors/js/forms/select/select2.full.min.js') }}"></script>

<script src="{{ url('/resources/js/custom-js.js') }}"></script>

</html>

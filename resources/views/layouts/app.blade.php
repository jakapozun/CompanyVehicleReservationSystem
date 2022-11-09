<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery/dist/jquery.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md shadow-sm bg-white navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('vehicle.index') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ app()->getLocale() }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <form action="">
                                <a class="dropdown-item" href="/locale/sl">Sl</a>
                                <a class="dropdown-item" href="/locale/en">En</a>
                            </form>
                        </div>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('view-roles','view-users')
                                    <a class="dropdown-item"
                                       href="{{ route('admin.users.index') }}">@lang('global.allUsers')</a>
                                    <a class="dropdown-item"
                                       href="{{ route('admin.roles.index') }}">@lang('global.allRoles')</a>
                                @endcan
                                @can('edit-reservations')
                                    <a class="dropdown-item"
                                       href="{{ route('admin.reservations.index') }}">@lang('global.allRes')</a>
                                @endcan
                                @can('create-vehicles','edit-vehicles')
                                    <a class="dropdown-item"
                                       href="{{ route('admin.vehicles.index') }}">@lang('global.allVeh')</a>
                                @endcan
                                @can('edit-reservations')
                                    <a class="dropdown-item"
                                       href="{{ route('admin.notes.index') }}">@lang('global.allNotes')</a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    @lang('auth.logout')
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
<script src="{{ asset('js/app.js') }}" defer></script>
<script>
    $(document).ready(function () {
        $(function () {
            $('.alert').delay(1000).fadeOut(1000);
        });

        let $searchButton = $("button#ok");
        let $pickupDate = $("input#pickup_date");
        let $dropoffDate = $("input#dropoff_date");



        $("#resetForm").click(function () {
            $pickupDate.val('');
            $dropoffDate.val('');

            checkSearchButtonAvailability();
        })

        checkSearchButtonAvailability();

        $pickupDate.on('change', function () {
            checkSearchButtonAvailability();
        });

        $dropoffDate.on('change', function () {
            checkSearchButtonAvailability();
        });

        function checkSearchButtonAvailability() {
            if (!$pickupDate.val()) {
                $searchButton.attr('disabled', true);
            }

            if (!$dropoffDate.val()) {
                $searchButton.attr('disabled', true);
            }

            if ($pickupDate.val() && $dropoffDate.val()) {
                $searchButton.attr('disabled', false);
            }
        }
    });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn4S-pSxkRdgC4wTYx6xoevWmv6m9lQ80&libraries=places"></script>
</body>
</html>

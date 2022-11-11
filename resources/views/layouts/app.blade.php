<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>SOMS</title>

    <!-- Logo -->
    <link rel="icon" href="\img\neust-logo.png" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src="\img\neust-logo.png" alt="NEUST-MGT Logo" height="30" width="30" style="margin-right: 10px" />
                <a class="navbar-brand" href="{{ url('/') }}">
                    NEUST - SOMS
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if(Auth::check()) @if(auth()->user()->type ==
                        'Student')
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('student.dashboard')) active @endif"
                                href="{{ route('student.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('student.feed')) active @endif"
                                href="{{ route('student.feed') }}">Feed</a>
                        </li>
                        @endif @if(auth()->user()->type == 'Organization')
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('organization.dashboard')) active @endif"
                                href="{{ route('organization.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('organization.organization')) active @endif" href="{{
                                        route('organization.organization')
                                    }}">Organization</a>
                        </li>
                        @endif @if(auth()->user()->type == 'Administrator')
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('administrator.dashboard')) active @endif" href="{{
                                        route('administrator.dashboard')
                                    }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('administrator.organizationsTab')) active @endif" href="{{
                                        route('administrator.organizationsTab')
                                    }}">Organizations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('administrator.studentsTab')) active @endif" href="{{
                                        route('administrator.studentsTab')
                                    }}">Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('administrator.administratorsTab')) active @endif" href="{{
                                        route('administrator.administratorsTab')
                                    }}">Administrators</a>
                        </li>
                        @endif @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest @if (Route::is('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __("Login") }}</a>
                        </li>
                        @endif @if (Route::is('login') || request()->is('/')
                        )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __("Register") }}</a>
                        </li>
                        @endif @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    {{ __("Profile") }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __("Logout") }}
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

        <main class="py-4">@yield('content')</main>
    </div>
</body>

</html>
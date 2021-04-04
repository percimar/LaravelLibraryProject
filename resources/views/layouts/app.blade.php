<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'La Biblioteca') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/86aec59525d1d04b53f54ad95ff3f6bf?family=Hold" rel="stylesheet" type="text/css" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/book.css') }}" rel="stylesheet"> -->
</head>

<body class="bannerbackground">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">


                <a class="text-decoration-none" href="{{ url('/') }}">
                    <img src="{{ asset('img/labiblio-logo.png') }}" height="50" width="30" />
                    <img src="{{ asset('img/labiblio.png') }}" height="60" width="200" />
                    <img src="{{ asset('img/labiblio-logo.png') }}" height="50" width="30" />
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        <a class="dropdown-item" href="{{ route('contacts.create') }}">
                            Contact
                        </a>
                        @endguest
                        @role('member')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('userBorrowed') }}">Your Books</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('returnedBooks') }}">Returned History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contacts.index') }}">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('request.create') }}">Request a Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wishlist.index') }}">Wishlist</a>
                        </li>
                        @endrole
                        @role('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contacts.index') }}">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.create') }}">Add Books</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservations.index') }}">Manage Reservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('returnedBooks') }}">Returned History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('request.index') }}">Requested Books</a>
                        </li>
                        @endrole
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('reservations.index') }}">
                                    Book Reservations
                                </a>
                                <a class="dropdown-item" href="{{ route('rooms.index') }}">
                                    Book a Room
                                </a>
                                <a class="dropdown-item" href="{{ route('bookings.index') }}">
                                    Your Bookings
                                </a>
                                <a class="dropdown-item" href="{{ route('contacts.create') }}">
                                    Contact
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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
            @include('layouts.alerts')

            @yield('content')
        </main>
    </div>
    @include('layouts.footer')

    @yield('scripts')
</body>

</html>
<!DOCTYPE html>
<html lang="en">
    <!--

            Web Development Team Project
            Authors: Emma Middleton, Joshua Knutson, Mobin Syed, Johan Elder
            Date: April 11, 2022

    -->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sauce Financial</title>
        <link rel="stylesheet" href={{ asset('css/app.css') }}>
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light yellow">
            <div class="container-fluid">
                <a class="navbar-brand mx-3" href="#">sauce</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-2 me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('/')) {{ 'active' }} @endif" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link @if (Request::is('dashboard')) {{ 'active' }} @endif" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                        @endauth
                    </ul>
                    <div class="d-flex pe-3 align-items-center">
                        @auth
                            <span class="d-inline-block me-4">{{ auth()->user()->name }}</span>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-dark me-2 px-4" role="button">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-dark yellow-text" role="button">Register</a>
                        @endguest

                        @auth
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-dark yellow-text" type="submit">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>

        <footer class="dark-section">
            <div class="container py-3">
            <p class="text-center mb-0">&copy; Sauce Financial 2022 - All Rights Reserved</p>
            </div>
        </footer>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

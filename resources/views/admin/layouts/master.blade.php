<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Home')</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/magic-input/dist/magic-input.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">


    <!-- bootstrap, JQUERY e  script-backoffice JS -->

<!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<body>
<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('img/logo-branca.png') }}" style="width: 60%;" class="logo">
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="{{ route('admin.home') }}">
                        <i class="fas fa-home"></i>
                        <span class="title">Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ouvidoria.home') }}">
                        <i class="fas fa-bullhorn"></i>
                        <span class="title">Ouvidorias</span>
                    </a>
                </li>
                @can('isAdmin', Auth::user())
                    <li>
                        <a href="{{ route('usuarios.home') }}">
                            <i class="fas fa-users-cog"></i>
                            <span class="title">Usuários</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('config.create') }}">
                            <i class="fas fa-cogs"></i>
                            <span class="title">Configurações</span>
                        </a>
                    </li>
                @endcan
                <li>
                    <a href="{{ route('logout') }}">
                        <i class="fas fa-power-off"></i>
                        <span class="title">Sair</span>
                    </a>
                </li>
            </ul>

            <!-- <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul> -->
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <!-- <span><img src="https://scontent-for1-1.xx.fbcdn.net/v/t1.0-9/69245500_2230340117092318_8648757003797135360_n.jpg?_nc_cat=110&_nc_ohc=3fQdyZtVEAQAX-r6wOV&_nc_ht=scontent-for1-1.xx&oh=ff1da2a5c2a2c31a1cb8f61c3bb7a293&oe=5EC222F4" class="rounded-circle" alt="avatar image" height="40"></span> -->
                                <span class="text-uppercase">{{ Auth::user()->nome }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
            <script src="{{ asset('js/script-admin.js') }}"></script>
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>

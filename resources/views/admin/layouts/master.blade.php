<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    
</head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><span>{{ Auth::user()->name }}</span></li>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="{{ Route('ouvidoria.home') }}">Ouvidorias Abertas</a></li>
                    <li><a href="#">Relatório</a></li>
                    <li><a href="{{ Route('logout') }}">Sair</a></li>
                </ul>
            </nav>
        </header>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <div id="content">
            @yield('content')
        </div>
    </body>
</html>
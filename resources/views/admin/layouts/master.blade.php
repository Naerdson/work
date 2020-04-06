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
                    <li><a href="#">Inicio</a></li>
                    <li><a href="{{ Route('ouvidoria.home') }}">Ouvidorias Abertas</a></li>
                    <li><a href="#">Ouvidorias Encaminhadas</a></li>
                    <li><a href="#">Relatório</a></li>
                    <li><a href="{{ Route('logout') }}">Sair</a></li>
                </ul>
            </nav>
        </header>
        <div id="content">
            @yield('content')
        </div>
    </body>
</html>
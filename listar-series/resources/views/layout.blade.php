<!doctype html>
<html lang="pt-BR ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de Cadastros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/897323dac4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
    <a class="navbar navbar-expand-lg" href="{{ route('listar_series') }}">Home</a>
    @auth
    <a href="/sair" class="text-danger">Sair</a>
    @endauth
    <!--@guest
        <a href="/entrar" >Entrar</a>
    @endguest
    -->
</nav>
@include('erros',['errors' => $errors])

    <div class="container">
        <div class="" >
            <h1>@yield('cabecalho')</h1>
        </div>

        @yield('conteudo')
    </div>
</body>
</html>


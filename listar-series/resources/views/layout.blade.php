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
<navbar class="navbar navbar-expand-lg navbar-light bg-primary mb-2 d-flex justify-content-between" >
    <a></a>
    @auth
    <a href="/sair" class="btn btn-danger">Sair</a>
    @endauth
    <!--@guest
        <a href="/entrar" >Entrar</a>
    @endguest
    -->
</navbar>

@include('erros',['errors' => $errors])
    <div class="container">
        <div class="" >
            <h6>
                @if(!empty($mensagem))
                    <div class="alert alert-success">
                        {{ $mensagem }}
                    </div>
                @endif
            </h6>
            <h1><b>@yield('cabecalho')</b></h1>
            <br>
            <br>
        </div>

        @yield('conteudo')
    </div>
</body>
</html>


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Unifametro') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <header class="auth-header">
        <div class="logo-login">
            <img src="{{ asset('img/logo-unifametro-02.png') }}" class="auth-header-logo">
        </div>
        <p class="auth-header-intro">Intranet Institucional.</p>
        <div class="img-header"></div>
    </header>
    <div class="auth-form">
        <form class="p-5" method="POST" action="{{ route('login') }}">
            @csrf
            <h3 class="mb-4">Insira seus dados:</h3>
            @if(Session::has('message') && Session::has('type'))
                <div class="alert alert-{{ Session::get('type') }} text-center">{{ Session::get('message') }}</div>
            @endif

            <!-- Usuário -->
            <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror mb-4" name="usuario" value="{{ old('usuario') }}"  autocomplete="usuario" autofocus placeholder="Usuário">
            @error('usuario')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
            @enderror

            <!-- Senha -->
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror mb-4" name="password"  autocomplete="current-password" placeholder="Senha">
            @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button class="btn btn-success btn-block my-4" type="submit" style="color:white;">{{ __('Entrar') }}</button>
        </form>
    </div>

</body>
</html>


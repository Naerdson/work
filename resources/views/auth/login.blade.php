<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet - Unifametro</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container">
        <form method="POST" action="{{ route('login') }}">
            @if(Session::has('message') && Session::has('type'))
                <div class="alert alert-{{ Session::get('type') }} text-center">{{ Session::get('message') }}</div>
            @endif
        @csrf
            <label for="">usuario</label>
            <input type="text" name="username" />
            <label for="">senha</label>
            <input type="password" name="password">
            <button type="submit">Entrar</button>
        </form>
    </div>
    
</body>
</html>
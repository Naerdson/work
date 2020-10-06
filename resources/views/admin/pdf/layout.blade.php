<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/loader.js') }}"></script>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body onload="init()">
    @include('admin.pdf._header')

    @yield('title')
    @yield('content')
    
    @stack('scripts')
</body>
</html>
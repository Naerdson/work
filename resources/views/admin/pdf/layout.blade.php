<?php
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('css\bootstrap.min.css') }}">
    <!-- <script src="{{ public_path('js\loader.js') }}"></script> -->
    
    <!-- <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <!-- <script src="http://www.gstatic.com/charts/loader.js"></script> -->
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
    <script type="text/javascript" src="http://www.gstatic.com/charts/loader.js"></script>
</body>
</html>

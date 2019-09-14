<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raport Gugus 1 Dalisodo</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="background"></div>
    <div class="wrapper">
        @yield('content')
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    
</body>
</html>
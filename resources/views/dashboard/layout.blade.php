<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ Auth()->user()->fullname }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-light bg-light navbar-expand-md">
            <a href="/" class="navbar-brand">SPSG1</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse pull-right" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active pull-right">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item active pull-right">
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-sign-out"></i>
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        @yield('dash-content')
        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
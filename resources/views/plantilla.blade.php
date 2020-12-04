<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GGEZ.io')</title>
    <style>
        .active a {
            text-decoration: none;
            color: red;
        }
    </style>
</head>

<body>

    @include('partials.nav')
    @yield('contenido')
    @yield('errorlog')

</body>

</html>
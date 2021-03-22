<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

        <title>maquetacion</title>

        @include('admin.layout.partials.styles')
    </head>

    <body>

        <div class="pantalla50">
            @yield('content')
        </div>
 
    </body>
</html>

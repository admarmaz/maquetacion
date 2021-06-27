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

        @include('admin.components.messages')
        @include('admin.components.wait')
        @include('admin.components.modal_image')
        @include('admin.components.modal_delete')
        @include('admin.layout.partials.sidebar')


        @if(isset($filters))
                @include('admin.components.table_filters', [
                    'route' => $route, 
                    'filters' => $filters, 
                    'order' => $order
                ])
        @endif

        <div class="global-container">
            @yield('content')
        </div>
 
        @include('admin.layout.partials.js')

    </body>
</html>

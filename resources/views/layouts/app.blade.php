<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>DevStagram - @yield('titulo')</title>
        <script src="{{ asset('js/app.js') }}" defer></script>        
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between">
                <h1 class="text-3xl font-black">
                    DevStagram
                </h1>
                <nav>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="#">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="#">Crear Cuenta</a>
                </nav>
            </div>    
        </header>
    </body>
</html>
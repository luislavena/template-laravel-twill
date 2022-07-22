<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <x-partials::head-assets/>
</head>
    <body class="antialiased">
        @section('header')
            <x-partials::header/>
        @show

        <main>
            @yield('body')
        </main>

        @section('footer')
            <x-partials::footer/>
        @show
    </body>
</html>

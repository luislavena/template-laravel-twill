<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Twill Template</title>

    <x-partials::head-seo :title="'Laravel Twill template'" :description="'Pre-configured template to start new Laravel project'" />
    <x-partials::head-assets />
</head>

<body class="{{ $body_classes ?? '' }} antialiased">
    @section('header')
        <x-partials::header />
    @show

    <main class="{{ $main_classes ?? '' }}">
        @yield('body')
    </main>

    @section('footer')
        <x-partials::footer />
    @show

    @env('local')
    <x-components::helpers.grid />
    @endenv
</body>

</html>

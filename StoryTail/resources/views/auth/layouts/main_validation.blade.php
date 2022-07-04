<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/website/Favicon_Logo.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/validation_style.css')}}">
    @yield('styles_validation')
</head>
<body>
<main >
    @yield('content_validation')
</main>

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

@yield('scripts_validation')

</body>
</html>

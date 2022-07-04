<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/website/Favicon_Logo.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
    @toastr_css
    @yield('styles')
</head>
<body>


@component('master.header')
@endcomponent

<main >
    @yield('content')
</main>

@component('master.footer')
@endcomponent


<!-- Scripts -->
<script src="https://kit.fontawesome.com/9220e6c257.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
@jquery
@toastr_js
@toastr_render
<script src="{{ asset('js/script.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>


@yield('scripts')
</body>
</html>

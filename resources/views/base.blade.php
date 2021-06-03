<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
        <script src="https://js.stripe.com/v3/"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/css/splide.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @yield('css')
        <title>Document</title>
    </head>
    <body>
        <div class="relative bg-cover bg-center bg-no-repeat h-screen w-screen">
            <img class="w-full h-full bg-header" src="{{ asset('img/bg-header.png') }}" alt="">
            <div class="absolute top-0 left-0 z-10 h-full w-full overflow-y-auto">
                @yield('body')
            </div>
        </div>
    </body>
    <footer>
        @yield('footer')
    </footer>
    @yield('js')
    <script src="{{ mix('js/show_sub_nav_mobile.js') }}"></script>
</html>

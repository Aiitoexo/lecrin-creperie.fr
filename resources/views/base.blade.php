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
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @yield('css')
        <title>Document</title>
    </head>
    <body>
        <div class="relative">
            <div class="test bg-cover bg-center bg-no-repeat fixed top-0 h-screen w-screen"
                 style="background-image: url('{{ asset('img/bg-header.png') }}')">
            </div>

            @yield('body')
        </div>
    </body>
    @yield('js')
    <script src="{{ mix('js/show_sub_nav_mobile.js') }}"></script>
</html>

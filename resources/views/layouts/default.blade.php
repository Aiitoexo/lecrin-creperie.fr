@extends('base')

@section('body')

    @include('partials.navbar.navbar')
    <div class="mt-56">
        @yield('main')
        @yield('footer')
    </div>

@endsection

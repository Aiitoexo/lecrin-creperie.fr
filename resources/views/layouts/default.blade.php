@extends('base')

@section('body')

    @include('partials.navbar.navbar')
    @yield('main')
    @yield('footer')

@endsection

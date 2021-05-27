@extends('base')

@section('body')

    <div class="{{ isset($all_menus) ? 'mt-24' : 'flex flex-col items-center justify-center' }} h-full w-full">
        @include('partials.navbar.navbar')
        @yield('main')
    </div>

@endsection


@extends('pages.admin.base')

@section('body_admin')

    <div class="h-screen w-screen flex">
        <div class="w-64 h-full">
            @include('pages.admin.partials.nav_bar_admin')
        </div>
        <div class="w-full h-full bg-gray-100">
            @yield('main_admin')
        </div>
    </div>

@endsection

@section('js_admin')
    <script src="{{ mix('js/delete_item_admin.js') }}"></script>
@endsection

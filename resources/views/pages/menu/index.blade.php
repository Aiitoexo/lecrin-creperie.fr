@extends('layouts.default')

@section('main')

    @if ($bad_postal !== null)
        <div id="modal_fail_postal"
             class="fixed top-0 left-0 w-screen h-screen z-50 flex justify-center items-center bg-gray-800 bg-opacity-60">
            <div class="w-4/12 h-96 rounded-lg bg-white">
                <button type="button">X</button>
                {{ $bad_postal }}
            </div>
        </div>
    @endif

    <div class="overflow-hidden">
        @include('pages.menu.partials.burger')
        @include('pages.menu.partials.wrap')
        @include('pages.menu.partials.desserts')
        @include('pages.menu.partials.boisson')
        @include('pages.menu.partials.box_apero')

        @include('partials.cart.cart')
    </div>

    <div id="modal_type_command"
         class="fixed top-0 left-0 w-screen h-screen z-50 flex justify-center items-center bg-gray-800 bg-opacity-60 hidden">
        @include('partials.type_command')
    </div>
@endsection

@section('js')
    @if ($bad_postal !== null)
        <script src="{{ mix('js/modal_fail_postal.js') }}"></script>
    @endif
    <script src="{{ mix('js/show_section_menu.js') }}"></script>
    <script src="{{ mix('js/access_carte.js') }}"></script>
@endsection

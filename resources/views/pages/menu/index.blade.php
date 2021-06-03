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
        @if (!empty($all_promos_active))
            <div class="w-full flex justify-center h-32">
                <div class="w-7/12 bg-yellow-500 rounded-xl shadow-2xl">
                    <div id="splide" class="splide w-full h-full py-2 px-6">
                        <div class="splide__track w-full h-full">
                            <ul class="splide__list w-full h-full">
                                @foreach($all_promos_active as $promo_active)
                                    <li class="splide__slide w-full h-full">
                                        @if ($promo_active->type_code === true)
                                            @include('pages.homepage.partials.promo_code')
                                        @elseif($promo_active->type_quantity === true)
                                            @include('pages.homepage.partials.promo_quantity')
                                        @elseif($promo_active->type_price === true)
                                            @include('pages.homepage.partials.promo_price')
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @include('pages.menu.partials.menu')
        @include('pages.menu.partials.burger')
        @include('pages.menu.partials.wrap')
        @include('pages.menu.partials.burger_enfant')
        @include('pages.menu.partials.box_apero')
        @include('pages.menu.partials.accompagnement')
        @include('pages.menu.partials.desserts')
        @include('pages.menu.partials.boisson')

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
    <script>
        new Splide('#splide', {
            type: 'loop',
            autoplay: true,
            arrows: false,
            drag: false,
            interval: 12000,
            speed: 1000,
            pauseOnHover: true,
        }).mount();
    </script>
@endsection

@extends('layouts.default')

@section('main')
    {{--    @if(isset($errors))--}}
    {{--        @if($errors->any())--}}
    {{--            @foreach($errors->all() as $error)--}}
    {{--                <div class="text-red-500" role="alert">--}}
    {{--                    {{ $error }}--}}
    {{--                </div>--}}
    {{--            @endforeach--}}
    {{--        @endif--}}
    {{--    @endif--}}

    <div class="w-4/12 mx-auto flex justify-center items-center bg-gray-800 border-2 border-yellow-500 px-12 pb-8 rounded-xl relative">
        @if (!isset($orderInfo))
            @include('pages.cart.partials.form_info')
        @else
            @include('pages.cart.partials.form_edit_info')
        @endif

        <div class="absolute -top-10 bg-gray-800 border-2 border-yellow-500 rounded-xl w-8/12 py-6 flex justify-center text-white">
            <h1 class="text-lg">Information Client</h1>
        </div>
    </div>

@endsection






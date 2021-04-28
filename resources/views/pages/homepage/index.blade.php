@extends('layouts.default')

@section('main')
    <div class="mt-60 h-full flex justify-center">
        @include('partials.type_command')
    </div>
@endsection

@section('js')
    <script src="{{ mix('js/access_carte.js') }}"></script>
@endsection



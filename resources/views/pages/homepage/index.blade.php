@extends('layouts.default')

@section('main')
    @include('partials.type_command')
@endsection

@section('js')
    <script src="{{ mix('js/access_carte.js') }}"></script>
@endsection



@extends('layouts.default')

@section('main')
    <div class="mt-52 w-4/12 h-96 grid grid-cols-12 mx-auto gap-x-6">
        <div id="livraison" class="col-span-6 h-full bg-blue-300"></div>
        <div class="relative col-span-6 h-full bg-pink-400">
            <form id="emporter" class="absolute h-full w-full bg-blue-300 z-10"
                  action="{{ route('verification.access') }}" method="post">
                @csrf
                <input name="type_command" type="hidden" value="emporter">
                <button class="h-full w-full" type="submit"></button>
            </form>

            <div id="postal" class="absolute h-full w-full bg-red-300 py-10">
                <form action="{{ route('verification.access') }}" method="post"
                      class="flex flex-col gap-y-4 justify-center items-center">
                    @csrf
                    <label for="postal_code">Code Postal</label>
                    <input name="postal_code" type="text">
                    <input name="type_command" type="hidden" value="livraison">
                    <button>Confirmer</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ mix('js/access_carte.js') }}"></script>
@endsection




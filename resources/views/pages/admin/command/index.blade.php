@extends('pages.admin.layouts.default_admin')

@section('main_admin')
    <div class="w-full h-screen pb-20">
        <div class="grid grid-cols-2 h-20">
            <h2 class="col-span-1 flex justify-center items-center text-xl h-full border-b-4 border-r-4 border-gray-600">Commande a Emporter</h2>
            <h2 class="col-span-1 flex justify-center items-center text-xl h-full border-b-4 border-gray-600">Commande en Livraison</h2>
        </div>

        <div class="grid grid-cols-2 h-full">
            <div id="all_command_emporter" class="overflow-y-auto h-full px-6">

            </div>

            <div id="all_command_livraison" class="overflow-y-auto h-full px-6">

            </div>
        </div>
    </div>
@endsection

@section('js_admin')
    <script src="{{ mix('js/command_admin.js') }}"></script>
@endsection


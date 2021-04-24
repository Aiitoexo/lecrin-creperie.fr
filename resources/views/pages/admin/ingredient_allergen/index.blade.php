@extends('pages.admin.layouts.default_admin')

@section('main_admin')
    <div class="grid grid-cols-2 h-full">
        <div class="col-span-1 h-full">
            @include('pages.admin.ingredient_allergen.partials.form_ingredient')
        </div>
        <div class="col-span-1 h-full">
            @include('pages.admin.ingredient_allergen.partials.form_allergen')
        </div>
    </div>

    @if (isset($ingredient_item))
        <div class="fixed top-0 z-50 bg-red-600 h-full w-full">
            <form action="{{ route('admin.ingredient.update', ['id' => $ingredient_item->id]) }}" method="post">
                @csrf
                <input name="name" type="text" placeholder="Nom de l'ingrédient" value="{{ $ingredient_item->name }}">
                <button type="submit">Confirmer</button>
            </form>
        </div>
    @endif

    @if (isset($allergen_item))
        <div class="fixed top-0 z-50 bg-red-600 h-full w-full">
            <form action="{{ route('admin.allergen.update', ['id' => $allergen_item->id]) }}" method="post">
                @csrf
                <input name="name" type="text" placeholder="Nom de l'ingrédient" value="{{ $allergen_item->name }}">
                <button type="submit">Confirmer</button>
            </form>
        </div>
    @endif

@endsection

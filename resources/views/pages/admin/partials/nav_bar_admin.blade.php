<div class="w-full h-full bg-white shadow-3xl py-4">
    <div class="px-6">
        <img src="{{ asset('img/title-logo.png') }}" alt="">
    </div>

    <div class="mt-10 w-full flex flex-col items-center text-center">
        <a class="w-full py-3 hover:bg-yellow-400" href="{{ route('admin.admin') }}">Admin</a>

        <a class="w-full py-3 hover:bg-yellow-400 bg-yellow-400" href="{{ route('admin.command') }}">Commande</a>

        <a class="w-full py-3 hover:bg-yellow-400" href="{{ route('admin.recipe') }}">Recipes</a>

        <a class="w-full py-3 hover:bg-yellow-400" href="{{ route('admin.ingredient.allergen') }}">Ingredient/Allergen</a>
    </div>
</div>

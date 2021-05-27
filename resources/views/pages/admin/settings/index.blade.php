@extends('pages.admin.layouts.default_admin')

@section('main_admin')

    <div class="h-screen w-full overflow-y-hidden">

        <div class="h-2/5 w-full grid grid-cols-12 gap-x-6 pt-6 px-6">
            <div class="relative col-span-3 overflow-y-auto bg-white shadow-2xl rounded-xl">
                <form class="sticky top-0 w-full grid grid-cols-5 gap-x-2 p-2 shadow-xl bg-yellow-400" action="{{ route('admin.tva.store') }}" method="post">
                    @csrf
                    <div class="col-span-3">
                        <input class="w-full rounded-xl" name="name_tva" id="name_tva" type="text" placeholder="Nom TVA">
                    </div>

                    <div class="col-span-2">
                        <input class="w-full rounded-xl" name="tva" id="tva" type="text" placeholder="Taux TVA">
                    </div>

                    <div class="col-span-5 flex justify-center mt-2">
                        <button class="w-full bg-white py-1 rounded-lg">Ajouter</button>
                    </div>
                </form>

                <div class="px-2">
                    @foreach($all_tva as $tva)
                        <div class="grid grid-cols-12 bg-yellow-400 my-2 py-2 px-4 rounded-xl flex items-center">
                            <form action="{{ route('admin.tva.update', ['id' => $tva->id]) }}" method="post" class="col-span-10 grid grid-cols-12 gap-x-2">
                                @csrf
                                <input name="id_tva" value="{{ $tva->id }}" type="hidden">

                                <input name="name_tva" class="input_name_tva col-span-6 rounded-lg py-1 px-1 text-left w-full border-none bg-yellow-400" type="text" value="{{ $tva->name_tva }}" disabled>

                                <div class="col-span-4 flex items-center">
                                    <input name="tva" class="input_tva rounded-lg py-1 px-1 text-center w-full border-none bg-yellow-400" type="text" value="{{ $tva->tva }}" disabled>
                                    <p class="text-center ml-2">%</p>
                                </div>

                                <div class="col-span-2 flex items-center justify-center">
                                    <button class="edit_tva" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>


                                    <button class="button_submit_tva flex items-center justify-center hidden" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>

                            <div class="col-span-2 mx-auto">
                                <form action="{{ route('admin.tva.destroy', ['id' => $tva->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-span-2 bg-white shadow-2xl rounded-xl overflow-y-hidden">
                <div class="relative overflow-y-auto h-full">
                    <form class="sticky top-0 w-full gap-y-2 p-2 shadow-xl bg-yellow-400 flex flex-col" action="{{ route('admin.postal.store') }}" method="post">
                        @csrf
                        <input name="postal_code" class="rounded-xl" type="text" placeholder="Code Postal Livraison">
                        <button class="py-1 w-full bg-white rounded-lg">Ajouter</button>
                    </form>

                    <div class="px-2">
                        @foreach($all_postal_code as $postal_code)
                            <div class="bg-yellow-400 mt-2 px-4 rounded-xl grid grid-cols-2">
                                <p class="col-span-1 py-2">{{ $postal_code->postal_code }}</p>
                                <form class="col-span-1 flex justify-end items-center" action="{{ route('admin.postal.destroy', ['id' => $postal_code->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-span-2 bg-white shadow-2xl rounded-xl overflow-y-hidden">
                <div class="relative overflow-y-auto h-full">
                    <form class="sticky top-0 w-full gap-y-2 p-2 shadow-xl bg-yellow-400 flex flex-col" action="{{ route('admin.category.ingredient.store') }}" method="post">
                        @csrf
                        <input name="category" class="rounded-xl" type="text" placeholder="Categories Ingredient">
                        <button class="py-1 w-full bg-white rounded-lg">Ajouter</button>
                    </form>

                    <div class="px-2">
                        @foreach($all_category_ingredient as $category_ingredient)
                            <div class="bg-yellow-400 mt-2 px-4 rounded-xl flex justify-between items-center">
                                <p class="py-2">{{ $category_ingredient->category }}</p>
                                <button class="category flex justify-end items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>

                            <form class="modal_category fixed top-0 left-0 z-50 h-screen w-full mx-auto bg-black bg-opacity-30 hidden shadow-2xl" action="{{ route('admin.category.ingredient.destroy', ['id' => $category_ingredient->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="w-3/12 bg-white p-8 mx-auto rounded-2xl mt-28">
                                    <p class="text-center px-6">Supprimer une categories d'ingrédient supprime l'intégralité des ingredients qui ont cette categories etes vous sur de votre choix ?</p>
                                    <div class="flex justify-around mt-6">
                                        <button class="cancel_category py-2 px-6 bg-blue-600 text-white rounded-full w-32" type="button">Annuler</button>
                                        <button class="py-2 px-6 bg-red-600 text-white rounded-full w-32" type="submit">Confirmer</button>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-span-2 bg-white shadow-2xl rounded-xl overflow-y-hidden">
                <div class="relative overflow-y-auto h-full">
                    <form class="sticky top-0 w-full gap-y-2 p-2 shadow-xl bg-yellow-400 flex flex-col" action="{{ route('admin.category.boisson.store') }}" method="post">
                        @csrf
                        <input name="category" class="rounded-xl" type="text" placeholder="Categories Boisson">
                        <button class="py-1 w-full bg-white rounded-lg">Ajouter</button>
                    </form>

                    <div class="px-2">
                        @foreach($all_category_drink as $category_drink)
                            <div class="bg-yellow-400 mt-2 px-4 rounded-xl grid grid-cols-12">
                                <p class="col-span-10 py-2">{{ $category_drink->category }}</p>
                                <form class="col-span-2 flex justify-end items-center" action="{{ route('admin.category.boisson.destroy', ['id' => $category_drink->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-span-3 bg-white shadow-2xl rounded-xl overflow-y-hidden">
                <div class="relative overflow-y-auto h-full">
                    <form class="sticky top-0 w-full gap-y-2 p-2 shadow-xl bg-yellow-400 flex flex-col z-20" action="{{ route('admin.allergen.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-x-2">
                            <div class="col-span-2 relative z-10">
                                <input id="input_file" class="h-10 w-full rounded-lg" name="img" type="file" accept="image/jpeg, image/png, image/jpg" onchange="preview_image(event)">
                                <img id="output_image" class="h-10 w-full absolute rounded-lg top-0 left-0 object-cover object-center">
                                <div id="section_svg" class="absolute top-0 left-0 w-full h-full flex justify-center items-center cursor-pointer bg-black bg-opacity-40 rounded-lg">
                                    <svg id="svg_upload" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 border-current text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>

                                    <svg id="svg_confirm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 border-current text-green-300 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <input name="name" class="rounded-xl col-span-10" type="text" placeholder="Allergen">
                        </div>
                        <button class="py-1 w-full bg-white rounded-lg">Ajouter</button>
                    </form>

                    <div class="px-2">
                        @foreach($all_allergens as $allergens)
                            <div class="bg-yellow-400 mt-2 px-4 rounded-xl grid grid-cols-12 flex items-center gap-x-4 py-2">
                                <form class="col-span-11 grid grid-cols-12" action="{{ route('admin.allergen.update', ['id' => $allergens->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-span-2 relative z-10">
                                        <input class="custom-file-input h-10 w-10 rounded-lg" style="background-image: url('{{ $allergens->img }}')" name="img" type="file" accept="image/jpeg, image/png" disabled>
                                        <div class="svg-input absolute top-0 left-0 w-10 h-full flex justify-center items-center cursor-pointer hidden bg-black bg-opacity-40 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 border-current text-white svg_upload" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 border-current text-green-300 svg_confirm hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <input name="name" class="input_allergen py-2 col-span-8 pl-2 text-left w-full border-none bg-yellow-400 border-none rounded-lg" type="text" value="{{ $allergens->name }}" disabled>

                                    <button type="button" class="edit_allergen col-span-2 flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>

                                    <button type="submit" class="submit_allergen col-span-2 flex justify-center items-center hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </form>

                                <form class="col-span-1 flex justify-end items-center" action="{{ route('admin.allergen.destroy', ['id' => $allergens->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="h-3/5 w-full grid grid-cols-12 gap-x-6 p-6">
            <div class="col-span-5 bg-white shadow-2xl rounded-xl overflow-hidden">
                <div class="relative overflow-y-auto h-full">
                    <div class="sticky top-0 w-full shadow-xl bg-yellow-400">
                        <form class=" w-full grid grid-cols-12 gap-x-2 p-2" action="{{ route('admin.ingredient.store') }}" method="post">
                            @csrf
                            <div class="col-span-6">
                                <input class="w-full rounded-xl" name="name" type="text" placeholder="Nom Ingredient">
                            </div>

                            <select class="col-span-4 rounded-xl" name="category_ingredients_id" id="category_ingredients_id">
                                <option value="">Categories</option>
                                @foreach($all_category_ingredient as $category_ingredient)
                                    <option value="{{ $category_ingredient->id }}">{{ $category_ingredient->category }}</option>
                                @endforeach
                            </select>

                            <div class="col-span-2 flex justify-center">
                                <button class="w-full h-full bg-white py-1 rounded-lg">Ajouter</button>
                            </div>
                        </form>
                        <div class="pb-2 px-2">
                            <hr class="border-gray-800">
                        </div>
                        <form class="col-span-12 grid grid-cols-12 px-2 pb-2 gap-x-2" action="{{ route('admin.settings.ingredient.allergen') }}" method="get">
                            <select class="col-span-4 rounded-xl" name="category" id="category">
                                <option value="all">Tous</option>
                                @foreach($all_category_ingredient as $category_ingredient)
                                    <option value="{{ $category_ingredient->id }}" {{ $category_ingredient->id == $id_category ? 'selected' : '' }}>{{ $category_ingredient->category }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="col-span-1 flex justify-center items-center bg-white rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div class="px-2">
                        @foreach ($all_ingredients as $ingredient)
                            <div class="bg-yellow-400 mt-2 px-4 rounded-xl grid grid-cols-12">
                                <form class="col-span-11 grid grid-cols-11 py-2 gap-x-4" action="{{ route('admin.ingredient.update', ['id' => $ingredient->id]) }}" method="post">
                                    @csrf
                                    <input type="text" name="name" class="input_ingredient col-span-6 py-2 pl-2 text-left w-full border-none bg-yellow-400 border-none rounded-lg" value="{{ $ingredient->name }}" disabled>

                                    <p class="p_category col-span-4 py-2 pl-2 text-left w-full border-none bg-yellow-400 border-none rounded-lg">{{ $ingredient->categoryIngredient->category }}</p>
                                    <select class="input_category_ingredient col-span-4 py-2 pl-2 text-left w-full border-none bg-yellow-400 border-none rounded-lg hidden" name="category_ingredients_id" id="category_ingredients_id">
                                        @foreach($all_category_ingredient as $category_ingredient)
                                            <option value="{{ $category_ingredient->id }}" {{ $ingredient->categoryIngredient->category === $category_ingredient->category ? 'selected' : '' }}>{{ $category_ingredient->category }}</option>
                                        @endforeach
                                    </select>

                                    <button type="button" class="edit_ingredient col-span-1 flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>

                                    <button type="submit" class="submit_ingredient col-span-1 flex justify-center items-center hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </form>

                                <form class="col-span-1 flex justify-end items-center" action="{{ route('admin.ingredient.destroy', ['id' => $ingredient->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-span-2">
                <div class="p-4 bg-white rounded-xl shadow-2xl">
                    <p class="text-center mb-4">Activation Type Commande</p>
                    <form action="{{ route('admin.active.command') }}" method="post">
                        @csrf
                        <button class="submit_livraison hidden"></button>
                        <div class="flex items-center gap-x-2">
                            <input type="hidden" name="active_command_livraison" value="{{ $active_command->active_command_livraison === false ? '1' : '0' }}">
                            <input class="input_livraison" type="checkbox" {{ $active_command->active_command_livraison === true ? 'checked' : '' }}>
                            <label for="active_command_livraison">Livraison</label>
                        </div>
                    </form>
                    <form action="{{ route('admin.active.command') }}" method="post">
                        @csrf
                        <button class="submit_emporter hidden"></button>
                        <div class="flex items-center gap-x-2">
                            <input type="hidden" name="active_command_emporter" value="{{ $active_command->active_command_emporter === false ? '1' : '0' }}">
                            <input class="input_emporter" type="checkbox" {{ $active_command->active_command_emporter === true ? 'checked' : '' }}>
                            <label for="active_command_emporter">Emporter</label>
                        </div>
                    </form>
                    <form action="{{ route('admin.active.extras') }}" method="post">
                        @csrf
                        <button class="submit_extras hidden"></button>
                        <div class="flex items-center gap-x-2">
                            <input type="hidden" name="active_extras" value="{{ $active_extras->active_extras === false ? '1' : '0' }}">
                            <input class="input_extras" type="checkbox" {{ $active_extras->active_extras === true ? 'checked' : '' }}>
                            <label for="active_extras">Supplement</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    {{--    <div class="grid grid-cols-2 h-full">--}}
    {{--        <div class="col-span-1 h-full">--}}
    {{--            @include('pages.admin.settings.partials.form_ingredient')--}}
    {{--        </div>--}}
    {{--        <div class="col-span-1 h-full">--}}
    {{--            @include('pages.admin.settings.partials.form_allergen')--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    @if (isset($ingredient_item))--}}
    {{--        <div class="fixed top-0 z-50 bg-red-600 h-full w-full">--}}
    {{--            <form action="{{ route('admin.ingredient.update', ['id' => $ingredient_item->id]) }}" method="post">--}}
    {{--                @csrf--}}
    {{--                <input name="name" type="text" placeholder="Nom de l'ingrédient" value="{{ $ingredient_item->name }}">--}}
    {{--                <select name="category_ingredients_id" id="category_ingredients_id">--}}
    {{--                    @foreach($all_category_ingredient as $category)--}}
    {{--                        <option value="{{ $category->id }}" {{ $ingredient_item->categoryIngredient->id === $category->id ? 'selected' : '' }}>--}}
    {{--                            {{ $category->category }}--}}
    {{--                        </option>--}}
    {{--                    @endforeach--}}
    {{--                </select>--}}
    {{--                <button type="submit">Confirmer</button>--}}
    {{--            </form>--}}
    {{--        </div>--}}
    {{--    @endif--}}

    {{--    @if (isset($allergen_item))--}}
    {{--        <div class="fixed top-0 z-50 bg-red-600 h-full w-full">--}}
    {{--            <form action="{{ route('admin.allergen.update', ['id' => $allergen_item->id]) }}" method="post">--}}
    {{--                @csrf--}}
    {{--                <input name="name" type="text" placeholder="Nom de l'ingrédient" value="{{ $allergen_item->name }}">--}}
    {{--                <button type="submit">Confirmer</button>--}}
    {{--            </form>--}}
    {{--        </div>--}}
    {{--    @endif--}}

@endsection

@section('js_admin')
    @parent
    <script type="text/javascript">
        const submit_livraison = document.querySelector('.submit_livraison')
        const input_livraison = document.querySelector('.input_livraison')

        input_livraison.addEventListener('change', function () {
            submit_livraison.click()
        })

        const submit_emporter = document.querySelector('.submit_emporter')
        const input_emporter = document.querySelector('.input_emporter')

        input_emporter.addEventListener('change', function () {
            submit_emporter.click()
        })

        const submit_extras = document.querySelector('.submit_extras')
        const input_extras = document.querySelector('.input_extras')

        input_extras.addEventListener('change', function () {
            submit_extras.click()
        })


        const all_input_name_tva = document.querySelectorAll('.input_name_tva')
        const all_input_tva = document.querySelectorAll('.input_tva')
        const all_button_edit_tva = document.querySelectorAll('.edit_tva')
        const all_button_update_tva = document.querySelectorAll('.button_submit_tva')

        for (let i = 0; i < all_input_tva.length; i++) {
            all_button_edit_tva[i].addEventListener('click', function () {
                for (let j = 0; j < all_input_tva.length; j++) {
                    all_input_name_tva[j].disabled = true;
                    all_input_name_tva[j].classList.remove('bg-white', 'border', 'border-gray-800', 'border-none')
                    all_input_name_tva[j].classList.add('bg-yellow-400', 'border-none')
                    all_input_tva[j].disabled = true;
                    all_input_tva[j].classList.remove('bg-white', 'border', 'border-gray-800', 'border-none')
                    all_input_tva[j].classList.add('bg-yellow-400', 'border-none')
                    all_button_edit_tva[j].classList.remove('hidden')
                    all_button_update_tva[j].classList.add('hidden')
                }
                all_button_edit_tva[i].classList.add('hidden')
                all_button_update_tva[i].classList.remove('hidden')
                all_input_tva[i].disabled = false;
                all_input_tva[i].classList.remove('bg-yellow-400', 'border-none')
                all_input_tva[i].classList.add('bg-white', 'border', 'border-gray-800')
                all_input_name_tva[i].disabled = false;
                all_input_name_tva[i].classList.remove('bg-yellow-400', 'border-none')
                all_input_name_tva[i].classList.add('bg-white', 'border', 'border-gray-800')
                all_input_tva[i].focus()
            })
        }

        const all_button_modal = document.querySelectorAll('.category')
        const all_modal_category = document.querySelectorAll('.modal_category')
        const all_button_cancel_modal = document.querySelectorAll('.cancel_category')

        for (let i = 0; i < all_button_modal.length; i++) {
            all_button_modal[i].addEventListener('click', function () {
                for (let j = 0; j < all_button_modal.length; j++) {
                    all_modal_category[j].classList.remove('hidden')
                    all_modal_category[j].classList.add('hidden')
                }
                all_modal_category[i].classList.remove('hidden')
            })

            all_button_cancel_modal[i].addEventListener('click', function () {
                all_modal_category[i].classList.add('hidden')
            })
        }

        const all_input_allergen = document.querySelectorAll('.input_allergen')
        const all_svg_section = document.querySelectorAll('.svg-input')
        const all_input_file = document.querySelectorAll('.custom-file-input')
        const all_button_edit_allergen = document.querySelectorAll('.edit_allergen')
        const all_button_submit_allergen = document.querySelectorAll('.submit_allergen')
        const all_svg_upload = document.querySelectorAll('.svg_upload')
        const all_svg_confirm = document.querySelectorAll('.svg_confirm')

        for (let i = 0; i < all_svg_section.length; i++) {
            all_svg_section[i].addEventListener('click', function () {
                all_input_file[i].click()
            })

            all_button_edit_allergen[i].addEventListener('click', function () {
                for (let j = 0; j < all_svg_section.length; j++) {
                    all_input_allergen[j].disabled = true;
                    all_input_file[j].disabled = true;
                    all_input_file[j].value = ''
                    all_svg_upload[j].classList.add('hidden')
                    all_svg_upload[j].classList.remove('hidden')
                    all_svg_confirm[j].classList.remove('hidden')
                    all_svg_confirm[j].classList.add('hidden')
                    all_svg_section[j].classList.remove('hidden');
                    all_svg_section[j].classList.add('hidden');
                    all_button_edit_allergen[j].classList.remove('hidden');
                    all_button_submit_allergen[j].classList.add('hidden')
                    all_input_allergen[j].classList.remove('bg-white', 'border', 'border-gray-800', 'border-none')
                    all_input_allergen[j].classList.add('bg-yellow-400', 'border-none')
                }

                all_input_allergen[i].disabled = false;
                all_input_file[i].disabled = false;
                all_svg_section[i].classList.remove('hidden');
                all_button_edit_allergen[i].classList.add('hidden');
                all_button_submit_allergen[i].classList.remove('hidden')
                all_input_allergen[i].classList.remove('bg-yellow-400', 'border-none')
                all_input_allergen[i].classList.add('bg-white', 'border', 'border-gray-800')
                all_input_allergen[i].focus()

                setInterval(function () {
                    if (all_input_file[i].value !== '') {
                        all_svg_upload[i].classList.add('hidden')
                        all_svg_confirm[i].classList.remove('hidden')
                    }
                }, 300)
            })
        }

        const input_file = document.getElementById('input_file')
        const svg_section = document.getElementById('section_svg')
        const svg_upload = document.getElementById('svg_upload')
        const svg_confirm = document.getElementById('svg_confirm')

        svg_section.addEventListener('click', function () {
            input_file.click()

            setInterval(function () {
                if (input_file.value !== '') {
                    svg_upload.classList.add('hidden')
                    svg_confirm.classList.remove('hidden')
                }
            }, 300)
        })

        function preview_image(event) {
            let reader = new FileReader();
            reader.onload = function () {
                let output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        const input_ingredient = document.querySelectorAll('.input_ingredient')
        const p_category = document.querySelectorAll('.p_category')
        const input_category_ingredient = document.querySelectorAll('.input_category_ingredient')
        const edit_ingredient = document.querySelectorAll('.edit_ingredient')
        const submit_ingredient = document.querySelectorAll('.submit_ingredient')

        for (let i = 0; i < edit_ingredient.length; i++) {
            edit_ingredient[i].addEventListener('click', function () {
                for (let j = 0; j < edit_ingredient.length; j++) {
                    edit_ingredient[j].classList.add('hidden')
                    edit_ingredient[j].classList.remove('hidden')
                    submit_ingredient[j].classList.remove('hidden')
                    submit_ingredient[j].classList.add('hidden')
                    p_category[j].classList.add('hidden')
                    p_category[j].classList.remove('hidden')
                    input_category_ingredient[j].classList.remove('hidden')
                    input_category_ingredient[j].classList.add('hidden')
                    input_category_ingredient[j].classList.remove('bg-white', 'border', 'border-gray-800', 'border-none')
                    input_category_ingredient[j].classList.add('bg-yellow-400', 'border-none')
                    input_ingredient[j].classList.remove('bg-white', 'border', 'border-gray-800', 'border-none')
                    input_ingredient[j].classList.add('bg-yellow-400', 'border-none')
                    input_ingredient[j].disabled = true;
                }
                edit_ingredient[i].classList.add('hidden')
                submit_ingredient[i].classList.remove('hidden')
                p_category[i].classList.add('hidden')
                input_category_ingredient[i].classList.remove('hidden')
                input_category_ingredient[i].classList.remove('bg-yellow-400', 'border-none')
                input_category_ingredient[i].classList.add('bg-white', 'border', 'border-gray-800')
                input_ingredient[i].classList.remove('bg-yellow-400', 'border-none')
                input_ingredient[i].classList.add('bg-white', 'border', 'border-gray-800')
                input_ingredient[i].disabled = false;
                input_ingredient[i].focus();
            })
        }
    </script>
@endsection



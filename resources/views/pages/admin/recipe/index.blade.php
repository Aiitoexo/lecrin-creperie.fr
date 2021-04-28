@extends('pages.admin.layouts.default_admin')

@section('main_admin')
    <div class="w-full h-full grid grid-cols-12">

        <div class="col-span-7 h-full bg-yellow-500 border-r-4 border-gray-800">
            @if (!isset($item_menu))
                @include('pages.admin.recipe.partials.form_recipe')
            @else
                @include('pages.admin.recipe.partials.form_edit_recipe')
            @endif
        </div>

        <div class="col-span-5 h-screen flex flex-col">
            <div class="h-20 w-full py-3 px-5 bg-gray-800 shadow-2xl">
                <form action="{{ route('admin.recipe') }}" method="get">
                    <select name="section" id="section" class="rounded">
                        <option value="0">Tous</option>

                        @foreach($all_sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                    <button class="button-cancel ml-10" type="submit">Confirmer</button>
                </form>
            </div>
            <div class="menu_item h-full overflow-y-auto flex flex-col gap-y-6 px-4 py-6">
                @foreach($all_items_menu as $item)
                    <div class="w-full">
                        <div class="w-full bg-yellow-500 grid grid-cols-6 px-10 py-4 rounded shadow-2xl">
                            <img class="h-14 rounded col-span-1 flex items-center justify-center" src="{{ getImageUrl($item->img) }}"
                                 alt="">
                            <p class="col-span-1 flex items-center justify-start">{{ $item->name }}</p>
                            <p class="col-span-1 flex items-center justify-center">{{ $item->sectionMenu->name }}</p>
                            <p class="col-span-1 flex items-center justify-center">{{ $item->price }}€</p>
                            @if ($item->menu == true)
                                <p class="col-span-1 flex items-center justify-start">Oui</p>
                            @else
                                <p class="col-span-1 flex items-center justify-start">Non</p>
                            @endif
                            <div class="col-span-1 flex items-center justify-between">
                                <form action="{{ route('admin.recipe.edit', ['id' => $item->id]) }}">
                                    <button class="flex items-center justify-center" type="submit">
                                        <svg class="h-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                </form>

                                <button class="delete_item flex items-center justify-center" type="button">
                                    <svg class="h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                            <button
                                class="button_details col-span-6 flex justify-center items-center focus:outline-none">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                        <div class="w-full bg-white hidden details flex gap-x-4 rounded-b border-t-2 border-gray-800
                        shadow-2xl">
                            <ul>
                                @foreach($item->ingredientItemRecipe as $ingredient)
                                    <li>{{ $ingredient->name }}</li>
                                @endforeach
                            </ul>

                            <ul>
                                @foreach($item->allergenItemRecipe as $allergen)
                                    <li>{{ $allergen->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <hr>
                        <div class="modal_item w-screen h-screen fixed top-0 left-0 z-50 flex justify-center items-center hidden">
                            <div class="flex flex-col justify-center items-center p-10 bg-red-600">
                                <p>Est vous sur de vouloir supprimer cette article</p>
                                <div class="flex">
                                    <button class="cancel_modal" type="button">Annuler</button>
                                    <form action="{{ route('admin.recipe.destroy', ['id' => $item->id ]) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection

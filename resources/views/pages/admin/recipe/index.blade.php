@extends('pages.admin.layouts.default_admin')

@section('main_admin')
    <div class="h-full grid grid-cols-12 relative">

        <div id="modal_recipe" class="{{ $errors->any() ? '' : 'hidden' }} w-full h-full absolute z-50 bg-black bg-opacity-40 flex justify-center items-center">
            <div class="bg-white rounded-lg w-10/12 h-5/6 p-10 relative">
                <button class="bg-gray-800 rounded-full p-3 h-12 w-12 absolute top-2 right-2 text-white">X</button>
                @include('pages.admin.recipe.partials.form_recipe')
            </div>
        </div>

        @if (isset($item_menu))
            <div class="w-full h-full absolute z-50 bg-black bg-opacity-40 flex justify-center items-center">
                <div class="bg-white rounded-lg w-10/12 h-5/6 p-10 relative">
                    <a href="{{ route('admin.recipe') }}" class="bg-gray-800 rounded-full p-3 h-12 w-12 absolute top-2 right-2 text-white">X</a>
                    @include('pages.admin.recipe.partials.form_edit_recipe')
                </div>
            </div>
        @endif

        <div class="h-20 w-full py-3 px-5 bg-gray-800 shadow-2xl absolute top-0 grid grid-cols-12 flex items-center">
            <button id="button_modal_recipe" class="button-cancel mr-10 col-span-2 h-10">Creer un article</button>

            <form class="col-span-5 flex justify-end h-10 px-4 border-r border-white" action="{{ route('admin.recipe') }}" method="get">
                <select name="section_id" id="section_id" class="rounded">
                    <option value="0">Tous</option>
                    @foreach($all_sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                        {{--                            {{ $section->id == $all_items_menu->first()->section_id ? 'selected' : '' }}--}}
                    @endforeach
                </select>
                <button class="button-cancel ml-10" type="submit">Confirmer</button>
            </form>
            <div class="col-span-5 flex justify-center items-center text-white">
                <p>Supplement Menu</p>
            </div>
        </div>

        <div class="col-span-7 h-screen flex flex-col pt-20">
            <div class="menu_item h-full overflow-y-auto flex flex-col gap-y-6 px-4 py-6">
                @foreach($all_items_menu as $item)
                    <div class="w-full">
                        <div class="w-full bg-yellow-500 grid grid-cols-6 px-10 py-4 rounded shadow-2xl">
                            <img class="h-14 w-14 object-cover object-center rounded col-span-1 flex items-center justify-center" src="{{ getImageUrl($item->img) }}"
                                 alt="">
                            <p class="col-span-1 flex items-center justify-start">{{ $item->name }}</p>
                            <p class="col-span-1 flex items-center justify-center">{{ $item->sectionMenu->name }}</p>
                            <p class="col-span-1 flex items-center justify-center">{{ $item->price_ttc }}€</p>
                            @if ($item->menu == true)
                                <p class="col-span-1 flex items-center justify-start">Oui</p>
                            @else
                                <p class="col-span-1 flex items-center justify-start">Non</p>
                            @endif
                            <div class="col-span-1 flex items-center justify-between">
                                @if ($item->active === true)
                                    <form action="{{ route('admin.recipe.show', ['id' => $item->id]) }}" method="post">
                                        @csrf
                                        <button class="flex items-center justify-center" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.recipe.show', ['id' => $item->id]) }}" method="post">
                                        @csrf
                                        <button class="flex items-center justify-center" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

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
                            <button class="button_details col-span-6 flex justify-center items-center focus:outline-none">
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

        @if (isset($all_extra_items))
            <div class="col-span-5 h-screen pt-20">
                <div class="h-full overflow-y-auto flex flex-col gap-y-6 px-4 py-6">
                    @foreach($all_extra_items as $extra_item)
                        <div class="w-full bg-yellow-500 grid grid-cols-7 px-10 py-4 rounded shadow-2xl flex items-center">
                            {{--                        {{ $extra_item->extraMenuItem->name }}--}}
                            <img class="h-14 w-14 object-cover object-center rounded col-span-2 flex items-center justify-center" src="{{ getImageUrl($extra_item->extraMenuItem->img) }}" alt="">
                            <p class="col-span-2">{{ $extra_item->extraMenuItem->name }}</p>
                            <p class="col-span-1">{{ $extra_item->price_extra_ttc }}</p>
                            <form class="col-span-2 flex justify-end" action="{{ route('admin.recipe.destroy.extra', ['id' => $extra_item->id]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button>
                                    <svg class="h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js_admin')
    @parent
    <script>
        const modal_recipe = document.getElementById('modal_recipe')
        const button_modal_recipe = document.getElementById('button_modal_recipe')

        const button_close_modal = document.querySelector('#modal_recipe > div > button')

        button_modal_recipe.addEventListener('click', function () {
            modal_recipe.classList.remove('hidden')
            modal_recipe.classList.add('block')
        })

        button_close_modal.addEventListener('click', function (){
            modal_recipe.classList.remove('block')
            modal_recipe.classList.add('hidden')
        })
    </script>
@endsection

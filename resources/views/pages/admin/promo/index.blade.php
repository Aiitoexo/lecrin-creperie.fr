@extends('pages.admin.layouts.default_admin')

@section('main_admin')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="p-6 w-full h-full gap-x-6 flex">
        <form class="w-8/12 h-full bg-white shadow-2xl rounded-xl p-3 flex flex-col" action="{{ route('admin.create.promo') }}" method="post">
            @csrf
            <div class="w-full border-2 p-3 rounded-lg flex gap-x-10 grid grid-cols-2">
                <div class="col-span-1">
                    <label for="name">Nom Promo</label>
                    <input class="border border-gray-300 rounded w-full" name="name" type="text">
                </div>

                <div class="col-span-1">
                    <label for="code">Code Promo</label>
                    <input class="border border-gray-300 rounded w-full uppercase" name="code" type="text">
                </div>

                <div class="col-span-2 mt-2">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="resize-none w-full border border-gray-300 rounded"></textarea>
                </div>
            </div>

            <div class="w-full flex-grow border-2 p-3 rounded-lg mt-3 gap-y-6 flex flex-col">
                <div class="flex flex-col">
                    <label for="type_promo">Regles</label>
                    <select class="border border-gray-300 rounded" name="type_promo_section" id="select_promo">
                        <option value="promo_code">Promo par Code</option>
                        <option value="promo_quantity">Promo par Quantiter Minimum</option>
                        <option value="promo_price">Promo par Prix Minimum</option>
                    </select>
                </div>

                <div class="section_promo border border-gray-300 rounded p-3">
                    <div class="flex justify-between">
                        <div class="flex flex-col">
                            <p>Reduction</p>
                            <div class="flex">
                                <div class="flex items-center justify-center gap-x-2 mr-4">
                                    <div class="cc w-24 h-full flex items-center justify-center border border-gray-300 rounded-xl">
                                        <input class="input_code input_promo_code border-none rounded-l-xl w-full text-right cursor-text" name="type_percentage" type="text" disabled>
                                        <p class="px-3 h-full bg-gray-200 flex items-center rounded-r-xl">%</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-center gap-x-2">
                                    <div class="cc w-24 h-full flex items-center justify-center border border-gray-300 rounded-xl">
                                        <input class="input_code input_promo_code border-none rounded-l-xl w-full text-right cursor-text" name="type_price" type="text" disabled>
                                        <p class="px-3 h-full bg-gray-200 flex items-center rounded-r-xl">€</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p>Commence le</p>
                            <div class="flex gap-x-3">
                                <input class="input_code border border-gray-300 rounded-xl" name="start_date" type="date">
                                <input class="input_code border border-gray-300 rounded-xl" name="start_time" type="time">
                            </div>
                        </div>

                        <div>
                            <p>Fini le</p>
                            <div class="flex gap-x-3">
                                <input class="input_code border border-gray-300 rounded-xl" name="end_date" type="date">
                                <input class="input_code border border-gray-300 rounded-xl" name="end_time" type="time">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section_promo border border-gray-300 rounded p-3 h-full hidden flex flex-col">
                    <div class="grid grid-cols-12 flex-grow gap-x-4">
                        <div class="col-span-4 overflow-y-auto relative flex flex-col">
                            <p>Selection Article Eligible</p>
                            <select class="input_quantity sticky top-0 w-full select_section_quantity border border-gray-300 rounded mb-4" disabled>
                                @foreach($all_sections as $section)
                                    <option class="all_sections_quantity" value="">{{ $section->name }}</option>
                                @endforeach
                            </select>

                            <div class="p-4 border border-gray-300 rounded flex-grow">
                                @foreach ($all_sections as $items)
                                    <div class="items_sections_quantity grid grid-cols-2 {{ $loop->first ? '' : 'hidden' }}">
                                        @foreach($items->allMenuItemBySection as $item)
                                            <div class="col-span-1 flex items-center gap-x-2">
                                                <input class="input_quantity" name="menu_items_id[]" type="checkbox" value="{{ $item->id }}" disabled>
                                                <p>{{ $item->name }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-span-4 flex flex-col gap-y-4">
                            <div class="grid grid-cols-2 gap-x-4">
                                <div class="col-span-1">
                                    <label for="">Nombre min</label>
                                    <input class="input_quantity border border-gray-300 rounded w-full" name="min_quantity" type="number" disabled>
                                </div>

                                <div class="col-span-1">
                                    <label for="">Nombre max</label>
                                    <input class="input_quantity border border-gray-300 rounded w-full" name="max_quantity" type="number" disabled>
                                </div>
                            </div>

                            <div>
                                <label>Type de Reduction</label>
                                <select class="input_quantity w-full border border-gray-300 rounded select_reduction" name="type_promo" disabled>
                                    <option selected disabled>Selection</option>
                                    <option value="percentage">Reduction par %</option>
                                    <option value="price">Reduction du Prix</option>
                                    <option value="items">Article Gratuit</option>
                                </select>
                            </div>

                            <div>
                                <label>Type de Date</label>
                                <select class="input_quantity w-full border border-gray-300 rounded option_date" name="type_date" disabled>
                                    <option selected disabled>Selection</option>
                                    <option value="date">Debut - Fin</option>
                                    <option value="days">Jour - Jours</option>
                                </select>
                            </div>

                            <div class="date_limit hidden">
                                <div>
                                    <p>Commence le</p>
                                    <div class="flex gap-x-3">
                                        <input class="input_quantity border border-gray-300 rounded-xl input_date" name="start_date" type="date" disabled>
                                        <input class="input_quantity border border-gray-300 rounded-xl input_date" name="start_time" type="time" disabled>
                                    </div>
                                </div>

                                <div>
                                    <p>Fini le</p>
                                    <div class="flex gap-x-3">
                                        <input class="input_quantity border border-gray-300 rounded-xl input_date" name="end_date" type="date" disabled>
                                        <input class="input_quantity border border-gray-300 rounded-xl input_date" name="end_time" type="time" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="date_limit hidden">
                                <label for="">Tous les ..</label>
                                <div class="border border-gray-300 rounded p-2">
                                    <div class="flex items-center gap-x-3">
                                        <input class="input_quantity checkbox_date" name="days[]" value="monday" type="checkbox" disabled>
                                        <label for="">Lundi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_quantity checkbox_date" name="days[]" value="tuesday" type="checkbox" disabled>
                                        <label for="">Mardi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_quantity checkbox_date" name="days[]" value="wednesday" type="checkbox" disabled>
                                        <label for="">Mercredi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_quantity checkbox_date" name="days[]" value="thursday" type="checkbox" disabled>
                                        <label for="">Jeudi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_quantity checkbox_date" name="days[]" value="friday" type="checkbox" disabled>
                                        <label for="">Vendredi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_quantity checkbox_date" name="days[]" value="saturday" type="checkbox" disabled>
                                        <label for="">Samedi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_quantity checkbox_date" name="days[]" value="sunday" type="checkbox" disabled>
                                        <label for="">Dimanche</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-4 option_reduction hidden">
                            <p>Reduction en pourcentage</p>
                            <div class="h-10 w-full flex border border-gray-300 rounded">
                                <input class="input_quantity border-none rounded-l w-full text-right cursor-text" name="type_percentage" type="text" disabled>
                                <p class="px-3 w-10 h-full bg-gray-200 flex items-center justify-center rounded-r">%</p>
                            </div>
                        </div>

                        <div class="col-span-4 option_reduction hidden">
                            <p>Reduction en euro</p>
                            <div class="h-10 w-full flex border border-gray-300 rounded">
                                <input class="input_quantity border-none rounded-l w-full text-right cursor-text" name="type_price" type="text" disabled>
                                <p class="px-3 w-10 h-full bg-gray-200 flex items-center justify-center rounded-r">€</p>
                            </div>
                        </div>

                        <div class="col-span-4 overflow-y-auto relative flex flex-col hidden option_reduction">
                            <p>Article Gratuit</p>
                            <select class="input_quantity sticky top-0 w-full select_section_free border border-gray-300 rounded mb-4" name="" id="" disabled>
                                @foreach($all_sections as $section)
                                    <option class="all_sections_free" value="">{{ $section->name }}</option>
                                @endforeach
                            </select>

                            <div class="p-4 border border-gray-300 rounded flex-grow ">
                                @foreach ($all_sections as $items)
                                    <div class="items_sections_free grid grid-cols-2 {{ $loop->first ? '' : 'hidden' }}">
                                        @foreach($items->allMenuItemBySection as $item)
                                            <div class="col-span-1 flex items-center gap-x-2">
                                                <input class="input_quantity" name="free_menu_items_id[]" type="checkbox" value="{{ $item->id }}" disabled>
                                                <p>{{ $item->name }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                            <div class="grid grid-cols-2 gap-x-4 mt-4">
                                <div class="col-span-1">
                                    <label for="">Min Article Gratuit</label>
                                    <input class="input_quantity w-full border border-gray-300 rounded" name="free_min_items" type="text" disabled>
                                </div>
                                <div class="col-span-1">
                                    <label for="">Max Article Gratuit</label>
                                    <input class="input_quantity w-full border border-gray-300 rounded" name="free_max_items" type="text" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section_promo border border-gray-300 rounded p-3 h-full hidden flex flex-col">
                    <div class="grid grid-cols-12 flex-grow gap-x-4">
                        <div class="col-span-4 relative flex flex-col">
                            <label for="">Prix Minimum Commande</label>
                            <input class="input_price border border-gray-300 rounded w-full" name="min_price" type="number" disabled>
                        </div>

                        <div class="col-span-4 flex flex-col gap-y-4">
                            <div>
                                <label>Type de Reduction</label>
                                <select class="input_price w-full border border-gray-300 rounded select_reduction_price" name="type_promo" disabled>
                                    <option selected disabled>Selection</option>
                                    <option value="percentage">Reduction par %</option>
                                    <option value="price">Reduction du Prix</option>
                                    <option value="items">Article Gratuit</option>
                                </select>
                            </div>

                            <div>
                                <label>Type de Date</label>
                                <select class="input_price w-full border border-gray-300 rounded option_date_price" name="type_date" disabled>
                                    <option selected disabled>Selection</option>
                                    <option value="date">Debut - Fin</option>
                                    <option value="days">Jour - Jours</option>
                                </select>
                            </div>

                            <div class="date_limit_price hidden">
                                <div>
                                    <p>Commence le</p>
                                    <div class="flex gap-x-3">
                                        <input class="input_price border border-gray-300 rounded-xl input_price_date" name="start_date" type="date" disabled>
                                        <input class="input_price border border-gray-300 rounded-xl input_price_date" name="start_time" type="time" disabled>
                                    </div>
                                </div>

                                <div>
                                    <p>Fini le</p>
                                    <div class="flex gap-x-3">
                                        <input class="input_price border border-gray-300 rounded-xl input_price_date" name="end_date" type="date" disabled>
                                        <input class="input_price border border-gray-300 rounded-xl input_price_date" name="end_time" type="time" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="date_limit_price hidden">
                                <label for="">Tous les ..</label>
                                <div class="border border-gray-300 rounded p-2">
                                    <div class="flex items-center gap-x-3">
                                        <input class="input_price checkbox_price_date" name="days[]" value="monday" type="checkbox" disabled>
                                        <label for="">Lundi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_price checkbox_price_date" name="days[]" value="tuesday" type="checkbox" disabled>
                                        <label for="">Mardi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_price checkbox_price_date" name="days[]" value="wednesday" type="checkbox" disabled>
                                        <label for="">Mercredi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_price checkbox_price_date" name="days[]" value="thursday" type="checkbox" disabled>
                                        <label for="">Jeudi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_price checkbox_price_date" name="days[]" value="friday" type="checkbox" disabled>
                                        <label for="">Vendredi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_price checkbox_price_date" name="days[]" value="saturday" type="checkbox" disabled>
                                        <label for="">Samedi</label>
                                    </div>

                                    <div class="flex items-center gap-x-3">
                                        <input class="input_price checkbox_price_date" name="days[]" value="sunday" type="checkbox" disabled>
                                        <label for="">Dimanche</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-4 option_reduction_price hidden">
                            <p>Reduction en pourcentage</p>
                            <div class="h-10 w-full flex border border-gray-300 rounded">
                                <input class="input_price border-none rounded-l w-full text-right cursor-text" name="type_percentage" type="text" disabled>
                                <p class="px-3 w-10 h-full bg-gray-200 flex items-center justify-center rounded-r">%</p>
                            </div>
                        </div>

                        <div class="col-span-4 option_reduction_price hidden">
                            <p>Reduction en euro</p>
                            <div class="h-10 w-full flex border border-gray-300 rounded">
                                <input class="input_price border-none rounded-l w-full text-right cursor-text" name="type_price" type="text" disabled>
                                <p class="px-3 w-10 h-full bg-gray-200 flex items-center justify-center rounded-r">€</p>
                            </div>
                        </div>

                        <div class="col-span-4 overflow-y-auto relative flex flex-col hidden option_reduction_price">
                            <p>Article Gratuit</p>
                            <select class="input_price sticky top-0 w-full select_section_free_price border border-gray-300 rounded mb-4" name="" id="" disabled>
                                @foreach($all_sections as $section)
                                    <option class="all_sections_free_price" value="">{{ $section->name }}</option>
                                @endforeach
                            </select>

                            <div class="p-4 border border-gray-300 rounded flex-grow ">
                                @foreach ($all_sections as $items)
                                    <div class="items_sections_free_price grid grid-cols-2 {{ $loop->first ? '' : 'hidden' }}">
                                        @foreach($items->allMenuItemBySection as $item)
                                            <div class="col-span-1">
                                                <input class="input_price" name="free_menu_items_id[]" type="checkbox" value="{{ $item->id }}" disabled>
                                                <label for="">{{ $item->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <div class="grid grid-cols-2 gap-x-4 mt-4">
                                <div class="col-span-1">
                                    <label for="">Max Article Gratuit</label>
                                    <input class="input_price w-full border border-gray-300 rounded" name="free_min_items" type="text" disabled>
                                </div>
                                <div class="col-span-1">
                                    <label for="">Min Article Gratuit</label>
                                    <input class="input_price w-full border border-gray-300 rounded" name="free_max_items" type="text" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="h-14 mt-6 flex justify-end">
                <button class="h-full bg-yellow-400 px-8 rounded-xl">Creer</button>
            </div>
        </form>

        <div class="w-4/12 h-full bg-white shadow-2xl rounded-xl">
        <div class="w-4/12 h-full bg-white shadow-2xl rounded-xl">
            @foreach ($all_promos as $promo)
                <div>{{ $promo->name }}</div>
            @endforeach
        </div>
    </div>
@endsection

@section('js_admin')
    @parent
    <script type="text/javascript">
        const select_promo = document.getElementById('select_promo')
        const all_section_promo = document.querySelectorAll('.section_promo')
        const input_code_promo = document.querySelectorAll('.input_code')
        const input_quantity = document.querySelectorAll('.input_quantity')
        const input_price = document.querySelectorAll('.input_price')

        select_promo.addEventListener('change', function () {
            for (let i = 0; i < all_section_promo.length; i++) {
                all_section_promo[i].classList.remove('hidden')
                all_section_promo[i].classList.add('hidden')
            }

            for (let i = 0; i < input_code_promo.length; i++) {
                input_code_promo[i].disabled = true
            }

            for (let i = 0; i < input_quantity.length; i++) {
                input_quantity[i].disabled = true
            }

            for (let i = 0; i < input_price.length; i++) {
                input_price[i].disabled = true
            }

            let promo_select = select_promo.selectedIndex
            all_section_promo[promo_select].classList.remove('hidden')

            if (promo_select === 0) {
                for (let j = 0; j < input_code_promo.length; j++) {
                    input_code_promo[j].disabled = false
                }
            }

            if (promo_select === 1) {
                for (let j = 0; j < input_quantity.length; j++) {
                    input_quantity[j].disabled = false
                }
            }

            if (promo_select === 2) {
                for (let j = 0; j < input_price.length; j++) {
                    input_price[j].disabled = false
                }
            }
        })

        const input_promo_code = document.querySelectorAll('.input_promo_code')
        const cc = document.querySelectorAll('.cc')

        for (let i = 0; i < cc.length; i++) {
            cc[i].addEventListener('click', function () {
                for (let j = 0; j < input_promo_code.length; j++) {
                    input_promo_code[j].disabled = true
                    input_promo_code[j].classList.remove('bg-gray-100')
                    input_promo_code[j].classList.add('bg-gray-100')
                    input_promo_code[j].value = ''
                }
                input_promo_code[i].classList.remove('bg-gray-100')
                input_promo_code[i].disabled = false
                input_promo_code[i].focus()
            })
        }

        const items_sections_quantity = document.querySelectorAll('.items_sections_quantity')
        const select_section_quantity = document.querySelector('.select_section_quantity')

        select_section_quantity.addEventListener('change', function () {
            for (let i = 0; i < items_sections_quantity.length; i++) {
                items_sections_quantity[i].classList.remove('hidden')
                items_sections_quantity[i].classList.add('hidden')
            }
            let section_select = select_section_quantity.selectedIndex
            items_sections_quantity[section_select].classList.remove('hidden')
        })

        const items_sections_free = document.querySelectorAll('.items_sections_free')
        const select_section_free = document.querySelector('.select_section_free')

        select_section_free.addEventListener('change', function () {
            for (let i = 0; i < items_sections_free.length; i++) {
                items_sections_free[i].classList.remove('hidden')
                items_sections_free[i].classList.add('hidden')
            }
            let section_select = select_section_free.selectedIndex
            items_sections_free[section_select].classList.remove('hidden')
        })

        const option_date = document.querySelector('.option_date')
        const date_limit = document.querySelectorAll('.date_limit')
        const input_date = document.querySelectorAll('.input_date')
        const checkbox_date = document.querySelectorAll('.checkbox_date')

        option_date.addEventListener('change', function () {
            for (let i = 0; i < date_limit.length; i++) {
                date_limit[i].classList.remove('hidden')
                date_limit[i].classList.add('hidden')
            }

            for (let j = 0; j < input_date.length; j++) {
                input_date[j].value = ''
            }

            for (let h = 0; h < checkbox_date.length; h++) {
                checkbox_date[h].checked = false
            }

            let option_select = option_date.selectedIndex - 1
            date_limit[option_select].classList.remove('hidden')
        })

        const select_reduction = document.querySelector('.select_reduction')
        const option_reduction = document.querySelectorAll('.option_reduction')
        const input_reduction = document.querySelectorAll('.option_reduction > div > input')

        select_reduction.addEventListener('change', function () {
            for (let i = 0; i < option_reduction.length; i++) {
                option_reduction[i].classList.remove('hidden')
                option_reduction[i].classList.add('hidden')
            }

            for (let j = 0; j < input_reduction.length; j++) {
                input_reduction[j].value = ''
            }

            let reduction_select = select_reduction.selectedIndex - 1
            option_reduction[reduction_select].classList.remove('hidden')
        })

        const items_sections_free_price = document.querySelectorAll('.items_sections_free_price')
        const select_section_free_price = document.querySelector('.select_section_free_price')

        select_section_free_price.addEventListener('change', function () {
            for (let i = 0; i < items_sections_free_price.length; i++) {
                items_sections_free_price[i].classList.remove('hidden')
                items_sections_free_price[i].classList.add('hidden')
            }
            let section_select = select_section_free_price.selectedIndex
            items_sections_free_price[section_select].classList.remove('hidden')
        })

        const option_date_price = document.querySelector('.option_date_price')
        const date_limit_price = document.querySelectorAll('.date_limit_price')
        const input_price_date = document.querySelectorAll('.input_price_date')
        const checkbox_price_date = document.querySelectorAll('.checkbox_price_date')

        option_date_price.addEventListener('change', function () {
            for (let i = 0; i < date_limit_price.length; i++) {
                date_limit_price[i].classList.remove('hidden')
                date_limit_price[i].classList.add('hidden')
            }

            for (let j = 0; j < input_price_date.length; j++) {
                input_price_date[j].value = ''
            }

            for (let h = 0; h < checkbox_price_date.length; h++) {
                checkbox_price_date[h].checked = false
            }

            let option_select = option_date_price.selectedIndex - 1
            date_limit_price[option_select].classList.remove('hidden')
        })

        const select_reduction_price = document.querySelector('.select_reduction_price')
        const option_reduction_price = document.querySelectorAll('.option_reduction_price')
        const input_reduction_price = document.querySelectorAll('.option_reduction_price > div > input')

        select_reduction_price.addEventListener('change', function () {
            for (let i = 0; i < option_reduction_price.length; i++) {
                option_reduction_price[i].classList.remove('hidden')
                option_reduction_price[i].classList.add('hidden')
            }

            for (let j = 0; j < input_reduction_price.length; j++) {
                input_reduction_price[j].value = ''
                input_reduction_price[j].value = ''
            }

            let reduction_select = select_reduction_price.selectedIndex - 1
            option_reduction_price[reduction_select].classList.remove('hidden')
        })
    </script>
@endsection

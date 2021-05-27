@if (isset($all_sections))
    <div class="w-8/12 mx-auto">
        <ul class="rounded-b-4xl overflow-hidden shadow-3xl flex">
            <li class="flex-1">
                <button type="button" class="button_section w-full h-14 text-white focus:outline-none py-8 flex justify-center items-center bg-yellow-500 text-gray-800">
                    Menu
                </button>
            </li>
            @foreach ($all_sections as $section)
                <li class="flex-1">
                    <button type="button" class="button_section w-full h-14 text-white focus:outline-none py-8 flex justify-center items-center bg-gray-800 text-white">
                        {{ $section->name }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
@endif

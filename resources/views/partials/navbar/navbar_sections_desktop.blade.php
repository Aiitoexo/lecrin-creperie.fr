@if (isset($all_sections))
    <div class="w-8/12 mx-auto">
        <ul class="grid grid-cols-10 rounded-b-4xl overflow-hidden shadow-3xl">
            @foreach ($all_sections as $section)
                <li class="col-span-2 flex justify-center">
                    <button id="button_section" type="button"
                            class="w-full h-12 text-white focus:outline-none
                            {{ $loop->first ? 'bg-yellow-500 text-gray-800' : 'bg-gray-800 text-white' }}">
                        {{ $section->name }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
@endif

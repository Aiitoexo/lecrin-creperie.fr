<div id="section" class="mt-10 w-8/12 mx-auto grid grid-cols-12 gap-12 hidden">
    @foreach ($all_desserts as $item)
        @include('pages.menu.partials.card')
    @endforeach
</div>


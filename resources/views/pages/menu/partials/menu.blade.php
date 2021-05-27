<div class="section mt-10 w-7/12 mx-auto grid grid-cols-12 gap-y-12 gap-x-20">
    @foreach ($all_menus as $item)
        @include('pages.menu.partials.card')
    @endforeach
</div>

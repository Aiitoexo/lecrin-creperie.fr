<div class="section mt-10 sm:w-full lg:w-full xl:w-7/12 w-full px-12 xl:px-0 mx-auto grid grid-cols-12 xl:gap-y-12 xl:gap-x-20 sm:gap-x-6 lg:gap-x-6 hidden">
    @foreach ($all_desserts as $item)
        @include('pages.menu.partials.card')
    @endforeach
</div>


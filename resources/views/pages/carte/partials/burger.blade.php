<div id="section"
     class="mt-10 sm:w-full lg:w-full xl:w-8/12 w-full px-12 xl:px-0 mx-auto grid grid-cols-12 xl:gap-12 gap-y-10
     sm:gap-x-6 lg:gap-x-6">
    @foreach ($all_burgers as $item)
        @include('pages.carte.partials.card')
    @endforeach
</div>

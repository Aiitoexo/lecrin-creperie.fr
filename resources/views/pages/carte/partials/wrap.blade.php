<div id="section" class="mt-10 w-8/12 mx-auto grid grid-cols-12 gap-12 hidden">
    @foreach ($all_wraps as $item)
        @include('pages.carte.partials.card')
    @endforeach
</div>

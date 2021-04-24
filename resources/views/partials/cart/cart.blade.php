<div id="cart" class="hidden xl:block fixed top-64 right-0 bg-yellow-500 rounded-l-4xl z-40 w-72 h-96">
    <div id="section_cart" class="h-full w-full px-3 py-6 flex flex-col relative">
        @if (session('cart'))
            <div class="h-5/6 w-full">
                @foreach ($cart as $item)
                    <div class="grid grid-cols-12">
                        <p class="col-span-6 text-left">{{ $item['name'] }}</p>
                        <p class="col-span-2 text-center">x{{ $item['quantity'] }}</p>
                        <p class="col-span-2 text-center">{{ $item['total_price_items'] }} €</p>
                        <form class="col-span-2 flex justify-center items-center"
                              action="{{ route('delete.item', [$item['id']]) }}" method="post">
                            @csrf
                            <button>
                                <svg class="h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col justify-center items-center h-1/6">
                <p class="mb-4">Total Commande : {{ session('cart_total', 0) }}</p>
                <form action="{{ route('panier') }}" method="post">
                    @csrf
                    <button class="py-2 px-4 bg-purple-400">Commander</button>
                </form>
            </div>
        @else
            <div>panier vide</div>
        @endif
    </div>
</div>

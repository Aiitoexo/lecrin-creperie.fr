@extends('layouts.default')

@section('main')
    <div class="flex justify-center gap-x-6 relative">
        <div class="w-6/12">
            @foreach ($cart as $item)
                <div class="h-24 w-full shadow-2xl rounded-xl py-4 px-6 mb-6 flex items-center justify-center grid grid-cols-12 bg-gray-800 border-2 border-yellow-500">
                    <div class="col-span-2">
                        <img class="h-14 w-14 object-cover object-center rounded-lg rounded border-2 border-yellow-500" src="{{ getImageUrl($item['img']) }}" alt="">
                    </div>
                    <p class="col-span-3 text-white">{{ $item['name'] }}</p>
                    <div class="col-span-2 h-full flex justify-center">
                        <p class="w-2/3 flex justify-center items-center h-full border-2 border-yellow-500 rounded-xl bg-white">{{ $item['price_ttc'] }}€</p>
                    </div>
                    <div class="col-span-2 flex items-center justify-evenly text-white">
                        <form action="{{ route('less.item', [$item['id']]) }}" method="post">
                            @csrf
                            <button class="flex items-center">
                                <svg class="h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </form>
                        <p>x{{ $item['quantity'] }}</p>
                        <form action="{{ route('more.item', [$item['id']]) }}" method="post">
                            @csrf
                            <button class="flex items-center">
                                <svg class="h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="col-span-2 h-full flex justify-center">
                        <p class="w-2/3 flex justify-center items-center h-full border-2 border-yellow-500 rounded-xl bg-white">{{ $item['total_price_items'] }}€</p>
                    </div>
                    <form action="{{ route('delete.item', [$item['id']]) }}" class="col-span-1 text-white" method="post">
                        @csrf
                        <button>
                            <svg class="h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
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
        <div class="w-2/12 sticky top-52 h-96 flex flex-col items-center justify-around p-5 gap-y-6 shadow-3xl rounded-xl bg-yellow-500 border-2 border-white">
            <p class="text-4xl text-gray-800 text-center">Total <br> Commande</p>
            <p class="text-4xl text-gray-800 bg-white w-full h-full py-6 rounded-xl flex justify-center items-center">{{ session('cart_total', 0) }}€</p>

            <div class="w-full flex flex-col items-center gap-y-4">
                <a class="button" href="{{ route ('order.info') }}">Confirmer la commande</a>
                <a class="button" href="{{ route('order.flush') }}">Vider le Panier</a>
            </div>
        </div>
    </div>

@endsection

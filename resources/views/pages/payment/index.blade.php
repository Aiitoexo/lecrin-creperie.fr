@extends('layouts.default')

@section('main')
    <div class="mt-72 w-5/12 h-auto mx-auto bg-gray-800 border-2 border-yellow-500 rounded-xl px-6 pb-6 relative">
        <div class="w-full h-auto grid grid-cols-5 gap-x-10">
            <div class="col-span-2 text-white flex flex-col justify-evenly mt-8">
                <div>Nom : {{ $orderClient->last_name }}</div>
                <div>Prenom : {{ $orderClient->first_name }}</div>
                <div>Telephone : {{ $orderClient->phone }}</div>
                <div>E-mail : {{ $orderClient->mail }}</div>
                @if (session('type_command') === 'livraison')
                    <div>Adresse : {{ $orderClient->adresse }}</div>
                    <div>Code Postal : {{ $orderClient->postal }}</div>
                    <div>Ville : {{ $orderClient->city }}</div>
                @endif
                <div>Heure Commande : {{ $orderClient->created_at }}</div>
            </div>

            <div class="col-span-3">
                <h2 class="py-4 text-white text-2xl text-center">Récapitulatif Commande</h2>

                <div class="h-96 w-full bg-white rounded-xl border-2 border-yellow-500 flex flex-col">
                    @foreach ($commandClient as $item)
                        <div class="w-full flex justify-evenly grid grid-cols-4">
                            <p class="col-span-1">{{ $item['name'] }}</p>
                            <p class="col-span-1">{{ $item['price'] }}€</p>
                            <p class="col-span-1">x{{ $item['quantity'] }}</p>
                            <p class="col-span-1">{{ $item['total_price_items'] }}€</p>
                        </div>
                    @endforeach
                    <div>
                        <p>{{ $orderClient->price }}€</p>
                    </div>
                </div>


                <div class="w-full flex justify-evenly gap-x-14 pt-4">
                    <form class="w-full flex justify-center" action="{{ route('payment.info.edit', ['id' => session('id_order')]) }}" method="post">
                        @csrf
                        <button class="w-full bg-white py-2 rounded-full">Modifier</button>
                    </form>

                    <div class="w-full flex justify-center">
                        <button id="checkout-button" class="w-full bg-yellow-500 py-2 rounded-full">Payer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute -top-12 -left-4 bg-gray-800 w-2/5 py-3 rounded-xl border-2 border-yellow-500 text-lg text-white flex justify-center">
            Numero de commande : <br>
            {{ $orderClient->reference }}
        </div>
    </div>

    <button id="checkout-button"></button>
@endsection

@section('js')
    <script type="text/javascript">
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var checkoutButton = document.getElementById("checkout-button");

        checkoutButton.addEventListener("click", function () {
            fetch("{{ route('payment.process') }}", {
                method: "POST",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.head.querySelector("[name~=csrf-token][content]").content
                }
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (session) {
                    return stripe.redirectToCheckout({sessionId: session.id});
                })
                .then(function (result) {
                    // If redirectToCheckout fails due to a browser or network
                    // error, you should display the localized error message to your
                    // customer using error.message.
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(function (error) {
                    console.error("Error:", error);
                });
        });
    </script>
@endsection

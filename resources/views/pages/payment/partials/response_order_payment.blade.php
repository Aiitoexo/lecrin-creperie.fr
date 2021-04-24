<div class="w-full flex justify-center pb-6">
    <h2 class="text-3xl text-white">Commande {{ $result === 'success' ? 'Confirmer' : 'Echoue'}}</h2>
</div>

<div class="w-full grid grid-cols-7 gap-x-10">
    <div class="col-span-3 px-66">
        <p class="text-xl text-white mb-2 ml-2">Numéro de commande</p>
        <p class="w-full text-center bg-white py-2 rounded-full border-2 border-yellow-500">{{ $order->reference }}</p>
        @if ($result === 'success')
            <div class="w-full py-10">
                <p class="text-white text-center text-xl">Votre commande à est <br> enregistré ! <br> Elle est en cours de préparation <br> par notre cuisine un e-mail <br> vous sera envoyer <br> lorsque celle ci sera prête.</p>
            </div>
        @else
            <div class="py-10">
                <p class="text-white text-center text-xl">Votre commande à n’a pas était <br> enregistré ! <br> Le paiement à Echoué.</p>
            </div>
            <div class="w-full flex flex-col items-center gap-y-6">
                <button id="checkout-button" class="px-6 py-2 rounded-full bg-yellow-500">Reesayer le paiement</button>
                <form action="{{ route('payment.delete.command', ['id' => $order->id]) }}" method="post">
                    @csrf
                    <button class="px-6 py-2 rounded-full bg-white">Annuler la commande</button>
                </form>
            </div>
        @endif
    </div>
    <div class="col-span-4 h-full pb-10">
        <p class="text-xl text-white mb-2 ml-2">Récapitulatif Commande</p>
        <div class="w-full h-full bg-white border-2 border-yellow-500 rounded-2xl"></div>
    </div>
</div>

@if ($promo_active->promo_percentage === true)
    <p>Pour toute commande superieur avec {{ $promo_active->min_quantity }} items mini profiter de {{ $promo_active->percentage_discount }}% sur votre commande</p>
@elseif($promo_active->promo_price === true)
    <p>Pour toute commande superieur avec {{ $promo_active->min_quantity }} items mini profiter de {{ $promo_active->price_discount }}E sur votre commande</p>
@elseif($promo_active->promo_items === true)
    <div class="w-full h-full grid grid-cols-12">
        <p class="col-span-10">{{ $promo_active->description }}</p>
        <form class="col-span-2" action="">
            <button>En Profiter</button>
        </form>
    </div>
@endif

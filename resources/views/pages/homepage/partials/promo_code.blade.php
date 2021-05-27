@if ($promo_active->promo_percentage === true)
    <p>Avec le code {{ $promo_active->code }} profiter de {{ $promo_active->percentage_discount }}% sur votre commande</p>
@elseif($promo_active->promo_price === true)
    <p>Avec le code {{ $promo_active->code }} profiter de {{ $promo_active->percentage_discount }}E sur votre commande</p>
@endif

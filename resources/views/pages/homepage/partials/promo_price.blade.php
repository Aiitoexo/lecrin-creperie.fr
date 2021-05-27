@if ($promo_active->promo_percentage === true)
    <p>Pour toute commande superieur a {{ $promo_active->min_price }}E profiter de {{ $promo_active->percentage_discount }}% sur votre commande</p>
@elseif($promo_active->promo_price === true)
    <p>Pour toute commande superieur a {{ $promo_active->min_price }}E profiter de {{ $promo_active->percentage_discount }}E sur votre commande</p>
@elseif($promo_active->promo_items === true)
    <p>Pour toutes commande superieur a {{ $promo_active->min_price }}E, {{ $promo_active->max_items_discount }} items offert</p>
@endif

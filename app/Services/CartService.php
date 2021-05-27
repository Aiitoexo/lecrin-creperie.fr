<?php


namespace App\Services;


use App\Models\MenuItem;
use Illuminate\Support\Arr;
use function dd;
use function session;

class CartService
{
    public function addItem($id, int $quantity = 1)
    {
        $item = MenuItem::findOrFail($id);

        $cart = session('cart', []);

        $quantity = Arr::get($cart, $item->id.'.quantity', 0) + $quantity;

        $cart[$item->id] = [
            'id' => $item->id,
            'name' => $item->name,
            'tva' => $item->tvaItems->tva,
            'price_ht' => $item->price_ht,
            'total_tva' => $item->total_tva,
            'price_ttc' => $item->price_ttc,
            'img' => $item->img,
            'quantity' => $quantity,
            'total_price_items' => $item->price_ttc * $quantity,
        ];

        session()->put('cart', $cart);

        $this->totalPriceItems();
    }

    public function deleteItem(int $id)
    {
        $cart = session('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        $this->totalPriceItems();
    }

    public function lessItem($id)
    {

        $cart = session('cart');

        if ($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity'] -= 1;
            session()->put('cart', $cart);
            $this->totalPriceItems();
        }

    }

    public function moreItem($id)
    {

        $cart = session('cart');

        if ($cart[$id]['quantity'] < 100) {
            $cart[$id]['quantity'] += 1;
            session()->put('cart', $cart);
            $this->totalPriceItems();
        }

    }

    public function totalPriceItems()
    {
        $total = 0;
        $cart = session('cart', []);

        foreach ($cart as $id => $item) {
            $sub_total = $item['price_ttc'] * $item['quantity'];
            $cart[$id]['total_price_items'] = $sub_total;
            $total += $sub_total;
        }
        session()->put('cart', $cart);
        session()->put('cart_total', $total);

//        dd(session('type_command'));

        if (session('cart_total') < 40 && session('type_command') === 'livraison') {
            $total += 2;
            session()->put('cart_total', $total);
            session()->put('livraison_price', 'Frais de Livraison 2 euro');
        } elseif ( session('type_command') === 'emporter') {
            session()->forget('livraison_price');
        }

        if (session('cart_total') >= 40 && session('type_command') === 'livraison') {
            session()->put('livraison_price', 'Frais de livraison Gratuit');
        } elseif ( session('type_command') === 'emporter') {
            session()->forget('livraison_price');
        }
    }
}

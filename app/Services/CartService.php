<?php


namespace App\Services;


use App\Models\MenuItem;
use function session;

class CartService
{
    public function addItem($id, int $quantity = 1)
    {
        $item = MenuItem::findOrFail($id);

        $cart = session('cart', []);

        $cart[$item->id] = [
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price_ttc,
            'img' => $item->img,
            'quantity' => $quantity,
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

    public function lessItem($id) {

        $cart = session('cart');

        if ($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity'] -= 1;
            session()->put('cart', $cart);
            $this->totalPriceItems();
        }

    }

    public function moreItem($id) {

        $cart = session('cart');

        if ($cart[$id]['quantity'] < 100) {
            $cart[$id]['quantity'] += 1;
            session()->put('cart', $cart);
            $this->totalPriceItems();
        }

    }

    private function totalPriceItems()
    {
        $total = 0;
        $cart = session('cart', []);

        foreach ($cart as $id => $item) {
            $sub_total = $item['price'] * $item['quantity'];
            $cart[$id]['total_price_items'] = $sub_total;
            $total += $sub_total;
        }
        session()->put('cart', $cart);
        session()->put('cart_total', $total);
    }
}

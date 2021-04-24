<?php

use App\Models\Order;
use Illuminate\Support\Str;

if (!function_exists('getImageUrl')) {
    function getImageUrl($path)
    {
        $path = ltrim($path, '/');
        return asset('storage/'.$path);
    }
}

if (!function_exists('generateOrderReference')) {
    function generateOrderReference()
    {
        $string = Str::upper(Str::random(4));

        $date = now()->format('Ymd');

        $order_number = $date.$string;

        if (Order::where('reference', $order_number)->exists()) {
            return generateOrderReference();
        }

        return $order_number;
    }
}

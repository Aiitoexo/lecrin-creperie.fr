<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartOrder extends Model
{
    protected $fillable = [
        'order_id',
        'menu_item_id',
        'name',
        'detail',
        'tva',
        'price_ht',
        'total_tva',
        'price_ttc',
        'img',
        'quantity',
        'total_price_ht',
        'total_price_tva',
        'total_price_ttc',
    ];

    use HasFactory;

    public function order() {
        $this->belongsTo(Order::class);
    }
}

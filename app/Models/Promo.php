<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'active',
        'visible',
        'type_code',
        'type_quantity',
        'min_quantity',
        'max_quantity',
        'type_price',
        'min_price',
        'promo_percentage',
        'percentage_discount',
        'promo_price',
        'price_discount',
        'promo_items',
        'min_items_discount',
        'max_items_discount',
        'type_date',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'type_days',
        'mon',
        'tue',
        'wed',
        'thu',
        'fri',
        'sat',
        'sun',
    ];

    protected $casts = [
        'active' => 'boolean',
        'visible' => 'boolean',
        'type_code' => 'boolean',
        'type_quantity' => 'boolean',
        'type_price' => 'boolean',
        'type_date' => 'boolean',
        'type_days' => 'boolean',
        'promo_percentage' => 'boolean',
        'promo_price' => 'boolean',
        'promo_items' => 'boolean',
        'mon' => 'boolean',
        'tue' => 'boolean',
        'wed' => 'boolean',
        'thu' => 'boolean',
        'fri' => 'boolean',
        'sat' => 'boolean',
        'sun' => 'boolean',
    ];

    use HasFactory;
}

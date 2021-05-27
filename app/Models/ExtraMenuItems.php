<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraMenuItems extends Model
{
    protected $fillable = [
        'menu_id',
        'price_extra_ttc',
        'tva_id',
        'price_extra_tva',
        'price_extra_ht',
    ];

    use HasFactory;

    public function extraMenuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_id');
    }
}

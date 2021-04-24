<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllAllergen extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'img'
    ];

    public function isMenuAllergen()
    {
        return $this->belongsToMany(MenuItem::class, 'allergens', 'allergen', 'menu');
    }
}

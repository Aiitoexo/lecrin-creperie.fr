<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'img'
    ];

    public function isMenuAllergen()
    {
        return $this->belongsToMany(MenuItem::class, 'allergen_recipes', 'allergen_id', 'menu_id');
    }
}

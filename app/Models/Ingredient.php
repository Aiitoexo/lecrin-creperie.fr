<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_ingredients_id'
    ];

    public function isMenuIngredient()
    {
        return $this->belongsToMany(MenuItem::class, 'ingredient_recipes', 'ingredient_id', 'menu_id');
    }

    public function categoryIngredient() {
        return $this->belongsTo(CategoryIngredient::class, 'category_ingredients_id');
    }
}

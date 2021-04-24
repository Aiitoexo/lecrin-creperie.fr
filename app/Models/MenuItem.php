<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'img',
        'alt_img',
        'price',
        'section',
        'menu'
    ];

    use HasFactory;

    public function ingredientRecipe()
    {
        return $this->belongsToMany(AllIngredient::class, 'ingredients', 'menu', 'ingredient');
    }

    public function allergenRecipe()
    {
        return $this->belongsToMany(AllAllergen::class, 'allergens', 'menu', 'allergen');
    }

    public function sectionMenu()
    {
        return $this->belongsTo(SectionMenu::class, 'section');
    }
}

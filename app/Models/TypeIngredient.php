<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function isMenuIngredient()
    {
        return $this->belongsToMany(MenuItem::class, 'ingredients', 'ingredient', 'menu');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TypeAllergen;
use App\Models\TypeIngredient;
use function view;

class AdminController extends Controller
{
    public function index()
    {
        $all_allergens = TypeAllergen::all();
        $all_ingredients = TypeIngredient::all();

        return view('pages.admin.index', [
            'all_ingredients' => $all_ingredients,
            'all_allergens' => $all_allergens,
            'title' => 'Accueil | Admin'
        ]);
    }

}

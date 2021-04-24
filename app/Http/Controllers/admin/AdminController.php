<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AllAllergen;
use App\Models\AllIngredient;
use function view;

class AdminController extends Controller
{
    public function index()
    {
        $all_allergens = AllAllergen::all();
        $all_ingredients = AllIngredient::all();

        return view('pages.admin.index', [
            'all_ingredients' => $all_ingredients,
            'all_allergens' => $all_allergens,
            'title' => 'Accueil | Admin'
        ]);
    }

}

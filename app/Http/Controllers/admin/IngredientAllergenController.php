<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Allergen;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use function date;
use function redirect;
use function route;
use function sprintf;
use function storage_path;
use function str_replace;
use function view;


//TODO refactore les function ingredient et alergen dans une seul fuinction
class IngredientAllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_ingredients = Ingredient::all();
        $all_allergens = Allergen::all();

        return view('pages.admin.ingredient_allergen.index', [
            'all_ingredients' => $all_ingredients,
            'all_allergens' => $all_allergens,
            'title' => 'IngredientRecipe AllergenRecipe | Admin'
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ingredient_store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:type_ingredients,name',
            'img' => 'required|image'
        ]);

        $data_name = str_replace(" ", "", $data['name']);

        $file_name = sprintf('%s-%s.%s', $data_name, date('d.m.y'),
            $request->file('img')->getClientOriginalExtension());
        $request->file('img')->move(storage_path('app/public/img_ingredients'), $file_name);

        $data['img'] = sprintf('storage/img_ingredients/%s', $file_name);

        Ingredient::create($data);

        return redirect(route('admin.ingredient.allergen'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allergen_store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:type_allergens,name',
            'img' => 'required|image'
        ]);

        $data_name = str_replace(" ", "", $data['name']);

        $file_name = sprintf('%s-%s.%s', $data_name, date('d.m.y'),
            $request->file('img')->getClientOriginalExtension());
        $request->file('img')->move(storage_path('app/public/img_allergens'), $file_name);

        $data['img'] = sprintf('storage/img_allergens/%s', $file_name);

        Allergen::create($data);

        return redirect(route('admin.ingredient.allergen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ingredient_edit($id)
    {
        $ingredient_item = Ingredient::findOrFail($id);
        $all_ingredients = Ingredient::all();
        $all_allergens = Allergen::all();

        return view('pages.admin.ingredient_allergen.index', [
            'ingredient_item' => $ingredient_item,
            'all_ingredients' => $all_ingredients,
            'all_allergens' => $all_allergens,
            'title' => 'IngredientRecipe AllergenRecipe | Admin'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allergen_edit($id)
    {
        $allergen_item = Allergen::findOrFail($id);
        $all_ingredients = Ingredient::all();
        $all_allergens = Allergen::all();

        return view('pages.admin.ingredient_allergen.index', [
            'allergen_item' => $allergen_item,
            'all_ingredients' => $all_ingredients,
            'all_allergens' => $all_allergens,
            'title' => 'IngredientRecipe AllergenRecipe | Admin'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ingredient_update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($data);

        return redirect(route('admin.ingredient.allergen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allergen_update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'img' => 'image'
        ]);


        $ingredient = Allergen::findOrFail($id);
        $ingredient->update($data);

        return redirect(route('admin.ingredient.allergen'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ingredient_destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allergen_destroy($id)
    {
        $ingredient = Allergen::findOrFail($id);
        $ingredient->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Allergen;
use App\Models\AllergenRecipe;
use App\Models\ExtraMenuItems;
use App\Models\Ingredient;
use App\Models\IngredientRecipe;
use App\Models\MenuItem;
use App\Models\SectionMenu;
use App\Models\TvaRestaurant;
use Illuminate\Http\Request;
use function date;
use function floatval;
use function redirect;
use function route;
use function sprintf;
use function storage_path;
use function str_replace;
use function view;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $all_sections = SectionMenu::all();
        $all_ingredients = Ingredient::all();
        $all_allergens = Allergen::all();
        $all_items_menu = MenuItem::all();
        $all_tva = TvaRestaurant::all();
        $all_extra_items = ExtraMenuItems::all();

        if ($request['section_id'] && $request['section_id'] !== 0) {
            $section = $request['section_id'];
            $all_items_menu = MenuItem::where('section_id', $section)->get();
        }

        return view('pages.admin.recipe.index', [
            'all_sections' => $all_sections,
            'all_ingredients' => $all_ingredients,
            'all_allergens' => $all_allergens,
            'all_items_menu' => $all_items_menu,
            'all_tva' => $all_tva,
            'all_extra_items' => $all_extra_items,
            'title' => 'Recette | Admin',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['price_ht'] = floatval(str_replace(',', '.', $request['price_ht']));

        $data = $request->validate([
            'name' => 'required|string|unique:menu_items,id',
            'img' => 'required|image',
            'alt_img' => 'required|string',
            'price_ht' => 'required|numeric',
            'tva_id' => 'required|integer|exists:tva_restaurants,id',
            'section_id' => 'required|integer|exists:section_menus,id',
            'ingredients' => 'required|array',
            'allergens' => 'required|array',
            'menu' => 'required|boolean'
        ]);


        $tva = TvaRestaurant::findOrFail($data['tva_id']);

        $data['total_tva'] = ($data['price_ht'] * $tva->tva) / 100;
        $data['price_ttc'] = $data['price_ht'] + $data['total_tva'];

        $data_name = str_replace(" ", "", $data['name']);

        $file_name = sprintf('%s-%s.%s', $data_name, date('d-m-y'),
            $request->file('img')->getClientOriginalExtension());
        $request->file('img')->move(storage_path('app/public/img_menu_item'), $file_name);

        $data['img'] = sprintf('img_menu_item/%s', $file_name);

        $menu_item = MenuItem::create($data);

        $data_ingredients = $data['ingredients'];
        $data_allergens = $data['allergens'];

        foreach ($data_ingredients as $ingredient) {
            IngredientRecipe::create([
                'menu_id' => $menu_item->id,
                'ingredient_id' => $ingredient
            ]);
        }

        foreach ($data_allergens as $allergen) {
            AllergenRecipe::create([
                'menu_id' => $menu_item->id,
                'allergen_id' => $allergen
            ]);
        }

        if ($request['extra']) {
            $data_extra = $request->validate([
                'price_extra_ht' => 'required|numeric',
            ]);
        }

        $data_extra['menu_id'] = $menu_item->id;
        $data_extra['tva_id'] = $tva->id;
        $data_extra['price_extra_tva'] = ($data_extra['price_extra_ht'] * $tva->tva) / 100;
        $data_extra['price_extra_ttc'] = $data_extra['price_extra_ht'] + $data_extra['price_extra_tva'];

        $extra = ExtraMenuItems::create($data_extra);

        return redirect(route('admin.recipe'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu_item = MenuItem::findOrFail($id);

        if ($menu_item->active === true) {
            $menu_item->active = false;
        } else {
            $menu_item->active = true;
        }

        $menu_item->update();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $all_sections = SectionMenu::all();
        $all_ingredients = Ingredient::all();
        $all_allergens = Allergen::all();
        $all_items_menu = MenuItem::all();
        $all_tva = TvaRestaurant::all();
        $all_extra_items = ExtraMenuItems::all();

        $data = ExtraMenuItems::where('menu_id', $id)->first();
        if ($data !== null) {
            $extra_menu_item = $data;
        } else {
            $extra_menu_item = null;
        }

        $item_menu = MenuItem::findOrFail($id);

        if ($request['section'] && $request['section'] !== 0) {
            $section = $request['section'];
            $all_items_menu = MenuItem::where('section', $section)->get();
        }

        return view('pages.admin.recipe.index', [
            'all_sections' => $all_sections,
            'all_ingredients' => $all_ingredients,
            'all_allergens' => $all_allergens,
            'all_items_menu' => $all_items_menu,
            'all_extra_items' => $all_extra_items,
            'all_tva' => $all_tva,
            'item_menu' => $item_menu,
            'extra_menu_item' => $extra_menu_item,
            'title' => 'Recette | Admin',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['price_ht'] = floatval(str_replace(',', '.', $request['price_ht']));

        $data = $request->validate([
            'name' => 'required|string|unique:menu_items,id',
            'img' => 'image',
            'alt_img' => 'required|string',
            'price_ht' => 'required|numeric',
            'tva_id' => 'required|integer|exists:tva_restaurants,id',
            'section_id' => 'required|integer|exists:section_menus,id',
            'ingredients' => 'required|array',
            'allergens' => 'required|array',
            'menu' => 'required|boolean'
        ]);

        $tva = TvaRestaurant::findOrFail($data['tva_id']);

        $data['total_tva'] = ($data['price_ht'] * $tva->tva) / 100;
        $data['price_ttc'] = $data['price_ht'] + $data['total_tva'];

        if (isset($request['img'])) {
            $data_name = str_replace(" ", "", $data['name']);

            $file_name = sprintf('%s-%s.%s', $data_name, date('d-m-y'), $request->file('img')->getClientOriginalExtension());
            $request->file('img')->move(storage_path('app/public/img_menu_item'), $file_name);

            $data['img'] = sprintf('img_menu_item/%s', $file_name);
        }

        $menu_item = MenuItem::findOrFail($id);
        $menu_item->update($data);

        if ($request['extra'] === null) {
            $extra = ExtraMenuItems::where('menu_id', $id);
            $extra->delete();
        } else {
            $extra_delete = ExtraMenuItems::where('menu_id', $id);
            $extra_delete->delete();

            $data_extra = $request->validate([
                'price_extra_ht' => 'required|numeric',
            ]);

            $data_extra['menu_id'] = $menu_item->id;
            $data_extra['tva_id'] = $tva->id;
            $data_extra['price_extra_tva'] = ($data_extra['price_extra_ht'] * $tva->tva) / 100;
            $data_extra['price_extra_ttc'] = $data_extra['price_extra_ht'] + $data_extra['price_extra_tva'];

            $extra = ExtraMenuItems::create($data_extra);
        }

        $all_ingredients_item = IngredientRecipe::where('menu_id', $menu_item->id)->get();
        $all_allergens_item = AllergenRecipe::where('menu_id', $menu_item->id)->get();

        foreach ($all_ingredients_item as $ingredient_item) {
            $ingredient = IngredientRecipe::findOrFail($ingredient_item->id);
            $ingredient->delete();
        }

        foreach ($all_allergens_item as $allergen_item) {
            $allergen = AllergenRecipe::findOrFail($allergen_item->id);
            $allergen->delete();
        }

        $data_ingredients = $data['ingredients'];
        $data_allergens = $data['allergens'];

        foreach ($data_ingredients as $ingredient) {
            IngredientRecipe::create([
                'menu_id' => $menu_item->id,
                'ingredient_id' => $ingredient
            ]);
        }

        foreach ($data_allergens as $allergen) {
            AllergenRecipe::create([
                'menu_id' => $menu_item->id,
                'allergen_id' => $allergen
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_extra($id)
    {
        $extra_item = ExtraMenuItems::findOrFail($id);
        $extra_item->delete();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $allergen = AllergenRecipe::where('menu_id', $id);
        $ingredient = IngredientRecipe::where('menu_id', $id);
        $extra_item = ExtraMenuItems::where('menu_id', $id);
        $menu_item = MenuItem::findOrFail($id);
        $allergen->delete();
        $ingredient->delete();
        $extra_item->delete();
        $menu_item->delete();
        return redirect()->back();
    }
}

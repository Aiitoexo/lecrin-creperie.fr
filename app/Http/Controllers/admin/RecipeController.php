<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AllergenRecipe;
use App\Models\IngredientRecipe;
use App\Models\MenuItem;
use App\Models\SectionMenu;
use App\Models\Allergen;
use App\Models\Ingredient;
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

        if ($request['section'] && $request['section'] !== 0) {
            $section = $request['section'];
            $all_items_menu = MenuItem::where('section', $section)->get();
        }

        return view('pages.admin.recipe.index', [
            'all_sections' => $all_sections,
            'all_ingredients' => $all_ingredients,
            'all_allergens' => $all_allergens,
            'all_items_menu' => $all_items_menu,
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


        $data = $request->validate([
            'name' => 'required|string|unique:menu_items,id',
            'img' => 'required|image',
            'alt_img' => 'required|string',
            'price' => 'required|string',
            'section' => 'required|integer|exists:section_menus,id',
            'ingredients' => 'required|array',
            'allergens' => 'required|array',
            'menu' => 'required|boolean'
        ]);

        $data['price'] = floatval(str_replace(',', '.', $data['price']));

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
                'menu' => $menu_item->id,
                'ingredient' => $ingredient
            ]);
        }

        foreach ($data_allergens as $allergen) {
            AllergenRecipe::create([
                'menu' => $menu_item->id,
                'allergen' => $allergen
            ]);
        }

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
        //
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
            'title' => 'Recette | Admin',
            'item_menu' => $item_menu,
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
        $data = $request->validate([
            'name' => 'string|unique:menu_items,id',
            'img' => 'image',
            'price' => 'string',
            'section' => 'integer|exists:section_menus,id',
            'ingredients' => 'array',
            'allergens' => 'array',
            'menu' => 'boolean'
        ]);

        $data['price'] = floatval(str_replace(',', '.', $data['price']));

        $data_name = str_replace(" ", "", $data['name']);

        $file_name = sprintf('%s-%s.%s', $data_name, date('d-m-y'), $request->file('img')->getClientOriginalExtension());
        $request->file('img')->move(storage_path('app/public/img_menu_item'), $file_name);

        $data['img'] = sprintf('img_menu_item/%s', $file_name);

        $item = MenuItem::findOrFail($id);
        $item->update($data);

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
        $allergen = AllergenRecipe::where('menu', $id);
        $ingredient = IngredientRecipe::where('menu', $id);
        $menu_item = MenuItem::findOrFail($id);
        $allergen->delete();
        $ingredient->delete();
        $menu_item->delete();
        return redirect()->back();
    }
}

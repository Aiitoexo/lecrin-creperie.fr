<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ActiveExtra;
use App\Models\ActiveTypeCommand;
use App\Models\Allergen;
use App\Models\CategoryDrink;
use App\Models\CategoryIngredient;
use App\Models\Ingredient;
use App\Models\Postal;
use App\Models\TvaRestaurant;
use Illuminate\Http\Request;
use function date;
use function dd;
use function intval;
use function redirect;
use function route;
use function sprintf;
use function storage_path;
use function str_replace;
use function view;


//TODO refactore les function ingredient et alergen dans une seul fuinction
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $all_ingredients = Ingredient::all();
        $all_allergens = Allergen::all();
        $all_category_ingredient = CategoryIngredient::all();
        $all_category_drink = CategoryDrink::all();
        $all_tva = TvaRestaurant::all();
        $all_postal_code = Postal::all();
        $id_category = null;
        $active_command = ActiveTypeCommand::latest()->first();
        $active_extras = ActiveExtra::first();

        if (isset($request['category']) && $request['category'] > 0) {
            $all_ingredients = Ingredient::where('category_ingredients_id', $request['category'])->get();
            $id_category = $request['category'];
        }
//        && $request->validate(['category' => 'numeric|exists:category_ingredients,id'])
        return view('pages.admin.settings.index', [
            'all_ingredients' => $all_ingredients,
            'all_allergens' => $all_allergens,
            'all_category_ingredient' => $all_category_ingredient,
            'all_category_drink' => $all_category_drink,
            'all_postal_code' => $all_postal_code,
            'id_category' => $id_category,
            'all_tva' => $all_tva,
            'active_command' => $active_command,
            'active_extras' => $active_extras,
            'title' => 'Settings | Admin'
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function tva_store(Request $request)
    {
        $data = $request->validate([
            'name_tva' => 'required|unique:tva_restaurants,name_tva',
            'tva' => 'required|numeric'
        ]);

        TvaRestaurant::create($data);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function tva_update(Request $request, $id)
    {
        $request['tva'] = floatval(str_replace(',', '.', $request['tva']));

        $data = $request->validate([
            'id_tva' => 'required|exists:tva_restaurants,id',
            'name_tva' => 'required|string',
            'tva' => 'required|numeric'
        ]);


        $tva_restaurant = TvaRestaurant::findOrFail($id);
        $tva_restaurant->update($data);

        return redirect()->route('admin.settings.ingredient.allergen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function tva_destroy($id)
    {
        $tva_restaurant = TvaRestaurant::findOrFail($id);
        $tva_restaurant->delete();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postal_store(Request $request)
    {
        $data = $request->validate([
            'postal_code' => 'required|unique:postals,postal_code',
        ]);

        Postal::create($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function postal_destroy($id)
    {
        $postal_code = Postal::findOrFail($id);
        $postal_code->delete();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function category_ingredient_store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|unique:category_ingredients,category',
        ]);

        CategoryIngredient::create($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function category_ingredient_destroy($id)
    {
        $category = CategoryIngredient::findOrFail($id);
        $ingredient = Ingredient::where('category_ingredients_id', $id);
        $category->delete();
        $ingredient->delete();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function category_boisson_store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|unique:category_drinks,category',
        ]);

        CategoryDrink::create($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function category_boisson_destroy($id)
    {
        $category = CategoryDrink::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function ingredient_store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:ingredients,name',
            'category_ingredients_id' => 'required|integer|exists:category_ingredients,id'
        ]);

        Ingredient::create($data);

        return redirect(route('admin.settings.ingredient.allergen'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function allergen_store(Request $request)
    {
//        dd($request['img']);
        $data = $request->validate([
            'name' => 'required|string|unique:allergens,name',
            'img' => 'required|image'
        ]);

        $data_name = str_replace(" ", "", $data['name']);

        $file_name = sprintf('%s-%s.%s', $data_name, date('d.m.y'),
            $request->file('img')->getClientOriginalExtension());
        $request->file('img')->move(storage_path('app/public/img_allergens'), $file_name);

        $data['img'] = sprintf('storage/img_allergens/%s', $file_name);

        Allergen::create($data);

        return redirect(route('admin.settings.ingredient.allergen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function ingredient_update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category_ingredients_id' => 'required|integer|exists:category_ingredients,id'
        ]);

        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($data);

        return redirect()->route('admin.settings.ingredient.allergen');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function allergen_update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string',
            'img' => 'image'
        ]);

        if (!empty($request['img'])) {
            $data_name = str_replace(" ", "", $data['name']);

            $file_name = sprintf('%s-%s.%s', $data_name, date('d.m.y'),
                $request->file('img')->getClientOriginalExtension());
            $request->file('img')->move(storage_path('app/public/img_allergens'), $file_name);

            $data['img'] = sprintf('storage/img_allergens/%s', $file_name);
        }

        $allergen = Allergen::findOrFail($id);
        $allergen->update($data);

        return redirect()->route('admin.settings.ingredient.allergen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function allergen_destroy($id)
    {
        $ingredient = Allergen::findOrFail($id);
        $ingredient->delete();
        return redirect()->back();
    }

    public function active_command(Request $request)
    {
        $active_command = ActiveTypeCommand::latest()->first();

        if (isset($request['active_command_livraison'])) {
            $data = $request->validate([
                'active_command_livraison' => 'boolean'
            ]);

            $data['active_command_emporter'] = $active_command['active_command_emporter'];

            ActiveTypeCommand::create($data);
        }

        if (isset($request['active_command_emporter'])) {
            $data = $request->validate([
                'active_command_emporter' => 'boolean'
            ]);

            $data['active_command_livraison'] = $active_command['active_command_livraison'];

            ActiveTypeCommand::create($data);
        }

        return redirect()->back();
    }

    public function active_extras(Request $request)
    {
        if (isset($request['active_extras'])) {
            $data = $request->validate([
                'active_extras' => 'boolean'
            ]);

            $active_extras = ActiveExtra::first();
            $active_extras->update($data);
        }

        return redirect()->back();
    }
}

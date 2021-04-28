<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Allergen;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\TvaRestaurant;
use Illuminate\Http\Request;
use function redirect;
use function view;

class AdminController extends Controller
{
    public function index()
    {
        $all_tva = TvaRestaurant::all();
//        $command_available = Order::all()->where('st')

        return view('pages.admin.index', [
            'title' => 'Accueil | Admin',
            'all_tva' => $all_tva,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tva_store(Request $request) {
        $data = $request->validate([
            'name_tva' => 'required|unique:tva_restaurants,name_tva',
            'tva' => 'required|numeric'
        ]);

        TvaRestaurant::create($data);

        return redirect()->back();
    }
}

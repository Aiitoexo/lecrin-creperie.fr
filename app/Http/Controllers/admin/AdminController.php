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

//        $command_available = Order::all()->where('st')

        return view('pages.admin.index', [
            'title' => 'Accueil | Admin',
        ]);
    }

}

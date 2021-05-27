<?php

namespace App\Http\Controllers;

use App\Models\ActiveTypeCommand;
use App\Models\Promo;
use App\Services\CartService;
use App\Services\PromoService;
use Illuminate\Http\Request;
use function date;
use function dd;
use function view;

class HomeController extends Controller
{
    public function index(CartService $cart, Request $request)
    {
        $active_command = ActiveTypeCommand::latest()->first();

        return view('pages.homepage.index', [
            'active_command' => $active_command,
        ]);
    }
}

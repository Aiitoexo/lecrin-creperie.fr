<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use function session;
use function view;

class HomeController extends Controller
{
    public function index(CartService $cart, Request $request)
    {
        return view('pages.homepage.index');
    }
}

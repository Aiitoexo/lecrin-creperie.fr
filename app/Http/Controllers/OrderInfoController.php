<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use function dd;
use function json_encode;
use function now;
use function redirect;
use function route;
use function session;
use function Symfony\Component\String\s;
use function view;

class OrderInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.panier.order_info', [
        ]);
    }

    public function flush_cart() {
        session()->forget('cart');
        return redirect(route('carte'));
    }

}

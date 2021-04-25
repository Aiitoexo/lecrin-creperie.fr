<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function back;
use function redirect;
use function route;
use function session;
use function view;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('pages.cart.index', [
            'cart' => session('cart')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CartService $cart, Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:menu_items,id',
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        $cart->addItem($data['id'], $data['quantity']);

        return redirect(route('menu'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(CartService $cart, $id)
    {
        $cart->deleteItem($id);

        return back();
    }

    public function lessItem(CartService $cart, $id)
    {
        $cart->lessItem($id);

        return back();
    }

    public function moreItem(CartService $cart, $id)
    {
        $cart->moreItem($id);

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use function back;
use function redirect;
use function route;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
    public function store(CartService $cart, Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:menu_items,id',
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        $cart->addItem($data['id'], $data['quantity']);

        return redirect(route('carte'));
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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

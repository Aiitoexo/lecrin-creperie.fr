<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\SectionMenu;
use Illuminate\Http\Request;
use function count;
use function dd;
use function session;
use function view;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bad_postal = session('bad_postal');

        $all_sections = SectionMenu::all();
        $all_burgers = MenuItem::all()->where('section_id', 1);
        $all_wraps = MenuItem::all()->where('section_id', 2);
        $all_desserts = MenuItem::all()->where('section_id', 3);
        $all_boissons = MenuItem::all()->where('section_id', 4);
        $all_box_aperos = MenuItem::all()->where('section_id', 5);

        $cart = session('cart');
        $count_cart = 0;

        foreach ($cart as $item) {
            $count_cart += $item['quantity'];
        }

        return view('pages.menu.index', [
            'all_sections' => $all_sections,
            'all_burgers' => $all_burgers,
            'all_wraps' => $all_wraps,
            'all_desserts' => $all_desserts,
            'all_boissons' => $all_boissons,
            'all_box_aperos' => $all_box_aperos,
            'cart' => session('cart'),
            'bad_postal' => $bad_postal,
            'count_cart' => $count_cart
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
        //
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
    public function destroy($id)
    {
        //
    }
}

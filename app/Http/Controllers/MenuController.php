<?php

namespace App\Http\Controllers;

use App\Models\ActiveExtra;
use App\Models\ActiveTypeCommand;
use App\Models\Drink;
use App\Models\MenuItem;
use App\Models\SectionMenu;
use App\Services\PromoService;
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
    public function index(Request $request, PromoService $promo)
    {
        $all_promos_active = $promo->active_promo();

        $bad_postal = session('bad_postal');

        $active_command = ActiveTypeCommand::latest()->first();

        $all_sections = SectionMenu::all();
        $all_menus = MenuItem::all()->where('menu', true)->where('active', true);
        $all_burgers = MenuItem::all()->where('section_id', 1)->where('active', true);
        $all_wraps = MenuItem::all()->where('section_id', 2)->where('active', true);
        $all_enfant_burgers = MenuItem::all()->where('section_id', 3)->where('active', true);
        $all_box_aperos = MenuItem::all()->where('section_id', 4)->where('active', true);
        $all_accompagnements = MenuItem::all()->where('section_id', 5)->where('active', true);
        $all_desserts = MenuItem::all()->where('section_id', 6)->where('active', true);
        $all_boissons = MenuItem::all()->where('section_id', 7)->where('active', true);

        $active_extras = ActiveExtra::first();

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
            'all_accompagnements' => $all_accompagnements,
            'all_menus' =>  $all_menus,
            'all_enfant_burgers' => $all_enfant_burgers,
            'cart' => session('cart'),
            'bad_postal' => $bad_postal,
            'count_cart' => $count_cart,
            'active_command' => $active_command,
            'active_extras' => $active_extras,
            'all_promos_active' => $all_promos_active,
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

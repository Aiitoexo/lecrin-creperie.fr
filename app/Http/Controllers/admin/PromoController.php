<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FreeItemPromo;
use App\Models\ItemPromo;
use App\Models\Promo;
use App\Models\PromoCode;
use App\Models\SectionMenu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function date;
use function dd;
use function redirect;
use function strtolower;
use function view;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd( strtolower(date('D', )));

        $all_sections = SectionMenu::all();
        $all_promos = Promo::where('active', true)->get();

        return view('pages.admin.promo.index', [
            'title' => 'Admin | Promos',
            'all_sections' => $all_sections,
            'all_promos' => $all_promos,
        ]);
    }

    public function create_promo(Request $request)
    {
        if ($request['type_promo_section'] === 'promo_code') {
            $this->create_promo_code($request);
            return redirect()->route('admin.promo');
        }

        if ($request['type_promo_section'] === 'promo_quantity') {
            $this->create_promo_quantity($request);
            return redirect()->route('admin.promo');
        }

        if ($request['type_promo_section'] === 'promo_price') {
            $this->create_promo_price($request);
            return redirect()->route('admin.promo');
        }
    }

    public function create_promo_code($request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:promos,code',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after:start_date',
            'end_time' => 'required|date_format:H:i',
        ]);

        $data['type_code'] = true;
        $data['type_date'] = true;

        if (isset($request['type_percentage'])) {
            $data_type = $request->validate([
                'type_percentage' => 'required|numeric'
            ]);
            $data['promo_percentage'] = true;
            $data['promo_price'] = false;
            $data['percentage_discount'] = $data_type['type_percentage'];
        }

        if (isset($request['type_price'])) {
            $data_type = $request->validate([
                'type_price' => 'required|numeric'
            ]);
            $data['promo_price'] = true;
            $data['promo_percentage'] = false;
            $data['price_discount'] = $data_type['type_price'];
        }

        Promo::create($data);
    }

    public function create_promo_quantity($request)
    {
        $type_promo = ['percentage', 'price', 'items'];
        $type_date = ['date', 'days'];

        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:promos,code',
            'description' => 'required|string',
            'min_quantity' => 'required|numeric|min:1|lte:max_quantity',
            'max_quantity' => 'required|numeric|gte:min_quantity',
        ]);

        $data['type_quantity'] = true;

        $data_items = $request->validate([
            'menu_items_id' => 'required|array',
            'menu_items_id.*.id' => 'exists:menu_items,id',
        ]);

        $data_type = $request->validate([
            'type_promo' => ['required', 'string', Rule::in($type_promo)],
            'type_date' => ['required', 'string', Rule::in($type_date)],
        ]);

        if ($data_type['type_promo'] === $type_promo[0]) {
            $data_type_promo = $request->validate([
                'type_percentage' => 'required|numeric',
            ]);
            $data['promo_percentage'] = true;
            $data['percentage_discount'] = $data_type_promo['type_percentage'];
        }

        if ($data_type['type_promo'] === $type_promo[1]) {
            $data_type_promo = $request->validate([
                'type_price' => 'required|numeric',
            ]);
            $data['promo_price'] = true;
            $data['price_discount'] = $data_type_promo['type_price'];
        }

        if ($data_type['type_promo'] === $type_promo[2]) {
            $data_free_items = $request->validate([
                'free_menu_items_id' => 'required|array',
                'free_menu_items_id.*.id' => 'exists:menu_items,id',
            ]);

            $data_promo = $request->validate([
                'free_min_items' => 'required|numeric|min:1|lte:free_max_items',
                'free_max_items' => 'required|numeric|gte:free_min_items',
            ]);
            $data['promo_items'] = true;
            $data['min_items_discount'] = $data_promo['free_min_items'];
            $data['max_items_discount'] = $data_promo['free_max_items'];
        }

        if ($data_type['type_date'] === $type_date[0]) {
            $data_date = $request->validate([
                'start_date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_date' => 'required|date|after:start_date',
                'end_time' => 'required|date_format:H:i',
            ]);
            $data['type_date'] = true;
            $data['start_date'] = $data_date['start_date'];
            $data['start_time'] = $data_date['start_time'];
            $data['end_date'] = $data_date['end_date'];
            $data['end_time'] = $data_date['end_time'];
        }

        if ($data_type['type_date'] === $type_date[1]) {
            $data_days = $request->validate([
                'days' => 'required|array'
            ]);
            $data['type_days'] = true;

            foreach ($data_days['days'] as $day) {
                switch ($day) {
                    case 'monday' :
                        $data['mon'] = true;
                        break;
                    case 'tuesday' :
                        $data['tue'] = true;
                        break;
                    case 'wednesday' :
                        $data['wed'] = true;
                        break;
                    case 'thursday' :
                        $data['thu'] = true;
                        break;
                    case 'friday' :
                        $data['fri '] = true;
                        break;
                    case 'saturday' :
                        $data['sat'] = true;
                        break;
                    case 'sunday' :
                        $data['sun'] = true;
                        break;
                }
            }
        }

        $promo = Promo::create($data);

        if (isset($data_items)) {
            foreach ($data_items['menu_items_id'] as $item) {
                ItemPromo::create([
                    'promos_id' => $promo->id,
                    'menu_items_id' => $item
                ]);
            }
        }

        if (isset($data_free_items)) {
            foreach ($data_free_items['free_menu_items_id'] as $item) {
                FreeItemPromo::create([
                    'promos_id' => $promo->id,
                    'menu_items_id' => $item
                ]);
            }
        }
    }

    public function create_promo_price($request) {
        $type_promo = ['percentage', 'price', 'items'];
        $type_date = ['date', 'days'];

        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:promos,code',
            'description' => 'required|string',
            'min_price' => 'required|numeric'
        ]);

        $data['type_price'] = true;

        $data_type = $request->validate([
            'type_promo' => ['required', 'string', Rule::in($type_promo)],
            'type_date' => ['required', 'string', Rule::in($type_date)],
        ]);

        if ($data_type['type_promo'] === $type_promo[0]) {
            $data_type_promo = $request->validate([
                'type_percentage' => 'required|numeric',
            ]);
            $data['promo_percentage'] = true;
            $data['percentage_discount'] = $data_type_promo['type_percentage'];
        }

        if ($data_type['type_promo'] === $type_promo[1]) {
            $data_type_promo = $request->validate([
                'type_price' => 'required|numeric',
            ]);
            $data['promo_price'] = true;
            $data['price_discount'] = $data_type_promo['type_price'];
        }

        if ($data_type['type_promo'] === $type_promo[2]) {
            $data_free_items = $request->validate([
                'free_menu_items_id' => 'required|array',
                'free_menu_items_id.*.id' => 'exists:menu_items,id',
            ]);

            $data_promo = $request->validate([
                'free_min_items' => 'required|numeric|min:1|lte:free_max_items',
                'free_max_items' => 'required|numeric|gte:free_min_items',
            ]);
            $data['promo_items'] = true;
            $data['min_items_discount'] = $data_promo['free_min_items'];
            $data['max_items_discount'] = $data_promo['free_max_items'];
        }

        if ($data_type['type_date'] === $type_date[0]) {
            $data_date = $request->validate([
                'start_date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_date' => 'required|date|after:start_date',
                'end_time' => 'required|date_format:H:i',
            ]);
            $data['type_date'] = true;
            $data['start_date'] = $data_date['start_date'];
            $data['start_time'] = $data_date['start_time'];
            $data['end_date'] = $data_date['end_date'];
            $data['end_time'] = $data_date['end_time'];
        }

        if ($data_type['type_date'] === $type_date[1]) {
            $data_days = $request->validate([
                'days' => 'required|array'
            ]);
            $data['type_days'] = true;
            foreach ($data_days['days'] as $day) {
                switch ($day) {
                    case 'monday' :
                        $data['mon'] = true;
                        break;
                    case 'tuesday' :
                        $data['tue'] = true;
                        break;
                    case 'wednesday' :
                        $data['wed'] = true;
                        break;
                    case 'thursday' :
                        $data['thu'] = true;
                        break;
                    case 'friday' :
                        $data['fri'] = true;
                        break;
                    case 'saturday' :
                        $data['sat'] = true;
                        break;
                    case 'sunday' :
                        $data['sun'] = true;
                        break;
                }
            }
        }

        $promo = Promo::create($data);

        if (isset($data_free_items)) {
            foreach ($data_free_items['free_menu_items_id'] as $item) {
                FreeItemPromo::create([
                    'promos_id' => $promo->id,
                    'menu_items_id' => $item
                ]);
            }
        }
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

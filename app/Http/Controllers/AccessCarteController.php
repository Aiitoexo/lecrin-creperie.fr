<?php

namespace App\Http\Controllers;

use App\Models\Postal;
use Illuminate\Http\Request;
use function redirect;
use function route;
use function session;
use function view;

class AccessCarteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.menu.access_carte');
    }

    public function verification(Request $request)
    {
        $type_command = $request->validate([
            'type_command' => 'string|required',
            'postal_code' => 'numeric'
        ]);

        if ($request['type_command'] == 'emporter') {

            session()->put('type_command', $type_command['type_command']);
            return redirect(route('menu'));

        } elseif ($request['type_command'] == 'livraison') {

            if (Postal::where('postal_code', $type_command['postal_code'])->exists()) {

                session()->put('type_command', $type_command['type_command']);
                return  redirect(route('menu'));

            } else {

                session()->flash('bad_postal', 'Cette commune n\'est pas prise en charge pour la livraison');
                return redirect(route('menu'));

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

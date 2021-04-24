<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use function array_values;
use function dd;
use function redirect;
use function response;
use function view;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.command.index', [
            'title' => 'Commande | Admin',
        ]);
    }

    public function command_emporter()
    {
        $result_command_emporter = Order::where('status', 'IN_PROGRESS')->where('type_command', 'emporter')->get()->map(function ($commande){
            $commande->command = array_values($commande->command);
            return $commande;
        })->toArray();

        return response()->json($result_command_emporter);
    }

    public function command_livraison()
    {
        $result_command_livraison = Order::where('status', 'IN_PROGRESS')->where('type_command', 'livraison')->get()->map(function ($commande){
            $commande->command = array_values($commande->command);
            return $commande;
        })->toArray();

        return response()->json($result_command_livraison);
    }

    public function complete(Request $request)
    {
        $data['status'] = Order::FINISHED;

        $item = Order::findOrFail($request['id']);
        $item->update($data);

        return redirect()->back();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

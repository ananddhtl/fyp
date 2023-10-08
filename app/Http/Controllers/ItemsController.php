<?php

namespace App\Http\Controllers;

use App\Models\items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = \DB::table('items')->get();
        return view('frontend.items.list', compact('data'));
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
    public function search($key)
    {
        $data = items::select('*')->where('itemName', 'like', '' . $key . '%')->get()->take(10);
        return json_encode($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'itemName' => 'required | min:2',
            'itemUnit' => 'required | min:2',
            // 'itemName' => 'unique:items,email_address,' . $userId
        ]);

        $items = new items();
        $items->itemName = $request->itemName;
        $items->itemUnit = $request->itemUnit;
        $items->save();
        return redirect('/items/list')->with('status', ' Your data has been added successfully');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, items $items)
    {
        //
        $request->validate([
            'itemName' => 'required | min:2',
            'itemUnit' => 'required | min:2',
        ]);
        return redirect('/items/list')->with('status', ' Your data has been added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(items $items)
    {
        //
    }
}

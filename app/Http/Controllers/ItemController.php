<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $items = Item::orderBy('id', 'asc')->get();
        // return view('cssd.items',compact('items'));
        return view('cssd.items');
    }

    public function getItems()
    {
        $items = Item::orderBy('id', 'asc')->get();
        // return view('cssd.items',compact('items'))
        //     ->with('i', (request()->input('page', 1) - 1) * 20);
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $item = new Item;
        $item->name = $request->name;
        $saved = $item->save();
        if (!$saved) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Cannot insert Data'
                ]
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully',
                'item' => $item,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->name = $request->name;
        $item->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully',
                'item' => $item,
            ]
        );
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {

        $item->delete();
    }
}

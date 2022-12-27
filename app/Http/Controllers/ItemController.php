<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
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
        //s
        $items = Item::all();
        $suppliers = Supplier::all();
        return view('inventory.new-item', compact('items','suppliers'));
    }
    /**
     * Show  return matcing items
     *
     * @return \Illuminate\Http\Response
     */
    public function getItems(Request $request){
        // dd($request->all());
        $items = Item::where([['name','like', '%'. $request->key .'%'],['supplier_id',$request->supplier_id]])->whereNotNull('supplier_id')->get();
        return $items;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $items = Item::all();
        $suppliers = Supplier::all();
        return view('inventory.new-item', compact('items','suppliers'));
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
        $item = new Item();
        $item->name = $request->name;
        $item->category = $request->category;
        $item->make = $request->make;
        $item->model = $request->model;

        $item->supplier_id = $request->supplier;
        $item-> prop_1 = $request-> prop_1;
        $item-> prop_2 = $request-> prop_2;
        $item-> prop_3 = $request-> prop_3;
        $item-> prop_4 = $request-> prop_4;       
        $item->save();

        return redirect()->route('item.create');
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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {   
         
        $items = Item::all();
        return view('inventory.new-item', compact('items','item'));
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
        $item->category = $request->category;
        $item->make = $request->make;
        $item->model = $request->model;
        $item-> prop_1 = $request-> prop_1;
        $item-> prop_2 = $request-> prop_2;
        $item-> prop_3 = $request-> prop_3;
        $item-> prop_4 = $request-> prop_4;   
        $item->save();
        return redirect()->route('item.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        // $item->delete();
        return redirect()->route('item.create');
    }
}

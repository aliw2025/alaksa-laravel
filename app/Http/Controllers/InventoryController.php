<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Investor;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        
    }

    public function getInvestorInventory(Request $request){
        // dd($request->investor_id);
        // with('item.propertyValues')
        $supplier = Supplier::find($request->supplier_id);
        $items = Inventory::where('investor_id','=',$request->investor_id)->where('quantity','>',0)->whereHas('item', function ($query)  use ($request,$supplier) {
            $query->where('name','like','%'.$request->key.'%')->where('cat_id',$supplier->category_id);
        })->with('item')->get();
        
        return $items;
    }
    public function getInvestorInventoryById(Request $request){
        $supplier = Supplier::find($request->supplier_id);
        if(!isset($supplier->category_id)){
              return [];
        }
        $items = Inventory::where('investor_id','=',$request->investor_id)->where('quantity','>',0)->whereHas('item', function ($query)  use ($request,$supplier) {
            $query->where('id',$request->item_id)->where('cat_id',$supplier->category_id);
        })->with('item')->first();
        
        return $items;
    }

    public function showInventory($investor_id){
        
        $investor = Investor::Find($investor_id);
        $inventory_items= $investor->inventories;
        return view('inventory.inventory',compact('inventory_items','investor'));
        
    }
}

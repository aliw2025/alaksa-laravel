<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProperty;
use App\Models\Item;
use App\Models\PropertyValue;
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
        $categories = Category::all();
        return view('inventory.new-item', compact('items','suppliers','categories'));
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
        $categories = Category::all();
        return view('inventory.new-item', compact('items','suppliers','categories'));
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
        $props = CategoryProperty::where('cat_id',$request->category_id)->get();
       
        // dd($request->all());
        $item = new Item();
        $item->name = $request->name;
       
        $item->make = $request->make;
        $item->model = $request->model;
        $item->supplier_id = $request->supplier;
        $item->cat_id =  $request->category_id;
        $item->save();
         
        foreach($props as $p){
            $propValue = new PropertyValue();
            $propValue->prop_name = $p->property_name;
            $propValue->prop_id =  $p->id;
            $propValue->prop_value =$request[$p->id];
            $propValue->item_id = $item->id;
            $propValue->save();  
        }

        
        


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
    public function Itemdetail($id){

        $item = Item::where('id',$id)->with('propertyValues')->first();
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
         
        $items = Item::all();
        $categories = Category::all();
        $propertyValues = PropertyValue::where('item_id',$item->id)->get();
        // dd($propertyValues);
        return view('inventory.new-item', compact('items','item','categories','propertyValues'));
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
        $item->make = $request->make;
        $item->model = $request->model;
        $item->save();
        $oldProps = PropertyValue::where('item_id',$item->id);
        $oldProps->delete();
        $props = CategoryProperty::where('cat_id',$request->category_id)->get();
        foreach($props as $p){
            $propValue = new PropertyValue();
            $propValue->prop_name = $p->property_name;
            $propValue->prop_id =  $p->id;
            $propValue->prop_value =$request[$p->id];
            $propValue->item_id = $item->id;
            $propValue->save();  
        }
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

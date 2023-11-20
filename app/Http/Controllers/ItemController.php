<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProperty;
use App\Models\Item;
use App\Models\PropertyValue;
use App\Models\Supplier;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\QueryException as DatabaseQueryException;
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
        // $items = Item::where('name','like', '%'. $request->key .'%')->get();
        $supplier = Supplier::find($request->supplier_id);
        
        $items = Item::where([['name','like', '%'. $request->key .'%'],['cat_id',$supplier->category->id]])->get();
        return $items;
    }

    public function getItemsById(Request $request){
        
         $supplier = Supplier::find($request->supplier_id);
        $items = Item::where([['id', $request->item_id],['cat_id',$supplier->category->id]])->first();
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

        $validated = $request->validate([
            'name'=>'required',
            'make'=>'required',
            'model'=>'required',
        ]);

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

        
        

        return redirect()->back()->with('message', 'Item added successfully.');
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
        $item->cat_id =  $request->category_id;
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
        return redirect()->back()->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        try {
            $item->delete();
            return redirect()->route('item.create')->with('message', 'Item deleted successfully.');
            return redirect()->back()->with('message', 'Item deleted successfully.');
        } catch (DatabaseQueryException $e) {

            return redirect()->back()->with('error', 'Cannot delete item. It is associated with other records.');
        }
    }
}

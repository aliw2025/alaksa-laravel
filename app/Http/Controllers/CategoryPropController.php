<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProperty;
use Illuminate\Http\Request;

class CategoryPropController extends Controller
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
    public function create($id)
    {
        //
        createProperty($id);
    }

    public function getProperties($id) {
        $properties = CategoryProperty::where('cat_id',$id)->get();
        return $properties;
    }   

    public function createProperty($id){

        $category = Category::find($id);
        $properties = CategoryProperty::where('cat_id',$id)->get();
        
        return view('inventory.cat-properties',compact('category','properties'));
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
        $request->validate(
            ['property_name'=>'required']
        );
        $categoryProperty = new CategoryProperty();
        $categoryProperty->cat_id = $request->cat_id;
        $categoryProperty->property_name = $request->property_name;
        $categoryProperty->save();

        return redirect()->back()->with('message','new record added');
        return redirect()->route('create-property',$request->cat_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryProperty  $categoryProperty
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProperty $categoryProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryProperty  $categoryProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProperty $categoryProperty)
    {
        $category = Category::find($categoryProperty->cat_id);  
        $properties = CategoryProperty::where('cat_id',$categoryProperty->cat_id)->get();
        return view('inventory.cat-properties',compact('category','properties','categoryProperty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryProperty  $categoryProperty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryProperty $categoryProperty)
    {
        $request->validate(
            ['property_name'=>'required']
        );
          
        $categoryProperty->property_name = $request->property_name;
        $categoryProperty->save();
        return redirect()->back()->with('message','record updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryProperty  $categoryProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryProperty $categoryProperty)
    {
        //
        $categoryProperty->delete();
        return redirect()->back()->with('message','record deleted');
    }
}

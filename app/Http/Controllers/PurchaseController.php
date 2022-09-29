<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Purchase;
use App\Models\Item;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;

class PurchaseController extends Controller
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
    {   $items = Item::all();
        $investors = Investor::all();
        return view('purchase.purchase',compact('items','investors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        
        $investor = Investor::find($request->investor_id);
        $purchase = new Purchase();
        $id = Purchase::max('id');
        if($id ==null){
            $id = 1;
        }
        
        $purchase->purchase_no = $investor->prefix.'-'.$id+1;
        $purchase->investor_id = $request->investor_id;
        $purchase->store_id = 1;
        $purchase->supplier = $request->supplier;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->save();
        
        for ($a=0 ; $a<count($request->qty); $a++) {
            echo $a.'<br>';
            $purchase_item = new PurchaseItem();
            $purchase_item->item_id = $request->item_id[$a];
            $purchase_item->quantity = $request->qty[$a];
            $purchase_item->unit_cost = $request->cost[$a];
            $purchase_item->trade_discount = 0;
            $purchase_item->purchase_id = $purchase->id;
            $purchase_item->save();
        
        }

        return redirect()->route('purchase.create');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}

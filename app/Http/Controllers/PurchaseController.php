<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Investor;
use App\Models\InvestorLeadger;

use App\Models\Purchase;
use App\Models\Item;
use App\Models\PurchaseItem;
use App\Models\Payable;
use App\Models\Supplier;
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
        $suppliers = Supplier::all();
        return view('purchase.purchase',compact('items','investors','suppliers'));
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
        // creating purchase transactions
        $purchase = new Purchase();
        $id = Purchase::max('id');
        // $id = Purchase::where('investor_id','=',$request->investor_id)->max('id');
        if($id ==null){
            $id = 0;
        }
        $num = str_pad($id+1, 10, '0', STR_PAD_LEFT);
        $purchase->purchase_no = $investor->prefix.'22'.$num;
        $purchase->investor_id = $request->investor_id;
        $purchase->store_id = 1;
        $purchase->supplier = $request->supplier;
        $purchase->total =$request->total_amount;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->save();

        //  saving each item of the purchase transaction
        for ($a=0 ; $a<count($request->qty); $a++) {
            echo $a.'<br>';
            // saving purchase items
            $purchase_item = new PurchaseItem();
            $purchase_item->item_id = $request->item_id[$a];
            $purchase_item->quantity = $request->qty[$a];
            $purchase_item->unit_cost = $request->cost[$a];
            $purchase_item->trade_discount = 0;
            $purchase_item->purchase_id = $purchase->id;
            $purchase_item->save();
            
            // updating inventory
            // $investor =Investor::Find($purchase->investor_id);
            $inventory = Inventory::where('investor_id','=',$purchase->investor_id)->where('item_id','=',$purchase_item->item_id)->first();
          
            if($inventory==null){
                $inventory = new Inventory();
                $inventory->store_id = $purchase->store_id;
                $inventory->item_id = $purchase_item->item_id;
                $inventory->investor_id = $purchase->investor_id;
                $inventory->unit_cost = $purchase_item->unit_cost;
                $inventory->quantity = $purchase_item->quantity;
                $inventory->save();
            }else{
                // dd($inventory);
                $inventory->quantity = $inventory->quantity +$purchase_item->quantity;
                $inventory->save();
            }
        
        }
        // getting inventory account of the investor
        $inv_acc_id =  $investor->charOfAccounts->where('account_type',3)->first()->id;
        $purchase->leadgerEntries()->create([
            'account_id'=>  $inv_acc_id,
            'value'=> $request->total_amount,
            'date'=>$purchase->purchase_date        
        ]);  
        //  getting supplier payable account of the supplier
        $supplier = Supplier::find($request->supplier);
        $sup_acc_id = $supplier->charOfAccounts->where('account_type',6)->first()->id;
        $purchase->leadgerEntries()->create([
            'account_id'=>  $sup_acc_id,
            'value'=> -$request->total_amount,
            'date'=>$purchase->purchase_date       
        ]);  
        

        // $payable = new Payable();
        // $payable->transaction_id =  $purchase->id;
        // $payable->remaining_value = $request->total_amount;
        // $payable->total_value=$request->total_amount;
        // $payable->save();
       
        // // adding entry in leadger
        // $ledgerEntry = new InvestorLeadger();
        // $ledgerEntry->account_id = $investor->accounts->where('account_type',2)->first()->id;
        // $ledgerEntry->transaction_type = "purchase";
        // $ledgerEntry->transaction_id = $purchase->id;
        // $ledgerEntry->value =  $request->total_amount*-1;
        // $ledgerEntry->date = $investor->created_at;
        // $ledgerEntry->save();
        


        return redirect()->route('get-purchases',$investor->id);
       
    }

    public function showPurchaseItems($id){

        $purchase = Purchase::find($id);
        $purchase_items = $purchase->items;
        return view('purchase.purchase-item-list',compact('purchase_items','purchase'));

    }

    public function showPurchases($id){

        $investor = Investor::find($id);
        $purchases= $investor->purchases;
        return view('purchase.purchases-list',compact('purchases','investor'));

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

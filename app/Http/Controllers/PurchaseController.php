<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Inventory;
use App\Models\Investor;
use App\Models\InvestorLeadger;

use App\Models\Purchase;
use App\Models\Item;
use App\Models\PurchaseItem;
use App\Models\Payable;
use App\Models\Supplier;
use App\Models\TransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




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
        // for purchase
        $type = 1;
        return view('purchase.purchase',compact('items','investors','suppliers','type'));
    }

    public function purchaseReturn(){

        $items = Item::all();
        $investors = Investor::all();
        $suppliers = Supplier::all();
        // for purchase return
        $type = 2;
        $row_count = 0;
        return view('purchase.purchase',compact('items','investors','suppliers','type','row_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    public function store(Request $request)
    {   
        
        // dd($request->all());
        
       $validated = $request->validate([
            'supplier'=>'required',
             'item_id'=>'required',
            'item_id.*'=>'required',
            'qty.*'=>'required',
            'cost.*'=>'required'
        ],[
           
            'item_id.*'=>'One or more item feild is left empty',
            'qty.*'=> 'One or more Quantity feild is left empty',
            'cost.*'=>'One or more Cost feild is left empty',
        ]);

        $user = Auth::user();
        $investor = Investor::find($request->investor_id);
        // creating purchase transactions
        $purchase = new Purchase();
        $id = Purchase::max('id');

        $td_loss = 0;
        if($id ==null){
            $id = 0;
        }
       
        $num = str_pad($id+1, 10, '0', STR_PAD_LEFT);
        $purchase->purchase_no = $investor->prefix.'23'.$num;
        $purchase->investor_id = $request->investor_id;
        $purchase->store_id = 1;
        $purchase->supplier = $request->supplier;
        $purchase->total = str_replace(',','', $request->total_amount);
        $purchase->type = $request->purchase_type;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->tran_type = $request->tran_type;
        $purchase->status = 1;
        $purchase->save();

        //  saving each item of the purchase transaction
        $total_td = 0;
        for ($a=0 ; $a<count($request->qty); $a++) {
            echo $a.'<br>';
            // saving purchase items
            $total_td += $request->trade_discount[$a] * $request->qty[$a]; 
            $purchase_item = new PurchaseItem();
            $purchase_item->item_id = $request->item_id[$a];
            $purchase_item->quantity = $request->qty[$a];
            $purchase_item->unit_cost =  str_replace(',','',$request->cost[$a]); 
            $purchase_item->trade_discount = $request->trade_discount[$a] *$request->qty[$a];
            $purchase_item->purchase_id = $purchase->id;
            // $purchase_item->td_loss = $request->td_loss[$a];
            $t=str_replace(',','', $request->td_loss[$a]);
            $purchase_item->td_loss = isset($request->td_loss[$a]) ?$t:0;
            $purchase_item->save();

        }   
        $purchase->trade_discount = $total_td;
        $purchase->save();

        return redirect()->route('purchase.show',$purchase)->with('message','Record Saved');;   
    }


    public function postPurchase(Request $request){
        
        // dd('correct post td loss isse');
        $user = Auth::user();
        $investor = Investor::find($request->investor_id);
        // creating purchase transactions
        $purchase = Purchase::find($request->purchase_id);
        
        $totalDiscount  = 0;
        //  saving each item of the purchase transaction
        foreach ($purchase->purchaseItems as $purchase_item) {

            $totalDiscount += $purchase_item->trade_discount;
            
            // updating inventory
            $inventory = Inventory::where('investor_id','=',$purchase->investor_id)->where('item_id','=',$purchase_item->item_id)->first();



            if($inventory==null){

                $inventory = new Inventory();
                $inventory->store_id = $purchase->store_id;
                $inventory->item_id = $purchase_item->item_id;
                $inventory->investor_id = $purchase->investor_id;
                $inventory->unit_cost = $purchase_item->unit_cost;
                $inventory->quantity = $purchase_item->quantity;
                $inventory->discount = $purchase_item->discount;
                $inventory->save();


            }else{
                if($request->tran_type==2){
                    
                    $inventory->quantity = $inventory->quantity -$purchase_item->quantity;
                }else{
                    $inventory->quantity = $inventory->quantity +$purchase_item->quantity;
                    // averaging purchase price
                    $inventory->unit_cost =  ($inventory->unit_cost+$purchase_item->unit_cost)/2;
                }
                $inventory->save();
                
            }
            $supplier = Supplier::find($request->supplier);
            $sup_acc_id = $supplier->charOfAccounts->where('account_type',7)->first()->id;

            if($request->tran_type==2){
                // creating expene
                $expense = new Expense();
                $expense->description = $investor->investor_name." ".$inventory->item->name." return to ".$supplier->name." loss";
                $expense->amount = str_replace(',','',$purchase_item->td_loss);
                $expense->date = $purchase->purchase_date;
                $expense->status = 3;
                $expense->save();
                $expense->investor_id = $investor->id;
                $purchase_item->expense = $expense->id;
                $purchase_item->save();
                // creating impact of expense on leadger
                $expense->createLeadgerEntry(8,str_replace(',','',$purchase_item->td_loss),$investor->id,$purchase->purchase_date,$user->id);
                $expense->createLeadgerEntry($sup_acc_id,-str_replace(',','',$purchase_item->td_loss),$investor->id,$purchase->purchase_date,$user->id);
            }

        }   

        $purchase->status = 3;
        $purchase->save();
        if($request->purchase_type==2){

            // $request->total_amount = $request->total_amount * -1;
            $purchase->total =  $purchase->total * -1;
            $purchase->save();
            
            
        }
        /******************** Leadger Entries ******************/
        $purchase->createLeadgerEntry(3,$purchase->total,$investor->id,$purchase->purchase_date,$user->id); 
        $purchase->createLeadgerEntry($sup_acc_id,-$purchase->total,$investor->id,$purchase->purchase_date,$user->id); 
       
        return redirect()->back()->with('message','Purchase Posted');
    
    }
    

    public function unpostPurchase(Request $request){
        

       
        // dd($request->all());
        $user = Auth::user();
        $investor = Investor::find($request->investor_id);
        // creating purchase transactions
        $purchase = Purchase::find($request->purchase_id);
        
        if ($purchase->status != 3) {
            return "purchase cannot be un posted";
        }
        //  saving each item of the purchase transaction
        foreach ($purchase->purchaseItems as $purchase_item) {
            
            // updating inventory
            $inventory = Inventory::where('investor_id','=',$purchase->investor_id)->where('item_id','=',$purchase_item->item_id)->first();
            if($request->tran_type==2){
                
                $expense = Expense::find($purchase_item->expense);
                $expense->status = 2;
                $expense->save();
                
                $expense->leadgerEntries()->delete();
                $inventory->quantity = $inventory->quantity +$purchase_item->quantity;
                

            }else{
                $inventory->quantity = $inventory->quantity -$purchase_item->quantity;
               
            }
           
            $inventory->save();
            
        }   

        $purchase->status = 1;
        $purchase->save();
        
        $purchase->leadgerEntries()->delete();
        
        return redirect()->back()->with('message','Purchase Un Posted');

    
    }
    
    

    public function showPurchaseItems($id){

        $purchase = Purchase::find($id);
        $purchase_items = $purchase->items;
        return view('purchase.purchase-item-list',compact('purchase_items','purchase'));

    }

    public function showPurchases(Request $request){

        $statuses = TransactionStatus::all();
        $investors = Investor::all();
        $suppliers = Supplier::all();
      
        return view('purchase.purchases-list',compact('investors','suppliers','statuses'));

    }

    public function showPurchasesPost(Request $request){

        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required'   
        ]);
        
        $purchases = Purchase::showPurchases($request->from_date, $request->to_date, $request->investor_id,$request->supplier_id,$request->status_id);

        $investors = Investor::all();
        $suppliers = Supplier::all();
        $statuses = TransactionStatus::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;

       

        $sum = DB::table('purchases')
            ->join('purchase_items', 'purchases.id', '=', 'purchase_items.purchase_id')
            ->select(DB::raw('sum(purchase_items.trade_discount) as discount'),DB::raw('sum(purchases.total) as total'))    
            ->whereBetween('purchases.purchase_date',[$from_date,$to_date]);
            if(isset($request->investor_id))
            $sum = $sum->where('purchases.investor_id',$request->investor_id);
            if(isset($request->supplier_id))
            $sum = $sum->where('purchases.supplier_id',$request->supplier_id);
            if(isset($request->status_id))
            $sum = $sum->where('purchases.status',$request->status_id);
            
            $sum=$sum->get();
                    
        if ($request->input('action') == "pdf"){
            
            $purchases = $purchases->get();
            return view('purchase.purchase_reports',compact('purchases','investors','suppliers','from_date','to_date','statuses','sum'));

        }

        $purchases = $purchases->paginate(20);
        $purchases->appends([
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'investor_id' => $request->investor_id,
            'supplier_id'=>$request->supplier_id
           
        ]);
        return view('purchase.purchases-list',compact('purchases','investors','suppliers','from_date','to_date','statuses','sum'));
       
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        $investors = Investor::all();
        $suppliers = Supplier::all();
        $type = $purchase->type;
        // return $purchase->purchaseItems;
        return view('purchase.purchase',compact('purchase','investors','suppliers','type'));
    }

    public function getLastPurchase(Request $request){


        // dd($request->all());
        // getting all those purchases how have that item
        $purchase = Purchase::where('investor_id','=',$request->investor_id)->whereHas('items', function ($query)  use ($request) {
            $query->where('item_id',$request->item_id);
        })->orderBy('purchase_date', 'DESC')->first();
        // getting that specific item from purchase entry
        $item = $purchase->items()->where('item_id',$request->item_id)->first();
        // getting cost of the item
        $cost = $item->pivot->unit_cost;

        return ($cost);

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
        // dd('i am update route');
        // dd($request->all());    
        if ($request->input('action') == "post") {

            return redirect()->route('post-purchase', $request->all());
        }else if ($request->input('action') == "unpost"){
            return redirect()->route('unpost-purchase', $request->all());
        }
         else if ($request->input('action') == "cancel") {
            return redirect()->route('cancel-purchase', $request->all());
        }
        // dd($request->all());
        $validated = $request->validate([
            'supplier'=>'required',
             'item_id'=>'required',
            'item_id.*'=>'required',
            'qty.*'=>'required',
            'purchase_date'=>'required',
            'cost.*'=>'required'
        ],[
           
            'item_id.*'=>'One or more item feild is left empty',
            'qty.*'=> 'One or more Quantity feild is left empty',
            'cost.*'=>'One or more Cost feild is left empty',
        ]);

        $user = Auth::user();
        $investor = Investor::find($request->investor_id);
        // creating purchase transactions
    
        $purchase->investor_id = $request->investor_id;
        $purchase->store_id = 1;
        $purchase->supplier = $request->supplier;
        $purchase->total = str_replace(',','', $request->total_amount);
        $purchase->type = $request->purchase_type;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->tran_type = $request->tran_type;
        $purchase->status = 1;
        $purchase->save();

        //  saving each item of the purchase transaction
        $pitems = $purchase->purchaseItems();
        // dd($pitems);
        $pitems->delete();
        for ($a=0 ; $a<count($request->qty); $a++) {
            echo $a.'<br>';
            // saving purchase items
            $purchase_item = new PurchaseItem();
            $purchase_item->item_id = $request->item_id[$a];
            $purchase_item->quantity = $request->qty[$a];
            $purchase_item->unit_cost =  str_replace(',','',$request->cost[$a]); 
            $purchase_item->trade_discount = 0;
            $purchase_item->purchase_id = $purchase->id;
            $purchase_item->td_loss = isset($request->td_loss[$a]) ?$request->td_loss[$a]:0;
            $purchase_item->save();

        }   
       

        return redirect()->back()->with('message','Record saved');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {

    }

    public function cancelPurchase(Request $request)
    {
        $purchase = Purchase::find($request->purchase_id);
        if ($purchase->status != 1) {
            return "transaction with entry status can be cancelled only";
        }
        $purchase->status = 2;
        $purchase->save();

        return redirect()->back()->with('message','Puchase Cancelled');
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SupplierPayment;
use App\Models\ChartOfAccount;
use App\Models\GLeadger;
use App\Models\Payable;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Symfony\Component\Finder\Glob;
use App\Models\Investor;
use App\Models\InvestorLeadger;
use App\Models\Item;
use App\Models\PurchaseItem;
use App\Models\TransactionStatus;
use Illuminate\Support\Facades\Auth;


class SupplierPaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    public function payablesRepTem($id){
        
        $leadger = GLeadger::where('investor_id',$id)->whereHas('account',function ($query)  {
            $query->where('account_type',7);
        })->orderBy('account_id')->get()  ;
        $total = $leadger->sum('value');
        return  view('payable.payables2', compact('leadger','total'));
    }


    public function getPayables($id)
    {
        $suppliers = Supplier::whereIn('id', Purchase::select('supplier')->distinct()->pluck('supplier'))->get();
        return view('payable.payables', compact('suppliers', 'id'));
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $investors = Investor::all();
        $suppliers = Supplier::all();
        $bank_acc = ChartOfAccount::where('owner_type','App\Models\Investor')->where(
            function($query) {
              return 
              $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);
             })->get();
        return view('payable.pay', compact('investors', 'suppliers','bank_acc'));

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
        $validate = $request->validate([
            'supplier'=>'required',
            'amount'=>'required'
        ]);
        $user = Auth::user();
        $id = SupplierPayment::max('id');
        if ($id == null) {
            $id = 0;
        }
        $num = str_pad($id + 1, 10, '0', STR_PAD_LEFT);
        $investor = Investor::find($request->investor_id);
        $supplierPayment = new SupplierPayment();
        $supplierPayment->payment_no = $investor->prefix . '22' . $num;
        $supplierPayment->investor_id = $request->investor_id;
        $supplierPayment->store_id = 1;
        $supplierPayment->supplier_id = $request->supplier;
        $supplierPayment->amount = str_replace(',','',$request->amount); 
        $supplierPayment->note = $request->note;
        $supplierPayment->payment_date = $request->payment_date;
        $supplierPayment->status = 1;
        $supplierPayment->account_id = $request->acc_type;
        $supplierPayment->save();

        return redirect()->route('supplierPayment.show')->with('message','Record saved');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierPayment $supplierPayment)
    {
    
        $investors = Investor::all();
        $suppliers = Supplier::all();
        $bank_acc = ChartOfAccount::where('owner_type','App\Models\Investor')->where(
            function($query) {
              return 
              $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);
             })->get();

        return view('payable.pay', compact('investors', 'suppliers','bank_acc','supplierPayment'));


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierPayment $supplierPayment)
    {
        //
        return view('payable.pay');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierPayment $supplierPayment)
    {

        if ($request->input('action') == "post") {

            return redirect()->route('post-supplierPayment', $request->all());
        
        }else if ($request->input('action') == "unpost") {
           
            return redirect()->route('unpost-supplierPayment', $request->all());
        }
         else if ($request->input('action') == "cancel") {
           
            return redirect()->route('cancel-supplierPayment', $request->all());
        }


        $validate = $request->validate([
            'supplier'=>'required',
            'amount'=>'required'
        ]);
        $user = Auth::user();
        $id = SupplierPayment::max('id');
        if ($id == null) {
            $id = 0;
        }
        $num = str_pad($id + 1, 10, '0', STR_PAD_LEFT);
        $investor = Investor::find($request->investor_id);

        $supplierPayment->payment_no = $investor->prefix . '22' . $num;
        $supplierPayment->investor_id = $request->investor_id;
        $supplierPayment->store_id = 1;
        $supplierPayment->supplier_id = $request->supplier;
        $supplierPayment->amount = str_replace(',','',$request->amount); 
        $supplierPayment->note = $request->note;
        $supplierPayment->payment_date = $request->payment_date;
        $supplierPayment->status = 1;
        $supplierPayment->account_id = $request->acc_type;
        $supplierPayment->save();

        return redirect()->back()->with('message','Record Saved');

    }

    public function searchPayables(Request $request){


        $statuses = TransactionStatus::all();
        $investors = Investor::all();
        $suppliers = Supplier::all(); 
        return view('payable.search-payables',compact('investors','suppliers','statuses'));


    }

    //  search payables
    public function searchPayablesPost(Request $request){

        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required'
        ]);

        $gl = GLeadger::whereBetween('date',[$request->from_date,$request->to_date])->wherehas('account',function($query){
            $query->where('owner_type','like','%supplier%');
        })->where('value','<',0);
        if(isset($request->investor_id)){
            $gl = $gl->where('investor_id',$request->investor_id);
        }
        if(isset($request->supplier_id)){
            $gl = $gl->where('account_id',$request->supplier_id);
        }
        $sum = $gl->sum('value');
        
        $statuses =  TransactionStatus::all();
        $investors = Investor::all();
        $suppliers = Supplier::all();
        $from_date  = $request->from_date;
        $to_date = $request->to_date;
        if ($request->input('action') == "pdf"){
            
            $gl = $gl->get();
            return view('payable.search_payables_report',compact('investors','suppliers','statuses','gl',  'from_date','to_date','sum'));

        }
        $gl = $gl->paginate(25);

        return view('payable.search-payables',compact('investors','suppliers','statuses','gl',  'from_date','to_date','sum'));

    }

    public function cancelSupplierPayment(Request $request){

        $supplierPayment = SupplierPayment::find($request->supplierPayment_id);
        if ($supplierPayment->status != 1) {
            return "transaction with entry status can be cancelled only";
        }
        $supplierPayment->status = 2;
        $supplierPayment->save();

        return redirect()->back()->with('message','Record Cancelled');
    }

    public function postsupplierPayment(Request $request)
    {
        
        $supplierPayment = SupplierPayment::find($request->supplierPayment_id);
        if ($supplierPayment->status == 3) {
            return "supplierPayment alreaddy posted";
        }elseif ($supplierPayment->status == 2) {
            return "supplierPayment cancelled cannot be posted";
        }

        $user = Auth::user();
        $supplierPayment->status = 3;
        $supplierPayment->save();
       
        // // getting supplier supplierPayment account
        $supplier = Supplier::find($request->supplier);
        $sup_acc_id = $supplier->charOfAccounts->where('account_type', 7)->first()->id;

        // /************** Leadger Entries **********/
        $supplierPayment->createLeadgerEntry($sup_acc_id,str_replace(',','',$request->amount),$supplierPayment->investor_id,$request->payment_date,$user->id);
        $supplierPayment->createLeadgerEntry($request->acc_type,-str_replace(',','',$request->amount),$supplierPayment->investor_id,$request->payment_date,$user->id);

        
       

        return redirect()->back()->with('message','Record Posted');
    }

    public function UnpostSupplierPayment(Request $request)
    {
        $supplierPayment = SupplierPayment::find($request->supplierPayment_id);
        if ($supplierPayment->status != 3) {
            return "only posted supplierPayment can be unposted";
        }
        $user = Auth::user();
        $supplierPayment->status = 1;
        $supplierPayment->save();
        $supplierPayment->leadgerEntries()->delete();

       
        return redirect()->back()->with('message','Record Un Posted');
    }

    public function showSupplierPayments(Request $request){

        $statuses = TransactionStatus::all();
        $investors = Investor::all();
        $suppliers = Supplier::all();
      
        return view('payable.supplier-payments',compact('investors','suppliers','statuses'));
    }

    public function showSupplierPaymentsPost(Request $request){

        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required'   
        ]);
        
        $supplierPayments = SupplierPayment::showSupplierPayments($request->from_date, $request->to_date, $request->investor_id,$request->supplier_id,$request->status_id);

        $investors = Investor::all();
        $suppliers = Supplier::all();
        $statuses = TransactionStatus::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;

       

            $sum = SupplierPayment::whereBetween('payment_date',[$from_date,$to_date]);
            if(isset($request->investor_id))
            $sum = $sum->where('investor_id',$request->investor_id);
            if(isset($request->supplier_id))
            $sum = $sum->where('supplier_id',$request->supplier_id);
            if(isset($request->status_id))
            $sum = $sum->where('status',$request->status_id);
            
            $sum=$sum->sum('amount');
                    
        if ($request->input('action') == "pdf"){
            
            $supplierPayments = $supplierPayments->get();
            return view('payable.supplier_payment_report',compact('supplierPayments','investors','suppliers','from_date','to_date','statuses','sum'));

        }

        $supplierPayments = $supplierPayments->paginate(20);
        $supplierPayments->appends([
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'investor_id' => $request->investor_id,
            'supplier_id'=>$request->supplier_id
           
        ]);
       
        return view('payable.supplier-payments',compact('supplierPayments','investors','suppliers','from_date','to_date','statuses','sum'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierPayment $supplierPayment)
    {
        //
    }
}

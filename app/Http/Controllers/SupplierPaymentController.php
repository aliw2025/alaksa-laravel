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
        //
        $supplierPayments = SupplierPayment::all();
        return view('payable.payables', compact('supplierPayments'));
    }

    public function payablesRepTem($id){
        

        $leadger = GLeadger::where('investor_id',$id)->whereHas('account',function ($query)  {
            $query->where('account_type',7);
        })->orderBy('account_id')->get()  ;
        $total = $leadger->sum('value');

        // where('transaction_type','like',"%purchase%")
        return  view('payable.payables2', compact('leadger','total'));
    }

    public function getPayables($id)
    {
        // dd('sdsd');
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
        //
        $investors = Investor::all();
        $suppliers = Supplier::all();
        // $bank_acoounts = ChartOfAccount::whereHas(' ')
        $bank_acc = ChartOfAccount::where('account_type',4)->get();
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
        $supplierPayment->save();


        //  getting investor asset account
        $investor = Investor::find($request->investor_id);

        // getting supplier supplierPayment account
        $supplier = Supplier::find($request->supplier);
        $sup_acc_id = $supplier->charOfAccounts->where('account_type', 7)->first()->id;


        /************** Leadger Entries **********/
        $supplierPayment->createLeadgerEntry($sup_acc_id,str_replace(',','',$request->amount),$investor->id,$request->payment_date,$user->id);
        $supplierPayment->createLeadgerEntry($request->acc_type,-str_replace(',','',$request->amount),$investor->id,$request->payment_date,$user->id);


        return redirect()->route('payable.create',compact('supplierPayment'))->with('message','Record saved');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierPayment $supplierPayment)
    {
        //
        return view('payable.pay', compact('supplierPayment'));

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
        //
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

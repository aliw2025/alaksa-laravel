<?php

namespace App\Http\Controllers;

use App\Models\GLeadger;
use App\Models\Payable;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Glob;
use App\Models\Investor;
use App\Models\InvestorLeadger;
use App\Models\Item;
use App\Models\PurchaseItem;

class PayableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payables = Payable::all();
        return view('payable.payables', compact('payables'));
    }

    public function getPayables($id)
    {
        // dd($id);
        $suppliers = Supplier::whereIn('id', Purchase::select('supplier')->distinct()->pluck('supplier'))->get();
        return view('payable.payables', compact('suppliers','id'));

        echo 'suppliers:<br>';
        foreach ($suppliers as $sup) {

            $sid = $sup->charOfAccounts->first->get();

            echo 'supplier name: ' . $sup->name . ' acc_id:' . $sid->id . '<br>';
            $purchases = $sup->investor_purchases($id);
            $payments = $sup->investor_payments($id);
        //    dd($payments);
                
            if ($purchases != NULL) {
                foreach ($purchases as $pur) {
                    echo $pur->purchase_no . ' ' . $pur->investor_id . '<br>';
                }
                echo 'purchahse id is: ' . $purchases->pluck('id') . '<br>';
                // echo 'checking accout: '.$sid->id;
                $leadgers = GLeadger::where('account_id', '=', $sid->id)->whereIn('transaction_id', $purchases->pluck('id'))->where('transaction_type', 'like', "%purchase%")->get();
                $leadgers2 = GLeadger::where('account_id', '=', $sid->id)->whereIn('transaction_id', $payments->pluck('id'))->where('transaction_type', 'like', "%payable%")->get();
                echo 'total rem: '.$leadgers->sum('value').'<br>';
                echo 'total rem: '.$purchases->sum('total').'<br>';
                echo 'total paid: '.$leadgers2->sum('value').'<br>';
                echo 'total paid: '.$payments->sum('amount').'<br>';
            
                echo 'leadger entries:<br>';
                $c = 1;
                foreach ($leadgers as $led) {
                    echo $c . ':   ' . $led->value . '<br>';
                    $c++;
                }
            }
        }
        dd($suppliers);
        $purchases = Purchase::where('investor_id', '=', $id)->get();

        // $investor_purchases = Purchase::whereIn('id',Payable::all()->pluck('transaction_id'))->where('investor_id','=',$id)->pluck('id');
        // $payables = Payable::whereIn('transaction_id',$investor_purchases)->get();
        return view('payable.payables', compact('purchases'));
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
        return view('payable.pay', compact('investors', 'suppliers'));
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
        $id = Payable::max('id');
        // $id = Purchase::where('investor_id','=',$request->investor_id)->max('id');
        if($id ==null){
            $id = 0;
        }
        $num = str_pad($id+1, 10, '0', STR_PAD_LEFT);
        $investor = Investor::find($request->investor_id);
        $payable = new Payable();
        $payable->payment_no = $investor->prefix.'22'.$num;
        $payable->investor_id = $request->investor_id;
        $payable->store_id = 1;
        $payable->supplier = $request->supplier;
        $payable->amount = $request->amount;
        $payable->payment_date = $request->payment_date;
        $payable->account_type=$request->acc_type;
        $payable->save();

        $investor = Investor::find($request->investor_id);
        $inv_acc_id =  $investor->charOfAccounts->where('account_type',$request->acc_type)->first()->id;

        $supplier = Supplier::find($request->supplier);
        $sup_acc_id = $supplier->charOfAccounts->where('account_type',6)->first()->id;

        
        $payable->leadgerEntries()->create([
            'account_id'=>  $sup_acc_id,
            'value'=>  $request->amount,
            'date'=> $request->payment_date
        ]);

        $payable->leadgerEntries()->create([
            'account_id'=> $inv_acc_id,
            'value'=> - $request->amount,
            'date'=> $request->payment_date
        ]);    

        return redirect()->route('payable.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payable  $payable
     * @return \Illuminate\Http\Response
     */
    public function show(Payable $payable)
    {
        //
        // $investors = Investor::all();
        // $suppliers = Supplier::all();
        // 'investors','suppliers'
        
        return view('payable.pay',compact('payable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payable  $payable
     * @return \Illuminate\Http\Response
     */
    public function edit(Payable $payable)
    {
        //
        return view('payable.pay');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payable  $payable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payable $payable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payable  $payable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payable $payable)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\GLeadger;
use App\Models\Payable;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Glob;

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


        foreach ($suppliers as $sup) {
            $sid = $sup->charOfAccounts->first->get();
            echo $sup->name . ' ' . $sid->id . '<br>';
            $purchases = $sup->purchases->where('investor_id','=',$id);

            if($purchases!=NULL){
                foreach ($purchases as $pur) {

                    echo $pur->purchase_no.' '.$pur->investor_id.'<br>';
                    
                }
                echo $purchases->pluck('id').'<br>';
                $leadgers = GLeadger::whereIn('transaction_id',$purchases->pluck('id'))->where('account_id','=',$sid)->where('transaction_type','like','Purchase');
                foreach ($leadgers as $led) {

                    echo '   '.$led->value.'<br>';
                    
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
     * @param  \App\Models\Payable  $payable
     * @return \Illuminate\Http\Response
     */
    public function show(Payable $payable)
    {
        //
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

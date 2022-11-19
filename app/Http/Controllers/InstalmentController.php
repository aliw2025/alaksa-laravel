<?php

namespace App\Http\Controllers;

use App\Models\Instalment;
use App\Models\Investor;

use Illuminate\Http\Request;

class InstalmentController extends Controller
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
    {
        
    }
    public function recieveInstalment(Instalment $instalment) {
    //    return $instalment;
        return view('sale.recieve_instalment',compact('instalment'));
    }


    public function payInstalment(Request $request){
      

        $instalment = Instalment::find($request->id);

        $instalment->amount_paid = $request->amount_paid;
        $instalment->instalment_paid = 1;
        $instalment->save();
        $sale = $instalment->sale;

        // calculate commisions 
        $investor = Investor::find($sale->investor_id);
        // getting investory inventory account 
        $inv_acc_id =  $investor->charOfAccounts->where('account_type', 3)->first()->id;
        //  getting investor recievable account
        $inv_rcv_acc = $investor->charOfAccounts->where('account_type', 5)->first()->id;
        // getting investor unrealized profit account
        $inv_un_pft_acc = $investor->charOfAccounts->where('account_type', 9)->first()->id;
        //  getting company
        $cmp = Investor::where('investor_type', '=', 1)->first();
        //  getting company cash account
        $cmp_cash_acc =  $cmp->charOfAccounts->where('account_type', 1)->first()->id;
         //  getting investor cash account
         $inv_cash_acc =  $investor->charOfAccounts->where('account_type', 1)->first()->id;
        //  getting company recibable account
        $cmp_rcv_acc =  $cmp->charOfAccounts->where('account_type', 5)->first()->id;
        //  getting company unrealized profit account
        $cmp_un_pft_acc =  $cmp->charOfAccounts->where('account_type', 9)->first()->id;
        // getting company trade discount profit account
        $cmp_td_pft_acc =  $cmp->charOfAccounts->where('account_type', 10)->first()->id;

        $inv_per = $sale->selling_price  / $sale->total;
        $markup_per = 1 - $inv_per;
        // item price recovry
        $ins_mon = $request->amount_paid * $inv_per;
        // each investor share in markup profit
        $share = ($request->amount_paid - $ins_mon) * 0.50;
        
        //  make leadger entries
         // debit cash of investor for inventory recovery
         $instalment->leadgerEntries()->create([
            'account_id' =>  $inv_cash_acc,
            'value' => $ins_mon,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);
        //  credit recievable of inventory recovery
        $instalment->leadgerEntries()->create([
            'account_id' =>  $inv_rcv_acc,
            'value' => -$ins_mon,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);

         // debit company cash of markup
         $instalment->leadgerEntries()->create([
            'account_id' => $cmp_cash_acc,
            'value' => $share,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);

        //  credit company  recievable of markup
        $instalment->leadgerEntries()->create([
            'account_id' =>  $cmp_rcv_acc,
            'value' => -$share,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);
        
         // debit investor cash  of markup
         $instalment->leadgerEntries()->create([
            'account_id' => $inv_cash_acc,
            'value' => $share,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);

         // credit investor  recievable of markup
         $instalment->leadgerEntries()->create([
            'account_id' =>  $inv_rcv_acc,
            'value' => -$share,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);

        $instalments = $sale->instalments;

        $instalment->saleCommision()->create(
            [
                'commission_type' => 2,
                'user_id' => $sale->rec_of_id,
                'amount' => $request->amount_paid * 0.01,
                'status' => 0,
                'earned_date' => $sale->sale_date
            ]
        );

        return view('sale.sale-instalments',compact('sale','instalments'));
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
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function show(Instalment $instalment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function edit(Instalment $instalment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instalment $instalment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instalment $instalment)
    {
        //
    }
}

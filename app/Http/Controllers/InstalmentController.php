<?php

namespace App\Http\Controllers;

use App\Models\Instalment;
use App\Models\InstalmentPayment;
use App\Models\Investor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

        return view('sale.recieve_instalment',compact('instalment'));
    }

    public function payInstalment(Request $request){
       
        $user = Auth::user();
        // dd($requssest->all());
        $instalment = Instalment::find($request->id);
        $sale = $instalment->sale;
        $instalments = $sale->instalments;
        $instalment->amount_paid = $instalment->amount_paid+ str_replace(',','',$request->amount_paid);
        
        if(isset($request->move_to_next)){
            $next_instalment = Instalment::find($request->id+1);
            if($next_instalment==NULL || $next_instalment->sale_id !=$sale->id){

                return redirect()->route('get-sale-instalments',["id"=>$sale->id,"user_exception"=>"next instalment not found"]);
            }
            $next_instalment->amount = $next_instalment->amount +( $instalment->amount - $instalment->amount_paid);
            $instalment->amount = $instalment->amount_paid;
            $next_instalment->save();

        }
        
        if($instalment->amount_paid > $instalment->amount){
            $user_exception = "amount cannot be greater than due amount";
            return redirect()->route('get-sale-instalments',["id"=>$sale->id,"user_exception"=>$user_exception]);
            // return view('sale.sale-instalments',compact('sale','instalments','user_exception'));
        }
        // add payment transaction here
        $payment = new InstalmentPayment();
        $payment->instalment_id = $instalment->id;
        $payment->amount =  str_replace(',','',$request->amount_paid);
        $payment->payment_date = $request->pay_date;
        $payment->notes = $request->notes;
        $payment->save();

        if($instalment->amount_paid==$instalment->amount){
            $instalment->instalment_paid = 1;
        }
        $instalment->save();
        // calculate commisions 
        $investor = Investor::find($sale->investor_id);
        // getting investory inventory account 
        // $inv_acc_id =  $investor->charOfAccounts->where('account_type', 3)->first()->id;
        //  getting investor recievable account
        // $inv_rcv_acc = $investor->charOfAccounts->where('account_type', 5)->first()->id;
        // getting investor unrealized profit account
        // $inv_un_pft_acc = $investor->charOfAccounts->where('account_type', 9)->first()->id;
        //  getting company
        $cmp = Investor::where('investor_type', '=', 1)->first();
        //  getting company cash account
        $cmp_cash_acc =  $cmp->charOfAccounts->where('account_type', 1)->first()->id;
         //  getting investor cash account
        //  $inv_cash_acc =  $investor->charOfAccounts->where('account_type', 1)->first()->id;
        //  getting company recibable account
        $cmp_rcv_acc =  $cmp->charOfAccounts->where('account_type', 5)->first()->id;
        //  getting company unrealized profit account
        $cmp_un_pft_acc =  $cmp->charOfAccounts->where('account_type', 9)->first()->id;
        // getting company trade discount profit account
        $cmp_td_pft_acc =  $cmp->charOfAccounts->where('account_type', 10)->first()->id;

        $inv_per = $sale->selling_price  / $sale->total;
        $markup_per = 1 - $inv_per;
        // item price recovry
        $ins_mon =  str_replace(',','',$request->amount_paid) * $inv_per;
        // each investor share in markup profit
        $share = ( str_replace(',','',$request->amount_paid) - $ins_mon) * 0.50;
        
        //  make leadger entries
         // debit cash of investor for inventory recovery
         $instalment->leadgerEntries()->create([
            'account_id' => $request->account,
            'value' => $ins_mon,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' =>$user->id,
        ]);
        //  * credit recievable of inventory recovery
        $instalment->leadgerEntries()->create([
            'account_id' =>  5,
            'value' => -$ins_mon,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' =>$user->id,
        ]);

         // debit company cash of markup
         $instalment->leadgerEntries()->create([
            'account_id' => $request->account,
            'value' => $share,
            'investor_id' => 1,
            'date' => $sale->sale_date,
            'user_id' =>$user->id,
        ]);

        // * credit  company  recievable of markup
        $instalment->leadgerEntries()->create([
            'account_id' =>  5,
            'value' => -$share,
            'investor_id' => 1,
            'date' => $sale->sale_date,
            'user_id' =>$user->id,
        ]);
        
         // debit investor cash  of markup
         $instalment->leadgerEntries()->create([
            'account_id' => $request->account,
            'value' => $share,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' =>$user->id,
        ]);

         // * credit  investor  recievable of markup
         $instalment->leadgerEntries()->create([
            'account_id' =>  5,
            'value' => -$share,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' =>$user->id,
        ]);
        
    
        $instalment->saleCommision()->create(
            [
                'commission_type' => 2,
                'user_id' => $sale->rec_of_id,
                'amount' =>  str_replace(',','',$request->amount_paid) * 0.01,
                'status' => 0,
                'earned_date' => $sale->sale_date,
                'user_id' =>$user->id,
            ]
        );
        
        return redirect()->route('get-sale-instalments',['id'=>$sale->id]);
    }


    public function showInstalmentDetails($id){

        $instalment_payments = InstalmentPayment::where('instalment_id',$id)->get();
        return view('sale.instalment_payment_details',compact('instalment_payments'));

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
        return $instalment;
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

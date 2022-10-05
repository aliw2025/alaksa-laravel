<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Account;
use App\Models\InvestorLeadger;
use Carbon\Cli\Invoker;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $investors = Investor ::all();
        $investors = Investor::where('investor_type','!=',1)->get();  
        return view('investor.investor',compact('investors'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $investors = Investor ::all();
        $investors = Investor::where('investor_type','!=',1)->get();  
        return view('investor.investor',compact('investors'));
        return view('investor.add-new-investor',compact('investors'));
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
        $validated = $request->validate(
            [
                'investor_name' => 'required',
                'email' => 'required|email|unique:investors',
                'phone' => 'required|min:8|max:11|unique:investors',
                'prefix' => 'required|unique:investors',
            ],[
                
                'investor_name.unique' => ' investor Name already exists',
                'email.unique' => ' Email already exists',
                'phone.unique' => ' Number already exists',
                'prefix.unique' => ' prefix already exists'
            ]
        );

        $investor = new Investor();
        $investor->investor_name = $request->investor_name;
        $investor->email = $request->email;
        $investor->phone = $request->phone;
        $investor->prefix = $request->prefix;
        $investor->investor_type = $request->investor_type;
        $investor->save();

        $account = new Account();
        $account->account_name = $investor->prefix.'_cash';
        $account->owner= $investor->id;
        $account->account_type = 1;
        $account->opening_balance = $request->opening_balance;
        $account->save();



        $account = new Account();
        $account->account_name = $investor->prefix.'_payables';
        $account->owner= $investor->id;
        $account->account_type = 2;
        $account->opening_balance = 0;
        $account->save();

        $account = new Account();
        $account->account_name = $investor->prefix.'_recievables';
        $account->owner= $investor->id;
        $account->account_type = 3;
        $account->opening_balance = 0;
        $account->save();
      

        $ledgerEntry = new InvestorLeadger();
        $ledgerEntry->account_id = $investor->accounts->where('account_type',1)->first()->id;
        $ledgerEntry->transaction_type = "opening";
        $ledgerEntry->transaction_id = $investor->id;
        $ledgerEntry->value =  $request->opening_balance;
        $ledgerEntry->date = $investor->created_at;
        $ledgerEntry->save();

        return redirect()->route('investor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pInvestor  $investor
     * @return \Illuminate\Http\Response
     */
    public function show(Investor $investor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function edit(Investor $investor)
    {
        //
        $investors = Investor ::all();
        
        return view('investor.investor',compact('investors','investor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investor $investor)
    {
        //

        $validated = $request->validate(
            [
               'investor_name' => 'required',
                'email' => 'required|email|unique:investors,email,'.$investor->id,
                'phone' => 'required|min:8|max:11|unique:investors,phone,'.$investor->id,
                'prefix' => 'required|unique:investors,prefix,'.$investor->id,
            ],[
                
                'investor_name.unique' => ' investor Name already exists',
                'email.unique' => ' Email already exists',
                'phone.unique' => ' Number already exists',
                'prefix.unique' => ' prefix already exists'
            ]
        );
       
        $investor->investor_name = $request->investor_name;
        $investor->email = $request->email;
        $investor->phone = $request->phone;
        $investor->prefix = $request->prefix;
        $investor->save();
        return redirect()->route('investor.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investor $investor)
    {
        //
        $investor->delete();
       return redirect()->route('investor.index');
    }
}

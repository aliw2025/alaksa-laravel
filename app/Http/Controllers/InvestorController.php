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
        $investors = Investor::where('investor_type', '!=', 1)->get();
        return view('investor.investor', compact('investors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $investors = Investor ::all();
        $investors = Investor::where('investor_type', '!=', 1)->get();
        return view('investor.investor', compact('investors'));
        return view('investor.add-new-investor', compact('investors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validating the incoming request
        $validated = $request->validate(
            [
                'investor_name' => 'required',
                'email' => 'required|email|unique:investors',
                'phone' => 'required|min:8|max:11|unique:investors',
                'prefix' => 'required|unique:investors',
            ],
            [

                'investor_name.unique' => ' investor Name already exists',
                'email.unique' => ' Email already exists',
                'phone.unique' => ' Number already exists',
                'prefix.unique' => ' prefix already exists'
            ]
        );

        // defining  invertor 
        $investor = new Investor();
        $investor->investor_name = $request->investor_name;
        $investor->email = $request->email;
        $investor->phone = $request->phone;
        $investor->prefix = $request->prefix;
        $investor->investor_type = $request->investor_type;
        $investor->save();

        //  creating the chart of accounts
        $investor_cash= $investor->charOfAccounts()->create([
            'account_name' => $investor->prefix . '_cash',
            'account_type' => 1,
            'opening_balance' => $request->opening_balance
        ]);

        $investor_eq= $investor->charOfAccounts()->create([
            'account_name' => $investor->prefix . '_equipment',
            'account_type' => 2,
            'opening_balance' => 0
        ]);

        $investor_inv= $investor->charOfAccounts()->create([
            'account_name' => $investor->prefix . '_inventory',
            'account_type' => 3,
            'opening_balance' => 0
        ]);

        $investor_eq= $investor->charOfAccounts()->create([
            'account_name' => $investor->prefix . '_equity',
            'account_type' => 5,
            'opening_balance' => -$request->opening_balance
        ]);

        $investor->leadgerEntries()->create([
            'account_id'=> $investor_cash->id ,
            'value'=> $request->opening_balance,
            'date'=>$investor->created_at

        ]);

        $investor->leadgerEntries()->create([
            'account_id'=> $investor_eq->id ,
            'value'=> - $request->opening_balance,
            'date'=>$investor->created_at
            
        ]);

        //  this transaction id create transaction_id and transaction_type
       
        // value of the transaction
        // $ledgerEntry = new InvestorLeadger();
        // $ledgerEntry->account_id = $investor->accounts->where('account_type', 1)->first()->id;
        // $ledgerEntry->transaction_type = "opening";
        // $ledgerEntry->transaction_id = $investor->id;
        // $ledgerEntry->value =  $request->opening_balance;
        // $ledgerEntry->date = $investor->created_at;
        // $ledgerEntry->save();

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
        $investors = Investor::all();

        return view('investor.investor', compact('investors', 'investor'));
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
                'email' => 'required|email|unique:investors,email,' . $investor->id,
                'phone' => 'required|min:8|max:11|unique:investors,phone,' . $investor->id,
                'prefix' => 'required|unique:investors,prefix,' . $investor->id,
            ],
            [

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

<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\Investor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartOfAccountController extends Controller
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
        $accounts = ChartOfAccount::where('account_type',4)->get();
        return view('capital-investments.accounts',compact('accounts'));

        
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
                'account_name' => 'required',
                'account_number' => 'required',
            ]);

        $investor = Investor::where('investor_type', '=', 1)->first();
        $investor->charOfAccounts()->create([
            'account_name' => $request->account_name,
            'account_type' => 4,
            'account_number'=>$request->account_number,
            'opening_balance' => 0
        ]);
      
       
        // dd($request->all());

        return redirect()->route('chartOfAccount.create');
    }

    public function userAccountsCreate(Request $request){

            

    }


    public function userAccountsStore(Request $request){



    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */

    public function show(ChartOfAccount $chartOfAccount)
    {
        //

    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(ChartOfAccount $chartOfAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChartOfAccount $chartOfAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChartOfAccount $chartOfAccount)
    {
        //
    }
}

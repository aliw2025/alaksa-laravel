<?php

namespace App\Http\Controllers;
use Auth;
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
        $accounts = ChartOfAccount::where('account_type', 4)->where('owner_type','App\Models\Investor')->get();
        return view('capital-investments.accounts', compact('accounts'));

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
            'bank_name'=>'required',
            'account_number' => 'required',
        ]);

        $investor = Investor::where('investor_type', '=', 1)->first();
        $investor->charOfAccounts()->create([
            'account_name' => $request->account_name,
            'account_type' => 4,
            'bank_name'=>$request->bank_name,
            'account_number' => $request->account_number,
            'opening_balance' => 0
        ]);

        // dd($request->all());
        return redirect()->route('chartOfAccount.create')->with('message','record saved');
    }


    public function userAccountsCreate(Request $request)
    {

        $user = $email = Auth::user();
        $accounts = ChartOfAccount::where('owner_type', 'App\Models\User')->get();
        return view('recovery.ro-accounts', compact('accounts','user'));

    }


    public function userAccountsStore(Request $request)
    {

        $validated = $request->validate(
        [
            'account_name' => 'required',
            'account_number' => 'required',
        ]);

        $user = $email = Auth::user();
        $user->charOfAccounts()->create([
            'account_name' => $request->account_name,
            'account_type' => 4,
            'account_number' => $request->account_number,
            'opening_balance' => 0
        ]);
    
        return redirect()->route('create-user-accounts');

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
        
        $accounts = ChartOfAccount::where('account_type', 4)->where('owner_type','App\Models\Investor')->get();
        return view('capital-investments.accounts', compact('accounts','chartOfAccount'));

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
    $validated = $request->validate(
        [
            'account_name' => 'required',
            'bank_name'=>'required',
            'account_number' => 'required',
        ]);

        $chartOfAccount->account_name = $request->account_name;
        $chartOfAccount->bank_name = $request->bank_name;
        $chartOfAccount->account_number= $request->account_number;
        $chartOfAccount->save();

       

       return redirect()->route('chartOfAccount.create')->with('message','record updated');
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

<?php

namespace App\Http\Controllers;

use App\Models\GLeadger;
use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GLController extends Controller
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
     * @param  \App\Models\GLeadger  $gLeadger
     * @return \Illuminate\Http\Response
     */
    public function show(GLeadger $gLeadger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GLeadger  $gLeadger
     * @return \Illuminate\Http\Response
     */
    public function edit(GLeadger $gLeadger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GLeadger  $gLeadger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GLeadger $gLeadger)
    {
        //
    }
    public function transferBalances(Request $request){

        $bank_accounts = ChartOfAccount ::where('account_type', 1)->orWhere('account_type', 4)->get();
        $investors = Investor::all();
        return view('capital-investments.transfer-balances',compact('bank_accounts','investors'));
    }
    public function bankTransfer(Request $request)
    {   
        dd($request->all());
        if($request->inv_1 == $request->inv_2){
            // $bnk_1 = ChartOfAccount ::where('account_id');
        }else{
            
        }
    }
    public function AccountBalances(Request $request)
    {   
        $investors = Investor::all();
        $bank_accounts = ChartOfAccount ::where('account_type', 1)->orWhere('account_type', 4)->get();
        $transactions = GLeadger::select('investor_id','account_id', DB::raw('sum(value) as value'))->where('value','!=',0)->whereHas('account', function ($query) {
            $query->where(function ($query2) {
                $query2->where('account_type', 1)->orWhere('account_type', 4);
            });
        })->groupBy('account_id')->groupBy('investor_id')->with('account')->with('investor')->get();
        
        return view('capital-investments.account-balances',compact('transactions','investors','bank_accounts'));
       
        // return $transactions;
        // // allbank accounts
        // $bank_acc  = ChartOfAccount::where(function ($query) {
        //     $query->where('account_type', 1)
        //           ->orWhere('account_type', 4);
        //         }
        //     )->get();
        // dd($bank_acc);
        // foreach($investors as $inv){
        //     foreach($bank_acc as $acc){
        //     }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GLeadger  $gLeadger
     * @return \Illuminate\Http\Response
     */
    public function destroy(GLeadger $gLeadger)
    {
        //
    }
}

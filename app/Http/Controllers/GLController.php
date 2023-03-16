<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\GLeadger;
use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransferRequests;
use Illuminate\Support\Facades\Input;

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

    public function userTransferBalances(Request $request){
        $user = Auth::user();
        $ro_bank_accounts = $user->charOfAccounts;
        $bank_accounts = ChartOfAccount ::where('owner_type','App\Models\Investor')->where(function($query){
            $query->where('account_type', 1)->orWhere('account_type', 4);
        })->get();
        $investors = Investor::all();
        return view('recovery.ro-transfer-balances',compact('bank_accounts','investors','ro_bank_accounts'));
    }
    public function addTransferRequest(Request $request){

        // dd($request->all());


        $tr = new TransferRequests();
        $tr->sender_account_id = $request->bnk_1;
        $tr->reciever_account_id = $request->bnk_2;
        $tr->amount = $request->amount;
        $tr->status = 0;
        $tr->owner_investor_id = $request->inv_1;
        $tr->save();
        
        return redirect()->route('ro-dashboard');
    }


    public function investorApprovalQueue(){

        $tr = TransferRequests::all();

        $t_pending = TransferRequests::where('status',0)->get();
        $t_appr = TransferRequests::where('status',1)->get();
        $t_cancel = TransferRequests::where('status',2)->get();
        return view('capital-investments.transfer-requests',compact('tr','$t_pending',,));

    }

    public function userApprovalQueue(){

        $user = Auth::user();
        $tr = TransferRequests::whereHas('sender_account',function($query) use($user){
            $query->where('owner_type','App\Models\User')->where('owner_id',$user->id);
        })->get();
        return view('recovery.ro-pending-fund-requests',compact('tr'));

    }

    public function userApproval(Request $request){

        $t = TransferRequests ::where('id',$request->tran_id)->first();
        if($request->input('submit')=='approve'){

               
             $t->status = 1;
             $t->save();
        }else{


            $t->status = 2;
            $t->save();
                
        }
        
        return redirect()->route('investor-transfer-queue');
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
        $bank_accounts = ChartOfAccount ::where('owner_type','App\Models\Investor')->where(function($query){
            $query->where('account_type', 1)->orWhere('account_type', 4);
        })->get();
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
    public function userAccountBalances(Request $request)
    {   
        $investors = Investor::all();
        $user = Auth::user();
        $bank_accounts = $user->charOfAccounts; 
        $transactions = GLeadger::select('investor_id','account_id', DB::raw('sum(value) as value'))->where('value','!=',0)->whereHas('account', function ($query) {
            $query->where(function ($query2) {
                $query2->where('account_type', 1)->orWhere('account_type', 4);
            });
        })->groupBy('account_id')->groupBy('investor_id')->with('account')->with('investor')->get();
        
        return view('recovery.ro-account_balances',compact('transactions','investors','bank_accounts'));
       
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

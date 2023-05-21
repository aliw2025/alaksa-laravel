<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;

class InvestmentController extends Controller
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
        $investors = Investor::all();
        
        // $bank_acc = ChartOfAccount::where(function ($query) {
        //     $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);})->get();
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        // dd($bank_acc);   
        return view('capital-investments.add_balance',compact('investors','bank_acc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'amount'=>'required',
            'description'=>'required',
            'date'=>'required'
        ]);
        $investment = new Investment();
        $investment->description = $request->description;
        $investment->amount = str_replace(',','',$request->amount);
        $investment->date = $request->date;
        $investment->investor_id = $request->investor_id;
        $investment->status = 1;
        $investment->account_id = $request->acc_type;
        $investment->save();
        // $user = Auth::user();
        // $investment->createLeadgerEntry($request->acc_type,$investment->amount,$request->investor_id,$request->date,$user->id);
        // $investment->createLeadgerEntry(8,-$investment->amount,$request->investor_id,$request->date,$user->id);
        $investors = Investor::all();
       
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        return redirect()->route('investment.show',$investment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment)
    {
        $investors = Investor::all();
       
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        return view('capital-investments.add_balance',compact('investors','bank_acc','investment'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Investment $investment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment)
    {
        //
    }
}

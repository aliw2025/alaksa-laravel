<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\ExpenseHead;
use App\Models\ExpensePayment;
use App\Models\Investor;
use Illuminate\Http\Request;

class ExpensePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investors = Investor::all();
        $expense_heads = ExpenseHead::all();
        $bank_acc = ChartOfAccount::where('owner_type','App\Models\Investor')->where(
            function($query) {
              return 
              $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);
             })->get();
        return view('payable.pay-expenses', compact('investors', 'expense_heads','bank_acc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){}
    
        //
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensePayment  $expensePayment
     * @return \Illuminate\Http\Response
     */
    public function show(ExpensePayment $expensePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensePayment  $expensePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpensePayment $expensePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensePayment  $expensePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpensePayment $expensePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensePayment  $expensePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensePayment $expensePayment)
    {
        //
    }
}

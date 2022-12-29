<?php

namespace App\Http\Controllers;

use App\Models\PaySalary;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Commission;




class PaySalaryController extends Controller
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
        $users = User::all();
        return view('hrm.paySalary',compact('users'));
    }
    public function paySalaryPost(Request $request){
        $users = User::all();
        $user = User::find($request->user_id);
        $salary = $user->designation->pay_Scale->scale_pay;
        $commissions = Commission::ReportData($request->from_date,$request->to_date,$request->user_id,3)->get();
        $com_am = $commissions->sum('amount');
        // dd($commissions->sum('amount'));
        return view('hrm.paySalary',compact('users','salary','com_am'));

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
     * @param  \App\Models\PaySalary  $paySalary
     * @return \Illuminate\Http\Response
     */
    public function show(PaySalary $paySalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaySalary  $paySalary
     * @return \Illuminate\Http\Response
     */
    public function edit(PaySalary $paySalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaySalary  $paySalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaySalary $paySalary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaySalary  $paySalary
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaySalary $paySalary)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PayScale;
use Illuminate\Http\Request;

class PayScaleController extends Controller
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
        //
        $scales = PayScale::all();
        return view('hrm.payScale',compact('scales'));
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
       $validated = $request->validate([
            'scale_name'=>'required',
            'scale_pay'=>'required',

       ]);
        $scale = new PayScale();
        $scale->scale_name = $request->scale_name;
        $scale->scale_pay = $request->scale_pay;
        $scale->save();

        return redirect()->route('payScale.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PayScale  $payScale
     * @return \Illuminate\Http\Response
     */
    public function show(PayScale $payScale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PayScale  $payScale
     * @return \Illuminate\Http\Response
     */
    public function edit(PayScale $payScale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PayScale  $payScale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayScale $payScale)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PayScale  $payScale
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayScale $payScale)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PayScale;
use Illuminate\Http\Request;

class payScaleContoller extends Controller
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
        return view('hrm.payScale');
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
        //
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

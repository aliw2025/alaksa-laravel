<?php

namespace App\Http\Controllers;

use App\Models\Investor;
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
        $investors = Investor ::all();
        return view('investor.investor',compact('investors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investors = Investor ::all();
        return view('investor.investor',compact('investors'));
        return view('investor.add-new-investor',compact('investors'));
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
                'investor_name' => 'required|unique:investors',
                'email' => 'required',
                'phone' => 'required',
                'prefix' => 'required',
            ],[
                'investor_name.required' => 'Please enter investor Name',
                'investor_name.unique' => ' investor Name already exists'
            ]
        );
        $investor = new Investor();
        $investor->investor_name = $request->investor_name;
        $investor->email = $request->email;
        $investor->phone = $request->phone;
        $investor->prefix = $request->prefix;
        $investor->save();
        return redirect()->route('investor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investor  $investor
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

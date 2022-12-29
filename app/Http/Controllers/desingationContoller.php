<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\PayScale;
use App\Models\User;
use Illuminate\Http\Request;

class desingationContoller extends Controller
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
    public function editDesignation($id){
        $designations  = Designation::all();
        $user = User::find($id);
        return view('hrm.edit-designation',compact('user','designations'));
    }

    public function changeDesignation(Request $request){

        // dd($request->all());

        $user = User::find($request->user_id);
        $user->designation_id = $request->designation_id;
        $user->save();
        
        return redirect()->route('users');
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
        $designations = Designation::all();
        return view('hrm.designation',compact('scales','designations'));
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
        $designation = new Designation();
        $designation->Name = $request->designation_name;
        $designation->pay_scale = $request->pay_scale;
        $designation->save(); 

        return redirect()->route('designation.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Supplier::all();  
        return view('supplier.supplier',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $suppliers = Supplier::all();  
        return view('supplier.supplier',compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:suppliers',
                'phone' => 'required|min:8|max:11|unique:suppliers',
                 'business_name'=>'required'
                
            ],[
                
                'supplier_name.unique' => ' supplier Name already exists',
                'email.unique' => ' Email already exists',
                'phone.unique' => ' Number already exists',
               
            ]
        );

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->business_name= $request->business_name;
        $supplier->address = $request->address;
        $supplier->save();


        $supplier_pay= $supplier->charOfAccounts()->create([
            'account_name' => $supplier->name . '_payable',
            'account_type' => 7,
            'opening_balance' => $request->opening_balance,
        ]);

        $supplier->leadgerEntries()->create([
            'account_id'=> $supplier_pay->id ,
            'value'=> 0,
            'date'=>$supplier->created_at
        ]);        
        return redirect()->route('supplier.index');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
        $suppliers = Supplier ::all();
        return view('supplier.supplier',compact('suppliers','supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
        $validated = $request->validate(
            [
               'name' => 'required',
                'email' => 'required|email|unique:suppliers,email,'.$supplier->id,
                'phone' => 'required|min:8|max:11|unique:suppliers,phone,'.$supplier->id,
                'business_name'=>'required'
                
            ],[
                
                'name.unique' => ' supplier Name already exists',
                'email.unique' => ' Email already exists',
                'phone.unique' => ' Number already exists',
                'prefix.unique' => ' prefix already exists'
            ]
        );
       
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->business_name= $request->business_name;
        $supplier->save();
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
        $supplier->delete();
        return redirect()->route('supplier.index');
    }
}

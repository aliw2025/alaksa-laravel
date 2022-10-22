<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = customer::all();
        return view('customer.customer', compact('customers'));
        return view('customer.add-new-customer', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = customer::all();
        return view('customer.customer', compact('customers'));
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
                'customer_name' => 'required',
                'email' => 'required|email|unique:customers',
                'phone' => 'required|min:8|max:11|unique:customers',
                'CNIC' => 'required|max:13|unique:customers',
            ],
            [
                'email.unique' => ' Email already exists',
                'phone.unique' => ' Number already exists',
                'CNIC.unique' => ' CNIC already exists',
            ]
        );

        
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->CNIC = $request->CNIC;
        $customer->save();

        return redirect()->route('customer.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
        $customers = Customer::all();

        return view('customer.customer', compact('customers', 'customer'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $validated = $request->validate(
            [
                'customer_name' => 'required',
                'email' => 'required|email|unique:customers,email,'.$customer->id,
                'phone' => 'required|min:8|max:11|unique:customers,phone,'.$customer->id,
                'CNIC' => 'required|max:13|unique:customers,CNIC,'.$customer->id,
            ],
            [
                'email.unique' => ' Email already exists',
                'phone.unique' => ' Number already exists',
                'CNIC.unique' => ' CNIC already exists',
            ]
        );

        
       
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->CNIC = $request->CNIC;
        $customer->save();

        return redirect()->route('customer.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->delete();
        return redirect()->route('customer.create');
    }

    public function customerByName(Request $request){

        $customers = Customer::where('customer_name','like','%'.$request->key.'%')->get();
        return  $customers; 
    }
    
}

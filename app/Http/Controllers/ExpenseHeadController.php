<?php

namespace App\Http\Controllers;



use App\Models\ExpenseHead;
use App\Models\SubExpenseHead;

use Illuminate\Http\Request;

class ExpenseHeadController extends Controller
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
       $heads = ExpenseHead::all();
        return view('expenses.expense_heads',compact('heads'));
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
        $expensehead = new ExpenseHead();
        $expensehead->name = $request->head_name;
        $expensehead->save();

        return redirect()->route('expenseHead.create');
    }
    
    function addSubexpHeads($id){
        $expensehead = ExpenseHead::find($id);
        $subHeads = SubExpenseHead::where('head_id',$id)->get();
        // dd($subHeads);  
        return view('expenses.add-sub-heads',compact('subHeads','expensehead'));

    }

    function getSubHeads(Request $request){

        $expensehead = ExpenseHead::find($request->id);
        $subHeads = SubExpenseHead::where('head_id',$request->id)->get();
        // dd($subHeads);  
        return $subHeads;


    }
    
    function storeSubexpHeads(Request $request){
        
        $subHead = new SubExpenseHead();
        $subHead->sub_head_name = $request->head_name;
        $subHead->head_id = $request->head_id;
        $subHead->save();

        

        return redirect()->route('add-sub-exp-head',$request->head_id);

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expensehead  $expensehead
     * @return \Illuminate\Http\Response
     */
    public function show(Expensehead $expensehead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expensehead  $expensehead
     * @return \Illuminate\Http\Response
     */
    public function edit(Expensehead $expensehead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expensehead  $expensehead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expensehead $expensehead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expensehead  $expensehead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expensehead $expensehead)
    {
        //
    }
}

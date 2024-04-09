<?php

namespace App\Http\Controllers;



use App\Models\ExpenseHead;
use App\Models\SubExpenseHead;
use Illuminate\Database\QueryException as DatabaseQueryException;

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
        $validated = $request->validate([
            'head_name'=>'required',
            
        ]);
        $expensehead = new ExpenseHead();
        $expensehead->name = $request->head_name;
        $expensehead->active = $request->active;
        $expensehead->save();

        return redirect()->route('expenseHead.create');
    }
    
    function addSubexpHeads($id){
        $expensehead = ExpenseHead::find($id);
        $subHeads = SubExpenseHead::where('head_id',$id)->get();
        // dd($subHeads);  
        return view('expenses.add-sub-heads',compact('subHeads','expensehead'));
        
    }
    function storeSubexpHeads(Request $request){
        $validated = $request->validate([
            'head_name'=>'required',
            
        ]);

        $subHead = new SubExpenseHead();
        $subHead->sub_head_name = $request->head_name;
        $subHead->head_id = $request->head_id;
        $subHead->active = $request->active;
        $subHead->save();
        return redirect()->route('add-sub-exp-head',$request->head_id);

    }

    function editSubexpHeads($id){
      
        $heads = ExpenseHead::all();
        $subHead = SubExpenseHead::find($id);
        $expensehead = ExpenseHead::find($subHead->head_id);
        $subHeads = SubExpenseHead::where('head_id',$subHead->head_id)->get();
        
        return view('expenses.add-sub-heads',compact('heads','subHead','expensehead','subHeads'));
        
    }

    function updateSubexpHeads(Request $request,$id){

        $subHead = SubExpenseHead::find($id);
        $subHead->sub_head_name = $request->head_name;
        $subHead->head_id = $request->head_id;
        $subHead->active = $request->active;
        $subHead->save();
        return redirect()->route('add-sub-exp-head',$request->head_id);
        
    }
    function deleteSubexpHeads($id){
      
       
        $subHead = SubExpenseHead::find($id);
        $expensehead = ExpenseHead::find($subHead->head_id);
       

        try {
            $subHead->delete();
           
            return redirect()->route('add-sub-exp-head', ['id' => $expensehead->id])->with('message', 'Item deleted successfully.');
           
        } catch (DatabaseQueryException $e) {

            return redirect()->back()->with('error', 'Cannot delete item. It is associated with other records.');
        }
        
    }
    


    function getSubHeads(Request $request){

        $expensehead = ExpenseHead::find($request->id);
        $subHeads = SubExpenseHead::where('head_id',$request->id)->get();
        // dd($subHeads);  
        return $subHeads;


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
    public function edit(ExpenseHead $expenseHead)
    {
       // $expenseHead = ExpenseHead::find($id);
       
        $heads = ExpenseHead::all();
      
        return view('expenses.expense_heads',compact('heads','expenseHead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expensehead  $expensehead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expensehead $expenseHead)
    {
        //
        $validated = $request->validate([
            'head_name'=>'required',
            
        ]);
       
        $expenseHead->name = $request->head_name;
        $expenseHead->active = $request->active;
        $expenseHead->save();

        return redirect()->route('expenseHead.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expensehead  $expensehead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expensehead $expenseHead)
    {
        //
        try {
            $expenseHead->delete();
            return redirect()->route('expenseHead.create')->with('message', 'Item deleted successfully.');
           
        } catch (DatabaseQueryException $e) {

            return redirect()->back()->with('error', 'Cannot delete item. It is associated with other records.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Investor;
use App\Models\ChartOfAccount;
use App\Models\ExpenseHead;
use App\Models\SubExpenseHead;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;

class ExpenseController extends Controller
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
        $investors = Investor::all();
        $heads  = ExpenseHead::all();
        $sheads = SubExpenseHead::all();
        // $bank_acc = ChartOfAccount::where(function ($query) {
        //     $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);})->get();
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        // dd($bank_acc);   
        return view('expenses.expense',compact('investors','bank_acc','heads','sheads'));
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
            'amount'=>'required',
            'description'=>'required',
            'date'=>'required'
        ]);
        $expense = new Expense();
        $expense->description = $request->description;
        $expense->amount = str_replace(',','',$request->amount);
        $expense->date = $request->date;
        $expense->investor_id = $request->investor_id;
        $expense->head_id = $request->head_id;
        $expense->sub_head_id = $request->sub_head_id;
        $expense->status = 1;
        $expense->account_id = $request->acc_type;
        $expense->save();
        // $user = Auth::user();
        // $expense->createLeadgerEntry($request->acc_type,$expense->amount,$request->investor_id,$request->date,$user->id);
        // $expense->createLeadgerEntry(8,-$expense->amount,$request->investor_id,$request->date,$user->id);
        $investors = Investor::all();
        $heads  = ExpenseHead::all();
        $sheads = SubExpenseHead::all();
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        return view('expenses.expense',compact('investors','bank_acc','heads','sheads','expense'))->with('message','Record Saved');

    }

    public function showExpenses(Request $request){
        
        $investors = Investor::all();
        
        return view('expenses.expenses_all',compact('investors'));
    }


    public function showExpensesPost(Request $request){

        $investors = Investor::all();
        
        $expenses = Expense::ShowExpenses($request->from_date, $request->to_date, $request->investor_id)->paginate(25);
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        $expenses->appends([
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'investor_id' => $request->investor_id,
           
        ]);
        // return $expenses;
        return view('expenses.expenses_all',compact('expenses','investors','bank_acc'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
        $investors = Investor::all();
        $heads  = ExpenseHead::all();
        $sheads = SubExpenseHead::all();
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        return view('expenses.expense',compact('investors','bank_acc','heads','sheads','expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
        if ($request->input('action') == "post") {

            return redirect()->route('post-expense', $request->all());
        
        }else if ($request->input('action') == "unpost") {
           
            return redirect()->route('unpost-expense', $request->all());
        }
         else if ($request->input('action') == "cancel") {
           
            return redirect()->route('cancel-expense', $request->all());
        }

        $validated = $request->validate([
            'amount'=>'required',
            'description'=>'required',
            'date'=>'required'
            
        ]);
        $expense = Expense::find($request->expense_id);
        $expense->description = $request->description;
        $expense->amount = str_replace(',','',$request->amount);
        $expense->date = $request->date;
        $expense->investor_id = $request->investor_id;
        $expense->head_id = $request->head_id;
        $expense->sub_head_id = $request->sub_head_id;
        $expense->status = 1;
        $expense->account_id = $request->acc_type;
        $expense->save();
        // $user = Auth::user();
        // $expense->createLeadgerEntry($request->acc_type,$expense->amount,$request->investor_id,$request->date,$user->id);
        // $expense->createLeadgerEntry(8,-$expense->amount,$request->investor_id,$request->date,$user->id);
        $investors = Investor::all();
        $heads  = ExpenseHead::all();
        $sheads = SubExpenseHead::all();
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        return view('expenses.expense',compact('investors','bank_acc','heads','sheads','expense'))->with('message','Record Saved');
        

    }

    public function postExpense(Request $request)
    {
        
        $expense = Expense::find($request->expense_id);
        if ($expense->status == 3) {
            return "expense alreaddy postedd";
        }
        $user = Auth::user();
        $expense->status = 3;
        $expense->save();
        $expense->createLeadgerEntry($request->acc_type,$expense->amount,$request->investor_id,$request->date,$user->id);
        $expense->createLeadgerEntry(8,-$expense->amount,$request->investor_id,$request->date,$user->id);
        $investors = Investor::all();
        $heads  = ExpenseHead::all();
        $sheads = SubExpenseHead::all();
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        return view('expenses.expense',compact('investors','bank_acc','heads','sheads','expense'))->with('message','Record Posted');


    }
    public function UnpostExpense(Request $request)
    {
        
        
        $expense = Expense::find($request->expense_id);
        if ($expense->status != 3) {
            return "only posted expense can be unposted";
        }
        $user = Auth::user();
        $expense->status = 1;
        $expense->save();
        $expense->leadgerEntries()->delete();
        
        $investors = Investor::all();
        $heads  = ExpenseHead::all();
        $sheads = SubExpenseHead::all();
        $bank_acc = ChartOfAccount::where('account_type', '=', 1)->orWhere('account_type', '=', 4)->get();
        return view('expenses.expense',compact('investors','bank_acc','heads','sheads','expense'))->with('message','Record Un Posted');


    }
    
    public function cancelExpense(Request $request)
    {   

        $expense = Expense::find($request->expense_id);
        if ($expense->status != 1) {
            return "transaction with entry status can be cancelled only";
        }
        $expense->status = 2;
        $expense->save();

        return redirect()->route('expense.show', $expense->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}

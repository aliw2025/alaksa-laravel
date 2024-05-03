<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Investor;
use App\Models\ChartOfAccount;
use App\Models\ExpenseHead;
use App\Models\SubExpenseHead;
use App\Models\TransactionStatus;
use App\Models\ExpenseAttachment;
use Illuminate\Support\Facades\File; 



use App\Http\Controllers\Controller;
use App\Models\ExpensePayment;
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
        $heads = ExpenseHead::where('active', 1)->get();
        $sheads = SubExpenseHead::where('active', 1)->get();
        //$heads  = ExpenseHead::all();
        //$sheads = SubExpenseHead::all();

        $bank_acc = ChartOfAccount::where('owner_type', 'App\Models\Investor')->where(
            function ($query) {
                return
                    $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);
            }
        )->get();
        return view('expenses.expense', compact('investors', 'bank_acc', 'heads', 'sheads'));
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
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);
        $expense = new Expense();
        $expense->description = $request->description;
        $expense->amount = str_replace(',', '', $request->amount);
        $expense->date = $request->date;
        $expense->investor_id = $request->investor_id;
        $expense->head_id = $request->head_id;
        $expense->sub_head_id = $request->sub_head_id;
        $expense->status = 1;
        $expense->account_id = $request->acc_type;
        $expense->save();

        $fileModel = new ExpenseAttachment();
        // dd($request->all());
        // dd();
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            // dd($file);s
            $fileModel->db_name  = $request->db_name;
            $fileName = $file->getClientOriginalName();
            $fileModel->expense_id = $expense->id;
            $filePath = $request->file('file_name')->storeAs('uploads/expenses', $fileName,  'public');
            $fileModel->name = $file->getClientOriginalName();
            $fileModel->file_path = url('/') . '/public/storage/' . $filePath;
            $fileModel->save();

        }


        return redirect()->route('expense.show', $expense)->with('message', 'Record Saved');
    }

    public function showExpenses(Request $request)
    {

        $investors = Investor::all();
        $heads  = ExpenseHead::all();
        $sheads = SubExpenseHead::all();
        $statuses = TransactionStatus::all();

        return view('expenses.expenses_all', compact('investors', 'heads', 'sheads', 'statuses'));
    }


    public function getSubHeads(Request $request)
    {
        $head_id = $request->head_id;

        $sheads = SubExpenseHead::where('head_id', $head_id)->get();
        return $sheads;
    }


    public function showExpensesPost(Request $request)
    {

        $investors = Investor::all();
        // $heads  = ExpenseHead::all();
        // $sheads = SubExpenseHead::all();
        $heads = ExpenseHead::where('active', 1)->get();
        $sheads = SubExpenseHead::where('active', 1)->get();
        $statuses = TransactionStatus::all();
        $head_id = $request->head_id;
        $shead = $request->sub_head_id;

        $expenses = Expense::ShowExpenses($request->from_date, $request->to_date, $head_id, $shead, $request->investor_id, $request->status_id);
        $sum = Expense::whereBetween('date', [$request->from_date, $request->to_date]);

        $sum = $expenses->sum('amount');
        if ($request->input('action') == "pdf") {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $expenses = $expenses->get();
            return view('expenses.expenses_report', compact('expenses', 'from_date', 'to_date', 'sum'));
        }

        $expenses = $expenses->paginate(20);
        $expenses->appends([
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'head_id' => $request->head_id,
            'sub_head_id' => $request->sub_head_id,
            'investor_id' => $request->investor_id,
            'status_id' => $request->status_id
        ]);
        return view('expenses.expenses_all', compact('expenses', 'investors', 'heads', 'statuses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {

        $investors = Investor::all();
        $heads  = ExpenseHead::all();
        $sheads = SubExpenseHead::all();
        $bank_acc = ChartOfAccount::where('owner_type', 'App\Models\Investor')->where(
            function ($query) {
                return
                    $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);
            }
        )->get();

        $attachment = ExpenseAttachment::where('expense_id', $expense->id)->latest()->first();

        return view('expenses.expense', compact('investors', 'bank_acc', 'heads', 'sheads', 'expense','attachment'));
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
        } else if ($request->input('action') == "unpost") {

            return redirect()->route('unpost-expense', $request->all());
        } else if ($request->input('action') == "cancel") {

            return redirect()->route('cancel-expense', $request->all());
        }

        $validated = $request->validate([
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required'

        ]);
        $expense = Expense::find($request->expense_id);
        $expense->description = $request->description;
        $expense->amount = str_replace(',', '', $request->amount);
        $expense->date = $request->date;
        $expense->investor_id = $request->investor_id;
        $expense->head_id = $request->head_id;
        $expense->sub_head_id = $request->sub_head_id;
        $expense->status = 1;
        $expense->account_id = $request->acc_type;
        $expense->save();

        $fileModel = new ExpenseAttachment();
        if ($request->hasFile('file_name')) {

            //$OldAttachment = ExpenseAttachment::where('expense_id', $expense->id)->latest()->first();
            //File::delete($OldAttachment->file_path);
            //$OldAttachment->delete();
            $file = $request->file('file_name');
            // dd($file);s
            $fileModel->db_name  = $request->db_name;
            $fileName = $file->getClientOriginalName();
            $fileModel->expense_id = $expense->id;
            $filePath = $request->file('file_name')->storeAs('uploads/expenses', $fileName,  'public');
            $fileModel->name = $file->getClientOriginalName();
            $fileModel->file_path = url('/') . '/public/storage/' . $filePath;
            $fileModel->save();

           
        }


        return redirect()->back()->with('message', 'Record Saved');
    }

    public function postExpense(Request $request)
    {

        $expense = Expense::find($request->expense_id);
        if ($expense->status == 3) {
            return "expense alreaddy postedd";
        }
        $user = Auth::user();
        // if(!Expense:: NegativeCheck($request->acc_type,$expense->amount,$request->investor_id)){
        //     return redirect()->back()->with('error_m', 'Balance insufficient');
        // }
        $expense->status = 3;
        $expense->save();
        $ad_payable_acc_no =  7;
        $expense->createLeadgerEntry($ad_payable_acc_no, -$expense->amount, $request->investor_id, $request->date, $user->id);
        // $expense->createLeadgerEntry($request->acc_type, $expense->amount, $request->investor_id, $request->date, $user->id);
        $expense->createLeadgerEntry(8, $expense->amount, $request->investor_id, $request->date, $user->id);
        return redirect()->back()->with('message', 'Record Posted');
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
        return redirect()->back()->with('message', 'Record Un Posted');
    }

    public function cancelExpense(Request $request)
    {

        $expense = Expense::find($request->expense_id);
        if ($expense->status != 1) {
            return "transaction with entry status can be cancelled only";
        }
        $expense->status = 2;
        $expense->save();
        return redirect()->back()->with('message', 'Record Cancelled');
    }

    public function expenseNetPayable(Request $request)
    {   
        $request->validate([
            'head_id'=>'required',
            'sub_head_id'=>'required',
            'investor_id'=>'required'
        ]);
        $net  = 0;
        $expenses = Expense::where('investor_id', $request->investor_id)
            ->where('head_id', $request->head_id)->where('sub_head_id', $request->sub_head_id)->where('status',3)->sum('amount');
        
        $payments = ExpensePayment::where('investor_id', $request->investor_id)
        ->where('head_id', $request->head_id)->where('sub_head_id', $request->sub_head_id)->where('status',3)->sum('amount');

        $net = $expenses - $payments;
        return $net;
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

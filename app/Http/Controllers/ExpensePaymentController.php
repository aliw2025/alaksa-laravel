<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\Expense;
use App\Models\ExpenseHead;
use App\Models\ExpensePayment;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensePaymentController extends Controller
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
        $investors = Investor::all();
        $expense_heads = ExpenseHead::all();
        $bank_acc = ChartOfAccount::where('owner_type','App\Models\Investor')->where(
            function($query) {
              return 
              $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);
             })->get();
        return view('payable.pay-expenses', compact('investors', 'expense_heads','bank_acc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validated = $request->validate([
            'amount' => 'required',
            'investor_id'=>'required',
            'head_id'=>'required',
            'sub_head_id'=>'required',
            'date' => 'required'
        ]);

        $id = ExpensePayment::max('id');
        if ($id == null) {
            $id = 0;
        }
        $num = str_pad($id + 1, 10, '0', STR_PAD_LEFT); 
        $investor = Investor::find($request->investor_id);
        $expense_payment = new ExpensePayment();
        $year = date('y');
        $expense_payment->payment_no = $investor->prefix . $year . $num;
        $expense_payment->note = $request->note;
        $expense_payment->amount = str_replace(',', '', $request->amount);
        $expense_payment->payment_date = $request->date;
        $expense_payment->investor_id = $request->investor_id;
        $expense_payment->head_id = $request->head_id;
        $expense_payment->sub_head_id = $request->sub_head_id;
        $expense_payment->status = 1;
        $expense_payment->transaction_expense = str_replace(',','',$request->tran_exp);
        $expense_payment->account_id = $request->acc_type;
        $expense_payment->save();
        return redirect()->route('expensePayment.show', $expense_payment)->with('message', 'Record Saved');
    }
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensePayment  $expensePayment
     * @return \Illuminate\Http\Response
     */
    public function show(ExpensePayment $expensePayment)
    {

        $investors = Investor::all();
        $expense_heads = ExpenseHead::all();
        $bank_acc = ChartOfAccount::where('owner_type','App\Models\Investor')->where(
            function($query) {
              return 
              $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);
             })->get();
        return view('payable.pay-expenses', compact('investors', 'expense_heads','bank_acc','expensePayment'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensePayment  $expensePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpensePayment $expensePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensePayment  $expensePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpensePayment $expensePayment)
    {
        
        if ($request->input('action') == "post") {

            return redirect()->route('post-expensePayment', $request->all());
        
        }
        else if ($request->input('action') == "unpost") {
           
            return redirect()->route('unpost-expensePayment', $request->all());
        }
        else if ($request->input('action') == "cancel") {
           
            return redirect()->route('cancel-expensePayment', $request->all());
        }

        $validate = $request->validate([
            'amount' => 'required',
            'investor_id'=>'required',
            'head_id'=>'required',
            'sub_head_id'=>'required',
            'date' => 'required'
        ]);
         
        $expensePayment->note = $request->note;
        $expensePayment->amount = str_replace(',', '', $request->amount);
        $expensePayment->payment_date = $request->date;
        $expensePayment->investor_id = $request->investor_id;
        $expensePayment->head_id = $request->head_id;
        $expensePayment->sub_head_id = $request->sub_head_id;
        $expensePayment->status = 1;
        $expensePayment->transaction_expense = str_replace(',','',$request->tran_exp);
        $expensePayment->account_id = $request->acc_type;
        $expensePayment->save();

        return redirect()->back()->with('message','Record Saved');

    }
    // show expenses payment
    public function cancelExpensePayment(Request $request){

        $expensePayment = ExpensePayment::find($request->expensePayment_id);
        if ($expensePayment->status != 1) {
            return "transaction with entry status can be cancelled only";
        }
        $expensePayment->status = 2;
        $expensePayment->save();

        return redirect()->back()->with('message','Record Cancelled');
    }

    public function postExpensePayment(Request $request)
    {
        $expensePayment = ExpensePayment::find($request->expensePayment_id);
        if ($expensePayment->status == 3) {
            return "expensePayment alreaddy posted";
        }elseif ($expensePayment->status == 2) {
            return "expensePayment cancelled cannot be posted";
        }

        $user = Auth::user();

        // $request = new Request([
        //     'supplier_id' => $expensePayment->supplier_id, // replace with actual supplier_id
        //     'investor_id' => $expensePayment->investor_id, // replace with actual investor_id
        // ]);

        // Call the supplierNetPayable method
        // $netPayable = $this->supplierNetPayable($request);
        
        // if($expensePayment->amount > $netPayable){
        //     return redirect()->back()->with('error_m', 'Amount is greater than net payable');
        // }
        

        // if(!ExpensePayment:: NegativeCheck($supplierPayment->account_id,$supplierPayment->amount,$request->investor_id)){
        //     return redirect()->back()->with('error_m', 'Balance insufficient');
        // }

        // if($supplierPayment->transaction_charges >0){

        //     $expense = new Expense();
        //     $expense->description = "supplier payment no: ".$supplierPayment->payment_no."  bank charges  ";
        //     $expense->amount = str_replace(',','',$supplierPayment->transaction_charges);
        //     $expense->date = $supplierPayment->payment_date;
        //     $expense->head_id = 1;
        //     $expense->status = 3;
        //     $expense->investor_id = $supplierPayment->investor_id;
        //     $expense->save();
        //     $supplierPayment->expense_id = $expense->id;
        //     $supplierPayment->save();
        //     // creating impact of expense on leadger
        //     $expense->createLeadgerEntry(8,$expense->amount,$supplierPayment->investor_id, $expense->date ,$user->id);
        //     $expense->createLeadgerEntry($supplierPayment->account_id,-$expense->amount,$supplierPayment->investor_id,$expense->date,$user->id);
        // }

       
       
        // // getting supplier supplierPayment account
        //$supplier = Supplier::find( $supplierPayment->supplier_id);
        // dd($supplier);
        //$sup_acc_id = $supplier->charOfAccounts->where('account_type', 7)->first()->id;
        //$total = SupplierPayment::PayableAmount($supplierPayment->investor_id,$sup_acc_id);
        // dd($total);
        // if($total-$supplierPayment->amount<0){
        //     return redirect()->back()->with('error_m','payment exceeded payable amount of '.$total);

        // }

        $expensePayment->status = 3;
        $expensePayment->save();

        // /************** Leadger Entries **********/
        $expensePayment->createLeadgerEntry(7,str_replace(',','',$expensePayment->amount),$expensePayment->investor_id,$expensePayment->payment_date,$user->id);
        $expensePayment->createLeadgerEntry($expensePayment->account_id,-str_replace(',','',$expensePayment->amount),$expensePayment->investor_id,$expensePayment->payment_date,$user->id);

        
       

        return redirect()->back()->with('message','Record Posted');
    }

    public function UnpostExpensePayment(Request $request)
    {
        $ExpensePayment = ExpensePayment::find($request->ExpensePayment_id);
        if ($ExpensePayment->status != 3) {
            return "only posted ExpensePayment can be unposted";
        }
        $user = Auth::user();
        $ExpensePayment->status = 1;
        $ExpensePayment->save();
        $ExpensePayment->leadgerEntries()->delete();
        if($ExpensePayment->expense_id){
            $expense = Expense::find($ExpensePayment->expense_id);
            $expense->status = 2;
            $expense->save();
            $expense->leadgerEntries()->delete();
        }
       
        return redirect()->back()->with('message','Record Un Posted');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensePayment  $expensePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensePayment $expensePayment)
    {
        //
    }
}

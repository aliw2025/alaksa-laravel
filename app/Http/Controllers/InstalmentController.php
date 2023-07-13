<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\Instalment;
use App\Models\InstalmentExtention;
use App\Models\InstalmentPayment;
use App\Models\Investor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Carbon\Cli\Invoker;
use Laravel\Sail\Console\InstallCommand;

class InstalmentController extends Controller
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


    }
    public function recieveInstalment(Instalment $instalment)
    {

        return view('sale.recieve_instalment', compact('instalment'));
    }

    public function payInstalmentNew(Request $request){
        
        $instalment = Instalment::find($request->instalment_id);
        $investors = Investor::all();
        // where('owner_type','App\Models\Investor')->
        $bank_acc = ChartOfAccount::where(
            function($query) {
              return 
              $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);
             })->get();
                            
        return view('sale.pay-instalment',compact('bank_acc','instalment','investors'));

    }


    public function payInstalmentNewShow($id){


        $instalmentPayment = InstalmentPayment::find($id); 
        $instalment = Instalment::find($instalmentPayment->instalment_id);
        $investors = Investor::all();
        // where('owner_type','App\Models\Investor')->
        $bank_acc = ChartOfAccount::where(
            function($query) {
              return 
              $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);
             })->get();

             return view('sale.pay-instalment',compact('instalmentPayment','bank_acc','instalment','investors'));

    }

    
    public function payInstalmentNewStore(Request $request){
       
        $validated = $request->validate([
            'amount_paid'=>'required',
            'pay_date'=>'required',
            'account_id'=>'required',
        ]);

    
        $instalment = Instalment::find($request->instalment_id);
        // add payment transaction here
        $payment = new InstalmentPayment();
        $payment->instalment_id = $instalment->id;
        $payment->amount = str_replace(',', '', $request->amount_paid);
        $payment->payment_date = $request->pay_date;
        $payment->notes = $request->notes;
        $payment->account_id= $request->account_id;
        $instalment->move_to_next = isset($request->move_to_next)?true:false;
        $payment->status = 1;
        
        $payment->save();
        $instalment->save();

        return redirect()->route('pay-instalment-new-show',$payment->id)->with('message','Record Saved');
    }


    public function payInstalmentNewUpdate(Request $request){
        


        if ($request->input('action') == "post") {

            return redirect()->route('pay-instalment-new-post', $request->all());

        }else if ($request->input('action') == "unpost"){

            return redirect()->route('pay-instalment-new-unpost', $request->all());
        }
         else if ($request->input('action') == "cancel") {
            return redirect()->route('pay-instalment-new-cancel', $request->all());
        }


        $validated = $request->validate([
            'amount_paid'=>'required',
            'pay_date'=>'required',
            'account_id'=>'required',
        ]);

    
        // add payment transaction here
        $payment = InstalmentPayment::find($request->id);
        $instalment = Instalment::find($payment->instalment_id);
        $payment->amount = str_replace(',', '', $request->amount_paid);
        $payment->payment_date = $request->pay_date;
        $payment->notes = $request->notes;
        $payment->account_id= $request->account_id;
        $instalment->move_to_next = isset($request->move_to_next)?true:false;
        $instalment->save();
        $payment->status = 1;
        $payment->save();


        return redirect()->back()->with('message','Record Saved');


    }
    

    
    public function payInstalmentNewPost(Request $request){

        $instalment = Instalment::find($request->instalment_id);
        $instalmentPayment = InstalmentPayment::find($request->id);
        $sale = $instalment->sale;
        $instalment->amount_paid = $instalment->amount_paid + str_replace(',', '', $instalmentPayment->amount);
        $user = Auth::user();
       
        if ($instalment->move_to_next==true) {
            $next_instalment = Instalment::find($request->instalment_id + 1);
            if ($next_instalment == NULL || $next_instalment->sale_id != $sale->id) {

                return redirect()->back()->with("error_m" , "next instalment not found");
            }
            $next_instalment->amount = $next_instalment->amount + ($instalment->amount - $instalment->amount_paid);
            $instalment->moving_amount = $instalment->amount - $instalment->amount_paid;
            $instalment->amount = $instalment->amount_paid;
            $next_instalment->save();

        }
        if ($instalment->amount_paid > $instalment->amount) {
            return redirect()->back()->with("error_m" , "Amount cannot be greater than pending amount");

        }

        if ($instalment->amount_paid == $instalment->amount) {
            $instalment->instalment_paid = 1;
        }

        $instalment->save();
        // calculate commisions 
        $investor = Investor::find($sale->investor_id);
        $inv_per = $sale->selling_price / $sale->total;
        // item price recovry
        $ins_mon = str_replace(',', '', $instalmentPayment->amount) * $inv_per;
        // each investor share in markup profit
       
        $alp_share = 0.5;
        $inv_share = 1-$alp_share;
        $share1 = (str_replace(',', '', $instalmentPayment->amount) - $ins_mon) * $inv_share;
        $share2 = (str_replace(',', '', $instalmentPayment->amount) - $ins_mon) * $alp_share;
       
        $instalmentPayment->status = 3;
        $instalmentPayment->save();
        //*********************** Leadger  *********************/
        // debit cash of investor for inventory recovery
        $instalmentPayment->createLeadgerEntry($instalmentPayment->account_id, $ins_mon+$share1, $investor->id, $instalmentPayment->payment_date, $user->id);
        //  * credit recievable of inventory recovery
        $instalmentPayment->createLeadgerEntry(5, -$ins_mon-$share1, $investor->id, $instalmentPayment->payment_date, $user->id);
        // debit company cash of markup
        $instalmentPayment->createLeadgerEntry($instalmentPayment->account_id, $share2, 1, $instalmentPayment->payment_date, $user->id);
        // * credit  company  recievable of markup
        $instalmentPayment->createLeadgerEntry(5, -$share2, 1, $instalmentPayment->payment_date, $user->id);
       
        //*********************** Instalment Commission  *********************/
        $instalment->createInstalmentComision($sale, $user->id, $instalmentPayment);

        return redirect()->back()->with('message','record posted');
        
    }


    public function payInstalmentNewUnPost(Request $request){

        $instalment = Instalment::find($request->instalment_id);
        $payment = InstalmentPayment::find($request->id);
        $sale = $instalment->sale;

        if ($instalment->move_to_next==true) {
            $next_instalment = Instalment::find($request->instalment_id + 1);
            if ($next_instalment == NULL || $next_instalment->sale_id != $sale->id) {

                return redirect()->back()->with("error" , "next instalment not found");
            }
            $next_instalment->amount = $next_instalment->amount - $instalment->moving_amount;
            $instalment->amount = $instalment->amount+$instalment->moving_amount;
            $next_instalment->save();

        }
        $instalment->amount_paid = $instalment->amount_paid - str_replace(',', '', $payment->amount);

        if ($instalment->amount_paid != $instalment->amount) {
            $instalment->instalment_paid = 0;
        }

        $payment->status=1;
        $payment->save();
        $instalment->save();    
        // deleting leadger impact   
        $payment->leadgerEntries()->delete();

        //*********************** Instalment Commission  deleting *********************/
        $instalment->saleCommision()->delete();
        return redirect()->back()->with('message','Record Un Posted');
    }

    public function payInstalmentNewCancel(Request $request){

        $instalment = Instalment::find($request->instalment_id);
        $payment = InstalmentPayment::find($request->id);
        $payment->status = 2;
        $payment->save();
        return redirect()->back()->with('message','Record cancelled');



    }


    public function payInstalment(Request $request)
    {

        $user = Auth::user();
        // dd($requssest->all());
        $instalment = Instalment::find($request->id);
        $sale = $instalment->sale;
        $instalments = $sale->instalments;
        $instalment->amount_paid = $instalment->amount_paid + str_replace(',', '', $request->amount_paid);

        if (isset($request->move_to_next)) {
            $next_instalment = Instalment::find($request->id + 1);
            if ($next_instalment == NULL || $next_instalment->sale_id != $sale->id) {

                return redirect()->route('get-sale-instalments', ["id" => $sale->id, "user_exception" => "next instalment not found"]);
            }
            $next_instalment->amount = $next_instalment->amount + ($instalment->amount - $instalment->amount_paid);
            $instalment->amount = $instalment->amount_paid;
            $next_instalment->save();

        }

        if ($instalment->amount_paid > $instalment->amount) {
            $user_exception = "amount cannot be greater than due amount";
            return redirect()->route('get-sale-instalments', ["id" => $sale->id, "user_exception" => $user_exception]);

        }

        // add payment transaction here
        $payment = new InstalmentPayment();
        $payment->instalment_id = $instalment->id;
        $payment->amount = str_replace(',', '', $request->amount_paid);
        $payment->payment_date = $request->pay_date;
        $payment->notes = $request->notes;
        $payment->save();

        if ($instalment->amount_paid == $instalment->amount) {
            $instalment->instalment_paid = 1;
        }
        $instalment->save();
        // calculate commisions 
        $investor = Investor::find($sale->investor_id);
        $inv_per = $sale->selling_price / $sale->total;
        // item price recovry
        $ins_mon = str_replace(',', '', $request->amount_paid) * $inv_per;
        // each investor share in markup profit
       
        $alp_share = 0.5;
        $inv_share = 1-$alp_share;
        $share1 = (str_replace(',', '', $request->amount_paid) - $ins_mon) * $inv_share;
        $share2 = (str_replace(',', '', $request->amount_paid) - $ins_mon) * $alp_share;

        //*********************** Leadger  *********************/
        // debit cash of investor for inventory recovery
        $payment->createLeadgerEntry($request->account, $ins_mon+$share1, $investor->id, $request->pay_date, $user->id);
        //  * credit recievable of inventory recovery
        $payment->createLeadgerEntry(5, -$ins_mon-$share1, $investor->id, $request->pay_date, $user->id);
        // debit company cash of markup
        $payment->createLeadgerEntry($request->account, $share2, 1, $request->pay_date, $user->id);
        // * credit  company  recievable of markup
        $payment->createLeadgerEntry(5, -$share2, 1, $request->pay_date, $user->id);
       
        //*********************** Instalment Commission  *********************/
        $instalment->createInstalmentComision($sale, $user->id, $payment);
        return redirect()->route('get-sale-instalments', ['id' => $sale->id]);
        
        

    }


    public function showInstalmentDetails($id)
    {

        $instalment_payments = InstalmentPayment::where('instalment_id', $id)->get();
        return view('sale.instalment_payment_details', compact('instalment_payments'));

    }
    public function showInstalmentPayment($id)
    {

        $instalment_payments = InstalmentPayment::where('id', $id)->get();
        return view('sale.instalment_payment_details', compact('instalment_payments'));

    }

    public function showUpcomingInstalments(Request $request)
    {   
        // dd($request->all());

        // $instalments = Instalment::all();
        $customer_name = $request->customer_name;
        $customer_id = $request->customer_id;
        if (count($request->all()) > 0) {
            
            
            $from_date = new Carbon($request->from_date); 
            $to_date  = new Carbon ($request->to_date);
           

            $sales = Instalment::SearchInstalment($request->from_date, $request->to_date, $request->customer_name, $request->customer_id, $request->instalment_paid)->paginate(20);
            $sales->appends([
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'customer_name' => $request->customer_name,
                'customer_id' => $request->customer_id,
                'invoice_no' => $request->invoice_no
            ]);
            return view('recovery.ro-uc-instalments', compact('sales','from_date','to_date','customer_name','customer_id'));
        }
        else {
            // dd('request is empty');
            $mytime = Carbon::now();   
            $mytime2 = Carbon::now();         
            $mytime2->day(1);
            // $mytime2->year(2021);
            $mytime2->hour(0);
            $mytime2->minute(0);
            $mytime2->second(0);         
            
            $sales = Instalment::SearchInstalment($mytime2,$mytime, $request->customer_name, $request->customer_id, $request->instalment_paid)->paginate(10);
            $sales->appends([
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'customer_name' => $request->customer_name,
                'customer_id' => $request->customer_id,
                'invoice_no' => $request->invoice_no
            ]);
            $from_date = $mytime2;
            $to_date = $mytime;
            // dd($sales);
            return view('recovery.ro-uc-instalments', compact('sales','from_date','to_date','customer_name','customer_id'));
        }



    }

    public function extendInstalment(Request $request){
        
        // dd($request->all());
        $validated = $request->validate([
            'new_date'=>'required',
        ]);
        
        $user = Auth::user();

        // changing instalment due date
        $instalment = Instalment::find($request->id);
        $prev_due_date = $instalment->due_date;
        $instalment->due_date = $request->new_date;
        $instalment->save();

        // recording the history 
        $instalmentExt = new InstalmentExtention();
        $instalmentExt->note = $request->note;
        $instalmentExt->user_id = $user->id;
        $instalmentExt->note = $request->note;
        $instalmentExt->instalment_id = $request->id;
        $instalmentExt->previous_date =  $prev_due_date;
        $instalmentExt->current_date =   $request->new_date;
        $instalmentExt->save();



        return redirect('/get-sale-instalments?id='.$request->sale_id.'&ins_id='.$request->id);


    }

    public function getInstalmentExt(Request $request){

        $insExts = InstalmentExtention::where('instalment_id',$request->id)->get();
        
        return $insExts;


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
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function show(Instalment $instalment)
    {
        return $instalment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function edit(Instalment $instalment)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instalment $instalment)
    {
    //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instalment  $instalment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instalment $instalment)
    {
    //
    }
}

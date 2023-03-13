<?php

namespace App\Http\Controllers;

use App\Models\Instalment;
use App\Models\InstalmentPayment;
use App\Models\Investor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    public function recieveInstalment(Instalment $instalment) {

        return view('sale.recieve_instalment',compact('instalment'));
    }

    public function payInstalment(Request $request){
       
        $user = Auth::user();
        // dd($requssest->all());
        $instalment = Instalment::find($request->id);
        $sale = $instalment->sale;
        $instalments = $sale->instalments;
        $instalment->amount_paid = $instalment->amount_paid+ str_replace(',','',$request->amount_paid);
        
        if(isset($request->move_to_next)){
            $next_instalment = Instalment::find($request->id+1);
            if($next_instalment==NULL || $next_instalment->sale_id !=$sale->id){

                return redirect()->route('get-sale-instalments',["id"=>$sale->id,"user_exception"=>"next instalment not found"]);
            }
            $next_instalment->amount = $next_instalment->amount +( $instalment->amount - $instalment->amount_paid);
            $instalment->amount = $instalment->amount_paid;
            $next_instalment->save();

        }

        if($instalment->amount_paid > $instalment->amount){
            $user_exception = "amount cannot be greater than due amount";
            return redirect()->route('get-sale-instalments',["id"=>$sale->id,"user_exception"=>$user_exception]);
           
        }

        // add payment transaction here
        $payment = new InstalmentPayment();
        $payment->instalment_id = $instalment->id;
        $payment->amount =  str_replace(',','',$request->amount_paid);
        $payment->payment_date = $request->pay_date;
        $payment->notes = $request->notes;
        $payment->save();

        if($instalment->amount_paid==$instalment->amount){
            $instalment->instalment_paid = 1;
        }
        $instalment->save();
        // calculate commisions 
        $investor = Investor::find($sale->investor_id);
        $inv_per = $sale->selling_price  / $sale->total;
        // item price recovry
        $ins_mon =  str_replace(',','',$request->amount_paid) * $inv_per;
        // each investor share in markup profit
        $share = ( str_replace(',','',$request->amount_paid) - $ins_mon) * 0.50;
        
        //*********************** Leadger  *********************/
        // debit cash of investor for inventory recovery
        $payment->createLeadgerEntry($request->account,$ins_mon,$investor->id,$request->pay_date,$user->id);
        //  * credit recievable of inventory recovery
        $payment->createLeadgerEntry(5,-$ins_mon,$investor->id,$request->pay_date,$user->id);
        // debit company cash of markup
        $payment->createLeadgerEntry($request->account,$share,1,$request->pay_date,$user->id);
        // * credit  company  recievable of markup
        $payment->createLeadgerEntry(5,-$share,1,$request->pay_date,$user->id);
        // debit investor cash  of markup
        $payment->createLeadgerEntry($request->account,$share,$investor->id,$request->pay_date,$user->id);
        // * credit  investor  recievable of markup
        $payment->createLeadgerEntry(5,-$share,$investor->id,$request->pay_date,$user->id);
        
        //*********************** Instalment Commission  *********************/
        $instalment->createInstalmentComision($sale,$user->id,$payment);
        return redirect()->route('get-sale-instalments',['id'=>$sale->id]);

    }


    public function showInstalmentDetails($id){

        $instalment_payments = InstalmentPayment::where('instalment_id',$id)->get();
        return view('sale.instalment_payment_details',compact('instalment_payments'));

    }
    public function showInstalmentPayment($id){

        $instalment_payments = InstalmentPayment::where('id',$id)->get();
        return view('sale.instalment_payment_details',compact('instalment_payments'));

    }

    public function showUpcomingInstalments(){
    
        $instalments = Instalment::all();

        // // dd($request->all());
        // $sales = Sale::SearchSale($request->from_date, $request->to_date, $request->customer_name, $request->customer_id, $request->invoice_no)->paginate(10);
        // $sales->appends([
        //     'from_date' => $request->from_date,
        //     'to_date' => $request->to_date,
        //     'customer_name' => $request->customer_name,
        //     'customer_id' => $request->customer_id,
        //     'invoice_no' => $request->invoice_no
        // ]);

        return view('recovery.ro-uc-instalments');
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

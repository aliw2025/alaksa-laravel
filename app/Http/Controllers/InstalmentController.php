<?php

namespace App\Http\Controllers;

use App\Models\Instalment;
use App\Models\InstalmentExtention;
use App\Models\InstalmentPayment;
use App\Models\Investor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

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

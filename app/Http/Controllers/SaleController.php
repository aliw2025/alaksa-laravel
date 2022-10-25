<?php

namespace App\Http\Controllers;

use App\Models\Instalment;
use App\Models\Sale;
use App\Models\Inventory;
use App\Models\Investor;
use App\Models\InvestorLeadger;

use App\Models\Purchase;
use App\Models\Item;
use App\Models\PurchaseItem;
use App\Models\Payable;
use App\Models\Supplier;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;


class SaleController extends Controller
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
        $suppliers = Supplier::all();
        return view('sale.sale', compact('investors', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // finding the investor to get investor name
        $investor = Investor::find($request->investor_id);
        // creatin the sale 
        $sale = new Sale();
        // getting sale id for sale invoice
        $id = Sale::max('id');
        if ($id == null) {
            $id = 0;
        }
        // create a 14 digit sale invoice
        $num = str_pad($id + 1, 10, '0', STR_PAD_LEFT);
        $sale->invoice_no = $investor->prefix . '22' . $num;
        $sale->customer_id = $request->customer_id;
        $sale->item_id = $request->item_id;
        $sale->store_id = 1;
        $sale->investor_id = $request->investor_id;
        if ($request->sale_type == 2) {
            $payment_type = "Cash";
            $sale->total = $request->selling_price;
        }else{
            $payment_type = "Instalments";
            $sale->total = $request->total_sum;
        }
        
        $sale->sale_date = $request->sale_date;
        $sale->save();

        if ($request->sale_type == 1) {
            
            // creating down payment
            $instalment = new Instalment();
            $instalment->sale_id = $sale->id;
            $instalment->amount = $request->down_payment;
            $instalment->instalment_paid = true;
            $instalment->due_date = $request->sale_date;
            $instalment->save();

            $temp =  new Carbon($request->sale_date);

            // creatting the instalments for the sale
            for ($i = 0; $i < $request->plan; $i++) {

                $next = $temp->addMonth();
                $instalment = new Instalment();
                $instalment->sale_id = $sale->id;
                $instalment->amount = $request->instalment_per_month;
                $instalment->instalment_paid = false;
                $instalment->due_date = $next;
                $instalment->save();
                $temp = $next;
            }
        }
       
       
      $sale_detail = null;
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'sale'=> $sale,
            'sale_detail'=> $sale_detail,
            'payment_type' => $payment_type,
            'selling_price' => $request->selling_price,
            'markup' =>$request->mark_up,
            'plan'=> $request->plan

        ];
        

        $pdf = PDF::loadView('sale.sale_invoice_pdf', $data);

        return $pdf->stream('my.pdf', array('Attachment' => 0));

        

        
        // return redirect()->route('get-sales', $request->investor_id);
        // dd($request->all());
    }

    public function testPdf()
    {
        $sale = null;
        $sale_detail = null;
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'sale'=> $sale,
            'sale_detail'=> $sale_detail,
        ];
        

        $pdf = PDF::loadView('sale.sale_invoice_pdf', $data);

        return $pdf->stream('my.pdf', array('Attachment' => 0));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
    }

    public function showSales($id)
    {
        // dd('i am hit');
        $investor = Investor::find($id);
        $sales = $investor->sales;
        // return $sales;
        return view('sale.sale-list', compact('sales', 'investor'));
    }

    public function showInstalments(Sale $sale)
    {
        // dd('i am hit');
        // dd($sale);
        $instalments = $sale->instalments;
        // dd($instalments);
        // return $sales;
        return view('sale.sale-instalments', compact('sale', 'instalments'));
    }
    public function  getInvoices(Request $request)
    {

        $sales = Sale::where('invoice_no', 'like', '%' . $request->key . '%')->get();

        return $sales;
    }
}

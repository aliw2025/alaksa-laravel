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
use App\Models\Commission;
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
        $sale->mar_of_id = $request->mar_of_id;
        $sale->rec_of_id = $request->rec_of_id;
        $sale->investor_id = $request->investor_id;

        if ($request->sale_type == 2) {

            $payment_type = "Cash";
            $sale->total = $request->selling_price;
        } else {

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

        // updating inventory 
        $inventory = Inventory::where('investor_id', '=', $sale->investor_id)->where('item_id', '=', $sale->item_id)->first();
        $inventory->quantity =  $inventory->quantity - 1;
        $inventory->save();

        // calculating commission for maretinggg officer
        $commision = new Commission();
        $commision->commission_type = 1;
        $commision->user_id = $sale->mar_of_id;
        
        $sale->saleCommision()->create(
            [
                'commission_type' => 1,
                'user_id' => $sale->mar_of_id,
                'amount' => $sale->total * 0.01,
                'status' => 0,
                'earned_date' => $sale->sale_date
            ]
        );
       





        // getting investory inventory account 
        $inv_acc_id =  $investor->charOfAccounts->where('account_type', 3)->first()->id;
        //  getting investor recievable account
        $inv_rcv_acc = $investor->charOfAccounts->where('account_type', 5)->first()->id;
        // getting investor unrealized profit account
        $inv_un_pft_acc = $investor->charOfAccounts->where('account_type', 9)->first()->id;
        //  getting company
        $cmp = Investor::where('investor_type', '=', 1)->first();
        //  getting company cash account
        $cmp_cash_acc =  $cmp->charOfAccounts->where('account_type', 1)->first()->id;
        //  getting company recibable account
        $cmp_rcv_acc =  $cmp->charOfAccounts->where('account_type', 5)->first()->id;
        //  getting company unrealized profit account
        $cmp_un_pft_acc =  $cmp->charOfAccounts->where('account_type', 9)->first()->id;
        // getting company trade discount profit account
        $cmp_td_pft_acc =  $cmp->charOfAccounts->where('account_type', 10)->first()->id;

        // leadger entry for credit inventory
        $sale->leadgerEntries()->create([
            'account_id' =>  $inv_acc_id,
            'value' => -$request->selling_price,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);

        //  leadger entry for debit recievable of inventory
        $sale->leadgerEntries()->create([
            'account_id' =>  $inv_rcv_acc,
            'value' => $request->selling_price,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);

        // calculating profit share of investor and company
        $inv_mark_pft = ($request->total_sum - $request->selling_price) * 0.50;
        $cmp_mark_pft =  $inv_mark_pft;

        // leadger entry for debit recievable of markup
        $sale->leadgerEntries()->create([
            'account_id' =>  $inv_rcv_acc,
            'value' => $inv_mark_pft,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);
        // leadger entry for credit markup profit
        $sale->leadgerEntries()->create([
            'account_id' =>  $inv_un_pft_acc,
            'value' => -$inv_mark_pft,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);

        // leadger entry for company debit recievable of markup
        $sale->leadgerEntries()->create([
            'account_id' =>  $cmp_rcv_acc,
            'value' => $inv_mark_pft,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);
        // leadger entry for credit markup profit
        $sale->leadgerEntries()->create([
            'account_id' =>  $cmp_un_pft_acc,
            'value' => -$inv_mark_pft,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);

        $item_price = $investor->inventories()->where('item_id', '=', $request->item_id)->first()->unit_cost;
        $trade_discount = $request->selling_price - $item_price;

        // leadger entry for company debit cash of trade profit
        $sale->leadgerEntries()->create([
            'account_id' => $cmp_cash_acc,
            'value' => $trade_discount,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);

        // leadger entry for credit trade discount profit
        $sale->leadgerEntries()->create([
            'account_id' => $cmp_td_pft_acc,
            'value' => -$trade_discount,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date
        ]);



        //  printing invoice
        $sale_detail = null;
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'sale' => $sale,
            'sale_detail' => $sale_detail,
            'payment_type' => $payment_type,
            'selling_price' => $request->selling_price,
            'markup' => $request->mark_up,
            'plan' => $request->plan

        ];
        $pdf = PDF::loadView('sale.sale_invoice_pdf', $data);
        return $pdf->stream('my.pdf', array('Attachment' => 0));
        // return redirect()->route('get-sales', $request->investor_id);
    }

    public function testPdf()
    {
        //  printing invoice
        $sale = new Sale();
        // getting sale id for sale invoice
        $id = Sale::max('id');
        if ($id == null) {
            $id = 0;
        }
        // create a 14 digit sale invoice
        $num = str_pad($id + 1, 10, '0', STR_PAD_LEFT);
        $sale->invoice_no = 'AD' . '22' . $num;
        $sale->customer_id = 1;
        $sale->item_id = 2;
        $sale->store_id = 1;
        $sale->investor_id = 1;
        if (0) {
            $payment_type = "Cash";
            $sale->total = 12000;
        } else {
            $payment_type = "Instalments";
            $sale->total = 14400;
        }

        $sale->sale_date = date('m/d/Y');

        $sale_detail = null;
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'sale' => $sale,
            'sale_detail' => $sale_detail,
            'payment_type' => $payment_type,
            'selling_price' => 12000,
            'markup' => 20,
            'plan' => 6

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

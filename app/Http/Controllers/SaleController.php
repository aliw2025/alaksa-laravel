<?php

namespace App\Http\Controllers;

use App\Models\Instalment;
use App\Models\InstalmentPayment;

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
use App\Models\GLeadger;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use FontLib\Table\Type\cmap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        $type = 1;
        return view('sale.sale', compact('investors', 'suppliers', 'type'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //**************  CREATING SALE *****************/
        $user = Auth::user();
        // finding the investor to get investor name
        $investor = Investor::find($request->investor_id);
        // check if down payment paid     
        $down_payment = false;
        if ($request->input('down_payment_paid') != NULL) {
            $down_payment = true;
        }

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
        $sale->status = 1;
        $sale->plan = $request->plan;
        $sale->markup = $request->markup;
        $sale->user_id = $user->id;
        // creaating a selling price var
        $selling_price = str_replace(',', '', $request->selling_price);
        $sale->selling_price =  $selling_price;
        $sale->sale_type = $request->sale_type;
        // if sale is of type cash 
        if ($request->sale_type == 2) {
            $payment_type = "Cash";
            $sale->total =  $selling_price;
        } else {
            $payment_type = "Instalments";
            $sale->total = str_replace(',', '', $request->total_sum);
        }
        $sale->sale_date = $request->sale_date;
        $sale->save();


        //**************  creating instalments  *****************/
        // if its an instalments sale
        if ($request->sale_type == 1) {
            // creating down payment
            $instalment = new Instalment();
            $instalment->sale_id = $sale->id;
            $instalment->amount = str_replace(',', '', $request->down_payment);
            // if down payment is paid $down_payment is true
            $instalment->instalment_paid = $down_payment;
            $instalment->due_date = $request->sale_date;
            $instalment->instalment_no = 0;
            $instalment->amount_paid = $down_payment ? str_replace(',', '', $request->down_payment) : 0;
            $instalment->save();

            //**************  creating inventory and markup share  *****************/
            $inv_per = floatval($selling_price) / $sale->total;
            // item price recovery
            $ins_mon = str_replace(',', '', $request->down_payment) * $inv_per;
            // each investor share in markup profit
            $share = (str_replace(',', '', $request->down_payment) - $ins_mon) * 0.50;

            if ($down_payment) {
                $payment = new InstalmentPayment();
                $payment->instalment_id = $instalment->id;
                $payment->amount =   $ins_mon;
                $payment->payment_date = $request->sale_date;
                $payment->save();

                // debit cash of investor for inventory recovery
                $payment->createLeadgerEntry($request->acc_type, $ins_mon, $investor->id, $sale->sale_date, $user->id);
                //*  credit recievable of inventory recovery
                $payment->createLeadgerEntry(5, -$ins_mon, $investor->id, $sale->sale_date, $user->id);
                // debit investor cash  of markup
                $payment->createLeadgerEntry($request->acc_type, $share, $investor->id, $sale->sale_date, $user->id);
                //* credit investor recievable of markup
                $payment->createLeadgerEntry(5, -$share, $investor->id, $sale->sale_date, $user->id);
                // debit company cash of markup
                $payment->createLeadgerEntry($request->acc_type, $share, 1, $sale->sale_date, $user->id);
                //*  credit company  recievable of markup
                $payment->createLeadgerEntry(5, -$share, 1, $sale->sale_date, $user->id);
            }

            $temp =  new Carbon($request->sale_date);
            // creatting the instalments for the sale
            for ($i = 0; $i < $request->plan; $i++) {
                $next = $temp->addMonth();
                $instalment = new Instalment();
                $instalment->sale_id = $sale->id;
                $instalment->amount = str_replace(',', '', $request->instalment_per_month);
                $instalment->instalment_paid = false;
                $instalment->due_date = $next;
                $instalment->instalment_no = $i + 1;
                $instalment->save();
                $temp = $next;
            }
        }

        //************** inventory update  *****************/
        // updating inventory 
        $inventory = Inventory::where('investor_id', '=', $sale->investor_id)->where('item_id', '=', $sale->item_id)->first();
        $inventory->quantity =  $inventory->quantity - 1;
        $inventory->save();

        //**************  creating sale comission  *****************/
        $sale->createSaleComision($sale, $user->id);

        //**************  calculating trade discount  *****************/
        $item_price = $investor->inventories()->where('item_id', '=', $request->item_id)->first()->unit_cost;
        $trade_discount = 0;
        if ($request->sale_type == 1) {
            $trade_discount = $selling_price - $item_price;
        } else {
            $trade_discount = $request->trade_discount;
        }

        //**************  LEADGER *****************/
        if ($request->sale_type == 1) {

            //  leadger entry for debit recievable of inventory
            $sale->createLeadgerEntry(5, $selling_price, $investor->id, $sale->sale_date, $user->id);
            //* leadger entry for credit inventory for actual price of item
            $sale->createLeadgerEntry(3, -$item_price, $investor->id, $sale->sale_date, $user->id);
            //* leadger entry for credit cash of investor bank account for trade profit
            $sale->createLeadgerEntry(4, -$trade_discount, $investor->id, $sale->sale_date, $user->id);

            // calculating profit share of investor and company
            $inv_mark_pft = (str_replace(',', '', $request->total_sum) - str_replace(',', '', $request->selling_price)) * 0.50;

            // leadger entry for investor debit recievable of markup 
            $sale->createLeadgerEntry(5, $inv_mark_pft, $investor->id, $sale->sale_date, $user->id);
            //* leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, -$inv_mark_pft, $investor->id, $sale->sale_date, $user->id);

            // leadger entry for company debit recievable of markup
            $sale->createLeadgerEntry(5, $inv_mark_pft, 1, $sale->sale_date, $user->id);
            // *leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, -$inv_mark_pft, 1, $sale->sale_date, $user->id);
            // leadger entry for company debit cash of trade profit
            $sale->createLeadgerEntry(4, $trade_discount, 1, $sale->sale_date, $user->id);
            //* leadger entry for credit trade discount profit
            $sale->createLeadgerEntry(10, -$trade_discount, 1, $sale->sale_date, $user->id);
        } else {

            //  leadger entry for debit cash/bank of investory
            $sale->createLeadgerEntry($request->acc_type, $item_price, $investor->id, $sale->sale_date, $user->id);
            //* leadger entry for credit inventory for actual price of item
            $sale->createLeadgerEntry(3, -$item_price, $investor->id, $sale->sale_date, $user->id);
            // calculating profit share of investor and company
            $inv_pft = ($selling_price -  $trade_discount - $item_price) * 0.50;

            // leadger entry for investor debit cash/bank for profit money 
            $sale->createLeadgerEntry($request->acc_type, $inv_pft, $investor->id, $sale->sale_date, $user->id);
            //* leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, -$inv_pft, $investor->id, $sale->sale_date, $user->id);
            // leadger entry for company debit recievable of markup
            $sale->createLeadgerEntry($request->acc_type, $inv_pft, 1, $sale->sale_date, $user->id);
            // *leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, -$inv_pft, 1, $sale->sale_date, $user->id);
            // leadger entry for company debit cash of trade profit
            $sale->createLeadgerEntry(1, $trade_discount, 1, $sale->sale_date, $user->id);
            //* leadger entry for credit trade discount profit
            $sale->createLeadgerEntry(10, -$trade_discount, 1, $sale->sale_date, $user->id);
        }

        //************** INVOICE *****************/

        $sale_detail = null;
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'sale' => $sale,
            'sale_detail' => $sale_detail,
            'payment_type' => $payment_type,
            'selling_price' => str_replace(',', '', $request->selling_price),
            'markup' => $request->mark_up,
            'plan' => $request->plan,
            'user_id' => $user->id

        ];
        $pdf = PDF::loadView('sale.sale_invoice_pdf', $data);
        return $pdf->stream('my.pdf', array('Attachment' => 0));
        // return redirect()->route('get-sales', $request->investor_id);
    }





    // function to return sale invoice
    public function postReturn(Request $request)
    {

        $user = Auth::user();
        $cash_back_investor = $request->investor_share + $request->inventory_money;
        $cash_back_company = $request->investor_share;

        $give_to_investor = $request->return_investor;
        $give_to_company = $request->return_alp;
        return view('sale.return_final', compact('cash_back_investor', 'cash_back_company', 'give_to_investor', 'give_to_company'));
        
        echo $request->sale_id . "<br>";
        $sale = Sale::find($request->sale_id);
        // finding the investor to get investor name
        $investor = Investor::find($sale->investor_id);
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
        //  getting investor cash account
        $inv_cash_acc =  $investor->charOfAccounts->where('account_type', 1)->first()->id;
        //  getting company recibable account
        $cmp_rcv_acc =  $cmp->charOfAccounts->where('account_type', 5)->first()->id;
        //  getting company unrealized profit account
        $cmp_un_pft_acc =  $cmp->charOfAccounts->where('account_type', 9)->first()->id;
        // getting company trade discount profit account
        $cmp_td_pft_acc =  $cmp->charOfAccounts->where('account_type', 10)->first()->id;
        if ($sale->status == 2) {
            return "already Returned";
        }

        $instalment = $sale->instalments->first();
        $sale->status = 2;
        echo $instalment->amount;

        $inv_per = $sale->selling_price  / $sale->total;
        $markup_per = 1 - $inv_per;
        // item price recovry
        $ins_mon = $instalment->amount * $inv_per;
        // each investor share in markup profit
        $share = ($instalment->amount - $ins_mon) * 0.50;

        // inventroy
        $inventory = Inventory::where('investor_id', '=', $sale->investor_id)->where('item_id', '=', $sale->item_id)->first();
        $inventory->quantity =  $inventory->quantity + 1;
        $inventory->save();

        $item_price = $investor->inventories()->where('item_id', '=', $sale->item_id)->first()->unit_cost;
        $trade_discount = $sale->selling_price - $item_price;

        // leadger entry for debit inventory.
        $sale->leadgerEntries()->create([
            'account_id' =>  $inv_acc_id,
            'value' =>  $item_price,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);
        // leadger entry for debit cash of investor
        $sale->leadgerEntries()->create([
            'account_id' =>  4,
            'value' =>  $trade_discount,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);


        //*  leadger entry for credit recievable of inventory.
        $sale->leadgerEntries()->create([
            'account_id' =>  $inv_rcv_acc,
            'value' => -$sale->selling_price,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);

        // calculating profit share of investor and company
        $inv_mark_pft = ($sale->total - $sale->selling_price) * 0.50;
        $cmp_mark_pft =  $inv_mark_pft;

        echo "inv_mark : " . $inv_mark_pft . '<br>';

        //* leadger entry for investor credit recievable of markup. 
        $sale->leadgerEntries()->create([
            'account_id' =>  $inv_rcv_acc,
            'value' => -$inv_mark_pft,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);
        // leadger entry for debit markup profit.
        $sale->leadgerEntries()->create([
            'account_id' =>  $inv_un_pft_acc,
            'value' => $inv_mark_pft,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);

        //* leadger entry for company credit recievable of markup.
        $sale->leadgerEntries()->create([
            'account_id' =>  $cmp_rcv_acc,
            'value' => -$inv_mark_pft,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);
        // leadger entry for debit markup profit.
        $sale->leadgerEntries()->create([
            'account_id' =>  $cmp_un_pft_acc,
            'value' => $inv_mark_pft,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);



        //* leadger entry for company credit cash of trade profit.
        $sale->leadgerEntries()->create([
            'account_id' => 4,
            'value' => -$trade_discount,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);

        // leadger entry for debit trade discount profit.
        $sale->leadgerEntries()->create([
            'account_id' => $cmp_td_pft_acc,
            'value' => $trade_discount,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);

        // //* credit cash of investor for inventory recovery
        // $instalment->leadgerEntries()->create([
        //     'account_id' =>  $inv_cash_acc,
        //     'value' => -$ins_mon,
        //     'investor_id' => $investor->id,
        //     'date' => $sale->sale_date
        // ]);
        // //  debit recievable of inventory recovery
        // $instalment->leadgerEntries()->create([
        //     'account_id' =>  $inv_rcv_acc,
        //     'value' => $ins_mon,
        //     'investor_id' => $investor->id,
        //     'date' => $sale->sale_date
        // ]);
        //**** adjusting the recived and paid back to customer */

        $sale->leadgerEntries()->create([
            'account_id' => $cmp_cash_acc,
            'value' => -$trade_discount,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
            // inventory_money
        ]);

        // leadger entry for debit trade discount profit.
        $sale->leadgerEntries()->create([
            'account_id' => $cmp_td_pft_acc,
            'value' => $trade_discount,
            'investor_id' => $investor->id,
            'date' => $sale->sale_date,
            'user_id' => $user->id
        ]);

        $sale->save();
    }



    public function saleClose()
    {   
      

        $user = Auth::user();
        $mytime = Carbon::today();

        $sales = Sale::where('sale_date', $mytime)->where('user_id', $user->id);

        $transactions = GLeadger::select('transaction_type','transaction_id','date','account_id', DB::raw('sum(value) as value'))->where('user_id', $user->id)->where('value','!=',0)->where('date', $mytime)->whereHas('account', function ($query) {
            $query->where(function ($query2) {
                $query2->where('account_type', 1)->orWhere('account_type', 4);
            });
        })->groupBy('transaction_type')->groupBy('transaction_id')->groupBy('date')->groupBy('account_id')->groupBy('user_id')->get();
       
        $cash_sum = GLeadger::where('user_id', $user->id)->where('date', $mytime)->whereHas('account', function ($query) {
            $query->where('account_type', 1);
        })->sum('value');

        $bank_sum = GLeadger::where('user_id', $user->id)->where('date', $mytime)->whereHas('account', function ($query) {
            $query->where('account_type', 4);
        })->sum('value');

        $cash_sum_all = GLeadger::whereHas('account', function ($query) {
            $query->where('account_type', 1);
        })->sum('value');

        $bank_sum_all = GLeadger::whereHas('account', function ($query) {
            $query->where('account_type', 4);
        })->sum('value');

        $transactions->sum('value');
        // return $transactions;
        return view('sale.sale_close_user', compact('user', 'transactions', 'bank_sum', 'cash_sum', 'cash_sum_all', 'bank_sum_all'));
    }

    public function saleClose2()
    {

        $user = Auth::user();
        $mytime = Carbon::today();

        $sales = Sale::where('sale_date', $mytime)->where('user_id', $user->id);

        $transactions = GLeadger::where('user_id', $user->id)->where('date', $mytime)->whereHas('account', function ($query) {
            $query->where(function ($query2) {
                $query2->where('account_type', 1)->orWhere('account_type', 4);
            });
        })->get();

        $cash_sum = GLeadger::where('user_id', $user->id)->where('date', $mytime)->whereHas('account', function ($query) {
            $query->where('account_type', 1);
        })->sum('value');

        $bank_sum = GLeadger::where('user_id', $user->id)->where('date', $mytime)->whereHas('account', function ($query) {
            $query->where('account_type', 4);
        })->sum('value');

        $cash_sum_all = GLeadger::whereHas('account', function ($query) {
            $query->where('account_type', 1);
        })->sum('value');

        $bank_sum_all = GLeadger::whereHas('account', function ($query) {
            $query->where('account_type', 4);
        })->sum('value');

        $transactions->sum('value');
        // return $transactions;
        return view('sale.sale_close_user2', compact('user', 'transactions', 'bank_sum', 'cash_sum', 'cash_sum_all', 'bank_sum_all'));
    }


    public function testPdf()
    {
        //  printing invoices
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
        return view('sale.sale_show', compact('sale'));
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
        $investor = Investor::find($id);
        $sales = $investor->sales;
        return view('sale.sale-list', compact('sales', 'investor'));
    }


    public function showInstalments(Request $request)
    {
        // dd($request->all());
        if (isset($request->id)) {

            $sale = Sale::find($request->id);
            $instalments = $sale->instalments;
            if (isset($request->user_exception)) {
                // dd("hererserer");

                $user_exception = $request->user_exception;
                return view('sale.sale-instalments', compact('sale', 'instalments', 'user_exception'));
            } else {

                return view('sale.sale-instalments', compact('sale', 'instalments'));
            }
        }

        return view('sale.sale-instalments');
    }

    public function  getInvoices(Request $request)
    {

        $sales = Sale::where('invoice_no', 'like', '%' . $request->key . '%')->get();
        return $sales;
    }

    public function getSaleNo(Request $request)
    {

        $sale = Sale::where('invoice_no', 'like',  "%" . $request->key)->with('item')->with('marketingOfficer')->with('recoveryOfficer')->with('customer')->with('investor')->with('instalments')->get();
        return $sale;
    }



    public function saleReturn(Request $request)
    {

        return view('sale.sale_ret_temp');
    }


    // function to spof get requests of post request
    public function redirectPost()
    {
    }


    public function saleReturns(Request $request)
    {
        $type = 2;
        $investors = Investor::all();
        $suppliers = Supplier::all();
        // dd($request->id);
        if (isset($request->id)) {

            $sale = Sale::find($request->id);
            $inv_per = $sale->selling_price  / $sale->total;
            $markup_per = 1 - $inv_per;
            // item price recovry 
            $total_amount_paid = $sale->instalments->sum('amount_paid');
            // dd($total_amount_paid);
            $inventory_money = $total_amount_paid * $inv_per;
            // each investor share in markup profit
            $share = ($total_amount_paid - $inventory_money) * 0.50;

            return view('sale.sale', compact('investors', 'suppliers', 'type', 'sale', 'total_amount_paid', 'inventory_money', 'share'));
        }

        // for purchase return

        return view('sale.sale', compact('investors', 'suppliers', 'type'));
    }

    public function searchSales(Request $request)
    {


        return view('sale.search_sale');
    }

    public function searchSalesPost(Request $request)
    {
        // dd($request->all());
        $sales = Sale::SearchSale($request->from_date, $request->to_date, $request->customer_name, $request->customer_id, $request->invoice_no)->paginate(10);
        $sales->appends([
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'customer_name' => $request->customer_name,
            'customer_id' => $request->customer_id,
            'invoice_no' => $request->invoice_no
        ]);
        // dd($sales);
        return view('sale.search_sale', compact('sales'));
    }
}

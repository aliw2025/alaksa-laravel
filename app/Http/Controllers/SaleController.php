<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
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
use App\Models\TransactionStatus;
use Illuminate\Http\Request;
use Session;

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

        $investors = Investor::all();
        $suppliers = Supplier::all();
        $bank_acc = ChartOfAccount::where('account_type', 4)->get();
        $type = 1;
        return view('sale.sale', compact('investors', 'suppliers', 'type', 'bank_acc'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'customer_id' => 'required',
                'item_id' => 'required',
                'selling_price' => 'required',
                'plan' => 'required',
                'markup' => 'required'

            ]
        );
        // dd($request->all());
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
        $sale->invoice_no = $investor->prefix . '23' . $num;
        $sale->customer_id = $request->customer_id;
        $sale->item_id = $request->item_id;
        $sale->store_id = 1;
        $sale->mar_of_id = $request->mar_of_id;
        $sale->rec_of_id = $request->rec_of_id;
        $sale->inq_of_id = $request->inq_of_id;
        $sale->investor_id = $request->investor_id;
        $sale->status = 1;
        $sale->seriel_no =  $request->seriel_no;


        $sale->user_id = $user->id;
        // creaating a selling price var
        $selling_price = str_replace(',', '', $request->selling_price);
        $sale->selling_price =  $selling_price;
        $sale->payment_type = $request->sale_type;
        // if sale is of type cash 
        if ($request->sale_type == 2) {
            $payment_type = "Cash";
            $sale->total =  $selling_price;
        } else {
            $payment_type = "Instalments";
            $sale->total = str_replace(',', '', $request->total_sum);
            $sale->downpayment = str_replace(',', '', $request->down_payment);
            $sale->plan = $request->plan;
            $sale->markup = $request->markup;
        }
        $sale->sale_date = $request->sale_date;
        $sale->save();
        $type = 1;
        $investors = Investor::all();
        // $suppliers = Supplier::all();
        $bank_acc = ChartOfAccount::where('account_type', 4)->get();
        return view('sale.sale', compact('sale', 'type', 'bank_acc', 'investors'))->with('message', 'Record saved');

        // return redirect()->route('sale.edit', $sale->id,$message);
        // return redirect()->route('get-sales', $request->investor_id);
    }


    public function postSale(Request $request)
    {

        $sale = Sale::find($request->sale_id);
        if ($sale->status == 3) {
            return "sale already posted";
        }
        $sale->status = 3;
        $down_payment = false;
        $investor = Investor::find($request->investor_id);
        $user = Auth::user();
        if ($request->input('down_payment_paid') != NULL) {
            $down_payment = true;
        }
        $selling_price = floatval(str_replace(',', '', $request->selling_price));
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


            $alp_share = 0.5;
            $inv_share = 1 - $alp_share;



            //**************  creating inventory and markup share  *****************/
            $inv_per = floatval($selling_price) / $sale->total;
            // item price recovery
            $ins_mon = str_replace(',', '', $request->down_payment) * $inv_per;
            // each investor share in markup profit
            $share1 = (str_replace(',', '', $request->down_payment) - $ins_mon) * $inv_share;
            $share2 = (str_replace(',', '', $request->down_payment) - $ins_mon) * $alp_share;

            if ($down_payment) {
                $payment = new InstalmentPayment();
                $payment->instalment_id = $instalment->id;
                $payment->amount =   $ins_mon;
                $payment->payment_date = $request->sale_date;
                $payment->save();

                // debit cash of investor for inventory recovery
                $payment->createLeadgerEntry($request->acc_type, $ins_mon + $share1, $investor->id, $sale->sale_date, $user->id);
                //*  credit recievable of inventory recovery
                // debit company cash of markup
                $payment->createLeadgerEntry($request->acc_type, $share2, 1, $sale->sale_date, $user->id);
                //*  credit company  recievable of markup
                $payment->createLeadgerEntry(5, -$share2, 1, $sale->sale_date, $user->id);
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
        //** new **/
        $p_discount = $investor->inventories()->where('item_id', '=', $request->item_id)->first()->trade_discount;

        $trade_discount = 0;
        if ($request->sale_type == 1) {
            // trade discount is now provit over cost
            $trade_discount = $selling_price - $item_price;
            if ($trade_discount < 0) {
                // now to be adjusted in leadger
                $loss = $item_price - $selling_price;
            }
        } else {
            $trade_discount = $request->trade_discount;
        }
        $sale->trade_discount = $trade_discount;
        //**************  LEADGER *****************/
        if ($request->sale_type == 1) {
            $alp_share = 0.5;
            $inv_share = 1 - $alp_share;
            // calculating profit share of investor and company
            $inv_mark_pft1 = (str_replace(',', '', $request->total_sum) - str_replace(',', '', $request->selling_price)) * $inv_share;
            $inv_mark_pft2 = (str_replace(',', '', $request->total_sum) - str_replace(',', '', $request->selling_price)) * $alp_share;

            //  leadger entry for debit recievable of inventory
            $sale->createLeadgerEntry(5, $selling_price + $inv_mark_pft1, $investor->id, $sale->sale_date, $user->id);
            //* leadger entry for credit inventory for actual price of item
            $sale->createLeadgerEntry(3, -$item_price, $investor->id, $sale->sale_date, $user->id);
            //* leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, -$inv_mark_pft1, $investor->id, $sale->sale_date, $user->id);
            //*** change this entry too ****/
            if ($trade_discount > 0) {
                if ($investor->id == 1) {
                    // ad trade profit  
                    $sale->createLeadgerEntry(10, -$trade_discount, $investor->id, $sale->sale_date, $user->id);
                } else {
                    //ad payable
                    $sale->createLeadgerEntry(7, -$trade_discount, $investor->id, $sale->sale_date, $user->id);
                }
            } else {
                // temp expense account for loss
                $sale->createLeadgerEntry(8, $loss, $investor->id, $sale->sale_date, $user->id);
            }

            // leadger entry for company debit recievable of markup
            $sale->createLeadgerEntry(5, $inv_mark_pft2, 1, $sale->sale_date, $user->id);
            //*leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, -$inv_mark_pft2, 1, $sale->sale_date, $user->id);
        } else {

            //  leadger entry for debit cash/bank of investory
            $sale->createLeadgerEntry($request->acc_type, $item_price, $investor->id, $sale->sale_date, $user->id);
            //* leadger entry for credit inventory for actual price of item
            $sale->createLeadgerEntry(3, -$item_price, $investor->id, $sale->sale_date, $user->id);
            // calculating profit share of investor and company

            $inv_pft1 = ($selling_price -   $item_price) * $inv_share;
            $inv_pft2 = ($selling_price -   $item_price) * $alp_share;

            // leadger entry for investor debit cash/bank for profit money 
            $sale->createLeadgerEntry($request->acc_type, $inv_pft1, $investor->id, $sale->sale_date, $user->id);
            //* leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, -$inv_pft1, $investor->id, $sale->sale_date, $user->id);
            // leadger entry for company debit  of 
            $sale->createLeadgerEntry($request->acc_type, $inv_pft2, 1, $sale->sale_date, $user->id);
            // *leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, -$inv_pft2, 1, $sale->sale_date, $user->id);
            // leadger entry for company debit cash of trade profit
            $sale->createLeadgerEntry($request->acc_type, $trade_discount, 1, $sale->sale_date, $user->id);
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
            'payment_type' => $sale->pay_type_name->name,
            'selling_price' => str_replace(',', '', $request->selling_price),
            'markup' => $request->mark_up,
            'plan' => $request->plan,
            'user_id' => $user->id

        ];
        $sale->save();
        $pdf = PDF::loadView('sale.sale_invoice_pdf', $data);
        return $pdf->stream('my.pdf', array('Attachment' => 0));
    }


    // unpost sale
    public function unpostSale(Request $request)
    {
    }

    public function saleReturnAdjustment(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $sale = Sale::find($request->sale_id);

        //**************  calculating trade discount  *****************/
        $trade_discount = $sale->trade_discount;
        $cash_back_investor = $request->investor_share + $request->inventory_money;
        $cash_back_company = $request->investor_share;
        $give_to_investor = $request->return_investor;
        $give_to_company = $request->return_alp;
        $bank_acc = ChartOfAccount::where('account_type', 4)->get();
        return view('sale.return_final', compact('cash_back_investor', 'cash_back_company', 'give_to_investor', 'give_to_company', 'bank_acc', 'sale'));
    }

    public function postReturnAdjustmentSimple(Request $request)
    {

        $mytime = date('Y-m-d'); // 

        // dd($request->all());
        $sale = Sale::find($request->sale_id);
        $sale->status = 4;
        $down_payment = false;
        $investor = Investor::find($sale->investor_id);
        $user = Auth::user();
        $selling_price = str_replace(',', '', $sale->selling_price);
        // dd($investor->inventories()->where('item_id', '=', $request->item_id)->first());
        $item_price = $investor->inventories()->where('item_id', '=', $sale->item_id)->first()->unit_cost;
        //************** inventory update  *****************/
        // updating inventory 
        $inventory = Inventory::where('investor_id', '=', $sale->investor_id)->where('item_id', '=', $sale->item_id)->first();
        $inventory->quantity =  $inventory->quantity + 1;
        $inventory->save();
        //**************  calculating trade discount  *****************/
        $trade_discount = $sale->trade_discount;


        //**************  LEADGER *****************/
        if ($sale->payment_type == 1) {
            //  leadger entry for debit recievable of inventory
            $sale->createLeadgerEntry(5, -$selling_price, $investor->id, $mytime, $user->id);
            //* leadger entry for credit inventory for actual price of item
            $sale->createLeadgerEntry(3, $item_price, $investor->id, $mytime, $user->id);
            //* leadger entry for credit cash of investor bank account for trade profit ??
            // $sale->createLeadgerEntry(4, $trade_discount, $investor->id, $mytime, $user->id);
            // calculating profit share of investor and company
            $inv_mark_pft = ($sale->total_sum - $sale->selling_price) * 0.50;
            // leadger entry for investor debit recievable of markup 
            $sale->createLeadgerEntry(5, -$inv_mark_pft, $investor->id, $mytime, $user->id);
            //* leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, $inv_mark_pft, $investor->id, $mytime, $user->id);
            // leadger entry for company debit recievable of markup
            $sale->createLeadgerEntry(5, -$inv_mark_pft, 1, $mytime, $user->id);
            // *leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, $inv_mark_pft, 1, $mytime, $user->id);
            // leadger entry for company debit cash of trade profit ??
            // $sale->createLeadgerEntry(4, -$trade_discount, 1, $mytime, $user->id);
            //* leadger entry for credit trade discount profit
            // $sale->createLeadgerEntry(10, $trade_discount, 1, $mytime, $user->id);

            //*** Adjustments****/ 
            // 1 - debit reciveable investor
            $sale->createLeadgerEntry(5, str_replace(',', '', $request->take_back_inv), $sale->investor_id, $mytime, $user->id);
            //* credit selected_acc
            $sale->createLeadgerEntry($request->take_back_inv_acc, -str_replace(',', '', $request->take_back_inv), $sale->investor_id, $mytime, $user->id);
            // 2- debit recv alp
            $sale->createLeadgerEntry(5, str_replace(',', '', $request->take_back_alp), 1, $mytime, $user->id);
            //* credit selected_acc alp
            $sale->createLeadgerEntry($request->take_back_alp_acc, -str_replace(',', '', $request->take_back_inv), 1, $mytime, $user->id);

            // 3 - debit investor selected_acc
            $sale->createLeadgerEntry($request->give_back_inv_acc, str_replace(',', '', $request->give_back_inv), $sale->investor_id, $mytime, $user->id);
            //* credit pft
            $sale->createLeadgerEntry(9, -str_replace(',', '', $request->give_back_inv), $sale->investor_id, $mytime, $user->id);
            // 4 - debit investor selected_acc
            $sale->createLeadgerEntry($request->give_back_alp_acc, str_replace(',', '', $request->give_back_alp), 1, $mytime, $user->id);
            //* credit pft
            $sale->createLeadgerEntry(9, -str_replace(',', '', $request->take_back_alp), 1, $mytime, $user->id);
            
            // debit profit if positive profit
            if ($sale->trade_discount > 0) {
                if ($sale->investor_id == 1) {
                    // debit profit
                } else {
                    // debit payable to alp
                }
            } else {
                
                // credit loss expense
            }
            //5 - debit td pft
            // $sale->createLeadgerEntry(10, str_replace(',', '', $request->take_back_td), 1, $mytime, $user->id);
            //* credit alp selected
            // $sale->createLeadgerEntry($request->take_back_td_acc, -str_replace(',', '', $request->take_back_td), 1, $mytime, $user->id);
            //5 - debit td to inv
            //$sale->createLeadgerEntry($request->take_back_td_acc, str_replace(',', '', $request->take_back_td), $sale->investor_id, $mytime, $user->id);
        } else {

            //  leadger entry for debit cash/bank of investory
            $sale->createLeadgerEntry($request->take_back_inv_acc, -$item_price, $investor->id, $mytime, $user->id);
            //* leadger entry for credit inventory for actual price of item
            $sale->createLeadgerEntry(3, $item_price, $investor->id, $mytime, $user->id);
            // calculating profit share of investor and company
            $inv_pft = ($selling_price - $trade_discount - $item_price) * 0.50;
            // leadger entry for investor debit cash/bank for profit money 
            $sale->createLeadgerEntry($request->take_back_inv_acc, -$inv_pft, $investor->id, $mytime, $user->id);
            //* leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, $inv_pft, $investor->id, $mytime, $user->id);
            // leadger entry for company debit  of 
            $sale->createLeadgerEntry($request->take_back_alp_acc, -$inv_pft, 1, $mytime, $user->id);
            // *leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, $inv_pft, 1, $mytime, $user->id);
            // leadger entry for company debit cash of trade profit
            $sale->createLeadgerEntry($request->take_back_td_acc, -$trade_discount, 1, $mytime, $user->id);
            //* leadger entry for credit trade discount profit
            $sale->createLeadgerEntry(10, $trade_discount, 1, $mytime, $user->id);
            // adjustments
            // 3 - debit investor selected_acc
            $sale->createLeadgerEntry($request->give_back_inv_acc, str_replace(',', '', $request->give_back_inv), $sale->investor_id, $mytime, $user->id);
            //* credit pft
            $sale->createLeadgerEntry(9, -str_replace(',', '', $request->give_back_inv), $sale->investor_id, $mytime, $user->id);
            // 4 - debit investor selected_acc
            $sale->createLeadgerEntry($request->give_back_alp_acc, str_replace(',', '', $request->give_back_alp), 1, $mytime, $user->id);
            //* credit pft
            $sale->createLeadgerEntry(9, -str_replace(',', '', $request->take_back_alp), 1, $mytime, $user->id);

            //* credit alp selected
            $sale->createLeadgerEntry($request->take_back_td_acc, -str_replace(',', '', $request->take_back_td), 1, $mytime, $user->id);
            //5 - debit td to inv
            $sale->createLeadgerEntry($request->take_back_td_acc, str_replace(',', '', $request->take_back_td), $sale->investor_id, $mytime, $user->id);
        }

        $sale->save();

        return redirect()->route('sale.show', $sale->id);
    }

    public function postReturnAdjustment(Request $request)
    {
        $mytime = date('Y-m-d'); // 

        // dd($request->all());
        $sale = Sale::find($request->sale_id);
        $sale->status = 4;
        $down_payment = false;
        $investor = Investor::find($sale->investor_id);
        $user = Auth::user();
        $selling_price = str_replace(',', '', $sale->selling_price);
        // dd($investor->inventories()->where('item_id', '=', $request->item_id)->first());
        $item_price = $investor->inventories()->where('item_id', '=', $sale->item_id)->first()->unit_cost;
        //************** inventory update  *****************/
        // updating inventory 
        $inventory = Inventory::where('investor_id', '=', $sale->investor_id)->where('item_id', '=', $sale->item_id)->first();
        $inventory->quantity =  $inventory->quantity + 1;
        $inventory->save();
        //**************  calculating trade discount  *****************/
        $trade_discount = $sale->trade_discount;

        //**************  LEADGER *****************/
        if ($sale->payment_type == 1) {
            //  leadger entry for debit recievable of inventory
            $sale->createLeadgerEntry(5, -$selling_price, $investor->id, $mytime, $user->id);
            //* leadger entry for credit inventory for actual price of item
            $sale->createLeadgerEntry(3, $item_price, $investor->id, $mytime, $user->id);
            //* leadger entry for credit cash of investor bank account for trade profit ??
            // $sale->createLeadgerEntry(4, $trade_discount, $investor->id, $mytime, $user->id);
            // calculating profit share of investor and company
            $inv_mark_pft = ($sale->total_sum - $sale->selling_price) * 0.50;
            // leadger entry for investor debit recievable of markup 
            $sale->createLeadgerEntry(5, -$inv_mark_pft, $investor->id, $mytime, $user->id);
            //* leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, $inv_mark_pft, $investor->id, $mytime, $user->id);
            // leadger entry for company debit recievable of markup
            $sale->createLeadgerEntry(5, -$inv_mark_pft, 1, $mytime, $user->id);
            // *leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, $inv_mark_pft, 1, $mytime, $user->id);
            // leadger entry for company debit cash of trade profit ??
            // $sale->createLeadgerEntry(4, -$trade_discount, 1, $mytime, $user->id);
            //* leadger entry for credit trade discount profit
            // $sale->createLeadgerEntry(10, $trade_discount, 1, $mytime, $user->id);

            //*** Adjustments****/ 
            // 1 - debit reciveable investor
            $sale->createLeadgerEntry(5, str_replace(',', '', $request->take_back_inv), $sale->investor_id, $mytime, $user->id);
            //* credit selected_acc
            $sale->createLeadgerEntry($request->take_back_inv_acc, -str_replace(',', '', $request->take_back_inv), $sale->investor_id, $mytime, $user->id);
            // 2- debit recv alp
            $sale->createLeadgerEntry(5, str_replace(',', '', $request->take_back_alp), 1, $mytime, $user->id);
            //* credit selected_acc alp
            $sale->createLeadgerEntry($request->take_back_alp_acc, -str_replace(',', '', $request->take_back_inv), 1, $mytime, $user->id);

            // 3 - debit investor selected_acc
            $sale->createLeadgerEntry($request->give_back_inv_acc, str_replace(',', '', $request->give_back_inv), $sale->investor_id, $mytime, $user->id);
            //* credit pft
            $sale->createLeadgerEntry(9, -str_replace(',', '', $request->give_back_inv), $sale->investor_id, $mytime, $user->id);
            // 4 - debit investor selected_acc
            $sale->createLeadgerEntry($request->give_back_alp_acc, str_replace(',', '', $request->give_back_alp), 1, $mytime, $user->id);
            //* credit pft
            $sale->createLeadgerEntry(9, -str_replace(',', '', $request->take_back_alp), 1, $mytime, $user->id);
            //5 - debit td pft
            $sale->createLeadgerEntry(10, str_replace(',', '', $request->take_back_td), 1, $mytime, $user->id);
            //* credit alp selected
            $sale->createLeadgerEntry($request->take_back_td_acc, -str_replace(',', '', $request->take_back_td), 1, $mytime, $user->id);
            //5 - debit td to inv
            $sale->createLeadgerEntry($request->take_back_td_acc, str_replace(',', '', $request->take_back_td), $sale->investor_id, $mytime, $user->id);
        } else {

            //  leadger entry for debit cash/bank of investory
            $sale->createLeadgerEntry($request->take_back_inv_acc, -$item_price, $investor->id, $mytime, $user->id);
            //* leadger entry for credit inventory for actual price of item
            $sale->createLeadgerEntry(3, $item_price, $investor->id, $mytime, $user->id);
            // calculating profit share of investor and company
            $inv_pft = ($selling_price - $trade_discount - $item_price) * 0.50;
            // leadger entry for investor debit cash/bank for profit money 
            $sale->createLeadgerEntry($request->take_back_inv_acc, -$inv_pft, $investor->id, $mytime, $user->id);
            //* leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, $inv_pft, $investor->id, $mytime, $user->id);
            // leadger entry for company debit  of 
            $sale->createLeadgerEntry($request->take_back_alp_acc, -$inv_pft, 1, $mytime, $user->id);
            // *leadger entry for credit markup profit
            $sale->createLeadgerEntry(9, $inv_pft, 1, $mytime, $user->id);
            // leadger entry for company debit cash of trade profit
            $sale->createLeadgerEntry($request->take_back_td_acc, -$trade_discount, 1, $mytime, $user->id);
            //* leadger entry for credit trade discount profit
            $sale->createLeadgerEntry(10, $trade_discount, 1, $mytime, $user->id);
            // adjustments
            // 3 - debit investor selected_acc
            $sale->createLeadgerEntry($request->give_back_inv_acc, str_replace(',', '', $request->give_back_inv), $sale->investor_id, $mytime, $user->id);
            //* credit pft
            $sale->createLeadgerEntry(9, -str_replace(',', '', $request->give_back_inv), $sale->investor_id, $mytime, $user->id);
            // 4 - debit investor selected_acc
            $sale->createLeadgerEntry($request->give_back_alp_acc, str_replace(',', '', $request->give_back_alp), 1, $mytime, $user->id);
            //* credit pft
            $sale->createLeadgerEntry(9, -str_replace(',', '', $request->take_back_alp), 1, $mytime, $user->id);

            //* credit alp selected
            $sale->createLeadgerEntry($request->take_back_td_acc, -str_replace(',', '', $request->take_back_td), 1, $mytime, $user->id);
            //5 - debit td to inv
            $sale->createLeadgerEntry($request->take_back_td_acc, str_replace(',', '', $request->take_back_td), $sale->investor_id, $mytime, $user->id);
        }

        $sale->save();

        return redirect()->route('sale.show', $sale->id);
    }


    public function saleReturn(Request $request)
    {
        $type = 2;
        // return "to be implemented";
        $investors = Investor::all();
        $suppliers = Supplier::all();
        $bank_acc = ChartOfAccount::where('account_type', 4)->get();

        $sale = Sale::find($request->sale_id);
        $investor = Investor::find($sale->investor_id);
        $item_price = $investor->inventories()->where('item_id', '=', $sale->item_id)->first()->unit_cost;
        $loss_profit = $sale->trade_discount;
        $inv_per = $sale->selling_price  / $sale->total;
        $markup_per = 1 - $inv_per;
        // dd('dfdfdf');
        if ($sale->payment_type == 1) {
            $total_amount_paid = $sale->instalments->sum('amount_paid');
            // dd($total_amount_paid);
            $inventory_money = $total_amount_paid * $inv_per;
            // each investor share in markup profit
            $alp_share = 0.5;
            $inv_share = 1 - $alp_share;

            $share_alp = ($total_amount_paid - $inventory_money) * $alp_share;
            $share_inv = ($total_amount_paid - $inventory_money) * $inv_share;
        } else {

            $total_amount_paid = $sale->total;
            $inventory_money = $item_price;
            $alp_share = 0.5;
            $inv_share = 1 - $alp_share;
            // dd(   $inventory_money );
            // each investor share in markup profit
            $share_alp = ($sale->total - $inventory_money - $sale->trade_discount) * $alp_share;
            $share_inv =  ($sale->total - $inventory_money - $sale->trade_discount) * $inv_share;
        }

        return view('sale.sale_temp', compact('investors', 'suppliers', 'type', 'sale', 'total_amount_paid', 'inventory_money', 'share_alp', 'share_inv', 'loss_profit'));
    }


    // function to return sale invoice
    public function saleClose()
    {

        $user = Auth::user();
        $mytime = Carbon::today();
        $sales = Sale::where('sale_date', $mytime)->where('user_id', $user->id);
        $transactions = GLeadger::select('transaction_type', 'transaction_id', 'date', 'account_id', DB::raw('sum(value) as value'))->where('user_id', $user->id)->where('value', '!=', 0)->where('date', $mytime)->whereHas('account', function ($query) {
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
        $sale->id = 1;
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
        $investors = Investor::all();
        $suppliers = Supplier::all();
        $bank_acc = ChartOfAccount::where('account_type', 4)->get();

        return view('sale.sale', compact('sale', 'investors', 'suppliers', 'bank_acc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {

        $investors = Investor::all();
        $suppliers = Supplier::all();
        $bank_acc = ChartOfAccount::where('account_type', 4)->get();
        $type = 1;
        if ($sale->status != 1) {

            return "sale status other than entry  cannot be edited";
        }
        return view('sale.sale', compact('sale', 'investors', 'suppliers', 'type', 'bank_acc'));
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
        if ($request->input('action') == "post") {
            return redirect()->route('post-sale', $request->all());
        } else if ($request->input('action') == "cancel") {
            return redirect()->route('cancel-sale', $request->all());
        } else if ($request->input('action') == "reprint") {
            return redirect()->route('reprint-invoice', $request->all());
        } else if ($request->input('action') == "return") {
            return redirect()->route('sale-return', $request->all());
        }



        if ($sale->status != 1) {

            return "sale status other than entry  cannot be edited";
        }
        $user = Auth::user();

        $sale->customer_id = $request->customer_id;
        $sale->item_id = $request->item_id;
        $sale->store_id = 1;
        $sale->mar_of_id = $request->mar_of_id;
        $sale->rec_of_id = $request->rec_of_id;
        $sale->inq_of_id = $request->inq_of_id;
        $sale->downpayment = str_replace(',', '', $request->down_payment);
        $sale->seriel_no =  $request->seriel_no;

        $sale->investor_id = $request->investor_id;
        $sale->status = 1;
        $sale->plan = $request->plan;
        $sale->markup = $request->markup;
        $sale->user_id = $user->id;
        // creaating a selling price var
        $selling_price = str_replace(',', '', $request->selling_price);
        $sale->selling_price =  $selling_price;
        // $sale->sale_type = $request->sale_type;
        $sale->payment_type = $request->sale_type;

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
        $type = 1;
        return redirect()->back()->with('message', 'Record Saved');
    }

    public function cancelSale(Request $request)
    {


        $sale = Sale::find($request->sale_id);
        if ($sale->status != 1) {
            return "transaction with entry status can be cancelled only";
        }
        $sale->status = 2;
        $sale->save();

        return redirect()->back()->with('message', 'Record Cancelled');;
    }

    // function to reprint invoice
    public function reprintInvoice(Request $request)
    {

        $sale = Sale::find($request->sale_id);
        if ($sale->status != 3) {
            return "only posted invoices can be printed";
        }
        $sale_detail = null;
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'sale' => $sale,
            'sale_detail' => $sale_detail,
            'payment_type' => $sale->pay_type_name->name,
            'selling_price' => 12000,
            'markup' => 20,
            'plan' => 6

        ];
        $pdf = PDF::loadView('sale.sale_invoice_pdf', $data);
        return $pdf->stream('my.pdf', array('Attachment' => 0));
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

        //    dd($request->all());
        if (isset($request->id)) {
            // dd($request->id);
            $sale = Sale::find($request->id);
            // dd($sale);
            if (isset($request->ins_id)) {
                $instalments = $sale->instalments->where('id', $request->ins_id);
            } else {
                $instalments = $sale->instalments;
            }
            $user = Auth::user();

            $bank_acc = $user->charOfAccounts;
            // dd( $bank_acc);
            if (isset($request->user_exception)) {

                $user_exception = $request->user_exception;
                return view('sale.sale-instalments', compact('sale', 'instalments', 'user_exception', 'bank_acc'));
            } else {

                return view('sale.sale-instalments', compact('sale', 'instalments', 'bank_acc'));
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






    // function to spof get requests of post request
    public function redirectPost()
    {
    }




    public function searchSales(Request $request)
    {

        $statuses = TransactionStatus::all();


        return view('sale.search_sale', compact('statuses'));
    }

    public function searchSalesPost(Request $request)
    {
        // $request->validate([
        //     'from_date' => 'required',
        //     'to_date' => 'required'c
        // ]);


        $sales = Sale::SearchSale($request->from_date, $request->to_date, $request->customer_name, $request->customer_id, $request->invoice_no, $request->status_id);
        $statuses = TransactionStatus::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $customer_name = $request->customer_name;
        $customer_id = $request->customer_id;
        $invoice_no = $request->invoice_no;



        $sum = Sale::whereBetween('sale_date', [$from_date, $to_date]);

        $sum = $sales->sum('total');
        if ($request->input('action') == "pdf") {

            $sales = $sales->get();
            return view('sale.sale_report', compact('sales', 'from_date', 'to_date', 'statuses', 'sum'));
        }

        $sales = $sales->paginate(20);
        $sales->appends([
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'customer_name' => $request->customer_name,
            'customer_id' => $request->customer_id,
            'invoice_no' => $request->invoice_no,
            'status_id' => $request->status_id

        ]);

        return view('sale.search_sale', compact('sales', 'statuses', 'from_date', 'to_date', 'statuses', 'sum', 'customer_name', 'customer_id', 'invoice_no'));
    }
}

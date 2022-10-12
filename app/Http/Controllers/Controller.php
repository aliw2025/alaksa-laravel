<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\InvestorLeadger;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Carbon\Cli\Invoker;
use finfo;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setup()
    {

        // company investor has always type 1
        $investor = Investor::where('investor_type', '=', 1)->first();
        if ($investor === null) {
            $investor = new Investor();
            $investor->investor_name = "Alpha digital";
            $investor->email = "support@alphaDigital.com";
            $investor->phone = "00000000";
            $investor->prefix = "AD";
            $investor->investor_type = 1;
            $investor->save();
            // cash account
            
            $account_cash = new Account();
            $account_cash->account_name=$investor->prefix.'_cash';
            $account_cash->account_type =1;
            $account_cash->opening_balance=10000000;
            $account_cash->owner = $investor->id;
            $account_cash->save();

            $account_pay = new Account();
            $account_pay->account_name = $investor->prefix.'_payables';
            $account_pay->owner= $investor->id;
            $account_pay->account_type = 2;
            $account_pay->opening_balance = 0;
            $account_pay->save();

            $account_rcv = new Account();
            $account_rcv->account_name = $investor->prefix.'_recievables';
            $account_rcv->owner= $investor->id;
            $account_rcv->account_type = 3;
            $account_rcv->opening_balance = 0;
            $account_rcv->save();

            $ledgerEntry = new InvestorLeadger();
            $ledgerEntry->account_id = $account_cash->id;
            $ledgerEntry->transaction_type = "opening";
            $ledgerEntry->transaction_id = $investor->id;
            $ledgerEntry->value = $account_cash->opening_balance;
            $ledgerEntry->date = $investor->created_at;
            $ledgerEntry->save();
            //supplies account
            // $account = new Account();
            // $account->account_name($investor->prefix.'supplies');
            // $account->owner = $investor->id;
            // $account->save();

             //account
            //  $account = new Account();
            //  $account->account_name($investor->prefix.'payable_account');
            //  $account->owner = $investor->id;
            //  $account->save();



        } else {

           
        }
        return redirect()->route('index');
    }

    public function createAccountTypes(){


        $type = new AccountType();
        $type->name="cash";
        $type->catgory="Assets";
        
        $type = new AccountType();
        $type->name="Equipment";
        $type->catgory="Assets";

        $type = new AccountType();
        $type->name="inventory";
        $type->catgory="Assets";

        $type = new AccountType();
        $type->name="Account Receivable";
        $type->catgory="Assets";

        $type = new AccountType();
        $type->name="equity";
        $type->catgory="equity";

        $type = new AccountType();
        $type->name="Account Payable";
        $type->catgory="Liabilty";

        $type = new AccountType();
        $type->name="Expenses";
        $type->catgory="Salary Expenses";




    }

    public function index()
    {
        $investors = Investor::all();
        return view("template.dashboard-content", compact('investors'));
    }

    public function home($id)
    {
        $investor = Investor::find($id);
        return view("template.dashboard-content", compact('investor'));
    }
    public function showInvestments()
    {

        return view("capital-investments.capital-investment");
    }
  
    public function showPurchase(){
        return view('purchase.purchase');
    }


    // unused routes
    public function testSql($id)
    {    
        // $num = sprintf('%10d', $id+1);
        return str_pad(22, 10, '0', STR_PAD_LEFT);
        // $purchase->purchase_no = $investor->prefix.'22'.$num;

        $investor = Investor::find($id);
        // return $investor->accounts->where('account_type',1)->first();
        return $investor->accounts->where('account_type',1)->first()->investor;
        
        

        // return \Illuminate\Support\Facades\DB::table('users')->get();
    }

    public function testOracle()
    {
        $endpoint = env('ORACLE_DB_BRIDGE');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://10.10.10.222/skm-bridge/index.php");
        // curl_setopt($curl, CURLOPT_URL, "http://localhost/skm-bridge.php");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        print_r($data);
    }
}

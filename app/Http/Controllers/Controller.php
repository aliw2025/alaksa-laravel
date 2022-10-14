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

            
            //  creating the chart of accounts
            $investor_cash = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_cash',
                'account_type' => 1,
                'opening_balance' => 0
            ]);

            $investor_eq = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_equipment',
                'account_type' => 2,
                'opening_balance' => 0
            ]);

            $investor_inv = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_inventory',
                'account_type' => 3,
                'opening_balance' => 0
            ]);

            $investor_eq = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_equity',
                'account_type' => 5,
                'opening_balance' => 0
            ]);

            $investor->leadgerEntries()->create([
                'account_id' => $investor_cash->id,
                'value' => 0,
                'date' => $investor->created_at

            ]);

            $investor->leadgerEntries()->create([
                'account_id' => $investor_eq->id,
                'value' => 0,
                'date' => $investor->created_at

            ]);
        } else {
        }
        return redirect()->route('index');
    }

    public function createAccountTypes()
    {


        $type = new AccountType();
        $type->name = "cash";
        $type->category = "Assets";
        $type->save();

        $type = new AccountType();
        $type->name = "Equipment";
        $type->category = "Assets";
        $type->save();

        $type = new AccountType();
        $type->name = "inventory";
        $type->category = "Assets";
        $type->save();

        $type = new AccountType();
        $type->name = "Account Receivable";
        $type->category = "Assets";
        $type->save();

        $type = new AccountType();
        $type->name = "equity";
        $type->category = "equity";
        $type->save();

        $type = new AccountType();
        $type->name = "Account Payable";
        $type->category = "Liabilty";
        $type->save();

        $type = new AccountType();
        $type->name = "Expenses";
        $type->category = "Expenses";
        $type->save();



        return redirect()->route('index');
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

    public function showPurchase()
    {
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
        return $investor->accounts->where('account_type', 1)->first()->investor;

        // return  $investor->leadgerEntries()->where('transaction_type','=','App\Models\Investor')->get();

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

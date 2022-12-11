<?php

namespace App\Http\Controllers;

use App\Http\Controllers\investor as ControllersInvestor;
use App\Models\Investor;
use App\Models\InvestorLeadger;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\ChartOfAccount;
use App\Models\GLeadger;
use App\Models\User;
use App\Models\Sale;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Carbon\Cli\Invoker;
use finfo;
use Illuminate\Http\Request;
// use GuzzleHttp\Psr7\Request;

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
        // if invesotor alreay exists skip creting
        if ($investor === null) {

            $investor = new Investor();
            $investor->investor_name = "Alpha digital";
            $investor->email = "support@alphaDigital.com";
            $investor->phone = "00000000";
            $investor->prefix = "AD";
            $investor->investor_type = 1;
            $investor->save();
            
            /********************** creating accounts ****************************/
            // 1- cash
            $investor_cash = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_cash',
                'account_type' => 1,
                'opening_balance' => 120000
            ]);
            // 2- equipment
            $investor_eq = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_equipment',
                'account_type' => 2,
                'opening_balance' => 0
            ]);
            // 3- inventory
            $investor_inv = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_inventory',
                'account_type' => 3,
                'opening_balance' => 0
            ]);
            // 4 - bank
            $investor_bnk = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_bank',
                'account_type' => 4,
                'opening_balance' => 0
            ]);
            // 5- account receivable
            $investor_rcv = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_receivable',
                'account_type' => 5,
                'opening_balance' => 0
            ]);
            // 6- equity 
            $investor_eqt = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_equity',
                'account_type' => 6,
                'opening_balance' => -120000
            ]);
            // 7- payable
            $investor_pyb = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_payable',
                'account_type' => 7,
                'opening_balance' => 0
            ]);

            //8- expense
            $investor_pyb = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_expense',
                'account_type' => 8,
                'opening_balance' => 0
            ]);
            // 9 - unrealized profit
            $investor_un_pft = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_un_profit',
                'account_type' => 9,
                'opening_balance' => 0
            ]);
            // 10 - trade discount profit
            $investor_td_pft = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_trade_profit',
                'account_type' => 10,
                'opening_balance' => 0
            ]);
            
            /********************** Leadger Entries  ****************************/

            // adding entries to leadger of opening bakance of cash
            $investor->leadgerEntries()->create([
                'account_id' => $investor_cash->id,
                'investor_id'=>$investor->id,
                'value' => 120000,
                'date' => $investor->created_at
            ]);
            // adding entries to leadger of opening bakance of equity
            $investor->leadgerEntries()->create([
                'account_id' => $investor_eqt->id,
                'investor_id'=>$investor->id,
                'value' => -120000,
                'date' => $investor->created_at

            ]);
             // adding entries to leadger of opening bakance of bank
            $investor->leadgerEntries()->create([
                'account_id' => $investor_bnk->id,
                'investor_id'=>$investor->id,
                'value' => 0,
                'date' => $investor->created_at
            ]);
             // adding entries to leadger of opening bakance of equity
            $investor->leadgerEntries()->create([
                'account_id' => $investor_eqt->id,
                'investor_id'=>$investor->id,
                'value' => 0,
                'date' => $investor->created_at

            ]);


        } else {

        }
        return redirect()->route('index');
    }

    public function createAccountTypes()
    {
       /********************** Leadger Entries  ****************************/
        // 1- cash
        $type = new AccountType();
        $type->name = "cash";
        $type->category = "Assets";
        $type->save();
        //2- equipment  
        $type = new AccountType();
        $type->name = "Equipment";
        $type->category = "Assets";
        $type->save();
        //3- inventory
        $type = new AccountType();
        $type->name = "inventory";
        $type->category = "Assets";
        $type->save();
        //4- bank
        $type = new AccountType();
        $type->name = "Bank";
        $type->category = "Assets";
        $type->save();
        //5- account receivable
        $type = new AccountType();
        $type->name = "Account Receivable";
        $type->category = "Assets";
        $type->save();
        //6- equity
        $type = new AccountType();
        $type->name = "equity";
        $type->category = "equity";
        $type->save();
        //7- account payable
        $type = new AccountType();
        $type->name = "Account Payable";
        $type->category = "Liabilty";
        $type->save();
        //8- expenses
        $type = new AccountType();
        $type->name = "Expenses";
        $type->category = "Expenses";
        $type->save();
        //9-sale revenue
        $type = new AccountType();
        $type->name = "Sale Revenue";
        $type->category = "Revenue";
        $type->save();
        //10-trade discount revenue
        $type = new AccountType();
        $type->name = "Trade Discount Revenue";
        $type->category = "Revenue";
        $type->save();


        return redirect()->route('index');
    }


    
    public function index()
    {
        // queries for dashboard  calculations
        $investors = Investor::all();
        // finding the company investor
        $investor = Investor::find(1);
        $invCashAcc= $investor->charOfAccounts->where('account_type','=',1)->first()->id;
        $invRcvAcc= $investor->charOfAccounts->where('account_type','=',5)->first()->id;
        $invProAcc = $investor->charOfAccounts->where('account_type','=',9)->first()->id;

        $invinvAcc = $investor->charOfAccounts->where('account_type','=',3)->first()->id;

        $available_cash = GLeadger:: where('account_id','=',$invCashAcc)->sum('value');
        $rcv_cash = GLeadger:: where('account_id','=',$invRcvAcc)->sum('value');
        $pft = GLeadger:: where('account_id','=',$invProAcc)->sum('value');
        $pft = $pft * -1;
        $asset = GLeadger:: where('account_id','=',$invinvAcc)->sum('value');
        $sale = Sale::where('investor_id',1)->sum('total');
        

        return view("template.dashboard-content", compact('investors','investor','available_cash','rcv_cash','pft','sale','asset'));
    }

    public function getRecoveryOff(Request $request){
        // get user matching the key
        $users = User::where('name','like','%'.$request->key.'%')->get();
        return $users;
    }
    public function getMarketingOff(Request $request){
       
        // get user matching the key
        $users = User::where('name','like','%'.$request->key.'%')->get();
        return $users;
    }

    public function home($id)
    {   

       
        $investors = Investor::all();
        $investor = Investor::find($id);
        $invCashAcc= $investor->charOfAccounts->where('account_type','=',1)->first()->id;
        $invRcvAcc= $investor->charOfAccounts->where('account_type','=',5)->first()->id;
        $invProAcc = $investor->charOfAccounts->where('account_type','=',9)->first()->id;

        $invinvAcc = $investor->charOfAccounts->where('account_type','=',3)->first()->id;

        $available_cash = GLeadger:: where('account_id','=',$invCashAcc)->sum('value');
        $rcv_cash = GLeadger:: where('account_id','=',$invRcvAcc)->sum('value');
        $pft = GLeadger:: where('account_id','=',$invProAcc)->sum('value');
        $pft = $pft * -1;
        $asset = GLeadger:: where('account_id','=',$invinvAcc)->sum('value');
        $sale = Sale::where('investor_id',$id)->sum('total');
        

        return view("template.dashboard-content", compact('investors','investor','available_cash','rcv_cash','pft','sale','asset'));
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

    
    public function Users(){

        $users = User::all();
        return view('auth.users',compact('users'));
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
    
    public function getInvestorAccount( $investor_id){
       
        $accounts = ChartOfAccount::where('owner_id',$investor_id)->where(function ($query) {
            $query->where('account_type', '=', 1)->orWhere('account_type', '=', 4);})->get();

            return  $accounts;
    }
}

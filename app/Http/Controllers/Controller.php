<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Account;
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

        $investor = Investor::where('investor_type', '=', 1)->first();
        if ($investor === null) {
            $investor = new Investor();
            $investor->investor_name = "Alpha digital";
            $investor->email = "support@alphaDigital.com";
            $investor->phone = "00000000";
            $investor->prefix = "Company";
            $investor->investor_type = 1;
            $investor->save();
            // cash account
            // $account = new Account();
            // $account->account_name($investor->prefix.'cash');
            // $account->owner = $investor->id;
            // $account->save();

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
    public function showInventory(){
        return view('inventory.inventory');
    }
    public function showPurchase(){
        return view('purchase.purchase');
    }


    // unused routes
    public function testSQL()
    {
        return \Illuminate\Support\Facades\DB::table('users')->get();
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

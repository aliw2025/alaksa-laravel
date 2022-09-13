<?php

namespace App\Http\Controllers;

use App\Models\Investor;
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

    public function index()
    {   
        $investors = Investor::all();  
        return view("template.dashboard-content",compact('investors'));
    }
    
    public function home($id)
    {
        $investor = Investor::find($id);
        // dd($investor);
        //return view("home");
        return view("template.dashboard-content",compact('investor'));
    }
    public function showInvestments(){

        return view("capital-investments.capital-investment");
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

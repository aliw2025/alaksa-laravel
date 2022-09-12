<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Item;
use App\Models\Set;
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
        return view("template.dashboard-content");
    }
    
    public function home()
    {
        //return view("home");
        return view("template.dashboard-content");
    }

    public function items()
    {
        $items = Item::orderBy('id', 'asc')->paginate(5);

        return view('cssd.items', compact('items'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // $items = Item::all();
        // dd($items);
        // return view('cssd.items', compact( 'items', 'items'));
    }

    public function testSet()
    {

        $set = Set::find(2);
        //  dd($set);
        return $set->items;
    }

    public function testAdd($id)
    {

        $set  = Set::find(1);
        // dd($set);
        $set->items()->attach($id, ['quantity' => 3]);
        return $set;
    }

    public function showSet(Set $id)
    {
        $set = Set::find($id)->first();
        return $set;
    }

    public function showItem(Item $id)
    {
        // dd($item);
        $item = Item::find($id)->first();
        return $item;
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

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Set;
use App\Models\SetItems;
use Laravel\Ui\Presets\React;

class SetItemController extends Controller
{
    //
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createSet($id)
    {   $set = Set::find($id);
        $items = SetItems::distinct('item_id')->where('set_id',$id)->pluck('item_id')->toArray();
        $items = Item::whereNotIn('id' , $items)->get();
        // return $items;
        return view('cssd.add-items-to-set', compact('set', 'items'));
        

    }
    public function getMatchingItems(Request $request,$id)
    {   
        $key = $request->key;
        $set = Set::find($id);
        $items = SetItems::distinct('item_id')->where('set_id',$id)->pluck('item_id')->toArray();
        $items = Item::where('name','like', '%' .$request->key. '%')->whereNotIn('id' , $items)->get();
        
        return $items;
        // return view('cssd.add-items-to-set', compact('set', 'items'));
        

    }
    public function addItemToSet(Request $request, $id)
    {  // dd($request);
        $set = Set::find($id);
        $set->items()->attach($request->itemId, ['quantity' => $request->quantity]);

        return redirect()->route('create-set',$id);
    }
}

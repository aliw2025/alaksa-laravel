<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    use HasFactory;

   
    public function item(){

        return $this->belongsTo(Item::class,'item_id');
        
    }
    
    public function investor(){

        return $this->belongsTo(Investor::class,'investor_id');
        
    }

    // public function itemProperties(){

    //     return $this->Item()->propertyValues();
    //     // return $this->belongsTo(Item::class,'item_id');
    // }

    // public static function investor_inventory($id){
    //     return Inventory::where('investor_id','=',$id)->get();
    // }
}

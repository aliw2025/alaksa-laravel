<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    use HasFactory;

   
    public function Item(){

        return $this->belongsTo(Item::class,'item_id');
        
    }
    public function investor(){

        return $this->belongsTo(Investor::class,'investor_id');
        
    }
}

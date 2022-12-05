<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public function purchases()
    {
        return $this->belongsToMany(Purchase::class,'purchase_items','item_id','purchase_id');

    }
    public function supplier(){

        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function propertyValues(){
        
        return $this->hasMany(PropertyValue::class,'item_id');
    }
    public function Category(){
        return $this->belongsTo(Category::class,"cat_id");
    }
}


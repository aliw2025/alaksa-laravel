<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    // protected $primaryKey = 'purchase_no';
    
    public function items()
    {
        return $this->belongsToMany(Item::class,'purchase_items','purchase_id','item_id')->withPivot('quantity', 'unit_cost','trade_discount','created_at','updated_at');;
    }
    
    // public function payable(){
      
    //     return $this->hasOne(Payable::class,'transaction_id');
    // }

    public function investor()
    {
            return $this->belongsTo(Investor::class,'investor_id');
    }
    public function supplier_val()
    {       
        
            return $this->belongsTo(Supplier::class,'supplier');
    }
    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }
    
    public function leadgerValue(){
        return ($this->leadgerEntries());
        return $this->leadgerEntries()->first()->get();
    }
    public function psupplier(){
      
        return $this->belongsTo(Supplier::class,'supplier');
    }
    
}

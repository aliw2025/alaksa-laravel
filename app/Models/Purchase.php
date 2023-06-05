<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Purchase extends Model
{
    use HasFactory;
    // protected $primaryKey = 'purchase_no';
    
    public function items()
    {
        return $this->belongsToMany(Item::class,'purchase_items','purchase_id','item_id')->withPivot('quantity', 'unit_cost','trade_discount','created_at','updated_at');;
    }

    public function purchaseItems(){

        return $this->hasMany(PurchaseItem::class,'purchase_id');
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
    public function createLeadgerEntry($accound_id,$value,$investor_id,$date,$user_id ){

        $this->leadgerEntries()->create([
            'account_id' => $accound_id,
            'value' => $value,
            'investor_id' => $investor_id,
            'date' => $date,
            'user_id'=>$user_id
        ]);
    }
    
    public function leadgerValue(){
        return ($this->leadgerEntries());
        return $this->leadgerEntries()->first()->get();
    }
    public function psupplier(){
      
        return $this->belongsTo(Supplier::class,'supplier');
    }
    
    public function scopeShowPurchases($query,$from_date,$to_date,$investor_id,$supplier_id,$status_id)
    {   
     
         $query->whereBetween('purchase_date',[$from_date,$to_date]);
    
         if(isset($investor_id)){
           
           $query=$query->where('investor_id',$investor_id);
         }
         if(isset($supplier_id)){
            $query=$query->where('supplier',$supplier_id);
         }
         if(isset($status_id)){
            $query=$query->where('status',$status_id);
         }

         return $query;

    }
    
    public function transaction_status(){
        
        return $this->belongsTo(TransactionStatus::class,'status');
 
    }
    
}

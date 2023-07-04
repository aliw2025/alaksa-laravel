<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;
    public function investor()
    {
            return $this->belongsTo(Investor::class,'investor_id');
    }

    public function supplier_val()
    {       
        
            return $this->belongsTo(Supplier::class,'supplier_id');
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

    public function scopeShowSupplierPayments($query,$from_date,$to_date,$investor_id,$supplier_id,$status_id)
    {   
     
         $query->whereBetween('payment_date',[$from_date,$to_date]);
    
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
}

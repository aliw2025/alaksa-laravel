<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstalmentPayment extends Model
{
    use HasFactory;
    
    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }
    

    public function Instalment(){
        
        return $this->belongsTo(Instalment::class,'instalment_id'); 

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

    public function transaction_status(){
        
        return $this->belongsTo(TransactionStatus::class,'status'); 
 
    }
  


    public function scopeSearchInstPayment($query,$from_date,$to_date,$investor,$customer_name,$customer_id,$invoice,$status_id)
    {   
        // dd($commission);
        $query->whereBetween('payment_date',[$from_date,$to_date]);
    
         if(isset($customer_id)){
                $query= $query->whereHas('instalment', function ($ins) use($customer_id)  {
                    $ins= $ins->whereHas('sale', function ($ins)  use($customer_id) {
                    $ins->where('customer_id',$customer_id);
                });
            });
         }
         if(isset($customer_name)){
            $query= $query->whereHas('instalment', function ($ins) use($customer_name)  {
                    $ins= $ins->whereHas('sale', function ($ins)  use($customer_name) {
                    $ins->where('customer_name','like','%'.$customer_name.'%');
                });
            });
         }

         if(isset($status_id)){

            $query=$query->where('status',$status_id);

         }
         return $query;

        
    }
}

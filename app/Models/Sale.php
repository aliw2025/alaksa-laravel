<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Sale extends Model
{
    public $timestamps = false;

    use HasFactory;

    public function instalments(){

     return $this->hasMany(Instalment::class,'sale_id');
     
    }
    public function investor(){
        return $this->belongsTo(Investor::class,'investor_id');
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }
    public function customer(){
       return $this->belongsTo(Customer::class,'customer_id');
    }
    
    public function recoveryOfficer(){
        return $this->belongsTo(User::class,'rec_of_id');
     }
     
     public function inquiryOfficer(){

        return $this->belongsTo(User::class,'inq_of_id');
     }
     public function marketingOfficer(){

        return $this->belongsTo(User::class,'mar_of_id');
     }
     public function pay_type_name(){

        return $this->belongsTo(PaymentType::class,'payment_type');

     }
     
    //  this is the real one
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

    public function saleCommision(){
        
        return $this->morphMany(Commission::class,'transaction');
    }

    public function createSaleComision($sale,$user_id){
        $this->saleCommision()->create(
            [
                'commission_type' => 1,
                'user_id' => $sale->mar_of_id,
                'amount' => str_replace(',','',$sale->total) * 0.01,
                'status' => 0,
                'earned_date' => $sale->sale_date,
                'user_id'=>$user_id
            ]
        );
    }

    public function transaction_status(){
        
       return $this->belongsTo(TransactionStatus::class,'status');

    }
    public function saleStatus( ){

        return $this->belongsTo(SaleStatus::class,'stauts');
    }

    public function scopeSearchSale($query,$from_date,$to_date,$customer_name,$customer_id,$invoice,$status_id)
    {   
        // dd($commission);
        $query->whereBetween('sale_date',[$from_date,$to_date]);
    
         if(isset($customer_id)){
           
           $query=$query->where('customer_id',$customer_id);
         }
         if(isset($customer_name)){
            $query= $query->whereHas('customer', function ($cus)  use ($customer_name) {
                $cus->where('customer_name','like','%'.$customer_name.'%');
            });
         }
         if(isset($status_id)){
            $query=$query->where('status',$status_id);
         }
         if(isset($invoice)){
            $query=$query->where('invoice_no','like','%'.$invoice);
         }

         return $query;

        
        
    }
   
}

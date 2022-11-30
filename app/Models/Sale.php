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
        return $this->belongsTo(User::class,'rec_of_id');
     }
     public function marketingOfficer(){
        return $this->belongsTo(User::class,'mar_of_id');
     }

    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }
    
    public function saleCommision(){
        return $this->morphMany(Commission::class,'transaction');
    }
    public function saleStatus( ){

        return $this->belongsTo(SaleStatus::class,'stauts');
    }

    public function scopeSearchSale($query,$from_date,$to_date,$customer_name,$customer_id,$invoice)
    {   
        // dd($commission);
        
        if($invoice!=NULL){
            return $query->where('invoice_no','like','%'.$invoice);
        }else if($customer_id!= NULL){
            return $query->where('customer_id',$customer_id);
            
        }else if($customer_name!= NULL){

            return $query->whereHas('customer', function ($cus)  use ($customer_name) {
                $cus->where('customer_name','like','%'.$customer_name.'%');
            });
            
        }



    //    if($user==NULL){
    //         // dd('null');
    //         if($commission==3){
    //             return $query->whereBetween('earned_date',[$from_date,$to_date]);

    //         }
    //         return $query->whereBetween('earned_date',[$from_date,$to_date])->where('commission_type',$commission);
    //    }else{
    //         if($commission==3){
    //             return $query->whereBetween('earned_date',[$from_date,$to_date])->where('user_id',$user);

    //         }
    //         // dd($commission);
    //         return $query->whereBetween('earned_date',[$from_date,$to_date])->where('commission_type',$commission)->where('user_id',$user);
    //    }
        return$query->whereBetween('sale_date',[$from_date,$to_date]);
    }
   
}


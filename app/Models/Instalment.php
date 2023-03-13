<?php

namespace App\Models;
use Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalment extends Model
{
    use HasFactory;

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

    public function scopeSearchInstalment($query,$from_date,$to_date,$customer_name,$customer_id,$instalment_paid)
    {   
        // dd($commission);
        
        // if($invoice!=NULL){
            
        //     return $query->where('invoice_no','like','%'.$invoice);
        // }
        // else if($customer_id!= NULL){
        //     return $query->where('customer_id',$customer_id);
            
        // }
        // else if($customer_name!= NULL){

        //     return $query->whereHas('customer', function ($cus)  use ($customer_name) {
        //         $cus->where('customer_name','like','%'.$customer_name.'%');
        //     });
        
        // }
        
        if($instalment_paid==2){
            if($customer_name != Null){
                
            }
            return $query->whereBetween('due_date',[$from_date,$to_date])->whereHas('sale', function($query){
                $query->where('rec_of_id', Auth::user()->id);
            })->with('sale');
        }else{


        }
        return $query->whereBetween('due_date',[$from_date,$to_date])->where('instalment_paid',$instalment_paid)->whereHas('sale', function($query){
            $query->where('rec_of_id', Auth::user()->id);
        })->with('sale');
    }

    public function sale(){

        return $this->belongsTo(Sale::class,'sale_id');
    }
    
    public function saleCommision(){
        return $this->morphMany(Commission::class,'transaction');
    }
    public function createInstalmentComision($sale,$user_id,$payment){
       
        $this->saleCommision()->create(
            [
                'commission_type' => 2,
                'user_id' => $sale->rec_of_id,
                'amount' =>  $payment->amount,
                'status' => 0,
                'earned_date' => $payment->payment_date,
                'user_id' =>$user_id,
            ]
        );
    }
    public function instalmentPayments(){
        return $this->hasMany(InstalmentPayment::class,'instalment_id');
    }
}

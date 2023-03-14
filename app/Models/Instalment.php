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

        // in case of first request instalment paid is null
        if($instalment_paid==2 || $instalment_paid==null){
            // if customer name is provided
            if($customer_name != Null){
                return $query->whereBetween('due_date',[$from_date,$to_date])->whereHas('sale', function($query) use($customer_name){
                    $query->where('rec_of_id', Auth::user()->id)->whereHas('customer',function($query2) use($customer_name) {
                        $query2->where('customer_name','like','%'.$customer_name.'%');
                    });
                })->with('sale');
            }
            // search by Id
            if($customer_id != Null){
                return $query->whereBetween('due_date',[$from_date,$to_date])->whereHas('sale', function($query) use($customer_id){
                    $query->where('rec_of_id', Auth::user()->id)->whereHas('customer',function($query2) use($customer_id) {
                        $query2->where('id',$customer_id);
                    });
                })->with('sale');
            }
            // if no parameter provided just search by date and return all statuses
            return $query->whereBetween('due_date',[$from_date,$to_date])->whereHas('sale', function($query){
                $query->where('rec_of_id', Auth::user()->id);
            })->with('sale');

        }
        // if instalment status is provided 
        else{
           
            if($customer_name != Null){
                return $query->whereBetween('due_date',[$from_date,$to_date])->where('instalment_paid',$instalment_paid)->whereHas('sale', function($query) use($customer_name){
                    $query->where('rec_of_id', Auth::user()->id)->whereHas('customer',function($query2) use($customer_name) {
                        $query2->where('customer_name','like','%'.$customer_name.'%');
                    });
                })->with('sale');
            }
            // search by Id
            if($customer_id != Null){
                return $query->whereBetween('due_date',[$from_date,$to_date])->where('instalment_paid',$instalment_paid)->whereHas('sale', function($query) use($customer_id){
                    $query->where('rec_of_id', Auth::user()->id)->whereHas('customer',function($query2) use($customer_id) {
                        $query2->where('id',$customer_id);
                    });
                })->with('sale');
            }

            return $query->whereBetween('due_date',[$from_date,$to_date])->where('instalment_paid',$instalment_paid)->whereHas('sale', function($query){
                $query->where('rec_of_id', Auth::user()->id);
            })->with('sale');
        }
       

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }
   
    public function transaction_status(){
        
        return $this->belongsTo(TransactionStatus::class,'status');
 
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
    public function head(){

      return  $this->belongsTo(ExpenseHead::class,'head_id','id');
    }
    public function subHead(){

        return  $this->belongsTo(SubExpenseHead::class,'sub_head_id','id');
    }

    public function investor(){
        return $this->belongsTo(Investor::class,'investor_id');
    }
    public function scopeShowExpenses($query,$from_date,$to_date,$head_id,$sub_head_id,$investor_id,$status_id)
    {    
        $query->whereBetween('date',[$from_date,$to_date]);
    
        if(isset($investor_id)){
          
          $query=$query->where('customer_id',$investor_id);
        }
        
        if(isset($head_id)){
           $query=$query->where('head_id',$head_id);
        }
        if(isset($sub_head_id)){
            $query=$query->where('sub_head_id',$sub_head_id);
         }

         if(isset($status_id)){
            $query=$query->where('status',$status_id);
         }

       

        return $query;

        
    }
    public function scopeNegativeCheck($query,$account,$amount,$investor){



        $query = GLeadger::where('account_id','=',$account)->where('investor_id','=',$investor);
        
        $sum= $query->sum('value');
        if(($sum-$amount)<0){
            return false;
        }else{
            return true;
        }
    }

}

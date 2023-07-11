<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferRequests extends Model
{
    use HasFactory;

    public function sender_account() {

        return $this->belongsTo(ChartOfAccount::class,'sender_account_id');
    }
    public function reciever_account() {

        return $this->belongsTo(ChartOfAccount::class,'reciever_account_id');
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

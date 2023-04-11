<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorLoan extends Model
{
    use HasFactory;


    public function investor1()
    {
            return $this->belongsTo(Investor::class,'inv1_id');
    }
    public function investor2()
    {
            return $this->belongsTo(Investor::class,'inv2_id');
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
}

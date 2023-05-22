<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
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
}

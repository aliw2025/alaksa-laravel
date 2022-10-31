<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    use HasFactory;

    public function purchase()
    {
            return $this->belongsTo(Purchase::class,'transaction_id');
    }

    public function investor()
    {
            return $this->belongsTo(Investor::class,'investor_id');
    }
    public function supplier_val()
    {       
        
            return $this->belongsTo(Supplier::class,'supplier');
    }
   
    

    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }
}

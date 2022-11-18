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
   
}


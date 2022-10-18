<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function charOfAccounts(){

        return $this->morphMany(ChartOfAccount::class,'owner');

    }
   
    public function purchases(){
        return $this->hasMany(Purchase::class,'supplier');
    }

    public function payments(){
        return $this->hasMany(Payable::class,'supplier');
    }


    public function investor_purchases($id){
       return $this->purchases->where('investor_id', '=', $id);
    }

    public function investor_payments($id){
        return $this->payments()->where('investor_id', '=', $id);
    }


    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }

}

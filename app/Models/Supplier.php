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
   
    public function items(){

        return $this->hassMany(Item::class,'supplier_id');
    }
   public function category(){

    return $this->belongsTo(Category::class,'category_id');
   }

    public function payments(){
        return $this->hasMany(SupplierPayment::class,'supplier_id');
    }


    public function investor_payments($id){
        // dd($id);
        return $this->payments()->where('investor_id', '=', $id)->where('status',3)->get();
    }

    public function purchases(){
        return $this->hasMany(Purchase::class,'supplier');
    }
    
    public function investor_purchases($id){
       
       return $this->purchases()->where('investor_id', '=', $id)->where('status',3)->get();
    }

    public function investor_Sup_expenses($id){
       
        $sup_acc_id = $this->charOfAccounts->where('account_type',7)->first()->id;
      
         $led =  GLeadger::where('investor_id', '=', $id)->where('transaction_type','App\Models\Expense')->where('account_id',$sup_acc_id)->get();
        //  dd($led);
        return $led;
    }


   

    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }

}

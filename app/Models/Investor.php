<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Investor extends Model
{
    use HasFactory;
    
    public function purchases()
    {
        // ->withPivot('store_id', 'supplier','purchase_date','created_at','updated_at')
        return $this->hasMany(Purchase::class);
        
    }
    public function sales()
    {
        // ->withPivot('store_id', 'supplier','purchase_date','created_at','updated_at')
        return $this->hasMany(Sale::class);
        
    }

    public function accounts(){
        return $this->hasMany(Account::class,'owner');
    }


    public function charOfAccounts(){

        return $this->morphMany(ChartOfAccount::class,'owner');

    }

    public function inventories(){

        return $this->hasMany(Inventory::class,'investor_id');
    }
    
    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }

}

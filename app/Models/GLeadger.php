<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class GLeadger extends Model
{

    // sale
    // purchase
    // pay
    // instalment
    use HasFactory;
    protected $guarded = [];    
    
    // anyohter name
    public function transactionable()
    {
        
        return $this->morphTo(__FUNCTION__, 'transaction_type', 'transaction_id');
        // return $this->morphTo();

    }
    
     public function investor()
    {
        return $this->belongsTo(investor::class,'investor_id');
    }
    
    public function transaction()
    {
        
        // return $this->morphTo(__FUNCTION__, 'transaction_type', 'transaction_id');
        return $this->morphTo();

    }
    public function account() {

        return $this->belongsTo(ChartOfAccount::class,'account_id');
    }


    

}

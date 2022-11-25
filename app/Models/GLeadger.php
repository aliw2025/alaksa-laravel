<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GLeadger extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function transaction ()
    {
        // dd("sdsd");
        return $this->morphTo('transaction');
    }
    public function account() {

        return $this->belongsTo(ChartOfAccount::class,'account_id');
    }
    // public function purchase() {
      
    //     return $this->belongsTo(Purchase::class,'transaction_id');
    // }

}

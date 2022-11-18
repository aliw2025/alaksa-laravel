<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{ protected $guarded = [];
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopeReportData($query,$from_date,$to_date,$user,$commission)
    {   
        // dd($commission);
        
       if($user==NULL){
            // dd('null');
            return $query->whereBetween('earned_date',[$from_date,$to_date])->where('commission_type',$commission);
       }else{
            // dd($commission);
            return $query->whereBetween('earned_date',[$from_date,$to_date])->where('commission_type',$commission)->where('user_id',$user);
       }
    }

}

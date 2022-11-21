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
            if($commission==3){
                return $query->whereBetween('earned_date',[$from_date,$to_date]);

            }
            return $query->whereBetween('earned_date',[$from_date,$to_date])->where('commission_type',$commission);
       }else{
            if($commission==3){
                return $query->whereBetween('earned_date',[$from_date,$to_date])->where('user_id',$user);

            }
            // dd($commission);
            return $query->whereBetween('earned_date',[$from_date,$to_date])->where('commission_type',$commission)->where('user_id',$user);
       }
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    // public function items()
    // {
    //     return $this->belongsToMany(Set::class,'set_items','set_id','item_id');
    // }
    public function items()
    {
        return $this->belongsToMany(Item::class,'set_items','set_id','item_id')->withPivot('quantity', 'created_at','updated_at');;
    }

} 
    

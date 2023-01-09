<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyValue extends Model
{
    use HasFactory;

    public function propertyName(){

        return $this->belongsTo(CategoryProperty::class,'prop_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $timestamps = false;

    use HasFactory;

    public function instalments(){

     return $this->hasMany(Instalment::class,'sale_id');
    }
}

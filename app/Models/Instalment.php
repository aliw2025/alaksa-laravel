<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalment extends Model
{
    use HasFactory;

    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }
    public function sale(){

        return $this->belongsTo(Sale::class,'sale_id');
    }
    public function saleCommision(){
        return $this->morphMany(Commission::class,'transaction');
    }
}

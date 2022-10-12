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
    public function leadgerEntries(){

        return $this->morphMany(GLeadger::class,'transaction');
    }
}

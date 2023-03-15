<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferRequests extends Model
{
    use HasFactory;

    public function sender_account() {

        return $this->belongsTo(ChartOfAccount::class,'sender_account_id');
    }
    public function reciever_account() {

        return $this->belongsTo(ChartOfAccount::class,'reciever_account_id');
    }

}

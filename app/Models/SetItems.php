<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetItems extends Model
{
    use HasFactory;

    protected $table = 'set_items';
    

    public function items()
    {
        return $this->belongsTo(Item::class , 'item_id' , 'id');
    }
}

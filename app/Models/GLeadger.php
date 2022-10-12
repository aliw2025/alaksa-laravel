<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GLeadger extends Model
{
    use HasFactory;

    public function transaction ()
    {
        return $this->morphTo();
    }
}

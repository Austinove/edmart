<?php

namespace App\finance\expences;

use Illuminate\Database\Eloquent\Model;

class RequestedExps extends Model
{
    protected $fillable = [
        "viewed",
        "recommended",
        "aproved"
    ];
}

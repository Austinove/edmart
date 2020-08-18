<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestedExps extends Model
{
    protected $fillable = [
        "viewed",
        "recommended",
        "reason"
    ];
}

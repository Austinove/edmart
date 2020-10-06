<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        "client",
        "desc",
        "fee",
        "Assmanager",
        "commencement",
        "completion",
        "status"
    ];
}

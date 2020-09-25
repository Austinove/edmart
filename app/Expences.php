<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expences extends Model
{
    protected $fillable = [
        "desc",
        "amount",
        "status",
        "viewed",
        "reason"
    ];

    public function requestedExps() {
        return $this->hasOne("App\RequestedExps");
    }

    public function cancelledExps() {
        return $this->hasOne("App\cancelledExps");
    }

    public function approvedExps() {
        return $this->hasOne("App\ApprovedExps");
    }

    public function user() {
        return $this->belongsTo("App\User");
    }
}

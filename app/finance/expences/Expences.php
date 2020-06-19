<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expences extends Model
{
    protected $fillable = [
        "desc",
        "amount",
        "status"
    ];

    public function requestedExps() {
        return $this->hasOne("App\finance\expences\RequestedExps");
    }

    public function cancelledExps() {
        return $this->hasOne("App\finance\expences\CancelledExps");
    }

    public function approvedExps() {
        return $this->hasOne("App\finance\expences\ApprovedExps");
    }
}

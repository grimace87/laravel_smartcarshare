<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    // Define primary key and disable timestamps
    public $primaryKey = 'Review_Id';
    public $timestamps = false;

    // Define relationships

    public function member() {
        return $this->belongsTo('App\Member', 'Membership_No');
    }

    public function rego() {
        return $this->belongsTo('App\Vehicle', 'Rego_No');
    }

}

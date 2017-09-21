<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    // Define primary key and disable timestamps
    public $primaryKey = 'Booking_No';
    public $timestamps = false;

    // Define relationships

    public function rego() {
        return $this->belongsTo('App\Vehicle', 'Rego_No');
    }

    public function membership() {
        return $this->belongsTo('App\Member', 'Membership_No');
    }

    public function payment() {
        return $this->belongsTo('App\Payment', 'Payment_No');
    }

    public function staff() {
        return $this->belongsTo('App\Staff', 'Staff_No');
    }

}

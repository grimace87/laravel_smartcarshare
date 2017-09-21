<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    // Define primary key and disable timestamps
    public $primaryKey = 'Payment_No';
    public $timestamps = false;

    // Define relationships

    public function member() {
        return $this->belongsTo('App\Member', 'Membership_No');
    }

    public function staff() {
        return $this->belongsTo('App\Staff', 'Staff_No');
    }

    public function bookings() {
        return $this->hasMany('App\Booking', 'Payment_No');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    // Define primary key and disable timestamps
    public $primaryKey = 'Membership_No';
    public $timestamps = false;

    // Define relationships

    public function memberships() {
        return $this->hasMany('App\MemberMembership', 'Membership_No');
    }

    public function bookings() {
        return $this->hasMany('App\Booking', 'Membership_No');
    }

    public function payments() {
        return $this->hasMany('App\Payment', 'Membership_No');
    }

    public function reviews() {
        return $this->hasMany('App\Review', 'Membership_No');
    }

    public function damageReports() {
        return $this->hasMany('App\DamageReport', 'Membership_No');
    }

}

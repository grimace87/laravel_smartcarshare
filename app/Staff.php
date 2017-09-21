<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{

    use Notifiable;

    // Define primary key and disable timestamps
    public $primaryKey = 'Staff_No';
    public $timestamps = false;

    // Copied parameters from the original Auth-related User class
    protected $fillable = [
        'First_Name', 'Last_Name', 'Street_Address', 'Suburb', 'Postcode', 'Phone_No', 'Email_Add', 'Position', 'Date_Birth', 'username', 'password'
    ];
    protected $hidden = [ 'password', 'remember_token' ];

    // Define relationships

    public function locations() {
        return $this->hasMany('App\Location', 'Staff_No');
    }

    public function payments() {
        return $this->hasMany('App\Payment', 'Staff_No');
    }

    public function bookings() {
        return $this->hasMany('App\Booking', 'Staff_No');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    // Define primary key and disable timestamps (also tell Eloquent that the primary key doesn't increment)
    public $primaryKey = 'Rego_No';
    public $timestamps = false;
    public $incrementing = false;

    // Define relationships

    public function location() {
        return $this->belongsTo('App\Location', 'Location_Id');
    }

    public function vehicleType() {
        return $this->belongsTo('App\VehicleType', 'Type_Id');
    }

    public function bookings() {
        return $this->hasMany('App\Booking', 'Rego_No');
    }

    public function reviews() {
        return $this->hasMany('App\Review', 'Rego_No');
    }

    public function damageReports() {
        return $this->hasMany('App\DamageReport', 'Rego_No');
    }

}

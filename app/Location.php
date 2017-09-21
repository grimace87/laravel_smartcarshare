<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    // Define primary key and disable timestamps
    public $primaryKey = 'Location_Id';
    public $timestamps = false;

    // Define relationships

    public function staff() {
        return $this->belongsTo('App\Staff', 'Staff_No');
    }

    public function vehicles() {
        return $this->hasMany('App\Vehicle', 'Location_Id');
    }

}

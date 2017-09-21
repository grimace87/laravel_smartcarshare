<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{

    // Define primary key and disable timestamps
    public $primaryKey = 'Type_Id';
    public $timestamps = false;

    // Define relationships

    public function rego() {
        return $this->belongsTo('App\Vehicle', 'Rego_No');
    }

}

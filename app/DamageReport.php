<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{

    // Define primary key and disable timestamps
    public $primaryKey = 'Damage_Id';
    public $timestamps = false;

    // Define relationships

    public function member() {
        return $this->belongsTo('App\Member', 'Membership_No');
    }

    public function rego() {
        return $this->belongsTo('App\Vehicle', 'Rego_No');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberMembership extends Model
{

    /*
     * THIS IS THE PART WHERE THE CRAP HAPPENS
     *
     * LARAVEL DOESN'T SUPPORT COMPOSITE PRIMARY KEYS
     * UNLESS THEY ARE DEFINED WITHIN A MIGRATION
     */

    // Define primary key and disable timestamps (also tell Eloquent that the primary key doesn't increment)
    public $primaryKey = '';
    public $timestamps = false;
    public $incrementing = false;

    // Define relationships

    public function member() {
        return $this->belongsTo('App\Member', 'Membership_No');
    }

    public function membershipType() {
        return $this->belongsTo('App\MembershipType', 'MemType_Id');
    }

}

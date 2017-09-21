<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{

    // Define primary key and disable timestamps
    public $primaryKey = 'MemType_Id';
    public $timestamps = false;

    // Define relationships

    public function memberships() {
        return $this->hasMany('App\MemberMembership', 'MemType_Id');
    }
}

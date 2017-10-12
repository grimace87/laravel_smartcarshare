<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MemberMembership extends Model
{

    /*
     * THIS IS THE PART WHERE THE CRAP HAPPENS
     *
     * LARAVEL DOESN'T SUPPORT COMPOSITE PRIMARY KEYS
     * UNLESS THEY ARE DEFINED WITHIN A MIGRATION
     */

    // Define primary key and disable timestamps (also tell Eloquent that the primary key doesn't increment)
    public $primaryKey = ['Membership_No', 'MemType_Id'];
    public $timestamps = false;
    public $incrementing = false;

    // Override the key-querying functions because it doesn't account for composite primary keys
    protected function setKeysForSaveQuery(Builder $query)
    {
        foreach ($this->primaryKey as $key)
            $query->where($key, '=', $this->getKeyForSaveQuery($key));

        return $query;
    }
    protected function getKeyForSaveQuery($key = '')
    {
        return isset($this->original[$key])
            ? $this->original[$key]
            : $this->getAttribute($key);
    }

    // Define relationships

    public function member() {
        return $this->belongsTo('App\Member', 'Membership_No');
    }

    public function membershipType() {
        return $this->belongsTo('App\MembershipType', 'MemType_Id');
    }

}

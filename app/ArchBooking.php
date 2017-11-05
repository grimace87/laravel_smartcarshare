<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchBooking extends Model
{
    
    // Define primary key and disable timestamps
    public $primaryKey = 'Arch_No';
    public $timestamps = false;

}

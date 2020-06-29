<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'TX_CONTACT_US';

    protected $fillable = [
    	'CONTACT_US_EMAIL',
        'CONTACT_US_NAME',
        'CONTACT_US_TEXT',
        'CONTACT_US_READ',
    ];
    
    public $timestamps = false;
}

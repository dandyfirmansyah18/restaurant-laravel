<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'TX_CLIENT';
    protected $fillable = [
        'CLIENT_NAME','CLIENT_WEBSITE','CLIENT_LOGO'
    ];
    protected $primaryKey = 'CLIENT_ID';    
}

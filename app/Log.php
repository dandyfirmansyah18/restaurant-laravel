<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'TL_LOGS';

    protected $fillable = [
    					'USER_ID',
						'SESSION_ID',
						'REQUEST_METHOD',
						'LOG_URL',
						'REQUEST_PAYLOAD',
						'LOG_TASK',
						'CLIENT_IP_ADDRESS',
						'CLIENT_HTTP_AGENT'
					];
					
	public $timestamps = false;
}

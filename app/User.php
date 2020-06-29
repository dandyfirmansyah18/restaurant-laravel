<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'TM_USERS';

    protected $fillable = [
        'PROFILE_ID','USER_NAME', 'USER_EMAIL', 'USER_PASSWORD', 'USER_ROLE_ID', 'USER_STATUS_ID', 'USER_LAST_LOGIN', 'REMEMBER_TOKEN', 'SESSION_ID', 'PASSWORD_RESET_CODE', 'PASSWORD_RESET_EXPIRED'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'USER_PASSWORD', 'REMEMBER_TOKEN',
    ];

    protected $primaryKey = 'USER_ID';

    public function getAuthPassword()
    {
        return $this->USER_PASSWORD;
    }
}

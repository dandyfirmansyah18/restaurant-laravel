<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'TM_PROFILE';

    protected $fillable = [					    
					    'PROFILE_KODE_CASHIER',
						'PROFILE_CASHIER_NAME',						
						'PROFILE_ADDRESS',
						'PROFILE_STATE',
						'PROFILE_CITY',
						'PROFILE_DISTRICT',
						'PROFILE_SUB_DISTRICT',
						'PROFILE_POST_CODE',						
						'PROFILE_EMAIL',
						'PROFILE_PHONE',						
						'PROFILE_PASSWORD',
						'CREATED_BY',
						'UPDATED_BY',
						];
}

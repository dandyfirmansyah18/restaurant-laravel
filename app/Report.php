<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $table = 'TX_REPORT';
    protected $fillable = [
        'REPORT_TYPE_ID', 'PROFILE_ID', 'REPORT_DATE', 'REPORT_PATH', 'REPORT_FILENAME', 'CREATED_BY', 'UPDATED_BY'
    ];
    protected $primaryKey = 'REPORT_ID';
    // public $timestamps = false;
}

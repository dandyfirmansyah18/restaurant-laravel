<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'TR_TABLE';
    protected $fillable = [
        'TABLE_NO', 'TABLE_PEOPLE_MAX'
    ];
    protected $primaryKey = 'TABLE_ID';
    public $timestamps = false;
}

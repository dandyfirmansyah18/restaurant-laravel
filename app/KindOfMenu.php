<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KindOfMenu extends Model
{
    protected $table = 'TR_KIND_MENU';
    protected $fillable = [
        'KIND_MENU_NAME'
    ];
    protected $primaryKey = 'KIND_MENU_ID';
    public $timestamps = false;
}

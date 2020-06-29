<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'TM_MENU';
    protected $fillable = [
        'MENU_NAME', 'PRICE', 'PHOTO', 'KIND_MENU_ID'
    ];
    protected $primaryKey = 'MENU_ID';
    public $timestamps = false;
}

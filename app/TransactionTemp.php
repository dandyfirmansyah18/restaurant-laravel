<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionTemp extends Model
{
    protected $table = 'TX_TRANSACTION_TEMP';
    protected $fillable = [
        'TRANSACTION_TEMP_TRANSACTION_NUMBER', 'TRANSACTION_TEMP_ID_MENU', 'TRANSACTION_TEMP_AMOUNT'
    ];
    protected $primaryKey = 'TRANSACTION_TEMP_ID';
    public $timestamps = false;
}

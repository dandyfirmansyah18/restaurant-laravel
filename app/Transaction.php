<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'TX_TRANSACTION';
    protected $fillable = [
        'TRANSACTION_CUSTOMER_NAME', 'TRANSACTION_NUMBER', 'TRANSACTION_TYPE', 'TRANSACTION_TABLE_ID', 'TRANSACTION_PRICE', 'TRANSACTION_TAX', 'TRANSACTION_PRICE_TOTAL', 'TRANSACTION_CASHIER_ID'
    ];
    protected $primaryKey = 'TRANSACTION_ID';
    public $timestamps = false;
}

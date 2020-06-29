<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'TX_TRANSACTION_DETAIL';
    protected $fillable = [
        'TRANSACTION_MENU_ID', 'TRANSACTION_MENU_AMOUNT', 'TRANSACTION_MENU_PRICE_TOTAL', 'TRANSACTION_ID', 'TRANSACTION_TAX', 'TRANSACTION_PRICE_TOTAL', 'TRANSACTION_CASHIER_ID'
    ];
    protected $primaryKey = 'TRANSACTION_DETAIL_ID';
    public $timestamps = false;
}

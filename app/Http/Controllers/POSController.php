<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Hash, Auth, Mail, DB, PDF;
use App\User, App\Profile, App\Menu, App\Transaction, App\TransactionDetail, App\Table, App\TransactionTemp;

class POSController extends Controller
{
    public function index($type, $id='')
    {                        
        $data['food_breakfast'] = Menu::select('*')->where('KIND_MENU_ID',1)->orderby('MENU_ID','DESC')->get();
        $data['food_lunch'] = Menu::select('*')->where('KIND_MENU_ID',2)->orderby('MENU_ID','DESC')->get();
        $data['drink'] = Menu::select('*')->where('KIND_MENU_ID',3)->orderby('MENU_ID','DESC')->get();
        $data['snack'] = Menu::select('*')->where('KIND_MENU_ID',4)->orderby('MENU_ID','DESC')->get();
        $data['table_master'] = Table::select('*')->orderby('TABLE_NO','ASC')->get();
        $data['TRANSACTION_NUMBER'] = date('YmdHis').intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9));
        // $data['TRANSACTION_NUMBER'] = '99999999';

        return view('admin/layouts/pos/posindex', $data);        
    }

    public function getDetailTransaction()
    {
        $TRANSACTION_NUMBER = Input::get('TRANSACTION_NUMBER');
        $data = TransactionTemp::select('*')
                                ->leftjoin('tm_menu','tm_menu.MENU_ID','=','tx_transaction_temp.TRANSACTION_TEMP_ID_MENU')
                                ->where('tx_transaction_temp.TRANSACTION_TEMP_TRANSACTION_NUMBER',$TRANSACTION_NUMBER)
                                ->get();
        return $data;
    }

    public function updateamounttemp()
    {
        $TRANSACTION_TEMP_ID = Input::get('TRANSACTION_TEMP_ID');
        $TRANSACTION_TEMP_AMOUNT = Input::get('TRANSACTION_TEMP_AMOUNT');

        $save = TransactionTemp::where('TRANSACTION_TEMP_ID', $TRANSACTION_TEMP_ID)
                    ->update([
                        'TRANSACTION_TEMP_AMOUNT' => $TRANSACTION_TEMP_AMOUNT
                ]);

        if ($save) {
            return 'success';
        }else{
            return 'failed';
        }
    }

    public function addmenus()
    {
        $TRANSACTION_TEMP_ID_MENU = Input::get('TRANSACTION_TEMP_ID_MENU');
        $TRANSACTION_TEMP_TRANSACTION_NUMBER = Input::get('TRANSACTION_TEMP_TRANSACTION_NUMBER');

        $check_menu_exist = TransactionTemp::where('TRANSACTION_TEMP_ID_MENU',$TRANSACTION_TEMP_ID_MENU)->where('TRANSACTION_TEMP_TRANSACTION_NUMBER',$TRANSACTION_TEMP_TRANSACTION_NUMBER)->count();

        if ($check_menu_exist > 0) {
            $get_amoutnow = TransactionTemp::where('TRANSACTION_TEMP_ID_MENU',$TRANSACTION_TEMP_ID_MENU)->where('TRANSACTION_TEMP_TRANSACTION_NUMBER',$TRANSACTION_TEMP_TRANSACTION_NUMBER)->value('TRANSACTION_TEMP_AMOUNT');
            $save = TransactionTemp::where('TRANSACTION_TEMP_TRANSACTION_NUMBER', $TRANSACTION_TEMP_TRANSACTION_NUMBER)
                    ->where('TRANSACTION_TEMP_ID_MENU', $TRANSACTION_TEMP_ID_MENU)
                    ->update([
                        'TRANSACTION_TEMP_AMOUNT' => $get_amoutnow + 1,
                ]);
        }else{
            $save = TransactionTemp::create([
                        'TRANSACTION_TEMP_TRANSACTION_NUMBER' => Input::get('TRANSACTION_TEMP_TRANSACTION_NUMBER'),
                        'TRANSACTION_TEMP_ID_MENU' => Input::get('TRANSACTION_TEMP_ID_MENU'),
                        'TRANSACTION_TEMP_AMOUNT' => 1,
                    ]);
        }

        if ($save) {
            return 'success';
        }else{
            return 'failed';
        }
    }

    public function deletedetailtemp()
    {
        $TRANSACTION_TEMP_ID = Input::get('TRANSACTION_TEMP_ID');
        $delete = TransactionTemp::where('TRANSACTION_TEMP_ID', $TRANSACTION_TEMP_ID)->delete();
        if ($delete) {
            return 'success';
        }else{
            return 'failed';
        }   
    }

    public function save()
    {
        $data = new Transaction;

        $data->TRANSACTION_CUSTOMER_NAME = Input::get('TRANSACTION_CUSTOMER_NAME');
        $data->TRANSACTION_NUMBER = Input::get('TRANSACTION_NUMBER');
        $data->TRANSACTION_TABLE_ID = Input::get('TRANSACTION_TABLE_ID');
        $data->TRANSACTION_CASHIER_ID = Auth::user()->USER_ID;
        $data->TRANSACTION_NOTE = Input::get('TRANSACTION_NOTE');

        $id_transaction = 0;
        if($data->save()) {
            $id_transaction = $data->TRANSACTION_ID;
        }

        $select_temp_tx = TransactionTemp::select('*')
                            ->leftjoin('tm_menu','tm_menu.MENU_ID','=','tx_transaction_temp.TRANSACTION_TEMP_ID_MENU')
                            ->where('TRANSACTION_TEMP_TRANSACTION_NUMBER',Input::get('TRANSACTION_NUMBER'))
                            ->get();

        $price_tx = 0;
        foreach ($select_temp_tx as $loops) {
            $save = TransactionDetail::create([                    
                        'TRANSACTION_MENU_ID' => $loops->TRANSACTION_TEMP_ID_MENU,
                        'TRANSACTION_MENU_AMOUNT' => $loops->TRANSACTION_TEMP_AMOUNT,
                        'TRANSACTION_ID' => $id_transaction
                    ]);

            $price_per_menu = $loops->PRICE * $loops->TRANSACTION_TEMP_AMOUNT;
            $price_tx = $price_per_menu + $price_tx;
        }

        $tax_tx = 0.1 * $price_tx;
        $price_total = $price_tx + $tax_tx;

        // update price and many more
        $save = Transaction::where('TRANSACTION_ID', $id_transaction)
                    ->update([
                        'TRANSACTION_PRICE' => $price_tx,
                        'TRANSACTION_TAX' => $tax_tx,
                        'TRANSACTION_PRICE_TOTAL' => $price_total
                ]);

        // delete temp data
        $delete = TransactionTemp::where('TRANSACTION_TEMP_TRANSACTION_NUMBER', Input::get('TRANSACTION_NUMBER'))->delete();

        return 'MSG#OK#Insert POS Data Success.#'.$id_transaction;
    }

    public function pos_form_print($id)
    {
        $posdata['header'] = Transaction::select('*',DB::raw('DATE_FORMAT(tx_transaction.CREATED_AT, "%d-%m-%Y %H:%i:%s") as date_transaction'))
                            ->leftjoin('tm_users', 'tm_users.USER_ID', '=', 'tx_transaction.TRANSACTION_CASHIER_ID')
                            ->leftjoin('tr_table', 'tr_table.TABLE_ID', '=', 'tx_transaction.TRANSACTION_TABLE_ID')          
                            ->leftjoin('tm_profile', 'tm_users.PROFILE_ID','=','tm_profile.PROFILE_ID')
                            ->where('tx_transaction.TRANSACTION_ID',$id)
                            ->first();
                        
        $posdata['detail'] = TransactionDetail::select('*')
                                ->leftjoin('tm_menu','tm_menu.MENU_ID','=','tx_transaction_detail.TRANSACTION_MENU_ID')
                                ->where('tx_transaction_detail.TRANSACTION_ID',$id)->get();

                                // dd($posdata);
        
        $pdf = PDF::loadView('admin/layouts/pos/pos_print', compact('posdata'));
        return $pdf->stream();    
    }

    public function list()
    {
        return view('admin/layouts/pos/poslist');  
    }

    public function datapos()
    {
        DB::statement(DB::raw('set @numrow:=0'));
        $data = Transaction::select('*',DB::raw('(@numrow:=@numrow + 1) AS row_number'), DB::raw('DATE_FORMAT(tx_transaction.CREATED_AT, "%d-%m-%Y %H:%i:%s") as date_transaction'))
                ->leftjoin('tm_users', 'tm_users.USER_ID', '=', 'tx_transaction.TRANSACTION_CASHIER_ID')
                ->leftjoin('tr_table', 'tr_table.TABLE_ID', '=', 'tx_transaction.TRANSACTION_TABLE_ID')          
                ->leftjoin('tm_profile', 'tm_users.PROFILE_ID','=','tm_profile.PROFILE_ID')                            
                ->get();

        return json_encode($data);
    }

    public function DetailPOS()
    {
        $TRANSACTION_ID = Input::get('TRANSACTION_ID');
        $posdata['header'] = Transaction::select('*',DB::raw('DATE_FORMAT(tx_transaction.CREATED_AT, "%d-%m-%Y %H:%i:%s") as date_transaction'))
                        ->leftjoin('tm_users', 'tm_users.USER_ID', '=', 'tx_transaction.TRANSACTION_CASHIER_ID')
                        ->leftjoin('tr_table', 'tr_table.TABLE_ID', '=', 'tx_transaction.TRANSACTION_TABLE_ID')          
                        ->leftjoin('tm_profile', 'tm_users.PROFILE_ID','=','tm_profile.PROFILE_ID')
                        ->where('tx_transaction.TRANSACTION_ID',$TRANSACTION_ID)
                        ->first();
                    
        $posdata['detail'] = TransactionDetail::select('*')
                            ->leftjoin('tm_menu','tm_menu.MENU_ID','=','tx_transaction_detail.TRANSACTION_MENU_ID')
                            ->where('tx_transaction_detail.TRANSACTION_ID',$TRANSACTION_ID)->get();

        return $posdata;

    }

}

<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request, DB, Auth;
use Illuminate\Support\Facades\Input;
use App\User, App\Profile, App\Country, App\State, App\City, App\District, App\SubDistrict;

class ReferenceController extends Controller
{
    public function address()
    {
    	$type = Input::get('type');
    	$id = Input::get('id');

    	if($type == 'city')
    		$data = City::where('STATE_ID', $id)->get();
    	if($type == 'district')
    		$data = District::where('CITY_ID', $id)->get();
    	if($type == 'subdistrict')
    		$data = SubDistrict::where('DISTRICT_ID', $id)->get();

    	return $data;
    }

    public function checkemailifexist()
    {
        $email = Input::get('email');
        $data = User::where(['USER_EMAIL'=>$email])->count();

        return $data;
    }

    public function checkCashierCodeifexist()
    {
        $cashier_code = Input::get('cashier');
        $data = Profile::where(['PROFILE_KODE_CASHIER'=>$cashier_code])->count();

        return $data;
    }

    public function insertlog($tipe,$id)
    {
    	if ($tipe == 'ca') {
    		$keterangan = 'download_ca';
    	}else{
    		$keterangan = $tipe;
    	}

    	$save = DB::table('TL_LOGS')->insert(
                    [
                        'USER_ID' => Auth::user()->USER_ID,
                        'REQUEST_METHOD' => 'POST',
                        'LOG_URL' => $keterangan,
                        'REQUEST_PAYLOAD' => $id,
                        'CLIENT_IP_ADDRESS' => Request::ip(),
                    ]
                );

    	if ($save) {
    		return 'success';
    	}else{
    		return 'gagal';
    	}
    }
}

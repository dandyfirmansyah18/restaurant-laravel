<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Hash, Auth, Mail, DB;
use App\User, App\Profile, App\Country, App\State, App\City, App\District, App\SubDistrict, App\HistoryPass;

class ManagementUserController extends Controller
{
    public function userlist($type, $id='')
    {
        $ajax = Input::get('ajax');
        if(!$ajax)
        {
            if($type == 'admin')
            {
                if (Auth::user()->USER_ROLE_ID != 3) {
                    return redirect('/dashboard');
                }
                
                $role_id = 3 . '|' . date('YmdHis');
                $data['role_id'] = encrypt($role_id);
                return view('admin/layouts/users/admin', $data);
            }
            elseif($type == 'manager')
            {
                $role_id = 1 . '|' . date('YmdHis');
                $data['role_id'] = encrypt($role_id);
                return view('admin/layouts/users/manager', $data);
            }
            elseif($type == 'cashier')
            {
                $role_id = 2 . '|' . date('YmdHis');
                $data['role_id'] = encrypt($role_id);
                $data['STATE'] = State::all();
                return view('admin/layouts/users/cashier', $data);
            }
        }
        else
        {
            if($type == 'admin')
            {
                $data = User::where(['USER_ROLE_ID' => 3])->orderBy('USER_ID', 'DESC')->get();
            }
            elseif($type == 'manager')
            {
                $data = User::where(['USER_ROLE_ID' => 1])->orderBy('USER_ID', 'DESC')->get();
            }
            elseif($type == 'cashier')
            {
                $data = Profile::orderBy('PROFILE_ID', 'DESC')->get();
            }
            else
            {
                $data = User::leftjoin('TR_ROLE', 'TR_ROLE.ROLE_ID', '=', 'TM_USERS.USER_ROLE_ID')->where('PROFILE_ID', $id)->select('*', 'TR_ROLE.ROLE_NAME')->orderBy('PROFILE_ID', 'DESC')->get();
            }

            return json_encode($data);
        }

    }

    public function save()
    {
        $save = false;
        $act = Input::get('act');

        if($act == 'create')
        {
            $name = Input::get('name');
            $email = Input::get('email');
            $password = Input::get('password');
            $role_id = explode('|', decrypt(Input::get('role_id')))[0];
            $role_allowed = [1,2,3,21];

            if(!in_array($role_id, $role_allowed))
                return 'MSG#ERR#Simpan data gagal. User Role tidak diketahui.';
            
            if($role_id != 2)
            {
                $save = User::create([
                    'USER_EMAIL' => $email,
                    'USER_PASSWORD' => Hash::make($password),
                    'USER_NAME' => $name,
                    'USER_ROLE_ID' => $role_id
                ]);
            }
            else
            {
                $type_user = Input::get('type_user');

                if($type_user == 'new_user')
                {
                    $save_profile = Profile::create([
                        "PROFILE_KODE_CASHIER" => Input::get('cashier_code'),                        
                        "PROFILE_CASHIER_NAME" => Input::get('cashier_name'),                        
                        "PROFILE_ADDRESS" => Input::get('address'),
                        "PROFILE_STATE" => Input::get('state'),
                        "PROFILE_CITY" => Input::get('city'),
                        "PROFILE_DISTRICT" => Input::get('district'),
                        "PROFILE_SUB_DISTRICT" => Input::get('sub_district'),
                        "PROFILE_POST_CODE" => Input::get('post_code'),                        
                        "PROFILE_EMAIL" => Input::get('company_email'),
                        "PROFILE_PHONE" => Input::get('phone'),                        
                        "CREATED_BY" => Auth::user()->USER_ID,
                    ]);

                    if($save_profile->id)
                    {
                        $save = User::create([
                            'USER_EMAIL' => $email,
                            'USER_PASSWORD' => Hash::make($password),
                            'USER_NAME' => $name,
                            'USER_ROLE_ID' => $role_id,
                            'PROFILE_ID' => $save_profile->id,
                        ]);

                        Mail::send('email.registercashier', ['email' => $email, 'password' => $password], function($mail) use ($email) {
                            $mail->from('no-reply@samsrestaurant.com', 'Samsul\'s Restaurant');
                            $mail->to($email)
                                ->subject('Registrasi Sams Restaurant');
                        });
                    }
                }
                else
                {
                    $save = User::create([
                            'USER_EMAIL' => $email,
                            'USER_PASSWORD' => Hash::make($password),
                            'USER_NAME' => $name,
                            'USER_ROLE_ID' => $role_id,
                            'PROFILE_ID' => Input::get('profile_id'),
                        ]);

                        Mail::send('email.registercashier', ['email' => $email, 'password' => $password], function($mail) use ($email) {
                            $mail->from('no-reply@samsrestaurant.com', 'Samsul\'s Restaurant');
                            $mail->to($email)
                                ->subject('Registrasi Sams Restaurant');
                        });
                }
            }
        }
        else
        {
            $type = Input::get('type');

            if($type == 'user')
            {
                $id = Input::get('user_id');
                $name = Input::get('name');
                $email = Input::get('email');

                $save = User::where('USER_ID', $id)
                    ->update([
                    'USER_EMAIL' => $email,
                    'USER_NAME' => $name,
                ]);
            }
            elseif($type == 'password')
            {
                $id = Input::get('user_id');
                $password = Input::get('password');
                
                $save = User::where('USER_ID', $id)
                    ->update([
                    'USER_PASSWORD' => Hash::make($password),
                ]);
            }
            else
            {
                $id = Input::get('profile_id');

                $save = Profile::where('PROFILE_ID', $id)->update([
                    "PROFILE_KODE_CASHIER" => Input::get('cashier_code'),
                    "PROFILE_CASHIER_NAME" => Input::get('cashier_name'),                    
                    "PROFILE_ADDRESS" => Input::get('address'),
                    "PROFILE_STATE" => Input::get('state'),
                    "PROFILE_CITY" => Input::get('city'),
                    "PROFILE_DISTRICT" => Input::get('district'),
                    "PROFILE_SUB_DISTRICT" => Input::get('sub_district'),
                    "PROFILE_POST_CODE" => Input::get('post_code'),                    
                    "PROFILE_EMAIL" => Input::get('company_email'),
                    "PROFILE_PHONE" => Input::get('phone'),
                    "UPDATED_BY" => Auth::user()->USER_ID,
                ]);
            }
        }

        if($save)
            return 'MSG#OK#Simpan data berhasil.';
        else
            return 'MSG#ERR#Simpan data gagal.';

    }

    public function view()
    {
        $id = Input::get('id');
        $type = Input::get('type');
        
        if($type != 2)
        {
            $data['ROLE'] = encrypt($type . '|' . date('YmdHis'));
            $data['USER'] = User::where('USER_ID', $id)->first();
        }
        else
        {
            $data['ROLE'] = encrypt($type . '|' . date('YmdHis'));
            $data['PROFILE'] = Profile::where('PROFILE_ID', $id)->first();
            $data['USERS'] = User::where('PROFILE_ID', $id)->get();
            $data['STATE'] = State::all();
            $data['CITY'] = City::where('STATE_ID', $data['PROFILE']->PROFILE_STATE)->get();
            $data['DISTRICT'] = District::where('CITY_ID', $data['PROFILE']->PROFILE_CITY)->get();
            $data['SUB_DISTRICT'] = SubDistrict::where('DISTRICT_ID', $data['PROFILE']->PROFILE_DISTRICT)->get();
        }

        return view('admin/layouts/users/formuser', $data);
    }

    public function viewusercashier()
    {
        $id = Input::get('id');
        $data['USER'] = User::where('USER_ID', $id)->first();
        
        return view('admin/layouts/users/formuser_cashier', $data);
    }

    public function delete($id='')
    {
        $delete = false;
        if(!$id)
            $id = Input::get('user_id');

        $user = User::where('USER_ID', $id)->first();

        $delete = User::where('USER_ID', $id)->delete();

        if($delete)
            return 'MSG#OK#Hapus user berhasil.#';
        else
            return 'MSG#ERR#Hapus user gagal.';
    }

    public function activate($id="")
    {        
        if(!$id)
            $id = Input::get('user_id');
        
        $status = Input::get('status');
        
        if($status == 1)
            $msg = 'Aktivasi';
        else
            $msg = 'Non Aktivasi';
            
        $activate = User::where('USER_ID', $id)->update(['USER_STATUS_ID'=>$status]);

        if($activate)
            return 'MSG#OK#'.$msg.' user berhasil.#';
        else
            return 'MSG#ERR#'.$msg.' user gagal.';
    }

    public function profile()
    {
        $data['USER'] = User::where('USER_ID', Auth::user()->USER_ID)->first();
        
        $data['PROFILE'] = NULL;
        if($data['USER']->PROFILE_ID)
        {
            $data['PROFILE'] = Profile::where('PROFILE_ID', $data['USER']->PROFILE_ID)->first();
            $data['STATE'] = State::all();
            $data['CITY'] = City::where('STATE_ID', $data['PROFILE']->PROFILE_STATE)->get();
            $data['DISTRICT'] = District::where('CITY_ID', $data['PROFILE']->PROFILE_CITY)->get();
            $data['SUB_DISTRICT'] = SubDistrict::where('DISTRICT_ID', $data['PROFILE']->PROFILE_DISTRICT)->get();
        }

        return view('admin.layouts.users.profile', $data);
    }

    public function changepassword()
    {
        $save = false;
        $id = Input::get('user_id');
        $old_password = Input::get('old_password');
        $password = Input::get('password');

        $user = User::where('USER_ID', $id)->first();

        if(!Hash::check($old_password, $user->USER_PASSWORD)) {
            return 'MSG#ERR#Simpan data gagal. Password lama Anda tidak sesuai';
        }
        else
        {
            $save = User::where('USER_ID', $id)
                ->update(['USER_PASSWORD' => Hash::make($password)]);
        }

        if($save)
            return 'MSG#OK#Simpan data berhasil.';
        else
            return 'MSG#ERR#Simpan data gagal.';
    }

    public function emitenstaff($type)
    {
        if($type == 'list')
        {
            $id = Input::get('id');
            $ajax = Input::get('ajax');
            if(!$ajax)
            {
                return view('admin/layouts/users/emitenstaff');
            }
            else
            {
                $data = User::where(['PROFILE_ID'=>$id, 'USER_ROLE_ID'=>'21'])->get();
                return json_encode($data);
            }
        }
        elseif($type == 'save')
        {
            $act = Input::get('act');
            if($act == 'create')
            {
                $name = Input::get('name');
                $email = Input::get('email');
                $password = Input::get('password');
                $role_id = '21';
                $profile_id = Auth::user()->PROFILE_ID;
                
                $save = User::create([
                    'PROFILE_ID' => $profile_id,
                    'USER_EMAIL' => $email,
                    'USER_PASSWORD' => Hash::make($password),
                    'USER_NAME' => $name,
                    'USER_ROLE_ID' => $role_id
                ]);

                Mail::send('email.registeremiten', ['email' => $email, 'password' => $password], function($mail) use ($email) {
                            $mail->from('no-reply@baeportal.com', 'BAE Portal');
                            $mail->to($email)
                                ->subject('Registrasi BAE Portal');
                        });
            }
            else
            {
                $type = Input::get('type');

                if($type == 'user')
                {
                    $id = Input::get('user_id');
                    $name = Input::get('name');
                    $email = Input::get('email');

                    $save = User::where('USER_ID', $id)
                        ->update([
                        'USER_EMAIL' => $email,
                        'USER_NAME' => $name,
                    ]);
                }
                elseif($type == 'password')
                {
                    $id = Input::get('user_id');
                    $password = Input::get('password');
                    
                    $save = User::where('USER_ID', $id)
                        ->update([
                        'USER_PASSWORD' => Hash::make($password),
                    ]);
                }
            }

            if($save)
                return 'MSG#OK#Simpan data berhasil.';
            else
                return 'MSG#ERR#Simpan data gagal.';
        }
        elseif($type == 'view')
        {
            $id = Input::get('id');
            $type = Input::get('type');
            
            $data['USER'] = User::where('USER_ID', $id)->first();

            return view('admin/layouts/users/formuser_emiten', $data);
        }
        elseif($type == 'delete')
        {
            $id = Input::get('user_id');
            $this->delete($id);
        }
        elseif($type == 'activate')
        {
            $id = Input::get('user_id');
            $this->activate($id);
        }
    }

    public function password_file($type)
    {
        if($type == 'draft')
        {
            $data['password'] = Profile::where('PROFILE_ID', Auth::user()->PROFILE_ID)->value('PROFILE_PASSWORD');
            return view('admin/layouts/users/password_file', $data);
        }
        elseif($type == 'save') 
        {
            // get date last update password

            $datelast = HistoryPass::where('HISTORY_PASS_PROFILE_ID',Auth::user()->PROFILE_ID)->orderby('CREATED_AT','DESC')->first();
            $valuedatelast = $datelast->CREATED_AT;
            $valuedatelast = date('Y-m-d',strtotime($valuedatelast));

            if (date('Y-m-d') == $valuedatelast) {
                return 'MSG#ERR#Simpan Data Gagal, Anda sudah mengubah password hari ini.';   
            }

            $password = Input::get('password') . '|' . date('YmdHis');
            $password = encrypt($password);

            $save = Profile::where('PROFILE_ID', Auth::user()->PROFILE_ID)->update(['PROFILE_PASSWORD'=>$password]);

            // insert to history
            $history = HistoryPass::create([
                    'HISTORY_PASS_CONTENT' => $password,
                    'HISTORY_PASS_PROFILE_ID' => Auth::user()->PROFILE_ID,                    
                ]);

            if($save && $history)
                return 'MSG#OK#Simpan data berhasil.';
            else
                return 'MSG#ERR#Simpan data gagal.';

        }elseif ($type == 'history') {
            DB::statement(DB::raw('set @numrow:=0'));            
            $data = HistoryPass::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_HISTORY_PASSWORD.*',
                                DB::raw('DATE_FORMAT(CREATED_AT,"%d-%m-%Y") as Tanggal'))
                            ->where('HISTORY_PASS_PROFILE_ID',Auth::user()->PROFILE_ID)->orderby('CREATED_AT','DESC')->get();
            
            $datareal = array(); 
            if (count($data) > 0) {
                foreach ($data as $datas) {
                    $datareal[] = array(
                                        'row_number' => $datas->row_number,
                                        'HISTORY_PASS_CONTENT' => explode('|', decrypt($datas->HISTORY_PASS_CONTENT))[0],
                                        'HISTORY_PASS_DATE' => $datas->Tanggal,
                                        'HISTORY_PASS_ID' => $datas->HISTORY_PASS_ID,
                                    );                    
                }
            }   

            return json_encode($datareal);      
        }
    }

    public function delete_cashier_profile()
    {
        $id = Input::get('id');
        
        DB::table('TM_USERS')->where('PROFILE_ID', $id)->delete();
        $delete = DB::table('TM_PROFILE')->where('PROFILE_ID', $id)->delete();

        if($delete)
            return 'MSG#OK#Simpan data berhasil.';
        else
            return 'MSG#ERR#Simpan data gagal.';
    }
}

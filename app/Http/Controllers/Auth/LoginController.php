<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth, Hash, Redirect, Session, Mail, Log, Request, DB;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = route('dashboard');
    }

    function log_login($userid)
    {

        $save = DB::table('TL_LOGS')->insert(
                    [
                        'USER_ID' => $userid,
                        'REQUEST_METHOD' => 'POST',
                        'LOG_URL' => 'post_login',
                        'CLIENT_IP_ADDRESS' => Request::ip(),
                    ]
                );
    }

    public function login()
    {
        return view('admin/login');
    }

    public function postLogin()
    {
        $email = Input::get('email');
        $password = Input::get('password');
        $credentials = array('USER_EMAIL' => $email, 'password' => $password);

        $cek_email = User::where('USER_EMAIL', '=', $email)->first();
        if(!$cek_email)
        {
            return 'MSG#ERR#Login gagal. Email tidak terdaftar.';
        }
        else
        {
            $user_status = User::where('USER_EMAIL', $email)->value('USER_STATUS_ID');
            if($user_status == 0)
            {
                return 'MSG#ERR#Login gagal. Akun anda belum aktif atau telah dinonaktifkan. Silahkan hubungi Admin.';
            }
            else
            {
                $check_login_status = User::where('USER_EMAIL', $email)->value('USER_LOGIN_STATUS');
                if ($check_login_status == 1) {
                    return 'MSG#ERR#Login gagal. Akun anda sedang digunakan.';
                }else{                    
                    if(Auth::attempt($credentials))
                    {
                        User::where('USER_EMAIL', '=', $email)->update([
                                'SESSION_ID' => Session::getId(),
                                'USER_LAST_LOGIN' => date('Y-m-d h:i:s'),
                                'USER_LOGIN_STATUS' => 1,
                                ]);

                        // insert log login
                        $this->log_login(Auth::user()->USER_ID);
                        
                        return 'MSG#OK#';
                    }
                    else
                    {
                        return 'MSG#ERR#Login gagal. Password Anda salah.';
                    }
                }
            }
        }
    }

    public function forgotpassword()
    {
        $email = Input::get('email');
        $user = User::where('USER_EMAIL', $email)->first();

        if(!$user)
        {
            return 'MSG#ERR#Maaf email Anda tidak terdaftar.';
        }
        else
        {

            $password_reset_code = str_random(30);

            $now = date_create(date('Y-m-d H:i:s'));
            $exp_date = $now->modify('+1 day');
            $password_reset_exp = $exp_date->format('Y-m-d H:i:s');

            Mail::send('email.resetpassword', ['password_reset_code' => $password_reset_code, 'email' => $email], function($mail) use ($email) {
                $mail->from('no-reply@baeportal.com', 'BAE Portal');
                $mail->to($email)
                    ->subject('Password Reset');
            });

            $user->PASSWORD_RESET_CODE = $password_reset_code;
            $user->PASSWORD_RESET_EXPIRED = $password_reset_exp;
            $user->save();

            // return 'MSG#ERR#Reset Password Failed. Please try again.';
            return 'MSG#OK#Password recovery instruction has been sent to your email.';
        }
    }

    public function resetpassword(){
        $verifier = Input::get('verifier');

        if(!$verifier)
        {
            Session::flash('ERR', 'Sorry, the page you are looking for could not be found.');
            return Redirect::to('/error404');
        }


        $user = User::where('PASSWORD_RESET_CODE', $verifier)->whereRaw('PASSWORD_RESET_EXPIRED > NOW()')->first();

        if (!$user)
        {
            Session::flash('ERR', 'Your password reset link has expired.');
            return Redirect::to('/login');
        }

        $email = $user->USER_EMAIL;
        $new_password = str_random(8);

        $user->USER_PASSWORD = Hash::make($new_password);
        $user->PASSWORD_RESET_CODE = null;
        $user->save();
        
        Mail::send('email.newpassword', ['new_password' => $new_password, 'email' => $email], function($mail) use ($email){
            $mail->from('no-reply@baeportal.com', 'BAE Portal');
            $mail->to($email)
                ->subject('Password Baru Anda');
        });

        Session::flash('OK', 'Password anda telah direset. Password baru telah dikirimkan ke email anda.');
        return Redirect::to('/login');
    }

    public function logout()
    {
        if(Auth::user())
        {
            User::where('USER_ID', '=', Auth::user()->USER_ID)->update(['USER_LOGIN_STATUS' => 0]);
            Auth::logout();
            return Redirect::to('login');
        }
        else
        {
            return Redirect::to('login');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Mail;
use Response;
use Illuminate\Support\Facades\Input;
use App\ContactUs;
use Storage, Auth;

class ContactUsController extends Controller
{        
    public function contactuslist()
    {    	
    	return view('admin.layouts.contactus.contactuslist');
    }

    public function contactusdata()
    {
    	DB::statement(DB::raw('set @numrow:=0'));
    	$data = ContactUs::select(DB::raw('(@numrow:=@numrow + 1) AS row_number, CONCAT(SUBSTRING(TX_CONTACT_US.CONTACT_US_TEXT,1,100), "...") AS CONTACT_US_TEXT2'),'TX_CONTACT_US.*')
                            ->orderby('CONTACT_US_ID','DESC')
                            ->get();
    	return json_encode($data);
    }

    public function view()
    {
        $id = Input::get('contactus_id');

        ContactUS::where('CONTACT_US_ID', $id)->update(['CONTACT_US_READ'=>'1']);
        $contactus = ContactUS::where('CONTACT_US_ID', $id)->first();
        $data['CONTACT_US'] = $contactus;

        return view('admin/layouts/contactus/formcontactus', $data);
    }

    public function delete()
    {
        $id = Input::get('regulation_id');
        $dokexist = Regulation::where(['REGULATION_ID'=>$id])->value('REGULATION_FILE_PATH');
        if ($dokexist) {
            @unlink(storage_path().'/app/'.$dokexist);
        }
        
        $delete = Regulation::where('REGULATION_ID', $id)->delete();

        if($delete)
            return 'MSG#OK#Hapus Regulation berhasil.#';
        else
            return 'MSG#ERR#Hapus Regulation gagal.';
    }

    public function reply()
    {
        $id = Input::get('CONTACT_US_ID');
        $msg_reply = Input::get('CONTACT_US_REPLY');

        $data = ContactUs::where('CONTACT_US_ID', $id)->first();
        $email = $data->CONTACT_US_EMAIL;
        $msg_inbox = '<p>'.$data->CONTACT_US_NAME.'<br>
                        '.$email.'<br><br>
                    </p>
                    <p>'.$data->CONTACT_US_TEXT.'</p>';

        Mail::send('email.contactus_reply', ['msg_inbox'=>$msg_inbox, 'msg_reply' => $msg_reply], function($mail) use ($email) {
                $mail->from('no-reply@baeportal.com', 'BAE Portal');
                $mail->to($email)
                    ->subject('BAE Portal Information');
            });

        return 'MSG#OK#Pesan berhasil terkirim.#';
    }

}

<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use App\Report, App\Profile, App\User, App\ReportType, App\CorporateAction, App\Regulation;
use Storage;
use Carbon\Carbon;
use Auth, Session, Mail, Zipper, File, Request;


class ReportController extends Controller
{

    function log_download($idreport,$keterangan)
    {
        // dd($idreport);
        $save = DB::table('TL_LOGS')->insert(
                    [
                        'USER_ID' => Auth::user()->USER_ID,
                        'REQUEST_METHOD' => 'POST',
                        'LOG_URL' => $keterangan,
                        'REQUEST_PAYLOAD' => $idreport,
                        'CLIENT_IP_ADDRESS' => Request::ip(),
                    ]
                );
    }

    public function reportlist($periode='')
    {       
        $drop_type = ReportType::get();
        $drop_profile = Profile::select('PROFILE_ID','PROFILE_NPWP','PROFILE_COMPANY_NAME')->get();
        $data['drop_type'] = $drop_type;
        $data['drop_profile'] = $drop_profile;
        if ($periode) {
            $data['periode'] = $periode;
        }else{
            $data['periode'] = '';
        }
        return view('admin.layouts.report.reportlist',$data);
    }

    public function reportdata($periode='')
    {
        DB::statement(DB::raw('set @numrow:=0'));
        if ($periode) {            
            $date1 = substr($periode, 0,10);
            $date2 = substr($periode, 13,10);
            
            $date1 = date("Y-m-d", strtotime($date1));
            $date2 = date("Y-m-d", strtotime($date2));
            
            if (Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21) {                
                $data = Report::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_REPORT.*',DB::raw('DATE_FORMAT(TX_REPORT.REPORT_DATE,"%d-%m-%Y") as REPORT_DATE_FORMAT'),'TM_PROFILE.PROFILE_NPWP','TM_PROFILE.PROFILE_COMPANY_NAME',
                                        'TR_REPORT_TYPE.REPORT_TYPE_NAME')
                                    ->whereBetween('TX_REPORT.REPORT_DATE', [$date1, $date2])
                                    ->leftjoin('TM_PROFILE','TM_PROFILE.PROFILE_ID','=','TX_REPORT.PROFILE_ID')
                                    ->leftjoin('TR_REPORT_TYPE','TR_REPORT_TYPE.REPORT_TYPE_ID','=','TX_REPORT.REPORT_TYPE_ID')
                                    ->orderby('TX_REPORT.REPORT_ID','DESC')
                                    ->get();
            }else{
                $data = Report::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_REPORT.*',DB::raw('DATE_FORMAT(TX_REPORT.REPORT_DATE,"%d-%m-%Y") as REPORT_DATE_FORMAT'),'TM_PROFILE.PROFILE_NPWP','TM_PROFILE.PROFILE_COMPANY_NAME',
                                        'TR_REPORT_TYPE.REPORT_TYPE_NAME')
                                    ->whereBetween('TX_REPORT.REPORT_DATE', [$date1, $date2])
                                    ->where('TX_REPORT.PROFILE_ID',Auth::user()->PROFILE_ID)
                                    ->leftjoin('TM_PROFILE','TM_PROFILE.PROFILE_ID','=','TX_REPORT.PROFILE_ID')
                                    ->leftjoin('TR_REPORT_TYPE','TR_REPORT_TYPE.REPORT_TYPE_ID','=','TX_REPORT.REPORT_TYPE_ID')
                                    ->orderby('TX_REPORT.REPORT_ID','DESC')
                                    ->get();
            }

        }else{
            if (Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21) {
                $data = Report::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_REPORT.*',DB::raw('DATE_FORMAT(TX_REPORT.REPORT_DATE,"%d-%m-%Y") as REPORT_DATE_FORMAT'),'TM_PROFILE.PROFILE_NPWP','TM_PROFILE.PROFILE_COMPANY_NAME',
                                        'TR_REPORT_TYPE.REPORT_TYPE_NAME')
                                    ->leftjoin('TM_PROFILE','TM_PROFILE.PROFILE_ID','=','TX_REPORT.PROFILE_ID')
                                    ->leftjoin('TR_REPORT_TYPE','TR_REPORT_TYPE.REPORT_TYPE_ID','=','TX_REPORT.REPORT_TYPE_ID')
                                    ->orderby('TX_REPORT.REPORT_ID','DESC')
                                    ->get();
            }else{
                $data = Report::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_REPORT.*',DB::raw('DATE_FORMAT(TX_REPORT.REPORT_DATE,"%d-%m-%Y") as REPORT_DATE_FORMAT'),'TM_PROFILE.PROFILE_NPWP','TM_PROFILE.PROFILE_COMPANY_NAME',
                                        'TR_REPORT_TYPE.REPORT_TYPE_NAME')
                                    ->where('TX_REPORT.PROFILE_ID',Auth::user()->PROFILE_ID)
                                    ->leftjoin('TM_PROFILE','TM_PROFILE.PROFILE_ID','=','TX_REPORT.PROFILE_ID')
                                    ->leftjoin('TR_REPORT_TYPE','TR_REPORT_TYPE.REPORT_TYPE_ID','=','TX_REPORT.REPORT_TYPE_ID')
                                    ->orderby('TX_REPORT.REPORT_ID','DESC')
                                    ->get();
            }
        }

        return json_encode($data);
    }

    public function save()
    {               
        $tgljam = date('YmdHis');
        // $npwp = Profile::where('PROFILE_ID',Input::get('PROFILE_ID'))->value('PROFILE_NPWP');
        // $kode_emiten = Profile::where('PROFILE_ID',Input::get('PROFILE_ID'))->value('PROFILE_KODE_EMITEN');
        // $type_report = ReportType::where('REPORT_TYPE_ID',Input::get('REPORT_TYPE_ID'))->value('REPORT_TYPE_NAME');
        // $code_report = ReportType::where('REPORT_TYPE_ID',Input::get('REPORT_TYPE_ID'))->value('REPORT_TYPE_CODE');
        $date = date('Ymd');
        $code = str_random(6);

        if (Input::get('act') == 'insert') {

            // if (Input::get('type_upload') == 1) { // Jika hanya upload satu file
                
            //     $directory = 'Report/'.$kode_emiten.'/'.$type_report.'/'.$date.'/'; 
            //     Storage::makeDirectory($directory, $mode = 0777, true, true);
            //     $path1 = 'Report/'.$kode_emiten.'/'.$type_report.'/'.$date.'/'; 
            //     $path2 = storage_path().'/app/'.$path1;
            //     @unlink($path2);

            //     $get_doc_file = Input::file('REPORT_PATH');
            //     $doc_name = $get_doc_file->getClientOriginalName();
            //     $doc_extension = $get_doc_file->getClientOriginalExtension();
            //     $doc_size =$get_doc_file->getClientSize();

            //     $new_doc_name = $kode_emiten."_".$date."_".$code_report.".".$doc_extension;
            //     $doc_move = $get_doc_file->move($path2, $new_doc_name);

            //     if ($doc_move) {
            //         $client = new \GuzzleHttp\Client([
            //                 'headers' => [ 'Content-Type' => 'application/json' ]
            //             ]);

            //         $res = $client->request('POST', 'http://192.168.5.196/encryptfile.php',  ['body' => json_encode(
            //                                                                                                 [
            //                                                                                                     'type' => 'encrypt',
            //                                                                                                     'path_file' => $path2.$new_doc_name,                        
            //                                                                                                 ]
            //                                                                                             )]);
            //         $apireturn = $res->getBody()->getContents();
            //     }

            //     list($msg,$pathenc) = explode('#', $apireturn);

            //     $path_old = str_replace('/var/www/laravel/storage/app/', '', $pathenc);
            //     $name_file = explode('/', $path_old);
            //     $name_file = end($name_file);
            //     $movefile = Storage::move($path_old,$path1.$name_file);

            //     if ($msg == 'success') {                   
            //         $save = Report::create([
            //             'REPORT_TYPE_ID' => Input::get('REPORT_TYPE_ID'),
            //             'PROFILE_ID' => Input::get('PROFILE_ID'),
            //             'REPORT_DATE' => date("Y-m-d", strtotime(Input::get('REPORT_DATE'))), 
            //             'REPORT_PATH' => $path2.$name_file,                    
            //             'REPORT_FILENAME' => $new_doc_name,
            //             'CREATED_BY' => Auth::user()->USER_ID,
            //             // 'CREATED_AT' => date('Y-m-d H:i:s'),
            //         ]);

            //         $idreport = $save->REPORT_ID;

            //         $this->log_download($idreport,'upload_report');
            //         // delete file report asli
            //         @unlink($path2.$new_doc_name);
            //     }

            // }else{ // Jika upload banyak file

            $get_doc_file_first = Input::file('REPORT_PATH');
            $doc_name_first = $get_doc_file_first->getClientOriginalName();
            $doc_extension_first = $get_doc_file_first->getClientOriginalExtension(); 

            if ($doc_extension_first == 'zip' || $doc_extension_first == 'rar' || $doc_extension_first == '7z') {
                
                $directory_first = 'TempZIP/'.$tgljam.$code.'/';
                $didelete = '/TempZIP/'.$tgljam.$code; 
                Storage::makeDirectory($directory_first, $mode = 0777, true, true);
                $path1_first = 'TempZIP/'.$tgljam.$code.'/'; 
                $path2_first = storage_path().'/app/'.$path1_first;
                @unlink($path2_first);

                $new_doc_name_first = $tgljam."_".$code.".".$doc_extension_first;
                $doc_move = $get_doc_file_first->move($path2_first, $new_doc_name_first);

                if ($doc_move) {
                    Zipper::make(storage_path().'/app/'.$path1_first.$new_doc_name_first)->extractTo(storage_path().'/app/'.$path1_first);
                    Zipper::close();

                    $listFile = File::allFiles($path2_first);

                    foreach ($listFile as $datafile) {
                        if ($datafile->getFilename() == $new_doc_name_first) { // jika list file sama dengan zip asal
                        }else{
                            $ext = pathinfo($datafile->getFilename(), PATHINFO_EXTENSION);
                            $filename = str_replace(".".$ext, "", $datafile->getFilename());
                            list($kode_emiten,$tgldokumen,$code_report) = explode("_", $filename);

                            $type_report = ReportType::where('REPORT_TYPE_CODE',$code_report)->value('REPORT_TYPE_NAME');
                            $directory = 'Report/'.$kode_emiten.'/'.$type_report.'/'.$tgldokumen.'/'; 
                            Storage::makeDirectory($directory, $mode = 0777, true, true);
                            $path1 = 'Report/'.$kode_emiten.'/'.$type_report.'/'.$tgldokumen.'/';  
                            $path2 = storage_path().'/app/'.$path1;
                            @unlink($path2);

                            $client = new \GuzzleHttp\Client([
                                    'headers' => [ 'Content-Type' => 'application/json' ]
                                ]);
                            $res = $client->request('POST', 'http://192.168.5.196/encryptfile.php',  ['body' => json_encode(
                                                                                                        [
                                                                                                            'type' => 'encrypt',
                                                                                                            'path_file' => $path2_first.$datafile->getFilename(),
                                                                                                        ]
                                                                                                    )]);
                            $apireturn = $res->getBody()->getContents();

                            list($msg,$pathenc) = explode('#', $apireturn);
                            $path_old = str_replace('/var/www/laravel/storage/app/', '', $pathenc);
                            $name_file = explode('/', $path_old);
                            $name_file = end($name_file);
                            $movefile = Storage::move($path_old,$path1.$name_file);

                            $REPORT_TYPE_ID = ReportType::where('REPORT_TYPE_CODE',$code_report)->value('REPORT_TYPE_ID');
                            $PROFILE_ID = Profile::where('PROFILE_KODE_EMITEN',$kode_emiten)->value('PROFILE_ID');

                            if ($msg == 'success') {
                                $save = Report::create([
                                    'REPORT_TYPE_ID' => $REPORT_TYPE_ID,
                                    'PROFILE_ID' => $PROFILE_ID,
                                    'REPORT_DATE' => date("Y-m-d", strtotime($tgldokumen)), 
                                    'REPORT_PATH' => $path2.$name_file,
                                    'REPORT_FILENAME' => $datafile->getFilename(),
                                    'CREATED_BY' => Auth::user()->USER_ID,
                                    // 'CREATED_AT' => date('Y-m-d H:i:s'),
                                ]);

                                $idreport = $save->REPORT_ID;
                                $this->log_download($idreport,'upload_report');

                                // delete file report asli
                                @unlink($path2_first.$datafile->getFilename());                                
                            }
                        }
                    }
                }

                // delete directory
                Storage::deleteDirectory($didelete);
                return 'MSG#OK#Simpan Report berhasil.#';

            }else{

                $get_doc_file = Input::file('REPORT_PATH');
                $doc_name = $get_doc_file->getClientOriginalName();
                $doc_extension = $get_doc_file->getClientOriginalExtension();
                $doc_size =$get_doc_file->getClientSize();

                $filename = str_replace(".".$doc_extension, "", $doc_name);
                list($kode_emiten,$tgldokumen,$code_report) = explode("_", $filename);
                $type_report = ReportType::where('REPORT_TYPE_CODE',$code_report)->value('REPORT_TYPE_NAME');
                
                $directory = 'Report/'.$kode_emiten.'/'.$type_report.'/'.$tgldokumen.'/'; 
                Storage::makeDirectory($directory, $mode = 0777, true, true);
                $path1 = 'Report/'.$kode_emiten.'/'.$type_report.'/'.$tgldokumen.'/'; 
                $path2 = storage_path().'/app/'.$path1;
                @unlink($path2);

                $new_doc_name = $kode_emiten."_".$tgldokumen."_".$code_report.".".$doc_extension;
                $doc_move = $get_doc_file->move($path2, $new_doc_name);

                if ($doc_move) {
                    $client = new \GuzzleHttp\Client([
                            'headers' => [ 'Content-Type' => 'application/json' ]
                        ]);

                    $res = $client->request('POST', 'http://192.168.5.196/encryptfile.php',  ['body' => json_encode(
                                                                                                            [
                                                                                                                'type' => 'encrypt',
                                                                                                                'path_file' => $path2.$new_doc_name,                        
                                                                                                            ]
                                                                                                        )]);
                    $apireturn = $res->getBody()->getContents();
                }

                list($msg,$pathenc) = explode('#', $apireturn);

                $path_old = str_replace('/var/www/laravel/storage/app/', '', $pathenc);
                $name_file = explode('/', $path_old);
                $name_file = end($name_file);
                $movefile = Storage::move($path_old,$path1.$name_file);

                $REPORT_TYPE_ID = ReportType::where('REPORT_TYPE_CODE',$code_report)->value('REPORT_TYPE_ID');
                $PROFILE_ID = Profile::where('PROFILE_KODE_EMITEN',$kode_emiten)->value('PROFILE_ID');

                if ($msg == 'success') {                   
                    $save = Report::create([
                        'REPORT_TYPE_ID' => $REPORT_TYPE_ID,
                        'PROFILE_ID' => $PROFILE_ID,
                        'REPORT_DATE' => date("Y-m-d", strtotime($tgldokumen)), 
                        'REPORT_PATH' => $path2.$name_file,                    
                        'REPORT_FILENAME' => $new_doc_name,
                        'CREATED_BY' => Auth::user()->USER_ID,
                        // 'CREATED_AT' => date('Y-m-d H:i:s'),
                    ]);

                    $idreport = $save->REPORT_ID;

                    $this->log_download($idreport,'upload_report');
                    // delete file report asli
                    @unlink($path2.$new_doc_name);
                }
            }

            // }



        }else {

            $id = Input::get('REPORT_ID');
            if (Input::file('REPORT_PATH')) {                

                $directory = 'Report/'.$kode_emiten.'/'.$type_report.'/'.$date.'/';
                Storage::makeDirectory($directory, $mode = 0777, true, true);
                $path1 = 'Report/'.$kode_emiten.'/'.$type_report.'/'.$date.'/';
                $path2 = storage_path().'/app/'.$path1;
                @unlink($path2);

                $get_doc_file = Input::file('REPORT_PATH');
                $doc_name = $get_doc_file->getClientOriginalName();
                $doc_extension = $get_doc_file->getClientOriginalExtension();
                $doc_size =$get_doc_file->getClientSize();

                $new_doc_name = $kode_emiten."_".$date."_".$code_report.".".$doc_extension;
                $doc_move = $get_doc_file->move($path2, $new_doc_name);

                $dokexist = DB::table('TX_REPORT')->where(['REPORT_ID'=>$id])->value('REPORT_PATH');
                if ($dokexist) {
                    @unlink(storage_path().'/app/'.$dokexist);
                }

                if ($doc_move) {                
                    $client = new \GuzzleHttp\Client([
                            'headers' => [ 'Content-Type' => 'application/json' ]
                        ]);

                    $res = $client->request('POST', 'http://192.168.5.196/encryptfile.php',  ['body' => json_encode(
                                                                                                            [
                                                                                                                'type' => 'encrypt',
                                                                                                                'path_file' => $path2.$new_doc_name,                        
                                                                                                            ]
                                                                                                        )]);
                    $apireturn = $res->getBody()->getContents();
                }

                list($msg,$pathenc) = explode('#', $apireturn);                

                $path_old = str_replace('/var/www/laravel/storage/app/', '', $pathenc);
                $name_file = explode('/', $path_old);
                $name_file = end($name_file);
                $movefile = Storage::move($path_old,$path1.$name_file);

                $save = Report::where('REPORT_ID', $id)
                            ->update([
                                'REPORT_TYPE_ID' => Input::get('REPORT_TYPE_ID'),
                                'PROFILE_ID' => Input::get('PROFILE_ID'),
                                'REPORT_DATE' => date("Y-m-d", strtotime(Input::get('REPORT_DATE'))),                 
                                'REPORT_PATH' => $path2.$name_file,
                                'REPORT_FILENAME' => $new_doc_name,
                                'UPDATED_BY' => Auth::user()->USER_ID
                        ]);

                // delete file report
                @unlink($path2.$new_doc_name);

            }else{
                $save = Report::where('REPORT_ID', $id)
                            ->update([
                                'REPORT_TYPE_ID' => Input::get('REPORT_TYPE_ID'),
                                'PROFILE_ID' => Input::get('PROFILE_ID'),
                                'REPORT_DATE' => date("Y-m-d", strtotime(Input::get('REPORT_DATE'))),                                
                                'UPDATED_BY' => Auth::user()->USER_ID
                        ]);                
            }            

        }

        if($save)
            return 'MSG#OK#Simpan Report berhasil.#';
        else
            return 'MSG#ERR#Simpan Report gagal.';
    }

    public function view()
    {
        $id = Input::get('report_id');
        $report = Report::select('TX_REPORT.*',DB::raw('DATE_FORMAT(TX_REPORT.REPORT_DATE,"%d-%m-%Y") as REPORT_DATE_FORMAT'))->where('REPORT_ID', $id)->first();
        $drop_type = ReportType::get();
        $drop_profile = Profile::select('PROFILE_ID','PROFILE_NPWP','PROFILE_COMPANY_NAME')->get();
        $data['drop_type'] = $drop_type;
        $data['drop_profile'] = $drop_profile;
        $data['REPORT'] = $report;

        if ($report->REPORT_PATH) {            
            $name_file = explode('/', $report->REPORT_PATH);
            $name_file = end($name_file);
        }else{
            $name_file = '';
        }
        $data['REPORT']['NAME_FILE'] = $name_file;
        return view('admin/layouts/report/formreport', $data);
    }

    public function delete()
    {
        $id = Input::get('report_id');
        $dokexist = Report::where(['REPORT_ID'=>$id])->value('REPORT_PATH');
        if ($dokexist) {
            @unlink(storage_path().'/app/'.$dokexist);
        }
        
        $delete = Report::where('REPORT_ID', $id)->delete();

        if($delete)
            return 'MSG#OK#Hapus Report berhasil.#';
        else
            return 'MSG#ERR#Hapus Report gagal.';
    }

    public function preview($tipe,$id){
        if ($tipe == 'ca') {
            $dokloc = CorporateAction::where('CA_ID',$id)->value('CA_PATH');
        }elseif ($tipe == 'regulation') {
            $dokloc = Regulation::where('REGULATION_ID',$id)->value('REGULATION_FILE_PATH');
        }elseif ($tipe == 'report') {
            $dokloc = Report::where('REPORT_ID',$id)->value('REGULATION_PATH');
        }

        return response()->file(storage_path().'/app/'.$dokloc);
    }

    public function sendotp($type='')
    {
        if ($type == 'close') {
            $update = User::where('USER_ID', Auth::user()->USER_ID)
                                ->update([
                                    'OTP_CODE' => null,
                                    'OTP_EXPIRED' => null
                            ]); 

            if ($update) {
                return 'success';        
            }else{
                return 'gagal';
            }            
        }else{            
            $code = str_random(6);

            $current = Carbon::now();
            $trialExpires = $current->addMinutes(5);
            $exp_code = $trialExpires->toDateTimeString();        
            
            Mail::send('email.codedownload', ['code' => $code, 'email' => Auth::user()->USER_EMAIL], function($mail) {
                    $mail->from('no-reply@baeportal.com', 'BAE Portal');
                    $mail->to(Auth::user()->USER_EMAIL)
                        ->subject('Code Download Report');
                });

            $update = User::where('USER_ID', Auth::user()->USER_ID)
                                ->update([
                                    'OTP_CODE' => $code,
                                    'OTP_EXPIRED' => $exp_code
                            ]); 

            if ($update) {
                return 'success';        
            }else{
                return 'gagal';
            }
        }
    }

    public function sendcode()
    {        
        $check_exp = User::where('OTP_CODE', Input::get('code'))->whereRaw('OTP_EXPIRED > NOW()')->first();
        if (!$check_exp)
        {      
            $data = array(
                        'type' => 'error',
                        'msg' => 'MSG#ERR#Your Code is Wrong or Your Code Was Expired.'
                    );   

            return $data;
        }
        
        $array_id = explode(',', Input::get('report_id'));                
        if (count($array_id) > 1) {
            $listfile = Report::whereIn('REPORT_ID',$array_id)->get();            

            $tgl = date("Ymd");
            $jam = date("His");
            
            $filebro = '';
            $filedec = [];
            foreach ($listfile as $datas) {

                $client = new \GuzzleHttp\Client([
                        'headers' => [ 'Content-Type' => 'application/json' ]
                    ]);
                $res = $client->request('POST', 'http://192.168.5.196/encryptfile.php',  ['body' => json_encode(
                                                                                                        [
                                                                                                            'type' => 'decrypt',
                                                                                                            'path_file' => $datas->REPORT_PATH,
                                                                                                            'filename' => $datas->REPORT_FILENAME,
                                                                                                        ]
                                                                                                    )]);
                $apireturn = $res->getBody()->getContents();
                list($msg,$pathenc) = explode('#', $apireturn);
                if ($msg == 'success') {                                        
                    $filedec[] = $pathenc;
                    $filebro .= $pathenc.',';
                    // $filebro .= storage_path().'/app/'.$datas->REPORT_PATH.',';

                    // insert log download
                    $this->log_download($datas->REPORT_ID,'download_report');
                }

            }

            $random_text = str_random(10);
            $files=rtrim($filebro,", ");
            $files=explode(",", $files);

            if (Auth::user()->USER_ROLE_ID == 2 || Auth::user()->USER_ROLE_ID == 21) {
                $kode_emiten = Profile::where('PROFILE_ID',Auth::user()->PROFILE_ID)->value('PROFILE_KODE_EMITEN');                
                $namefile = 'LAPORAN_'.$tgl.$jam.'_'.$kode_emiten.'.zip';
            }else{
                $namefile = 'LAPORAN_'.$tgl.$jam.'.zip';
            }
            
            // $create_folder = Zipper::make(storage_path().'/app/TempZIP/'.$namefile)->add($files)->close();
            $client = new \GuzzleHttp\Client([
                    'headers' => [ 'Content-Type' => 'application/json' ]
                ]);
            $res = $client->request('POST', 'http://192.168.5.196/setpasszip2.php',  ['body' => json_encode(
                                                                                                    [
                                                                                                        'namefile'  => $namefile,
                                                                                                        'listfile' => $files,
                                                                                                    ]
                                                                                                )]);
            $apireturn = $res->getBody()->getContents();            
            $namefile = $apireturn;
                        
            foreach ($filedec as $filedecs) {
                @unlink($filedecs);
            }
            
            $data = array(
                        'type' => 'download',
                        'count' => count($array_id),
                        'report_id' => $namefile
                    ); 

            return $data;

        }else{
            $report_id = $array_id[0];

            $data = array(
                        'type' => 'download',
                        'count' => 1,
                        'report_id' => $report_id
                    );

            //insert log
            $this->log_download($report_id,'download_report');

            return $data;
        }
    }

    public function downloadfile($type,$id)
    {
        $explode = explode('-', $type);
        $type = $explode[0];
        $kind = $explode[1];        

        if ($type == 'one') {
            if ($kind == 'report') {
                $get_path = Report::where('REPORT_ID',$id)->value('REPORT_PATH');
                $get_filename = Report::where('REPORT_ID',$id)->value('REPORT_FILENAME');

                $client = new \GuzzleHttp\Client([
                        'headers' => [ 'Content-Type' => 'application/json' ]
                    ]);

                $res = $client->request('POST', 'http://192.168.5.196/encryptfile.php',  ['body' => json_encode(
                                                                                                        [
                                                                                                            'type' => 'decrypt',
                                                                                                            'path_file' => $get_path,
                                                                                                            'filename' => $get_filename,                        
                                                                                                        ]
                                                                                                    )]);
                $apireturn = $res->getBody()->getContents();
                list($msg,$pathenc) = explode('#', $apireturn);
                if ($msg == 'success') {                    
                    $file = $pathenc;
                }
            }
        }else{
            if ($kind == 'report') {                
                $file = storage_path() ."/app/TempZIP/".$id;
            }
            // return response()->download($file)->deleteFileAfterSend(true);
        }

        return response()->download($file)->deleteFileAfterSend(true);
    }    

}

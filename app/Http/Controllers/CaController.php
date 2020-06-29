<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use App\CorporateAction, App\Profile, App\CaType, App\Regulation, App\Report;
use Storage, Auth, Request;

class CaController extends Controller
{
    function log_download($idreport, $keterangan)
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

    public function calist($periode='')
    {       
        $drop_type = CaType::get();
        $drop_profile = Profile::select('PROFILE_ID','PROFILE_NPWP','PROFILE_COMPANY_NAME')->get();
        $data['drop_type'] = $drop_type;
        $data['drop_profile'] = $drop_profile;
        if ($periode) {
            $data['periode'] = $periode;
        }else{
            $data['periode'] = '';
        }

        return view('admin.layouts.ca.calist',$data);
    }

    public function cadata($periode='')
    {
        DB::statement(DB::raw('set @numrow:=0'));

        if ($periode) {

            $date1 = substr($periode, 0,10);
            $date2 = substr($periode, 13,10);
            
            $date1 = date("Y-m-d", strtotime($date1));
            $date2 = date("Y-m-d", strtotime($date2));

            if (Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21) {
                $data = CorporateAction::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_CA.*',DB::raw('DATE_FORMAT(TX_CA.CA_DATE,"%d-%m-%Y") as CA_DATE_FORMAT'),'TM_PROFILE.PROFILE_NPWP','TM_PROFILE.PROFILE_COMPANY_NAME', 'TM_PROFILE.PROFILE_KODE_EMITEN',
                                        'TR_CA_TYPE.CA_TYPE_NAME')
                                    ->whereBetween('TX_CA.CA_DATE', [$date1, $date2])
                                    ->leftjoin('TM_PROFILE','TM_PROFILE.PROFILE_ID','=','TX_CA.PROFILE_ID')
                                    ->leftjoin('TR_CA_TYPE','TR_CA_TYPE.CA_TYPE_ID','=','TX_CA.CA_TYPE_ID')
                                    ->orderby('TX_CA.CA_ID','DESC')
                                    ->get();   
            }else{
                $data = CorporateAction::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_CA.*',DB::raw('DATE_FORMAT(TX_CA.CA_DATE,"%d-%m-%Y") as CA_DATE_FORMAT'),'TM_PROFILE.PROFILE_NPWP','TM_PROFILE.PROFILE_COMPANY_NAME', 'TM_PROFILE.PROFILE_KODE_EMITEN',
                                        'TR_CA_TYPE.CA_TYPE_NAME')
                                    ->where('TX_CA.PROFILE_ID',Auth::user()->PROFILE_ID)
                                    ->whereBetween('TX_CA.CA_DATE', [$date1, $date2])
                                    ->leftjoin('TM_PROFILE','TM_PROFILE.PROFILE_ID','=','TX_CA.PROFILE_ID')
                                    ->leftjoin('TR_CA_TYPE','TR_CA_TYPE.CA_TYPE_ID','=','TX_CA.CA_TYPE_ID')
                                    ->orderby('TX_CA.CA_ID','DESC')
                                    ->get();   
            }
        }else{            
            if (Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21) {
                $data = CorporateAction::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_CA.*',DB::raw('DATE_FORMAT(TX_CA.CA_DATE,"%d-%m-%Y") as CA_DATE_FORMAT'),'TM_PROFILE.PROFILE_NPWP','TM_PROFILE.PROFILE_COMPANY_NAME', 'TM_PROFILE.PROFILE_KODE_EMITEN',
                                        'TR_CA_TYPE.CA_TYPE_NAME')
                                    ->leftjoin('TM_PROFILE','TM_PROFILE.PROFILE_ID','=','TX_CA.PROFILE_ID')
                                    ->leftjoin('TR_CA_TYPE','TR_CA_TYPE.CA_TYPE_ID','=','TX_CA.CA_TYPE_ID')
                                    ->orderby('TX_CA.CA_ID','DESC')
                                    ->get();   
            }else{
                $data = CorporateAction::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_CA.*',DB::raw('DATE_FORMAT(TX_CA.CA_DATE,"%d-%m-%Y") as CA_DATE_FORMAT'),'TM_PROFILE.PROFILE_NPWP','TM_PROFILE.PROFILE_COMPANY_NAME', 'TM_PROFILE.PROFILE_KODE_EMITEN',
                                        'TR_CA_TYPE.CA_TYPE_NAME')
                                    ->where('TX_CA.PROFILE_ID',Auth::user()->PROFILE_ID)
                                    ->leftjoin('TM_PROFILE','TM_PROFILE.PROFILE_ID','=','TX_CA.PROFILE_ID')
                                    ->leftjoin('TR_CA_TYPE','TR_CA_TYPE.CA_TYPE_ID','=','TX_CA.CA_TYPE_ID')
                                    ->orderby('TX_CA.CA_ID','DESC')
                                    ->get();   
            }
        }
        return json_encode($data);
    }

    public function save()
    {               
        $tgljam = date('YmdHis');
        $npwp = Profile::where('PROFILE_ID',Input::get('PROFILE_ID'))->value('PROFILE_NPWP');

        if (Input::get('act') == 'insert') {
            $directory = 'CorporateAction/'.$npwp.'/'; 
            Storage::makeDirectory($directory, $mode = 0777, true, true);
            $path1 = 'CorporateAction/'.$npwp.'/';
            $path2 = storage_path().'/app/'.$path1;
            @unlink($path2);

            $get_doc_file = Input::file('CA_PATH');
            $doc_name = $get_doc_file->getClientOriginalName();
            $doc_extension = $get_doc_file->getClientOriginalExtension();
            $doc_size =$get_doc_file->getClientSize();

            $new_doc_name = $tgljam."-".str_random(10).".".$doc_extension;
            $doc_move = $get_doc_file->move($path2, $new_doc_name);
            
            $save = CorporateAction::create([
                'CA_TYPE_ID' => Input::get('CA_TYPE_ID'),
                'PROFILE_ID' => Input::get('PROFILE_ID'),
                'CA_DATE' => date("Y-m-d", strtotime(Input::get('CA_DATE'))),                 
                'CA_PATH' => $path1.$new_doc_name,
                'CA_CONTENT' => Input::get('CA_CONTENT'),
                'CREATED_BY' => Auth::user()->USER_ID,
                // 'CREATED_AT' => date('Y-m-d H:i:s'),
            ]);

            $idCa = $save->CA_ID;
            $this->log_download($idCa,'upload_ca');

        }else {

            $id = Input::get('CA_ID');                                    
            if (Input::file('CA_PATH')) {                
                $directory = 'CorporateAction/'.$npwp.'/';
                Storage::makeDirectory($directory, $mode = 0777, true, true);
                $path1 = 'CorporateAction/'.$npwp.'/';
                $path2 = storage_path().'/app/'.$path1;
                @unlink($path2);

                $get_doc_file = Input::file('CA_PATH');
                $doc_name = $get_doc_file->getClientOriginalName();
                $doc_extension = $get_doc_file->getClientOriginalExtension();
                $doc_size =$get_doc_file->getClientSize();

                $new_doc_name = $tgljam."-".str_random(10).".".$doc_extension;
                $doc_move = $get_doc_file->move($path2, $new_doc_name);

                $dokexist = DB::table('TX_CA')->where(['CA_ID'=>$id])->value('CA_PATH');
                if ($dokexist) {
                    @unlink(storage_path().'/app/'.$dokexist);
                }

                $save = CorporateAction::where('CA_ID', $id)
                            ->update([
                                'CA_TYPE_ID' => Input::get('CA_TYPE_ID'),
                                'PROFILE_ID' => Input::get('PROFILE_ID'),
                                'CA_DATE' => date("Y-m-d", strtotime(Input::get('CA_DATE'))),                 
                                'CA_PATH' => $path1.$new_doc_name,
                                'CA_CONTENT' => Input::get('CA_CONTENT'),
                                'UPDATED_BY' => Auth::user()->USER_ID                                
                        ]);
            }else{
                $save = CorporateAction::where('CA_ID', $id)
                            ->update([
                                'CA_TYPE_ID' => Input::get('CA_TYPE_ID'),
                                'PROFILE_ID' => Input::get('PROFILE_ID'),
                                'CA_DATE' => date("Y-m-d", strtotime(Input::get('CA_DATE'))),                                
                                'CA_CONTENT' => Input::get('CA_CONTENT'),
                                'UPDATED_BY' => Auth::user()->USER_ID                              
                        ]);                
            }            

        }

        if($save)
            return 'MSG#OK#Simpan Corporate Action berhasil.#';
        else
            return 'MSG#ERR#Simpan Corporate Action gagal.';
    }

    public function view()
    {
        $id = Input::get('ca_id');
        $ca = CorporateAction::select('TX_CA.*',DB::raw('DATE_FORMAT(TX_CA.CA_DATE,"%d-%m-%Y") as CA_DATE_FORMAT'))->where('CA_ID', $id)->first();
        $drop_type = CaType::get();
        $drop_profile = Profile::select('PROFILE_ID','PROFILE_NPWP','PROFILE_COMPANY_NAME')->get();
        $data['drop_type'] = $drop_type;
        $data['drop_profile'] = $drop_profile;
        $data['CA'] = $ca;

        if ($ca->CA_PATH) {            
            $name_file = explode('/', $ca->CA_PATH);
            $name_file = end($name_file);            
        }else{
            $name_file = '';
        }
        $data['CA']['NAME_FILE'] = $name_file;
        return view('admin/layouts/ca/formca', $data);
    }

    public function delete()
    {
        $id = Input::get('ca_id');
        $dokexist = DB::table('TX_CA')->where(['CA_ID'=>$id])->value('CA_PATH');
        if ($dokexist) {
            @unlink(storage_path().'/app/'.$dokexist);
        }
        
        $delete = CorporateAction::where('CA_ID', $id)->delete();

        if($delete)
            return 'MSG#OK#Hapus Corporate Action berhasil.#';
        else
            return 'MSG#ERR#Hapus Corporate Action gagal.';
    }

    public function preview($tipe,$id){        
        if ($tipe == 'ca') {
            $dokloc = CorporateAction::where('CA_ID',$id)->value('CA_PATH');
        }elseif ($tipe == 'regulation') {
            $dokloc = Regulation::where('REGULATION_ID',$id)->value('REGULATION_FILE_PATH');
        }elseif ($tipe == 'report') {
            $dokloc = Report::where('REPORT_ID',$id)->value('REPORT_PATH');
        }

        $ext = pathinfo($dokloc, PATHINFO_EXTENSION);

        if ($dokloc) {
            if (file_exists(storage_path().'/app/'.$dokloc)) {
                // if ($tipe == 'ca') {
                //     $this->log_download($id,'download_ca');
                // }
                return response()->download(storage_path().'/app/'.$dokloc);
                // if (strtolower($ext) == 'rar' || strtolower($ext) == 'zip' || strtolower($ext) == '7z') {                
                //     return response()->download(storage_path().'/app/'.$dokloc);
                // }else{
                //     return response()->file(storage_path().'/app/'.$dokloc);
                // }
            }else{
                return 'File Not Exist !';    
            }
        }else{
            return 'File Not Exist !';
        }

    }

    public function detail()
    {
        $id = Input::get('ca_id');
        $ca = CorporateAction::select('TX_CA.*',DB::raw('DATE_FORMAT(TX_CA.CA_DATE,"%d-%m-%Y") as CA_DATE_FORMAT'),'TR_CA_TYPE.CA_TYPE_NAME','TM_PROFILE.PROFILE_NPWP'
                            ,'TM_PROFILE.PROFILE_COMPANY_NAME')
                            ->leftjoin('TR_CA_TYPE','TR_CA_TYPE.CA_TYPE_ID','=','TX_CA.CA_TYPE_ID')
                            ->leftjoin('TM_PROFILE','TM_PROFILE.PROFILE_ID','=','TX_CA.PROFILE_ID')
                            ->where('CA_ID', $id)
                            ->first();
        $data['CA'] = $ca;
        if ($ca->CA_PATH) {            
            $name_file = explode('/', $ca->CA_PATH);
            $name_file = end($name_file);            
        }else{
            $name_file = '';
        }
        $data['CA']['NAME_FILE'] = $name_file;
        return view('admin/layouts/ca/detailca', $data);
    }

}

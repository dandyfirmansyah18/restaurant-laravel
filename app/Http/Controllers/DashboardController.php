<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth, DB;
use App\User, App\Profile, App\Log;
use App\Http\Controllers\ManagementUserController;

class DashboardController extends Controller
{
    public function __construct(ManagementUserController $_user)
    {
        $this->manageuser = $_user;
    }

    public function index()
    {
    	$viewData = array(
		                '_content_' => $this->view_dashboard()
	                );                
        return view('admin.templates.index', $viewData);
    }

    public function view_dashboard()
    {
        if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
        {            
            return view('admin.layouts.dashboard.dashboard');
        }
        else
        {
            $data = $this->manageuser->profile();
            return $data;
        }
    }

    public function listdata($type,$limit='')
    {
        if($type == 'emiten')
        {
            if($limit)
                $data = Profile::orderBy('PROFILE_ID', 'desc')->limit($limit)->get();
            else
                $data = Profile::orderBy('PROFILE_ID', 'desc')->get();
        }
        elseif($type == 'emitenislogin')
        {
            if($limit)
                $data = User::leftjoin('TM_PROFILE', 'TM_PROFILE.PROFILE_ID', '=', 'TM_USERS.PROFILE_ID')->where(['USER_LOGIN_STATUS'=>1])->whereIn('USER_ROLE_ID',[2,21])->limit($limit)->get();
            else
                $data = User::leftjoin('TM_PROFILE', 'TM_PROFILE.PROFILE_ID', '=', 'TM_USERS.PROFILE_ID')->where(['USER_LOGIN_STATUS'=>1])->whereIn('USER_ROLE_ID',[2,21])->get();
        }
        elseif($type == 'messages')
        {
            if($limit)
            {
                $data['messages'] = ContactUs::orderBy('CONTACT_US_ID', 'DESC')->where('CONTACT_US_READ', '0')->limit($limit)->get();
                $data['messages_count'] = ContactUs::orderBy('CONTACT_US_ID', 'DESC')->where('CONTACT_US_READ', '0')->count();
            }
            else
            {
                $data = ContactUs::orderBy('CONTACT_US_ID', 'DESC')->where('CONTACT_US_READ', '0')->get();
            }
        }
        elseif($type == 'downloadfile')
        {
            if($limit)
            {
                $data = DB::table('TL_LOGS AS LOG')
                        ->leftjoin('TM_USERS AS USER', 'LOG.USER_ID', '=', 'USER.USER_ID')
                        ->leftjoin('TM_PROFILE AS PROFILE', 'USER.PROFILE_ID', '=', 'PROFILE.PROFILE_ID')
                        ->leftjoin('TX_REPORT AS REPORT', 'LOG.REQUEST_PAYLOAD', '=', 'REPORT.REPORT_ID')
                        ->leftjoin('TR_REPORT_TYPE AS RTYPE', 'REPORT.REPORT_TYPE_ID', '=', 'RTYPE.REPORT_TYPE_ID')
                        ->whereIn('LOG_URL', ['download_ca','download_report'])
                        ->select('LOG.*', 'USER.USER_EMAIL', 'PROFILE.PROFILE_COMPANY_NAME', 'REPORT.REPORT_FILENAME', 'RTYPE.REPORT_TYPE_NAME')
                        ->orderBy('LOG_ID', 'DESC')
                        ->limit($limit)
                        ->get();
            }
            else
            {
                $data = DB::table('TL_LOGS AS LOG')
                        ->leftjoin('TM_USERS AS USER', 'LOG.USER_ID', '=', 'USER.USER_ID')
                        ->leftjoin('TM_PROFILE AS PROFILE', 'USER.PROFILE_ID', '=', 'PROFILE.PROFILE_ID')
                        ->leftjoin('TX_REPORT AS REPORT', 'LOG.REQUEST_PAYLOAD', '=', 'REPORT.REPORT_ID')
                        ->leftjoin('TR_REPORT_TYPE AS RTYPE', 'REPORT.REPORT_TYPE_ID', '=', 'RTYPE.REPORT_TYPE_ID')
                        ->whereIn('LOG_URL', ['download_ca','download_report'])
                        ->select('LOG.*', 'USER.USER_EMAIL', 'PROFILE.PROFILE_COMPANY_NAME', 'REPORT.REPORT_FILENAME', 'RTYPE.REPORT_TYPE_NAME')
                        ->orderBy('LOG_ID', 'DESC')
                        ->get();
            }
        }

        return $data;
    }

    public function chart($type)
    {
        if ($type == 'dailylogin')
        {

            $data = DB::table('CALENDAR_TABLE AS a')
                        ->select(DB::raw('a.dt,(SELECT COUNT(*) FROM TL_LOGS b WHERE b.LOG_URL = "post_login" AND a.dt = DATE_FORMAT(b.LOG_START,"%Y-%m-%d")) AS countlogin'))
                        ->whereRaw('DATE(a.dt) BETWEEN DATE_SUB(CURDATE(), INTERVAL 16 DAY)  AND CURDATE()')
                        ->get();

        }
        elseif($type == 'countreport')
        {

            $data = ReportType::select(DB::raw('TR_REPORT_TYPE.REPORT_TYPE_NAME,
                                            ROUND(((SELECT COUNT(*) FROM TX_REPORT WHERE TR_REPORT_TYPE.REPORT_TYPE_ID = TX_REPORT.REPORT_TYPE_ID) / 
                                            (SELECT COUNT(*) FROM TX_REPORT) * 100),2) AS value, "custom" as className,
                                            (CASE WHEN (TR_REPORT_TYPE.REPORT_TYPE_ID = 1) THEN "#0070ba"
                                            WHEN (TR_REPORT_TYPE.REPORT_TYPE_ID = 2) THEN "#01a89e"
                                            WHEN (TR_REPORT_TYPE.REPORT_TYPE_ID = 3) THEN "#86bd3d"
                                            WHEN (TR_REPORT_TYPE.REPORT_TYPE_ID = 4) THEN "#efaa3a"
                                            WHEN (TR_REPORT_TYPE.REPORT_TYPE_ID = 5) THEN "#f05a25"
                                            WHEN (TR_REPORT_TYPE.REPORT_TYPE_ID = 6) THEN "#c2272e"
                                            ELSE "#535456" END) AS colorpalette
                                            '))
                                            ->get();
        }
        elseif($type == 'uploaddownload')
        {
            $data["chart"] = DB::table('CALENDAR_TABLE AS a')
                        ->select(DB::raw('a.dt,(SELECT COUNT(*) FROM TL_LOGS b WHERE b.LOG_URL IN ("upload_report","upload_ca") AND a.dt = DATE_FORMAT(b.LOG_START,"%Y-%m-%d")) AS upload, (SELECT COUNT(*) FROM TL_LOGS b WHERE b.LOG_URL IN ("download_report","download_ca") AND a.dt = DATE_FORMAT(b.LOG_START,"%Y-%m-%d")) AS download'))
                        ->whereRaw('DATE(a.dt) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY)  AND CURDATE()')
                        ->get();

            $data['sumupload'] = Log::whereIn('LOG_URL', ['upload_report', 'upload_ca'])->count();
            $data['sumdownload'] = Log::whereIn('LOG_URL', ['download_report', 'download_ca'])->count();
        }

        return $data;

    }

    public function detail($type)
    {
        if($type == 'emitenislogin')
        {
            $data['title'] = "Emiten Currently Logged in";
            $data['type'] = $type;
            $data['datatable'] = array(
                    array("field" => "PROFILE_NPWP", "title" => "NPWP"),
                    array("field" => "PROFILE_COMPANY_NAME", "title" => "Company Name"),
                    array("field" => "USER_EMAIL", "title" => "Email"),
                    array("field" => "USER_NAME", "title" => "Name"),
                    array("field" => "USER_LAST_LOGIN", "title" => "Login Time"),
            );

            return view('admin.layouts.dashboard.detail', $data);
        }
        elseif($type == 'downloadfile')
        {
            $data['title'] = "Download History";
            $data['type'] = $type;
            $data['datatable'] = array(
                    array("field" => "LOG_START", "title" => "Date"),
                    array("field" => "USER_EMAIL", "title" => "Email"),
                    array("field" => "PROFILE_COMPANY_NAME", "title" => "Company Name"),
                    array("field" => "REPORT_TYPE_NAME", "title" => "Report Type"),
                    array("field" => "REPORT_FILENAME", "title" => "Filename"),
            );

            return view('admin.layouts.dashboard.detail', $data);
        }
    }
}

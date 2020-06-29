<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Response, Auth, Excel, File, PDF, Storage;
use Illuminate\Support\Facades\Input;
use App\StockSummary, App\Profile;

class StocksumController extends Controller
{        
    public function stocksumlist($emiten="", $periode="")
    {    	        
        if ($periode) {
            $data['periode'] = $periode;
        }else{
            $data['periode'] = date('M-Y');
        }


        if ($emiten) {            
            if (Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21) {                
                $data['emiten'] = $emiten;
            }else{
                $data['emiten'] = Profile::where('PROFILE_ID',Auth::user()->PROFILE_ID)->value('PROFILE_KODE_EMITEN');
            }
        }else{
            if (Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21) {
                $data['emiten'] = 'AALI';
            }else{
                $data['emiten'] = Profile::where('PROFILE_ID',Auth::user()->PROFILE_ID)->value('PROFILE_KODE_EMITEN');
            }
        }

        $data['emiten_list'] = StockSummary::groupBy('TX_STOCK_SUM_STOCK_CODE')->orderBy('TX_STOCK_SUM_ID', 'ASC')->get();        
    	return view('admin.layouts.stocksum.stocksumlist',$data);        	
    }

    public function stocksumdata($emiten="", $periode="")
    {
    	DB::statement(DB::raw('set @numrow:=0'));
        // dd($periode);
        if ($periode) {            
            $periode = date('m-Y', strtotime($periode));
            if (Auth::user()->USER_ROLE_ID == 2 || Auth::user()->USER_ROLE_ID == 21) {
                $kode_emiten = Profile::where('PROFILE_ID',Auth::user()->PROFILE_ID)->value('PROFILE_KODE_EMITEN');
            }else{
                $kode_emiten = $emiten;                
                // $date1 = substr($periode, 0,10);
                // $date2 = substr($periode, 13,10);
                
                // $date1 = date("Y-m-d", strtotime($date1));
                // $date2 = date("Y-m-d", strtotime($date2));

                // $whereperiode = "TX_STOCK_SUM_DATE BETWEEN '".$date1."' AND '".$date2."'";
            }

            $whereperiode = "DATE_FORMAT(TX_STOCK_SUM_DATE,'%m-%Y') = '".$periode."'";         
        }else{
            if (Auth::user()->USER_ROLE_ID == 2 || Auth::user()->USER_ROLE_ID == 21) {
                $kode_emiten = Profile::where('PROFILE_ID',Auth::user()->PROFILE_ID)->value('PROFILE_KODE_EMITEN');
            }else{
                $kode_emiten = 'AALI'; // pertama tampil hardcode
            }

            $whereperiode = "DATE_FORMAT(TX_STOCK_SUM_DATE,'%m-%Y') = '".date('m-Y')."'";
        }

        $data = StockSummary::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_STOCK_SUMMARY.*',
                                            DB::raw('DATE_FORMAT(TX_STOCK_SUM_DATE,"%d-%m-%Y") as Tanggal'))
                                    ->whereRaw($whereperiode." AND TX_STOCK_SUM_STOCK_CODE = '".$kode_emiten."'")
                                    ->orderby('TX_STOCK_SUM_DATE','ASC')
                                    ->get();
        
    	return json_encode($data);    	
    }

    public function save()
    {               
        if (Input::get('act') == 'insert') { 
                        
            $file = Input::file('FILESTOCKSUM');                
            $doc_name = $file->getClientOriginalName();
            $doc_extension = $file->getClientOriginalExtension();
            $doc_size =$file->getClientSize();

            $tanggal = date("Y-m-d", strtotime(Input::get('DATESTOCKSUM')));

            $extension = File::extension($file->getClientOriginalName());

            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $path = $file->getRealPath();
                $data_excel = Excel::load($path)->get();
                // $tanggal = date('Y-m-d');                

                if(!empty($data_excel) && $data_excel->count()){

                    foreach ($data_excel as $key => $value) {                
                        $save = StockSummary::updateOrCreate([
                                                                    'TX_STOCK_SUM_STOCK_CODE' => $value->stock_code,
                                                                    'TX_STOCK_SUM_DATE' => $tanggal
                                                                ],
                                                                [
                                                                    'TX_STOCK_SUM_STOCK_NAME' => $value->stock_name,
                                                                    'TX_STOCK_SUM_PREVIOUS' => $value->previous,
                                                                    'TX_STOCK_SUM_HIGH' => $value->high,
                                                                    'TX_STOCK_SUM_LOW' => $value->low,
                                                                    'TX_STOCK_SUM_CLOSE' => $value->close,
                                                                    'TX_STOCK_SUM_CHANGE' => $value->change,
                                                                    'TX_STOCK_SUM_VOLUME' => $value->volume,
                                                                    'TX_STOCK_SUM_VALUE' => $value->value,
                                                                    'TX_STOCK_SUM_FREQUENCY' => $value->frequency,
                                                                    'TX_STOCK_SUM_INDEX' => $value->index,
                                                                    'TX_STOCK_SUM_LISTED_SHARE' => $value->listed_share,
                                                                    'TX_STOCK_SUM_TRADEABLE_SH' => $value->tradeable_shares,
                                                                    'TX_STOCK_SUM_WEIGHT_INDEX' => $value->weight_for_index,
                                                                    'TX_STOCK_SUM_FOREIGN_SELL' => $value->foreign_sell,
                                                                    'TX_STOCK_SUM_FOREIGN_BUY' => $value->foreign_buy,
                                                                    'TX_STOCK_SUM_NON_REG_VOL' => $value->non_regular_volume,
                                                                    'TX_STOCK_SUM_NON_REG_VAL' => $value->non_regular_value,
                                                                    'TX_STOCK_SUM_NON_REG_FRE' => $value->non_regular_frequency,
                                                                    'CREATED_BY' => Auth::user()->USER_ID,
                                                                ]
                                                             );
                        $save->save();
                    }
                }
            }          
        }else{
            $id = Input::get('ARTICLE_ID');
            $save = Article::where('ARTICLE_ID', $id)
                ->update([
                    'ARTICLE_USER_ID' => 1,
                    'ARTICLE_TYPE_ID' => 2,                    
                    'ARTICLE_TITLE' => Input::get('ARTICLE_TITLE'),
                    'ARTICLE_PROLOG' => Input::get('ARTICLE_PROLOG'),
                    // 'ARTICLE_DATE' => date("Y-m-d", strtotime(Input::get('ARTICLE_DATE'))),
                    'ARTICLE_TEXT' => Input::get('ARTICLE_CONTENT'),
                    'ARTICLE_STATUS' => Input::get('ARTICLE_STATUS'),
                    'ARTICLE_HIGHLIGHT' => Input::get('ARTICLE_HIGHLIGHT'),
                    'UPDATED_BY' => Auth::user()->USER_ID
            ]);
        } 

        if($save)
            return 'MSG#OK#Simpan Stock Summary berhasil.#';
        else
            return 'MSG#ERR#Simpan Kegiatan Pasar Modal gagal.';
    }

    public function view()
    {
        $id = Input::get('kpm_id');
        $kpm = Article::select('*',DB::raw('DATE_FORMAT(ARTICLE_DATE,"%d-%m-%Y") as ARTICLE_DATE_FORMAT'))->where('ARTICLE_ID', $id)->first();        
        $data['KPM'] = $kpm;
        return view('admin/layouts/kpm/formkpm', $data);
    }

    public function delete()
    {
        $id = Input::get('kpm_id');
        $delete = Article::where('ARTICLE_ID', $id)->delete();

        if($delete)
            return 'MSG#OK#Hapus Kegiatan Pasar Modal berhasil.#';
        else
            return 'MSG#ERR#Hapus Kegiatan Pasar Modal gagal.';
    }

    public function export($type, $emiten, $periode, $filename="")
    {        

        $montharray = array(
                '01' => 'JANUARI',
                '02' => 'FEBRUARI',
                '03' => 'MARET',
                '04' => 'APRIL',
                '05' => 'MEI',
                '06' => 'JUNI',
                '07' => 'JULI',
                '08' => 'AGUSTUS',
                '09' => 'SEPTEMBER',
                '10' => 'OKTOBER',
                '11' => 'NOVEMBER',
                '12' => 'DESEMBER',
        );

        list($file,$from) = explode('-', $type);
        $periode = date('m-Y', strtotime($periode));

        $getcount = explode('-', $periode);        
        $whereDate = "DATE_FORMAT(TX_STOCK_SUM_DATE,'%m-%Y') = '".$periode."'";        

        if ($emiten == 'null') {
            $emiten = Profile::where('PROFILE_ID',Auth::user()->PROFILE_ID)->value('PROFILE_KODE_EMITEN');
        }

        list($month,$year) = explode('-', $periode);
        $monthname = $montharray[$month].' '.$year;        
        $stockdata = StockSummary::select('*',DB::raw('DATE_FORMAT(TX_STOCK_SUM_DATE,"%Y/%m/%d") as Tanggal'))
                                    ->whereRaw($whereDate.' AND TX_STOCK_SUM_STOCK_CODE = "'.$emiten.'"')
                                    ->orderby('TX_STOCK_SUM_DATE','ASC')
                                    ->get();

        $stockSum = StockSummary::select(DB::raw('CASE WHEN SUM(TX_STOCK_SUM_LOW) = 0 THEN 0
                                        ELSE MIN(NULLIF(TX_STOCK_SUM_LOW, 0))
                                        END AS value_low,
                                        CASE 
                                        WHEN SUM(TX_STOCK_SUM_HIGH) = 0 THEN 0
                                        ELSE MAX(NULLIF(TX_STOCK_SUM_HIGH, 0))
                                        END AS value_high, 
                                        SUM(TX_STOCK_SUM_VOLUME) as sum_volume, SUM(TX_STOCK_SUM_VALUE) as sum_value, SUM(TX_STOCK_SUM_FREQUENCY) as sum_frequency,
                                        SUM(TX_STOCK_SUM_NON_REG_VOL) as sum_nonvol, SUM(TX_STOCK_SUM_NON_REG_VAL) as sum_nonval, SUM(TX_STOCK_SUM_NON_REG_FRE) as sum_nonfreq'))
                                    ->whereRaw('DATE_FORMAT(TX_STOCK_SUM_DATE,"%m-%Y") = "'.$periode.'" AND TX_STOCK_SUM_STOCK_CODE = "'.$emiten.'"')
                                    ->orderby('TX_STOCK_SUM_DATE','ASC') 
                                    ->get();

        $value_previous = StockSummary::select('TX_STOCK_SUM_PREVIOUS')
                                        ->whereRaw('DATE_FORMAT(TX_STOCK_SUM_DATE,"%m-%Y") = "'.$periode.'" AND TX_STOCK_SUM_STOCK_CODE = "'.$emiten.'"')
                                        ->orderby('TX_STOCK_SUM_DATE','ASC')->limit(1)->get();
        $value_close = StockSummary::select('TX_STOCK_SUM_CLOSE')
                                        ->whereRaw('DATE_FORMAT(TX_STOCK_SUM_DATE,"%m-%Y") = "'.$periode.'" AND TX_STOCK_SUM_STOCK_CODE = "'.$emiten.'"')
                                        ->orderby('TX_STOCK_SUM_DATE','DESC')->limit(1)->get();


        if ($filename) {
            list($chart1,$chart2) = explode('-', $filename);
        }else{
            $chart1 = '';
            $chart2 = '';
        }

        $emiten_name = strtoupper($stockdata[0]->TX_STOCK_SUM_STOCK_NAME);

        if (Auth::check()) {            
            // password
            if (Auth::user()->USER_ROLE_ID == 2 || Auth::user()->USER_ROLE_ID == 21) {
                $checkpassword = Profile::where('PROFILE_ID',Auth::user()->PROFILE_ID)->value('PROFILE_PASSWORD');
                if ($checkpassword) {
                    $password = explode('|', decrypt($checkpassword))[0];
                }else{
                    $password = 'secret';
                }
            }else{
                $password = 'P@ssw0rd';
            }
        }


        if ($file == 'pdf') {            
            $pdf = PDF::loadView('pdf.stocksummary', compact('stockdata','stockSum','emiten','periode','emiten_name','monthname','chart1','chart2','value_close','value_previous'))->setPaper('a4', 'landscape');
            if ($from == 'luar') {                
                if(Auth::check()) {
                    $pdf->setEncryption($password);
                }
            }else{
                
            }
            return $pdf->download($emiten_name.' '.$monthname.'.pdf');
        }else{
            return Excel::create($emiten_name.' '.$monthname, function($excel) use($password,$stockdata,$stockSum,$emiten,$periode,$emiten_name,$monthname,$chart1,$chart2,$value_close,$value_previous) {
                $excel->sheet('Data Perdagangan Saham', function($sheet) use($password,$stockdata,$stockSum,$emiten,$periode,$emiten_name,$monthname,$chart1,$chart2,$value_close,$value_previous) {
                    $sheet->loadView('excel/stocksummary')                    
                    ->with("stockdata",$stockdata)
                    ->with("stockSum",$stockSum)
                    ->with("emiten",$emiten)
                    ->with("periode",$periode)
                    ->with("emiten_name",$emiten_name)
                    ->with("monthname",$monthname)
                    ->with("chart1",$chart1)
                    ->with("chart2",$chart2)
                    ->with("value_close",$value_close)
                    ->with("value_previous",$value_previous);
                    // PROTECT with your passwword                    
                    // $sheet->protect($password);
                });
                $excel->sheet('Chart Perkembangan Harga Saham', function($sheet) use($password,$chart1,$emiten_name,$monthname) {
                    $sheet->loadView('excel/chart1')                    
                    ->with("chart1",$chart1)
                    ->with("emiten_name",$emiten_name)
                    ->with("monthname",$monthname);                
                    // PROTECT with your passwword                    
                    // $sheet->protect($password);
                });
                $excel->sheet('Chart Nilai Transaksi Saham', function($sheet) use($password,$chart2,$emiten_name,$monthname) {
                    $sheet->loadView('excel/chart2')                    
                    ->with("chart2",$chart2)
                    ->with("emiten_name",$emiten_name)
                    ->with("monthname",$monthname);                   
                    // PROTECT with your passwword                    
                    // $sheet->protect($password);
                });
            })->export('xlsx');
            
        }
    }

    public function saveChart()
    {        
        $tgljam = date('YmdHis');
        $get_doc_file = Input::file('chart1');
        $get_doc_file2 = Input::file('chart2');
        // dd($get_doc_file);
        // $doc_name = $get_doc_file->getClientOriginalName();
        // $doc_extension = $get_doc_file->getClientOriginalExtension(); 

        $directory = 'TempZIP/';        
        Storage::makeDirectory($directory, $mode = 0777, true, true);
        $path1 = 'TempZIP/'; 
        $path2 = storage_path().'/app/'.$path1;
        @unlink($path2);

        $new_doc_name = $tgljam."_".str_random(6)."_chart1.png";
        $new_doc_name2 = $tgljam."_".str_random(6)."_chart2.png";
        $doc_move = $get_doc_file->move($path2, $new_doc_name);
        $doc_move2 = $get_doc_file2->move($path2, $new_doc_name2);

        if ($doc_move && $doc_move2) {
            return $new_doc_name.'-'.$new_doc_name2;
        }else{
            return 'GAOK';
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response, Auth;
use Illuminate\Support\Facades\Input;
use App\Article, App\ArticleTypeSub;

class NewsController extends Controller
{        
    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    public function newslist()
    {    	
        $drop_type = ArticleTypeSub::where('ARTICLE_TYPE_ID',1)->get();
        $data['drop_type'] = $drop_type;
        return view('admin.layouts.news.newslist',$data);           
    }

    public function newsdata()
    {
        DB::statement(DB::raw('set @numrow:=0'));
        $data = Article::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_ARTICLE.*','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_NAME')
                                       ->leftjoin('TR_ARTICLE_TYPE_SUB','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_ID','=','TX_ARTICLE.ARTICLE_TYPE_SUB_ID')
                                       ->where('TX_ARTICLE.ARTICLE_TYPE_ID',1)->orderby('TX_ARTICLE.ARTICLE_ID','DESC')->get();

    	return json_encode($data);    	
    }

    public function save()
    {               
        if (Input::get('act') == 'insert') { 
            $save = Article::create([
                'ARTICLE_USER_ID' => 1,
                'ARTICLE_TYPE_ID' => 1,
                'ARTICLE_TYPE_SUB_ID' => Input::get('ARTICLE_TYPE_SUB_ID'),
                'ARTICLE_TITLE' => Input::get('ARTICLE_TITLE'),
                'ARTICLE_PROLOG' => Input::get('ARTICLE_PROLOG'),
                // 'ARTICLE_DATE' => date("Y-m-d", strtotime(Input::get('ARTICLE_DATE'))),
                'ARTICLE_TEXT' => Input::get('ARTICLE_CONTENT'),
                'ARTICLE_STATUS' => Input::get('ARTICLE_STATUS'),
                'ARTICLE_HIGHLIGHT' => Input::get('ARTICLE_HIGHLIGHT'),
                // 'CREATED_AT' => date('Y-m-d H:i:s'),
                'CREATED_BY' => Auth::user()->USER_ID
            ]);            
        }else{
            $id = Input::get('ARTICLE_ID');
            $save = Article::where('ARTICLE_ID', $id)
                ->update([
                    'ARTICLE_USER_ID' => 1,
                    'ARTICLE_TYPE_ID' => 1,
                    'ARTICLE_TYPE_SUB_ID' => Input::get('ARTICLE_TYPE_SUB_ID'),
                    'ARTICLE_TITLE' => Input::get('ARTICLE_TITLE'),
                    'ARTICLE_PROLOG' => Input::get('ARTICLE_PROLOG'),
                    // 'ARTICLE_DATE' => date("Y-m-d", strtotime(Input::get('ARTICLE_DATE'))),
                    'ARTICLE_TEXT' => Input::get('ARTICLE_CONTENT'),
                    'ARTICLE_STATUS' => Input::get('ARTICLE_STATUS'),
                    'ARTICLE_HIGHLIGHT' => Input::get('ARTICLE_HIGHLIGHT'),
                    // 'UPDATED_AT' => date('Y-m-d H:i:s'),
                    'UPDATED_BY' => Auth::user()->USER_ID
            ]);
        } 

        if($save)
            return 'MSG#OK#Simpan News berhasil.#';
        else
            return 'MSG#ERR#Simpan News gagal.';
    }

    public function view()
    {
        $id = Input::get('news_id');
        $news = Article::select('*',DB::raw('DATE_FORMAT(ARTICLE_DATE,"%d-%m-%Y") as ARTICLE_DATE_FORMAT'))->where('ARTICLE_ID', $id)->first();
        $drop_type = DB::table('TR_ARTICLE_TYPE_SUB')->where('ARTICLE_TYPE_ID',1)->get();
        $data['drop_type'] = $drop_type;
        $data['NEWS'] = $news;
        return view('admin/layouts/news/formnews', $data);
    }

    public function delete()
    {
        $id = Input::get('news_id');
        $delete = Article::where('ARTICLE_ID', $id)->delete();

        if($delete)
            return 'MSG#OK#Hapus news berhasil.#';
        else
            return 'MSG#ERR#Hapus news gagal.';
    }

    public function activate()
    {
        $id = Input::get('news_id');
        $status = Input::get('status');
        
        if($status == 1)
            $msg = 'Aktivasi';
        else
            $msg = 'Non Aktivasi';
            
        $activate = Article::where('ARTICLE_ID', $id)->update(['ARTICLE_STATUS'=>$status]);

        if($activate)
            return 'MSG#OK#'.$msg.' news berhasil.#';
        else
            return 'MSG#ERR#'.$msg.' news gagal.';
    }

    public function uploadimage()
    {        
        $CKEditor = Input::get('CKEditor');
        $funcNum = Input::get('CKEditorFuncNum');
        $message = $url = '';        
        if (Input::hasFile('upload')) {
            $file = Input::file('upload');
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();
                $file->move(storage_path().'/images/', $filename);
                $url = public_path() .'/images/' . $filename;
            } else {
                $message = 'An error occured while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }

}

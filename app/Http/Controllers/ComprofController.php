<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response, Auth;
use Illuminate\Support\Facades\Input;
use App\Article;

class ComprofController extends Controller
{            
    public function save()
    {               
        if (Input::get('ARTICLE_ID') == '') { 
            $save = Article::create([
                'ARTICLE_USER_ID' => 1,
                'ARTICLE_TYPE_ID' => 5,                
                'ARTICLE_TITLE' => Input::get('ARTICLE_TITLE'),
                'ARTICLE_PROLOG' => Input::get('ARTICLE_PROLOG'),
                'ARTICLE_TEXT' => Input::get('ARTICLE_CONTENT'),
                'UPDATED_BY' => Auth::user()->USER_ID
            ]);            
        }else{
            $id = Input::get('ARTICLE_ID');
            $save = Article::where('ARTICLE_ID', $id)
                ->update([
                    'ARTICLE_USER_ID' => 1,
                    'ARTICLE_TYPE_ID' => 5,                    
                    'ARTICLE_TITLE' => Input::get('ARTICLE_TITLE'),
                    'ARTICLE_PROLOG' => Input::get('ARTICLE_PROLOG'),
                    'ARTICLE_TEXT' => Input::get('ARTICLE_CONTENT'),
                    'UPDATED_BY' => Auth::user()->USER_ID
            ]);
        } 

        if($save)
            return 'MSG#OK#Simpan Company Profile berhasil.#';
        else
            return 'MSG#ERR#Simpan Company Profile gagal.';
    }

    public function view()
    {
        $check_in_article = Article::where('ARTICLE_TYPE_ID',5)->count();
        if ($check_in_article > 0) {
            $show = Article::where('ARTICLE_TYPE_ID',5)->first();
            $data['COMPROF'] = $show;
        }else{            
            $data['COMPROF']['ARTICLE_ID'] = '';
            $data['COMPROF']['ARTICLE_TITLE'] = '';
            $data['COMPROF']['ARTICLE_PROLOG'] = '';
            $data['COMPROF']['ARTICLE_TEXT'] = '';   
        }

        return view('admin/layouts/comprof/formcomprof', $data);
    }

}

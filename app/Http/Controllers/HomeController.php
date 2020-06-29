<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\ContactUs, App\Profile, App\Menu;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->redirectTo = route('dashboard');
    // }

    public function index()
    {
    	$data['title'] = 'Home';
        $data['food_breakfast'] = Menu::select('*')->where('KIND_MENU_ID',1)->limit(6)->get();
        $data['food_lunch'] = Menu::select('*')->where('KIND_MENU_ID',2)->limit(6)->get();
        $data['drink'] = Menu::select('*')->where('KIND_MENU_ID',3)->limit(6)->get();
        $data['snack'] = Menu::select('*')->where('KIND_MENU_ID',4)->limit(6)->get();        
    	return view('layouts/home', $data);
    }

    public function news($type,$id='')
    {
    	$data_category = DB::select('SELECT *, (SELECT COUNT(*) FROM TX_ARTICLE a WHERE a.ARTICLE_TYPE_ID = 1 AND a.ARTICLE_TYPE_SUB_ID = b.ARTICLE_TYPE_SUB_ID) AS countbro 
                                        FROM TR_ARTICLE_TYPE_SUB b');
        
        $highlight = Article::select('TX_ARTICLE.*',DB::raw('DATE_FORMAT(TX_ARTICLE.CREATED_AT,"%d/%m/%Y %H:%i") as date_article'),'TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE_SUB','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_ID','=','TX_ARTICLE.ARTICLE_TYPE_SUB_ID')
                                ->where(['TX_ARTICLE.ARTICLE_TYPE_ID'=>1, 'TX_ARTICLE.ARTICLE_HIGHLIGHT'=>1, 'TX_ARTICLE.ARTICLE_STATUS'=>1])->orderby('TX_ARTICLE.ARTICLE_ID', 'DESC')->limit(3)->get();

        $title_highlight = 'Highlight News';

        if($type == 'latest_news')
        {
            $title = 'Latest News';
            $where = (['TX_ARTICLE.ARTICLE_TYPE_ID'=>1,'TX_ARTICLE.ARTICLE_STATUS'=>1]);
            $view = 'layouts/news/latest_news';

            $article = Article::select('TX_ARTICLE.*',DB::raw('DATE_FORMAT(TX_ARTICLE.CREATED_AT,"%d/%m/%Y %H:%i") as date_article'),'TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE_SUB','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_ID','=','TX_ARTICLE.ARTICLE_TYPE_SUB_ID')
                                ->where($where)->orderby('TX_ARTICLE.ARTICLE_ID', 'DESC')->paginate(10);


            $data = array(
                        'title' => $title,
                        'article' => $article,
                        'category' => $data_category,
                        'highlight' => $highlight, 
                        'title_highlight' => $title_highlight
                    );

        }elseif ($type == 'detail_news') {
            $title = 'Detail News';
            $view = 'layouts/news/detail_news';
            $where = (['TX_ARTICLE.ARTICLE_ID'=>$id]);

            $article = Article::select('TX_ARTICLE.*',DB::raw('DATE_FORMAT(TX_ARTICLE.CREATED_AT,"%d/%m/%Y %H:%i") as date_article'),'TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE_SUB','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_ID','=','TX_ARTICLE.ARTICLE_TYPE_SUB_ID')
                                ->where($where)->orderby('TX_ARTICLE.ARTICLE_ID', 'DESC')->first();

            $read_now = $article->ARTICLE_READ; 
            $update_read = Article::where('ARTICLE_ID', $id)
                                ->update([
                                    'ARTICLE_READ' => $read_now + 1,
                            ]);

            $data = array(
                        'title' => $title,
                        'article' => $article,
                        'category' => $data_category,
                        'highlight' => $highlight, 
                        'title_highlight' => $title_highlight
                    );            
        }elseif ($type == 'category_news'){

            $get_title = ArticleTypeSub::where('ARTICLE_TYPE_SUB_ID',$id)->value('ARTICLE_TYPE_SUB_NAME');

            $title = $get_title.' News';
            $where = (['TX_ARTICLE.ARTICLE_TYPE_ID'=>1,'TX_ARTICLE.ARTICLE_STATUS'=>1,'TX_ARTICLE.ARTICLE_TYPE_SUB_ID'=>$id]);
            $view = 'layouts/news/latest_news';

            $article = Article::select('TX_ARTICLE.*',DB::raw('DATE_FORMAT(TX_ARTICLE.CREATED_AT,"%d/%m/%Y %H:%i") as date_article'),'TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE_SUB','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_ID','=','TX_ARTICLE.ARTICLE_TYPE_SUB_ID')
                                ->where($where)->orderby('TX_ARTICLE.ARTICLE_ID', 'DESC')->paginate(10);


            $data = array(
                        'title' => $title,
                        'article' => $article,
                        'category' => $data_category,
                        'highlight' => $highlight, 
                        'title_highlight' => $title_highlight
                    );            
        }

        return view($view, $data);
    }

    public function kpmfront($type,$id='')
    {
        $data_category = DB::select('SELECT *, (SELECT COUNT(*) FROM TX_ARTICLE a WHERE a.ARTICLE_TYPE_ID = 1 AND a.ARTICLE_TYPE_SUB_ID = b.ARTICLE_TYPE_SUB_ID) AS countbro 
                                        FROM TR_ARTICLE_TYPE_SUB b');
        
        $highlight = Article::select('TX_ARTICLE.*',DB::raw('DATE_FORMAT(TX_ARTICLE.CREATED_AT,"%d/%m/%Y %H:%i") as date_article'),'TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE_SUB','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_ID','=','TX_ARTICLE.ARTICLE_TYPE_SUB_ID')
                                ->where(['TX_ARTICLE.ARTICLE_TYPE_ID'=>2, 'TX_ARTICLE.ARTICLE_HIGHLIGHT'=>1, 'TX_ARTICLE.ARTICLE_STATUS'=>1])->orderby('TX_ARTICLE.ARTICLE_ID', 'DESC')->limit(3)->get();

        $title_highlight = 'Highlight Kegiatan Pasar Modal';

        if($type == 'list')
        {
            $title = 'Kegiatan Pasar Modal';
            $where = (['TX_ARTICLE.ARTICLE_TYPE_ID'=>2,'TX_ARTICLE.ARTICLE_STATUS'=>1]);
            $view = 'layouts/kpm/kpmlist';

            $article = Article::select('TX_ARTICLE.*',DB::raw('DATE_FORMAT(TX_ARTICLE.CREATED_AT,"%d/%m/%Y %H:%i") as date_article'),'TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE_SUB','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_ID','=','TX_ARTICLE.ARTICLE_TYPE_SUB_ID')
                                ->where($where)->orderby('TX_ARTICLE.ARTICLE_ID', 'DESC')->paginate(10);

            $data = array(
                        'title' => $title,
                        'article' => $article,
                        'category' => $data_category,
                        'highlight' => $highlight,
                        'title_highlight' => $title_highlight 
                    );

        }elseif ($type == 'detail_kpm') {
            $title = 'Detail News';
            $view = 'layouts/kpm/detail_kpm';
            $where = (['TX_ARTICLE.ARTICLE_ID'=>$id]);

            $article = Article::select('TX_ARTICLE.*',DB::raw('DATE_FORMAT(TX_ARTICLE.CREATED_AT,"%d/%m/%Y %H:%i") as date_article'),'TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE_SUB','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_ID','=','TX_ARTICLE.ARTICLE_TYPE_SUB_ID')
                                ->where($where)->orderby('TX_ARTICLE.ARTICLE_ID', 'DESC')->first();

            $data = array(
                        'title' => $title,
                        'article' => $article,
                        'category' => $data_category,
                        'highlight' => $highlight,
                        'title_highlight' => $title_highlight 
                    );            
        }

        return view($view, $data);
    }

    public function company_profile()
    {
        $data['title'] = 'EDII';
        $data['COMPANY_PROFILE'] = Article::where('ARTICLE_TYPE_ID', 5)->first();

        return view('layouts/company_profile/company_profile', $data);
    }

    public function contactus()
    {
        $data['title'] = 'Contact Us';
        return view('layouts/contactus/contactus', $data);   
    }

    public function regulation(Request $request, $type)
    {
        $data_category = DB::select('SELECT *, (SELECT COUNT(*) FROM TX_ARTICLE a WHERE a.ARTICLE_TYPE_ID = 1 AND a.ARTICLE_TYPE_SUB_ID = b.ARTICLE_TYPE_SUB_ID) AS countbro 
                                        FROM TR_ARTICLE_TYPE_SUB b');
        
        $highlight = Article::select('TX_ARTICLE.*',DB::raw('DATE_FORMAT(TX_ARTICLE.CREATED_AT,"%d/%m/%Y %H:%i") as date_article'),'TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE_SUB','TR_ARTICLE_TYPE_SUB.ARTICLE_TYPE_SUB_ID','=','TX_ARTICLE.ARTICLE_TYPE_SUB_ID')
                                ->where(['TX_ARTICLE.ARTICLE_TYPE_ID'=>1, 'TX_ARTICLE.ARTICLE_HIGHLIGHT'=>1, 'TX_ARTICLE.ARTICLE_STATUS'=>1])->orderby('TX_ARTICLE.ARTICLE_ID', 'DESC')->limit(3)->get();

        $title_highlight = 'Highlight News';


        if($type == 'regulation')
        {
            $title = 'Regulation List';
            $where = (['TX_REGULATION.REGULATION_STATUS'=>1,'TX_REGULATION.REGULATION_TYPE_ID'=>3]);
            $view = 'layouts/regulation/regulationlist';

            $article = Regulation::select('TX_REGULATION.*',DB::raw('DATE_FORMAT(TX_REGULATION.CREATED_AT,"%d/%m/%Y %H:%i") as date_regulation'),'TR_ARTICLE_TYPE.ARTICLE_TYPE_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE','TX_REGULATION.REGULATION_TYPE_ID','=','TR_ARTICLE_TYPE.ARTICLE_TYPE_ID')
                                ->where($where)->orderby('TX_REGULATION.REGULATION_ID', 'DESC')->paginate(10);

            $type = 'Regulation';

        }elseif ($type == 'ca_procedure') {
            $title = 'Corporate Action Procedure';
            $where = (['TX_REGULATION.REGULATION_STATUS'=>1,'TX_REGULATION.REGULATION_TYPE_ID'=>4]);
            $view = 'layouts/regulation/regulationlist';

            $article = Regulation::select('TX_REGULATION.*',DB::raw('DATE_FORMAT(TX_REGULATION.CREATED_AT,"%d/%m/%Y %H:%i") as date_regulation'),'TR_ARTICLE_TYPE.ARTICLE_TYPE_NAME')
                                ->leftjoin('TR_ARTICLE_TYPE','TX_REGULATION.REGULATION_TYPE_ID','=','TR_ARTICLE_TYPE.ARTICLE_TYPE_ID')
                                ->where($where)->orderby('TX_REGULATION.REGULATION_ID', 'DESC')->paginate(10);

            $type = 'Corporate Action Procedure';

        }

        $data = array(
                    'title' => $title,
                    'article' => $article,
                    'category' => $data_category,
                    'highlight' => $highlight, 
                    'title_highlight' => $title_highlight,
                    'type' => $type 
                );           

        return view($view, $data)->with('i', ($request->input('page', 1) - 1) * 10);;
    }

    public function sendmessage()
    {
        $name = Input::get('name');
        $email = Input::get('email');
        $message = Input::get('message');


        $save = ContactUs::create([
            'CONTACT_US_EMAIL' => $email,
            'CONTACT_US_NAME' => $name,
            'CONTACT_US_TEXT' => $message,
        ]);        

        if($save)
            return 'MSG#OK#Pesan berhasil terkirim.';
        else
            return 'MSG#ERR#Pesan gagal terkirim.';
    }

    public function search($keyword = '')
    {        
        $data['ARTICLE'] = NULL;
        if($keyword)
        {
            $data['ARTICLE'] = Article::where('ARTICLE_TITLE', 'LIKE', '%'.$keyword.'%')
                    ->where('ARTICLE_PROLOG', 'LIKE', '%'.$keyword.'%')
                    ->where('ARTICLE_TEXT', 'LIKE', '%'.$keyword.'%')
                    ->paginate(10);
        }

        $data['KEYWORD'] = $keyword;

        return view('layouts.search', $data);
    }

    public function drawchart()
    {
        $kd_emiten = Input::get('emiten');
        $month = date('m-Y', strtotime(Input::get('month')));        

        $data['chart'] = StockSummary::where(['TX_STOCK_SUM_STOCK_CODE'=>$kd_emiten])->whereRaw("DATE_FORMAT(TX_STOCK_SUM_DATE, '%m-%Y') = '".$month."'")->select('*', DB::raw("DATE_FORMAT(TX_STOCK_SUM_DATE, '%d') as DATE"))->orderBy('TX_STOCK_SUM_DATE', 'ASC')->get();
        
        $data['table'] = StockSummary::where(['TX_STOCK_SUM_STOCK_CODE'=>$kd_emiten])->whereRaw("DATE_FORMAT(TX_STOCK_SUM_DATE, '%m-%Y') = '".$month."'")->orderBy('TX_STOCK_SUM_DATE', 'ASC')->get();

        return ($data);
    }

    public function showSlider()
    {
        $data = Slider::where('SLIDER_DISPLAY',1)->orderby('SLIDER_SORT','ASC')->get();
        return $data;
    }

    public function client()
    {
        $data['title'] = 'Klien Kami';
        $data['clients'] = Client::all();
        return view('layouts.client.client', $data);
    }
}

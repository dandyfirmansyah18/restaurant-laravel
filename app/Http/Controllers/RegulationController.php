<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use App\Regulation, App\ArticleType;
use Storage, Auth;

class RegulationController extends Controller
{        
    public function regulationlist()
    {    	
        $drop_type = ArticleType::whereIn('ARTICLE_TYPE_ID', [3, 4])->get();
        $data['drop_type'] = $drop_type;
    	return view('admin.layouts.regulation.regulationlist',$data);
    }

    public function regulationdata()
    {
    	DB::statement(DB::raw('set @numrow:=0'));
    	$data = Regulation::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TX_REGULATION.*','TR_ARTICLE_TYPE.ARTICLE_TYPE_NAME')
                            ->leftjoin('TR_ARTICLE_TYPE','TR_ARTICLE_TYPE.ARTICLE_TYPE_ID','=','TX_REGULATION.REGULATION_TYPE_ID')
                            ->orderby('TX_REGULATION.REGULATION_ID','DESC')
                            ->get();   
    	return json_encode($data);
    }

    public function save()
    {               
        $tgljam = date('YmdHis');
        if (Input::get('act') == 'insert') {
            $directory = 'Regulation/'; 
            Storage::makeDirectory($directory, $mode = 0777, true, true);
            $path1 = 'Regulation/';
            $path2 = storage_path().'/app/'.$path1;
            @unlink($path2);

            $get_doc_file = Input::file('REGULATION_FILE');
            $doc_name = $get_doc_file->getClientOriginalName();
            $doc_extension = $get_doc_file->getClientOriginalExtension();
            $doc_size = $get_doc_file->getClientSize();

            $new_doc_name = $tgljam."-".str_random(10).".".$doc_extension;
            $doc_move = $get_doc_file->move($path2, $new_doc_name);

            $save = Regulation::create([
                'REGULATION_NUMBER' => Input::get('REGULATION_NUMBER'),
                // 'REGULATION_DESC' => Input::get('REGULATION_CONTENT'),
                'REGULATION_DESC' => Input::get('REGULATION_DESC'),
                'REGULATION_STATUS' => Input::get('REGULATION_STATUS'), 
                'REGULATION_TYPE_ID' => Input::get('REGULATION_TYPE_ID'),                
                'REGULATION_FILE_PATH' => $path1.$new_doc_name,
                'CREATED_BY' => Auth::user()->USER_ID,
                // 'CREATED_AT' => date('Y-m-d H:i:s'),
            ]);

        }else {

            $id = Input::get('REGULATION_ID');                                    
            if (Input::file('REGULATION_FILE')) {
                $directory = 'Regulation/'; 
                Storage::makeDirectory($directory, $mode = 0777, true, true);
                $path1 = 'Regulation/';
                $path2 = storage_path().'/app/'.$path1;
                @unlink($path2);

                $get_doc_file = Input::file('REGULATION_FILE');
                $doc_name = $get_doc_file->getClientOriginalName();
                $doc_extension = $get_doc_file->getClientOriginalExtension();
                $doc_size =$get_doc_file->getClientSize();

                $new_doc_name = $tgljam."-".str_random(10).".".$doc_extension;
                $doc_move = $get_doc_file->move($path2, $new_doc_name);

                $dokexist = Regulation::where(['REGULATION_ID'=>$id])->value('REGULATION_FILE_PATH');
                if ($dokexist) {
                    @unlink(storage_path().'/app/'.$dokexist);
                }

                $save = Regulation::where('REGULATION_ID', $id)
                            ->update([
                                'REGULATION_NUMBER' => Input::get('REGULATION_NUMBER'),
                                // 'REGULATION_DESC' => Input::get('REGULATION_CONTENT'),
                                'REGULATION_DESC' => Input::get('REGULATION_DESC'),
                                'REGULATION_STATUS' => Input::get('REGULATION_STATUS'),
                                'REGULATION_TYPE_ID' => Input::get('REGULATION_TYPE_ID'),                                
                                'REGULATION_FILE_PATH' => $path1.$new_doc_name,
                                'UPDATED_BY' => Auth::user()->USER_ID,                                
                        ]);
            }else{
                $save = Regulation::where('REGULATION_ID', $id)
                            ->update([
                                'REGULATION_NUMBER' => Input::get('REGULATION_NUMBER'),
                                // 'REGULATION_DESC' => Input::get('REGULATION_CONTENT'),
                                'REGULATION_DESC' => Input::get('REGULATION_DESC'),
                                'REGULATION_STATUS' => Input::get('REGULATION_STATUS'),
                                'REGULATION_TYPE_ID' => Input::get('REGULATION_TYPE_ID'),
                                'UPDATED_BY' => Auth::user()->USER_ID,                                
                        ]);                
            }            

        }

        if($save)
            return 'MSG#OK#Simpan Regulation berhasil.#';
        else
            return 'MSG#ERR#Simpan Regulation gagal.';
    }

    public function view()
    {
        $id = Input::get('regulation_id');
        $regulation = Regulation::where('REGULATION_ID', $id)->first();
        $drop_type = ArticleType::whereIn('ARTICLE_TYPE_ID', [3, 4])->get();
        $data['drop_type'] = $drop_type;
        $data['REGULATION'] = $regulation;

        if ($regulation->REGULATION_FILE_PATH) {            
            $name_file = explode('/', $regulation->REGULATION_FILE_PATH);
            $name_file = end($name_file);            
        }else{
            $name_file = '';
        }
        $data['REGULATION']['NAME_FILE'] = $name_file;
        return view('admin/layouts/regulation/formregulation', $data);
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

    public function activate()
    {
        $id = Input::get('regulation_id');
        $status = Input::get('status');
        
        if($status == 1)
            $msg = 'Aktivasi';
        else
            $msg = 'Non Aktivasi';
            
        $activate = Regulation::where('REGULATION_ID', $id)->update(['REGULATION_STATUS'=>$status]);

        if($activate)
            return 'MSG#OK#'.$msg.' regulation berhasil.#';
        else
            return 'MSG#ERR#'.$msg.' regulation gagal.';
    }

}

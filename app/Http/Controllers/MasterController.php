<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response, Auth, Storage, DB, File;
use Illuminate\Support\Facades\Input;
use App\KindOfMenu, App\Table, App\Menu;

class MasterController extends Controller
{        
    public function masterlist($type='')
    {
        if ($type=='kom') {
    	    return view('admin.layouts.master.komlist');
        }elseif ($type == 'menu'){
            $dropdown = KindOfMenu::get();
            $data['kom'] = $dropdown;
            return view('admin.layouts.master.menulist', $data);
        }elseif ($type == 'table'){
            return view('admin.layouts.master.tablelist');
        }
    }

    public function masterdata($type='')
    {
    	DB::statement(DB::raw('set @numrow:=0'));
        if ($type == 'kom') {
            $data = KindOfMenu::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TR_KIND_MENU.*')
                        ->orderby('KIND_MENU_ID','ASC')->get();
        }elseif ($type == 'menu') {        
            $data = Menu::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TM_MENU.*')
                        ->orderby('MENU_ID','ASC')->get();
        }elseif ($type == 'table') {
            $data = Table::select(DB::raw('(@numrow:=@numrow + 1) AS row_number'),'TR_TABLE.*')
                        ->orderby('TABLE_NO','ASC')->get();
        }
    	return json_encode($data);    	
    }

    public function save($type='')
    {
        $tgljam = date('YmdHis');
        if (Input::get('act') == 'insert') {
            if ($type == 'kom') {                
                $save = KindOfMenu::create([                    
                    'KIND_MENU_NAME' => Input::get('KIND_MENU_NAME')
                ]);
            }elseif ($type == 'table'){
                $save = Table::create([                    
                    'TABLE_NO' => Input::get('TABLE_NO'),
                    'TABLE_PEOPLE_MAX' => Input::get('TABLE_PEOPLE_MAX'),                    
                ]);
            }elseif ($type == 'menu') {                
                $directory = '/files/MenuImage/'; 
                File::makeDirectory($directory, $mode = 0777, true, true);
                $path1 = '/files/MenuImage/';
                $path2 = public_path().$path1;
                @unlink($path2);

                $get_doc_file = Input::file('PHOTO');
                $doc_name = $get_doc_file->getClientOriginalName();
                $doc_extension = $get_doc_file->getClientOriginalExtension();
                $doc_size =$get_doc_file->getClientSize();

                $new_doc_name = $tgljam."-".str_replace(' ','',Input::get('MENU_NAME')).".".$doc_extension;
                $doc_move = $get_doc_file->move($path2, $new_doc_name);

                $save = Menu::create([
                    'MENU_NAME' => Input::get('MENU_NAME'),
                    'PRICE' => Input::get('PRICE'),
                    'PHOTO' => $path1.$new_doc_name,
                    'KIND_MENU_ID' => Input::get('KIND_MENU_ID'),
                    // 'CREATED_AT' => date('Y-m-d H:i:s'),
                ]);

            }
        }else{            
            if ($type == 'kom') {
                $id = Input::get('KIND_MENU_ID');
                $save = KindOfMenu::where('KIND_MENU_ID', $id)
                    ->update([
                        'KIND_MENU_NAME' => Input::get('KIND_MENU_NAME'),                        
                ]);
            }elseif ($type == 'table'){
                $id = Input::get('TABLE_ID');
                $save = Table::where('TABLE_ID', $id)
                    ->update([
                        'TABLE_NO' => Input::get('TABLE_NO'),
                        'TABLE_PEOPLE_MAX' => Input::get('TABLE_PEOPLE_MAX')
                ]);
            }elseif ($type == 'menu') {
                $id = Input::get('MENU_ID');
                if (Input::file('PHOTO')) {
                    $directory = '/files/MenuImage/';
                    File::makeDirectory($directory, $mode = 0777, true, true);
                    $path1 = '/files/MenuImage/';
                    $path2 = public_path().$path1;
                    @unlink($path2);

                    $get_doc_file = Input::file('PHOTO');
                    $doc_name = $get_doc_file->getClientOriginalName();
                    $doc_extension = $get_doc_file->getClientOriginalExtension();
                    $doc_size =$get_doc_file->getClientSize();

                    $new_doc_name = $tgljam."-".str_replace(' ','',Input::get('MENU_NAME')).".".$doc_extension;
                    $doc_move = $get_doc_file->move($path2, $new_doc_name);

                    $dokexist = Menu::where(['MENU_ID'=>$id])->value('PHOTO');
                    if ($dokexist) {
                        @unlink(public_path().$dokexist);
                    }


                    $save = Menu::where('MENU_ID', $id)
                                ->update([
                                    'MENU_NAME' => Input::get('MENU_NAME'),
                                    'PRICE' => Input::get('PRICE'),
                                    'PHOTO' => $path1.$new_doc_name,                                    
                                    'KIND_MENU_ID' => Input::get('KIND_MENU_ID'),
                            ]);
                }else{
                    $save = Menu::where('MENU_ID', $id)
                                ->update([
                                    'MENU_NAME' => Input::get('MENU_NAME'),
                                    'PRICE' => Input::get('PRICE'),                                    
                                    'KIND_MENU_ID' => Input::get('KIND_MENU_ID'),
                            ]);               
                }
            }
        } 

        if ($type=='kom') {
            $caption = 'Kind Of Menu';
        }elseif ($type == 'table'){
            $caption = 'Master Table';
        }elseif ($type == 'menu'){
            $caption = 'Master Menu ';
        }

        if($save)
            return 'MSG#OK#Simpan '.$caption.' berhasil.#';
        else
            return 'MSG#ERR#Simpan '.$caption.' gagal.';
    }

    public function view($type='')
    {
        if ($type == 'kom') {            
            $id = Input::get('KIND_MENU_ID');            
            $kindofmenu = KindOfMenu::where('KIND_MENU_ID', $id)->first();        
            $data['KIND_MENU'] = $kindofmenu;
            return view('admin/layouts/master/formkom', $data);
        }elseif ($type == 'table'){
            $id = Input::get('TABLE_ID');            
            $tablemaster = Table::where('TABLE_ID', $id)->first();        
            $data['TABLE'] = $tablemaster;
            return view('admin/layouts/master/formtable', $data);
        }elseif ($type == 'menu') {
            $id = Input::get('MENU_ID');            
            $menumaster = Menu::where('MENU_ID', $id)->first();  
            $dropdown = KindOfMenu::get();
            $data['kom'] = $dropdown;      
            $data['MENU'] = $menumaster;
            return view('admin/layouts/master/formmenu', $data);
        }
    }

    public function delete($type)
    {
        if ($type == 'kom') {
            $id = Input::get('KIND_MENU_ID');
            $delete = KindOfMenu::where('KIND_MENU_ID', $id)->delete();
        }elseif ($type == 'table') {
            $id = Input::get('TABLE_ID');
            $delete = Table::where('TABLE_ID', $id)->delete();
        }elseif ($type == 'menu') {
            $id = Input::get('MENU_ID');
            $dokexist = Menu::where(['MENU_ID'=>$id])->value('PHOTO');
            if ($dokexist) {
                @unlink(public_path().$dokexist);
            }
            $delete = Menu::where('MENU_ID', $id)->delete();
        }

        if ($type=='kom') {
            $caption = 'Kind Of Menu';
        }elseif ($type == 'table'){
            $caption = 'Master Table';
        }elseif ($type == 'Menu'){
            $caption = 'Master Menu ';
        }


        if($delete)
            return 'MSG#OK#Hapus '.$caption.' berhasil.#';
        else
            return 'MSG#ERR#Hapus '.$caption.' gagal.';
    }

}

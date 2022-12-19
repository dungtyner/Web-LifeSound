<?php

namespace App\Http\Controllers\Backend\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Session;

class BankAdminController extends Controller
{
    function showUpdateBank($id_Bank) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataBank = DB::table('bank')
            ->where(['id_Bank' => $id_Bank])
            ->get(
                array(
                    'id_Bank',
                    'name_Bank',
                    'number_Bank',
                    'name_user_Bank',
                    'image_background_bank'
                )
            )[0];

            return view('adminAD.Bank.update-bank')
            ->with(['dataBank'=>$dataBank]);
        }else{
            return Redirect::to('/admin');
        }
    }
    function updateBank(Request $request) {
        $image_background_bank = $request->file('image_background_bank');
        // dd($url_event);
        if($image_background_bank){

             // unlink image news
            $res_Image_News = DB::table('bank')->where('id_Bank', $request->id_Bank)->get(['image_background_bank']);
            $path_Image = ($res_Image_News[0]->image_background_bank);

            $path_Image = ltrim($path_Image, '/');

            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }


            $get_name_image = $image_background_bank->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$image_background_bank->getClientOriginalExtension();
            $image_background_bank->move('upload/Bank/',$new_image);
            $new_link_image = '/upload/Bank/'.$new_image;
            $image_background_bank = $new_link_image;
            $result = DB::table('bank')
            ->where(['id_Bank'=> $request->id_Bank])
            ->update([
                'name_Bank'=>$request->name_Bank,
                'number_Bank' => $request->number_Bank,
                'name_user_Bank' => $request->name_user_Bank,
                'image_background_bank' => $image_background_bank
            ]);
            return $result;
        } else {
            $result = DB::table('bank')
            ->where(['id_Bank'=> $request->id_Bank])
            ->update([
                'name_Bank'=>$request->name_Bank,
                'number_Bank' => $request->number_Bank,
                'name_user_Bank' => $request->name_user_Bank
            ]);
            return $result;
        }
        return Redirect::to('admin/bank/show-update-bank/'. $request->id_Bank .'');
    }
}

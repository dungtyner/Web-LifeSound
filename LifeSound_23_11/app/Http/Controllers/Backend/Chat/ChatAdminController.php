<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class ChatAdminController extends Controller
{
    function showChat($id_send) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $resultAccount = DB::table('accounts')
            ->where(['id_account' => $id_send])
            ->get(
                array(
                    'id_account',
                    'fname',
                    'url_avatar_account'
                    )
            )->first();



            return view('adminAD.Chat.show-chat')
            ->with(['resultAccount' => $resultAccount]);
        }else{
            return Redirect::to('/admin');
        }
    }


    function saveChat(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $id_account =  $request->id_account;
            $data_mess =  $request->data_mess;
            

            $resultData = DB::table('message')
            ->insert([
                'id_send' => '0',
                'id_receive' => $id_account,
                'mess_text' => $data_mess
            ]);


            return response()->json($resultData);
        }else{
            return Redirect::to('/admin');
        }
    }

    function loadChat($id_send) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $resultData = DB::table('message')
            ->where(['id_send' => $id_send, 'id_receive' => '0'])
            ->orWhere(function($query) use($id_send)
            {
                $query->where("id_send", '0')
                    ->where("id_receive", $id_send);
            })
            ->get(
                array(
                    'id_mess',
                    'id_send',
                    'id_receive',
                    'mess_text',
                    'mess_image',
                    'mess_time'
                    )
            );


            return response()->json($resultData);
        }else{
            return Redirect::to('/admin');
        }
    
    }


    function loadChatNotification() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataMessTemp = DB::table('message')
            ->where('id_send' , '<>', 0)
            ->groupBy('id_send')
            ->orderBy('id_mess', 'desc')
            ->limit(3)
            ->get('id_send');

            $dataMess = [];
            foreach ($dataMessTemp as $sub_dataMessTemp) {

                $mess = DB::table('message')
                ->where(['id_send' => $sub_dataMessTemp->id_send])
                ->orderBy('id_mess', 'desc')
                ->limit(1)
                ->get('mess_text')[0]->mess_text;
                if($mess != null || $mess != '') {
                    $sub_dataMessTemp->nameAccount = DB::table('accounts')
                    ->where(['id_account' => $sub_dataMessTemp->id_send])
                    ->get('fname')[0]->fname;
                    $sub_dataMessTemp->lastMess =  substr($mess, 0, 15).'...';
            
            
                    $dataMess[count($dataMess)] = $sub_dataMessTemp;
                } else {
                    $sub_dataMessTemp->lastMess =  'Đã gửi 1 ảnh...';
                    $sub_dataMessTemp->nameAccount = DB::table('accounts')
                    ->where(['id_account' => $sub_dataMessTemp->id_send])
                    ->get('fname')[0]->fname;
            
            
                    $dataMess[count($dataMess)] = $sub_dataMessTemp;
                }

            }


            return response()->json($dataMess);
        }else{
            return Redirect::to('/admin');
        }
    


        
    }
}

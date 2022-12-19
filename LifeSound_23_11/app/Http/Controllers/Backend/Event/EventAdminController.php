<?php

namespace App\Http\Controllers\Backend\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Session;

class EventAdminController extends Controller
{
    function showUpdateEvent() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataEvent = DB::table('code_sale')
            ->where(['id_code_sale' => 1])
            ->get(
                array(
                    'id_code_sale',
                    'status_event',
                    'code_sale',
                    'value_sale',
                    'description_event',
                    'url_event',
                    'date_event'
                )
            )[0];

            return view('adminAD.Event.update-event')
            ->with(['dataEvent'=>$dataEvent]);
        }else{
            return Redirect::to('/admin');
        }
    }

    function updateEvent(Request $request) {
        $url_event = $request->file('url_event');
        // dd($url_event);
        if($url_event){

             // unlink image news
            $res_Image_News = DB::table('code_sale')->where('id_code_sale', 1)->get(['url_event']);
            $path_Image = ($res_Image_News[0]->url_event);

            $path_Image = ltrim($path_Image, '/');

            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }


            $get_name_image = $url_event->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$url_event->getClientOriginalExtension();
            $url_event->move('upload/Event/',$new_image);
            $new_link_image = '/upload/Event/'.$new_image;
            $url_event = $new_link_image;
            $result = DB::table('code_sale')
            ->where(['id_code_sale'=> 1])
            ->update([
                'code_sale' => $request->code_sale,
                'status_event'=>$request->status_event,
                'value_sale' => $request->value_sale,
                'description_event' => $request->description_event,
                'date_event' => $request->date_event,
                'url_event' => $url_event
            ]);

            $sub_String = substr($request->description_event, 0, strlen('Life Sound vừa cập'));

            // dd($request->status_event);

            if($request->status_event == 'Hiện') {
                $notification = DB::table('notification_page')->insert([
                    'notification_object' => 0,
                    'notification_type' => 'notification_all',
                    'notification_avt' => '/images/owl.png',
                    'notification_title' => 'Thông Báo Sự Kiện',
                    'notification_content' => 'Life Sound vừa cập nhật sự kiện mới: '.$sub_String.'...'
                ]);
            } else {
                $notification = DB::table('notification_page')->insert([
                    'notification_object' => 0,
                    'notification_type' => 'notification_all',
                    'notification_avt' => '/images/owl.png',
                    'notification_title' => 'Thông Báo Sự Kiện',
                    'notification_content' => 'Life Sound vừa kết thúc sự kiện.'
                ]);
            }


            return response()->json(['rs'=>$sub_String]);
        } else {
            $result = DB::table('code_sale')
            ->where(['id_code_sale'=> 1])
            ->update([
                'code_sale' => $request->code_sale,
                'status_event'=>$request->status_event,
                'value_sale' => $request->value_sale,
                'description_event' => $request->description_event,
                'date_event' => $request->date_event
            ]);

            $sub_String = substr($request->description_event, 0, strlen('Life Sound vừa cập'));


            if($request->status_event == 'Hiện') {
                $notification = DB::table('notification_page')->insert([
                    'notification_object' => 0,
                    'notification_type' => 'notification_all',
                    'notification_avt' => '/images/owl.png',
                    'notification_title' => 'Thông Báo Sự Kiện',
                    'notification_content' => 'Life Sound vừa cập nhật sự kiện mới: '.$sub_String.'...'
                ]);
            } else {
                $notification = DB::table('notification_page')->insert([
                    'notification_object' => 0,
                    'notification_type' => 'notification_all',
                    'notification_avt' => '/images/owl.png',
                    'notification_title' => 'Thông Báo Sự Kiện',
                    'notification_content' => 'Life Sound vừa kết thúc sự kiện.'
                ]);
            }

            return $result;
        }
        // return Redirect::to('admin/event/update-event');
    }
}

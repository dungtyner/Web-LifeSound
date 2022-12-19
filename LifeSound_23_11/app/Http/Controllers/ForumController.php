<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class ForumController extends Controller
{
    function index()
    {
        if(isset($_SESSION['id_loginEd'])) {
            $dataForum = DB::table('notification_page')
            ->where(['notification_object' => 0])
            ->orWhere(['notification_object' => $_SESSION['id_loginEd']])
            ->orderBy('id_notification', 'desc')
            ->get(
                array(
                    'id_notification',
                    'notification_object',
                    'notification_type',
                    'notification_avt',
                    'notification_title',
                    'notification_content',
                    'notification_date',
                    'id_comment'
                    )    
                );

            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $limit = 5;
            $start = ($page - 1) * $limit;    
            $total_content = count($dataForum);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }

            $listDataForum = DB::table('notification_page')
            ->where(['notification_object' => 0])
            ->orWhere(['notification_object' => $_SESSION['id_loginEd']])
            ->orderBy('id_notification', 'desc')
            ->offset($start)->limit($limit)
            ->get(
                array(
                    'id_notification',
                    'notification_object',
                    'notification_type',
                    'notification_avt',
                    'notification_title',
                    'notification_content',
                    'notification_date',
                    'id_comment'
                    )    
                );
            
            $dataForum = [];
            foreach($listDataForum as $sublistDataForum) {
                $sublistDataForum->id_product = DB::table('comment_product')
                ->where(['id_comment' => $sublistDataForum->id_comment ])
                ->get('id_product')->first();

                $dataForum[count($dataForum)] = $sublistDataForum;
            }
            
            
            
            return view('product.indexForum')
            ->with(['dataForum'=> $dataForum ])
            ->with(['page'=>'Forum'])
            ->with(['total_page'=>$total_page]);

        } else {
            $dataForum = DB::table('notification_page')
            ->where(['notification_object' => 0])
            ->orderBy('id_notification', 'desc')
            ->get(
                array(
                    'id_notification',
                    'notification_object',
                    'notification_type',
                    'notification_avt',
                    'notification_content',
                    'notification_title',
                    'notification_date'
                    )    
                );

            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $limit = 5;
            $start = ($page - 1) * $limit;    
            $total_content = count($dataForum);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }

            $dataForum = DB::table('notification_page')
            ->where(['notification_object' => 0])
            ->orderBy('id_notification', 'desc')
            ->offset($start)->limit($limit)
            ->get(
                array(
                    'id_notification',
                    'notification_object',
                    'notification_type',
                    'notification_avt',
                    'notification_content',
                    'notification_title',
                    'notification_date'
                    )    
                );
        
            return view('product.indexForum')
            ->with(['dataForum'=> $dataForum ])
            ->with(['page'=>'Forum'])
            ->with(['total_page'=>$total_page]);

        }
    }
}

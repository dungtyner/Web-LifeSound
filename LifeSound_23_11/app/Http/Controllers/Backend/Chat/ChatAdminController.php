<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class ChatAdminController extends Controller
{
    function showChat() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){




            return view('adminAD.Chat.show-chat');
        }else{
            return Redirect::to('/admin');
        }
    }
}

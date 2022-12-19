<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventPageController extends Controller
{
    function index() {

        $dataEvent = DB::table('code_sale')
        ->where(['id_code_sale'=> 1])
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


        return view('product.indexEventPage')
        ->with(['dataEvent'=>$dataEvent])
        ->with(['page'=> 'Event']);
    }
}

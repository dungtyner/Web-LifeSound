<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    function indexOrderInformation()
    {
        return view('product.index',['page'=>'Order Detail']);
    }
    function indexOrderDetail()
    {
        return view('product.index',['page'=>'Order Information']);

    }
    function getDataOrderInformation() 
    {
        $obj_dataOrderInfo = DB::table('order_information')->where(
            'id_account',
            '=',
            $_SESSION['id_loginEd']
        )->get(
            array(
                'id_order_infomation',
                'id_account',
                'date_order',
                'name_product',
                'unit_price',
                'count'
            )
        );
        dd($obj_dataOrderInfo);

        return $obj_dataOrderInfo;

        

    }

    function getDataLocalCustomer() {
        $obj_Local= DB::table('local_accounts')->where(
            'id_account',
            '=',
            $_SESSION['id_loginEd']
            )->get(
                array(
                    'name_account'
                    ,'local_account'
                    ,'email_account'	
                    ,'phone_account'
                    )
            );

        // dd(json_decode($obj_Local)[0]);

        return json_decode($obj_Local)[0];
    }

    function getDataBank() {
        $obj_Bank= DB::table('bank')->get(
                array(
                    'name_Bank'
                    ,'number_Bank'
                    ,'name_user_Bank'
                    )
            );

        // dd(json_decode($obj_Local)[0]);

        return json_decode($obj_Bank)[0];
    }
}

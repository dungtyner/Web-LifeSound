<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

session_start();
class OrderController extends Controller
{
    function indexOrderDetail()
    {
        // dd($_SESSION['id_loginEd']);
        if (isset($_SESSION['id_loginEd'])) {
            $result = DB::table('order_information')->where(
                'id_account',
                '=',
                $_SESSION['id_loginEd']
            )->where(['status'=>'Đang xử lý'])->get(
                array(
                    'id_order_infomation'
                )
            );
            if (count(
                $result
            ) > 0) {
                $dataYourOrdered = OrderController::getDataOrderDetail();
                $dataYourLocal = OrderController::getDataLocalCustomer();
                // $dataProvince = DB::table('province')->select('id', '_name')->get();

                return view('product.indexOrderDetail',
                ['page'=>'Order Detail',
                'dataYourOrdered'=>$dataYourOrdered, 
                'dataYourLocal'=>$dataYourLocal, 

                ]);

                // return view('product.indexPayment',
                //     ['page' => 'Payment'
                //     ,'dataYourOdered'=>$dataYourOdered
                //     ,'dataYourLocal'=>$dataYourLocal
                //     ,'dataBank' => $dataBank
                //     ,'dataProvince' => $dataProvince] 
                // );
            } else return view('product.pleaseLogin', [
                'page' => 'PleaseLogin', 'mess' => 'Đơn hàng trống, Mua tai nghe đi hahaha.'
            ]);
            // return view('product.indexOrderDetail',
            //     ['page'=>'Order Detail']);
        } else {
            return view('product.pleaseLogin', [
                'page' => 'PleaseLogin', 'mess' => 'Đăng nhập đi, rồi mới xem được.'
            ]);
        }
    }
    function indexOrderInformation()
    {
        if (isset($_SESSION['id_loginEd'])) {
            $result = DB::table('order_information')->where(
                'id_account',
                '=',
                $_SESSION['id_loginEd']
            )->get(
                array(
                    'id_order_infomation'
                )
            );
            if (count(
                $result
            ) > 0) {

                $dataYourOrderInformation = OrderController::getDataOrderInformation();
                // $dataYourLocal = OrderController::getDataLocalCustomer();

                // return view('product.indexOrderDetail',
                // ['page'=>'Order Detail',
                // 'dataYourOrdered'=>$dataYourOrdered, 
                // 'dataYourLocal'=>$dataYourLocal, 
                // ]);

                return view('product.indexOrderInformation',['page'=>'Order Information','dataYourOrderInformation'=>$dataYourOrderInformation]);

            } else return view('product.pleaseLogin', [
                'page' => 'PleaseLogin', 'mess' => 'Bạn chưa đặt cái gì mà đòi xem.'
            ]);
            // return view('product.indexOrderDetail',
            //     ['page'=>'Order Detail']);
        } else {
            return view('product.pleaseLogin', [
                'page' => 'PleaseLogin', 'mess' => 'Đăng nhập đi, rồi mới xem được.'
            ]);
        }


    }


// PROCESS ORDER
    function cancelOrderDetail(Request $request) {
        $id_order_infomation = $request->id_order_infomation;
        // dd($id_order_infomation);
        $obj_dataOrderInfo = DB::table('order_information')
        ->where(['id_order_infomation'=>$id_order_infomation])
        ->update(['status' => 'Đã hủy']);

        $id_account = DB::table('accounts')
        ->where(['id_account' => $_SESSION['id_loginEd']])
        ->get(
            array(
                'fname',
                'url_avatar_account'
                )
        );

        $notification = DB::table('notification_page')->insert([
            'notification_object' => -1,
            'notification_type' => 'notification_admin_cancel_order',
            'notification_avt' => $id_account[0]->url_avatar_account,
            'notification_title' => 'Hủy Đơn Hàng',
            'notification_content' => $id_account[0]->fname.' vừa hủy đơn hàng: '.$id_order_infomation
        ]);

        return $obj_dataOrderInfo;
    }
    function returnOrderDetail() {
        // dd($_SESSION['id_loginEd']);
        if (isset($_SESSION['id_loginEd'])) {
            $result = DB::table('order_information')->where(
                'id_account',
                '=',
                $_SESSION['id_loginEd']
            )->where(['status'=>'Đang xử lý'])->get(
                array(
                    'id_order_infomation'
                )
            );
            if (count(
                $result
            ) > 0) {
                $dataYourOrdered = OrderController::getDataOrderInformation();
                $dataYourLocal = OrderController::getDataLocalCustomer();
                // $dataProvince = DB::table('province')->select('id', '_name')->get();

                return view('product.indexOrderDetail',
                ['page'=>'Order Detail',
                'dataYourOrdered'=>$dataYourOrdered, 
                'dataYourLocal'=>$dataYourLocal, 
                'messToast'=> 'Xóa đơn hàng thành công.'

                ]);

                // return view('product.indexPayment',
                //     ['page' => 'Payment'
                //     ,'dataYourOdered'=>$dataYourOdered
                //     ,'dataYourLocal'=>$dataYourLocal
                //     ,'dataBank' => $dataBank
                //     ,'dataProvince' => $dataProvince] 
                // );
            } else return view('product.pleaseLogin', [
                'page' => 'PleaseLogin', 'mess' => 'Đơn hàng trống, Mua tai nghe đi hahaha.', 'messToast'=> 'Hủy đơn hàng thành công.'
            ]);
            // return view('product.indexOrderDetail',
            //     ['page'=>'Order Detail']);
        } else {
            return view('product.pleaseLogin', [
                'page' => 'PleaseLogin', 'mess' => 'Đăng nhập đi, rồi mới xem được.'
            ]);
        }
    }


// GET DATA ORDER INFORMATION 
    function getDataOrderInformation() 
    {
        $obj_dataOrderInfo = DB::table('order_information')->select('id_order_infomation')->where(
            'id_account',
            '=',
            $_SESSION['id_loginEd']
        )->where(['status'=>'Đang giao hàng'])->groupBy('id_order_infomation')->orderBy('id_primary','desc')->get();
        
        // dd($obj_dataOrderInfo);

        $obj_listDataDetail = [];
        $count = 0;
        foreach($obj_dataOrderInfo as $sub_obj_dataOrderInfo ) {
            $obj_dataDetail = new stdClass();

            $obj_subListData = DB::table('order_information')->where(
                'id_order_infomation',
                '=',
                $sub_obj_dataOrderInfo->id_order_infomation
            )->get(
                array(
                    'id_order_infomation'
                    ,'id_account'
                    ,'date_order'
                    ,'id_product'
                    ,'name_product'
                    ,'unit_price'
                    ,'count'
                    ,'shipping'
                    ,'sale'
                    ,'payment'
                    ,'local_order'
                    ,'status'
                )
            );
            $obj_dataDetail->id_order_infomation = $obj_subListData[0]->id_order_infomation;
            $obj_dataDetail->id_account = $obj_subListData[0]->id_account;
            $obj_dataDetail->date_order = $obj_subListData[0]->date_order;
            $obj_dataDetail->shipping = $obj_subListData[0]->shipping;
            $obj_dataDetail->sale = $obj_subListData[0]->sale;
            $obj_dataDetail->payment = $obj_subListData[0]->payment;
            $obj_dataDetail->local_order = $obj_subListData[0]->local_order;
            $obj_dataDetail->status = $obj_subListData[0]->status;
            $obj_dataDetail->totalPrice = 0;
            
            $subCount = 0;
            foreach($obj_subListData as $sub_obj_subListData) {
                $obj_subdataProduct = new stdClass();
                
                $obj_subdataProduct->id_product = $sub_obj_subListData->id_product;
                $obj_subdataProduct->name_product = $sub_obj_subListData->name_product;
                $obj_subdataProduct->unit_price = $sub_obj_subListData->unit_price;
                $obj_subdataProduct->count = $sub_obj_subListData->count;

                $obj_dataDetail->listProductOrder[$subCount] = $obj_subdataProduct;
                $subCount = $subCount + 1;

                $obj_dataDetail->totalPrice = $obj_dataDetail->totalPrice + $obj_subdataProduct->unit_price * $obj_subdataProduct->count;
            }

            $obj_dataDetail->countProduct = $subCount + 1;

            $obj_dataDetail->totalPriceFinal = $obj_dataDetail->totalPrice + $obj_dataDetail->shipping - $obj_dataDetail->sale;

            $dataBank = OrderController::getDataBank($obj_dataDetail->payment);
            $obj_dataDetail->dataBank = $dataBank;






            $obj_listDataDetail[$count] = $obj_dataDetail; 
            $count = $count + 1;
        }




        // dd($obj_listDataDetail);
        return $obj_listDataDetail;
    }



// GET DATA ORDER DETAIL
    function getDataOrderDetail() 
    {
        $obj_dataOrderInfo = DB::table('order_information')->select('id_order_infomation')->where(
            'id_account',
            '=',
            $_SESSION['id_loginEd']
        )->where(['status'=>'Đang xử lý'])->groupBy('id_order_infomation')->orderBy('id_primary', 'desc')->get();
        
        // dd($obj_dataOrderInfo);

        $obj_listDataDetail = [];
        $count = 0;
        foreach($obj_dataOrderInfo as $sub_obj_dataOrderInfo ) {
            $obj_dataDetail = new stdClass();

            $obj_subListData = DB::table('order_information')->where(
                'id_order_infomation',
                '=',
                $sub_obj_dataOrderInfo->id_order_infomation
            )->get(
                array(
                    'id_order_infomation'
                    ,'id_account'
                    ,'date_order'
                    ,'id_product'
                    ,'name_product'
                    ,'unit_price'
                    ,'count'
                    ,'shipping'
                    ,'sale'
                    ,'payment'
                    ,'local_order'
                    ,'status'
                )
            );
            $obj_dataDetail->id_order_infomation = $obj_subListData[0]->id_order_infomation;
            $obj_dataDetail->id_account = $obj_subListData[0]->id_account;
            $obj_dataDetail->date_order = $obj_subListData[0]->date_order;
            $obj_dataDetail->shipping = $obj_subListData[0]->shipping;
            $obj_dataDetail->sale = $obj_subListData[0]->sale;
            $obj_dataDetail->payment = $obj_subListData[0]->payment;
            $obj_dataDetail->local_order = $obj_subListData[0]->local_order;
            $obj_dataDetail->status = $obj_subListData[0]->status;
            $obj_dataDetail->totalPrice = 0;
            
            $subCount = 0;
            foreach($obj_subListData as $sub_obj_subListData) {
                $obj_subdataProduct = new stdClass();
                
                $obj_subdataProduct->id_product = $sub_obj_subListData->id_product;
                $obj_subdataProduct->name_product = $sub_obj_subListData->name_product;
                $obj_subdataProduct->unit_price = $sub_obj_subListData->unit_price;
                $obj_subdataProduct->count = $sub_obj_subListData->count;

                $obj_dataDetail->listProductOrder[$subCount] = $obj_subdataProduct;
                $subCount = $subCount + 1;

                $obj_dataDetail->totalPrice = $obj_dataDetail->totalPrice + $obj_subdataProduct->unit_price * $obj_subdataProduct->count;
            }

            $obj_dataDetail->countProduct = $subCount;

            $obj_dataDetail->totalPriceFinal = $obj_dataDetail->totalPrice + $obj_dataDetail->shipping - $obj_dataDetail->sale;

            $dataBank = OrderController::getDataBank($obj_dataDetail->payment);
            $obj_dataDetail->dataBank = $dataBank;






            $obj_listDataDetail[$count] = $obj_dataDetail; 
            $count = $count + 1;
        }




        // dd($obj_listDataDetail);
        return $obj_listDataDetail;
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
    function getDataBank($nameBank) {
        $obj_Bank= DB::table('bank')->where(['name_Bank'=>$nameBank])->first();
        // dd($obj_Bank);

        return $obj_Bank;
    }
}

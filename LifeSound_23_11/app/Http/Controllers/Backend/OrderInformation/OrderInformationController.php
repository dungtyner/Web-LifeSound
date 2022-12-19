<?php

namespace App\Http\Controllers\Backend\OrderInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use stdClass;

class OrderInformationController extends Controller
{
    function index() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataOrderInfo = OrderInformationController::getDataOrderInformation();

            return view('adminAD.OrderInformation.indexOrderProcessing')
            ->with('dataOrderInfo', $dataOrderInfo);
        }else{
            return Redirect::to('/admin');
        }
    }
    function showOrderDelivery() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataOrderInfo = OrderInformationController::getDataOrderDelivery();

            return view('adminAD.OrderInformation.indexOrderDelivery')
            ->with('dataOrderInfo', $dataOrderInfo);
        }else{
            return Redirect::to('/admin');
        }
    }
    function showOrderDeteil($id_order_infomation) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            // $id_order_infomation = $_GET['id_order_infomation'];
            $dataOrderInfo = OrderInformationController::getDataDetail($id_order_infomation);

            return view('adminAD.OrderInformation.indexDetailOrder')
            ->with('dataOrderInfo', $dataOrderInfo);
        }else{
            return Redirect::to('/admin');
        }
    }



    // confirm Delivery
    function confirmDelivery(Request $request) {
    
        $id_order_infomation  = $request->id_order_infomation;

            // update count 
            $id_product_has_color_plug = DB::table('order_information')->where(
                'id_order_infomation',
                '=',
                $id_order_infomation
            )->get(array('id_product_has_color_plug','count'));

            // dd($id_product_has_color_plug);

            foreach($id_product_has_color_plug as $sub_id_product_has_color_plug) {
                $count_Product = DB::table('product_has_color_plug')->where(
                    'id_product_has_color_plug',
                    '=',
                    $sub_id_product_has_color_plug->id_product_has_color_plug
                )->get('quantity_product_has')->first()->quantity_product_has;

                $count_Product = $count_Product - $sub_id_product_has_color_plug->count;

                $update_Count = DB::table('product_has_color_plug')->where(
                    'id_product_has_color_plug',
                    '=',
                    $sub_id_product_has_color_plug->id_product_has_color_plug
                )->update(['quantity_product_has'=>$count_Product]);

                // dd($count_Product);
            }

        // update count

        $id_account = DB::table('order_information')->where(
            'id_order_infomation',
            '=',
            $id_order_infomation
        )->get(array('id_account', 'id_order_infomation'));

        $notification = DB::table('notification_page')->insert([
            'notification_object' => $id_account[0]->id_account,
            'notification_type' => 'delivery',
            // 'notification_avt' => '/images/owl.png',
            'notification_title' => 'Thông Báo Đơn Hàng Của Bạn',
            'notification_content' => 'Đơn hàng: '. $id_account[0]->id_order_infomation . ' của bạn đang được vận chuyển'
        ]);

        
        $result = DB::table('order_information')
        ->where(['id_order_infomation'=>$id_order_infomation])
        ->update(['status'=>'Đang giao hàng']);

        return $result;
    }
    // confirm Success
    function confirmSuccess(Request $request) {
        $id_order_infomation  = $request->id_order_infomation;

        $result = DB::table('order_information')
        ->where(['id_order_infomation'=>$id_order_infomation])
        ->update(['status'=>'Đã giao']);


        $id_account = DB::table('order_information')->where(
            'id_order_infomation',
            '=',
            $id_order_infomation
        )->get(array('id_account', 'id_order_infomation'));
        
        $notification = DB::table('notification_page')->insert([
            'notification_object' => $id_account[0]->id_account,
            'notification_type' => 'success',
            // 'notification_avt' => '/images/owl.png',
            'notification_title' => 'Thông Báo Đơn Hàng Của Bạn',
            'notification_content' => 'Life Sound đơn hàng: '. $id_account[0]->id_order_infomation . ' của bạn đã giao đến tận nơi.'
        ]);

        return $result;
    }
    // delete ORDER befor delivery
    function cancelOrder($id_order_infomation) {
        // $id_order_infomation = $request->id_order_infomation;
        // dd($id_order_infomation);
        $obj_dataOrderInfo = DB::table('order_information')
        ->where(['id_order_infomation'=>$id_order_infomation])
        ->update(['status' => 'Đã hủy']);

        $id_account = DB::table('order_information')->where(
            'id_order_infomation',
            '=',
            $id_order_infomation
        )->get(array('id_account', 'id_order_infomation'));

        $notification = DB::table('notification_page')->insert([
            'notification_object' => $id_account[0]->id_account,
            'notification_type' => 'cancel',
            // 'notification_avt' => '/images/owl.png',
            'notification_title' => 'Thông Báo Đơn Hàng Của Bạn',
            'notification_content' => 'Life Sound đã hủy đơn hàng: '. $id_account[0]->id_order_infomation . ' của bạn.'
        ]);

        return back();
    }

    // delete ORDER after delivery
    function cancelOrderAfter($id_order_infomation) {
        

        // update count 

            $id_product_has_color_plug = DB::table('order_information')->where(
                'id_order_infomation',
                '=',
                $id_order_infomation
            )->get(array('id_product_has_color_plug','count'));

            // dd($id_product_has_color_plug);

            foreach($id_product_has_color_plug as $sub_id_product_has_color_plug) {
                $count_Product = DB::table('product_has_color_plug')->where(
                    'id_product_has_color_plug',
                    '=',
                    $sub_id_product_has_color_plug->id_product_has_color_plug
                )->get('quantity_product_has')->first()->quantity_product_has;

                $count_Product = $count_Product + $sub_id_product_has_color_plug->count;

                $update_Count = DB::table('product_has_color_plug')->where(
                    'id_product_has_color_plug',
                    '=',
                    $sub_id_product_has_color_plug->id_product_has_color_plug
                )->update(['quantity_product_has'=>$count_Product]);

                // dd($count_Product);
            }
        // update count

        $obj_dataOrderInfo = DB::table('order_information')->where(['id_order_infomation'=>$id_order_infomation])->delete();

        return back();
    }






    // get Data Order Details
    function getDataDetail($id_order_infomation) {
        $obj_dataDetail = new stdClass();

        $obj_subListData = DB::table('order_information')->where(
            'id_order_infomation',
            '=',
            $id_order_infomation
        )->get(
            array(
                'id_order_infomation'
                ,'id_account'
                ,'date_order'
                ,'id_product'
                ,'id_product_has_color_plug'
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
        $obj_dataDetail->id_product_has_color_plug = $obj_subListData[0]->id_product_has_color_plug;
        $obj_dataDetail->date_order = $obj_subListData[0]->date_order;
        $obj_dataDetail->shipping = $obj_subListData[0]->shipping;
        $obj_dataDetail->sale = $obj_subListData[0]->sale;
        $obj_dataDetail->payment = $obj_subListData[0]->payment;
        $obj_dataDetail->local_order = $obj_subListData[0]->local_order;
        $obj_dataDetail->status = $obj_subListData[0]->status;
        $obj_dataDetail->totalPrice = 0;
        
        $subCount = 0;
        foreach($obj_subListData as $sub_obj_subListData) {

            $individualProduct = DB::table('product_has_color_plug')
            ->where(['id_product_has_color_plug'=> $sub_obj_subListData->id_product_has_color_plug])
            ->get(
                array(
                    'id_color_product',
                    'id_plug_product',
                    )
                )[0];
            // dd($individualProduct);

            $subIndividualProductColor = DB::table('color_products')
            ->select('value_color_product')
            ->where(['id_color_product'=>$individualProduct->id_color_product])
            ->first()->value_color_product;
            // dd($subIndividualProductColor);

            $subIndividualProductPlug = DB::table('plug_products')
            ->select('value_plug_product')
            ->where(['id_plug_product'=>$individualProduct->id_plug_product])
            ->first()->value_plug_product;
            // dd($subIndividualProductPlug);


            $obj_subdataProduct = new stdClass();
            
            $obj_subdataProduct->id_product = $sub_obj_subListData->id_product;
            $obj_subdataProduct->name_product = $sub_obj_subListData->name_product;
            $obj_subdataProduct->unit_price = $sub_obj_subListData->unit_price;
            $obj_subdataProduct->count = $sub_obj_subListData->count;
            $obj_subdataProduct->color_product = $subIndividualProductColor;
            $obj_subdataProduct->plug_product = $subIndividualProductPlug;


            $obj_dataDetail->listProductOrder[$subCount] = $obj_subdataProduct;
            $subCount = $subCount + 1;

            $obj_dataDetail->totalPrice = $obj_dataDetail->totalPrice + $obj_subdataProduct->unit_price * $obj_subdataProduct->count;
        }

        $obj_dataDetail->countProduct = $subCount;

        $obj_dataDetail->totalPriceFinal = $obj_dataDetail->totalPrice + $obj_dataDetail->shipping - $obj_dataDetail->sale;

        $dataBank = OrderInformationController::getDataBank($obj_dataDetail->payment);
        $obj_dataDetail->dataBank = $dataBank;

        $obj_dataDetail->image_Account = DB::table('accounts')
        ->select('url_avatar_account')
        ->where(['id_account'=>$obj_dataDetail->id_account])->first()->url_avatar_account;

        $obj_dataDetail->customer = OrderInformationController::getDataLocalCustomer($obj_dataDetail->id_account);


        return $obj_dataDetail;
    }
    // get Data Order Process
    function getDataOrderDelivery() 
    {
        $obj_dataOrderInfo = DB::table('order_information')
        ->select('id_order_infomation')
        ->where(['status'=>'Đang giao hàng'])
        ->groupBy('id_order_infomation')
        ->orderBy('id_primary','desc')
        ->get();
        
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

            $dataBank = OrderInformationController::getDataBank($obj_dataDetail->payment);
            $obj_dataDetail->dataBank = $dataBank;

            $obj_dataDetail->image_Account = DB::table('accounts')
            ->select('url_avatar_account')
            ->where(['id_account'=>$obj_dataDetail->id_account])->first()->url_avatar_account;

            // dd($obj_dataDetail->image_Account);


            $obj_listDataDetail[$count] = $obj_dataDetail; 
            $count = $count + 1;
        }




        // dd($obj_listDataDetail);
        return $obj_listDataDetail;
    }
    // get Data Order Process
    function getDataOrderInformation() 
    {
        $obj_dataOrderInfo = DB::table('order_information')
        ->select('id_order_infomation')
        ->where(['status'=>'Đang xử lý'])
        ->groupBy('id_order_infomation')
        ->orderBy('id_primary','desc')
        ->get();
        
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

            $dataBank = OrderInformationController::getDataBank($obj_dataDetail->payment);
            $obj_dataDetail->dataBank = $dataBank;

            $obj_dataDetail->image_Account = DB::table('accounts')
            ->select('url_avatar_account')
            ->where(['id_account'=>$obj_dataDetail->id_account])->first()->url_avatar_account;

            // dd($obj_dataDetail->image_Account);


            $obj_listDataDetail[$count] = $obj_dataDetail; 
            $count = $count + 1;
        }




        // dd($obj_listDataDetail);
        return $obj_listDataDetail;
    }
    function getDataLocalCustomer($id_account) {
        $obj_Local= DB::table('local_accounts')->where(
            'id_account',
            '=',
            $id_account
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

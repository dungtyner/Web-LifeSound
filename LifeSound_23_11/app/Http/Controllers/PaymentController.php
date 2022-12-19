<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use stdClass;

session_start();
class PaymentController extends Controller
{
    function index()
    {
        // echo $_SESSION['id_loginEd'];
        if (isset($_SESSION['id_loginEd'])) {
            $result = DB::table('carts_product')->where(
                'id_cart',
                '=',
                $_SESSION['id_loginEd']
            )->get(
                array(
                    'id_cart_product'
                )
            );
            if (count(
                $result
            ) > 0) {
                $dataYourOdered = PaymentController::getDataProductForCart();
                $dataYourLocal = PaymentController::getDataLocalCustomer();
                $dataBank = PaymentController::getDataBank();
                $dataProvince = DB::table('province')->select('id', '_name')->get();

                // dd($dataProvince);
                // dd('hello');
                return view('product.indexPayment',
                    ['page' => 'Payment'
                    ,'dataYourOdered'=>$dataYourOdered
                    ,'dataYourLocal'=>$dataYourLocal
                    ,'dataBank' => $dataBank
                    ,'dataProvince' => $dataProvince] 
            );
            } else return view('product.pleaseLogin', [
                'page' => 'PleaseLogin', 'mess' => 'Giỏ hàng trống, Mua tai nghe đi hahaha.'
            ]);
            return view('product.indexPayment', ['page' => 'Payment']);
        } else {
            return view('product.pleaseLogin', [
                'page' => 'PleaseLogin', 'mess' => 'Đăng nhập đi, rồi mới xem được.'
            ]);
        }
    }

    function getDataForPayment()
    {
        if (isset($_SESSION['id_loginEd']))
            $result = DB::table('carts_product')->where(
                'id_cart',
                '=',
                $_SESSION['id_loginEd']
            )->get(
                array(
                    'id_cart_product'
                )
            );
        if (count(
            $result
        ) > 0) {
        } else return response()->json(['status' => 0, 'mess' => 'Empty Cart, Please Add cart']);
    }

    function getDataProductForCart() {
        $obj_Ordereds= DB::table('carts_product')->where(
            'id_cart',
            '=',
            $_SESSION['id_loginEd']
            )->get(
                array(
                    'id_product'
                    ,'id_plug_product'
                    ,'id_color_product'	
                    ,'quantity_ordered'
                    )
            );
            
            
            $ProductForCart =[];
            $obj_totalOdered= new stdClass();
            $valueTotalOrdered = 0; 
        foreach($obj_Ordereds as $item)
        {
            // get data id_product_has_color_plug
            $id_product = $item->id_product;
            $id_color_product = $item->id_color_product;
            $id_plug_product = $item->id_plug_product;

            $resultIndividualProduct = DB::table('product_has_color_plug')
            ->select('id_product_has_color_plug')
            ->where(['id_product'=>$id_product])
            ->where(['id_color_product'=>$id_color_product])
            ->where(['id_plug_product'=>$id_plug_product])
            ->get()->first()->id_product_has_color_plug;
            $item->id_product_has_color_plug = $resultIndividualProduct;

            // dd($resultIndividualProduct);

            $item_atrributes= ProductController::getDataCardProduct_withIDproduct($item->id_product);
            $item->finalPriceProduct = $item->quantity_ordered * $item_atrributes->price->root_price_product;
            
            $valueTotalOrdered+=$item->finalPriceProduct;
            $ProductForCart[count($ProductForCart)] = (object)array_merge((array)$item_atrributes,(array)$item);


        }

    
        
        

        $obj_totalOdered->valueTotalOrdered=$valueTotalOrdered;
        $obj_totalOdered->totalPriceSale=0;

        $obj_shiping = DB::table('local_accounts')
        ->select('data_province')
        ->where('id_account',
        '=',
        $_SESSION['id_loginEd'])
        ->get();

        // dd($obj_shiping[0]->data_province);

        if($obj_shiping[0]->data_province == 'Đà Nẵng') {
            $obj_totalOdered->obj_shiping= 0;
            $obj_totalOdered->finalTotalOrdered=$valueTotalOrdered+0;

        } else {
            $obj_totalOdered->obj_shiping = 50000;
            $obj_totalOdered->finalTotalOrdered=$valueTotalOrdered+50000;

        }


        $dataYourOdered= new stdClass();
        $dataYourOdered->dataProductForCarts =  $ProductForCart;
        $dataYourOdered->obj_totalOdered=$obj_totalOdered;
            //    dd($dataYourOdered);
        return $dataYourOdered;
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

        // dump(json_decode($obj_Local)[0]);

        return json_decode($obj_Local)[0];
    }

    function getDataBank() {
        $obj_Bank= DB::table('bank')->get(
                array(
                    'name_Bank'
                    ,'number_Bank'
                    ,'name_user_Bank'
                    ,'image_background_bank'
                    )
            );

        // dd(json_decode($obj_Local)[0]);

        return json_decode($obj_Bank)[0];
    }
    function saveInformation() {
        $obj_dataInfo = json_decode($_POST['newInfo']);
        $result = DB::table('local_accounts')->where('id_account','=',$_SESSION['id_loginEd'])
        ->update([
            'name_account'=>$obj_dataInfo->nameFromYourLocal,
            'data_province'=>$obj_dataInfo->Province,
            'data_district'=>$obj_dataInfo->District,
            'data_ward'=>$obj_dataInfo->Ward,
            'data_street'=>$obj_dataInfo->Street,
            'data_numHouse'=>$obj_dataInfo->numHouse,
            'local_account'=>$obj_dataInfo->localFromYourLocal,
            'email_account'=>$obj_dataInfo->emailFromYourLocal,
            'phone_account'=>$obj_dataInfo->phoneFromYourLocal,
        ]);
        return response()->json(['obj_dataInfo'=>$result]);
    }

    public function returnView(){
        return view('product.pleaseLogin')
            ->with('page', 'PleaseLogin')
            ->with('mess','Giỏ hàng trống, Mua tai nghe đi hahaha.')
            ->with('messToast', 'Xác nhận đơn hàng thành công.');
    }

    function comfirmOrder() {

        //get datetime id 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $datetime = date('Ymdhis' , time());
        $dateTimeFormat = date('Y-m-d h:i:s', time());
        // $dateTimeFormat = date('Ymdhis', time());

        // dd($dateTimeFormat);


        $dataYourOdered = PaymentController::getDataProductForCart();
        $dataYourLocal = PaymentController::getDataLocalCustomer();
        $dataBank = PaymentController::getDataBank();
        

        // get phiVanChuyen and giamGia
        $data_get = json_decode($_POST['newData']);
        // $shipping = $data_get->phiVanChuyen;
        $codeSale = $data_get->giamGia;
        $wayPayment = $data_get->hinhThucThanhToan;
        $local_order = $data_get->diachiDonHang;

        $shipping = intval(str_replace('.', '', $data_get->phiVanChuyen));


        // dd($wayPayment);
        $i_count = 0;
        // dd($dataYourOdered); 
        while( $i_count < count($dataYourOdered->dataProductForCarts)) {

            DB::table('order_information')->insert([
                ['id_order_infomation'=> 'TDN'.$_SESSION['id_loginEd'].$datetime,
                'id_account'=> $_SESSION['id_loginEd'],
                'date_order'=> $dateTimeFormat,
                'id_product'=> $dataYourOdered->dataProductForCarts[$i_count]->id_product,
                'id_product_has_color_plug'=>$dataYourOdered->dataProductForCarts[$i_count]->id_product_has_color_plug,
                'name_product'=> $dataYourOdered->dataProductForCarts[$i_count]->name_product,
                'unit_price'=> $dataYourOdered->dataProductForCarts[$i_count]->price->root_price_product,
                'count'=> $dataYourOdered->dataProductForCarts[$i_count]->quantity_ordered,
                'shipping'=>$shipping,
                'sale'=>$codeSale,
                'local_order'=>$local_order,
                'payment'=>$wayPayment,
                ] 
            ]);
            $i_count++;
        }

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
            'notification_type' => 'notification_admin_order',
            'notification_avt' => $id_account[0]->url_avatar_account,
            'notification_title' => 'Xác Nhận Đơn Hàng',
            'notification_content' => $id_account[0]->fname.' vừa xác nhận đơn hàng: TDN'.$_SESSION['id_loginEd'].$datetime
        ]);

        DB::table('carts_product')->where(['id_cart' => $_SESSION['id_loginEd']])->delete();



        // return Redirect::to('returnView');
        // return redirect()->action([PaymentController::class, 'returnView']);
        return response()->json(['datetime_now'=>$datetime]);
    }

    function loadCodeSale(Request $request) {
        
        $check_Code_Sale= DB::table('code_sale')->where(
            'code_sale',
            '=',
            $request->codeSale
            )->get(array('value_sale'));

        $shipping = intval( str_replace('.', '', $request->TongCong)) / 100 * intval(json_decode($check_Code_Sale)[0]->value_sale);
        
        
        // dd($check_Code_Sale);

        return $shipping;
    }



    // load Bank api 
    function loadDataBank(Request $request) {

        $obj_Bank= DB::table('bank')
        ->where(['id_Bank' => $request->id_Bank])
        ->get(
            array(
                'name_Bank'
                ,'number_Bank'
                ,'name_user_Bank'
                ,'image_background_bank'
                )
        );

        return json_decode($obj_Bank)[0];
    }


    // load Local in VietNam
    function loadDistrictFromProvince(Request $request) {
        $data_District_From_Province= DB::table('district')->where(
            '_province_id',
            '=',
            number_format($request->id_Province)
            )->get(
                array(
                    'id'
                    ,'_name'
                    ,'_prefix'
                    ,'_province_id'
                    )
            );

            $output = '';

            
            
            foreach($data_District_From_Province as $sub_Data_District_From_Province)
            {
                $output .= '
                    <option data-District="'. $sub_Data_District_From_Province->id .'">'. $sub_Data_District_From_Province->_name .'</option>
                ';
            }

        // return json_decode($data_District_From_Province);
        return $output;
    }

    function loadWardFromDistrict(Request $request) {
        $data_Ward_From_District= DB::table('ward')->where(
            '_province_id',
            '=',
            number_format($request->id_Province)
            )->where(
                '_district_id',
                '=',
                number_format($request->id_District)
            )->get(
                array(
                    'id'
                    ,'_name'
                    ,'_prefix'
                    ,'_province_id'
                    ,'_district_id'
                    )
            );

            $output = '';

            
            
            foreach($data_Ward_From_District as $sub_Data_Ward_From_District)
            {
                $output .= '
                    <option data-Ward="'. $sub_Data_Ward_From_District->id .'">'. $sub_Data_Ward_From_District->_name .'</option>
                ';
            }

        // return json_decode($data_District_From_Province);
        return $output;
    }

    function loadStreetFromDistrict(Request $request) {
        $data_Street_From_District= DB::table('street')->where(
            '_province_id',
            '=',
            number_format($request->id_Province)
            )->where(
                '_district_id',
                '=',
                number_format($request->id_District)
            )->get(
                array(
                    'id'
                    ,'_name'
                    ,'_prefix'
                    ,'_province_id'
                    ,'_district_id'
                    )
            );

            $output = '';
            foreach($data_Street_From_District as $sub_Data_Street_From_District)
            {
                $output .= '
                    <option data-Ward="'. $sub_Data_Street_From_District->id .'">'. $sub_Data_Street_From_District->_name .'</option>
                ';
            }

        // return json_decode($data_District_From_Province);
        return $output;
    }


}

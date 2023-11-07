<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                // dd($dataYourOdered);
                return view('product.index',
                 ['page' => 'Payment'
                    ,'dataYourOdered'=>$dataYourOdered
                    ,'dataYourLocal'=>$dataYourLocal
                    ,'dataBank' => $dataBank] 
            );
            } else return view('product.index', [
                'page' => 'PleaseLogin', 'mess' => 'Empty Cart, Please Add cart'
            ]);
            return view('product.index', ['page' => 'Payment']);
        } else {
            return view('product.index', [
                'page' => 'PleaseLogin', 'mess' => 'Please Login'
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
            // $ProductForCart[count($ProductForCart)] = ProductController::getDataCardProduct_withIDproduct($item->id_product);
            $item_atrributes= ProductController::getDataCardProduct_withIDproduct($item->id_product);

            $item->finalPriceProduct = $item->quantity_ordered * $item_atrributes->price->root_price_product;
            
            $valueTotalOrdered+=$item->finalPriceProduct;
            $ProductForCart[count($ProductForCart)] = (object)array_merge((array)$item_atrributes,(array)$item);
        }

        $obj_totalOdered->valueTotalOrdered=$valueTotalOrdered;
        $obj_totalOdered->totalPriceSale=0;
        $obj_totalOdered->finalTotalOrdered=$valueTotalOrdered+0;
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
    function saveInformation() {
        $obj_dataInfo = json_decode($_POST['newInfo']);
        $result = DB::table('local_accounts')->where('id_account','=',$_SESSION['id_loginEd'])
        ->update([
            'name_account'=>$obj_dataInfo->nameFromYourLocal,
            'local_account'=>$obj_dataInfo->localFromYourLocal,
            'email_account'=>$obj_dataInfo->emailFromYourLocal,
            'phone_account'=>$obj_dataInfo->phoneFromYourLocal,
        ]);
        return response()->json(['obj_dataInfo'=>$result]);
    }

    function comfirmOrder() {
        
        //get datetime id 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $datetime = date('Ymdhis' , time());
        $dateTimeFormat = date('Y-m-d h:i:s', time());

        $dataYourOdered = PaymentController::getDataProductForCart();
        $dataYourLocal = PaymentController::getDataLocalCustomer();
        $dataBank = PaymentController::getDataBank();


        


        $i_count  = 0;
        // dd($dataYourOdered); 
        while( $i_count < count($dataYourOdered->dataProductForCarts)) {

            DB::table('order_information')->insert([
                ['id_order_infomation'=> $_SESSION['id_loginEd'].$datetime,
                'id_account'=> $_SESSION['id_loginEd'],
                'date_order'=> $dateTimeFormat,
                'name_product'=> $dataYourOdered->dataProductForCarts[$i_count]->name_product,
                'unit_price'=> $dataYourOdered->dataProductForCarts[$i_count]->price->root_price_product,
                'count'=> $dataYourOdered->dataProductForCarts[$i_count]->quantity_ordered,
                ] 
            ]);
            $i_count++;
        }

        DB::table('carts_product')->where(['id_cart' => $_SESSION['id_loginEd']])->delete();





        return response()->json(['datetime_now'=>$datetime]);
    }

}

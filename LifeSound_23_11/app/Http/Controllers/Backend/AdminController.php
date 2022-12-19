<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use stdClass;

class AdminController extends Controller
{
    public function AuthLogin(){
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin');
        }
    }
    function index() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            return Redirect::to('admin/dashboard');
        }else{
            return view('adminAD.loginAdmin');
        }
        // return view('adminAD.Dashboard.indexDashBoard');
    }

    function loginAdmin(Request $request) {

        $username = $request->username;
        $password = $request->password;

        // dd($password);

        $login = DB::table('admin')
        ->where(['user_name'=>$username])
        ->where(['password'=>$password])->get()->first();

        if($login) {
            $inforAdmin = new stdClass();
            $inforAdmin->user_name = $login->user_name;
            $inforAdmin->password = $login->password;
            $inforAdmin->full_name_admin = $login->full_name_admin;
            $inforAdmin->images_admin = $login->images_admin;
            // dd($login);

            $request->session()->put('inforAdmin', $inforAdmin);
            return Redirect::to('admin/dashboard');

            // return view('adminAD.Dashboard.indexDashBoard')->with('messToast', 'Chào mừng đến với ADMIN.');
        } else {
            return view('adminAD.loginAdmin')
            ->with('messToast', 'Tài khoảng hoặc mật khẩu sai.');
        }
        
    }

    function logoutAdmin() {
        Session::forget('inforAdmin');
        return view('adminAD.loginAdmin')
        ->with('messToast', 'Đăng Xuất Thành Công.');
    }

    function showDashboard() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            // get data forum
            $dataForum = DB::table('notification_page')
            ->where(['notification_object' => -1])
            ->orderBy('id_notification', 'desc')
            ->get(
                array(
                    'id_notification',
                    'notification_object',
                    'notification_type',
                    'notification_avt',
                    'notification_title',
                    'notification_content',
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
            ->where(['notification_object' => -1])
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

            $listDataForum = [];
            foreach($dataForum as $subDataForum) {
                if($subDataForum->id_comment > 0) {
                    $subDataForum->comment = DB::table('comment_product')->where(['id_comment' => $subDataForum->id_comment])
                    ->get(
                        array(
                            'id_comment',
                            'id_account',
                            'id_product',
                            'title_comment',
                            'content_comment',
                            'date_send'
                            )
                    )->first();
                    $subDataForum->url_image_comment = DB::table('comment_image')
                    ->where(['id_comment' => $subDataForum->id_comment])
                    ->get('url_image_comment')->first();
                    $subDataForum->comment_admin_reply = DB::table('comment_admin_reply')
                    ->where(['id_comment' => $subDataForum->id_comment])
                    ->get(
                        array(
                            'avt_admin_reply',
                            'content_reply',
                            'date_reply'
                            )    
                    );
    
                    $subDataForum->name_customer = DB::table('accounts')
                    ->where(['id_account' => $subDataForum->comment->id_account])
                    ->get('fname')[0]->fname;
                    $subDataForum->url_avatar_account = DB::table('accounts')
                    ->where(['id_account' => $subDataForum->comment->id_account])
                    ->get('url_avatar_account')[0]->url_avatar_account;
                    $subDataForum->products= AdminController::getDataCardProduct_withIDproduct($subDataForum->comment->id_product);
                    $subDataForum->count_commnent = count(DB::table('comment_product')->where(['id_product' => $subDataForum->comment->id_product])->get());
                    $subDataForum->count_product_loved = count(DB::table('products_loved')->where(['id_product' => $subDataForum->comment->id_product])->get());
    
    
                    $listDataForum[count($listDataForum)] = $subDataForum;
                
                } else {
                    $listDataForum[count($listDataForum)] = $subDataForum;
                }
            }



            // get data product
            $products = Product::inRandomOrder()->limit(4)->get();

            for($i=0;$i<count($products);$i++)
            {
                $products[$i]= AdminController::getDataCardProduct_withIDproduct($products[$i]->id_product);
                $products[$i]->count_commnent = count(DB::table('comment_product')->where(['id_product' => $products[$i]->id_product])->get());
                $products[$i]->count_product_loved = count(DB::table('products_loved')->where(['id_product' => $products[$i]->id_product])->get());
            }
            
            $listData = new stdClass();
            $listData->countComment = count(DB::table('comment_product')->get());
            $listData->countOrder = count(DB::table('order_information')->where(['status'=>'Đang xử lý'])->get());
            $listData->countProduct = count(DB::table('products')->get());
            $listData->countBrand = count(DB::table('brand_products')->get());

            // statistics order
            $list_charts_order = new stdClass();
            $list_charts_order->cancel = count(DB::table('order_information')->where(['status'=>'Đã hủy'])->get());
            $list_charts_order->success = count(DB::table('order_information')->where(['status'=>'Đã giao'])->get());
            $list_charts_order->process = count(DB::table('order_information')->where(['status'=>'Đang xử lý'])->get());
            $list_charts_order->delivery = count(DB::table('order_information')->where(['status'=>'Đang giao hàng'])->get());
            $listData->list_charts_order = $list_charts_order;

            // $list_charts_sale_product = new stdClass();
            // $date1 = new date;
            // $date2 = date('Y-m-d',strtotime($date1)-1);


            // statistics product 
            $list_charts_product = new stdClass();
            $list_charts_product->topProduct = DB::table('order_information')
            ->where(['status' => 'Đã giao'])
            ->orWhere(['status' => 'Đang giao hàng'])
            ->select('id_product')
            ->selectRaw('count("id_product") as count')
            ->groupBy('id_product')
            ->orderBy('count', 'desc')
            ->limit(6)
            ->get();
            // $list_charts_product->topProduct = array_slice($list_charts_product->topProduct->count, -6);
            // $list_charts_product->topProduct = array_slice($list_charts_product->topProduct->id_product, -6);

            $list_charts_product->nameProduct = [];
            foreach($list_charts_product->topProduct as $subTopProduct) {
                $list_charts_product->nameProduct[count($list_charts_product->nameProduct)] = DB::table('products')
                ->where(['id_product' => $subTopProduct->id_product])
                ->get('name_product')[0]->name_product;
            }
            $listData->list_charts_product = $list_charts_product;


            // statistics profit 
            // $list_charts_profit = new stdClass();
            // $list_charts_profit->profit = DB::table('order_information')
            // ->where(['status' => 'Đã giao'])
            // ->orWhere(['status' => 'Đang giao hàng'])








            
            return view('adminAD.Dashboard.indexDashBoard')
            ->with(['products' => $products])
            ->with(['listData' => $listData])
            ->with(['total_page' => $total_page])
            ->with(['dataForum' => $listDataForum]);
        }else{
            return Redirect::to('/admin');
        }
    }

    function eventCommentReply(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $id_account = $request->id_account;
            $id_comment = $request->id_comment;
            $content_reply = $request->content_reply;

            // save data comment reply
            $result = DB::table('comment_admin_reply')->insert([
                'id_comment' => $id_comment,
                'content_reply' => $content_reply
            ]);
            // thông bảo reply
            $notification = DB::table('notification_page')->insert([
                'notification_object' => $id_account,
                'notification_type' => 'reply_comment',
                'notification_avt' => '/images/owl.png',
                'notification_title' => 'Thông Báo Trả Lời',
                'notification_content' => 'Life Sound đã trả lời bình luận của bạn bạn.',
                'id_comment' => $id_comment
            ]);

            // send data notification
            $dataForum = DB::table('notification_page')
            ->where(['notification_object' => -1])
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
            $listDataForum = [];
            foreach($dataForum as $subDataForum) {
                if($subDataForum->id_comment > 0) {
                    $subDataForum->comment = DB::table('comment_product')->where(['id_comment' => $subDataForum->id_comment])
                    ->get(
                        array(
                            'id_comment',
                            'id_account',
                            'id_product',
                            'title_comment',
                            'content_comment',
                            'date_send'
                            )
                    )->first();
                    $subDataForum->url_image_comment = DB::table('comment_image')
                    ->where(['id_comment' => $subDataForum->id_comment])
                    ->get('url_image_comment')->first();
                    $subDataForum->comment_admin_reply = DB::table('comment_admin_reply')
                    ->where(['id_comment' => $subDataForum->id_comment])
                    ->get(
                        array(
                            'avt_admin_reply',
                            'content_reply',
                            'date_reply'
                            )    
                    );
    
                    $subDataForum->name_customer = DB::table('accounts')
                    ->where(['id_account' => $subDataForum->comment->id_account])
                    ->get('fname')[0]->fname;
                    $subDataForum->url_avatar_account = DB::table('accounts')
                    ->where(['id_account' => $subDataForum->comment->id_account])
                    ->get('url_avatar_account')[0]->url_avatar_account;
                    $subDataForum->products= AdminController::getDataCardProduct_withIDproduct($subDataForum->comment->id_product);
                    $subDataForum->count_commnent = count(DB::table('comment_product')->where(['id_product' => $subDataForum->comment->id_product])->get());
                    $subDataForum->count_product_loved = count(DB::table('products_loved')->where(['id_product' => $subDataForum->comment->id_product])->get());
    
    
                    $listDataForum[count($listDataForum)] = $subDataForum;
                
                } else {
                    $listDataForum[count($listDataForum)] = $subDataForum;
                }
            }
            // calculate count page
            $total_content = count($listDataForum);
            $total_page = $total_content / 5;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }


            $data = new stdClass();
            $data->listDataForum = $listDataForum;
            $data->total_page = $total_page;



            return response()->json($data);
        }else{
            return Redirect::to('/admin');
        }
    }






    function getDataCardProduct_withIDproduct($id_product)
    {
        $price = Product::select(
            array(
                'product_has_color_plug.rate_sale_default_product'
                ,'product_has_color_plug.root_price_product'
            )
        )
        ->join('product_has_color_plug','product_has_color_plug.id_product','=','products.id_product')
        ->where('products.id_product','=',$id_product)
        ->get()[0];
        $shortIntro = Product::where('products.id_product','=',$id_product)
        ->join('description_products','products.id_product','=','description_products.id_product')
        ->get(
            array(
            'title_description',
        )
        )[0]; 
        $img = Product::where('products.id_product','=',$id_product)
        ->join('img_products','products.id_product','=','img_products.id_product')
        ->get(
            array(
            'url_img_product')
        )[0];   
        $name_product = DB::table('products')
        ->where('products.id_product','=',$id_product)
        ->get(
            array(
                'name_product'
        ))[0]->name_product;
        $result= new stdClass();
        // $list = new stdClass();
        $result->price=json_decode($price);
        $result->shortIntro=json_decode($shortIntro);
        $result->img=json_decode($img);  
        $result->name_product=$name_product;
        $result->id_product=$id_product;
        return $result;
    }

}

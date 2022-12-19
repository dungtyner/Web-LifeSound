<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use stdClass;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class ProductController{
    public function indexDeal()
    {
        $result = Product::get();
        
        
        $products = ((array)json_decode($result));
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $limit = 9;
        $start = ($page - 1) * $limit;    
        $total_content = count($products);
        $total_page = $total_content / $limit;
        if(round($total_page) < $total_page) {
            $total_page = $total_page + 1;
            $total_page = round($total_page);
        } else {
            $total_page = round($total_page);
        }

        $products = Product::orderBy('id_product', 'desc')->offset($start)->limit($limit)
        ->get();


        for($i=0;$i<count($products);$i++)
        {
            $products[$i]=ProductController::getDataCardProduct_withIDproduct($products[$i]->id_product);
        
        }

        $brands = DB::table('brand_products')
        ->get(
            array(
                'name_brand_product'
                ,'id_brand_product'
            )
        );
        $categories = DB::table('category_products')->select(['name_category_product','id_category_product'])->get();
        return view('product.ListProduct.listDealProduct',['page'=>'Product','products'=>$products,'brands'=>$brands, 'categories'=>$categories, 'total_page'=>$total_page]);
    }

    public function getDetailWithIdRequest(Request $request)
    {
        // echo "ok";
        $result =Product::where('products.id_product','=',$request->input('id'))
        ->join('brand_products','products.id_brand_product','=','brand_products.id_brand_product')
        ->join('img_products','products.id_product','=','img_products.id_product')
        ->limit(1)
        ->get(
            array(
                'name_product'
                ,'name_brand_product'
                ,'brand_products.id_brand_product'
                ,'products.id_product'
            )
        );

        $list['img_product']= Product::where('products.id_product','=',$request->input('id'))
        ->join('img_products','products.id_product','=','img_products.id_product')
        ->get(
            array('url_img_product')
        );

        $list['color_product']= Product::where('products.id_product','=',$request->input('id'))
        ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
        ->join('color_products','color_products.id_color_product','=','product_has_color_plug.id_color_product')
        ->distinct()
        ->get(
            array(
                'value_color_product',
                'color_products.id_color_product',
                'product_has_color_plug.url_image_color_sub_product')
        );
        $list['plug_product']= Product::where('products.id_product','=',$request->input('id'))
        ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
        ->join('plug_products','plug_products.id_plug_product','=','product_has_color_plug.id_plug_product')
        ->distinct()
        ->get(
            array(
                'value_plug_product',
                'plug_products.id_plug_product')
        );

        $list['description_product']= Product::where('products.id_product','=',$request->input('id'))
        ->join('description_products','products.id_product','=','description_products.id_product')
        ->get(
            array(
                'title_description',
                'content_description',
                'id_description_product'
            )
        );

        for($i=0;$i<count($list['description_product']);$i++)
        {
            

            $list['description_product'][$i]->list_img_description_product=
            DB::table('img_description_products')
                    ->where('img_description_products.id_description_product','=',$list['description_product'][$i]->id_description_product)
                    ->get(
                        array(
                                'url_img_description_product'
                            )
                        );
            unset($list['description_product'][$i]->id_description_product);

        }
        
        $list['FAQs_product']= Product::where('products.id_product','=',$request->input('id'))
        ->join('faqs_products','products.id_product','=','faqs_products.id_product')
        ->get(
            array(
                'question_product',
                'answer_product'
                )
        );

        $list['tech_sound_product']= Product::where('products.id_product','=',$request->input('id'))
        ->join('product_has_tech_sound','products.id_product','=','product_has_tech_sound.id_product')
        ->join('tech_sound_products','product_has_tech_sound.id_tech_sound_product','=','tech_sound_products.id_tech_sound_product')

        ->get(
            array(
                'logo_tech_sound_product',
                'description_tech_sound_product'
                )
        );


        $list['id_product_of_brand'] = DB::table('products')
        ->where(['id_brand_product' => $result[0]->id_brand_product])
        ->get(array('id_product'));

        $list['accompanying_list'] = [];
        foreach($list['id_product_of_brand'] as $id_product) {
            // dump($id_product);
            $list['accompanying_list'][count($list['accompanying_list'])] = ProductController::getDataCardProduct_withIDproduct($id_product->id_product);
        }
        
        

        $list['comment_customer'] = [];
        $listCommentCustomer = DB::table('comment_product')
        ->where(['id_product' => $request->input('id')])
        ->orderBy('id_comment', 'desc')
        ->get(
            array(
                'id_comment',
                'id_product',
                'id_account',
                'title_comment',
                'content_comment',
                'date_send'
                )
        );
        foreach($listCommentCustomer as $sublistCommentCustomer) {
            $sublistCommentCustomer->name_customer = DB::table('accounts')
            ->where(['id_account' => $sublistCommentCustomer->id_account])
            ->get('fname')[0]->fname;
            $sublistCommentCustomer->url_avatar_account = DB::table('accounts')
            ->where(['id_account' => $sublistCommentCustomer->id_account])
            ->get('url_avatar_account')[0]->url_avatar_account;
            $sublistCommentCustomer->url_image_comment = DB::table('comment_image')
            ->where(['id_comment' => $sublistCommentCustomer->id_comment])
            ->get('url_image_comment')->first();
            $sublistCommentCustomer->comment_admin_reply = DB::table('comment_admin_reply')
            ->where(['id_comment' => $sublistCommentCustomer->id_comment])
            ->get(
                array(
                    'avt_admin_reply',
                    'content_reply',
                    'date_reply'
                    )    
            );

            $list['comment_customer'][count( $list['comment_customer'])] = $sublistCommentCustomer;
        }

        $list['pagination'] = [new stdClass()];
        $list['pagination'][0]->limit = 3;
        $list['pagination'][0]->totalPage = count( $list['comment_customer']) / $list['pagination'][0]->limit;

        if(round($list['pagination'][0]->totalPage) < $list['pagination'][0]->totalPage) {
            $list['pagination'][0]->totalPage = $list['pagination'][0]->totalPage + 1;
            $list['pagination'][0]->totalPage = round($list['pagination'][0]->totalPage);
        } else {
            $list['pagination'][0]->totalPage = round($list['pagination'][0]->totalPage);
        }

        
        






        $product=$result;
        if(isset($_SESSION['id_loginEd'])) {
            $product['YesNoLogin'] = 'yes';
        } else {
            $product['YesNoLogin'] = 'no';    
        }
        $product['list']=$list;
        return response()->json($product);
    }
    function getListProductExistCart(Request $request)
    {
        $obj_opt= json_decode($request->input('obj_opt'));
        $result=[];
        if(isset($_SESSION['email']))
        {
            DB::enableQueryLog();
                $result['id_optColor'] = CartProduct::select(array(
                DB::raw('id_color_product as id_optColor')
            ))
            ->join('accounts','accounts.id_account','carts_product.id_cart')
            ->where(
                array(
                    ['accounts.email','=',$_SESSION['email']],
                    ['id_product','=',$request->input('id')],
                    ['id_color_product','!=',$obj_opt->id_optColor],
                    ['id_plug_product','=',$obj_opt->id_optPlug],
                )
            )->get();
            $result['id_optPlug'] = CartProduct::select(array(
                DB::raw('id_plug_product as id_optPlug')
            ))
            ->join('accounts','accounts.id_account','carts_product.id_cart')
            ->where(
                array(
                    ['accounts.email','=',$_SESSION['email']],

                    ['id_product','=',$request->input('id')],
                    ['id_color_product','=',$obj_opt->id_optColor],
                    ['id_plug_product','!=',$obj_opt->id_optPlug],
                )
            )
            ->get();
        }
        return response()->json(['result'=>$result]);
    }
    function getQuantityProductWithOptCharRequest(Request $request)
    {
        $obj_opt = json_decode($request->input('obj_opt'));
        $result = ProductController::getQuantity_ProductWith_objOpt($request->input('id'),$obj_opt);
        return response()->json($result);
    }
    function getQuantity_ProductWith_objOpt($id_product,$obj_opt)
    {
        $result =  Product::where('products.id_product','=',$id_product)
        ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
        ->where('product_has_color_plug.id_color_product','=',$obj_opt->id_optColor)
        ->where('product_has_color_plug.id_plug_product','=',$obj_opt->id_optPlug)
        ->get(

            array(
                'quantity_product_has'
            )
        );
        if(isset($_SESSION['listProductOrder_cart']))
        {
            for($i=0;$i< count($_SESSION['listProductOrder_cart']);$i++)
            {
                if($_SESSION['listProductOrder_cart'][$i]->id_product==$id_product)
            {
                if($_SESSION['listProductOrder_cart'][$i]->id_optColor==$obj_opt->id_optColor 
                    && $_SESSION['listProductOrder_cart'][$i]->id_optPlug==$obj_opt->id_optPlug)
                {
                    $result[0]->dataOrdered=$_SESSION['listProductOrder_cart'][$i];

                }
            }
            }
        }
        else
        {
            $email=null;
            if(isset($_SESSION['email']))
            {
                $email=$_SESSION['email'];
                $productInCart=CartProduct::select(
                    array(
                        'id_product'
                        ,DB::raw('id_plug_product as id_optPlug')
                        ,DB::raw('id_color_product as id_optColor')
                        ,DB::raw('quantity_ordered as quantityOrder')
                    )
                )->where(array(
                    'id_cart'=>CartController::getId_cart_withEmail($email),
                    'id_product'=>$id_product,
                    'id_color_product'=>$obj_opt->id_optColor,
                    'id_plug_product'=>$obj_opt->id_optPlug,
                    ))->get();
                    if(count($productInCart)==1)
                    {
                        $result[0]->dataOrdered=$productInCart[0];
                    }
            }

        }
        return $result;
    }
    function getPrice_Sale_ProductWithOptCharRequest(Request $request)
    {
        $obj_opt = json_decode($request->input('obj_opt'));
        $result = ProductController::getPrice_Sale_ProductWith_objOpt($request->input('id'),$obj_opt);
        return response()->json($result);
    }
    function getPrice_Sale_ProductWith_objOpt($id_product,$obj_opt)
    {
        $result =  Product::where('products.id_product','=',$id_product)
        ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
        ->where('product_has_color_plug.id_color_product','=',$obj_opt->id_optColor)
        ->where('product_has_color_plug.id_plug_product','=',$obj_opt->id_optPlug)
        ->get(

            array(
                'product_has_color_plug.root_price_product',
                'product_has_color_plug.rate_sale_default_product'
            )
        );
        if(isset($_SESSION['listProductOrder_cart']))
        {
            for($i=0;$i< count($_SESSION['listProductOrder_cart']);$i++)
        {
            if($_SESSION['listProductOrder_cart'][$i]->id_product==$id_product)
            {
                if($_SESSION['listProductOrder_cart'][$i]->id_optColor==$obj_opt->id_optColor 
                    && $_SESSION['listProductOrder_cart'][$i]->id_optPlug==$obj_opt->id_optPlug)
                {
                    $result[0]->dataOrdered=$_SESSION['listProductOrder_cart'][$i];

                }
            }
        }
        }
        return $result;
    }
    function getResultSearch(Request $request)
    {
        $param_request = json_decode($request->input('obj_search'));
        $result = Product::select(
            array(
                'name_product'
                ,'id_product'
            )
            )
            ->where('name_product','like','%'.$param_request->textSearchProduct.'%')
            ->get();
        for($i=0;$i<count($result);$i++)
        {
            $list['img_product']= Product::where('products.id_product','=',$result[$i]->id_product)
            ->join('img_products','products.id_product','=','img_products.id_product')
            ->get(
            array(
               'url_img_product')
            );
            $result[$i]['list']=$list;   
        }

        return response()->json(['result'=>$result]);
    }
    static function getDataCardProduct_withIDproduct($id_product)
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
    function getProducts_withFilter(Request $request)
    {
        $value_Filter_brandItems_Selected = json_decode($request->input('value_Filter_brandItems_Selected'));
        $value_Filter_categoryItems_Selected = json_decode($request->input('value_Filter_categoriesItems_Selected'),true);
        // $list_id_product = 
        $list_id_product=[]; 
        if(count($value_Filter_brandItems_Selected)!=0 && count($value_Filter_categoryItems_Selected)!=0)
        {
        // dd($value_Filter_brandItems_Selected);   

        $list_id_product = DB::table('product_has_cagetories')
        ->join('products', 'products.id_product','=','product_has_cagetories.id_product')
        ->join('brand_products','brand_products.id_brand_product','=','products.id_product')
        ->whereIn('product_has_cagetories.id_cagetory_product',$value_Filter_categoryItems_Selected)
        ->whereIn('brand_products.id_brand_product',$value_Filter_brandItems_Selected)
        ->distinct()
        ->get();
        }
        else if(count($value_Filter_brandItems_Selected)!=0 && count($value_Filter_categoryItems_Selected)==0)
        {
            $list_id_product = DB::table(DB::raw('products,brand_products'))
            ->select('products.id_product')
            ->whereIn('brand_products.id_brand_product',$value_Filter_brandItems_Selected)
            ->distinct()->get();
        }
        else if(count($value_Filter_brandItems_Selected)==0 && count($value_Filter_categoryItems_Selected)!=0)
        {
            $list_id_product = DB::table('product_has_cagetories')
            ->join('products', 'products.id_product','=','product_has_cagetories.id_product')
            ->join('category_products','category_products.id_category_product','=','product_has_cagetories.id_cagetory_product')
            ->whereIn('product_has_cagetories.id_cagetory_product',$value_Filter_categoryItems_Selected)
            ->distinct()
            ->get(array(
                'product_has_cagetories.id_cagetory_product'
            ));
        }
        // dd(array_values((array)json_decode($value_Filter_brandItems_Selected)));
        // dd($list_id_product);
        return response()->json(['result'=>$list_id_product]);
    }




    //  comment
    function comment_product(Request $request) {
        $id_loginEd = $_SESSION['id_loginEd'];
        if($id_loginEd){

            // event save comment
                $url_image_comment = $request->file('url_image_comment');
                if($url_image_comment) {
                    // process image
                    $get_name_image = $url_image_comment->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$url_image_comment->getClientOriginalExtension();
                    $url_image_comment->move('upload/Product/CommentProduct/',$new_image);
                    $new_link_image = '/upload/Product/CommentProduct/'.$new_image;
                    $url_image_comment = $new_link_image;

                    // get dataa request
                    $title_comment = $request->title_comment;
                    $content_comment = $request->content_comment;
                    $id_product = $request->id_product;
                    $id_account = $_SESSION['id_loginEd'];
                    $dateTimeFormat = date('Y-m-d', time());

                    // save comment
                    $id_comment  = DB::table('comment_product')
                    ->insertGetId([
                        'id_account' => $id_account,
                        'id_product' => $id_product,
                        'title_comment' => $title_comment,
                        'content_comment' => $content_comment,
                        'date_send' => $dateTimeFormat
                    ]);

                    $comment_image = DB::table('comment_image')
                    ->insert([
                        'id_comment' => $id_comment,
                        'url_image_comment' => $url_image_comment
                    ]);





                } else {
                    $title_comment = $request->title_comment;
                    $content_comment = $request->content_comment;
                    $id_product = $request->id_product;
                    $id_account = $_SESSION['id_loginEd'];
                    $dateTimeFormat = date('Y-m-d', time());
        
                    $id_comment  = DB::table('comment_product')
                    ->insertGetId([
                        'id_account' => $id_account,
                        'id_product' => $id_product,
                        'title_comment' => $title_comment,
                        'content_comment' => $content_comment,
                        'date_send' => $dateTimeFormat
                    ]);
                }
            // =================================



            //  event load comment
                $list['comment_customer'] = [];
                $listCommentCustomer = DB::table('comment_product')
                ->where(['id_product' => $id_product])
                ->orderBy('id_comment', 'desc')
                ->get(
                    array(
                        'id_comment',
                        'id_product',
                        'id_account',
                        'title_comment',
                        'content_comment',
                        'date_send'
                        )
                );
                foreach($listCommentCustomer as $sublistCommentCustomer) {
                    $sublistCommentCustomer->name_customer = DB::table('accounts')
                    ->where(['id_account' => $sublistCommentCustomer->id_account])
                    ->get('fname')[0]->fname;
                    $sublistCommentCustomer->url_avatar_account = DB::table('accounts')
                    ->where(['id_account' => $sublistCommentCustomer->id_account])
                    ->get('url_avatar_account')[0]->url_avatar_account;
                    $sublistCommentCustomer->url_image_comment = DB::table('comment_image')
                    ->where(['id_comment' => $sublistCommentCustomer->id_comment])
                    ->get('url_image_comment')->first();
                    $sublistCommentCustomer->comment_admin_reply = DB::table('comment_admin_reply')
                    ->where(['id_comment' => $sublistCommentCustomer->id_comment])
                    ->get(
                        array(
                            'avt_admin_reply',
                            'content_reply',
                            'date_reply'
                            )    
                    );

                    $list['comment_customer'][count($list['comment_customer'])] = $sublistCommentCustomer;
                }

                $list['pagination'] = [new stdClass()];
                $list['pagination'][0]->limit = 3;
                $list['pagination'][0]->totalPage = count( $list['comment_customer']) / $list['pagination'][0]->limit;

                if(round($list['pagination'][0]->totalPage) < $list['pagination'][0]->totalPage) {
                    $list['pagination'][0]->totalPage = $list['pagination'][0]->totalPage + 1;
                    $list['pagination'][0]->totalPage = round($list['pagination'][0]->totalPage);
                } else {
                    $list['pagination'][0]->totalPage = round($list['pagination'][0]->totalPage);
                }

                $data['list'] = $list;
            // =================================

            // event save notification serve 
                $id_account = DB::table('accounts')
                ->where(['id_account' => $_SESSION['id_loginEd']])
                ->get(
                    array(
                        'fname',
                        'url_avatar_account'
                        )
                );
                $name_product = DB::table('products')
                ->where(['id_product' => $id_product])
                ->get(
                    array(
                        'name_product'
                        )
                );

                $notification = DB::table('notification_page')->insert([
                    'notification_object' => -1,
                    'notification_type' => 'notification_admin_comment',
                    'notification_avt' => $id_account[0]->url_avatar_account,
                    'notification_title' => 'Bình Luận',
                    'id_comment' => $id_comment,
                    'notification_content' => $id_account[0]->fname.' đã bình luận sản phẩm: '.$name_product[0]->name_product
                ]);
            //==================================




            return $data['list'];
        }else{
            return Redirect::to('/product/product');
        }


    }

    //  check filter
    function check_request_filter()
    {
        if(isset($_GET['filter_category'], $_GET['filter_price'])) {
            
            $filter_category = $_GET['filter_category'];
            $filter_price = $_GET['filter_price'];

            // dump($filter_category);
            // dump($filter_price);

            if($filter_price > 0 && $filter_category > 0) {
                $id_product = Product::get('id_product');
                $resultId_Category = [];
                for($i = 0; $i < count($id_product); $i++) {
                    // dump($id_product[$i]->id_product);
                    $id_product_cagetory = DB::table('product_has_cagetories')
                    ->where(['id_product' => $id_product[$i]->id_product])
                    ->get('id_product_cagetory');
                    for($j = 0; $j < count($id_product_cagetory); $j++) {
                        if($filter_category == $id_product_cagetory[$j]->id_product_cagetory) {
                            // dump($id_product[$i]->id_product);
                            // dump($id_product_cagetory[$j]->id_product_cagetory);
                            $resultId_Category[count($resultId_Category)] = $id_product[$i]->id_product;
                            $j = $j + count($id_product_cagetory);
                        }
                    }
                }

                $result = [];
                for($i = 0; $i < count($resultId_Category); $i++) {
                    // dump($id_product[$i]->id_product);
                    $root_price_product = DB::table('product_has_color_plug')
                    ->where(['id_product' => $resultId_Category[$i]])
                    ->get('root_price_product');
                    for($k = 0; $k < count($root_price_product); $k++) {
                        if($filter_price >= $root_price_product[$k]->root_price_product) {
                            // dump($id_product[$i]->id_product);
                            // dump($id_product_cagetory[$j]->id_product_cagetory);
                            $result[count($result)] = $resultId_Category[$i];
                            $k = $k + count($root_price_product);
                        }
                    }
                }
                // dump($result);


            } else if($filter_price == 0) {
                $id_product = Product::get('id_product');
                $result = [];
                for($i = 0; $i < count($id_product); $i++) {
                    // dump($id_product[$i]->id_product);
                    $id_product_cagetory = DB::table('product_has_cagetories')
                    ->where(['id_product' => $id_product[$i]->id_product])
                    ->get('id_product_cagetory');
                    for($j = 0; $j < count($id_product_cagetory); $j++) {
                        if($filter_category == $id_product_cagetory[$j]->id_product_cagetory) {
                            // dump($id_product[$i]->id_product);
                            // dump($id_product_cagetory[$j]->id_product_cagetory);
                            $result[count($result)] = $id_product[$i]->id_product;
                            $j = $j + count($id_product_cagetory);
                        }
                    }
                }
            } else if($filter_category == 0) {
                $id_product = Product::get('id_product');
                $result = [];
                for($i = 0; $i < count($id_product); $i++) {
                    // dump($id_product[$i]->id_product);
                    $root_price_product = DB::table('product_has_color_plug')
                    ->where(['id_product' => $id_product[$i]->id_product])
                    ->get('root_price_product');
                    for($j = 0; $j < count($root_price_product); $j++) {
                        if($filter_price >= $root_price_product[$j]->root_price_product) {
                            // dump($id_product[$i]->id_product);
                            // dump($id_product_cagetory[$j]->id_product_cagetory);
                            $result[count($result)] = $id_product[$i]->id_product;
                            $j = $j + count($root_price_product);
                        }
                    }
                }
            }

            // $result = Product::get();

            $products = $result;
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $limit = 9;
            $start = ($page - 1) * $limit;    
            $total_content = count($products);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }


            $products = array_slice($products, $start, $limit);
    
    
            for($i=0;$i<count($products);$i++)
            {
                $products[$i]=ProductController::getDataCardProduct_withIDproduct($products[$i]);
            
            }
    
            $brands = DB::table('brand_products')
            ->get(
                array(
                    'name_brand_product'
                    ,'id_brand_product'
                )
            );
            $categories = DB::table('category_products')->select(['name_category_product','id_category_product'])->get();
            return view('product.ListProduct.listFilterProduct',[
                'page'=>'Product',
                'products'=>$products,
                'brands'=>$brands, 
                'categories'=>$categories, 
                'filter_category'=>$filter_category, 
                'filter_price'=>$filter_price, 
                'total_page'=>$total_page]);
        } else {
            return back();
        }
    }

    function check_brand_filter() 
    {
        if(isset($_GET['filter_brand'])) {
            
            $filter_brand = $_GET['filter_brand'];

            if($filter_brand > 0 ) {
                $id_product = Product::get('id_product');
                $result = [];
                for($i = 0; $i < count($id_product); $i++) {
                    $id_brand_product = DB::table('products')
                    ->where(['id_product' => $id_product[$i]->id_product])
                    ->get('id_brand_product')[0]->id_brand_product;

                    if($filter_brand == $id_brand_product) {
                        $result[count($result)] = $id_product[$i]->id_product;
                    }
                }
                // dump($result);
            }
            

            $products = $result;
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $limit = 9;
            $start = ($page - 1) * $limit;    
            $total_content = count($products);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }


            $products = array_slice($products, $start, $limit);
    
    
            for($i=0;$i<count($products);$i++)
            {
                $products[$i]= ProductController::getDataCardProduct_withIDproduct($products[$i]);
            }
    
            $brands = DB::table('brand_products')
            ->get(
                array(
                    'name_brand_product'
                    ,'id_brand_product'
                )
            );
            $categories = DB::table('category_products')
            ->select(['name_category_product','id_category_product'])
            ->get();


            $name_brand_product = DB::table('brand_products')
            ->where(['id_brand_product' => $filter_brand])
            ->get(
                array(
                    'name_brand_product'
                )
            );
            $url_banner_brand_product = DB::table('brand_products')
            ->where(['id_brand_product' => $filter_brand])
            ->get(
                array(
                    'url_banner_brand_product'
                )
            );




            return view('product.Brand.listBrandProduct',[
                'page'=>'Product',
                'products'=>$products,
                'brands'=>$brands, 
                'categories'=>$categories, 
                'filter_brand'=>$filter_brand,
                'name_brand_product'=>$name_brand_product[0]->name_brand_product, 
                'url_banner_brand_product'=>$url_banner_brand_product[0]->url_banner_brand_product, 
                'total_page'=>$total_page]);
        } else {
            return back();
        }
    }

    function check_detail_brand_filter() {
        if(isset($_GET['filter_brand'])) {
            
            $filter_brand = $_GET['filter_brand'];
            $filter_category = $_GET['filter_category'];
            $filter_price = $_GET['filter_price'];

            if($filter_brand > 0 ) {
                $id_product = Product::get('id_product');
                $resultId_Brand = [];
                for($i = 0; $i < count($id_product); $i++) {
                    $id_brand_product = DB::table('products')
                    ->where(['id_product' => $id_product[$i]->id_product])
                    ->get('id_brand_product')[0]->id_brand_product;

                    if($filter_brand == $id_brand_product) {
                        $resultId_Brand[count($resultId_Brand)] = $id_product[$i]->id_product;
                    }
                }
                // dump($result);
            }
            // dump($resultId_Brand);

            if($filter_price > 0 && $filter_category > 0) {
                $resultId_Category = [];
                for($i = 0; $i < count($resultId_Brand); $i++) {
                    // dump($id_product[$i]->id_product);
                    $id_product_cagetory = DB::table('product_has_cagetories')
                    ->where(['id_product' => $resultId_Brand[$i]])
                    ->get('id_product_cagetory');
                    for($j = 0; $j < count($id_product_cagetory); $j++) {
                        if($filter_category == $id_product_cagetory[$j]->id_product_cagetory) {
                            // dump($id_product[$i]->id_product);
                            // dump($id_product_cagetory[$j]->id_product_cagetory);
                            $resultId_Category[count($resultId_Category)] = $resultId_Brand[$i];
                            $j = $j + count($id_product_cagetory);
                        }
                    }
                }


                

                $result = [];
                for($i = 0; $i < count($resultId_Category); $i++) {
                    // dump($id_product[$i]->id_product);
                    $root_price_product = DB::table('product_has_color_plug')
                    ->where(['id_product' => $resultId_Category[$i]])
                    ->get('root_price_product');
                    for($k = 0; $k < count($root_price_product); $k++) {
                        if($filter_price >= $root_price_product[$k]->root_price_product) {
                            // dump($id_product[$i]->id_product);
                            // dump($id_product_cagetory[$j]->id_product_cagetory);
                            $result[count($result)] = $resultId_Category[$i];
                            $k = $k + count($root_price_product);
                        }
                    }
                }
                // dump($result);


            } else if($filter_price == 0) {
                $result = [];
                for($i = 0; $i < count($resultId_Brand); $i++) {
                    // dump($id_product[$i]->id_product);
                    $id_product_cagetory = DB::table('product_has_cagetories')
                    ->where(['id_product' => $resultId_Brand[$i]])
                    ->get('id_product_cagetory');
                    for($j = 0; $j < count($id_product_cagetory); $j++) {
                        if($filter_category == $id_product_cagetory[$j]->id_product_cagetory) {
                            // dump($id_product[$i]->id_product);
                            // dump($id_product_cagetory[$j]->id_product_cagetory);
                            $result[count($result)] = $resultId_Brand[$i];
                            $j = $j + count($id_product_cagetory);
                        }
                    }
                }
            } else if($filter_category == 0) {
                $result = [];
                for($i = 0; $i < count($resultId_Brand); $i++) {
                    // dump($id_product[$i]->id_product);
                    $root_price_product = DB::table('product_has_color_plug')
                    ->where(['id_product' => $resultId_Brand[$i]])
                    ->get('root_price_product');
                    for($j = 0; $j < count($root_price_product); $j++) {
                        if($filter_price >= $root_price_product[$j]->root_price_product) {
                            // dump($id_product[$i]->id_product);
                            // dump($id_product_cagetory[$j]->id_product_cagetory);
                            $result[count($result)] = $resultId_Brand[$i];
                            $j = $j + count($root_price_product);
                        }
                    }
                }
            }
            





            $products = $result;
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $limit = 9;
            $start = ($page - 1) * $limit;    
            $total_content = count($products);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }


            $products = array_slice($products, $start, $limit);
    
    
            for($i=0;$i<count($products);$i++)
            {
                $products[$i]=ProductController::getDataCardProduct_withIDproduct($products[$i]);
            }
    
            $brands = DB::table('brand_products')
            ->get(
                array(
                    'name_brand_product'
                    ,'id_brand_product'
                )
            );
            $categories = DB::table('category_products')
            ->select(['name_category_product','id_category_product'])
            ->get();


            $name_brand_product = DB::table('brand_products')
            ->where(['id_brand_product' => $filter_brand])
            ->get(
                array(
                    'name_brand_product'
                )
            );
            $url_banner_brand_product = DB::table('brand_products')
            ->where(['id_brand_product' => $filter_brand])
            ->get(
                array(
                    'url_banner_brand_product'
                )
            );




            return view('product.Brand.listFilterBrandProduct',[
                'page'=>'Product',
                'products'=>$products,
                'brands'=>$brands, 
                'categories'=>$categories, 
                'filter_brand'=>$filter_brand,
                'filter_category'=>$filter_category, 
                'filter_price'=>$filter_price, 
                'name_brand_product'=>$name_brand_product[0]->name_brand_product, 
                'url_banner_brand_product'=>$url_banner_brand_product[0]->url_banner_brand_product, 
                'total_page'=>$total_page]);
        } else {
            return back();
        }
    }




}
?>
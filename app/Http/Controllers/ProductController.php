<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB;
use stdClass;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class ProductController{
    public function indexDeal()
    {
        $result = Product::get();
        
        
        $products = ((array)json_decode($result));
        for($i=0;$i<count($products);$i++)
        {
            $products[$i]=ProductController::getDataCardProduct_withIDproduct($products[$i]->id_product);
           
        }
        // dd($products);
        // print_r($products[0]->price);
        $brands = DB::table('brand_products')->
        join('products','brand_products.id_brand_product','=','products.id_brand_product')
        ->get(
            array(
                'name_brand_product'
                ,'products.id_brand_product'
            )
            );
            // dd($brands);
        $categories = DB::table('category_products')->select(['name_category_product','id_category_product'])->get();    
        // dd($categories);
        return view('product.listDealProduct',['products'=>$products,'brands'=>$brands, 'categories'=>$categories]);
    }

    public function list_product()
    {
        $result = Product::get();
        $products = ((array)json_decode($result));
        return view('product.listProduct',['products'=>$products]);
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
               ,'products.id_product'
            )
        );

        $list['img_product']= Product::where('products.id_product','=',$request->input('id'))
        ->join('img_products','products.id_product','=','img_products.id_product')
        ->get(
            array(
               'url_img_product')
        );

        $list['color_product']= Product::where('products.id_product','=',$request->input('id'))
        ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
        ->join('color_products','color_products.id_color_product','=','product_has_color_plug.id_color_product')
        ->distinct()
        ->get(
            array(
               'value_color_product',
               'color_products.id_color_product')
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

        $product=$result;
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
        )->join('product_has_color_plug','product_has_color_plug.id_product','=','products.id_product')
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
}
?>
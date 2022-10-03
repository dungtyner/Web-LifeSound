<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB;
session_start();
class CartController extends Controller{
    function SaveProductCart()
    {
        $Add_product_cart = (json_decode($_POST['productCartAdd']));  
        // $DB::table('product')
        // ->where('product.id_product','=',$Add_product_cart->id_product);
        if(isset($_SESSION['listProductOrder_cart']))
        {
            echo count($_SESSION['listProductOrder_cart']);
            $listProductOrder_cart=$_SESSION['listProductOrder_cart'];
            $listProductOrder_cart[intval(count($_SESSION['listProductOrder_cart']))]=$Add_product_cart;
            $_SESSION['listProductOrder_cart']= $listProductOrder_cart;
            
        }
        else
        {   
            $listProductOrder_cart[0]=$Add_product_cart;
            $_SESSION['listProductOrder_cart']= $listProductOrder_cart;
        }
        return response()->json(['result'=>$_SESSION['listProductOrder_cart']]);
    }
    function getCountProductsCart()
    {
        return response()->json(['result'=>count($_SESSION['listProductOrder_cart'])]);
    }
    function getListProductCart()
    {
        $listProductOrder_cart = $_SESSION['listProductOrder_cart'];
        // print_r ($listProductOrder_cart);
        $result=[];
        for($i =0;$i<count($listProductOrder_cart);$i++)
        {
            $result[$i]=DB::table('products')
            ->where('products.id_product','=',$listProductOrder_cart[$i]->id_product)
            ->join('brand_products','products.id_brand_product','=','brand_products.id_brand_product')
        ->join('category_products','products.id_category_product','=','category_products.id_category_product')
        ->join('img_products','products.id_product','=','img_products.id_product')
        ->limit(1)
        ->get(
            array(
               'name_product'
               ,'rate_sale_default_product'
               ,'root_price_product'
               ,'products.id_product'
            ));
        
            $result[$i][0]->dataPrice = DB::table('products')
            ->where('products.id_product','=',$listProductOrder_cart[$i]->id_product)
            ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
            ->where('product_has_color_plug.id_color_product','=',$listProductOrder_cart[$i]->id_optColor)
            ->where('product_has_color_plug.id_plug_product','=',$listProductOrder_cart[$i]->id_optPlug)
            ->get(
    
                array(
                'product_has_color_plug.root_price_product',
                'product_has_color_plug.rate_sale_default_product'
                )
            )[0];

            $result[$i][0]->dataQuantity = DB::table('products')
            ->where('products.id_product','=',$listProductOrder_cart[$i]->id_product)
            ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
            ->where('product_has_color_plug.id_color_product','=',$listProductOrder_cart[$i]->id_optColor)
            ->where('product_has_color_plug.id_plug_product','=',$listProductOrder_cart[$i]->id_optPlug)
            ->get(

                array(
                    'quantity_product_has'
                )
            )[0];
            $list['color_product']= DB::table('products')
            ->where('products.id_product','=',$listProductOrder_cart[$i]->id_product)
            ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
            ->join('color_products','color_products.id_color_product','=','product_has_color_plug.id_color_product')
            ->distinct()
            ->get(
                array(
                   'value_color_product',
                   'color_products.id_color_product')
            );
            $list['plug_product']= DB::table('products')
            ->where('products.id_product','=',$listProductOrder_cart[$i]->id_product)
            ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
            ->join('plug_products','plug_products.id_plug_product','=','product_has_color_plug.id_plug_product')
            ->distinct()
            ->get(
                array(
                   'value_plug_product',
                   'plug_products.id_plug_product')
            );
            $list['img_product']= DB::table('products')
            ->where('products.id_product','=',$listProductOrder_cart[$i]->id_product)
            ->join('img_products','products.id_product','=','img_products.id_product')
            ->get(
                array(
                'url_img_product')
            );
            $result[$i]['list']=$list;
            $result[$i]['dataOrdered']=$listProductOrder_cart[$i];
        }
        
        return response()->json(['result'=>$result]);
    }
}

?>
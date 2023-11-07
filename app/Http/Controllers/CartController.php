<?php
namespace App\Http\Controllers;
use App\Models\CartProduct;
use App\Models\Account;
use App\Models\Product;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class CartController extends Controller{
    function SaveProductCart()
    {
        $Add_product_cart = (json_decode($_POST['productCartAdd']));  
        if(isset($_SESSION['id_loginEd']))
        {
            $newCartProduct = CartProduct::firstOrCreate(
                array(
                    'id_cart'=>$_SESSION['id_loginEd'],
                    'id_product'=>$Add_product_cart->id_product,
                    'id_color_product'=>$Add_product_cart->id_optColor,
                    'id_plug_product'=>$Add_product_cart->id_optPlug,
                    'quantity_ordered'=>$Add_product_cart->quantityOrder 
                    )
                );    

        }
        else
        {
            if(isset($_SESSION['listProductOrder_cart']))
            {
                // print_r($_SESSION['listProductOrder_cart']);
                $listProductOrder_cart=$_SESSION['listProductOrder_cart'];
                $listProductOrder_cart[intval(count($_SESSION['listProductOrder_cart']))]=$Add_product_cart;
                $_SESSION['listProductOrder_cart']= $listProductOrder_cart;
                // print_r($_SESSION['listProductOrder_cart']);
            }
            else
            {   
                $listProductOrder_cart[0]=$Add_product_cart;
                $_SESSION['listProductOrder_cart']= $listProductOrder_cart;
            }
        }
        return response()->json(['result'=>true]);
    }
    function UpdateProductCart()
    {
    $obj_OptUpdateProductCart=json_decode($_POST['obj_OptUpdateProductCart']);
       if(isset($_SESSION['id_loginEd']))
       {
        // print_r ($obj_OptUpdateProductCart);
        $result=CartProduct::where(array(
            'id_product'=>$obj_OptUpdateProductCart->id_product,
            'id_color_product'=>$obj_OptUpdateProductCart->oldOpt->id_optColor,
            'id_plug_product'=>$obj_OptUpdateProductCart->oldOpt->id_optPlug,
            'quantity_ordered'=>$obj_OptUpdateProductCart->oldOpt->quantityOrder
            ))
            ->limit(1)->update(array(
                'id_color_product'=>$obj_OptUpdateProductCart->newOpt->id_optColor,
                'id_plug_product'=>$obj_OptUpdateProductCart->newOpt->id_optPlug,
                'quantity_ordered'=>$obj_OptUpdateProductCart->newOpt->quantityOrder
                ));
       }
       else
       {
        if(isset($_SESSION['listProductOrder_cart']))
        {
            foreach($_SESSION['listProductOrder_cart'] as $item)
            {
                if($item->id_product==$obj_OptUpdateProductCart->id_product
                && $item->id_optColor==$obj_OptUpdateProductCart->oldOpt->id_optColor
                && $item->id_optPlug==$obj_OptUpdateProductCart->oldOpt->id_optPlug
                && $item->quantityOrder==$obj_OptUpdateProductCart->oldOpt->quantityOrder
                )
                {
                $item->id_optColor=$obj_OptUpdateProductCart->newOpt->id_optColor;
                $item->id_optPlug=$obj_OptUpdateProductCart->newOpt->id_optPlug;
                $item->quantityOrder=$obj_OptUpdateProductCart->newOpt->quantityOrder;
                }
            }
        }
       }
        return response()->json(['result'=>$_POST['obj_OptUpdateProductCart']]);
    } 
    function getOptProductCart(Request $request)
    {
        $result =Product::where('products.id_product','=',$request->input('id'))
        ->join('brand_products','products.id_brand_product','=','brand_products.id_brand_product')
        // ->join('category_products','products.id_category_product','=','category_products.id_category_product')
        ->join('img_products','products.id_product','=','img_products.id_product')
        ->limit(1)
        ->get(
            array(
               'name_product'
               ,'name_brand_product'
               ,'products.id_product'
            )
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
        $list['plug_product'] = Product::where('products.id_product','=',$request->input('id'))
        ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
        ->join('plug_products','plug_products.id_plug_product','=','product_has_color_plug.id_plug_product')
        ->distinct()
        ->get(
            array(
               'value_plug_product',
               'plug_products.id_plug_product')
        );
        $result['list']=$list;


        if(isset($_SESSION['id_loginEd']))
        {
            
        }
        else
        {

        }
        return response()->json(['result'=>$result]);
    }
    function getCountProductsCart()
    {
        if(!isset($_SESSION['id_loginEd']))
        return response()->json(['result'=>count($_SESSION['listProductOrder_cart'])]);
        else
        return response()->json(['result'=>count(
           CartProduct::where('id_cart'
                ,'='
                ,$_SESSION['id_loginEd']
                )->get(
                    array(
                        'id_cart_product'
                    )
                )
           )
        ]);
    }
    function getListProductCart()
    {
        $listProductOrder_cart=null;
        if(!isset($_SESSION['id_loginEd']))
        {
            if(isset($_SESSION['listProductOrder_cart']))
            {
                $listProductOrder_cart = $_SESSION['listProductOrder_cart'];
            }
            // else if()
            // {

            // } 
            else
            {
                $listProductOrder_cart=[];
            }
        }
        else
        {
            $listProductOrder_cart=CartProduct::select(
                array(
                    'id_product'
                    ,DB::raw('id_plug_product as id_optPlug')
                    ,DB::raw('id_color_product as id_optColor')
                    ,DB::raw('quantity_ordered as quantityOrder')
                )
            )
                ->where('id_cart'
                ,'='
                ,$_SESSION['id_loginEd'])
                ->get();
        }
        // print_r ($listProductOrder_cart);
        $result=[];
        for($i =0;$i<count($listProductOrder_cart);$i++)
        {
            $result[$i]=DB::table('products')
            ->where('products.id_product','=',$listProductOrder_cart[$i]->id_product)
            ->join('brand_products','products.id_brand_product','=','brand_products.id_brand_product')
        // ->join('category_products','products.id_category_product','=','category_products.id_category_product')
        ->join('img_products','products.id_product','=','img_products.id_product')
        ->limit(1)
        ->get(
            array(
               'name_product'
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
    function getId_cart_withEmail($email)
    {
        $result = Account::where('email','=',$email)
            ->get(
                array(
                    DB::raw('id_account as id_cart')
                )
        )[0];
        return $result->id_cart ;
    }
    function SaveListProductCart_forController_withEmail($email)
    {

        foreach($_SESSION['listProductOrder_cart'] as $itemProductCart)
        {
                $result=CartProduct::where(array(
                    'id_cart'=>CartController::getId_cart_withEmail($email),
                    'id_product'=>$itemProductCart->id_product,
                    'id_color_product'=>$itemProductCart->id_optColor,
                    'id_plug_product'=>$itemProductCart->id_optPlug,
                    ))
                    ->limit(1)->update(array(
                        'id_cart'=>CartController::getId_cart_withEmail($email),
                        'id_product'=>$itemProductCart->id_product,
                        'id_color_product'=>$itemProductCart->id_optColor,
                        'id_plug_product'=>$itemProductCart->id_optPlug,
                        'quantity_ordered'=>$itemProductCart->quantityOrder
                        ));
             $newCartProduct = CartProduct::firstOrCreate(
                array(
                    'id_cart'=>CartController::getId_cart_withEmail($email),
                    'id_product'=>$itemProductCart->id_product,
                    'id_color_product'=>$itemProductCart->id_optColor,
                    'id_plug_product'=>$itemProductCart->id_optPlug,
                    'quantity_ordered'=>$itemProductCart->quantityOrder      
                    )
                );    
        }
        unset($_SESSION['listProductOrder_cart']);
    }

    function getListProductCart_forController_withEmail($email)
    {

    }
    function deleteProductCart(Request $request)
    {
        $param_CartProduct=json_decode($request->input('obj_cartProduct'));
        if(isset($_SESSION['id_loginEd']))
       {
        $result=CartProduct::where(array(
            'id_product'=>$param_CartProduct->id_product,
            'id_color_product'=>$param_CartProduct->id_optColor,
            'id_plug_product'=>$param_CartProduct->id_optPlug,
            ))->delete();
       }
       else
       {
        if(isset($_SESSION['listProductOrder_cart']))
        {   
            

            for($i=0;$i<count($_SESSION['listProductOrder_cart']);$i++)
            {
                if($_SESSION['listProductOrder_cart'][$i]->id_product==$param_CartProduct->id_product
                && $_SESSION['listProductOrder_cart'][$i]->id_optColor==$param_CartProduct->id_optColor
                && $_SESSION['listProductOrder_cart'][$i]->id_optPlug==$param_CartProduct->id_optPlug
                )
                {
                    
                    unset($_SESSION['listProductOrder_cart'][$i]);
                }
            }
        }
       }
        return response()->json(['result'=>true]);
    }
}

?>
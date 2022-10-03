<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB;
session_start();
class ProductController{
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
        ->join('category_products','products.id_category_product','=','category_products.id_category_product')
        ->join('img_products','products.id_product','=','img_products.id_product')
        ->limit(1)
        ->get(
            array(
               'name_product'
               ,'rate_sale_default_product'
               ,'root_price_product'
               ,'quantity_product'
               ,'name_brand_product'
               ,'name_category_product'
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
    function getQuantityProductWithOptCharRequest(Request $request)
    {
        $obj_opt = json_decode($request->input('obj_opt'));
        $result =  Product::where('products.id_product','=',$request->input('id'))
        ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
        ->where('product_has_color_plug.id_color_product','=',$obj_opt->id_optColor)
        ->where('product_has_color_plug.id_plug_product','=',$obj_opt->id_optPlug)
        ->get(

            array(
                'quantity_product_has'
            )
        );
        return response()->json($result);
    }
    function getPrice_Sale_ProductWithOptCharRequest(Request $request)
    {
        $obj_opt = json_decode($request->input('obj_opt'));
        $result =  Product::where('products.id_product','=',$request->input('id'))
        ->join('product_has_color_plug','products.id_product','=','product_has_color_plug.id_product')
        ->where('product_has_color_plug.id_color_product','=',$obj_opt->id_optColor)
        ->where('product_has_color_plug.id_plug_product','=',$obj_opt->id_optPlug)
        ->get(

            array(
                'product_has_color_plug.root_price_product',
                'product_has_color_plug.rate_sale_default_product'
            )
        );
        return response()->json($result);
    }
    
}
?>
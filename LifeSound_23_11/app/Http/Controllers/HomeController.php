<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function indexHome() {


        $obj_ListDataBrand = HomeController::getDataBrand();
        $obj_ListCategory = HomeController::getDataCategory();
        $obj_ListTechnology = HomeController::getDataTechnology();



        return view('product.indexHome')
            ->with(['page' => 'Home'])
            ->with(['obj_ListDataBrand' => $obj_ListDataBrand])
            ->with(['obj_ListCategory' => $obj_ListCategory])
            ->with(['obj_ListTechnology' => $obj_ListTechnology]);
    }

    // ===> Function get DATA
    function getDataBrand() {
        $obj_ListDataBrand = DB::table('brand_products')->get(
            array(
                'id_brand_product'
                ,'name_brand_product'
                ,'img_brand'
            )
        );
        return $obj_ListDataBrand;
    }
    function getDataCategory() {
        $obj_ListCategory = DB::table('category_products')->get(
            array(
                'id_category_product'
                ,'name_category_product'
                ,'img_category_product'
            )
        );
        return $obj_ListCategory;
    }
    function getDataTechnology() {
        $obj_ListTechnology = DB::table('tech_sound_products')->get(
            array(
                'id_tech_sound_product'
                ,'name_tech_sound_product'
                ,'description_tech_sound_product'
                ,'logo_tech_sound_product'
            )
        );
        return $obj_ListTechnology;
    }
}

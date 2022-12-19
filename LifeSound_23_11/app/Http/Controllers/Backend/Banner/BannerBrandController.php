<?php

namespace App\Http\Controllers\Backend\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Session;


class BannerBrandController extends Controller
{
    function showUpdateBannerBrand() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $obj_ListDataBrand = BannerBrandController::getDataBrand();

            return view('adminAD.Banner.update_banner_brand')
            ->with(['obj_ListDataBrand'=>$obj_ListDataBrand]);
        }else{
            return Redirect::to('/admin');
        }
    }

    function updateBannerBrand(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $obj_ListDataBrand = BannerBrandController::getDataBrand();

            
            $multiFileImageProduct = [];
            foreach($request->allFiles('listImageBrandBanner') as $file) {
                $multiFileImageProduct[count($multiFileImageProduct)] = $file;
            }

            
            foreach($multiFileImageProduct as $subMultiFileImageProduct) {
                if($subMultiFileImageProduct) {
                    $getNameFileImage = $subMultiFileImageProduct->getClientOriginalName();
                    $nameFile_ = current(explode('.',$getNameFileImage));
                    $nameFile = explode('_',$nameFile_)[0];
                    foreach($obj_ListDataBrand as $sub_obj_ListDataBrand) {
                        $check = 'idBrand'.$sub_obj_ListDataBrand->id_brand_product;
                        if( $nameFile == $check) {
                            $url_deleteBanner = DB::table('brand_products')
                            ->where(['id_brand_product' => $sub_obj_ListDataBrand->id_brand_product])
                            ->get('url_banner_brand_product')
                            ->first()->url_banner_brand_product;
                            // dump($url_deleteBanner);
                            if($url_deleteBanner != null) {
                                $path_Image = ltrim($url_deleteBanner, '/');
                                if (File::exists($path_Image)) {
                                    File::delete($path_Image);
                                }
                            }
                            
                            $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                            $name_image = current(explode('.',$get_name_image));
                            $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                            $subMultiFileImageProduct->move('upload/Brand/Banner/',$new_image);
                            $new_link_image = '/upload/Brand/Banner/'.$new_image;
                            $url_banner_brand_product = $new_link_image;
                            $resultImageProduct = DB::table('brand_products')
                            ->where(['id_brand_product' => $sub_obj_ListDataBrand->id_brand_product])
                            ->update([
                                'url_banner_brand_product' => $url_banner_brand_product
                            ]);
                        }
                    }
                }
            }

                
            


            return $obj_ListDataBrand;
        } else {
            return Redirect::to('/admin');
        }
    }
    




    function getDataBrand() {
        $obj_ListDataBrand = DB::table('brand_products')->get(
            array(
                'id_brand_product'
                ,'name_brand_product'
                ,'img_brand'
                ,'url_banner_brand_product'
            )
        );
        return $obj_ListDataBrand;
    }
}

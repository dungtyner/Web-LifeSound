<?php

namespace App\Http\Controllers\Backend\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Session;


class BrandAdminController extends Controller
{
    function showAllBrand() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $listDataBrand = BrandAdminController::getAllBrand();
            // dd($listDataBrand);

            return view('adminAD.Brand.all-brand')
            ->with(['listDataBrand'=> $listDataBrand]);
        }else{
            return Redirect::to('/admin');
        }
    }
    function showAddBrand() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            return view('adminAD.Brand.add-brand');
        }else{
            return Redirect::to('/admin');
        }
    }
    function showUpdateBrand($id_brand_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $dataBrand = DB::table('brand_products')
            ->where(['id_brand_product'=>$id_brand_product])
            ->get(
                array(
                    'id_brand_product',
                    'name_brand_product',
                    'img_brand'
                    )
            )->first();

            // dd($dataBrand);  

            return view('adminAD.Brand.update-brand')->with(['dataBrand' => $dataBrand]);
        }else{
            return Redirect::to('/admin');
        }
    }


    function addNewBrand(Request $request) {
        $get_image = $request->file('img_brand');
        // dd($get_image);
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/Brand/',$new_image);
            $new_link_image = 'upload/Brand/'.$new_image;
            $img_brand = $new_link_image;
            $resultBrand = DB::table('brand_products')->insert([
                'name_brand_product' => $request->name_brand_product,
                'img_brand' => $img_brand
            ]);
            return $resultBrand;
        }


        return Redirect::to('admin/brand/add-brand');
    }
    function updateNewBrand(Request $request) {

        $get_image = $request->file('img_brand');
        // dd($get_image);
        if($get_image){

             // unlink image news
            $res_Image_News = DB::table('brand_products')->where('id_brand_product', $request->id_brand_product)->get(['img_brand']);
            // dd($res_Image_News[0]->news_image);
            $path_Image = ($res_Image_News[0]->img_brand);
            // dd($path_Image);
            // dump($path_Image);

            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }


            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/Brand/',$new_image);
            $new_link_image = 'upload/Brand/'.$new_image;
            $img_brand = $new_link_image;
            $resultBrand = DB::table('brand_products')
            ->where(['id_brand_product'=>$request->id_brand_product])
            ->update([
                'name_brand_product' => $request->name_brand_product,
                'img_brand' => $img_brand
            ]);
            return $resultBrand;
        }


        return Redirect::to('admin/brand/add-brand');
    }
    function deleteBrand($id_brand_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

             // unlink image news
            $res_Image_News = DB::table('brand_products')->where('id_brand_product', $id_brand_product)->get(['img_brand']);
            $path_Image = ($res_Image_News[0]->img_brand);
            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }
            $dataBrand = DB::table('brand_products')
            ->where(['id_brand_product'=>$id_brand_product])
            ->delete(); 

            return Redirect::to('/admin/brand/all-brand');
        }else{
            return Redirect::to('/admin');
        }
    }




    function getAllBrand() {
        $dataBrand = DB::table('brand_products')
        ->get(
            array(
                'id_brand_product',
                'name_brand_product',
                'img_brand'
                )
        );
        return $dataBrand;
    }
}

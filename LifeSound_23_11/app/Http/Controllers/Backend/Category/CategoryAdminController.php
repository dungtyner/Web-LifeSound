<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Session;

class CategoryAdminController extends Controller
{
    function showAllCategory() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataCategory = CategoryAdminController::getAllCategory();
            // dd($dataCategory);

            return view('adminAD.Category.all-categogy')
            ->with(['listdataCategory'=> $dataCategory]);
        }else{
            return Redirect::to('/admin');
        }
    }
    function showAddCategory() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            return view('adminAD.Category.add-categogy');
        }else{
            return Redirect::to('/admin');
        }
    }
    function showUpdateCategory($id_category_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $dataCategory = DB::table('category_products')
            ->where(['id_category_product'=>$id_category_product])
            ->get(
                array(
                    'id_category_product',
                    'name_category_product',
                    'img_category_product'
                    )
            )->first();

            // dd($dataBrand);  

            return view('adminAD.Category.update-category')->with(['dataCategory' => $dataCategory]);
        }else{
            return Redirect::to('/admin');
        }
    }


    function addNewCategory(Request $request) {
        $get_image = $request->file('img_category_product');
        // dd($get_image);
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/Category/',$new_image);
            $new_link_image = 'upload/Category/'.$new_image;
            $img_category_product = $new_link_image;
            $resultCategory = DB::table('category_products')->insert([
                'name_category_product' => $request->name_category_product,
                'img_category_product' => $img_category_product
            ]);
            return $resultCategory;
        }


        return Redirect::to('admin/category/add-category');
    }
    function updateNewCategory(Request $request) {
        $get_image = $request->file('img_category_product');
        // dd($get_image);
        if($get_image){

             // unlink image news
            $res_Image_News = DB::table('category_products')->where('id_category_product', $request->id_category_product)->get(['img_category_product']);
            // dd($res_Image_News[0]->news_image);
            $path_Image = ($res_Image_News[0]->img_category_product);
            // dd($path_Image);
            // dump($path_Image);

            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }


            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/Category/',$new_image);
            $new_link_image = 'upload/Category/'.$new_image;
            $img_category_product = $new_link_image;
            $resultCategory = DB::table('category_products')
            ->where(['id_category_product'=>$request->id_category_product])
            ->update([
                'name_category_product' => $request->name_category_product,
                'img_category_product' => $img_category_product
            ]);
            return $resultCategory;
        }
        return Redirect::to('admin/category/all-category');
    }
    function deleteCategory($id_category_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            // unlink image news
            $res_Image_News = DB::table('category_products')->where('id_category_product', $id_category_product)->get(['img_category_product']);
            $path_Image = ($res_Image_News[0]->img_category_product);
            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }
            $dataCategory = DB::table('category_products')
            ->where(['id_category_product'=>$id_category_product])
            ->delete(); 

            return Redirect::to('/admin/category/all-category');
        }else{
            return Redirect::to('/admin');
        }
    }


    function getAllCategory() {
        $dataCategory = DB::table('category_products')
        ->get(
            array(
                'id_category_product',
                'name_category_product',
                'img_category_product'
                )
        );
        return $dataCategory;
    }
}

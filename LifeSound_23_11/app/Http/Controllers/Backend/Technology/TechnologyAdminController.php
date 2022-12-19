<?php

namespace App\Http\Controllers\Backend\Technology;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

use Session;
class TechnologyAdminController extends Controller
{
    function showAllTechnology() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataTechnology = TechnologyAdminController::getAllTechnology();

            return view('adminAD.Technology.all-technology')
            ->with(['listdataTechnology'=> $dataTechnology]);
        }else{
            return Redirect::to('/admin');
        }
    }
    function showAddTechnology() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            return view('adminAD.Technology.add-technology');
        }else{
            return Redirect::to('/admin');
        }
    }
    function showUpdateTechnology($id_tech_sound_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $dataTechnology = DB::table('tech_sound_products')
            ->where(['id_tech_sound_product'=>$id_tech_sound_product])
            ->get(
                array(
                    'id_tech_sound_product',
                    'name_tech_sound_product',
                    'description_tech_sound_product',
                    'logo_tech_sound_product'
                    )
            )->first();
            return view('adminAD.Technology.update-technology')->with(['dataTechnology' => $dataTechnology]);
        }else{
            return Redirect::to('/admin');
        }
    }



    function addNewTechnology(Request $request) {
        $get_image = $request->file('logo_tech_sound_product');
        // dd($get_image);
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/Technology/',$new_image);
            $new_link_image = 'upload/Technology/'.$new_image;
            $logo_tech_sound_product = $new_link_image;
            $resultTechnology = DB::table('tech_sound_products')->insert([
                'name_tech_sound_product' => $request->name_tech_sound_product,
                'description_tech_sound_product' => $request->description_tech_sound_product,
                'logo_tech_sound_product' => $logo_tech_sound_product
            ]);
            return $resultTechnology;
        }


        return Redirect::to('admin/technology/add-technology');
    }
    function updateNewTechnology(Request $request) {
        $get_image = $request->file('logo_tech_sound_product');
        // dd($get_image);
        if($get_image){

             // unlink image news
            $res_Image_News = DB::table('tech_sound_products')->where('id_tech_sound_product', $request->id_tech_sound_product)->get(['logo_tech_sound_product']);
            // dd($res_Image_News[0]->news_image);
            $path_Image = ($res_Image_News[0]->logo_tech_sound_product);
            // dd($path_Image);
            // dump($path_Image);

            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }


            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/Technology/',$new_image);
            $new_link_image = 'upload/Technology/'.$new_image;
            $logo_tech_sound_product = $new_link_image;
            $resultTechnology = DB::table('tech_sound_products')
            ->where(['id_tech_sound_product'=>$request->id_tech_sound_product])
            ->update([
                'id_tech_sound_product' => $request->id_tech_sound_product,
                'name_tech_sound_product' => $request->name_tech_sound_product,
                'description_tech_sound_product' => $request->description_tech_sound_product,
                'logo_tech_sound_product' => $logo_tech_sound_product
            ]);
            return $resultTechnology;
        }
        return Redirect::to('admin/technology/all-technology');
    }
    function deleteTechnology($id_tech_sound_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            // unlink image news
            $res_Image_News = DB::table('tech_sound_products')->where('id_tech_sound_product', $id_tech_sound_product)->get(['logo_tech_sound_product']);
            $path_Image = ($res_Image_News[0]->logo_tech_sound_product);
            if (File::exists($path_Image)) {
                File::delete($path_Image);
            }
            $dataTechnology = DB::table('tech_sound_products')
            ->where(['id_tech_sound_product'=>$id_tech_sound_product])
            ->delete(); 

            return Redirect::to('/admin/technology/all-technology');
        }else{
            return Redirect::to('/admin');
        }
    }

    function getAllTechnology() {
        $dataCategory = DB::table('tech_sound_products')
        ->get(
            array(
                'id_tech_sound_product',
                'name_tech_sound_product',
                'description_tech_sound_product',
                'logo_tech_sound_product'
                )
        );
        return $dataCategory;
    }
}

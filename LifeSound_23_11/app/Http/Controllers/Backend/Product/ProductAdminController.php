<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Session;
use stdClass;

class ProductAdminController extends Controller
{
    // ===> Display Info Page
    function showAllProduct() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $listDataProduct = ProductAdminController::getDataProduct();

            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            // $page = count($listDataProduct);
            $limit = 5;
            $start = ($page - 1) * $limit;    
            $total_content = count($listDataProduct);
            $total_page = $total_content / $limit;
            if(round($total_page) < $total_page) {
                $total_page = $total_page + 1;
                $total_page = round($total_page);
            } else {
                $total_page = round($total_page);
            }

            $listDataProduct = ProductAdminController::getDataProductForPage($start, $limit);





            return view('adminAD.Product.all-product')
            ->with(['listDataProduct'=>$listDataProduct])
            ->with(['total_page'=>$total_page]);
        }else{
            return Redirect::to('/admin');
        }
    }
    function showAddProduct() {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $obj_ListDataBrand = ProductAdminController::getDataBrand();
            $obj_ListCategory = ProductAdminController::getDataCategory();
            $obj_ListTechnology = ProductAdminController::getDataTechnology();
            $obj_ListColor = ProductAdminController::getDataColor();
            $obj_ListPlug = ProductAdminController::getDataPlug();


            return view('adminAD.Product.add-product')
            ->with(['obj_ListDataBrand' => $obj_ListDataBrand])
            ->with(['obj_ListCategory' => $obj_ListCategory])
            ->with(['obj_ListTechnology' => $obj_ListTechnology])
            ->with(['obj_ListColor' => $obj_ListColor])
            ->with(['obj_ListPlug' => $obj_ListPlug]);
        }else{
            return Redirect::to('/admin');
        }
    }
    function showUpdateNameBrandProduct($id_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataProduct = DB::table('products')
            ->where(['id_product'=>$id_product])
            ->get(
                array(
                    'id_product',
                    'name_product',
                    'id_brand_product'
                    )
            )
            ->first();
            $obj_ListDataBrand = ProductAdminController::getDataBrand();
            return view('adminAD.Product.update-name-brand-product')
            ->with(['dataProduct'=>$dataProduct])
            ->with(['obj_ListDataBrand'=>$obj_ListDataBrand]);
        }else{
            return Redirect::to('/admin');
        }
    } 
    function showUpdateCategoryTechnologyProduct($id_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataCategoryProductID = DB::table('product_has_cagetories')
            ->where(['id_product'=>$id_product])
            ->get(
                array(
                    'id_product_cagetory'
                    )
            );
            $dataCategoryProduct = [];
            foreach($dataCategoryProductID as $subDataCategoryProductID) {
                $dataCategoryProduct[count($dataCategoryProduct)] = DB::table('category_products')
                ->where(['id_category_product'=>$subDataCategoryProductID->id_product_cagetory])
                ->get(
                    array(
                        'id_category_product',
                        'name_category_product'
                        )
                )
                ->first();
            }
            $dataTechnologyProductID = DB::table('product_has_tech_sound')
            ->where(['id_product'=>$id_product])
            ->get(
                array(
                    'id_tech_sound_product'
                    )
            );
            $dataTechnologyProduct = [];
            foreach($dataTechnologyProductID as $subDataTechnologyProductID) {
                $dataTechnologyProduct[count($dataTechnologyProduct)] = DB::table('tech_sound_products')
                ->where(['id_tech_sound_product'=>$subDataTechnologyProductID->id_tech_sound_product])
                ->get(
                    array(
                        'id_tech_sound_product',
                        'name_tech_sound_product'
                        )
                )
                ->first();
            }
            $obj_ListCategory = ProductAdminController::getDataCategory();
            $obj_ListTechnology = ProductAdminController::getDataTechnology();

            return view('adminAD.Product.update-category-technology-product')
            ->with(['id_product'=>$id_product])
            ->with(['dataCategoryProduct'=>$dataCategoryProduct])
            ->with(['dataTechnologyProduct'=>$dataTechnologyProduct])
            ->with(['obj_ListCategory'=>$obj_ListCategory])
            ->with(['obj_ListTechnology'=>$obj_ListTechnology]);
        }else{
            return Redirect::to('/admin');
        }
    }
    function showImageProduct($id_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $dataImageProduct = DB::table('img_products')
            ->where(['id_product'=>$id_product])
            ->get(
                array(
                    'id_img_product',
                    'url_img_product'
                    )
                );
            // dump($dataImageProduct);

            return view('adminAD.Product.update-image-product')
            ->with(['id_product'=>$id_product])
            ->with(['dataImageProduct'=>$dataImageProduct]);
        }else{
            return Redirect::to('/admin');
        }
    }
    function showSubProduct($id_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){


            $dataSubProduct = DB::table('product_has_color_plug')
            ->where(['id_product'=>$id_product])
            ->get(
                array(
                    'id_color_product',
                    'id_plug_product',
                    'quantity_product_has',
                    'root_price_product',
                    'url_image_color_sub_product'
                    )
                );

            $obj_ListColor = ProductAdminController::getDataColor();
            $obj_ListPlug = ProductAdminController::getDataPlug();


            return view('adminAD.Product.update-sub-product')
            ->with(['id_product'=>$id_product])
            ->with(['dataSubProduct'=>$dataSubProduct])
            ->with(['obj_ListColor'=>$obj_ListColor])
            ->with(['obj_ListPlug'=>$obj_ListPlug]);

        }else{
            return Redirect::to('/admin');
        }
    }
    function showDescriptionProduct($id_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $dataDescription = DB::table('description_products')
            ->where(['id_product'=>$id_product])
            ->get(
                array(
                    'id_description_product',
                    'title_description',
                    'content_description'
                    )
                );
            foreach($dataDescription as $subDataDescription) {
                $dataListImageDescProduct = DB::table('img_description_products')
                ->where(['id_description_product'=>$subDataDescription->id_description_product])
                ->get(
                    array(
                        'url_img_description_product'
                        )
                    );
                $subDataDescription->url_img_description_product = json_decode($dataListImageDescProduct);
            }
            
                // dump($dataDescription);


            return view('adminAD.Product.update-description-product')
            ->with(['id_product'=>$id_product])
            ->with(['dataDescription'=>$dataDescription]);

        }else{
            return Redirect::to('/admin');
        }
    }




    // ===> Function process product
    function addNewProduct(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $name_product = $request->name_product;
            $id_brand_product = $request->id_brand_product;

            $listCategory = json_decode($request->listCategory);
            $listTechnology = json_decode($request->listTechnology);

            $listDescriptionProduct = json_decode($request->listDescriptionProduct);
            $multiFileImageProduct = [];
            foreach($request->allFiles('listFileImage') as $file) {
                $multiFileImageProduct[count($multiFileImageProduct)] = $file;
            }
            $listSubProduct = json_decode($request->listSubProduct);

            $id_product = DB::table('products')->insertGetId(
                ['name_product' => $name_product, 
                'id_brand_product' => intval($id_brand_product)]
            );
            foreach($multiFileImageProduct as $subMultiFileImageProduct) {
                if($subMultiFileImageProduct) {
                    $getNameFileImage = $subMultiFileImageProduct->getClientOriginalName();
                    $nameFile_ = current(explode('.',$getNameFileImage));
                    $nameFile = explode('_',$nameFile_)[0];
                    if($nameFile == 'imageProduct') {
                        $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                        $name_image = current(explode('.',$get_name_image));
                        $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                        $subMultiFileImageProduct->move('upload/Product/',$new_image);
                        $new_link_image = '/upload/Product/'.$new_image;
                        $url_img_product = $new_link_image;
                        $resultImageProduct = DB::table('img_products')->insert([
                            'id_product' => $id_product,
                            'url_img_product' => $url_img_product,
                            'id_color_product' => intval('0'),
                            'id_plug_product' => intval('0')
                        ]);
                    } 
                }
            }

            foreach($listCategory as $subListCategory) {
                $resultCategory = DB::table('product_has_cagetories')->insert([
                    'id_product_cagetory' => intval($subListCategory->id_category_product),
                    'id_product' => $id_product
                ]);
            }
            foreach($listTechnology as $subListTechnology) {
                $resultTechnology = DB::table('product_has_tech_sound')->insert([
                    'id_tech_sound_product' => intval($subListTechnology->id_tech_sound_product),
                    'id_product' => $id_product
                ]);
            }

            $id_description_product = [];
            foreach($listDescriptionProduct as $subListDescriptionProduct) {
                $id_description_product[count($id_description_product)] = DB::table('description_products')->insertGetId([
                    'title_description' => $subListDescriptionProduct->titleDescription,
                    'content_description' => $subListDescriptionProduct->contentDescription,
                    'id_product' => $id_product
                ]);
            }

            $idSubColorProduct = [];
            foreach($listSubProduct as $subListSubProduct) {
                $idSubColorProduct[count($idSubColorProduct)] = DB::table('product_has_color_plug')->insertGetId([
                    'id_product' => $id_product,
                    'id_color_product' => $subListSubProduct->id_color_product,
                    'id_plug_product' => $subListSubProduct->id_plug_product,
                    'quantity_product_has' => $subListSubProduct->quantity_product_has,
                    'root_price_product' => $subListSubProduct->root_price_product
                ]);
            }
            $countImageColor = 0;
            foreach($multiFileImageProduct as $subMultiFileImageProduct) {
                $getNameFileImage = $subMultiFileImageProduct->getClientOriginalName();
                $nameFile_ = current(explode('.',$getNameFileImage));
                $nameFile = explode('_',$nameFile_)[0];
                if($nameFile == 'subProductColor') {
                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/Product/SubProduct/',$new_image);
                    $new_link_image = '/upload/Product/SubProduct/'.$new_image;
                    $url_image_color_sub_product = $new_link_image;
                    $resultImageProduct1 = DB::table('product_has_color_plug')
                    ->where(['id_product_has_color_plug' => $idSubColorProduct[$countImageColor]])
                    ->update([
                        'url_image_color_sub_product' => $url_image_color_sub_product
                    ]);
                    $countImageColor = $countImageColor + 1;
                }
            }


            foreach($multiFileImageProduct as $subMultiFileImageProduct) {
                $getNameFileImage = $subMultiFileImageProduct->getClientOriginalName();
                $nameFile_ = current(explode('.',$getNameFileImage));
                $nameFile = explode('_',$nameFile_)[0];
                if($nameFile == 'mota1') {
                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/ImageDescriptProduct/',$new_image);
                    $new_link_image = '/upload/ImageDescriptProduct/'.$new_image;
                    $url_img_description_product = $new_link_image;
                    $resultImageProduct1 = DB::table('img_description_products')->insert([
                        'id_description_product' => $id_description_product[0],
                        'url_img_description_product' => $url_img_description_product
                    ]);
                } else if ($nameFile == 'mota2') {
                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/ImageDescriptProduct/',$new_image);
                    $new_link_image = '/upload/ImageDescriptProduct/'.$new_image;
                    $url_img_description_product = $new_link_image;
                    $resultImageProduct2 = DB::table('img_description_products')->insert([
                        'id_description_product' => $id_description_product[1],
                        'url_img_description_product' => $url_img_description_product
                    ]);
                } else if ($nameFile == 'mota3') {

                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/ImageDescriptProduct/',$new_image);
                    $new_link_image = '/upload/ImageDescriptProduct/'.$new_image;
                    $url_img_description_product = $new_link_image;
                    $resultImageProduct3 = DB::table('img_description_products')->insert([
                        'id_description_product' => $id_description_product[2],
                        'url_img_description_product' => $url_img_description_product
                    ]);
                } else if ($nameFile == 'mota4') {

                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/ImageDescriptProduct/',$new_image);
                    $new_link_image = '/upload/ImageDescriptProduct/'.$new_image;
                    $url_img_description_product = $new_link_image;
                    $resultImageProduct4 = DB::table('img_description_products')->insert([
                        'id_description_product' => $id_description_product[3],
                        'url_img_description_product' => $url_img_description_product
                    ]);
                }
            }

            $notification = DB::table('notification_page')->insert([
                'notification_object' => 0,
                'notification_type' => 'notification_all',
                'notification_avt' => '/images/owl.png',
                'notification_title' => 'Thông Báo Sản Phẩm Mới',
                'notification_content' => 'Life Sound vừa đăng sản phẩm mới: '.$name_product
            ]);
                
            


            return $id_product;
        } else {
            return Redirect::to('/admin');
        }
    }
    // ===> Function Delete product
    function deleteProduct($id_product) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){

            $id_description_product = DB::table('description_products')->where('id_product', $id_product)->get(['id_description_product']);
            // unlink image description product
            foreach($id_description_product as $sub_id_description_product) {
                $res_Image_Desc_Product = DB::table('img_description_products')->where('id_description_product', $sub_id_description_product->id_description_product)->get(['url_img_description_product']);
                foreach($res_Image_Desc_Product as $sub_res_Image_Desc_Product) {
                    $path_Desc_Image = ltrim($sub_res_Image_Desc_Product->url_img_description_product, '/');
                    // dump($path_Desc_Image);
                    if (File::exists($path_Desc_Image)) {
                        File::delete($path_Desc_Image);
                    }
                }
            }
            // unlink image product
            $res_Image_News = DB::table('img_products')->where('id_product', $id_product)->get(['url_img_product']);
            foreach($res_Image_News as $sub_res_Image_News) {
                $path_Image = ltrim($sub_res_Image_News->url_img_product, '/');
                // dump($path_Image);

                if (File::exists($path_Image)) {
                    File::delete($path_Image);
                }
            }

            $url_image_color_sub_product = DB::table('product_has_color_plug')->where('id_product', $id_product)->get(['url_image_color_sub_product']);
            // unlink image sub product
            foreach($url_image_color_sub_product as $sub_url_image_color_sub_product) {
                $path_Image = ltrim($sub_url_image_color_sub_product->url_image_color_sub_product, '/');
                // dump($path_Image);
                if (File::exists($path_Image)) {
                    File::delete($path_Image);
                }
            }
            

            // deleted data image description product
            foreach($id_description_product as $sub_id_description_product) { 
                $dataImgDescriptionProduct = DB::table('img_description_products')
                ->where(['id_description_product'=>$sub_id_description_product->id_description_product])
                ->delete();
            }
            // deleted data description product
            $dataDescriptionProduct = DB::table('description_products')
            ->where(['id_product'=>$id_product])
            ->delete();
            // deleted data category product
            $dataCategoryProduct = DB::table('product_has_cagetories')
            ->where(['id_product'=>$id_product])
            ->delete();
            // deleted data technology product
            $dataTechnologyProduct = DB::table('product_has_tech_sound')
            ->where(['id_product'=>$id_product])
            ->delete();
            // deleted data sub product
            $dataSubProduct = DB::table('product_has_color_plug')
            ->where(['id_product'=>$id_product])
            ->delete();

            // deleted data order information
            $dataOrderInfo = DB::table('order_information')
            ->where(['id_product'=>$id_product])
            ->delete();
            
            // deleted data cart product
            $dataCartProduct = DB::table('carts_product')
            ->where(['id_product'=>$id_product])
            ->delete();

            // deleted image product
            $dataImageProduct = DB::table('img_products')
            ->where(['id_product'=>$id_product])
            ->delete();

            // deleted main product
            $dataProduct = DB::table('products')
            ->where(['id_product'=>$id_product])
            ->delete();

            return Redirect::to('/admin/product/all-product');
            // return $res_Image_News;
        }else{
            return Redirect::to('/admin');
        }
    }
    // ===> Function Update Name Brand Product
    function updateNameBrandProduct(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $id_product = $request->id_product;
            $name_product = $request->name_product;
            $id_brand_product = $request->id_brand_product;
            
            $resultUpdateProducts = DB::table('products')
            ->where(['id_product'=>$id_product])
            ->update([
                'name_product' => $name_product,
                'id_brand_product' => $id_brand_product
            ]);



            return $resultUpdateProducts;
        }else{
            return Redirect::to('/admin');
        }
    }
    // ===> function Update Category Technology Product 
    function updateCategoryTechnologyProduct(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $id_product = $request->id_product;
            $listCategory = json_decode($request->listCategory);
            $listTechnology = json_decode($request->listTechnology);
            
            $deleteCategory = DB::table('product_has_cagetories')
            ->where(['id_product'=>$id_product])
            ->delete();
            $deleteTechnology = DB::table('product_has_tech_sound')
            ->where(['id_product'=>$id_product])
            ->delete();


            foreach($listCategory as $subListCategory) {
                $resultCategory = DB::table('product_has_cagetories')->insert([
                    'id_product_cagetory' => $subListCategory->id_category_product,
                    'id_product' => $id_product
                ]);
            }
            foreach($listTechnology as $subListTechnology) {
                $resultTechnology = DB::table('product_has_tech_sound')->insert([
                    'id_tech_sound_product' => $subListTechnology->id_tech_sound_product,
                    'id_product' => $id_product
                ]);
            }
            return $id_product;
        }else{
            return Redirect::to('/admin');
        }
    }
    // ===> function Update Image Product 
    function updateImageProduct(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $id_product = $request->id_product;

            $case = $request->case;
            if($case == 'case2') {
                $listIdDeleteImage = json_decode($request->listIdDeleteImage);
                foreach($listIdDeleteImage as $subListIdDeleteImage) {
                    $id_img_product_old = DB::table('img_products')
                    ->where(['id_img_product'=>intval($subListIdDeleteImage)])
                    ->get('url_img_product')
                    ->first();
                    // dump($id_img_product_old->url_img_product);
                    $path_Image = ltrim($id_img_product_old->url_img_product, '/');
                    if (File::exists($path_Image)) {
                        File::delete($path_Image);
                    }
                    $deleteOldImageProduct = DB::table('img_products')
                    ->where(['id_img_product'=>$subListIdDeleteImage])
                    ->delete();
                }
            } else if($case == 'case3') {
                $multiFileImageProduct = [];
                foreach($request->allFiles('listFileImage') as $file) {
                    $multiFileImageProduct[count($multiFileImageProduct)] = $file;
                }
                foreach($multiFileImageProduct as $subMultiFileImageProduct) {
                    if($subMultiFileImageProduct) {
                        $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                        $name_image = current(explode('.',$get_name_image));
                        $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                        $subMultiFileImageProduct->move('upload/Product/',$new_image);
                        $new_link_image = '/upload/Product/'.$new_image;
                        $url_img_product = $new_link_image;
                        $resultImageProduct = DB::table('img_products')->insert([
                            'id_product' => $id_product,
                            'url_img_product' => $url_img_product,
                            'id_color_product' => intval('0'),
                            'id_plug_product' => intval('0')
                        ]);
                    } 
                    
                }

            } else if($case == 'case4') {
                $listIdDeleteImage = json_decode($request->listIdDeleteImage);
                foreach($listIdDeleteImage as $subListIdDeleteImage) {
                    $id_img_product_old = DB::table('img_products')
                    ->where(['id_img_product'=>intval($subListIdDeleteImage)])
                    ->get('url_img_product')
                    ->first();
                    // dump($id_img_product_old->url_img_product);
                    $path_Image = ltrim($id_img_product_old->url_img_product, '/');
                    if (File::exists($path_Image)) {
                        File::delete($path_Image);
                    }
                    $deleteOldImageProduct = DB::table('img_products')
                    ->where(['id_img_product'=>$subListIdDeleteImage])
                    ->delete();
                }

                $multiFileImageProduct = [];
                foreach($request->allFiles('listFileImage') as $file) {
                    $multiFileImageProduct[count($multiFileImageProduct)] = $file;
                }
                foreach($multiFileImageProduct as $subMultiFileImageProduct) {
                    if($subMultiFileImageProduct) {
                        $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                        $name_image = current(explode('.',$get_name_image));
                        $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                        $subMultiFileImageProduct->move('upload/Product/',$new_image);
                        $new_link_image = '/upload/Product/'.$new_image;
                        $url_img_product = $new_link_image;
                        $resultImageProduct = DB::table('img_products')->insert([
                            'id_product' => $id_product,
                            'url_img_product' => $url_img_product,
                            'id_color_product' => intval('0'),
                            'id_plug_product' => intval('0')
                        ]);
                    } 
                    
                }
            }

            return $id_product;
        }else{
            return Redirect::to('/admin');
        }
    }
    // ===> function Sub Product 
    function updateSubProduct(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $id_product = $request->id_product;
            $multiFileImageProduct = [];

            foreach($request->allFiles('listSubImageColorProduct') as $file) {
                $multiFileImageProduct[count($multiFileImageProduct)] = $file;
            }

            $url_image_color_sub_product = DB::table('product_has_color_plug')->where('id_product', $id_product)->get(['url_image_color_sub_product']);
            // unlink image sub product
            foreach($url_image_color_sub_product as $sub_url_image_color_sub_product) {
                $path_Image = ltrim($sub_url_image_color_sub_product->url_image_color_sub_product, '/');
                // dump($path_Image);
                if (File::exists($path_Image)) {
                    File::delete($path_Image);
                }
            }

            $deleteListSubProductOld = DB::table('product_has_color_plug')
            ->where(['id_product'=>$id_product])
            ->delete();

            $listSubProduct = json_decode($request->listSubProduct);
            $idSubColorProduct = [];
            foreach($listSubProduct as $subListSubProduct) {
                $idSubColorProduct[count($idSubColorProduct)] = DB::table('product_has_color_plug')->insertGetId([
                    'id_product' => $id_product,
                    'id_color_product' => $subListSubProduct->id_color_product,
                    'id_plug_product' => $subListSubProduct->id_plug_product,
                    'quantity_product_has' => $subListSubProduct->quantity_product_has,
                    'root_price_product' => $subListSubProduct->root_price_product
                ]);
            }

            $countImageColor = 0;
            foreach($multiFileImageProduct as $subMultiFileImageProduct) {
                $getNameFileImage = $subMultiFileImageProduct->getClientOriginalName();
                $nameFile_ = current(explode('.',$getNameFileImage));
                $nameFile = explode('_',$nameFile_)[0];
                if($nameFile == 'subProductColor') {
                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/Product/SubProduct/',$new_image);
                    $new_link_image = '/upload/Product/SubProduct/'.$new_image;
                    $url_image_color_sub_product = $new_link_image;
                    $resultImageProduct1 = DB::table('product_has_color_plug')
                    ->where(['id_product_has_color_plug' => $idSubColorProduct[$countImageColor]])
                    ->update([
                        'url_image_color_sub_product' => $url_image_color_sub_product
                    ]);
                    $countImageColor = $countImageColor + 1;
                }
            }

            return $countImageColor;
        }else{
            return Redirect::to('/admin');
        }
    }
    // ===> function Description Product 
    function updateDescriptionProduct(Request $request) {
        $inforAdmin = Session::get('inforAdmin');
        if($inforAdmin){
            $id_product = $request->id_product;
            
            $id_description_product = DB::table('description_products')->where('id_product', $id_product)->get(['id_description_product']);
            // unlink image description product
            foreach($id_description_product as $sub_id_description_product) {
                $res_Image_Desc_Product = DB::table('img_description_products')->where('id_description_product', $sub_id_description_product->id_description_product)->get(['url_img_description_product']);
                foreach($res_Image_Desc_Product as $sub_res_Image_Desc_Product) {
                    $path_Desc_Image = ltrim($sub_res_Image_Desc_Product->url_img_description_product, '/');
                    // dump($path_Desc_Image);
                    if (File::exists($path_Desc_Image)) {
                        File::delete($path_Desc_Image);
                    }
                }
            }

            // deleted data image description product
            foreach($id_description_product as $sub_id_description_product) { 
                $dataImgDescriptionProduct = DB::table('img_description_products')
                ->where(['id_description_product'=>$sub_id_description_product->id_description_product])
                ->delete();
            }
            // deleted data description product
            $dataDescriptionProduct = DB::table('description_products')
            ->where(['id_product'=>$id_product])
            ->delete();



            $listDescriptionProduct = json_decode($request->listDescriptionProduct);
            $id_description_product = [];
            foreach($listDescriptionProduct as $subListDescriptionProduct) {
                $id_description_product[count($id_description_product)] = DB::table('description_products')->insertGetId([
                    'title_description' => $subListDescriptionProduct->titleDescription,
                    'content_description' => $subListDescriptionProduct->contentDescription,
                    'id_product' => $id_product
                ]);
            }

            $multiFileImageProduct = [];
            foreach($request->allFiles('listFileImage') as $file) {
                $multiFileImageProduct[count($multiFileImageProduct)] = $file;
            }
            foreach($multiFileImageProduct as $subMultiFileImageProduct) {
                $getNameFileImage = $subMultiFileImageProduct->getClientOriginalName();
                $nameFile_ = current(explode('.',$getNameFileImage));
                $nameFile = explode('_',$nameFile_)[0];
                if($nameFile == 'mota1') {
                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/ImageDescriptProduct/',$new_image);
                    $new_link_image = '/upload/ImageDescriptProduct/'.$new_image;
                    $url_img_description_product = $new_link_image;
                    $resultImageProduct1 = DB::table('img_description_products')->insert([
                        'id_description_product' => $id_description_product[0],
                        'url_img_description_product' => $url_img_description_product
                    ]);
                } else if ($nameFile == 'mota2') {
                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/ImageDescriptProduct/',$new_image);
                    $new_link_image = '/upload/ImageDescriptProduct/'.$new_image;
                    $url_img_description_product = $new_link_image;
                    $resultImageProduct2 = DB::table('img_description_products')->insert([
                        'id_description_product' => $id_description_product[1],
                        'url_img_description_product' => $url_img_description_product
                    ]);
                } else if ($nameFile == 'mota3') {

                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/ImageDescriptProduct/',$new_image);
                    $new_link_image = '/upload/ImageDescriptProduct/'.$new_image;
                    $url_img_description_product = $new_link_image;
                    $resultImageProduct3 = DB::table('img_description_products')->insert([
                        'id_description_product' => $id_description_product[2],
                        'url_img_description_product' => $url_img_description_product
                    ]);
                } else if ($nameFile == 'mota4') {

                    $get_name_image = $subMultiFileImageProduct->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$subMultiFileImageProduct->getClientOriginalExtension();
                    $subMultiFileImageProduct->move('upload/ImageDescriptProduct/',$new_image);
                    $new_link_image = '/upload/ImageDescriptProduct/'.$new_image;
                    $url_img_description_product = $new_link_image;
                    $resultImageProduct4 = DB::table('img_description_products')->insert([
                        'id_description_product' => $id_description_product[3],
                        'url_img_description_product' => $url_img_description_product
                    ]);
                }
            }


            return $id_product;
        }else{
            return Redirect::to('/admin');
        }
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
    function getDataColor() {
        $obj_ListColor = DB::table('color_products')->get(
            array(
                'id_color_product'
                ,'value_color_product'
            )
        );
        return $obj_ListColor;
    }
    function getDataPlug() {
        $obj_ListPlug = DB::table('plug_products')->get(
            array(
                'id_plug_product'
                ,'value_plug_product'
            )
        );
        return $obj_ListPlug;
    }

    function getDataProduct() {
        $obj_ListDataProduct = new stdClass();
        $obj_subListDataProduct = DB::table('products')
        ->get(
            array(
                'id_product'
                ,'name_product'
                ,'id_brand_product'
            )
        )
        
        ;

        $ListProduct = [];
        foreach($obj_subListDataProduct as $item) {
            $subListImageProduct = DB::table('img_products')
            ->select('url_img_product')
            ->where(['id_product'=>$item->id_product])
            ->first()->url_img_product;
            // dd($subListImageProduct);

            $item->url_img_product = $subListImageProduct;

            $ListProduct[count($ListProduct)] = (object)$item;
        }

        $obj_ListDataProduct = $ListProduct;
        // dd($obj_ListDataProduct);
        return $obj_ListDataProduct;
    }
    function getDataProductForPage($start, $limit) {
        $obj_ListDataProduct = new stdClass();
        $obj_subListDataProduct = DB::table('products')
        ->offset($start)->limit($limit)
        ->get(
            array(
                'id_product'
                ,'name_product'
                ,'id_brand_product'
            )
        )
        
        ;

        $ListProduct = [];
        foreach($obj_subListDataProduct as $item) {
            $subListImageProduct = DB::table('img_products')
            ->select('url_img_product')
            ->where(['id_product'=>$item->id_product])
            ->first()->url_img_product;
            // dd($subListImageProduct);

            $item->url_img_product = $subListImageProduct;

            $ListProduct[count($ListProduct)] = (object)$item;
        }

        $obj_ListDataProduct = $ListProduct;
        // dd($obj_ListDataProduct);
        return $obj_ListDataProduct;
    }
}

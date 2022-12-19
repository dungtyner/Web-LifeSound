@extends('adminAD.indexAdmin')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title" style="">
            Quản Lý Sản Phẩm
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                {{-- <i class="fa fa-certificate" aria-hidden="true" style="color: black;"></i> --}}
                <i class="fa fa-braille" aria-hidden="true" style="color: black;"></i>
            </span> 
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="mdi mdi-timetable"></i>
                    <span><?php
                    $today = date('d/m/Y');
                    echo $today;
                    ?></span>
                </li>
            </ul>
        </nav>
    </div>


    <div class="col-lg-12 grid-margin stretch-card" style="margin-bottom: 100px;">
        <div class="card" style="border: 2px solid black;">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9" style="font-size: 30px; font-weight: 900;  text-shadow: 0px 3px 0px #b2a98f,
                    0px 14px 10px rgba(0,0,0,0.15),
                    0px 24px 2px rgba(0,0,0,0.1),
                    0px 34px 30px rgba(0,0,0,0.1);">Thêm Sản Phẩm Mới</div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <div class="form-group col-md-5">
                                <button class="button-30" role="button" disabled>Tên Sản Phẩm</button>
                            </div>
                            <div class="form-group col-md-7">
                                <input type="text" class="form-control" id="name_product" placeholder="Nhập tên sản phẩm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-5">
                                <button class="button-30" role="button" disabled>Tên Thương Hiệu</button>
                            </div>
                            <div class="form-group col-md-7">
                                <select class="form-control product-brand" name="product-brand">
                                    <option id_brand_product="0" name_brand_product="null">--Chọn Thương Hiệu--</option>
                                    @foreach($obj_ListDataBrand as $sub_Obj_ListDataBrand) 
                                        <option id_brand_product="{{ $sub_Obj_ListDataBrand->id_brand_product }}" name_brand_product="{{ $sub_Obj_ListDataBrand->name_brand_product }}">{{ $sub_Obj_ListDataBrand->name_brand_product }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" id="name_brand" placeholder="Tên sản phẩm"> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="product-preview">
                            <div class="inner-product-preview">
                                <div class="product-style-select">
                                    <label>Chọn Thể Loại:</label>
                                    <select class="choose-category-product">
                                        <option id_category_product="0" name_category_product="null">--Thể Loại--</option>
                                        @foreach($obj_ListCategory as $sub_Obj_ListCategory) 
                                            <option id_category_product="{{ $sub_Obj_ListCategory->id_category_product }}" name_category_product="{{ $sub_Obj_ListCategory->name_category_product }}">{{ $sub_Obj_ListCategory->name_category_product }}</option>
                                        @endforeach
                                    </select>
                                    <label>Chọn Công Nghệ:</label>
                                    <select class= "choose-technology-product">
                                        <option id_tech_sound_product="0" name_tech_sound_product="null">--Công Nghệ--</option>
                                        @foreach($obj_ListTechnology as $sub_Obj_ListTechnology) 
                                            <option id_tech_sound_product="{{ $sub_Obj_ListTechnology->id_tech_sound_product }}" name_tech_sound_product="{{ $sub_Obj_ListTechnology->name_tech_sound_product }}">{{ $sub_Obj_ListTechnology->name_tech_sound_product }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="product-view">
                                    {{-- <h2 class="product-title">&nbsp;</h2> --}}
                                    <div class="custom-product-category" style="margin-bottom: 1rem;"><b>Thể Loại: </b>
                                    </div>
                                    <div class="custom-product-topics"><b>Công Nghệ: </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="big-form-group" style="padding: 1.5rem; border: 2px solid black; border-bottom: 0px solid transparent;">
                        
                            <div class="sub-big-form-group" count_subDescription="1">
                                <div class="form-group">
                                    <label for="">Tiêu Đề Mô Tả 1</label>
                                    <input type="text" name="description1" class="form-control titleDescription" id="description1" placeholder="Nhập tiêu đề mổ tả 1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Nội Dung Mô Tả 1</label>
                                    <textarea rows="3" class="form-control contentDescription" name="contentDescription1" id="contentDescription1"></textarea>
                                </div>
                            </div>
    
                        </div>
                        {{-- button add and remove subtitle  --}}
                        <div class="form-group" style="padding-bottom: 0.5rem;  text-align: center; border: 2px solid black; border-top: 0px solid transparent;">
                            <button class="button-30 btn_add_content_description" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i>Thêm Mô Tả</button>
                            <button class="button-30 btn_delete_content_description" role="button"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i> Xóa Mô Tả</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="big-form-group displayImageOfDescription" style="padding: 1.5rem; border: 2px solid black;">
                            <div class="form-group rowImageOfDescription rowImageOfDescription1" style="margin-bottom: 0px;">
                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <label for="">Ảnh Mô Tả 1</label>
                                    </div>
                                    <div class="form-group col-md-3 multiImageDescriptParent">
                                        <button type="button" class="btn btn-outline-dark btn_add_image_of_description" input-multiDescriptImages="multiDescriptImages1"><i class="fa fa-upload" aria-hidden="true" style=""></i></button>
                                        <button type="button" class="btn btn-outline-danger btn_remove_image_of_description" input-multiDescriptImages="multiDescriptImages1"><i class="fa fa-trash" aria-hidden="true" style=""></i></button>
                                        <input id="multiFile" class="multiDescriptImages multiDescriptImages1" type="file" name="images[]" multiple="" accept="image/*" style="display: none;">
                                        
                                    </div>
                                </div>
                                <div class="row displayImageOD imageOfDescription1" style="margin-bottom: 0.5rem;
                                border-bottom: 1px solid black;
                                padding-bottom: 0.5rem;">
                                    {{-- <img src="/upload/Brand/TEST.jpg" class="rounded mx-auto d-block displayDescription1" alt="" style="width: 100px; height: 100px; object-fit: cover;"> --}}
                                    <span style="font-weight: 900; font-size: 1.2rem;">Chưa có ảnh nào.</span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <button class="button-30 uploadImageProduct" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i> Đăng Ảnh</button>
                            <button class="button-30 clearImageProduct active" role="button" disabled><i class="fa fa-trash" aria-hidden="true" style="margin-right: 0.5rem;"></i> Xóa Toàn Bộ Ảnh</button>
                            <input id="multiFile" class="multiFileImages" type="file" name="images[]" multiple="" accept="image/*" style="display: none;">
                        </div>
                        <div class="multiple-uploader" id="multiple-uploader">
                            <div class="mup-msg">
                                <span class="mup-main-msg">Ảnh được úp lên đây nề bạn.</span>
                                <span class="mup-msg" id="max-upload-number">Được úp 10 ảnh thôi nà !!</span>
                                <span class="mup-msg">Chỉ được úp ảnh thôi đó.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="big-form-group" style="display: flex; width: 100%; padding-top: 1rem; border: 2px solid black;">
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">Chọn Màu Sắc</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">Chọn Cổng Tai Nghe</span>
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">Nhập Số Lượng</span>
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">Nhập Giá Tiền</span>
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">Ảnh Phụ Thuộc</span>
                            </div>
                        </div>
                        <div class="col">
                            <span style="font-weight: 900; font-size: 1.1rem;">Xóa Sản Phẩm Chi Tiết</span>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="big-form-group col-form-border-sub-product" style="display: flex; flex-wrap: wrap; width: 100%; padding-top: 1rem; border: 2px solid black;">
                        <div class="row-border-sub-product" style="display: flex; width: 100%;">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control choose-display-product-color" name="product-color">
                                        <option id_color_product="0" value_color_product="null">--Màu Sắc--</option>
                                        @foreach($obj_ListColor as $sub_Obj_ListColor) 
                                            <option id_color_product="{{ $sub_Obj_ListColor->id_color_product }}" value_color_product="{{ $sub_Obj_ListColor->value_color_product }}">{{ $sub_Obj_ListColor->value_color_product }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control choose-display-product-plug" name="product-plug">
                                        <option id_plug_product="0" value_plug_product="null">--Cổng kết nối--</option>
                                        @foreach($obj_ListPlug as $sub_Obj_ListPlug) 
                                            <option id_plug_product="{{ $sub_Obj_ListPlug->id_plug_product }}" value_plug_product="{{ $sub_Obj_ListPlug->value_plug_product }}">{{ $sub_Obj_ListPlug->value_plug_product }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input  class="form-control quantity_product_has" type="number" id="replyNumber" min="0" data-bind="value:replyNumber"placeholder="Nhập số lượng sản phẩm " value="0">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control root_price_product"  placeholder="Nhập số tiền sản phẩm" type="number" id="replyNumber" min="0" data-bind="value:replyNumber" value="0">
                                    
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="file" accept="image/*"  class="form-control-file file_image_sub_product_color" id="">
                                </div>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-danger btn_remove_sub_product btn_remove_sub_product" delete-num-sub-product="1"><i class="fa fa-trash" aria-hidden="true" style=""></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" style="padding: 0.5rem;  text-align: center;">
                        <button class="button-30 btn_add_sub_product" role="button"><i class="fa fa-window-maximize" aria-hidden="true" style="margin-right: 0.5rem;"></i>Thêm Sản Phẩm Chi Tiết</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group" style="text-align: center; border-top: 1px solid black; padding-top:  1rem;">
                            <button type="button" class="btn btn-outline-dark btn_add_new_product"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Thêm Sản Phẩm Mới</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    




    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src="{{ asset('backend/js/productAD.js') }}"></script>

    <style>
        #news_image {
            display: none;
        }
        /* CSS */
        .button-30 {
            align-items: center;
            appearance: none;
            background-color: #FCFCFD;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#D6D6E7 0 -3px 0 inset;
            box-sizing: border-box;
            color: #36395A;
            cursor: pointer;
            display: inline-flex;
            font-family: "JetBrains Mono",monospace;
            height: 48px;
            justify-content: center;
            line-height: 1;
            list-style: none;
            overflow: hidden;
            padding-left: 16px;
            padding-right: 16px;
            position: relative;
            text-align: left;
            text-decoration: none;
            transition: box-shadow .15s,transform .15s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            will-change: box-shadow,transform;
            font-size: 18px;
        }

        .button-30:focus {
            box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        }

        .button-30:hover {
            box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .button-30:active {
            box-shadow: #D6D6E7 0 3px 7px inset;
            transform: translateY(2px);
        }

        .button-30.active {
            box-shadow: #D6D6E7 0 3px 7px inset;
            transform: translateY(2px);
        }



        /* @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
        * {
            box-sizing: border-box;
            outline: 0;
        }

        body {
            font-family: 'Open Sans', sans-serif;
        } */

        .custom-product-bg h3 {
            font-size: 20px;
            line-height: 1.5;
            margin-top: 10px;
            border-bottom: 2px solid #7b006a;
            display: inline-block;
            margin-bottom: 15px;
        }

        .custom-product-bg {
            background: #fff;
            overflow: hidden;
            box-shadow: 0 0 4px #000;
            border: 1px solid rgba(0, 0, 0, 0.23);
            /* overflow: hidden; */
        }

        .add-product-form-wrapper::-webkit-scrollbar {
            /* display: none; */
            /* height: 20px; */
            width: 10px;
            border-radius: 20px;
            /* color: white; */
            /* background-clip: content-box; */
            background-image: linear-gradient(rgb(18, 0, 84), rgb(84, 0, 101), rgb(141, 0, 24));
        }
        .add-product-form-wrapper::-webkit-scrollbar-thumb {
            background-color: #ffffff;
            border-radius: 20px;
            border: 6px solid transparent;
            /* background-clip: content-box; */
        }



        .add-product-form-wrapper {
            width: 40%;
            float: left;
            background: #F1F3F2;
            padding: 10px 20px;
            overflow-y: scroll;
            height: 700px;
            box-shadow: 1px 0px 5px #b1b1b1;
            position: relative;
        }

        .product-preview {
            /* width: 60%; */
            /* float: right; */
            padding: 10px 20px;
        }

        .product-images {
            display: none !important;
        }

        .form-inner-product form label {
            display: block;
            max-width: 150px;
            float: left;
            height: 40px;
            line-height: 40px;
            font-weight: bold;
            font-size: 13px;
            width: 100%;
        }

        .form-inner-product form input,
        .form-inner-product form select {
            display: block;
            max-width: 500px;
            margin-bottom: 20px;
            border: 1px solid #848484;
            /* padding: 10px 10px; */
            height: 40px;
            width: 100%;
            border: 1px solid #c1c1c1;
        }

        textarea.product-description {
            min-height: 200px;
            max-width: 500px;
            width: 100%;
            border: 1px solid #c1c1c1;
        }

        .form-inner-product form input[type="submit"] {
            margin-left: 150px;
            display: inline-block;
            width: auto;
            margin-top: 10px;
            cursor: pointer;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.29);
            background: #03A9F4;
            border: 0 !important;
            color: #fff;
            font-weight: 100;
            letter-spacing: .5px;
        }

        .product-view {
            border: 1px solid #b7b7b7;
            padding: 10px 20px;
            margin: 0 -20px;
        }

        .product-view h2 {
            margin: 0;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .custom-product-category b,
        .custom-product-topics b {
            display: inline-block;
            margin-right: 10px;
            font-weight: 600;
            color: #9C27B0;
            font-size: 12px;
        }

        .custom-product-topics,
        .custom-product-category {
            font-size: 14px;
            line-height: 16px;
            margin-bottom: 5px;
        }
        .product-style-select {
            margin-bottom: 20px;
        }

        .product-style-select label {
            font-size: 14px;
            line-height: 19px;
            /* margin-right: 10px; */
        }

        .product-style-select select {
            margin-right: 15px;
        }
        .product-style-select {
            background: #f1f3f2;
            padding: 10px 20px;
            margin-left: -20px;
            margin-right: -20px;
            margin-top: -10px;
            border-bottom: 1px solid #b7b7b7;
            box-shadow: 0 0 5px #b1b1b1;
        }


    </style>
    {{-- style upload description  --}}
    <style>
        .displayImageOD {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

    </style>
    {{-- style upload image --}}
    <style>
        .multiple-uploader {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            border-radius: 15px;
            border: 2px dashed #858585;
            min-height: 150px;
            margin: 20px auto;
            cursor: pointer;
            /* width: 80%; */
        }

        .mup-msg {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .mup-msg span {
            margin-bottom: 10px;
        }

        .mup-msg .mup-main-msg {
            color: #606060;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .mup-msg .mup-msg {
            color: #737373;
        }

        .image-container{
            margin: 1rem;
            width: 120px;
            height: 120px;
            position: relative;
            cursor: auto;
            pointer-events: unset;
        }



        .image-preview {
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
        }

        .image-size {
            position: absolute;
            z-index: 1;
            height: 120px;
            width: 120px;
            
            backdrop-filter: blur(4px);
            font-weight: bolder;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            opacity: 0;
            pointer-events: unset;
        }

        .image-size:hover {
            opacity: 1;
        }

        .exceeded-size
        {
            position: absolute;
            z-index: 2;
            height: 120px;
            width: 120px;
            display: flex;
            font-weight: bold;
            font-size: 12px;
            text-align: center;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: white;
            background: rgba(255, 0, 0, 0.6);
            pointer-events: unset;
        }

    </style>


@endsection

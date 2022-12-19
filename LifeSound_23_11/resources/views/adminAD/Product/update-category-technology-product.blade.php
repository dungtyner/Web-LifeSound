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

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="border: 2px solid black;">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9" style="font-size: 30px; font-weight: 900;  text-shadow: 0px 3px 0px #b2a98f,
                    0px 14px 10px rgba(0,0,0,0.15),
                    0px 24px 2px rgba(0,0,0,0.1),
                    0px 34px 30px rgba(0,0,0,0.1);">Cập Nhật Thể Loại Và Công Nghệ Tai Nghe</div>
                    <input type="text" id="id_product" value="{{ $id_product }}" style="display: none;">

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <div class="form-group col-md-5">
                                <button class="button-30" role="button" disabled>Thể Loại</button>
                            </div>
                            <div class="form-group col-md-7">
                                <select class="form-control choose-category-product">
                                    <option id_category_product="0" name_category_product="null">---- Chọn Thể Loại ----</option>
                                    @foreach($obj_ListCategory as $sub_Obj_ListCategory) 
                                        <option id_category_product="{{ $sub_Obj_ListCategory->id_category_product }}" name_category_product="{{ $sub_Obj_ListCategory->name_category_product }}">{{ $sub_Obj_ListCategory->name_category_product }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <div class="form-group col-md-5">
                                <button class="button-30" role="button" disabled>Công Nghệ</button>
                            </div>
                            <div class="form-group col-md-7">
                                <select class= "form-control choose-technology-product">
                                    <option id_tech_sound_product="0" name_tech_sound_product="null">---- Chọn Công Nghệ ----</option>
                                    @foreach($obj_ListTechnology as $sub_Obj_ListTechnology) 
                                        <option id_tech_sound_product="{{ $sub_Obj_ListTechnology->id_tech_sound_product }}" name_tech_sound_product="{{ $sub_Obj_ListTechnology->name_tech_sound_product }}">{{ $sub_Obj_ListTechnology->name_tech_sound_product }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="product-preview">
                            <div class="inner-product-preview">
                                <div class="product-view">
                                    <div class="custom-product-category" style="margin-bottom: 1rem;"><b>Thể Loại: </b>
                                        @foreach($dataCategoryProduct as $subDataCategoryProduct)
                                            <span class="product-category display-span-product-category" name_category_product="{{ $subDataCategoryProduct->name_category_product }}" id_category_product="{{ $subDataCategoryProduct->id_category_product }}" style="background: rgba(249, 193, 235, 0.751); margin-right: 0.5rem;   border: 1px solid black;  box-shadow: rgb(207 3 214 / 30%) 0px 0px 0px 3px; padding: 0.2rem 0.7rem; cursor: pointer;">
                                                <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                                                {{ $subDataCategoryProduct->name_category_product }}
                                            </span>
                                        @endforeach
                                            <script>
                                                let displaySpanProductCategory = document.querySelectorAll('.display-span-product-category');
                                                displaySpanProductCategory.forEach(item => {
                                                    item.addEventListener('click', function(e) {
                                                        e.currentTarget.remove();
                                                    });
                                                });
                                            </script>
                                        {{-- <span class="product-category display-span-product-category" name_category_product="" id_category_product="" style="background: rgba(249, 193, 235, 0.751);   border: 1px solid black;  box-shadow: rgb(207 3 214 / 30%) 0px 0px 0px 3px; padding: 0.2rem 0.7rem; cursor: pointer;">
                                            <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                                            Gaming
                                        </span> --}}
                                    </div>
                                    <div class="custom-product-topics"><b>Công Nghệ: </b>
                                        @foreach($dataTechnologyProduct as $subDataTechnologyProduct) 
                                            <span class="product-technology display-span-product-technology" name_tech_sound_product="{{ $subDataTechnologyProduct->name_tech_sound_product }}" id_tech_sound_product="{{ $subDataTechnologyProduct->id_tech_sound_product }}" style=" margin-right: 0.5rem; background: rgba(249, 193, 235, 0.751);   border: 1px solid black;  box-shadow: rgb(207 3 214 / 30%) 0px 0px 0px 3px; padding: 0.2rem 0.7rem; cursor: pointer;">
                                                <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                                                {{ $subDataTechnologyProduct->name_tech_sound_product }}
                                            </span>
                                        @endforeach
                                            <script>
                                                let displaySpanProductTechnology = document.querySelectorAll('.display-span-product-technology');
                                                    displaySpanProductTechnology.forEach(item => {
                                                        item.addEventListener('click', function(e) {
                                                        e.currentTarget.remove();
                                                    });
                                                });
                                            </script>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="row" style="margin-top: 0.5rem;">
                    <div class="col">
                        <div class="form-group" style="text-align: center;">
                            <button type="button" class="btn btn-outline-dark btn_update_category_technology_product"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Cập Nhật Thể Loại Và Công Nghệ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        addAndRemoveCategory();
        addAndRemoveTechnology();
        // ===>>> function thêm xóa category 
        function addAndRemoveCategory() {
            let chooseCategoryProduct = document.querySelector('.choose-category-product');
            // let displaySpanProductCategory = document.querySelectorAll('.displaySpanProductCategory');
            chooseCategoryProduct.addEventListener('change', function() {
                const customProductCategory = document.querySelector('.custom-product-category');
                let name_category_product = chooseCategoryProduct.options[chooseCategoryProduct.selectedIndex].getAttribute('name_category_product');
                let id_category_product = chooseCategoryProduct.options[chooseCategoryProduct.selectedIndex].getAttribute('id_category_product');
                // console.log(id_category_product + ': ' + name_category_product);
                if(id_category_product != 0) {
                    if(customProductCategory.children.length > 1) {
                        let displaySpanProductCategory = document.querySelectorAll('.display-span-product-category');
                        let count = 0;
                            displaySpanProductCategory.forEach((item) => {
                                if(item.getAttribute('id_category_product') == id_category_product) {
                                    count = count + 1;
                                    // console.log(item.getAttribute('id_category_product') + ': ' + id_category_product + ' => ' + count);
                                } 
                            });
                            if(count > 0) {
                                displayToast('Có rồi Stupid Guy!');
                            } else {
                                let newHTML = `
                                    <span class="product-category display-span-product-category" name_category_product="`+name_category_product+`" id_category_product="`+ id_category_product +`" style=" margin-right: 0.5rem; background: rgba(249, 193, 235, 0.751);   border: 1px solid black;  box-shadow: rgb(207 3 214 / 30%) 0px 0px 0px 3px; padding: 0.2rem 0.7rem; cursor: pointer;">
                                        <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                                        `+ name_category_product +`
                                    </span>
                                `;
                                document.querySelector('.custom-product-category').insertAdjacentHTML('beforeend', newHTML);
                                deleteCategory();
                            }
                    } else {
                        let newHTML = `
                            <span class="product-category display-span-product-category" name_category_product="`+name_category_product+`" id_category_product="`+ id_category_product +`" style=" margin-right: 0.5rem; background: rgba(249, 193, 235, 0.751);   border: 1px solid black;  box-shadow: rgb(207 3 214 / 30%) 0px 0px 0px 3px; padding: 0.2rem 0.7rem; cursor: pointer;">
                                <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                                `+ name_category_product +`
                            </span>
                        `;
                        document.querySelector('.custom-product-category').insertAdjacentHTML('beforeend', newHTML);
                        deleteCategory();

                    }
                }
            });
        }
        function deleteCategory() {
            let displaySpanProductCategory = document.querySelectorAll('.display-span-product-category');
            displaySpanProductCategory[displaySpanProductCategory.length-1].addEventListener('click', function(e) {
                e.currentTarget.remove();
            });
        }
        // function thêm xóa technology 
        function addAndRemoveTechnology() {
            let chooseTechnologyProduct = document.querySelector('.choose-technology-product');
            // let displaySpanProductCategory = document.querySelectorAll('.displaySpanProductCategory');
            chooseTechnologyProduct.addEventListener('change', function() {
                const customProductTechnology = document.querySelector('.custom-product-topics');
                let name_tech_sound_product = chooseTechnologyProduct.options[chooseTechnologyProduct.selectedIndex].getAttribute('name_tech_sound_product');
                let id_tech_sound_product = chooseTechnologyProduct.options[chooseTechnologyProduct.selectedIndex].getAttribute('id_tech_sound_product');
                // console.log(id_category_product + ': ' + name_category_product);
                if(id_tech_sound_product != 0) {
                    if(customProductTechnology.children.length > 1) {
                        let displaySpanProductTechnolgy = document.querySelectorAll('.display-span-product-technology');
                        let count = 0;
                        displaySpanProductTechnolgy.forEach((item) => {
                                if(item.getAttribute('id_tech_sound_product') == id_tech_sound_product) {
                                    count = count + 1;
                                } 
                            });
                            if(count > 0) {
                                displayToast('Có rồi Stupid Guy!');
                            } else {
                                let newHTML = `
                                    <span class="product-technology display-span-product-technology" name_tech_sound_product="`+name_tech_sound_product+`" id_tech_sound_product="`+ id_tech_sound_product +`" style=" margin-right: 0.5rem; background: rgba(249, 193, 235, 0.751);   border: 1px solid black;  box-shadow: rgb(207 3 214 / 30%) 0px 0px 0px 3px; padding: 0.2rem 0.7rem; cursor: pointer;">
                                        <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                                        `+ name_tech_sound_product +`
                                    </span>
                                `; 
                                document.querySelector('.custom-product-topics').insertAdjacentHTML('beforeend', newHTML);
                                deleteTechnology();
                            }
                    } else {
                        let newHTML = `
                            <span class="product-technology display-span-product-technology" name_tech_sound_product="`+name_tech_sound_product+`" id_tech_sound_product="`+ id_tech_sound_product +`" style=" margin-right: 0.5rem; background: rgba(249, 193, 235, 0.751);   border: 1px solid black;  box-shadow: rgb(207 3 214 / 30%) 0px 0px 0px 3px; padding: 0.2rem 0.7rem; cursor: pointer; ">
                                <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                                `+ name_tech_sound_product +`
                            </span>
                        `;
                        document.querySelector('.custom-product-topics').insertAdjacentHTML('beforeend', newHTML);
                        deleteTechnology();
                    }
                }
            });
        }
        function deleteTechnology() {
            let displaySpanProductTechnology = document.querySelectorAll('.display-span-product-technology');
            displaySpanProductTechnology[displaySpanProductTechnology.length-1].addEventListener('click', function(e) {
                e.currentTarget.remove();
            });
        }

        $('.btn_update_category_technology_product').click(function() {
        
            let id_product = $('#id_product').val();
            // category
            let listCategory = [];
            let productCategory = document.querySelectorAll('.display-span-product-category');
            productCategory.forEach(item => {
                let subListCategory = new Object();
                subListCategory.id_category_product = item.getAttribute('id_category_product');
                subListCategory.name_category_product = item.getAttribute('name_category_product');

                listCategory[listCategory.length] = subListCategory;
            });
            // technology
            let listTechnology = [];
            let productTechnology= document.querySelectorAll('.display-span-product-technology');
            productTechnology.forEach(item => {
                let subListTechnology = new Object();
                subListTechnology.id_tech_sound_product = item.getAttribute('id_tech_sound_product');
                subListTechnology.name_tech_sound_product = item.getAttribute('name_tech_sound_product');

                listTechnology[listTechnology.length] = subListTechnology;
            });

            if(listCategory.length == 0  || listTechnology.length == 0 ) {
                displayToast('Nhập đầy đủ đi stupid guy!');
            } else {
                var form  = new FormData();
                
                form.append('id_product', id_product);
                form.append('listCategory', JSON.stringify(listCategory));
                form.append('listTechnology', JSON.stringify(listTechnology));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("admin/product/update-category-technology-product")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '{{URL::to("admin/product/all-product")}}';
                    },
                    error: function() {
                        displayToast('Không Thêm được.');
                    }
                });
            }

        });
    </script>

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


    </style>


@endsection

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
                    0px 34px 30px rgba(0,0,0,0.1);">Cập Nhập Chi Tiết Sản Phẩm</div>
                    <input type="text" id="id_product" value="{{ $id_product }}" style="display: none;">

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
                                <span style="font-weight: 900; font-size: 1.1rem;">Chọn Màu Sản Phẩm</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">Ảnh Màu Sản Phẩm</span>
                            </div>
                        </div>
                        <div class="col">
                            <span style="font-weight: 900; font-size: 1.1rem;">Xóa Sản Phẩm Chi Tiết</span>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="big-form-group col-form-border-sub-product" style="display: flex; flex-wrap: wrap; width: 100%; padding-top: 1rem; border: 2px solid black;">
                        @foreach ($dataSubProduct as $subDataSubProduct)
                            <div class="row-border-sub-product" style="display: flex; justify-content: center; align-items: center; width: 100%;">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control choose-display-product-color" name="product-color">
                                            <option id_color_product="0" value_color_product="null">--Màu Sắc--</option>
                                            @foreach($obj_ListColor as $sub_Obj_ListColor) 
                                                @if ($subDataSubProduct->id_color_product == $sub_Obj_ListColor->id_color_product)
                                                    <option id_color_product="{{ $sub_Obj_ListColor->id_color_product }}" value_color_product="{{ $sub_Obj_ListColor->value_color_product }}" selected>{{ $sub_Obj_ListColor->value_color_product }}</option>
                                                @else
                                                    <option id_color_product="{{ $sub_Obj_ListColor->id_color_product }}" value_color_product="{{ $sub_Obj_ListColor->value_color_product }}">{{ $sub_Obj_ListColor->value_color_product }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control choose-display-product-plug" name="product-plug">
                                            <option id_plug_product="0" value_plug_product="null">--Cổng kết nối--</option>
                                            @foreach($obj_ListPlug as $sub_Obj_ListPlug) 
                                                @if ($subDataSubProduct->id_plug_product == $sub_Obj_ListPlug->id_plug_product)
                                                    <option id_plug_product="{{ $sub_Obj_ListPlug->id_plug_product }}" value_plug_product="{{ $sub_Obj_ListPlug->value_plug_product }}" selected>{{ $sub_Obj_ListPlug->value_plug_product }}</option>
                                                @else
                                                    <option id_plug_product="{{ $sub_Obj_ListPlug->id_plug_product }}" value_plug_product="{{ $sub_Obj_ListPlug->value_plug_product }}">{{ $sub_Obj_ListPlug->value_plug_product }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input  class="form-control quantity_product_has" type="number" id="replyNumber" min="0" data-bind="value:replyNumber"placeholder="Nhập số lượng sản phẩm " value="{{ $subDataSubProduct->quantity_product_has }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input class="form-control root_price_product"  placeholder="Nhập số tiền sản phẩm" type="number" id="replyNumber" min="0" data-bind="value:replyNumber" value="{{ $subDataSubProduct->root_price_product }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="file" accept="image/*"  class="form-control-file file_image_sub_product_color" id="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        {{-- <img src="{{ $subDataSubProduct->url_image_color_sub_product }}" style="width: 75px; height: 75px; object-fit: cover;" class="image_display_color_product" alt=""> --}}
                                        <input type="text" id="" class="url_image_color_sub_product url_image_color_sub_product" url_image_color_sub_product="" value="{{ $subDataSubProduct->url_image_color_sub_product }}" style="display: none;">
                                        
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-outline-danger btn_remove_sub_product btn_remove_sub_product" delete-num-sub-product="1"><i class="fa fa-trash" aria-hidden="true" style=""></i></button>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="row-border-sub-product" style="display: flex; width: 100%;">
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
                                <button type="button" class="btn btn-outline-danger btn_remove_sub_product btn_remove_sub_product" delete-num-sub-product="1"><i class="fa fa-trash" aria-hidden="true" style=""></i></button>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" style="padding: 0.5rem;  text-align: center;">
                        <button class="button-30 btn_add_sub_product" role="button"><i class="fa fa-window-maximize" aria-hidden="true" style="margin-right: 0.5rem;"></i>Thêm Sản Phẩm Chi Tiết</button>
                    </div>
                </div>
                <div class="row" style="margin-top: 0.5rem;">
                    <div class="col">
                        <div class="form-group" style="text-align: center;">
                            <button type="button" class="btn btn-outline-dark btn_update_sub_product"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Cập Nhật Chi Tiết Sản Phẩm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        loadFile();
        addAndRemoveSubProduct();


        function loadFile(){
            let url_image_color_sub_product = document.querySelectorAll('.url_image_color_sub_product');
            url_image_color_sub_product.forEach( async el=>{
                let  inputFile = el.closest('.row-border-sub-product').querySelector('.file_image_sub_product_color');
                
                let arr_name = el.value.split('/');
                let nameFile = arr_name[arr_name.length-1];
                let fileImage = await new File([await (await fetch(el.value)).blob()],nameFile,{
                    type: `image/${nameFile.split('.').slice(-1)[0]}`
                });
                const dt = new DataTransfer();
                dt.items.add(fileImage);
                inputFile.files = dt.files;
                let scrLink = URL.createObjectURL(inputFile.files[0]);
                let newHtml =` 
                    <img src="${scrLink}" style="width: 75px; height: 75px; object-fit: cover;" class="image_display_color_product" alt="">
                `;
                el.closest('.form-group').insertAdjacentHTML('beforeend', newHtml);
            });
        }

        //====> fuction thêm và xóa sản phẩm chi tiết
        function addAndRemoveSubProduct() {
            let btn_add_sub_product = document.querySelector('.btn_add_sub_product');
            let btn_remove_sub_product = document.querySelectorAll('.btn_remove_sub_product');


            btn_add_sub_product.addEventListener('click', function(e) {
                e.preventDefault();
                var tmp = document.querySelector('.col-form-border-sub-product .row-border-sub-product').cloneNode(true);
                document.querySelector('.col-form-border-sub-product').appendChild(tmp);
                btnRemoveSubProduct();
            });
            // count = btnRemoveSubProduct(count);

        }
        function btnRemoveSubProduct() {
            let btn_remove_sub_product = document.querySelectorAll('.btn_remove_sub_product');
            if(btn_remove_sub_product.length >= 2) 
            {
                btn_remove_sub_product[0].addEventListener('click', function(e) {
                    
                    let btn_remove_sub_product = document.querySelectorAll('.btn_remove_sub_product');
                    if(btn_remove_sub_product.length>1)
                    e.currentTarget.closest('.row-border-sub-product').remove();
                        
                        btnRemoveSubProduct();
            
                })
            }

            btn_remove_sub_product[btn_remove_sub_product.length-1].addEventListener('click', function(e) {
                if(btn_remove_sub_product.length >= 2) {               
                    let btn_remove_sub_product = document.querySelectorAll('.btn_remove_sub_product');
                    if(btn_remove_sub_product.length>1)
                    e.currentTarget.closest('.row-border-sub-product').remove();
                    btnRemoveSubProduct();
                }

            });
        }
        let btn_remove_sub_product = document.querySelectorAll('.btn_remove_sub_product');
        btn_remove_sub_product.forEach(item => {
            item.addEventListener('click', function(e) {
                // console.log(document.querySelectorAll('.btn_remove_sub_product').length);
                if(document.querySelectorAll('.btn_remove_sub_product').length == 1) 
                {
                    displayToast('Phải có ít nhất 1 đó stupid guyy!?')
                } else {
                    e.currentTarget.closest('.row-border-sub-product').remove();    
                }
            
            });
        });

        // xóa cacs mảng giống nhau trong sub product
        function remove_Element_Same_List_Sub_Product(listSubProduct, listSubImageColorProduct) {
            for(let sublistSubProduct of listSubProduct) {
                let count = 0;
                let id_color_product = sublistSubProduct.id_color_product;
                let id_plug_product = sublistSubProduct.id_plug_product;
                for(let subSublistSubProduct of listSubProduct) {
                    if(subSublistSubProduct.id_color_product == id_color_product && subSublistSubProduct.id_plug_product == id_plug_product)
                    {
                        count++;
                        if(count == 2) {
                            listSubProduct.splice(listSubProduct.indexOf(subSublistSubProduct), 1);
                            listSubImageColorProduct.splice(listSubProduct.indexOf(subListSubProduct), 1);

                            remove_Element_Same_List_Sub_Product(listSubProduct);
                        }
                    }
                }
            }

        };
        function check_Array_Object_Sub_Product(listSubProduct, listSubImageColorProduct) {
            for(subListSubProduct of listSubProduct) {
                if(subListSubProduct.id_color_product == 0 || subListSubProduct.id_plug_product == 0) {
                    listSubProduct.splice(listSubProduct.indexOf(subListSubProduct), 1);
                    listSubImageColorProduct.splice(listSubProduct.indexOf(subListSubProduct), 1);
                    check_Array_Object_Sub_Product(listSubProduct);
                }
            }
        }
        

        $('.btn_update_sub_product').click(function() {
        
            let id_product = $('#id_product').val();
            //list sub product
            let listSubProduct = [];
            let rowBorderSubProduct = document.querySelectorAll('.row-border-sub-product');
            rowBorderSubProduct.forEach(item => {
                let subListSubProduct = new Object();
                subListSubProduct.id_color_product = item.querySelector('.choose-display-product-color').options[item.querySelector('.choose-display-product-color').selectedIndex].getAttribute('id_color_product');
                subListSubProduct.value_color_product = item.querySelector('.choose-display-product-color').options[item.querySelector('.choose-display-product-color').selectedIndex].getAttribute('value_color_product');

                subListSubProduct.id_plug_product = item.querySelector('.choose-display-product-plug').options[item.querySelector('.choose-display-product-plug').selectedIndex].getAttribute('id_plug_product');
                subListSubProduct.value_plug_product = item.querySelector('.choose-display-product-plug').options[item.querySelector('.choose-display-product-plug').selectedIndex].getAttribute('value_plug_product');

                subListSubProduct.quantity_product_has = item.querySelector('.quantity_product_has').value;
                subListSubProduct.root_price_product = item.querySelector('.root_price_product').value;

                listSubProduct[listSubProduct.length] = subListSubProduct;
            });
            // list sub image color product 
            let listSubImageColorProduct = [];
            let fileImageSubProductColor = document.querySelectorAll('.file_image_sub_product_color');
            fileImageSubProductColor.forEach((item)=>{
                let filesD = item.files;
                let count = 0;
                for(let fileD of filesD) {
                    listSubImageColorProduct[listSubImageColorProduct.length] = new File([fileD],`subProductColor_file${count+1}${fileD.name}`,{
                        type:fileD.type,lastModified:fileD.lastModified});
                        count = count + 1;
                }
            })
            // check_Array_Object_Description_Product(listDescriptionProduct);
            check_Array_Object_Sub_Product(listSubProduct, listSubImageColorProduct);
            remove_Element_Same_List_Sub_Product(listSubProduct, listSubImageColorProduct);

            if(listSubProduct.length == 0 ) {
                displayToast('Nhập đầy đủ đi stupid guy!');
            } else {
                var form  = new FormData();
                
                form.append('id_product', id_product);
                form.append('listSubProduct', JSON.stringify(listSubProduct));
                for(let i = 0; i < listSubImageColorProduct.length; i++) {
                    form.append('listSubImageColorProduct'+i.toString(), listSubImageColorProduct[i]);
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("admin/product/update-sub-product")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '{{URL::to("admin/product/all-product")}}';
                    },
                    error: function() {
                        displayToast('Không Sửa Được.');
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

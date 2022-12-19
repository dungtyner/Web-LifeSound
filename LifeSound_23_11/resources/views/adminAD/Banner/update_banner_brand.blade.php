@extends('adminAD.indexAdmin')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title" style="">
            Quản Lý Ảnh Bìa Thương Hiệu
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="fa fa-picture-o" aria-hidden="true" style="color: black;"></i>
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
                    0px 34px 30px rgba(0,0,0,0.1);">Cập Nhập Ảnh Bìa Thương Hiệu</div>
                    {{-- <input type="text" id="id_product" value="{{ $id_product }}" style="display: none;"> --}}

                </div>
                <div class="row">
                    <div class="big-form-group" style="display: flex; width: 100%; padding-top: 1rem; border: 2px solid black;">
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">#ID</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">Tên Thương Hiệu</span>
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">Chọn Ảnh Bìa</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <span style="font-weight: 900; font-size: 1.1rem;">Ảnh Bìa Thương Hiệu</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="big-form-group col-form-border-sub-product" style="display: flex; flex-wrap: wrap; width: 100%; padding-top: 1rem; border: 2px solid black;">
                        @foreach ($obj_ListDataBrand as $sub_obj_ListDataBrand)
                            <div class="row-border-sub-product" style="display: flex; justify-content: center; align-items: center; width: 100%;">
                                <div class="col">
                                    <div class="form-group">
                                        <input  class="form-control id_brand_product" type="text" value="{{ $sub_obj_ListDataBrand->id_brand_product  }}" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input  class="form-control name_brand_product" type="text" value="{{ $sub_obj_ListDataBrand->name_brand_product }}" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="file" accept="image/*"  class="form-control-file file_image_banner_brand_product" id_brand_product="{{ $sub_obj_ListDataBrand->id_brand_product  }}" id="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group display_banner_image">
                                        @if ($sub_obj_ListDataBrand->url_banner_brand_product)
                                            <img src="{{ $sub_obj_ListDataBrand->url_banner_brand_product }}" style="width: 75px; height: 75px; object-fit: cover;" class="image_display_banner_brand" alt="">
                                        @endif
                                        <input type="text" id="" class="url_banner_brand_product" url_image_color_sub_product="" value="{{ $sub_obj_ListDataBrand->url_banner_brand_product }}" style="display: none;">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
                <div class="row" style="margin-top: 0.5rem;">
                    <div class="col">
                        <div class="form-group" style="text-align: center;">
                            <button type="button" class="btn btn-outline-dark btn_update_banner_brand"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Cập Nhật Bìa Thương Hiệu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        // loadFile();
        loadChangeFile();
        function loadChangeFile() {
            let file_image_banner_brand_product = document.querySelectorAll('.file_image_banner_brand_product');
            file_image_banner_brand_product.forEach( (item) => {
                item.addEventListener('change', function(e) {
                    let scrLink = URL.createObjectURL(e.currentTarget.files[0]);
                    let newHtml =` 
                        <img src="${scrLink}" style="width: 75px; height: 75px; object-fit: cover;" class="image_display_banner_brand" alt="">
                    `;
                    item.closest('.row-border-sub-product').querySelector('.image_display_banner_brand').setAttribute('src', scrLink);

                    // console.log(e.currentTarget.files[0].name);

                });
            });
        }


        $('.btn_update_banner_brand').click(function() {
        
        // list sub image banner brand  
        let listImageBrandBanner = [];
        let fileImageBannerBrand = document.querySelectorAll('.file_image_banner_brand_product');
        fileImageBannerBrand.forEach((item)=>{
            let id_brand_product = item.getAttribute('id_brand_product');
            if(item.files.length != 0) {
                let filesD = item.files[0];
                listImageBrandBanner[listImageBrandBanner.length] = new File([filesD],`idBrand${id_brand_product}_${filesD.name}`,{
                    type:filesD.type,lastModified:filesD.lastModified});
            
            } 
        });
        
        var form  = new FormData();
        for(let i = 0; i < listImageBrandBanner.length; i++) {
            form.append('listImageBrandBanner'+i.toString(), listImageBrandBanner[i]);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{URL::to("admin/banner/update-banner-brand")}}',
            method: 'post',
            data: form,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                window.location.href = '{{URL::to("admin/banner/show-update-banner-brand")}}';
            },
            error: function() {
                displayToast('Không Sửa Được.');
            }
        });

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

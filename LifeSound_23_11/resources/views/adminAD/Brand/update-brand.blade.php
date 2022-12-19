@extends('adminAD.indexAdmin')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title" style="">
            Quản Lý Sản Phẩm
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="fa fa-certificate" aria-hidden="true" style="color: black;"></i>
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
                    0px 34px 30px rgba(0,0,0,0.1);">Cập Nhật Thương Hiệu</div>
                </div>

                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Tên Thương Hiệu</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control" id="name_brand" placeholder="Nhập tên thương hiệu" value="{{ $dataBrand->name_brand_product }}">
                                    <input type="text" id="id_brand_product" value="{{ $dataBrand->id_brand_product }}" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <div class="form-group col-md-5">
                                    <button class="button-30 uploadImageBrand" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i> Đăng Ảnh</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control" id="display_file_image_brand" placeholder="Đây là tên ảnh" disabled>
                                    <input id="news_image" type="file" name="news_image" class="file-upload-default">
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="button" class="btn btn-outline-success btn_update_brand"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Cập Nhật</button>
                            </div>
    
                        </form>
                    </div>
                    <div class="col">
                        <img src="{{ URL::to($dataBrand->img_brand) }}" class="rounded mx-auto d-block displayImageBrand" alt="" style="width: 200px; height: 200px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        $('.uploadImageBrand').click(function(e) {
            e.preventDefault();
            $('#news_image').click();
        });

        $('#news_image').change(function(e) {
            $('#display_file_image_brand').val(e.currentTarget.files[0].name);
            $('.displayImageBrand').attr('src',URL.createObjectURL(e.currentTarget.files[0]));
        });

        $('.btn_update_brand').click(function() {
        
            let id_brand_product = $('#id_brand_product').val();
            let name_file_Image = $('#display_file_image_brand').val();
            let name_brand_product = $('#name_brand').val();
            let img_brand = $('#news_image')[0].files;
            

            if(name_brand_product == '' || name_file_Image == '') {
                displayToast('Nhập đầy đủ đi stupid guy!');
            } else {

                var form  = new FormData();

                form.append('id_brand_product', id_brand_product);
                form.append('name_brand_product', name_brand_product);
                form.append('img_brand', img_brand[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("admin/brand/update-new-brand")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        window.location.href = '{{URL::to("admin/brand/all-brand")}}';
                    },
                    error: function() {
                        displayToast('Không Sửa được.');
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

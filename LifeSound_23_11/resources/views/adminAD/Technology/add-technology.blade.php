@extends('adminAD.indexAdmin')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title" style="">
            Quản Lý Công Nghệ Tai Nghe
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="fa fa-connectdevelop" aria-hidden="true" style="color: black;"></i>
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
                    0px 34px 30px rgba(0,0,0,0.1);">Thêm Công Nghệ Tai Nghe</div>
                </div>

                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Tên Công Nghệ</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control" id="name_technology" placeholder="Nhập tên công nghệ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Mô Tả Công Nghệ</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <textarea class="form-control" id="description_technology" rows="3" placeholder="Mô tả công nghệ"></textarea>
                                </div>
                            </div>
                            <div class="form-group row" >
                                <div class="form-group col-md-5">
                                    <button class="button-30 uploadImageTechnology" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i> Đăng Ảnh</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control" id="display_file_image_technology" placeholder="Đây là tên ảnh" disabled>
                                    <input id="news_image" type="file" name="news_image" class="file-upload-default">
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="button" class="btn btn-outline-success btn_add_new_technology"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Thêm Công Nghệ Mới</button>
                            </div>
    
                        </form>
                    </div>
                    <div class="col">
                        <img src="/upload/Brand/TEST.jpg" class="rounded mx-auto d-block displayImageTechnology" alt="" style="width: 200px; height: 200px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        $('.uploadImageTechnology').click(function(e) {
            e.preventDefault();
            $('#news_image').click();
        });

        $('#news_image').change(function(e) {
            $('#display_file_image_technology').val(e.currentTarget.files[0].name);
            $('.displayImageTechnology').attr('src',URL.createObjectURL(e.currentTarget.files[0]));
        });

        $('.btn_add_new_technology').click(function() {
        
            let name_file_Image = $('#display_file_image_technology').val();
            let name_tech_sound_product = $('#name_technology').val();
            let description_tech_sound_product = $('#description_technology').val();
            let logo_tech_sound_product = $('#news_image')[0].files;
            

            if(name_tech_sound_product == '' || logo_tech_sound_product == '') {
                displayToast('Nhập đầy đủ đi stupid guy!');
            } else {

                var form  = new FormData();
                form.append('name_tech_sound_product', name_tech_sound_product);
                form.append('description_tech_sound_product', description_tech_sound_product);
                form.append('logo_tech_sound_product', logo_tech_sound_product[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("admin/technology/add-new-technology")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '{{URL::to("admin/technology/add-technology")}}';
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

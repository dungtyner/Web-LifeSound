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
                    0px 34px 30px rgba(0,0,0,0.1);">Cập Nhật Ảnh Tai Nghe</div>
                    <input type="text" id="id_product" value="{{ $id_product }}" style="display: none;">

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <button class="button-30 " role="button"><i class="fa fa-file-image-o" aria-hidden="true" style="margin-right: 0.5rem;"></i></i> Ảnh Hiện Tại Sản Phẩm</button>

                            {{-- <button class="button-30 uploadImageProduct" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i> Đăng Ảnh</button>
                            <button class="button-30 clearImageProduct active" role="button" disabled><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;" ></i> Xóa Toàn Bộ Ảnh</button>
                            <input id="multiFile" class="multiFileImages" type="file" name="images[]" multiple="" accept="image/*" style="display: none;"> --}}
                        </div>
                        <div class="multiple-uploader old-image-product" id="multiple-uploader">
                            <div class="mup-msg sub-old-image-product" style="flex-direction: unset; text-align: inherit; display: flex;
                            flex-wrap: wrap;">
                                @foreach ($dataImageProduct as $subDataImageProduct)
                                    <div class="mup-msg delete-div-Image" style=" text-align: inherit;">
                                        <div class="image-container deleteSubListFileImage"  id="mup-image" data-acceptable-image="1" >
                                            <div class="image-size image-size-old" id_img_product="{{ $subDataImageProduct->id_img_product }}"><i class="fa fa-trash" aria-hidden="true" style="font-size: 50px; color: red;"></i></div>
                                            <img src="{{ $subDataImageProduct->url_img_product }}"  class="image-preview" id_img_product="{{ $subDataImageProduct->id_img_product }}" alt="" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- <span class="id_image_deleted" id_img_product="1" style="display: none;"></span> --}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <button class="button-30 uploadImageProduct" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i> Đăng Ảnh Mới</button>
                            <button class="button-30 clearImageProduct active" role="button" disabled><i class="fa fa-trash" aria-hidden="true" style="margin-right: 0.5rem;"></i> Xóa Toàn Bộ Ảnh Mới</button>
                            <input id="multiFile" class="multiFileImages" type="file" name="images[]" multiple="" accept="image/*" style="display: none;">
                        </div>
                        <div class="multiple-uploader new-image-product" id="multiple-uploader">
                            <div class="mup-msg descript-note-upload">
                                <span class="mup-main-msg">Ảnh được úp lên đây nề bạn.</span>
                                <span class="mup-msg" id="max-upload-number">Được úp 10 ảnh thôi nà !!</span>
                                <span class="mup-msg">Chỉ được úp ảnh thôi đó.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 0.5rem;">
                    <div class="col">
                        <div class="form-group" style="text-align: center;">
                            <button type="button" class="btn btn-outline-dark btn_update_image_product"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Cập Nhật Ảnh Sản Phẩm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        deletedOldImage();
        uploadImageProduct();
        // function xóa ảnh cũ
        function deletedOldImage() {
            let imageSizeOld = document.querySelectorAll('.image-size-old');
            imageSizeOld.forEach(item => {
                item.addEventListener('click', function(e) {
                    let id_image_delete = e.currentTarget.getAttribute('id_img_product');
                    let newHTML = `
                    <span class="id_image_deleted" id_img_product="` + id_image_delete + `" style="display: none;"></span>
                    `;
                    document.querySelector('.sub-old-image-product').insertAdjacentHTML('beforeend', newHTML);
                    e.currentTarget.closest('.delete-div-Image').remove();
                    // console.log(id_image_delete);
                });
            });
        }
        // ===> function thêm nhiều ảnh một lúc
        function uploadImageProduct() {
            let multiFileImages = document.querySelector('.multiFileImages');
            let uploadImageProduct = document.querySelector('.uploadImageProduct');
            let clearImageProduct = document.querySelector('.clearImageProduct');
            

            uploadImageProduct.addEventListener('click', function(e) {
                e.preventDefault();
                uploadImageProduct.classList.add('active');
                clearImageProduct.classList.remove('active');
                uploadImageProduct.setAttribute('disabled', '');
                clearImageProduct.removeAttribute('disabled');
                multiFileImages.click();
            });
            multiFileImages.addEventListener('change', function(e) {
                loadImageFromInputMultiFile();
            });
            clearImageProduct.addEventListener('click', function(e) {
                e.preventDefault();
                uploadImageProduct.classList.remove('active');
                clearImageProduct.classList.add('active');
                uploadImageProduct.removeAttribute('disabled');
                clearImageProduct.setAttribute('disabled', '');

                multiFileImages.value = '';
                let newHtml = `
                        <div class="mup-msg descript-note-upload">
                            <span class="mup-main-msg">Ảnh được úp lên đây nề bạn.</span>
                            <span class="mup-msg" id="max-upload-number">Được úp 10 ảnh thôi nà !!</span>
                            <span class="mup-msg">Chỉ được úp ảnh thôi đó.</span>
                        </div>
                    `;
                document.querySelector('.new-image-product').innerHTML =  newHtml;

            }); 
        }
        function loadImageFromInputMultiFile() {
            let multiFileImages = document.querySelector('.multiFileImages');
            let mupMsg = document.querySelector('.descript-note-upload');
                mupMsg.style.display = 'none';

            // nếu lớn hơn 10file thì sẻ xóa bớt
            let files = multiFileImages.files;
            if(files.length > 10) {
                const dt2 = new DataTransfer();
                for (let file of files) {
                    dt2.items.add(file);
                }
                multiFileImages.files = dt2.files;
                for(let i = files.length; i > 10; i--) {
                    let indexDelete = i - 1;
                    console.log(indexDelete);
                    dt2.items.remove(indexDelete);
                }
                document.querySelector('.multiFileImages').files = dt2.files;
                files = dt2.files;
            }

             // nếu 0 file 
            if(files.length == 0) {
                let uploadImageProduct = document.querySelector('.uploadImageProduct');
                let clearImageProduct = document.querySelector('.clearImageProduct');
                uploadImageProduct.classList.remove('active');
                clearImageProduct.classList.add('active');
                uploadImageProduct.removeAttribute('disabled');
                clearImageProduct.setAttribute('disabled', '');

                multiFileImages.value = '';
                let newHtml = `
                        <div class="mup-msg descript-note-upload">
                            <span class="mup-main-msg">Ảnh được úp lên đây nề bạn.</span>
                            <span class="mup-msg" id="max-upload-number">Được úp 10 ảnh thôi nà !!</span>
                            <span class="mup-msg">Chỉ được úp ảnh thôi đó.</span>
                        </div>
                    `;
                document.querySelector('.new-image-product').innerHTML =  newHtml;
            }

            // load image
            let count = 0;
            for(const file of files) {
                let scrLink = URL.createObjectURL(file);
                // console.log(scrLink);
                let newHtml = `
                    <div class="image-container deleteSubListFileImage"  id="mup-image" data-acceptable-image="1" >
                        <div class="image-size image-size-new" data-image-index="`+ count +`"><i class="fa fa-trash" aria-hidden="true" style="font-size: 50px; color: red;"></i></div>
                        <img src="`+ scrLink +`"  class="image-preview" alt="" />
                    </div>
                `;
                document.querySelector('.new-image-product').insertAdjacentHTML('beforeend', newHtml);
                count = count + 1;
            }
            // xóa từng ảnh 
            let imageSize = document.querySelectorAll('.image-size-new');
                imageSize.forEach((item) => {
                    item.addEventListener('click', function(e) {
                        let indexImage = e.currentTarget.getAttribute('data-image-index');


                        const dt = new DataTransfer();
                        for (let file of files) {
                            dt.items.add(file);
                        }
                        console.log(dt);
                        // Mise à jour des fichiers de l'input file après ajout
                        multiFileImages.files = dt.files;

                        dt.items.remove(indexImage);
                        document.querySelector('.multiFileImages').files = dt.files;
                        document.querySelector('.new-image-product').innerHTML =  '<div class="mup-msg descript-note-upload"></div>';
                        loadImageFromInputMultiFile();
                    });
                });
        }

        // click update 
        $('.btn_update_image_product').click(function() {
            let id_product = $('#id_product').val();
            // list multi image of Product
            let listFileImage = [];
            let multiFileImages = document.querySelector('.multiFileImages');
            let files = multiFileImages.files;
            let count = 0;
            for(let file of files) {
                listFileImage[listFileImage.length] = new File([file],`imageProduct_file${count}${file.name.split('.')[0]}.${file.type.split('/')[1]}`,{
                type:file.type,lastModified:file.lastModified});
                count = count + 1;
            }

            let listIdDeleteImage = [];
            let id_image_deleted = document.querySelectorAll('.id_image_deleted');
            id_image_deleted.forEach(item => {
                listIdDeleteImage[listIdDeleteImage.length] = item.getAttribute('id_img_product');
            });

            // trường hợp 1: không có ảnh mới và không xóa ảnh cũ
            if(listFileImage.length == 0 && listIdDeleteImage.length == 0) {
                displayToast('Nhập đầy đủ đi stupid guy!');
            } 
            // trường hợp 2: không có ảnh mới và ảnh xóa bớt ảnh cũ
            else if(listFileImage.length == 0 && listIdDeleteImage.length > 0)  {
                var form  = new FormData();
                form.append('id_product', id_product);
                form.append('case', 'case2');
                form.append('listIdDeleteImage', JSON.stringify(listIdDeleteImage));

                // form.append('listCategory', JSON.stringify(listCategory));
                // form.append('listTechnology', JSON.stringify(listTechnology));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("admin/product/update-image-product")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '{{URL::to("admin/product/all-product")}}';
                    },
                    error: function() {
                        displayToast('Không Sửa được.');
                    }
                });
            }
            // trường hợp 3: có ảnh mới và  không xóa bớt ảnh cũ
            else if(listFileImage.length > 0 && listIdDeleteImage.length == 0) {
                var form  = new FormData();
                form.append('id_product', id_product);
                form.append('case', 'case3');
                for(let i = 0; i < listFileImage.length; i++) {
                    form.append('listFileImage'+i.toString(), listFileImage[i]);
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("admin/product/update-image-product")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '{{URL::to("admin/product/all-product")}}';
                    },
                    error: function() {
                        displayToast('Không Sửa được.');
                    }
                });
            }
            // trường hợp 4: có ảnh mới và có xóa bớt ảnh cũ
            else if(listFileImage.length > 0 && listIdDeleteImage.length > 0) {
                var form  = new FormData();
                form.append('id_product', id_product);
                form.append('case', 'case4');
                form.append('listIdDeleteImage', JSON.stringify(listIdDeleteImage));
                for(let i = 0; i < listFileImage.length; i++) {
                    form.append('listFileImage'+i.toString(), listFileImage[i]);
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("admin/product/update-image-product")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '{{URL::to("admin/product/all-product")}}';
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
        .button-30.active {
            box-shadow: #D6D6E7 0 3px 7px inset;
            transform: translateY(2px);
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

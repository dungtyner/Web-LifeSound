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
                    0px 34px 30px rgba(0,0,0,0.1);">Cập Nhật Mô Tả Sản Phẩm</div>
                    <input type="text" id="id_product" value="{{ $id_product }}" style="display: none;">

                </div>
                <div class="row">
                    <div class="col">
                        <div class="big-form-group" style="padding: 1.5rem; border: 2px solid black; border-bottom: 0px solid transparent;">
                            <?php $count = 1;?>
                            @foreach ($dataDescription as $subDataDescription)
                                <div class="sub-big-form-group" count_subDescription="{{ $count }}">
                                    <div class="form-group">
                                        <label for="">Tiêu Đề Mô Tả {{ $count }}</label>
                                        <input type="text" name="description{{ $count }}" class="form-control titleDescription" id="description{{ $count }}" placeholder="Nhập tiêu đề mổ tả {{ $count }}" value="{{ $subDataDescription->title_description }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleTextarea{{ $count }}">Nội Dung Mô Tả {{ $count }}</label>
                                        <textarea rows="3" class="form-control contentDescription" name="contentDescription{{ $count }}" id="contentDescription{{ $count }}">{{ $subDataDescription->content_description }}</textarea>
                                    </div>
                                </div>
                                <?php $count = $count +  1;?>
                            @endforeach
    
                        </div>
                        {{-- button add and remove subtitle  --}}
                        <div class="form-group" style="padding-bottom: 0.5rem;  text-align: center; border: 2px solid black; border-top: 0px solid transparent;">
                            <button class="button-30 btn_add_content_description" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i>Thêm Mô Tả</button>
                            <button class="button-30 btn_delete_content_description" role="button"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i> Xóa Mô Tả</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="big-form-group displayImageOfDescription" style="padding: 1.5rem; border: 2px solid black;">
                            <?php $count = 1;?>
                            @foreach ($dataDescription as $subDataDescription)
                                <div class="form-group rowImageOfDescription rowImageOfDescription{{ $count }}" style="margin-bottom: 0px;">
                                    <div class="row">
                                        <div class="form-group col-md-9">
                                            <label for="">Ảnh Mô Tả {{ $count }}</label>
                                        </div>
                                        <div class="form-group col-md-3 multiImageDescriptParent">
                                            <button type="button" class="btn btn-outline-dark btn_add_image_of_description" input-multiDescriptImages="multiDescriptImages{{ $count }}"><i class="fa fa-upload" aria-hidden="true" style=""></i></button>
                                            <button type="button" class="btn btn-outline-danger btn_remove_image_of_description" input-multiDescriptImages="multiDescriptImages{{ $count }}"><i class="fa fa-trash" aria-hidden="true" style=""></i></button>
                                            <input id="multiFile" class="multiDescriptImages multiDescriptImages{{ $count }}" type="file" name="images[]" multiple="" accept="image/*" style="display: none;">
                                            
                                        </div>
                                    </div>
                                    <div class="row displayImageOD imageOfDescription1" style="margin-bottom: 0.5rem;
                                    border-bottom: 1px solid black;
                                    padding-bottom: 0.5rem;">
                                        @if ($subDataDescription->url_img_description_product)
                                            @foreach ($subDataDescription->url_img_description_product as $subImgDescriptionProduct)
                                                {{-- <img src="{{ $subImgDescriptionProduct->url_img_description_product }}" class="rounded mx-auto d-block displayDescription1" alt="" style="width: 100px; height: 100px; object-fit: cover;"> --}}
                                                <input type="text" id="" class="url_image_description_old url_image_description{{ $count }}" url_image_description="mota{{ $count }}" value="{{ $subImgDescriptionProduct->url_img_description_product }}" style="display: none;">
                                            @endforeach
                                            
                                        @else
                                            <input type="text" id="" class="url_image_description_old url_image_description{{ $count }}" url_image_description="mota{{ $count }}" value="" style="display: none;">
                                            <span style="font-weight: 900; font-size: 1.2rem;">Chưa có ảnh nào.</span>
                                        @endif
                                    </div>
                                </div>
                                <?php $count = $count +  1;?>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group" style="text-align: center; border-top: 1px solid black; padding-top:  1rem;">
                            <button type="button" class="btn btn-outline-dark btn_update_description_product"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Cập Nhật Mô Tả Sản Phẩm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        loadFile();
        subUploadImageForDescription();
        addAndRemoveOneContentDescription();
        // function thêm nhiều ảnh cho nhiều mô tả 
        function subUploadImageForDescription() {
            let btn_add_image_of_description = document.querySelectorAll('.btn_add_image_of_description'); //btb upload
            let btn_remove_image_of_description = document.querySelectorAll('.btn_remove_image_of_description'); //btb upload
            let multiDescriptImages = document.querySelectorAll('.multiDescriptImages'); // input ẩn

            btn_add_image_of_description[btn_add_image_of_description.length-1].addEventListener('click',(e)=>{
                e.preventDefault();
                let classInputImage = '.' + e.currentTarget.getAttribute('input-multiDescriptImages');
                e.currentTarget.closest('.multiImageDescriptParent').querySelector(classInputImage).click();
            })

            btn_remove_image_of_description[btn_remove_image_of_description.length-1].addEventListener('click', function(e) {
                e.preventDefault();
                let classInputImage = '.' + e.currentTarget.getAttribute('input-multiDescriptImages');
                e.currentTarget.closest('.multiImageDescriptParent').querySelector(classInputImage).value = '';
                let newHtml = `
                    <span style="font-weight: 900; font-size: 1.2rem;">Chưa có ảnh nào.</span>
                `;
                e.currentTarget.closest('.rowImageOfDescription').querySelector('.displayImageOD').innerHTML =  newHtml;

            });
            


            multiDescriptImages.forEach((item) => {
                item.addEventListener('change', function(e) {
                    let files = e.currentTarget.files;
                    
                    // nếu lớn hơn 5 ảnh thì xóa bớt
                    if(files.length > 5) {
                        const dt2 = new DataTransfer();
                        for (let file of files) {
                            dt2.items.add(file);
                        }
                        e.currentTarget.files = dt2.files;
                        for(let i = files.length; i > 5; i--) {
                            let indexDelete = i - 1;
                            console.log(indexDelete);
                            dt2.items.remove(indexDelete);
                        }
                        e.currentTarget.files = dt2.files;
                        files = dt2.files;
                    }
                    // load ảnh 
                    let count = 0;
                    e.currentTarget.closest('.rowImageOfDescription').querySelector('.displayImageOD').innerHTML = '';
                    for(const file of files) {
                        let scrLink = URL.createObjectURL(file);
                        console.log(files);
                        testCount = count + 1;
                        let newHtml = `
                            <img src="`+ scrLink +`" class="rounded mx-auto d-block displayDescription`+ testCount +`" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                        `;
                        e.currentTarget.closest('.rowImageOfDescription').querySelector('.displayImageOD').insertAdjacentHTML('beforeend', newHtml);
                        count = count + 1;
                    }


                });
            });



        }
        // ==> function thêm và xóa description product
        function addAndRemoveOneContentDescription() {
            let btnAddContentDescription = document.querySelector('.btn_add_content_description');
            let btnDeleteContentDescription = document.querySelector('.btn_delete_content_description');
            let count = document.querySelectorAll('.rowImageOfDescription').length;

            btnAddContentDescription.addEventListener('click', function (e) {
                e.preventDefault();
                if(count <= 3)
                {
                    count = count + 1;
                    let newHtml = `
                        <div class="sub-big-form-group" count_subDescription="`+ count +`">
                            <div class="form-group">
                                <label for="">Tiêu Đề Mô Tả `+ count +`</label>
                                <input type="text" name="description`+ count +`" class="form-control titleDescription" id="description`+ count +`" placeholder="Nhập tiêu đề mổ tả `+ count +`">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Nội Dung Mô Tả `+ count +`</label>
                                <textarea rows="3" class="form-control contentDescription" name="contentDescription`+ count +`" id="contentDescription`+ count +`"></textarea>
                            </div>
                        </div>
                    `;
                    document.querySelector('.big-form-group').insertAdjacentHTML('beforeend', newHtml);

                    let newHtml2 = `
                        <div class="form-group rowImageOfDescription rowImageOfDescription`+ count +`" style="margin-bottom: 0px;">
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label for="">Ảnh Mô Tả `+ count +`</label>
                                </div>
                                <div class="form-group col-md-3 multiImageDescriptParent">
                                    <button type="button" class="btn btn-outline-dark btn_add_image_of_description" input-multiDescriptImages="multiDescriptImages`+ count +`"><i class="fa fa-upload" aria-hidden="true" style=""></i></button>
                                    <button type="button" class="btn btn-outline-danger btn_remove_image_of_description" input-multiDescriptImages="multiDescriptImages`+ count +`"><i class="fa fa-trash" aria-hidden="true" style=""></i></button>
                                    <input id="multiFile" class="multiDescriptImages multiDescriptImages`+ count +`" type="file" name="images[]" multiple="" accept="image/*" style="display: none;">
                                </div>
                            </div>
                            <div class="row displayImageOD imageOfDescription`+ count +`" style="margin-bottom: 0.5rem;
                            border-bottom: 1px solid black;
                            padding-bottom: 0.5rem;">
                                <span style="font-weight: 900; font-size: 1.2rem;">Chưa có ảnh nào của đoạn `+ count +`.</span>
                            </div>
                        </div>
                    `;
                    document.querySelector('.displayImageOfDescription').insertAdjacentHTML('beforeend', newHtml2);

                    subUploadImageForDescription();
                }
            });

            btnDeleteContentDescription.addEventListener('click', function(e) {
                e.preventDefault();
                if(count >= 2) {
                    count = count - 1;
                    let subBigFormGroup = document.querySelectorAll('.sub-big-form-group');
                    subBigFormGroup[subBigFormGroup.length-1].remove();

                    let rowImageOfDescription = document.querySelectorAll('.rowImageOfDescription');
                    rowImageOfDescription[rowImageOfDescription.length-1].remove();
                }
            });
        }

        let btn_add_image_of_description = document.querySelectorAll('.btn_add_image_of_description'); //btb upload
        let btn_remove_image_of_description = document.querySelectorAll('.btn_remove_image_of_description'); //btb upload
        let multiDescriptImages = document.querySelectorAll('.multiDescriptImages'); // input ẩn
        for(let count = 0; count < btn_add_image_of_description.length-1; count++) {
            btn_add_image_of_description[count].addEventListener('click', function(e) {
                e.preventDefault();
                let classInputImage = '.' + e.currentTarget.getAttribute('input-multiDescriptImages');
                e.currentTarget.closest('.multiImageDescriptParent').querySelector(classInputImage).click();
            });
        } 
        btn_remove_image_of_description.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                let classInputImage = '.' + e.currentTarget.getAttribute('input-multiDescriptImages');
                e.currentTarget.closest('.multiImageDescriptParent').querySelector(classInputImage).value = '';
                let newHtml = `
                    <span style="font-weight: 900; font-size: 1.2rem;">Chưa có ảnh nào.</span>
                `;
                e.currentTarget.closest('.rowImageOfDescription').querySelector('.displayImageOD').innerHTML =  newHtml;
    
            });
        });
        multiDescriptImages.forEach((item) => {
            item.addEventListener('change', function(e) {
                let files = e.currentTarget.files;
                
                // nếu lớn hơn 5 ảnh thì xóa bớt
                if(files.length > 5) {
                    const dt2 = new DataTransfer();
                    for (let file of files) {
                        dt2.items.add(file);
                    }
                    e.currentTarget.files = dt2.files;
                    for(let i = files.length; i > 5; i--) {
                        let indexDelete = i - 1;
                        console.log(indexDelete);
                        dt2.items.remove(indexDelete);
                    }
                    e.currentTarget.files = dt2.files;
                    files = dt2.files;
                }
                // load ảnh 
                let count = 0;
                e.currentTarget.closest('.rowImageOfDescription').querySelector('.displayImageOD').innerHTML = '';
                for(const file of files) {
                    let scrLink = URL.createObjectURL(file);
                    // console.log(scrLink);
                    testCount = count + 1;
                    let newHtml = `
                        <img src="`+ scrLink +`" class="rounded mx-auto d-block displayDescription`+ testCount +`" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                    `;
                    e.currentTarget.closest('.rowImageOfDescription').querySelector('.displayImageOD').insertAdjacentHTML('beforeend', newHtml);
                    count = count + 1;
                }


            });
        });

        function loadFile(){
            let url_image_description_old = document.querySelectorAll('.url_image_description_old');
            url_image_description_old.forEach( async el=>{
                if(el.value!='')
                {
                    let  inputFile = el.closest('.rowImageOfDescription').querySelector('.multiDescriptImages');
                    
                    let arr_name = el.value.split('/');
                    let nameFile = arr_name[arr_name.length-1];
                    let fileImage = await new File([await (await fetch(el.value)).blob()],nameFile,{
                        type: `image/${nameFile.split('.').slice(-1)[0]}`
                    });
                    const dt = new DataTransfer();
                    for (let subfile of inputFile.files) {
                        dt.items.add(subfile);
                    }
                    dt.items.add(fileImage);
                    inputFile.files = dt.files;
                    console.log(inputFile.files);
                    let scrLink = URL.createObjectURL(fileImage);
                    let newHtml =` 
                        <img src="`+ scrLink +`" class="rounded mx-auto d-block displayDescription" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                    `;
                    el.closest('.displayImageOD').insertAdjacentHTML('beforeend', newHtml);
                    
                    
                    

                }
            });
        }



        $('.btn_update_description_product').click(function() {
        
            let id_product = $('#id_product').val();
            // list descript product
            let listDescriptionProduct = [];
            let subBigFormGroup = document.querySelectorAll('.sub-big-form-group');
            subBigFormGroup.forEach((item) => {
                let subListDescriptionProduct = new Object();
                subListDescriptionProduct.titleDescription = item.querySelector('.titleDescription').value;
                subListDescriptionProduct.contentDescription = item.querySelector('.contentDescription').value;
                listDescriptionProduct[listDescriptionProduct.length] = subListDescriptionProduct;
            });

            let listDescriptImage = [];
            let multiDescriptImages = document.querySelectorAll('.multiDescriptImages');
            multiDescriptImages.forEach((item,idx)=>{
                let filesD = item.files;
                let count = 0;
                for(let fileD of filesD) {
                    listDescriptImage[listDescriptImage.length] = new File([fileD],`mota${idx+1}_file${count+1}${fileD.name}`,{
                        type:fileD.type,lastModified:fileD.lastModified});
                        count = count + 1;
                }
            });
            

            
            var form  = new FormData();
            form.append('id_product', id_product);
            form.append('listDescriptionProduct', JSON.stringify(listDescriptionProduct));

            for(let i = 0; i < listDescriptImage.length; i++) {
                form.append('listDescriptImage'+i.toString(), listDescriptImage[i]);
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{URL::to("admin/product/update-description-product")}}',
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
    {{-- style upload description  --}}
    <style>
        .displayImageOD {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

    </style>


@endsection

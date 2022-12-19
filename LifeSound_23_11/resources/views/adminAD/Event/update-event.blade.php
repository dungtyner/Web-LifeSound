@extends('adminAD.indexAdmin')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title" style="">
            Quản Lý Sự Kiện
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                {{-- <i class="fa fa-certificate" aria-hidden="true" style="color: black;"></i> --}}
                <i class="fa fa-calendar" aria-hidden="true" style="color: black;"></i>
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
                    0px 34px 30px rgba(0,0,0,0.1);">Cập Nhật Sự Kiện</div>
                </div>

                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Trạng Thái Sự Kiện</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <select class="form-control status_event" id="status_event">
                                        @if ($dataEvent->status_event == 'Hiện')
                                            <option status_event="Hiện" selected>Hiện</option>
                                            <option status_event="Ẩn">Ẩn</option>
                                        @else
                                            <option status_event="Hiện" >Hiện</option>
                                            <option status_event="Ẩn" selected>Ẩn</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Mã Giảm Giá</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control" id="code_sale" placeholder="Nhập mã giảm giá" value="{{ $dataEvent->code_sale }}">
                                    <input type="text" id="id_code_sale" value="{{ $dataEvent->id_code_sale }}" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Giá Giảm %</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control" id="value_sale" placeholder="Nhập số giá giảm" value="{{ $dataEvent->value_sale }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Thời Gian Diễn Ra</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn_choose_date" id="basic-addon1">
                                                <i class="fa fa-calendar" aria-hidden="true" style="color: black;"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="date_event" class="form-control" value="{{ $dataEvent->date_event }}" placeholder="Nhập Nhày Giờ" aria-label="Username" aria-describedby="basic-addon1" >
                            
                                    </div>
                                </div>
                            </div>



                            
                            <div class="form-group row">
                                <div class="form-group col-md-5">
                                    <button class="button-30" role="button" disabled>Mô Tả Sự Kiện</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <textarea class="form-control" id="description_event" rows="3" placeholder="Mô tả sự kiện">{{ $dataEvent->description_event }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row" >
                                <div class="form-group col-md-5">
                                    <button class="button-30 upload" role="button"><i class="fa fa-upload" aria-hidden="true" style="margin-right: 0.5rem;"></i> Đăng Ảnh</button>
                                </div>
                                <div class="form-group col-md-7">
                                    <input type="text" class="form-control" id="display_file_image" placeholder="Đây là tên ảnh" disabled>
                                    <input id="news_image" type="file" name="news_image" class="file-upload-default">
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="button" class="btn btn-outline-success btn_update_event"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right: 0.5rem;"></i>Cập Nhật Sự Kiện</button>
                            </div>
    
                        </form>
                    </div>
                    <div class="col">
                        <img src="{{ $dataEvent->url_event }}" class="rounded mx-auto d-block displayImage" alt="" style="width: 200px; height: 200px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>

    {{-- display lịch --}}
    <link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"   />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script >
        $('#date_event').each(function () {
            $(this).datetimepicker();
        });
    </script>
    {{-- event --}}
    <script>
        $('.upload').click(function(e) {
            e.preventDefault();
            $('#news_image').click();
        });

        $('#news_image').change(function(e) {
            $('#display_file_image').val(e.currentTarget.files[0].name);
            $('.displayImage').attr('src',URL.createObjectURL(e.currentTarget.files[0]));
        });

        $('.btn_update_event').click(function() {

            let status_event = $('#status_event option:selected').attr('status_event');
            console.log(status_event);
        
            let id_code_sale = $('#id_code_sale').val();
            let code_sale = $('#code_sale').val();
            let value_sale = $('#value_sale').val();
            let description_event = $('#description_event').val();
            let url_event = $('#news_image')[0].files;
            let date_event = $('#date_event').val();
            

            if(value_sale == '' || code_sale == '' || description_event == '' || date_event=='') {
                displayToast('Nhập đầy đủ đi stupid guy!');
            } else {

                var form  = new FormData();
                form.append('id_code_sale', id_code_sale);
                form.append('status_event', status_event);
                form.append('code_sale', code_sale);
                form.append('value_sale', value_sale);
                form.append('description_event', description_event);
                form.append('url_event', url_event[0]);
                form.append('date_event', date_event);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("admin/event/update-event")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        window.location.href = '{{URL::to("admin/event/show-update-event")}}';
                    },
                    error: function() {
                        displayToast('Không sửa được.');
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

        .btn_choose_date {
            cursor: pointer;
        }


    </style>


@endsection

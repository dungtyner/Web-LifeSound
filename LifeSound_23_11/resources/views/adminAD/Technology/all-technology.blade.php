@extends('adminAD.indexAdmin')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title">
            Quản Lý Công Nghệ Âm Thanh
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
                    0px 34px 30px rgba(0,0,0,0.1);">Bảng Danh Sách Công Nghệ Âm Thanh</div>
                </div>

                <table style="margin-top:20px " class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#Mã Công Nghệ</th>
                            <th>Tên Công Nghệ</th>
                            <th>Ảnh Công Nghệ</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listdataTechnology as $subListdataTechnology) 
                            <tr class="row_data_news">
                                <td class="get_id_data_technology">{{ $subListdataTechnology->id_tech_sound_product }}</td>
                                <td>{{ $subListdataTechnology->name_tech_sound_product }}</td>

                                <td>
                                    <img style="object-fit: cover; border-radius: 0px" width="100px" height="100px"
                                        src="{{ URL::to($subListdataTechnology->logo_tech_sound_product) }}"
                                        alt="">
                                </td>

                                <td>
                                    <button type="button" class="btn btn btn-outline-success btn-detail-technology">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-delete-technology">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>

                </table>
            </div>
        </div>
    </div>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>
        $('.btn-detail-technology').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_technology').text();

            window.location.href = "update-technology/" + dataID + "";
        })

        $('.btn-delete-technology').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_technology').text();
            window.location.href = "delete-technology/" + dataID + "";
        });
    </script>

    


@endsection

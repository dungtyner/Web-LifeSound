@extends('adminAD.indexAdmin')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title">
            Quản Lý Sản Phẩm
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="fa fa-headphones" aria-hidden="true" style="color: black;"></i>
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
                    0px 34px 30px rgba(0,0,0,0.1);">Bảng Danh Sách Sản Phẩm</div>
                </div>

                <table style="margin-top:20px " class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;">#Mã Sản Phẩm</th>
                            <th style="vertical-align: middle;">Tên Sản Phẩm</th>
                            <th style="vertical-align: middle;">Ảnh Sản Phẩm</th>
                            <th style="vertical-align: middle;">Sửa Tên, Thương Hiệu</th>
                            <th style="vertical-align: middle;">Sửa Danh Sách Thể Loại, Công Nghệ</th>
                            <th style="vertical-align: middle;">Danh sách Mô tả</th>
                            <th style="vertical-align: middle;">Danh sách Hình Ảnh</th>
                            <th style="vertical-align: middle;">Danh Sách Sản Phẩm Con</th>
                            <th style="vertical-align: middle;">Xóa Sản Phẩm</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($listDataProduct as $subListDataProduct)
                            <tr class="row_data_news">
                                <td class="get_id_data_product">{{ $subListDataProduct->id_product }}</td>
                                <td>{{ $subListDataProduct->name_product }}</td>

                                <td>
                                    <img style="object-fit: cover; border-radius: 0px" width="100px" height="100px"
                                        src="{{ URL::to($subListDataProduct->url_img_product) }}"
                                        alt="">
                                </td>

                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-name-brand-product"><i class="fa fa-stack-exchange" aria-hidden="true"></i></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-dark btn-category-technology-product"><i class="fa fa-linode" aria-hidden="true"></i></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-warning btn-description-product"><i class="fa fa-indent"
                                            aria-hidden="true"></i></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success btn-image-product"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-sub-product"><i class="fa fa-server" aria-hidden="true"></i></button>
                                </td>   

                                <td>
                                    <button type="button" class="btn btn-outline-danger btn-delete-product">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>

                </table>

                <div class="row">
                    <div class="col">
                        <div class="form-group" style="text-align: center; border-top: 1px solid black; padding-top:  1rem;">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination" style="justify-content: center;">
                                    @for($i = 1; $i <= $total_page; $i++)
                                        {{-- echo '<a href="phantrang.php?page='.$i.'">'.$i.'</a> | '; --}}
                                        <li class="page-item"><a class="page-link" href="/admin/product/all-product?page={{ $i }}">{{ $i }}</a></li>
                                    @endfor
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>

        $('.btn-description-product').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_product').text();
            window.location.href = "show-description-product/" + dataID + "";
        });
        $('.btn-sub-product').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_product').text();
            window.location.href = "show-update-sub-product/" + dataID + "";
        });
        $('.btn-image-product').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_product').text();
            window.location.href = "show-update-image-product/" + dataID + "";
        });
        $('.btn-category-technology-product').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_product').text();
            window.location.href = "show-update-category-technology-product/" + dataID + "";
        });
        $('.btn-name-brand-product').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_product').text();
            window.location.href = "show-update-name-brand-product/" + dataID + "";
        });
        $('.btn-delete-product').click(function() {
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_product').text();
            window.location.href = "delete-product/" + dataID + "";
        });
    </script>


@endsection

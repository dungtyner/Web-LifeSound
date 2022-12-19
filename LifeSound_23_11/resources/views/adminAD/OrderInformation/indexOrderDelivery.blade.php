@extends('adminAD.indexAdmin')
@section('contentAdmin')
    <div class="page-header">
        <h3 class="page-title">
            Quản Lý Đơn Hàng Đang Giao
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="fa fa-fw fa-file" style="color: black;"></i>
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
                    <div class="card-title col-sm-9">Bảng Danh Sách Đơn Hàng</div>
                </div>

                <table style="margin-top:20px " class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#Mã Đơn Hàng</th>
                            <th>Ngày Đặt Hàng</th>
                            <th>Ảnh Người Mua</th>
                            <th>Trạng Thái</th>
                            <th>Xác nhận đã giao hàng</th>
                            <th>Xem Đơn Hàng</th>
                            <th>Xóa Đơn Hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataOrderInfo as $subDataOrderInfo)
                        <tr class="row_data_news">
                            <td class="get_id_data_order_infomation">{{ $subDataOrderInfo->id_order_infomation }}</td>
                            <td>{{ $subDataOrderInfo->date_order }}</td>

                            <td>
                                <img style="object-fit: cover; border-radius: 0px" width="100px" height="100px"
                                    src="{{ $subDataOrderInfo->image_Account }}"
                                    alt="">
                            </td>

                            <td>{{ $subDataOrderInfo->status }}</td>

                            <td>
                                <button class="button-89 confirmSuccess" role="button"><i class="fa fa-check" aria-hidden="true"></i>Giao Hàng Thành Công</button>
                            </td>

                            <td>
                                <button type="button" class="btn btn-outline-warning btn-order-detail"><i class="fa fa-indent"
                                        aria-hidden="true"></i></button>
                            </td>

                            <td>
                                <button type="button" class="btn btn-outline-danger btn-delete-order"><i
                                        class="fa fa-trash" aria-hidden="true"></i></button>
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
        $('.confirmSuccess').click(function (e) {
            e.preventDefault();

            let dataID = $(this).closest('.row_data_news').children('.get_id_data_order_infomation').text();
            // console.log(dataID);
            $.ajax({
                url: '{{URL::to("admin/order/confirm-success")}}',
                method: 'get',
                data: {
                    id_order_infomation: dataID
                },
                success: function(data) {
                    window.location.href = '{{URL::to("admin/order/all-order-delivery")}}';
                },
                error: function() {
                    displayToast('Không xóa được.');
                }
            });
        });

        $('.btn-order-detail').click(function(e) {
            e.preventDefault();

            let dataID = $(this).closest('.row_data_news').children('.get_id_data_order_infomation').text();

            console.log(dataID);

            window.location.href = "details-order/" + dataID + "";
        });

        $('.btn-delete-order').click(function(e) {
            e.preventDefault();
            let dataID = $(this).closest('.row_data_news').children('.get_id_data_order_infomation').text();

            window.location.href = "delete-order-after/" + dataID + "";
        });
    </script>

    <style>
        /* CSS */
        .button-89 {
            --b: 3px;
            /* border thickness */
            --s: .45em;
            /* size of the corner */
            --color: #373B44;

            padding: calc(.5em + var(--s)) calc(.9em + var(--s));
            color: var(--color);
            --_p: var(--s);
            background:
                conic-gradient(from 90deg at var(--b) var(--b), #0000 90deg, var(--color) 0) var(--_p) var(--_p)/calc(100% - var(--b) - 2*var(--_p)) calc(100% - var(--b) - 2*var(--_p));
            transition: .3s linear, color 0s, background-color 0s;
            outline: var(--b) solid #0000;
            outline-offset: .6em;
            font-size: 16px;

            border: 0;

            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-89:hover,
        .button-89:focus-visible {
            --_p: 0px;
            outline-color: var(--color);
            outline-offset: .05em;
        }

        .button-89:active {
            background: var(--color);
            color: #fff;
        }
    </style>
@endsection

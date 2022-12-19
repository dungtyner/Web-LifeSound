@extends('adminAD.indexAdmin')
@section('contentAdmin')

    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Bảng Điều Khiển</a>
            </li>
            <li class="breadcrumb-item active">Bảng Điều Khiển</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-comments"></i>
                        </div>
                        <div class="mr-5">{{ $listData->countComment }} Bình Luận</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="/admin/dashboard#all-notification-page">
                        <span class="float-left">Xem chi tiết</span>
                        <span class="float-right">
                            <i class="fa fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-shopping-cart"></i>
                        </div>
                        <div class="mr-5">{{ $listData->countOrder }} Đơn Hàng Đang Xử Lý</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="/admin/order/all-order-processing">
                        <span class="float-left">Xem chi tiết</span>
                        <span class="float-right">
                            <i class="fa fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-list"></i>
                        </div>
                        <div class="mr-5">{{ $listData->countProduct }} Sản Phẩm</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="/admin/product/all-product">
                        <span class="float-left">Xem chi tiết</span>
                        <span class="float-right">
                            <i class="fa fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-ravelry" aria-hidden="true"></i>
                        </div>
                        <div class="mr-5">{{ $listData->countBrand }} Thương Hiệu</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="/admin/brand/all-brand">
                        <span class="float-left">Xem chi tiết</span>
                        <span class="float-right">
                            <i class="fa fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Lượt Đồ Doanh Thu-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Doanh Thu
            </div>
            <div class="card-body">
                <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Đã Cập Nhật 
                <?php
                    $today = date('d/m/Y');
                    echo $today;
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <!-- Lượt Đồ Thông Kê Sản Phẩm -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-bar-chart"></i> Sản Phẩm Đã Bán
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8 my-auto">
                                <canvas id="myBarChart" width="100" height="50"></canvas>
                            </div>
                            <div class="col-sm-4 text-center my-auto">
                                <div class="h4 mb-0 text-primary">$34,693</div>
                                <div class="small text-muted">YTD Revenue</div>
                                <hr>
                                <div class="h4 mb-0 text-warning">$18,474</div>
                                <div class="small text-muted">YTD Expenses</div>
                                <hr>
                                <div class="h4 mb-0 text-success">$16,219</div>
                                <div class="small text-muted">YTD Margin</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">Đã Cập Nhật 
                        <?php
                            $today = date('d/m/Y');
                            echo $today;
                        ?>
                    </div>
                </div>
                <!-- Card Columns Example Social Feed-->
                <div class="mb-0 mt-4">
                    <i class="fa fa-newspaper-o"></i> Một Số Sản Phẩm Mới
                </div>
                <hr class="mt-2">
                <div class="card-columns">
                    @foreach ($products as  $product)
                        <div class="card mb-3 card_product_admin">
                            <a>
                                <img class="card-img-top img-fluid w-100" src="{{URL::to($product->img->url_img_product)}}" alt="">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title mb-1"><a class="text-LifeSound">{{ $product->name_product }}</a></h6>
                                <p class="card-text small ">
                                    {{substr($product->shortIntro->title_description,0,40)}}...
                                </p>
                            </div>
                            <hr class="my-0">
                            <div class="card-body py-2 small">
                                <a class="mr-3 d-inline-block text-danger">
                                    <i class="fa fa-fw fa-heart"></i>
                                    {{ $product->count_product_loved }}
                                </a>
                                <a class="mr-3 d-inline-block text-primary">
                                    <i class="fa fa-fw fa-comment "></i>
                                    {{ $product->count_commnent }}
                                </a>
                                <a class="d-inline-block text-success">
                                    <i class="fa fa-fw fa fa-money "></i>
                                    {{ number_format(($product->price->root_price_product), 0, '', '.') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                <!-- /Card Columns-->
            </div>
            <div class="col-lg-4">
                <!--  Trạng Thái Sản Phẩm-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-pie-chart"></i> Trạng Thái Sản Phẩm
                    </div>
                    <div class="card-body">
                        <canvas id="myPieChart" width="100%" height="100"></canvas>
                    </div>
                    <div class="card-footer small text-muted">Đã Cập Nhật 
                        <?php
                            $today = date('d/m/Y');
                            echo $today;
                        ?>
                    </div>
                </div>
                <!-- Thông Báo -->
                <div class="card mb-3" id="all-notification-page">
                    <div class="card-header" id="all-notification-page">
                        <i class="fa fa-bell-o"></i> Tất Cả Thông Báo
                    </div>
                    <div class="list-group list-group-flush small all_notification_content">
                        <div class="show_all_notification_content">

                        </div>
                        {{-- @foreach ($dataForum as $sub_dataForum)
                            @if ($sub_dataForum->notification_type == 'notification_admin_order')
                                <a class="list-group-item list-group-item-action">
                                    <div class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="{{ $sub_dataForum->notification_avt }}" class="rounded-circle"  width="45" height="45" alt="">
                                        <div class="media-body">
                                            <strong class="text-success">{{ $sub_dataForum->notification_title }}</strong><br>
                                            <strong>{{ $sub_dataForum->notification_content }}</strong>.
                                            <div class="text-muted smaller">{{ $sub_dataForum->notification_date }}</div>
                                        </div>
                                    </div>
                                </a>
                            @elseif ($sub_dataForum->notification_type == 'notification_admin_cancel_order')
                                <a class="list-group-item list-group-item-action" >
                                    <div class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="{{ $sub_dataForum->notification_avt }}" class="rounded-circle"  width="45" height="45" alt="">
                                        <div class="media-body">
                                            <strong class="text-danger">{{ $sub_dataForum->notification_title }}</strong><br>
                                            <strong>{{ $sub_dataForum->notification_content }}</strong>.
                                            <div class="text-muted smaller">{{ $sub_dataForum->notification_date }}</div>
                                        </div>
                                    </div>
                                </a>
                            @elseif ($sub_dataForum->notification_type == 'notification_admin_comment')
                                <a class="list-group-item list-group-item-action" >
                                    <div class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="{{ $sub_dataForum->notification_avt }}" class="rounded-circle"  width="45" height="45" alt="">
                                        <div class="media-body">
                                            <strong class="text-info">{{ $sub_dataForum->notification_title }}</strong><br>
                                            <strong>{{ $sub_dataForum->notification_content }}</strong>.
                                            <div class="text-muted smaller">{{ $sub_dataForum->notification_date }}</div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach --}}

                        <nav aria-label="Page navigation example " class="all_pagination">
                            <ul class="pagination all_pagination_border">
                                {{-- @if ($total_page > 0)
                                    @for ($i = 1; $i <= $total_page; $i++)
                                        <li class="page-item"><a class="page-link total_page" page="{{ $i }}">{{ $i }}</a></li>
                                    @endfor
                                @else
                                    <li class="page-item"><a class="page-link total_page" page="1">1</a></li>
                                @endif --}}
                            </ul>
                        </nav>
                    </div>
                    <div class="card-footer small text-muted">Đã Cập Nhật 
                        <?php
                            $today = date('d/m/Y');
                            echo $today;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Data Table Example
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011/01/25</td>
                                <td>112,000 VNĐ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Đã Cập Nhật 
                <?php
                    $today = date('d/m/Y');
                    echo $today;
                ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Noble Team Oct 2022</small>
            </div>
        </div>
    </footer>










    {{-- Css Dasshoard --}}
    <style>
        .list-group-item {
            cursor: pointer;
        }
        .all_pagination {
            display: flex;
            justify-content: center;
        }
        .pagination {
            margin: 0.5rem;
        }
        .rounded-circle {
            object-fit: cover;
        }
        .card_product_admin {
            cursor: pointer;
        }
        .text-LifeSound {
            color: #4d2082 !important;
        }
        .btn-outline-LifeSound {
            border: 2px solid #4d2082;
            color: #4d2082;
        }
        .btn-outline-LifeSound:hover {
            background-color: rgb(252 229 249);
        }
        .btn-outline-LifeSound:focus {
            /* border-bottom: 2px solid black; */
            box-shadow: rgba(200, 3, 214, 0.3) 0px 0px 0px 3px;
            outline: #4d2082;
        }
        .input-LifeSound{
            border: 2px solid #4d2082;
        }
        .input-LifeSound:focus {
            outline: none;
            border: 2px solid #4d2082;
            box-shadow: rgba(200, 3, 214, 0.3) 0px 0px 0px 3px;
        }
        .mb-3 {
            margin: 0px !important;
        }
    </style>


    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js'></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
    <script src="{{ asset('backend/js/DashBoardAdmin.js') }}"></script>
    


    {{-- render date from database  --}}
    <script>
        let delivery = {!! json_encode($listData->list_charts_order->delivery) !!};
        let process = {!! json_encode($listData->list_charts_order->process) !!};
        let cancel = {!! json_encode($listData->list_charts_order->cancel) !!};
        let success = {!! json_encode($listData->list_charts_order->success) !!};
        PieChart(delivery, process, cancel, success);


        var list_charts_product = {!! json_encode($listData->list_charts_product) !!};
        console.log(list_charts_product);
        BarChart(list_charts_product);


        AreaChart();


    </script>

    @if ($dataForum)
        <script>
            var data = {!! json_encode($dataForum) !!};
            var page = {!! json_encode($total_page) !!};
            loadNotificationDashBoard(data, page);
        </script>
    @endif
    
@endsection
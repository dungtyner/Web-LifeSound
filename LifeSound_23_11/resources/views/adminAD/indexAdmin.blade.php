<?php

    $dataForum = DB::table('notification_page')
    ->where(['notification_object' => -1])
    ->orderBy('id_notification', 'desc')
    ->limit(3)
    ->get(
        array(
            'id_notification',
            'notification_object',
            'notification_type',
            'notification_avt',
            'notification_title',
            'notification_content',
            'notification_date'
        )    
    );

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{asset('images/owl.png')}}">    
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

</head>


<!-- partial:index.partial.html -->

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        {{-- <a class="navbar-brand" href="#">LIFE SOUND</a> --}}
        <h1 class="purples">LIFE SOUND</h1>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                {{-- Bảng điều khiển --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="/admin">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Bảng điều khiển</span>
                    </a>
                </li>
                {{-- Quản lý đơn hàng --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                        href="#collapseOrderInformation" data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-file"></i>
                        <span class="nav-link-text">Quản Lí Đơn Hàng</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseOrderInformation">
                        <li>
                            <a href="/admin/order/all-order-processing">Đơn hàng chờ xử lý</a>
                        </li>
                        <li>
                            <a href="/admin/order/all-order-delivery">Đơn hàng đang vận chuyển</a>
                        </li>
                    </ul>
                </li>
                {{-- Quản lý sản phẩm --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                        href="#collapseProduct" data-parent="#exampleAccordion">
                        <i class="fa fa-headphones" aria-hidden="true"></i>
                        <span class="nav-link-text">Quản Lí Sản Phẩm</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseProduct">
                        <li>
                            <a href="/admin/product/all-product">Tất Cả Sản Phẩm</a>
                        </li>
                        <li>
                            <a href="/admin/product/add-product">Thêm Sản Phẩm</a>
                        </li>
                    </ul>
                </li>
                {{-- Quản lý Thương Hiệu --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                        href="#collapseBrand" data-parent="#exampleAccordion">
                        <i class="fa fa-certificate" aria-hidden="true"></i>
                        <span class="nav-link-text">Quản Lí Thương Hiệu</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseBrand">
                        <li>
                            <a href="/admin/brand/all-brand">Tất Cả Thương Hiệu</a>
                        </li>
                        <li>
                            <a href="/admin/brand/add-brand">Thêm Thương Hiệu</a>
                        </li>
                    </ul>
                </li>
                {{-- Quản lý Thể Loại --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                        href="#collapseCategory" data-parent="#exampleAccordion">
                        <i class="fa fa-braille" aria-hidden="true"></i>
                        <span class="nav-link-text">Quản Lí Thể Loại</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseCategory">
                        <li>
                            <a href="/admin/category/all-category">Tất Cả Thể Loại</a>
                        </li>
                        <li>
                            <a href="/admin/category/add-category">Thêm Thể Loại</a>
                        </li>
                    </ul>
                </li>
                {{-- Quản lý Công Nghệ Âm Thanh --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                        href="#collapseTechnology" data-parent="#exampleAccordion">
                        <i class="fa fa-connectdevelop" aria-hidden="true"></i>
                        <span class="nav-link-text">Quản Lí Công Nghệ</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseTechnology">
                        <li>
                            <a href="/admin/technology/all-technology">Tất Cả Công Nghệ</a>
                        </li>
                        <li>
                            <a href="/admin/technology/add-technology">Thêm Công Nghệ</a>
                        </li>
                    </ul>
                </li>
                {{-- Quản lý Thông Tin Ngân Hàng --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                        href="#collapseBank" data-parent="#exampleAccordion">
                        <i class="fa fa-university" aria-hidden="true"></i>
                        <span class="nav-link-text">Hình Thức Thanh Toán</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseBank">
                        <li>
                            <a href="/admin/bank/show-update-bank/1">VISA</a>
                        </li>
                        <li>
                            <a href="/admin/bank/show-update-bank/2">VIETCOMBANK</a>
                        </li>
                        <li>
                            <a href="/admin/bank/show-update-bank/3">ZALO Pay</a>
                        </li>
                        <li>
                            <a href="/admin/bank/show-update-bank/4">Nhận Tại Nhà</a>
                        </li>
                    </ul>
                </li>
                {{-- Cập Nhật Banner --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Banner">
                    <a class="nav-link" href="/admin/banner/show-update-banner-brand">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                        <span class="nav-link-text">Cập Nhật Bìa Thương Hiệu</span>
                    </a>
                </li>
                {{-- Cập Nhật Sự Kiện --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Event">
                    <a class="nav-link" href="/admin/event/show-update-event">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span class="nav-link-text">Cập Nhật Sự Kiện</span>
                    </a>
                </li>
                {{-- Tin Nhắn --}}
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Chat">
                    <a class="nav-link" href="/admin/chat/show-chat">
                        <i class="fa fa-comments" aria-hidden="true"></i>
                        <span class="nav-link-text">Tin Nhắn</span>
                    </a>
                </li>
                

                
            </ul>
            {{-- close open collapse --}}
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-envelope"></i>
                        <span class="indicator text-primary d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"  style="color: #bb60c7;"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">New Messages:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>David Miller</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty
                                awesome! These messages clip off when they reach the end of the box so they don't
                                overflow over to the sides!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>Jane Smith</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I was wondering if you could meet for an
                                appointment at 3:00 instead of 4:00. Thanks!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>John Doe</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I've sent the final files over to you for review.
                                When you're able to sign off of them let me know and we can discuss distribution.
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all messages</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="indicator text-warning d-none d-lg-block">
                            <i class="fa fa-fw fa-circle" style="color: #bb60c7;"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header notification_page">Thông Báo:</h6>
                        @foreach ($dataForum as $sub_dataForum)
                            @if ($sub_dataForum->notification_type == 'notification_admin_order')
                                <a class="dropdown-item" href="#">
                                    <span class="text-success">
                                        <strong>
                                            <img src="{{ $sub_dataForum->notification_avt }}" class="mr-3 rounded-circle" width="50" height="50" alt="User" style="object-fit: cover;" />
                                            {{ $sub_dataForum->notification_title }}
                                        </strong>
                                    </span>
                                    <span class="small float-right text-muted">{{ $sub_dataForum->notification_date }}</span>
                                    <div class="dropdown-message small">
                                        {{ $sub_dataForum->notification_content }}
                                    </div>
                                </a>
                            @elseif ($sub_dataForum->notification_type == 'notification_admin_cancel_order')
                                <a class="dropdown-item" href="#">
                                    <span class="text-danger">
                                        <strong>
                                            <img src="{{ $sub_dataForum->notification_avt }}" class="mr-3 rounded-circle" width="50" height="50" alt="User"  style="object-fit: cover;"/>
                                            {{ $sub_dataForum->notification_title }}
                                        </strong>
                                    </span>
                                    <span class="small float-right text-muted">{{ $sub_dataForum->notification_date }}</span>
                                    <div class="dropdown-message small">
                                        {{ $sub_dataForum->notification_content }}
                                    </div>
                                </a>
                            @elseif ($sub_dataForum->notification_type == 'notification_admin_comment')
                                <a class="dropdown-item" href="#">
                                    <span class="text-info">
                                        <strong>
                                            <img src="{{ $sub_dataForum->notification_avt }}" class="mr-3 rounded-circle" width="50" height="50" alt="User"  style="object-fit: cover;"/>
                                            {{ $sub_dataForum->notification_title }}
                                        </strong>
                                    </span>
                                    <span class="small float-right text-muted" style="">{{ $sub_dataForum->notification_date }}</span>
                                    <div class="dropdown-message small">
                                        {{ $sub_dataForum->notification_content }}
                                    </div>
                                </a>
                            @endif
                        @endforeach
                        
                    
                        
                        <a class="dropdown-item small" href="/admin/dashboard#all-notification-page">Xem Tất Cả Thông Báo >></a>
                    </div>
                </li>
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group">
                            <input class="form-control input-lifeSound" type="text" placeholder="Tìm Kiếm ...">
                            <span class="input-group-append">
                                <button class="btn btn-lifeSound" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    @if(session()->has('inforAdmin'))
                        <img src="{{ session()->get('inforAdmin')->images_admin }}" class="avatar-navbar" style="width: 50px;
                        height: 50px;
                        object-fit: cover;
                        border: 2px solid #ededed;
                        border-radius: 50px;">
                        {{-- <a class="nav-link" data-toggle="modal" data-target="#exampleModal" style="color: white;">{{ session()->get('inforAdmin')->full_name_admin }}</a> --}}
                        <span style="color: white;">{{ session()->get('inforAdmin')->full_name_admin }}</span>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/logout-admin">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="content-wrapper">
        @yield('contentAdmin')
    </div>

    <div class="toast">
        <div class="toast-content">
            <i class="fa fa-info check" aria-hidden="true"></i>
            {{-- <i class="fa-solid fa-circle-info"></i> --}}


            <div class="message">
                <span class="text text-1">Thông Báo nề!!!</span>
                <span class="text text-2">Your changes has been saved</span>
            </div>
        </div>
        {{-- <i class="fa-solid fa-xmark close"></i> --}}
        <i class="fa fa-times close" aria-hidden="true" style="font-size: 20px;"></i>
        <div class="progress"></div>
    </div>

</body>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.5/umd/popper.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js'></script>
    <script src="{{ asset('backend/js/adminAD.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/script.js') }}"></script> --}}

    <script>

        @if(isset($messToast))
            displayToast('{{ json_decode($messToast) }}');
        @endif
    </script>

</html>

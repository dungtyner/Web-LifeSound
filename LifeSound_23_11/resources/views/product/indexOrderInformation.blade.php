@extends('product.index')
@section('content')
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    

    <div class="container text-center">

        @foreach ($dataYourOrderInformation as $subDataYourOrderInformation)
            <div class="border_rowmain"> 
                <div class="row rowmain first-border" data-id="{{ $subDataYourOrderInformation->id_order_infomation }}">
                    <div class="col-8" style="">
                        <div class="row">
                            <b>Thông Tin Đơn Hàng: {{ $subDataYourOrderInformation->id_order_infomation }}</b>
                        </div>
                        <div class="row">
                            <b>Ngày Đặt Hàng: {{ $subDataYourOrderInformation->date_order }} </b>
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="button-85" role="button">{{ $subDataYourOrderInformation->status }}</button>
                        <div class="border-collapse open" data-id="{{ $subDataYourOrderInformation->id_order_infomation }}">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
        
                <div class="row rowmain {{ $subDataYourOrderInformation->id_order_infomation }}" id="offcollapsehehe">
                    <table class="table">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">#</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Đơn Giá</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $subDataYourOrderInformation->listProductOrder  as $subListProductOrder)
                                <tr>
                                    <td>{{ $subListProductOrder->id_product }}</td>
                                    <td>{{ $subListProductOrder->name_product }}</td>
                                    <td>{{ number_format(($subListProductOrder->unit_price), 0, '','.') }} </td>
                                    <td>{{ $subListProductOrder->count }}</td>
                                    <td style="text-align: right;">{{ number_format(($subListProductOrder->count * $subListProductOrder->unit_price), 0, '', '.') }}<span class="badge badge-danger badge-price-off" style="background: purple;">VNĐ</span></td>

                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" style="text-align: right;"><b>Tổng Tiền Sản Phẩm:</b></td>
                                <td style="text-align: right;">{{ number_format(($subDataYourOrderInformation->totalPrice), 0, '', '.') }}<span class="badge badge-danger badge-price-off" style="background: purple;">VNĐ</span></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right;"><b>Phí Ship:</b></td>
                                <td style="text-align: right;">{{ number_format(($subDataYourOrderInformation->shipping), 0, '', '.') }}<span class="badge badge-danger badge-price-off" style="background: purple;">VNĐ</span></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right;"><b>Giảm Giá:</b></td>
                                <td style="text-align: right;">{{ number_format(($subDataYourOrderInformation->sale), 0, '', '.') }}<span class="badge badge-danger badge-price-off" style="background: purple;">VNĐ</span></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right;"><b>Tổng Tiền:</b></td>
                                <td style="text-align: right;">{{ number_format(($subDataYourOrderInformation->totalPriceFinal), 0, '', '.') }}<span class="badge badge-danger badge-price-off" style="background: purple;">VNĐ</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
        
        



        {{-- <div class="border_rowmain"> 
            <div class="row rowmain first-border" data-id="ANHYEUEM3001">
                <div class="col-8">
                    <div class="row">
                        <b>Order Detail: ANHYEUEM3001</b>
                    </div>
                    <div class="row">
                        <b>Date Order: 23-06-2022 23:06:18 </b>
                    </div>
                </div>
                <div class="col-4">
                    <button class="button-85" role="button">ĐANG XỬ LÝ</button>
                    <div class="border-collapse open" data-id="ANHYEUEM3001">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="row rowmain ANHYEUEM3001" id="offcollapsehehe">
                <table class="table">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">#</th>
                            <th scope="col">Information Product</th>
                            <th scope="col">Count</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Into Money</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>BASUES</td>
                            <td>$25</td>
                            <td>2</td>
                            <td>$50</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Air Port</td>
                            <td>$25</td>
                            <td>1</td>
                            <td>$25</td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>TOTAL:</b></td>
                            <td>$75</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row rowmain ANHYEUEM3001" id="offcollapsehehe">
                <div class="col informationorder">
                    <div class="row"><h5>Information Order</h5></div>
                    <div class="row">
                        Order Name Customer: TRUONG THANH TUNG
                    </div>
                    <div class="row">
                        Phone: 0354723814 
                    </div>
                    <div class="row">
                        Email: tungtt2.21it@vku.udn.vn 
                    </div>
                    <div class="row">
                        Local: 470 Tran Dai Nghia, p Hoa Hai, q Ngu Hanh Son, TP Da Nang, nuoc Viet Nam 
                    </div>
                </div>


                <div class="col informationorder">
                    <div class="row"><h5>Information Transfer</h5></div>
                    <div class="row">
                        Order Content Transfer: ANHYEUEM3000-20221010232323
                    </div>
                    <div class="row">
                        Num Card: 2306 1810 2306 1810 
                    </div>
                    <div class="row">
                        Limit: Transfer 100% 
                    </div>
                    <div class="row">
                        Status: WAITING PAYMENT 
                    </div>
                </div>
            </div>
        </div> --}}

    </div>

@endsection
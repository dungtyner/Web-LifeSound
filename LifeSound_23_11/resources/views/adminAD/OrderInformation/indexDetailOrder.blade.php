@extends('adminAD.indexAdmin')
@section('contentAdmin')
    <table style="width: 1000px; margin: auto">
        <caption>CHI TIẾT ĐƠN HÀNG</caption>


        <tbody class="{{ $dataOrderInfo->id_order_infomation }}">
            <tr>
                <td colspan="3" class="left">ID Đơn Hàng: <b>{{ $dataOrderInfo->id_order_infomation }}</b><br /><br />Ngày: <b>{{ $dataOrderInfo->date_order }}</b> </td>
                <td colspan="3" class="right-collapse-detail-info">
                    <div class="border-right-icon-collapse-detail open" data-order="{{ $dataOrderInfo->id_order_infomation }}">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                    </div>
                </td>
            </tr>
            <!-- Items -->
            <tr class="{{ $dataOrderInfo->id_order_infomation }} tr" style="background: #ecd3ec;">
                <td colspan="6">
                    <table >
                        <thead style="backdrop-filter: blur(10px); border: solid 2px #ff00cf;">
                            <tr style="background: none;">
                                <th scope="col">ID Đơn Hàng</th>
                
                                <th scope="col">Tên</th>

                                <th scope="col">Màu sắc</th>
                                
                                <th scope="col">Cổng</th>
                
                                <th scope="col">Số Lượng</th>
                
                                <th scope="col">Đơn Giá</th>

                                <th scope="col">Thành Tiền</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $dataOrderInfo->listProductOrder  as $subListProductOrder)
                                <tr>
                                    <td>{{ $subListProductOrder->id_product }}</td>
                                    <td>{{ $subListProductOrder->name_product }}</td>
                                    <td>{{ $subListProductOrder->color_product }}</td>
                                    <td>{{ $subListProductOrder->plug_product }}</td>
                                    <td>{{ $subListProductOrder->count }}</td>
                                    <td>{{ number_format(($subListProductOrder->unit_price), 0, '','.') }} </td>
                                    <td style="text-align: right;">{{ number_format(($subListProductOrder->count * $subListProductOrder->unit_price), 0, '', '.') }}<span class="badge badge-danger badge-price-off">VNĐ</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                {{-- <th scope="col"></th> --}}
                
                                <th scope="col" colspan="4" style="text-align: right;">Phí Ship:</th>
                
                                <th scope="col"></th>
                                <th scope="col"></th>

                
                                <th scope="col" style="text-align: right;">{{ number_format(($dataOrderInfo->shipping), 0, '', '.') }}  <span class="badge badge-danger badge-price-off">VNĐ</span></th>
                            </tr>

                            <tr>
                                {{-- <th scope="col"></th> --}}
                
                                <th scope="col"  colspan="4" style="text-align: right;">Giảm Giá:</th>
                
                                <th scope="col"></th>
                                <th scope="col"></th>

                
                                <th scope="col" style="text-align: right;">{{ number_format(($dataOrderInfo->sale), 0, '', '.') }} <span class="badge badge-danger badge-price-off">VNĐ</span></th>
                            </tr>

                            <tr>
                                {{-- <th scope="col"></th> --}}
                
                                <th scope="col" colspan="4" style="text-align: right;">Tổng Cộng:</th>
                
                                <th scope="col">{{ $dataOrderInfo->countProduct }}</th>
                                <th scope="col"></th>

                
                                <th scope="col" style="text-align: right;">{{ number_format(($dataOrderInfo->totalPriceFinal), 0, '', '.') }} <span class="badge badge-danger badge-price-off">VNĐ</span></th>
                
                            </tr>
                        </tfooter>
                        
                    </table>
                </td>
            </tr>
            
            <tr class="{{ $dataOrderInfo->id_order_infomation }} tr">
                <td colspan="3">
                    <table>
                        <caption>Thông Tin Khách Hàng</caption>
                        <tbody>
                        <tr>
                            <td>ID:</td>
            
                            <td> {{ $dataOrderInfo->id_account }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tên:</td>
            
                            <td> {{ $dataOrderInfo->customer->name_account }}
                            </td>
                        </tr>
                        <tr>
                            <td>Địa Chỉ: </td>
            
                            <td>  {{ $dataOrderInfo->local_order }}
                            </td>
                        </tr>
                        <tr>
                            <td>SĐT: </td>
            
                            <td> {{ $dataOrderInfo->customer->phone_account }}
                            </td>
                        </tr>
                        <tr>
                            <td>Email: </td>
            
                            <td>{{ $dataOrderInfo->customer->email_account }}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td colspan="3">
                    <table>
                        <caption>Thông Tin Đơn Hàng</caption>
                        <tbody>
                        <tr>
                            <td>ID Đơn Hàng:</td>
            
                            <td> {{ $dataOrderInfo->id_order_infomation }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Trạng Thái: </td>
            
                            <td> {{ $dataOrderInfo->status }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Số Tiền Phải Trả:</td>
            
                            <td> {{ number_format(($dataOrderInfo->totalPriceFinal), 0, '', '.') }} VNĐ
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Hình Thức Thanh Toán: </td>
            
                            <td> {{ $dataOrderInfo->payment }}
                            </td>
                        </tr>
                        @if( $dataOrderInfo->payment != 'Gửi Tiền Khi Nhận Hàng')
                            <tr>
                                <td>
                                Số TK: </td>
                
                                <td> {{ $dataOrderInfo->dataBank->number_Bank }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Nội Dung Chuyển Khoảng: </td>
                
                                <td> {{ $dataOrderInfo->id_order_infomation }}
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    
                </td>
            </tr>
        </tbody>

    </table>




    <style>
        
        table {
            border: 1px solid red;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }



        table caption {
            font-size: 1.5em;
            margin: 0.5em 0 0.75em;
            caption-side: top;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: 0.35em;
        }

        table th,
        table td {
            padding: 0.625em;
            text-align: center;
        }

        table th {
            font-size: 0.85em;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: 0.625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: 0.8em;
                text-align: right;
            }

            table td::before {
                /*
            * aria-label has no advantage, it won't be read inside a table
            content: attr(aria-label);
            */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }

        /* Button */
        .badge {
            display: inline-block;
            padding: 0.25rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .badge-price-off {
            font-size: 12px;
            background-color: #9d0a92;
        }

        .badge-price-off,
        .badge-price-off-wishlist {
            font-weight: 700;
            color: #fff;
            border-radius: 0.25rem;
            text-transform: uppercase;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }



        .right-collapse-detail-info {
            /* background-color: #dc3545; */
            
        }

        .right-collapse-detail-info .border-right-icon-collapse-detail {
            width: 30px;
            height: 30px;
            /* border: 1px solid black; */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            margin-left: auto;
        }

        .button-cancel-order {
            width: 90%;
            height: 50px;
            background-color: red;
            font-size: 20px;
            color: black;
            cursor: pointer;
        }

        .button-check-order {
            width: 90%;
            height: 50px;
            background-color: rgb(0, 255, 0);
            font-size: 20px;
            color: black;
            cursor: pointer;
        }

        .tr {
            /* display: none; */
        }
    </style>
@endsection
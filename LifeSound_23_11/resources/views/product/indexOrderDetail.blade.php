@extends('product.index')
@section('content')

        <table style="width: 1000px; margin: auto">
            <caption>CHI TIẾT ĐƠN HÀNG</caption>

            @foreach($dataYourOrdered as $subDataYourOrdered)

                <tbody class="{{ $subDataYourOrdered->id_order_infomation }}">
                    <tr>
                        <td colspan="3" class="left">ID Đơn Hàng: <b>{{ $subDataYourOrdered->id_order_infomation }}</b><br /><br />Ngày: <b>{{ $subDataYourOrdered->date_order }}</b> </td>
                        <td colspan="3" class="right-collapse-detail-info">
                            <div class="border-right-icon-collapse-detail open" data-order="{{ $subDataYourOrdered->id_order_infomation }}">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </td>
                    </tr>
                    <!-- Items -->
                    <tr class="{{ $subDataYourOrdered->id_order_infomation }} tr" style="background: #ecd3ec;">
                        <td colspan="6">
                            <table >
                                <thead style="backdrop-filter: blur(10px); border: solid 2px #ff00cf;">
                                    <tr style="background: none;">
                                        <th scope="col">ID Đơn Hàng</th>
                        
                                        <th scope="col">Tên</th>
                        
                                        <th scope="col">Số Lượng</th>
                        
                                        <th scope="col">Đơn Giá</th>

                                        <th scope="col">Thành Tiền</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $subDataYourOrdered->listProductOrder  as $subListProductOrder)
                                        <tr>
                                            <td>{{ $subListProductOrder->id_product }}</td>
                                            <td>{{ $subListProductOrder->name_product }}</td>
                                            <td>{{ $subListProductOrder->count }}</td>
                                            <td>{{ number_format(($subListProductOrder->unit_price), 0, '','.') }} </td>
                                            <td>{{ number_format(($subListProductOrder->count * $subListProductOrder->unit_price), 0, '', '.') }}<span class="badge badge-danger badge-price-off">VNĐ</span></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfooter>
                                    <tr>
                                        {{-- <th scope="col"></th> --}}
                        
                                        <th scope="col" colspan="2">Phí Ship:</th>
                        
                                        <th scope="col"></th>
                                        <th scope="col"></th>

                        
                                        <th scope="col">{{ number_format(($subDataYourOrdered->shipping), 0, '', '.') }}  <span class="badge badge-danger badge-price-off">VNĐ</span></th>
                                    </tr>

                                    <tr>
                                        {{-- <th scope="col"></th> --}}
                        
                                        <th scope="col"  colspan="2">Giảm Giá:</th>
                        
                                        <th scope="col"></th>
                                        <th scope="col"></th>

                        
                                        <th scope="col">{{ number_format(($subDataYourOrdered->sale), 0, '', '.') }} <span class="badge badge-danger badge-price-off">VNĐ</span></th>
                                    </tr>

                                    <tr>
                                        {{-- <th scope="col"></th> --}}
                        
                                        <th scope="col" colspan="2">Tổng Cộng:</th>
                        
                                        <th scope="col">{{ $subDataYourOrdered->countProduct }}</th>
                                        <th scope="col"></th>

                        
                                        <th scope="col">{{ number_format(($subDataYourOrdered->totalPriceFinal), 0, '', '.') }} <span class="badge badge-danger badge-price-off">VNĐ</span></th>
                        
                                    </tr>
                                </tfooter>
                                
                            </table>
                        </td>
                    </tr>
                    
                    <tr class="{{ $subDataYourOrdered->id_order_infomation }} tr">
                        <td colspan="6">
                        <table>
                            <caption>Thanh Toán cho Tui đi nào!</caption>
                            <thead>
                            <tr>
                                <td>
                                    Đơn Hàng
                                </td>
                                <td>
                                <b>Thanh Toán / Bắt đầu giao dịch</b>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="left" colspan="2">
                                <u><b>Lưu ý:</b></u>
                                <br /> <br />
                                Cảm ơn bạn đã sử dụng dịch vụ của LifeSound. Chúng tôi đã gửi chi tiết đơn đặt hàng của bạn đến email của bạn. Vui lòng thanh toán theo thông tin bên dưới.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    
                    <tr class="{{ $subDataYourOrdered->id_order_infomation }} tr">
                        <td colspan="3">
                            <table>
                                <caption>Thông Tin Khách Hàng</caption>
                                <tbody>
                                <tr>
                                    <td>ID:</td>
                    
                                    <td> {{ $subDataYourOrdered->id_account }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tên:</td>
                    
                                    <td> {{ $dataYourLocal->name_account }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Địa Chỉ: </td>
                    
                                    <td>  {{ $subDataYourOrdered->local_order }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>SĐT: </td>
                    
                                    <td> {{ $dataYourLocal->phone_account }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email: </td>
                    
                                    <td>{{ $dataYourLocal->email_account }}</td>
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
                    
                                    <td> {{ $subDataYourOrdered->id_order_infomation }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    Trạng Thái: </td>
                    
                                    <td> {{ $subDataYourOrdered->status }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    Số Tiền Phải Trả:</td>
                    
                                    <td> {{ number_format(($subDataYourOrdered->totalPriceFinal), 0, '', '.') }} VNĐ
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    Hình Thức Thanh Toán: </td>
                    
                                    <td> {{ $subDataYourOrdered->payment }}
                                    </td>
                                </tr>
                                @if( $subDataYourOrdered->payment != 'Gửi Tiền Khi Nhận Hàng')
                                    <tr>
                                        <td>
                                        Số TK: </td>
                        
                                        <td> {{ $subDataYourOrdered->dataBank->number_Bank }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Nội Dung Chuyển Khoảng: </td>
                        
                                        <td> {{ $subDataYourOrdered->id_order_infomation }}
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            
                        </td>
                    </tr>

                    <td colspan="6" class="{{ $subDataYourOrdered->id_order_infomation }} tr">
                        <table>
                        <tbody>
                            <tr>
                            <td>
                                <button class="button-cancel-order"><i class="fa-solid fa-trash-can"></i> Hủy Đơn Hàng</button>
                            </td>
                            <td>
                                {{-- <button class="button-check-order">Check Order</button> --}}
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </td>
                </tbody>

            @endforeach


            

        </table>

@endsection
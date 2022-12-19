@extends('product.index')
@section('content')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> 
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="{{asset('css/payment/payment.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>

    <div class=" container-fluid my-5 ">
        <div class="row justify-content-center ">
            <div class="col-xl-10">
                <div class="card shadow-lg ">
                    <div class="row  mx-auto justify-content-center text-center">
                        <div class="col-12 mt-3 ">
                            
                        </div>
                    </div>
                
                    <div class="row justify-content-around">
                        <div class="col-md-5">
                            <div class="card border-0">
                                <div class="card-header pb-0">
                                    <h2 class="card-title space ">Kiểm tra</h2>
                                    <p class="card-text text-muted mt-4  space">Nội Dung Chi Tiết</p>
                                    <hr class="my-0">
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-between">
                                        <div class="col-auto mt-0"><p><b>Nhập thông tin vào biểu mẫu. Nhập đúng nội dung chuyển khoản theo cú pháp bên trên tránh nhập sai.</b></p></div>  
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col"><p class="text-muted mb-2">Chi Tiết Thanh Toán</p><hr class="mt-0"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="NAME" class="small text-muted mb-1">TÊN CỦA BẠN</label>
                                        <input type="text" class="form-control form-control-sm" name="NAME" id="nameFromYourLocal" aria-describedby="helpId" placeholder="Enter Your Name" value="{{ $dataYourLocal->name_account }}">
                                    </div>


                                    <div class="row no-gutters">
                                        <div class="col-sm-6 pr-sm-2">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Tỉnh Thành</label>
                                                <select class="form-control" id="exampleFormControlSelectProvince">
                                                    
                                                    @foreach ($dataProvince as $subdataProvince )
                                                        <option data-Province="{{ $subdataProvince->id }}">{{ $subdataProvince->_name }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Quận Huyện</label>
                                                <select class="form-control need-Element-Before" id="exampleFormControlSelectDistrict">
                                                    <option>Chọn Tỉnh Thành đi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-sm-6 pr-sm-2">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Chọn Xã Phường</label>
                                                <select class="form-control need-Element-Before" id="exampleFormControlSelectWard">
                                                    <option>Chọn Huyện Quận Đi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Chọn Tên Đường</label>
                                                <select class="form-control need-Element-Before" id="exampleFormControlSelectStreet">
                                                    <option>Chọn Xã Phường đi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row no-gutters">
                                        <div class="col-sm-2 pr-sm-2">
                                            <div class="form-group">
                                                <label for="NAME" class="small text-muted mb-1">Số Nhà</label>
                                                <input type="text" class="form-control form-control-sm" name="NAME" id="numHouseFromYourLocal" aria-describedby="helpId" placeholder="Nhập Địa Chỉ Nhà!" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label for="NAME" class="small text-muted mb-1">ĐỊA CHỈ CỦA BẠN</label>
                                                <input type="text" class="form-control form-control-sm" name="NAME" id="localFromYourLocal" aria-describedby="helpId" placeholder="Enter Local Here!" value="{{ $dataYourLocal->local_account}}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="row no-gutters">
                                        <div class="col-sm-6 pr-sm-2">
                                            <div class="form-group">
                                                <label for="NAME" class="small text-muted mb-1">Email</label>
                                                <input type="text" class="form-control form-control-sm" name="NAME" id="emailFromYourLocal" aria-describedby="helpId" placeholder="EnterYourEmail" value="{{ $dataYourLocal->email_account }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="NAME" class="small text-muted mb-1">SĐT</label>
                                                <input type="text" class="form-control form-control-sm" name="NAME" id="phoneFromYourLocal" aria-describedby="helpId" placeholder="EnterPhoneNumber" value="{{ $dataYourLocal->phone_account }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-md-5">
                                        <div class="col">
                                            <button type="button" name="" id="btnSaveInformation" class="btn  btn-lg btn-block ">Lưu Thông Tin</button>
                                        </div>
                                    </div>    
                                </div>

                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col"><p class="text-muted mb-2">Mã Giảm Giá</p><hr class="mt-0"></div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-sm-6 pr-sm-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm" name="NAME" id="displayCodeSale"  placeholder="Nhập Mã Giảm" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <button type="button" name="" id="btnApplyCodeSale" class="btn  btn-lg btn-block ">Áp Dụng Mã Giảm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            
                            <div class="card border-0 ">
                                

                                <div class="card-form-list-bank">
                                    <div class="card-items-visa">
                                            <div class="logo">
                                                {{-- <img src="{{ $dataBank->image_background_bank }}" class="image_background_bank" alt="Visa"> --}}
                                            </div>
                                            <div class="chip">
                                                <img src="https://raw.githubusercontent.com/dasShounak/freeUseImages/main/chip.png" alt="chip">
                                            </div>
                                            <div class="number number_Bank">{{ $dataBank->number_Bank }}</div>
                                            <div class="name name_user_Bank">{{ $dataBank->name_user_Bank }}</div>
                                            <div class="from">18/10</div>
                                            <div class="to">23/06</div>
                                            <div class="ring"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header card-2">
                                    <div class="form-group choose-bank">
                                        <span class="border border-light applyChoosePayments" id_Bank="1" data-bank="VISA">
                                            <img src="https://raw.githubusercontent.com/dasShounak/freeUseImages/main/Visa-Logo-PNG-Image.png" alt="">
                                        </span>
                                        <span class="border border-primary applyChoosePayments" id_Bank="3" data-bank="ZALO PAY">
                                            <img src="{{ asset('images/bank/zalosvg.svg') }}" alt="">
                                        </span>
                                        <span class="border border-success applyChoosePayments" id_Bank="2" data-bank="VIETCOMBANK">
                                            <img src="{{ asset('images/bank/VietcomBank.png') }}" alt="">
                                        </span>
                                        <span class="border border-warning applyChoosePayments" id_Bank="4" data-bank="Gửi Tiền Khi Nhận Hàng">
                                            <img src="{{ asset('images/bank/giaoHang.jpg') }}" alt="">
                                        </span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="NAME" class="small text-muted mb-1">Hình thức thanh toán</label>
                                        <input type="text" class="form-control form-control-sm way-payment" name="NAME" placeholder="Hình Thức Thanh Toán!"  disabled>
                                    </div>
                                </div>
                                
                        


                                <div class="card-header card-2">
                                    <p class="card-text text-muted mt-md-4  mb-2 space">ĐƠN HÀNG CỦA BẠN<span class=" small text-muted ml-2 cursor-pointer">CHỈNH SỬA GIỎ HÀNG</span> </p>
                                    <hr class="my-2">
                                </div>
                                <div class="card-body pt-0">
                                    
                                    <div class="borderList-PaymentProduct" >
                                        @foreach ( $dataYourOdered->dataProductForCarts as $dataProductForCart )
                                        <div class="row justify-content-between">

                                            
                                            <div class="col-auto col-md-7">
                                                <div class="media flex-column flex-sm-row">
                                                    <img class=" img-fluid" src="{{ $dataProductForCart->img->url_img_product }}" width="62" height="62">
                                                    <div class="media-body  my-auto">
                                                        <div class="row ">
                                                            <div class="col-auto"><p class="mb-0"><b>{{ $dataProductForCart->name_product }}</b></p><small class="text-muted">1 Week Subscription</small></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" pl-0 flex-sm-col col-auto  my-auto"> <p class="boxed-1">{{ $dataProductForCart->quantity_ordered }}</p></div>
                                            <div class=" pl-0 flex-sm-col col-auto  my-auto "><p><b>{{ number_format(($dataProductForCart->finalPriceProduct),0,'','.') }} VNĐ</b></p></div>
                                            <hr class="my-2">
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr class="my-2">
                                    <div class="row ">
                                        <div class="col">
                                            <div class="row justify-content-between">
                                                <div class="col-4"><p class="mb-1"><b>Giá gốc</b></p></div>
                                                <div class="flex-sm-col col-auto"><p class="mb-1"><b>{{ number_format(($dataYourOdered->obj_totalOdered->valueTotalOrdered), 0, '', '.')   }} VNĐ</b></p></div>
                                            </div>
                                            <div class="row justify-content-between">
                                                <div class="col"><p class="mb-1"><b>Phí vận chuyển</b></p></div>
                                                <div class="flex-sm-col col-auto"><p class="mb-1"><b class="phiVanChuyen">{{ number_format(($dataYourOdered->obj_totalOdered->obj_shiping), 0, '', '.')   }} </b><b>VNĐ</b></p></div>
                                            </div>
                                            <div class="row justify-content-between">
                                                <div class="col"><p class="mb-1"><b>Giảm giá</b></p></div>
                                                <div class="flex-sm-col col-auto"><p class="mb-1"><b class="giamGia">0</b><b> VNĐ</b></p></div>
                                            </div>
                                            <div class="row justify-content-between">
                                                <div class="col-4"><p ><b>Tổng cộng</b></p></div>
                                                <div class="flex-sm-col col-auto"><p  class="mb-1"><b class="TongCong">{{  number_format(($dataYourOdered->obj_totalOdered->finalTotalOrdered), 0, '', '.')  }} </b><b> VNĐ</b></p> </div>
                                            </div><hr class="my-0">
                                        </div>
                                    </div>
                                    <div class="row mb-5 mt-4 ">
                                        <div class="col-md-7 col-lg-6 mx-auto"><button type="button" id="btnBtnBlockBtnOutlinePrimaryBtnLg" class="btn btn-block btn-outline-primary btn-lg">XÁC NHẬN ĐƠN HÀNG</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
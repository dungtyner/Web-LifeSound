@extends('product.index')
@section('content')
    <link rel="stylesheet" href="{{asset('css/event/event.css')}}">

    @if ($dataEvent->status_event == 'Hiện')
        <div id="countdown">
            <div id='tiles'></div>
            <div class="labels">
                <li>Ngày</li>
                <li>Giờ</li>
                <li>Phút</li>
                <li>Giây</li>
            </div>
        </div>

        <div class="big_class">
            <div class="content_left">
                <div class="box box2">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="content">
                        <h2>Nội Dung Sự Kiện:</h2>
                        <p><a>
                            {{ $dataEvent->description_event }}
                        </a></p>
                    </div>
                
                </div>
            </div>
            <div class="content_right">
                
                <div class="box box1">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="content">
                        <h2>{{ $dataEvent->code_sale }}</h2>
                    </div>
                    
                </div>

                <div class="div_image_shake" style="">
            
                    <figure class="wave">
                        <img src="/images/event/dungggg.jpg" alt="rajni"></img>
                        <figcaption>Dũng Lương</figcaption>
                    </figure>
                
                    <figure class="wave">
                        <img src="/images/event/Meeeee.jpg" alt="chuck"></img>
                    <figcaption>Tùng Chương</figcaption>
                    </figure>
                
                    <figure class="wave">
                    <img src="/images/event/nhattt.jpg" alt="chan"></img>
                    <figcaption>Nhật Đặng</figcaption>
                    </figure>
                
                    
                
                </div>
            </div>
        </div>


        
        @if ( $dataEvent->url_event )
            <style>
                .content-life-sound {
                    background-image: url({{ $dataEvent->url_event }});
                }
            </style>
        @else
            <style>
                .content-life-sound {
                    background-image: black;
                }
            </style>
        @endif
        

        <script  src="{{asset('js/event/event.js')}}"></script>
        <script>
            var target_date = new Date('{{ $dataEvent->date_event }}').getTime();
            getCountdown();
        </script>      
    @else
        <div class="content_left">
            <div class="box">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <div class="content">
                    <h2>Không Có Sự Kiện Nào Cả Hihi:</h2>
                    <p><a>
                        Việc đổi mới thương hiệu của chúng tôi sẽ không thể thực hiện được nếu không có sự ủng hộ của bạn. Xin chân thành cảm ơn vì đã luôn đồng hành cùng công ty chúng tôi trong năm vừa qua.
                    </a></p>
                </div>
            
            </div>
        </div>

        <style>
            .content-life-sound {
                background-image: black;
            }

            .box {
                position: relative;
                /* top: 50%; */
                top: 0;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 627px;
                height: 157px;
                background: #3c1145a6;
                box-sizing: border-box;
                overflow: hidden;
                box-shadow: 0 20px 50px rgb(90 23 81);
                border: 2px solid #ab2aad;
                color: white;
                padding: 20px;
            }
        </style>
        
    @endif


    
@endsection
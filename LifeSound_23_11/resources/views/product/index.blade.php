<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    @include('layouts.config')

    @include('layouts.mainCss')
    @if($page=='Home')
    {{-- <link rel="stylesheet" href="{{asset('css/celearangce.css')}}"> --}}
    @elseif($page=='Payment')
    <link rel="stylesheet" href="{{asset('css/payment/payment.css')}}">
    @elseif($page=='Order Detail')
    <link rel="stylesheet" href="{{asset('css/order/orderDetail.css')}}">
    @elseif($page=='Order Information')
    <link rel="stylesheet" href="{{asset('css/order/orderInformation.css')}}">
    @elseif($page=='Forum')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{asset('css/forum/forum.css')}}">
    @else
    @endif

    @include('layouts.mainJS')
    @if($page=='Home')
        <!-- Script about library Three js 3D -->
        {{-- <script defer type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
        <script defer src="{{asset('js_3d/three.min.js')}}"></script>
        <script defer src="{{asset('js_3d/GLTFLoader.js')}}"></script>
        <script defer src="{{asset('js_3d/OrbitControls.js')}}"></script> --}}
        <!-- <script src="ExtinctApp.js"></script> -->
    @elseif($page=='Payment')
        <script defer type="module" src="{{asset('js/payment/toolPayment.js')}}"></script>
    @elseif($page=='Order Detail')
        <script defer src="{{asset('js/order/orderDetail.js')}}"></script>
    @elseif($page=='Order Information')
        <script defer src="{{asset('js/order/orderInformation.js')}}"></script>
    @elseif($page=='Forum')
        <script defer type="module" src="{{asset('js/forum/forum.js')}}"></script>
    @else
    
    @endif

    
    <title>{{$page}}</title>
</head>
<body>
    
    <div id="root" class="root">
            <header>
            
                <!-- RESPONSIVE -->
                @include('layouts.headerResponsive')
                <!-- FORM SEARCH -->
                @include('layouts.search')
                <!-- FORM CART  -->
                {{--@include('layouts.cart')--}}
                <!-- Header begin -->
                @include('layouts.header')
                <!-- Header end -->
            </header>
            <content>
                
                <div class='content-life-sound'>
                    @yield('content')
                </div>
            </content>

            {{-- <footer>
                @include('layouts.footer')
            </footer> --}}


            <div class="toast">
                <div class="toast-content">
                    <i class="fas fa-solid fa-check check"></i>
                    {{-- <i class="fa-solid fa-circle-info"></i> --}}

        
                    <div class="message">
                        <span class="text text-1">Thông Báo nề!!!</span>
                        <span class="text text-2">Your changes has been saved</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
        
                <div class="progress"></div>
            </div>
    </div>

    @if(isset($messToast))
        <script>displayToast('{{ $messToast }}')</script>
    @endif
    
</body>
</html>
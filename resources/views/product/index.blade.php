<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    @include('layouts.config')

    @include('layouts.mainCss')
    @if($page=='Home')
    <link rel="stylesheet" href="{{asset('css/celearangce.css')}}">
    @elseif($page=='Payment')
    <link rel="stylesheet" href="{{asset('css/payment/payment.css')}}">
    @elseif($page=='Order Information')
    <link rel="stylesheet" href="{{asset('css/order/orderInformation.css')}}">
    @elseif($page=='Order Detail')
    <link rel="stylesheet" href="{{asset('css/order/orderDetail.css')}}">
    @else
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/forum/forum.css')}}">
    @endif


    @include('layouts.mainJS')
    @if($page=='Home')

    @elseif($page=='Payment')
    <script defer type="module" src="{{asset('js/payment/toolPayment.js')}}"></script>
    @elseif($page=='Order Information')
    <script defer src="{{asset('js/order/orderInformation.js')}}"></script>
    
    @elseif($page=='Order Detail')
    <script defer src="{{asset('js/order/orderDetail.js')}}"></script>
    
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
                    @if($page=='Home')
                        @include('product.indexHome')
                    @elseif($page=='Payment')
                        @include('product.indexPayment')
                    @elseif($page=='PleaseLogin')
                        @include('product.pleaseLogin')
                    @elseif($page=='Order Information')
                        @include('product.indexOrderInformation')
                    @elseif($page=='Order Detail')
                        @include('product.indexOrderDetail')
                    @else
                        @include('product.indexForum')
                    @endif
            </div>
        </content>

    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('css/celearangce.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">






    <link rel="stylesheet"  href="{{ URL::asset('/css/products/product_detail.css') }}">





<!-- JQUERY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script defer type="module" src="{{ URL::asset('/js/products/product_detail.js') }}"></script>
    <!-- Script about library Three js 3D -->
<script defer type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script defer src="{{asset('js_3d/three.min.js')}}"></script>
<script defer src="{{asset('js_3d/GLTFLoader.js')}}"></script>
<script defer src="{{asset('js_3d/OrbitControls.js')}}"></script>
<!-- <script src="ExtinctApp.js"></script> -->

<script defer type = 'module' src="{{ asset('/js/components/load_componentsPopUp.js') }}"></script>
<script defer type = 'module' src="{{ asset('js/header.js') }}"></script>

<script defer type="module" src="{{ asset('js/login.js') }}"></script>

    <title>Document</title>
</head>
<body>
    
<div id="root" class="root">

        <!-- RESPONSIVE -->
        @include('layouts.headerResponsive')
        <!-- FORM SEARCH -->
        @include('layouts.search')
        <!-- FORM CART  -->
        {{--@include('layouts.cart')--}}
        <!-- Header begin -->
        @include('layouts.header')
        <!-- Header end -->
    </div>
        
        <div class="list_product">
             
             @for($i=0;$i<count($products);$i++)
             
                 <div class="item_product" data-id_product='{{$products[$i]->id_product}}'>
                 {{($products[$i]->name_product)}};
                 </div>
             
             @endfor
             
         
     </div>
        
</body>
</html>
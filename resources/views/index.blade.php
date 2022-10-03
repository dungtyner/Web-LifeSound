<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Sound</title>
    
    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="icon" href="images/owl.png">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->



    <link rel="stylesheet" href="{{asset('css/celearangce.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">

   
    

</head>

<body>

    <div class="root">
        <!-- RESPONSIVE -->
        @include('layouts.headerResponsive')
        <!-- FORM SEARCH -->
        @include('layouts.search')
        <!-- FORM CART  -->
        @include('layouts.cart')
        <!-- Header begin -->
        @include('layouts.header')
        <!-- Header end -->
    </div>
<!-- CONTENT -->
        <div class="content-life-sound">
            <div class="left-content-title">
                <h1>Hello, We are 3 Anh, <br>Welcome to Live Sound Shop !</h1>
                <div class="three-subtitle-nice-home">
                    <div class="row-three-subtitle-nice-home">
                        <i class="fa-solid fa-check"></i>
                        <p>Singin Now !</p>
                    </div>
                    
                    <div class="row-three-subtitle-nice-home">
                        <i class="fa-solid fa-check"></i>
                        <p>Singin Now !</p>
                    </div>
                    <div class="row-three-subtitle-nice-home">
                        <i class="fa-solid fa-check"></i>
                        <p>Singin Now !</p>
                    </div>


                </div>
                <div class="buton-readmore">
                    <button type="button" class="btn btn-warning">Singup Now </button>
                    <button type="button" class="btn btn-info">Read more</button>
                </div>
            </div>
            <div class="model-3d-content">
                <model-viewer class="threeD-edit-home-model" src="images/3D_Product/Phone1/scene.gltf" alt="VR Headset" auto-rotate camera-controls autoplay ar ios-src="Picture_Dinosaur/T-Rex/scene.gltf"></model-viewer>
                <!-- <i class="fa-solid fa-circle-xmark" onclick="close_display()"></i> -->
            </div>
        </div>
        <!-- END CONTENT -->


</body>

<!-- Script about library Three js 3D -->
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script src="{{asset('js_3d/three.min.js')}}"></script>
<script src="{{asset('js_3d/GLTFLoader.js')}}"></script>
<script src="{{asset('js_3d/OrbitControls.js')}}"></script>
<!-- <script src="ExtinctApp.js"></script> -->

<script type = 'module' src="{{ asset('/js/components/load_componentsPopUp.js') }}"></script>
<script type = 'module' src="{{ asset('js/header.js') }}"></script>

<script type="module" src="{{ asset('js/login.js') }}"></script>

</html>
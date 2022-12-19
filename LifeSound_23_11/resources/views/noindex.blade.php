<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Sound</title>
    
    @include('layouts.mainCSS')
    @include('layouts.mainJS')


</head>

<body>

    <div class="root">
        <header>
        <!-- RESPONSIVE -->
        @include('layouts.headerResponsive')
        <!-- FORM SEARCH -->
        @include('layouts.search')
        <!-- FORM CART  -->
        @include('layouts.cart')
        <!-- Header begin -->
        @include('layouts.header')
        <!-- Header end -->
        </header>

    <content>
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
    </content>
    </div>

</body>
</html>
<?php

    $output = "";
    $output .= '
    
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
                    

    <div class="left-content-title">
        <div class="type-word-demo">
            <h1 class="typing-demo">Hello, Welcome to Live Sound Shop!</h1>
        </div>
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
            <model-viewer class="threeD-edit-home-model" src="images/3D_Product/HeadPhone2/scene.gltf" alt="VR Headset" auto-rotate camera-controls autoplay ar ios-src="Picture_Dinosaur/T-Rex/scene.gltf"></model-viewer>
            <!-- <i class="fa-solid fa-circle-xmark" onclick="close_display()"></i> -->
    </div>
    
    
    ';


    echo $output;


?>
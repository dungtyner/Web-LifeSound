function close_display() {

    let close_display = document.getElementById('display_dinosaur');
    close_display.style.transform = 'scale(0.1)';

    setTimeout(function () {
        close_display.style.display = 'none';
    }, 900);
    document.querySelector("#headermua").style.zIndex="1";


}


function openT_Rex() {

    let openT_Rex = document.getElementById('display_dinosaur');

    openT_Rex.innerHTML = '<model-viewer src="Picture_Dinosaur/T-Rex/scene.gltf" alt="VR Headset" auto-rotate camera-controls autoplay ar ios-src="Picture_Dinosaur/T-Rex/scene.gltf"></model-viewer>' +
        ' <i class="fa-solid fa-circle-xmark" onclick="close_display()"></i>';
    openT_Rex.style.backgroundImage = 'url("https://images.pexels.com/photos/449011/pexels-photo-449011.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1")';
    openT_Rex.style.zIndex = 5;
    openT_Rex.style.display = 'block';
    document.querySelector("#headermua").style.zIndex="0";
    setTimeout(function () {
        openT_Rex.style.transform = 'scale(1)';

    }, 0001);



}

function openTriceratops() {

    let openT_Rex = document.getElementById('display_dinosaur');

    openT_Rex.innerHTML = '<model-viewer camera-controls autoplay ar shadow-intensity="1"  src="Picture_Dinosaur/Triceratops/scene.gltf" alt="VR Headset" auto-rotate camera-controls ></model-viewer>' +
        ' <i class="fa-solid fa-circle-xmark" onclick="close_display()"></i>';
    openT_Rex.style.backgroundImage = 'url("https://images.pexels.com/photos/5408006/pexels-photo-5408006.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1")';
    openT_Rex.style.zIndex = 5;
    openT_Rex.style.display = 'block';
    document.querySelector("#headermua").style.zIndex="0";
    setTimeout(function () {
        openT_Rex.style.transform = 'scale(1)';

    }, 0001);




}

function openStegosaurus() {
    let openT_Rex = document.getElementById('display_dinosaur');

    openT_Rex.innerHTML = '<model-viewer camera-controls autoplay ar shadow-intensity="1"  src="Picture_Dinosaur/Stegosaur/scene.gltf" alt="VR Headset" auto-rotate camera-controls ></model-viewer>' +
        ' <i class="fa-solid fa-circle-xmark" onclick="close_display()"></i>';
    openT_Rex.style.backgroundImage = 'url("https://images.pexels.com/photos/4813938/pexels-photo-4813938.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1")';
    openT_Rex.style.zIndex = 5;
    openT_Rex.style.display = 'block';
    document.querySelector("#headermua").style.zIndex="0";
    setTimeout(function () {
        openT_Rex.style.transform = 'scale(1)';

    }, 0001);

}

function openSpinosaurus() {

    let openT_Rex = document.getElementById('display_dinosaur');

    openT_Rex.innerHTML = '<model-viewer camera-controls autoplay ar shadow-intensity="1"  src="Picture_Dinosaur/Spinosaurus/scene.gltf" alt="VR Headset"  ></model-viewer>' +
        ' <i class="fa-solid fa-circle-xmark" onclick="close_display()"></i>';
    openT_Rex.style.backgroundImage = 'url("https://images.pexels.com/photos/5594216/pexels-photo-5594216.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1")';
    openT_Rex.style.zIndex = 5;
    openT_Rex.style.display = 'block';
    document.querySelector("#headermua").style.zIndex="0";
    setTimeout(function () {
        openT_Rex.style.transform = 'scale(1)';

    }, 0001);


}


function openIguanodon() {
    let openT_Rex = document.getElementById('display_dinosaur');

    openT_Rex.innerHTML = '<div class="sketchfab-embed-wrapper"> <iframe title="Iguanodon" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/c44704402d534c72a6afd97ebd05b8ce/embed"> </iframe></div>' +
        ' <i class="fa-solid fa-circle-xmark" onclick="close_display()"></i>';
    openT_Rex.style.backgroundImage = 'url("https://images.pexels.com/photos/5594216/pexels-photo-5594216.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1")';
    openT_Rex.style.zIndex = 5;
    openT_Rex.style.display = 'block';
    document.querySelector("#headermua").style.zIndex="0";
    setTimeout(function () {
        openT_Rex.style.transform = 'scale(1)';

    }, 0001);

}


function openDiploducus() {
    let openT_Rex = document.getElementById('display_dinosaur');

    openT_Rex.innerHTML = '<model-viewer camera-controls autoplay ar shadow-intensity="1"  src="Picture_Dinosaur/Diplodocus/scene.gltf" alt="VR Headset" auto-rotate camera-controls ></model-viewer>' +
        ' <i class="fa-solid fa-circle-xmark" onclick="close_display()"></i>';
    openT_Rex.style.backgroundImage = 'url("https://images.pexels.com/photos/4612724/pexels-photo-4612724.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1")';
    openT_Rex.style.zIndex = 5;
    openT_Rex.style.display = 'block';
    document.querySelector("#headermua").style.zIndex="0";
    setTimeout(function () {
        openT_Rex.style.transform = 'scale(1)';

    }, 0001);

}


function openBranchiosaurus() {
    let openT_Rex = document.getElementById('display_dinosaur');

    openT_Rex.innerHTML = '<model-viewer camera-controls autoplay ar shadow-intensity="1"  src="Picture_Dinosaur/Brachiosaurus/scene.gltf" alt="VR Headset" auto-rotate camera-controls ></model-viewer>' +
        ' <i class="fa-solid fa-circle-xmark" onclick="close_display()"></i>';
    openT_Rex.style.backgroundImage = 'url("https://images.pexels.com/photos/4718366/pexels-photo-4718366.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1")';
    openT_Rex.style.zIndex = 5;
    openT_Rex.style.display = 'block';
    document.querySelector("#headermua").style.zIndex="0";
    setTimeout(function () {
        openT_Rex.style.transform = 'scale(1)';

    }, 0001);

}

















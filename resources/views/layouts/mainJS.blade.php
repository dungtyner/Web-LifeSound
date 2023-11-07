<!-- JQUERY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://cdn.socket.io/socket.io-1.0.0.js"></script> -->
<!-- <script  src="{{asset('js/socket.io.js')}}"></script> -->
<script src="https://cdn.socket.io/4.5.4/socket.io.min.js" integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI" crossorigin="anonymous"></script>
<script>
    const socket = io('http://localhost:3000',{ transports : ['websocket'] });
</script>
<!-- Script about library Three js 3D -->
<script defer type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script defer src="{{asset('js_3d/three.min.js')}}"></script>
<script defer src="{{asset('js_3d/GLTFLoader.js')}}"></script>
<script defer src="{{asset('js_3d/OrbitControls.js')}}"></script>

<!-- <script src="ExtinctApp.js"></script> -->

<script defer type="module" src="{{ URL::asset('/js/products/product_detail.js') }}"></script>
<script defer type = 'module' src="{{ asset('/js/components/load_componentsPopUp.js') }}"></script>
<script defer type = 'module' src="{{ asset('js/header.js') }}"></script>
<script defer type="module" src="{{ URL::asset('/js/searchs/searchProduct/searchProduct.js') }}"></script>
<script defer type="module" src="{{ asset('js/login.js') }}"></script>
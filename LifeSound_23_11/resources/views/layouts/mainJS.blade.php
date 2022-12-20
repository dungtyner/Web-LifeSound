<!-- JQUERY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.socket.io/4.5.4/socket.io.min.js" integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI" crossorigin="anonymous"></script>




<script defer type="module" src="{{ URL::asset('/js/products/product_detail.js') }}"></script>
<script defer type = 'module' src="{{ asset('/js/components/load_componentsPopUp.js') }}"></script>
<script defer type = 'module' src="{{ asset('js/header.js') }}"></script>
<script defer type="module" src="{{ URL::asset('/js/searchs/searchProduct/searchProduct.js') }}"></script>
{{-- <script defer type="module" src="{{ URL::asset('js/login.js') }}"></script> --}}


<script>
    function displayToast(mess) {
        document.querySelector('.toast .text.text-2').textContent = mess;
        document.querySelector('.toast').classList.add('active');
        document.querySelector('.progress').classList.add('active');


        let time = setTimeout(() => {
            document.querySelector('.toast').classList.remove("active");
            document.querySelector('.progress').classList.remove("active");
        }, 5000); //1s = 1000 milliseconds

        document.querySelector(".toast .close").addEventListener("click", () => {
            document.querySelector('.toast').classList.remove("active");
            
            setTimeout(() => {
                document.querySelector('.progress').classList.remove("active");
            }, 300);

            clearTimeout(time);
        });
    }

    

    
</script>
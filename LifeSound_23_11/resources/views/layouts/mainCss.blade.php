<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="icon" href="{{asset('images/owl.png')}}">    

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<link rel="stylesheet" href="{{asset('css/login.css')}}">
<link rel="stylesheet" href="{{asset('css/actors/LMD/account/loginLMD.css')}}">
<link rel="stylesheet" href="{{asset('css/header/header.css')}}">
<link rel="stylesheet" href="{{asset('css/actors/LMD/header/headerLMD.css')}}">






<link rel="stylesheet"  href="{{ URL::asset('/css/products/product_detail.css') }}">

<link rel="stylesheet" href="{{asset('css/actors/LMD/carts/cartLMD.css')}}">

<style>
    /* CSS FONT */
    @font-face {
        font-family: 'Rocher';
        src: url(https://assets.codepen.io/9632/RocherColorGX.woff2);
    }

    @font-palette-values --Purples {
        font-family: Rocher;
        base-palette: 6;
    }

    .purples {
        font-family: "Rocher";
        text-align: center;
        font-size: 30px;
        font-palette: --Purples;
    }



    /* CSS TOAASST */
    .toast{
        position: absolute;
        top: 25px;
        right: 30px;
        border-radius: 12px;
        background: #fff;
        padding: 20px 35px 20px 25px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        border-left: 6px solid #ff00f7;
        overflow: hidden;
        transform: translateX(calc(100% + 30px));
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
        z-index: 9;
        display: none;
    }

    .toast.active{
        transform: translateX(0%);
        opacity: 1 !important;
        display: block;
    }

    .toast .toast-content{
        display: flex;
        align-items: center;
    }

    .toast-content .check{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 35px;
        width: 35px;
        background-color: #ff00f7;
        color: #fff;
        font-size: 20px;
        border-radius: 50%;
    }

    .toast-content .message{
        display: flex;
        flex-direction: column;
        margin: 0 20px;
    }

    .message .text{
        font-size: 20px;
        font-weight: 400;;
        color: #666666;
    }

    .message .text.text-1{
        font-weight: 600;
        color: #333;
    }

    .toast .close{
        position: absolute;
        top: 10px;
        right: 15px;
        padding: 5px;
        cursor: pointer;
        opacity: 0.7;
    }

    .toast .close:hover{
        opacity: 1;
    }

    .toast .progress{
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background: #ddd;
    }

    .toast .progress:before{
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        height: 100%;
        width: 100%;
        background-color: #ff00f2;
    }

    .progress.active:before{
        animation: progress 5s linear forwards;
    }

    @keyframes progress {
        100%{
            right: 100%;
        }
    }

</style>

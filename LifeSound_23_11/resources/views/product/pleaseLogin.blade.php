@extends('product.index')
@section('content')
    <style>
        #pleaseLogin{
            background: white;
            height: 100%;
            width: 100%;
            border: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pleaseLogin-text {
            font-size: 30px;
            font-family: monospace;
            height: max-content;
        }
    </style>
    <div id="pleaseLogin">
        <b class="pleaseLogin-text">{{ $mess}}</b>
    </div>
@endsection
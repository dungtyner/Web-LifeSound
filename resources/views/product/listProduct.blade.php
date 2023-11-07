<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    @include('layouts.config')

    @include('layouts.mainCss')

    @include('layouts.mainJS')

    <title>Document</title>
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
            <div class="list_product">
                
                @for($i=0;$i<count($products);$i++)
                
                    <div class="item_product" data-id_product='{{$products[$i]->id_product}}'>
                    {{($products[$i]->name_product)}};
                    </div>
                
                @endfor
                
            
            </div>
        </content>

    </div>
</body>
</html>
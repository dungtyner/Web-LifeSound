<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Life Sound</title>
    
    @include('layouts.config')

    @include('layouts.mainCss')
    
    <link rel="stylesheet" href="{{asset('css/products/deal.css')}}">
    <link rel="stylesheet" href="{{asset('css/actors/LMD/product/dealLMD.css')}}">
    
    @include('layouts.mainJS')
    <script type='module' defer src="{{asset('/js/products/deal.js')}}"></script>

    <!-- FONT AWESOME -->
</head>
<body>

    
    <div class="root" id='root'>
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
         <!-- toolbar responsive -->
         <content>
            
        <div class="mobile-toolbar">
            <button class="mobile-toolbar-item mobile-toolbar-item__filter" 
            {{--onclick="openNav()"--}}
            >
                <img src="{{asset('images/svg/svgexport-25.svg')}}" alt=""class="item-info-img icon-filter">
                <span class="mobile-toolbar-item__label">Filters</span>
            </button>
            <button class="mobile-toolbar-item mobile-toolbar-item__sort-by">
                <span class="mobile-toolbar-item__label">Sort by</span>
                <img src="{{asset('images/svg/svgexport-26.svg')}}" alt=""class="item-info-img icon-chevron">
            </button>
        </div>

        <!-- responsive menu filter -->
        <div class="prod-filter-responsive" id="prod-filter">
            <a href="javascript:void(0)" class="closebtn" {{--onclick="closeNav()"--}}>&times;</a>
            <span class="drawer__overlay"></span>
            
        </div> 

        <div class="container container-banner">
            <div class="content-wrapper-banner">
                <nav class="wrapper-banner-action">
                    <ul class="banner-action-list">
                        <li class="banner-action-item">
                            <a class="banner-action-link" href="/">Home</a>
                        </li>
                        <li class="banner-action-item">
                            <span class="banner-action-link">Unboxed</span>
                        </li>
                        <!-- <li class="banner-action-item"></li> -->
                    </ul>
                </nav>
                <div class="heading-text-banner">
                    <span>Unboxed</span>
                </div>
            </div>
        </div>
        <div class="container-section-template">
            <section class="section section-select">
                <div class="container section-select-wrapper">
                    <div class="scrollable-content-inner">
                        <div class="block-template-item">
                            <a class="item-info-link" href="#">
                                <img src="{{asset('images/svg/svgexport-2.svg')}}" alt=""class="item-info-img">             
                            </a>
                            <div class="item-info-text">
                                <p class="">WIRED EARPHONES</p>
                            </div>
                        </div>
                        <div class="block-template-item">
                            <a class="item-info-link" href="#">
                                <img src="{{asset('images/svg/svgexport-3.svg')}}" alt=""class="item-info-img">
                            </a>
                            <div class="item-info-text">
                                <p class="">WIRED HEADPHONES</p>
                            </div>
                        </div>
                        <div class="block-template-item">
                            <a class="item-info-link" href="#">
                                <img src="{{asset('images/svg/svgexport-4.svg')}}" alt=""class="item-info-img">
                            </a>
                            <div class="item-info-text">
                                <p class="">TRUE WIRELESS EARBUDS</p>
                            </div>
                        </div>
                        <div class="block-template-item">
                            <a class="item-info-link" href="#">
                                <img src="{{asset('images/svg/svgexport-10.svg')}}" alt=""class="item-info-img">  
                            </a>
                            <div class="item-info-text">
                                <p class="">AMPS & DACS</p>          
                            </div>
                        </div>
                        <div class="block-template-item">
                            <a class="item-info-link" href="#">
                                <img src="{{asset('images/svg/svgexport-5.svg')}}" alt=""class="item-info-img"> 
                            </a>
                            <div class="item-info-text">
                                <p class="">WIRELESS HEADPHONES</p>
                            </div>
                        </div>
                        <div class="block-template-item">
                            <a class="item-info-link" href="#">
                                <img src="{{asset('images/svg/svgexport-15.svg')}}" alt=""class="item-info-img">
                            </a>
                            <div class="item-info-text">
                                <p class="">WIRELESS EARPHONES</p>      
                            </div>
                        </div>
                        <div class="block-template-item">
                            <a class="item-info-link" href="#">
                                <img src="{{asset('images/svg/svgexport-8.svg')}}" alt=""class="item-info-img">
                            </a>
                            <div class="item-info-text">
                                <p class="">HI-RES PLAYERS</p> 
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
        </div>
        
        
        
    
    <!-- content begin -->
    <div class="container container-content_deal">
        <div class="col-md-3 product-facet__aside">
            <!-- menu begin -->
            
            <section class="panel">
                <header class="panel-heading">
                    FILTERS
                </header>
                <div class="panel-body">
                    <div class="prod-cat">
                        <div class="prod-nav-list">
                            <button class="btn-block prod-btn-content" 
                            {{--onclick="myFunction()"--}}
                            >
                                Brand
                                <i class="fa fa-angle-down nav-arrow-icon"></i>
                            </button>
                            @if(count($brands)>0)
                            <div class="prod-subnav-list" id="prod-dropdown-brand">
                                @for($i=0;$i<count($brands);$i++)
                                <div class="prod-subnav-item" data-id-brand-product={{$brands[$i]->id_brand_product}}><div href="#" class="subnav-item-link">{{$brands[$i]->name_brand_product}}</div></div>
                                @endfor
                            </div>
                            @endif

                        </div>
                        <div  class="prod-nav-list">
                            <button class="btn-block prod-btn-content" 
                            {{--onclick="myFunction1()"--}}
                            >
                                Product type
                                <i class="fa fa-angle-down nav-arrow-icon"></i>
                            </button>
                            @if(count($categories)>0)
                            <div class="prod-subnav-list" id="prod-dropdown-type">
                                @for($i=0; $i<count($categories);$i++)
                                <div class="prod-subnav-item" data-id-category-product={{$categories[$i]->id_category_product}}><div href="#" class="subnav-item-link">{{$categories[$i]->name_category_product}}</div></div>
                                @endfor
                            </div>
                            @endif
                        </div>
                        <div  class="prod-nav-list">
                            <button class="btn-block prod-btn-content" 
                            {{--onclick="myFunction2()"--}}
                            >
                                Price
                                <i class="fa fa-angle-down nav-arrow-icon"></i>
                            </button>
                           <div class="prod-subnav-list price-range"  id="prod-dropdown-price">
                                <div class="prod-subnav-lists range-group">
                                    <input type="range" class="form-range subnav-item-range-price" id="myRange" name="points" value="0"  min="0" max="10000">
                                    <!-- <input type="range" class="form-range subnav-item-range-price" id="customRange" name="points"> -->
                                    
                                </div>
                                <div class="prod-subnav-lists range-group-input">
                                    <div class="range-input">
                                        <span class="text--dollar">$</span>
                                        <span class="input-price-field">0</span>
                                        <!-- <input type="text" inputmode="numeric" min="0" max="50000" placeholder="0" class="input-price-field"> -->
                                    </div>
                                    <span class="price-range__delimiter text--small">to</span>
                                    <div class="range-input">
                                        <span class="text--dollar">$</span>
                                        <!-- <input type="text" inputmode="numeric" min="0" max="50000" placeholder="0" class="input-price-field" > -->
                                        <span class="input-price-field" id="demo"></span>
                                    </div>
                                </div>
                                
                           </div>
                        </div>
                        <div  class="prod-nav-list" style='display:none'>
                            <button class="btn-block prod-btn-content" 
                            {{--onclick="myFunction3()"--}}
                            >
                                Availability
                                <i class="fa fa-angle-down nav-arrow-icon"></i>
                            </button>
                            <div class="prod-subnav-list" id="prod-dropdown-availability">
                                <div class="prod-subnav-item"><a href="#" class="subnav-item-link">In stock</a></div>
                                <div class="prod-subnav-item"><a href="#" class="subnav-item-link">Out of stock</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- menu end -->
        </div>
        
        <div class="col-md-9 wrapper-product">
        

            <div class="row product-list">
                
                @foreach ($products as $product)
                    <div class="col-md-4 product-card-item" data-id_product='{{$product->id_product}}'>
                        <section class="panel">
                            <div class="pro-img-box">
                                <img src="{{($product->img->url_img_product)}}" alt="" />
                            </div>

                            <div class=" pro-item-info">
                                <a href="#" class="pro-meta-item-title">
                                    <p class="">{{($product->name_product)}}</p>
                                </a>
                                <span class="subtitle center">{{substr($product->shortIntro->title_description,0,40)}}...</span>
                                <div class="pro-item-price-container">
                                    <div class="price-list">
                                        <span class="price price-highlight">
                                            <span class="visually-hidden">Sale price</span>
                                            {{((1-$product->price->rate_sale_default_product)*$product->price->root_price_product)}}$
                                        </span>
                                        <span class="price price-compare">
                                            <span class="visually-hidden">Regular price</span>
                                            {{($product->price->root_price_product)}}$
                                        </span>
                                    </div>    
                                </div>
                                <a href="#" class="pro-item-meta-reviews">
                                    <div class="rating">
                                        <div class="rating-star">
                                            <img src="{{asset('images/svg/svgexport-30.svg')}}" alt="">
                                            <img src="{{asset('images/svg/svgexport-30.svg')}}" alt="">
                                            <img src="{{asset('images/svg/svgexport-30.svg')}}" alt="">
                                            <img src="{{asset('images/svg/svgexport-30.svg')}}" alt="">
                                            <img src="{{asset('images/svg/svgexport-31.svg')}}" alt="">
                                        </div>
                                        <span class="rating-caption">28 reviews</span>
                                    </div>
                                </a> 
                            </div>
                        </section>
                    </div>
                @endforeach
                
            </div>
            <section class="panel">
                <div class="panel-body next-page-num">
                    <div class="pull-right">
                        <ul class="pagination pagination-sm pro-page-list">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    <!-- content end -->
    </div>
</content>
</div>

</body>
</html>
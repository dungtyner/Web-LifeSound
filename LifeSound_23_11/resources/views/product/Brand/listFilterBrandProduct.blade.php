@extends('product.index')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/products/deal.css')}}">
    <link rel="stylesheet" href="{{asset('css/products/brands.css')}}">
    <link rel="stylesheet" href="{{asset('css/products/product_detail.css')}}">
    <link rel="stylesheet" href="{{asset('css/actors/LMD/product/dealLMD.css')}}">
    <script type='module' src="{{ asset('js/products/deal.js') }}"></script>

    {{-- css library --}}
    <link href="{{ asset('css/home/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


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
                        <span class="banner-action-link">PRODUCT</span>
                    </li>
                    <!-- <li class="banner-action-item"></li> -->
                </ul>
            </nav>
            <div class="heading-text-banner">
                {{-- <span style="font-size: 50px">SẢN PHẨM</span> --}}
                <section class="wrapper">
                    <div class="top">{{ $name_brand_product }}</div>
                    <div class="bottom" aria-hidden="true">{{ $name_brand_product }}</div>
                </section>
                <style>
                    :root {
                        --background-color: transperant;
                        --text-color: hsl(0, 0%, 100%);
                    }
                    .wrapper {
                        display: grid;
                        place-content: center;
                        background-color: var(--background-color);
                        min-height: 40vh;
                        width: 100%;
                        font-family: "Oswald", sans-serif;
                        font-size: clamp(1.5rem, 1rem + 18vw, 15rem);
                        /* font-size: 50px; */
                        font-weight: 700;
                        text-transform: uppercase;
                        color: var(--text-color);
                    }

                    .wrapper > div {
                        grid-area: 1/1/-1/-1;
                    }
                    .top {
                        clip-path: polygon(0% 0%, 100% 0%, 100% 48%, 0% 58%);
                        font-size: 90px;

                    }
                    .bottom {
                        font-size: 90px;

                        clip-path: polygon(0% 60%, 100% 50%, 100% 100%, 0% 100%);
                        color: transparent;
                        background: -webkit-linear-gradient(177deg, black 53%, var(--text-color) 65%);
                        background: linear-gradient(177deg, black 53%, var(--text-color) 65%);
                        background-clip: text;
                        -webkit-background-clip: text;
                        transform: translateX(-0.02em);
                    }
                </style>
            </div>
        </div>
    </div>

    @if ($url_banner_brand_product)
        <style>
            .container-banner {
                background: transparent;    
            }
            .content-life-sound {
                background-image: url('{{ $url_banner_brand_product }}');
                background-size: 100%;
                background-position: center;
                background-attachment: fixed;
            }
        </style>
    @endif

    <div class="container-section-template">
        <section class="section section-select">
            <div class="container section-select-wrapper">
                <div class="scrollable-content-inner">
                    <!-- slid library Start -->
                    <div class="container-fluid py-5">
                        <div class="row px-xl-5">
                            <div class="col">
                                <div class="owl-carousel vendor-carousel">

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
                        </div>
                    </div>
                <!-- slid library End -->
                    
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
                    BỘ LỌC
                </header>
                <div class="panel-body">
                    <div class="prod-cat">
                        <div class="prod-nav-list">
                            <button class="btn-block prod-btn-content">
                                Thương Hiệu
                                <i class="fa fa-angle-down nav-arrow-icon"></i>
                            </button>
                            @if(count($brands)>0)
                            <div class="prod-subnav-list" id="prod-dropdown-brand">
                                @foreach ($brands as $subBrands)
                                    @if ($filter_brand  == $subBrands->id_brand_product)
                                        <div class="prod-subnav-item" data-id-brand-product={{$subBrands->id_brand_product}}>
                                            <div  class="subnav-item-link filter_brand press" id_brand_product={{$subBrands->id_brand_product}}>{{$subBrands->name_brand_product}}</div>
                                        </div>
                                    @else
                                        <div class="prod-subnav-item" data-id-brand-product={{$subBrands->id_brand_product}}>
                                            <div  class="subnav-item-link filter_brand" id_brand_product={{$subBrands->id_brand_product}}>{{$subBrands->name_brand_product}}</div>
                                        </div>
                                    @endif
                                @endforeach
                                {{-- @for($i=0;$i<count($brands);$i++)
                                <div class="prod-subnav-item" data-id-brand-product={{$brands[$i]->id_brand_product}}><div href="#" class="subnav-item-link">{{$brands[$i]->name_brand_product}}</div></div>
                                @endfor --}}
                            </div>
                            @endif

                        </div>
                        <div  class="prod-nav-list">
                            <button class="btn-block prod-btn-content" 
                            {{--onclick="myFunction1()"--}}
                            >
                                Thể loại
                                <i class="fa fa-angle-down nav-arrow-icon"></i>
                            </button>
                            @if(count($categories)>0)
                                <div class="prod-subnav-list" id="prod-dropdown-type">
                                    @for($i=0; $i<count($categories);$i++)
                                        @if($filter_category == $categories[$i]->id_category_product) 
                                            <div class="prod-subnav-item" data-id-category-product={{$categories[$i]->id_category_product}}>
                                                <div  class="subnav-item-link filter_category press" id_category_product="{{$categories[$i]->id_category_product}}">{{$categories[$i]->name_category_product}}</div>
                                            </div>
                                        @else 
                                            <div class="prod-subnav-item" data-id-category-product={{$categories[$i]->id_category_product}}>
                                                <div  class="subnav-item-link filter_category" id_category_product="{{$categories[$i]->id_category_product}}">{{$categories[$i]->name_category_product}}</div>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            @endif
                        </div>
                        <div  class="prod-nav-list">
                            <button class="btn-block prod-btn-content" 
                            {{--onclick="myFunction2()"--}}
                            >
                                Giá
                                <i class="fa fa-angle-down nav-arrow-icon"></i>
                            </button>
                            <div class="prod-subnav-list price-range"  id="prod-dropdown-price">
                                    <div class="prod-subnav-lists range-group">
                                        <input type="range" class="form-range subnav-item-range-price" id="myRange" name="points" value="{{ $filter_price }}"  min="0" max="100000000">
                                        <!-- <input type="range" class="form-range subnav-item-range-price" id="customRange" name="points"> -->
                                        
                                    </div>
                                    <div class="prod-subnav-lists range-group-input">
                                        <div class="range-input">
                                            <span class="input-price-field">0</span>
                                            <span class="text--dollar"> VNĐ</span>
                                            <!-- <input type="text" inputmode="numeric" min="0" max="50000" placeholder="0" class="input-price-field"> -->
                                        </div>
                                        <span class="price-range__delimiter text--small">đến</span>
                                        <div class="range-input">
                                            <!-- <input type="text" inputmode="numeric" min="0" max="50000" placeholder="0" class="input-price-field" > -->
                                            <span class="input-price-field input-price-for-search" id="demo"></span>
                                            <span class="text--dollar"> VNĐ</span>
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
                                <img src="{{URL::to($product->img->url_img_product)}}" alt="" />
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
                                            {{ number_format(((1-$product->price->rate_sale_default_product)*$product->price->root_price_product), 0, '', '.') }} VNĐ
                                        </span>
                                        <span class="price price-compare">
                                            <span class="visually-hidden">Regular price</span>
                                            {{ number_format(($product->price->root_price_product), 0, '', '.') }} VNĐ
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
                            @for($i = 1; $i <= $total_page; $i++)
                                <li><a href="/product/brand?page={{ $i }}">{{ $i }}</a></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- content end -->



    <style>
        .filter_brand.press {
            color: #ff50c8;
        }
        .filter_category.press {
            color: #ff50c8;
        }

    </style>


    {{-- sự kiện filter --}}
    <script>

        let filterCategory = document.querySelectorAll('.filter_category');
        filterCategory.forEach(item => {
            item.addEventListener('click', function(e) {
                
                let filter_category = e.currentTarget.getAttribute('id_category_product');
                let filter_price =  document.querySelector('.input-price-for-search').textContent;
                let filter_brand = document.querySelector('.filter_brand.press').getAttribute('id_brand_product');

                
                // console.log(filter_category);
                // console.log(filter_price);

                
                window.location.href = `/product/brand/filter?filter_brand=${filter_brand}&&filter_category=${filter_category}&&filter_price=${filter_price}`;


            });
        });

        let subnavItemRangePrice = document.querySelector('.subnav-item-range-price');
        subnavItemRangePrice.addEventListener('change', function() {
            let filter_category = 0;
            if(document.querySelector('.filter_category.press')) {
                filter_category = document.querySelector('.filter_category.press').getAttribute('id_category_product');
            }
            let filter_price =  document.querySelector('.input-price-for-search').textContent;
            let filter_brand = document.querySelector('.filter_brand.press').getAttribute('id_brand_product');

            window.location.href = `/product/brand/filter?filter_brand=${filter_brand}&&filter_category=${filter_category}&&filter_price=${filter_price}`;

        });

        let filterBrand = document.querySelectorAll('.filter_brand');
        filterBrand.forEach(item => {
            item.addEventListener('click', function(e) {
                let filter_brand = e.currentTarget.getAttribute('id_brand_product');
                window.location.href = `/product/brand?filter_brand=${filter_brand}`;

            });
        });
    
    </script>


    {{--  css library  --}}
    <style>
        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }
        .px-xl-5 {
            padding-right: 3rem !important;
            padding-left: 3rem !important;

        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            flex-basis: 0;
            flex-grow: 1;
            max-width: 100%;
        }
        .bg-light {
            background-color: #FFFFFF !important;
        }
        .owl-carousel {
            z-index: unset;
        }
        .item-info-img:hover {
            transform: scale(1.3);
            transition: all 0.2s;
            filter: invert(170%) sepia(95%) saturate(935%) hue-rotate(-84deg) brightness(116%) contrast(95%);

        }
        .section-select {
            /* background-image: linear-gradient(to bottom, black, #222222 , white ); */
            background: transparent;
        }
        

        .container-banner {
            background: transparent;    
        }
        .content-life-sound {
            background-color: black;
        }
        .container-fluid.py-5 {
            width: 1300px;
            background: rgba(255, 255, 255, 0.19);
            border: 1px solid rgba(255,255,255,0.2);
            /* position: absolute; */
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }
        

        .block-template-item {
            background: rgba(255,255,255,0.4);
            border: 1px solid rgba(255,255,255,0.2);
            /* position: absolute; */
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        

    </style>

    {{--  --}}
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('css/home/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('css/home/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        (function ($) {
            "use strict";

            // Vendor carousel
            $('.vendor-carousel').owlCarousel({
                loop: true,
                margin: 29,
                nav: false,
                autoplay: true,
                smartSpeed: 1000,
                responsive: {
                    0:{
                        items:2
                    },
                    576:{
                        items:3
                    },
                    768:{
                        items:4
                    },
                    992:{
                        items:5
                    },
                    1200:{
                        items:6
                    }
                }
            });

            // Related carousel
            $('.related-carousel').owlCarousel({
                loop: true,
                margin: 29,
                nav: false,
                autoplay: true,
                smartSpeed: 1000,
                responsive: {
                    0:{
                        items:1
                    },
                    576:{
                        items:2
                    },
                    768:{
                        items:3
                    },
                    992:{
                        items:4
                    }
                }
            });

            
        })(jQuery);
    </script>


    
@endsection

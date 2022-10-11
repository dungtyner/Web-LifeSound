<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Sound</title>

    <link rel="icon" href="images/owl.png">


     <!-- FONT AWESOME -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        
        
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
        <link rel="stylesheet" href="css/header.css">
        
        <?php 

if(isset($_REQUEST['page'])) 
    {
    
        
        
        $numPage = $_REQUEST['page'];
        switch($numPage)
        {
            case 1: 
                echo '
                        
                        <link rel="stylesheet" href="css/celearangce.css">
                    ';
                    break;
                case 2:
                    echo '<link rel="stylesheet" href="css/categories.css">';
                    break;
                case 3: 
                    echo '<link rel="stylesheet" href="css/brands.css">';
                    break;
                case 4:
    
                    break;
                case 5: 
                    $subpage = $_REQUEST['subpage'];
                    if($subpage == 51) 
                    {
                        echo '<link rel="stylesheet" href="css/payment.css">';
                    }
                    else if($subpage == 52)
                    {
                        echo '<link rel="stylesheet" href="css/orderInformation.css">';
                    }
                    else if($subpage == 53)
                    {
                        echo '<link rel="stylesheet" href="css/orderDetail.css">';
                    }
                    break;
                case 6:
                    echo '<link rel="stylesheet" href="css/forum.css">';
                    break;
                case 7:

                    break;
                        

                default: 
                echo '<link rel="stylesheet" href="css/celearangce.css">';
            }
        }
        else 
        {
            echo '<link rel="stylesheet" href="css/celearangce.css">';
        }
    ?>
    <!-- <link rel="stylesheet" href="css/celearangce.css"> -->
    
   
   
</head>

<body>

    <div class="root">

        <!-- RESPONSIVE -->
        <div class="header-show-responsive">
            <div class="row-item-choose-responsive">
                <a href="index.php?page=1">Celearance</a>
            </div>
            <div class="row-item-choose-responsive">
                <a href="index.php?page=2">Categories</a>
            </div>
            <div class="row-item-choose-responsive">
                <a href="index.php?page=3">Brands</a>
            </div>
            <div class="row-item-choose-responsive">
                <a href="index.php?page=4">Deals</a>
            </div>
            <div class="row-item-choose-responsive">
                <a href="index.php?page=5">Payment</a>
            </div>
            <div class="row-item-choose-responsive">
                <a href="index.php?page=6">Forum</a>
            </div>
            <div class="row-item-choose-responsive">
                <a href="index.php?page=7">Developer</a>
            </div>
        </div>
        <div class="header-show-left-responsive">
            <div class="zoom-left-more-item zoom-left-left">
                <i class="fa-solid fa-angles-left"></i>
            </div>
            <div class="three-more-item">
                <div class="zoom-left-more-item">
                    <i class="fa-solid fa-magnifying-glass click-form-search"></i>
                </div>
                <div class="zoom-left-more-item">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="zoom-left-more-item">
                    <i class="fa-solid fa-cart-shopping click-form-cart"></i>
                    <span class="header__cart__count">0</span>
                </div>
            </div>
        </div>


        <!-- FORM SEARCH -->
        <div class="search-content-data">
            <div class="header-search-content-data">
                <input type="text" placeholder="Enter your search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="product-search-content-data">
                <div class="sub-product-display">
                    <div class="image-sub-product">
                        <img src="images/product/1.png" alt="">
                    </div>
                    <div class="content-sub-content-display">
                        <h2>Basues</h2>
                        <p>This is headphone bluetooth hahahahahahahhahhadhshd</p>
                        
                    </div>
                </div>
                <div class="sub-product-display">
                    
                    <div class="image-sub-product">
                        <img src="images/product/2.png" alt="">
                    </div>
                    <div class="content-sub-content-display">
                        <h2>Basues</h2>
                        <p>This is headphone bluetooth hahahahahahahhahhadhshd</p>
                        
                    </div>
                </div>
                <div class="sub-product-display">
                    <div class="image-sub-product">
                        <img src="images/product/3.png" alt="">
                    </div>
                    <div class="content-sub-content-display">
                        <h2>Basues</h2>
                        <p>This is headphone bluetooth hahahahahahahhahhadhshd</p>
                        
                    </div>
                </div>
                <div class="sub-product-display">
                    <div class="image-sub-product">
                        <img src="images/product/4.png" alt="">
                    </div>
                    <div class="content-sub-content-display">
                        <h2>Basues</h2>
                        <p>This is headphone bluetooth hahahahahahahhahhadhshd</p>
                        
                    </div>
                </div>
                



            </div>

            <div class="close-contetn-data">
                <i class="fa-solid fa-angles-right"></i>
            </div>
            
        </div>
        <!-- FORM CART  -->
        <div class="cart-content-data">
            <div class="header-cart-content-data">
                <div class="left-item-cart-content">
                    <p>1</p>
                    <i class="fa-solid fa-bag-shopping"></i>
                    <p>ITEM</p>
                </div>
                <div class="close-content-data">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <div class="product-cart-content-data">
                <div class="sub-cart-product-display">
                    <div class="image-sub-cart-product">
                        <img src="images/product/1.png" alt="">
                    </div>
                    <div class="title-sub-cart-product">
                        <h2>BASUES</h2>
                        <div class="plus-minus-sub-cart-product">
                            <div class="one-three-plus-minus-num">
                                <i class="fa-solid fa-minus"></i>
                            </div>
                            <div class="one-three-plus-minus-num">
                                <h3>1</h3>
                            </div>
                            <div class="one-three-plus-minus-num">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <div class="price-remove-sub-cart-product">
                        <h3>230<span>$</span></h3>
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div class="sub-cart-product-display">
                    <div class="image-sub-cart-product">
                        <img src="images/product/2.png" alt="">
                    </div>
                    <div class="title-sub-cart-product">
                        <h2>BASUES</h2>
                        <div class="plus-minus-sub-cart-product">
                            <div class="one-three-plus-minus-num">
                                <i class="fa-solid fa-minus"></i>
                            </div>
                            <div class="one-three-plus-minus-num">
                                <h3>1</h3>
                            </div>
                            <div class="one-three-plus-minus-num">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <div class="price-remove-sub-cart-product">
                        <h3>230<span>$</span></h3>
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div class="sub-cart-product-display">
                    <div class="image-sub-cart-product">
                        <img src="images/product/3.png" alt="">
                    </div>
                    <div class="title-sub-cart-product">
                        <h2>BASUES</h2>
                        <div class="plus-minus-sub-cart-product">
                            <div class="one-three-plus-minus-num">
                                <i class="fa-solid fa-minus"></i>
                            </div>
                            <div class="one-three-plus-minus-num">
                                <h3>1</h3>
                            </div>
                            <div class="one-three-plus-minus-num">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <div class="price-remove-sub-cart-product">
                        <h3>230<span>$</span></h3>
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div class="sub-cart-product-display">
                    <div class="image-sub-cart-product">
                        <img src="images/product/4.png" alt="">
                    </div>
                    <div class="title-sub-cart-product">
                        <h2>BASUES</h2>
                        <div class="plus-minus-sub-cart-product">
                            <div class="one-three-plus-minus-num">
                                <i class="fa-solid fa-minus"></i>
                            </div>
                            <div class="one-three-plus-minus-num">
                                <h3>1</h3>
                            </div>
                            <div class="one-three-plus-minus-num">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <div class="price-remove-sub-cart-product">
                        <h3>230<span>$</span></h3>
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header begin -->
        <div class="header">
            <div class="header__left">
                <div class="nav_responsive">
                    <div class="icon-menu-more">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <div class="menu-content-more-click">

                    </div>
                </div>

                <div class="nav_none_responsive">
                    <img src="https://condaluna.com/assets/stickers/music-headphones.gif" alt="">
                    <h1>LIFE SOUND</h1>
                </div>

            </div>

            <div class="header__middle">
                <ul id="nav">
                    <li class="nav__item">
                        <a href="index.php?page=1" class="header__nav__celearance">CELEARANCE</a>
                    </li>
                    <li class="nav__item ">
                        <div class="nav__categories">
                            <a href="index.php?page=2">Categories</a>
                        </div>
                        <ul class="subnav">
                            <li class="subnav__item"><a href="#">IN-EARS FOR BEGINERS</a></li>
                            <li class="subnav__item"><a href="#">HEADPHONES FOR BEGINERS</a></li>
                            <li class="subnav__item"><a href="#">TRUE WIRELESS EARBUDS</a></li>
                            <li class="subnav__item"><a href="#">WIRELESS HEADPHONES</a></li>
                            <li class="subnav__item"><a href="#">FLAGSHIP IEMS</a></li>
                            <li class="subnav__item"><a href="#">FLAGSHIP HEADPHONES</a></li>
                        </ul>
                    </li>
                    <li class="nav__item">
                        <div class="nav__brands">
                            <a href="index.php?page=3">Brands</a>
                        </div>
                        <ul class="subnav">
                            <li class="subnav__item"><a href="#">1Custom</a></li>
                            <li class="subnav__item"><a href="#">64 Audio</a></li>
                            <li class="subnav__item"><a href="#">Abyss</a></li>
                            <li class="subnav__item"><a href="#">AlAlAl</a></li>
                            <li class="subnav__item"><a href="#">AKG</a></li>
                            <li class="subnav__item"><a href="#">ALO Audio</a></li>
                            <li class="subnav__item"><a href="#">Altiat</a></li>
                            <li class="subnav__item"><a href="#">Astell&Kern</a></li>
                            <li class="subnav__item"><a href="#">Audeze</a></li>
                            <li class="subnav__item"><a href="#">AudioQuest</a></li>
                            <li class="subnav__item"><a href="#">Aune Audio</a></li>
                            <li class="subnav__item"><a href="#">Austrian Audio</a></li>
                            <!-- <li class="subnav__item"><a href="#">AZLA</a></li>
                            <li class="subnav__item"><a href="#">Bang & Olufsen</a></li>
                            <li class="subnav__item"><a href="#">Beyerdynamic</a></li> -->
                        </ul>
                    </li>
                    <li class="nav__item">
                        <a href="index.php?page=4">Deals</a>
                    </li>
                    <li class="nav__item">
                        <div class="nav_payment">
                            <a href="#">Payment</a>
                        </div>
                        <ul class="subnav">
                            <li class="subnav__item"><a href="index.php?page=5&subpage=51">PAYMENT</a></li>
                            <li class="subnav__item"><a href="index.php?page=5&subpage=52">ORDER INFORMATING</a></li>
                            <li class="subnav__item"><a href="index.php?page=5&subpage=53">ORDER DETAILS</a></li>
                        </ul>
                    </li>
                    <li class="nav__item">
                        <a href="index.php?page=6">Forum</a>
                    </li>
                    <li class="nav__item">
                        <a href="index.php?page=7">Developer</a>
                    </li>
                </ul>



            </div>

            <div class="header__right">
                <ul class="header__linklist">
                    <li class="header__linklist__item">
                        <a href="#" class="click-form-search">Search</a>
                    </li>
                    <li class="header__linklist__item">
                        <a href="#">Login</a>
                    </li>
                    <li class="header__linklist__item">
                        <a href="#" class="click-form-cart">Cart
                            <span class="header__cart__count">0</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- Header end -->


        <!-- CONTENT -->
        <div class="content-life-sound">
        <?php 

            if(isset($_REQUEST['page'])) 
            {
                $numPage = $_REQUEST['page'];
                switch($numPage)
                {
                    case 1: 
                        $page = include 'php/indexHome.php';
                        break;

                    case 2: 
                        $page = include 'php/indexCategories.php';
                        break;
                    
                    case 3: 
                        $page = include 'php/indexBrands.php';
                        break;

                    case 4: 

                        break;
                    case 5: 

                        $subpage = $_REQUEST['subpage'];
                            if($subpage == 51) 
                            {
                                $page = include 'php/indexPayment.php';
                            }
                            else if($subpage == 52)
                            {
                                $page = include 'php/indexOrderInformation.php';
                            }
                            else if($subpage == 53)
                            {
                                $page = include 'php/indexOrderDetail.php';
                            }

                        break;

                    case 6: 
                        $page = include 'php/indexForum.php';
                        break;
                    case 7: 

                        break;

                    default:
                    $page = include 'php/indexHome.php';
                }
            }
            else 
            {
                $page = include 'php/indexHome.php';
            }
        ?>
        </div>
        <!-- END CONTENT -->


    </div>



</body>

<?php 
            if(isset($_GET['page'])) 
            {
                switch($_GET['page'])
                {
                    case 1: 
                        echo '
                            <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
                            <script src="js_3d/three.min.js"></script>
                            <script src="js_3d/GLTFLoader.js"></script>
                            <script src="js_3d/OrbitControls.js"></script>
                        ';
                        break;

                    case 2: 
                        
                        break;
                    
                    case 3: 

                        break;

                    case 4: 

                        break;
                    case 5: 
                        $subpage = $_REQUEST['subpage'];
                        if($subpage == 51) 
                        {
                            
                        }
                        else if($subpage == 52)
                        {
                            echo '
                                <script src="js/orderInformation.js"></script>
                            ';
                        }
                        else if($subpage == 53)
                        {
                            echo '
                            <script src="js/orderDetail.js"></script>
                            ';
                        }
                        break;

                    case 6: 

                        break;
                    case 7: 

                        break;

                    default:
                        echo '
                        <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
                        <script src="js_3d/three.min.js"></script>
                        <script src="js_3d/GLTFLoader.js"></script>
                        <script src="js_3d/OrbitControls.js"></script>
                        ';
                }
            }
            else 
            {
                echo '
                <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
                <script src="js_3d/three.min.js"></script>
                <script src="js_3d/GLTFLoader.js"></script>
                <script src="js_3d/OrbitControls.js"></script>
                ';
            }
?>



<script src="js/header.js"></script>

</html>
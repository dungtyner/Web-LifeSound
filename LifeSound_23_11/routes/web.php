<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Bank\BankAdminController;
use App\Http\Controllers\Backend\Banner\BannerBrandController;
use App\Http\Controllers\Backend\Brand\BrandAdminController;
use App\Http\Controllers\Backend\Category\CategoryAdminController;
use App\Http\Controllers\Backend\Chat\ChatAdminController;
use App\Http\Controllers\Backend\Event\EventAdminController;
use App\Http\Controllers\Backend\OrderInformation\OrderInformationController;
use App\Http\Controllers\Backend\Product\ProductAdminController;
use App\Http\Controllers\Backend\Technology\TechnologyAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EventPageController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginSpecialController;





Route::prefix('/')->group(
    function()
    {
        Route::get('/',[HomeController::class,'indexHome']);
    }
);
Route::prefix('auth')->group(
    function()
    {
        Route::get('/',function (){
            return view('account.loginSpecial');
        });
        Route::get('/google',[LoginSpecialController::class,'redirectToGoogle']);
        Route::get('/google/callback', [LoginSpecialController::class, 'handleGoogleCallback']);
    }
);
Route::prefix('forum')->group(
    function()
    {
        Route::get('/',[ForumController::class,'index']);
    }

);
Route::prefix('payment')->group(
    function()
    {
        Route::get('/',[PaymentController::class,'index']);
        Route::get('/getDataForPayment',[PaymentController::class,'getDataForPayment']);
        Route::post('/saveInformation',[PaymentController::class,'saveInformation']);
        Route::post('/comfirmOrder',[PaymentController::class,'comfirmOrder']);
        Route::get('/loadCodeSale',[PaymentController::class,'loadCodeSale']);
        Route::get('/returnView', [PaymentController::class,'returnView']);

        // load Local in VietNam
        Route::get('/loadDistrictFromProvince',[PaymentController::class,'loadDistrictFromProvince']);
        Route::get('/loadWardFromDistrict',[PaymentController::class,'loadWardFromDistrict']);
        Route::get('/loadStreetFromDistrict',[PaymentController::class,'loadStreetFromDistrict']);
        Route::get('/loadDataBank',[PaymentController::class,'loadDataBank']);

    }
);
Route::prefix('order')->group(
    function()
    {
        Route::get('/detail',[OrderController::class,'indexOrderDetail']);
        Route::get('/cancelOrder',[OrderController::class,'cancelOrderDetail']);
        Route::get('/returnOrderDetail',[OrderController::class,'returnOrderDetail']);

        



        Route::get('/information',[OrderController::class,'indexOrderInformation']);
    }
);
Route::prefix('product')->group(
    function()
    {
        Route::get('/list',[ProductController::class,'list_product']);
        Route::get('/getDetail',[ProductController::class,'getDetailWithIdRequest']);
        Route::get('/getQuantity',[ProductController::class,'getQuantityProductWithOptCharRequest']);
        Route::get('/getPrice_Sale',[ProductController::class,'getPrice_Sale_ProductWithOptCharRequest']);
        Route::get('/getListProductExistCart',[ProductController::class,'getListProductExistCart']);
        Route::get('/getResultSearch',[ProductController::class,'getResultSearch']);
        Route::get('/product',[ProductController::class,'indexDeal']);
        Route::get('/getProducts_withFilter',[ProductController::class,'getProducts_withFilter']);


        // filter
        Route::get('/filter', [ProductController::class,'check_request_filter']);
        // brand filter 
        Route::get('/brand', [ProductController::class,'check_brand_filter']);
        Route::get('/brand/filter', [ProductController::class,'check_detail_brand_filter']);
        // comment

        Route::post('/comment', [ProductController::class,'comment_product']);
        

    }
);
Route::prefix('event')->group(
    function()
    {
        Route::get('/',[EventPageController::class,'index']);
    }

);


// cart
Route::prefix('cart')->group(
    function()
    {
        Route::post('/SaveAddCart',[CartController::class,'SaveProductCart']);
        Route::post('/SaveProductCart',[CartController::class,'UpdateProductCart']);
        Route::get('/getCountProductsCart',[CartController::class,'getCountProductsCart']);
        Route::get('/getListProductCart',[CartController::class,'getListProductCart']);
        Route::get('/getOptProductCart',[CartController::class,'getOptProductCart']);
        Route::get('/deleteProductCart',[CartController::class,'deleteProductCart']);
    }
);

// profile account
Route::prefix('account')->group(function(){
    Route::get('/profile',[AccountController::class,'index']);
    Route::get('/getInfoBasicAccount',[AccountController::class,'getInfoBasicAccount']);
    Route::get('/checkSignInEd',[AccountController::class,'handleCheckLoginEd']);
    Route::get('/signOut',[AccountController::class,'handleSignOut']);
    Route::get('/signin',[AccountController::class,'signIn']);
    Route::post('/signin',[AccountController::class,'handleSignIn']);
    Route::post('/signup',[AccountController::class,'handleSignUp']);
    Route::post('/restorePass',[AccountController::class,'RestorePass']);
    Route::post('/changePass',[AccountController::class,'changePass']);
    Route::post('/updateInfoBasicAccount',[AccountController::class,'updateInfoBasicAccount']);
    Route::post('/updateAvatarAccount',[AccountController::class,'updateAvatarAccount']);


    Route::post('/upload-file-chat', [AccountController::class, 'uploadFileChat']);
    Route::get('/load-chat', [AccountController::class, 'loadChat']);
});











// admin =============
    Route::group(array('prefix' => 'admin'), function() {
        Route::get('/', [AdminController::class, 'index']);
        Route::post('/login-admin', [AdminController::class, 'loginAdmin']);
        Route::get('/logout-admin', [AdminController::class, 'logoutAdmin']);
    });

        // admin dashboard
    Route::group(array('prefix' => 'admin/dashboard'), function() {
        Route::get('/', [AdminController::class, 'showDashboard']);
        Route::post('/comment-reply', [AdminController::class, 'eventCommentReply']);


        Route::get('/loadForum', [AdminController::class, '']);
    });
        // admin order
    Route::group(array('prefix' => 'admin/order'), function() {
        Route::get('/all-order-processing', [OrderInformationController::class, 'index']);
        Route::get('/all-order-delivery', [OrderInformationController::class, 'showOrderDelivery']);
        
        
        Route::get('/cancel-order/{id_order_infomation}', [OrderInformationController::class, 'cancelOrder']);
        Route::get('/delete-order-after/{id_order_infomation}', [OrderInformationController::class, 'cancelOrderAfter']);
        Route::get('/details-order/{id_order_infomation}', [OrderInformationController::class, 'showOrderDeteil']);

        Route::get('/confirm-delivery', [OrderInformationController::class, 'confirmDelivery']);
        Route::get('/confirm-success', [OrderInformationController::class, 'confirmSuccess']);

    });
        // admin product
    Route::group(array('prefix' => 'admin/product'), function() {
        Route::get('/all-product', [ProductAdminController::class, 'showAllProduct']);
        Route::get('/add-product', [ProductAdminController::class, 'showAddProduct']);
        Route::get('/show-update-name-brand-product/{id_product}', [ProductAdminController::class, 'showUpdateNameBrandProduct']);
        Route::get('/show-update-category-technology-product/{id_product}', [ProductAdminController::class, 'showUpdateCategoryTechnologyProduct']);
        Route::get('/show-update-image-product/{id_product}', [ProductAdminController::class, 'showImageProduct']);
        Route::get('/show-update-sub-product/{id_product}', [ProductAdminController::class, 'showSubProduct']);
        Route::get('/show-description-product/{id_product}', [ProductAdminController::class, 'showDescriptionProduct']);

        Route::post('/update-description-product', [ProductAdminController::class, 'updateDescriptionProduct']);
        Route::post('/update-sub-product', [ProductAdminController::class, 'updateSubProduct']);
        Route::post('/update-image-product', [ProductAdminController::class, 'updateImageProduct']);
        Route::post('/update-category-technology-product', [ProductAdminController::class, 'updateCategoryTechnologyProduct']);
        Route::post('/update-name-brand-product', [ProductAdminController::class, 'updateNameBrandProduct']);
        Route::get('/delete-product/{id_product}', [ProductAdminController::class, 'deleteProduct']);
        Route::post('/add-new-product', [ProductAdminController::class, 'addNewProduct']);
    });
        // admin brand
    Route::group(array('prefix' => 'admin/brand'), function() {
        Route::get('/all-brand', [BrandAdminController::class, 'showAllBrand']);
        Route::get('/add-brand', [BrandAdminController::class, 'showAddBrand']);
        Route::get('/update-brand/{id_brand_product}', [BrandAdminController::class, 'showupdateBrand']);
        Route::get('/delete-brand/{id_brand_product}', [BrandAdminController::class, 'deleteBrand']);
        Route::post('/add-new-brand', [BrandAdminController::class, 'addNewBrand']);
        Route::post('/update-new-brand', [BrandAdminController::class, 'updateNewBrand']);
    });
        // admin category
    Route::group(array('prefix' => 'admin/category'), function() {
        Route::get('/all-category', [CategoryAdminController::class, 'showAllCategory']);
        Route::get('/add-category', [CategoryAdminController::class, 'showAddCategory']);
        Route::get('/update-category/{id_category_product}', [CategoryAdminController::class, 'showUpdateCategory']);
        Route::get('/delete-category/{id_category_product}', [CategoryAdminController::class, 'deleteCategory']);
        Route::post('/add-new-category', [CategoryAdminController::class, 'addNewCategory']);
        Route::post('/update-new-category', [CategoryAdminController::class, 'updateNewCategory']);
    });
        // admin technology
    Route::group(array('prefix' => 'admin/technology'), function() {
        Route::get('/all-technology', [TechnologyAdminController::class, 'showAllTechnology']);
        Route::get('/add-technology', [TechnologyAdminController::class, 'showAddTechnology']);
        Route::get('/update-technology/{id_tech_sound_product}', [TechnologyAdminController::class, 'showUpdateTechnology']);
        Route::get('/delete-technology/{id_tech_sound_product}', [TechnologyAdminController::class, 'deleteTechnology']);
        Route::post('/add-new-technology', [TechnologyAdminController::class, 'addNewTechnology']);
        Route::post('/update-new-technology', [TechnologyAdminController::class, 'updateNewTechnology']);
    });
    // admin technology
    Route::group(array('prefix' => 'admin/bank'), function() {
        Route::get('/show-update-bank/{id_Bank}', [BankAdminController::class, 'showUpdateBank']);
        Route::post('/update-bank', [BankAdminController::class, 'updateBank']);
    });

        // admin banner brand
    Route::group(array('prefix' => 'admin/banner'), function() {
        Route::get('/show-update-banner-brand', [BannerBrandController::class, 'showUpdateBannerBrand']);
        Route::post('/update-banner-brand', [BannerBrandController::class, 'updateBannerBrand']);
    });
        // admin event
    Route::group(array('prefix' => 'admin/event'), function() {
        Route::get('/show-update-event', [EventAdminController::class, 'showUpdateEvent']);
        Route::post('/update-event', [EventAdminController::class, 'updateEvent']);
    });

        // admin chat 
    Route::group(array('prefix' => 'admin/chat'), function() {
        Route::get('/show-chat/{id_send}', [ChatAdminController::class, 'showChat']);
        
        Route::post('/save-chat', [ChatAdminController::class, 'saveChat']);
        Route::get('/load-chat/{id_send}', [ChatAdminController::class, 'loadChat']);
        Route::get('/load-chat-notification', [ChatAdminController::class, 'loadChatNotification']);
    });


// admin =============

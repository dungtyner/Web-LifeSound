<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginSpecialController;





Route::prefix('/')->group(
    function()
    {
        Route::get('/',function ()
        {
            return view('product.index',['page'=>'Home']);
        });
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
        Route::get('/comfirmOrder',[PaymentController::class,'comfirmOrder']);
    }
);
Route::prefix('order')->group(
    function()
    {
        Route::get('/detail',[OrderController::class,'indexOrderDetail']);
    }
);
Route::prefix('order')->group(
    function()
    {
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
        Route::get('/deal',[ProductController::class,'indexDeal']);
        Route::get('/getProducts_withFilter',[ProductController::class,'getProducts_withFilter']);
    }
);
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
});
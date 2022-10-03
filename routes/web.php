<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::prefix('/')->group(
    function()
    {
        Route::get('/',function ()
        {
            return view('index');
        });
        Route::get('/home',function ()
        {
            return view('index');
        });
        Route::get('/trang-chu',function ()
        {
            return view('index');
        });
    }
);

Route::prefix('product')->group(
    function()
    {
        Route::get('/list',[ProductController::class,'list_product']);
        Route::get('/getDetail',[ProductController::class,'getDetailWithIdRequest']);
        Route::get('/getQuantity',[ProductController::class,'getQuantityProductWithOptCharRequest']);
        Route::get('/getPrice_Sale',[ProductController::class,'getPrice_Sale_ProductWithOptCharRequest']);
        Route::get('/test',function ()
        {
            return view('productDetail');
        });
    }
);
Route::prefix('cart')->group(
function()
{
    Route::post('/SaveAddCart',[CartController::class,'SaveProductCart']);
    Route::get('/getCountProductsCart',[CartController::class,'getCountProductsCart']);
    Route::get('/getListProductCart',[CartController::class,'getListProductCart']);

}
);



Route::prefix('account')->group(function(){
    Route::get('/',[AccountController::class,'index']);
    Route::get('/checkSignInEd',[AccountController::class,'handleCheckLoginEd']);
    Route::get('/signOut',[AccountController::class,'handleSignOut']);
    Route::get('/signin',[AccountController::class,'signIn']);
    Route::post('/signin',[AccountController::class,'handleSignIn']);
    Route::post('/signup',[AccountController::class,'handleSignUp']);
    Route::post('/restorePass',[AccountController::class,'RestorePass']);
    Route::post('/changePass',[AccountController::class,'changePass']);

});
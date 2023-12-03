<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DasboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::controller(AuthController::class)->group(function(){
    Route::get('/login-admin', 'login')->name('login');
    Route::get('/registrasi-admin', 'regist')->name('regist');
    Route::post('/post-login-admin', 'postlogin')->name('post-login');
    Route::post('/post-regist-admin', 'pushRegist')->name('post-regist');
    Route::get('/logout-admin', 'logoutAdmin')->name('logout_admin');
    Route::get('/login', 'LoginUser')->name('login-user');
    Route::get('register', 'Registrasi')->name('Regist-user');
    Route::post('post-login', 'PostLoginUser')->name('Post_login');
    Route::post('post-regist', 'PostRegistUser')->name('Post_regist');
    Route::get('logout', 'logoutUser')->name('logout-user');

});


Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'home')->name('Home');
    Route::get('all-product', 'allProduct')->name('all_product');
    Route::get('category-product/{slug}', 'categoryProduct')->name('product_cat');
    Route::get('Detail-product/{slug}', 'DetailPro')->name('detail_product');
});

Route::controller(CartController::class)->group(function(){
    Route::get('detail-cart', 'detailCart')->name('cart');
    Route::post('add-to-cart', 'addtoCart')->name('AddToCart');
    Route::post('delete-item-cart', 'deleteCart')->name('delete-itm-cart');
    Route::post('cekout-cart', 'cekout')->name('cekout');
});

Route::middleware(['user'])->group(function(){
    Route::controller(ProfileUserController::class)->group(function(){
        Route::get('profile', 'profile')->name('user_profile');
        Route::post('update-profile/{id}', 'updateProfile')->name('updateProfile');
    });
});


Route::middleware(['admins'])->group(function () {
    Route::controller(DasboardAdminController::class)->group(function(){
        Route::get('/dashboard', 'Dasboard')->name('dasboard');
    });

    Route::controller(KategoriController::class)->group(function(){
        Route::get('data-kategori', 'indexKategori')->name('data_kategori');
        Route::get('create-Kategori', 'createKatgeori')->name('create_kategori');
        Route::get('edit-kategori/{id}', 'editData')->name('editkategori');
        Route::post('post-data-kategori', 'postCreate')->name('post_kategori');
        Route::put('post-edit-data-kategori/{id}', 'UpdateData')->name('update_kategori');
        Route::get('hapus-data-kategori/{id}', 'deleteData')->name('delete_kategori');
    });

    Route::resource('product', ProductController::class);
    Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('delete-product');

    Route::get('data-order', [OrderController::class, 'DataOrders'])->name('data-order');

    Route::controller(OrderController::class)->group(function(){
        Route::get('data-order', 'DataOrders')->name('data-order');
        Route::get('detail-order/{id}', 'DetailsOrder')->name('detail-order');
        Route::post('accept-order/{id}', 'AcceptOrder')->name('AcceptOrder');
        Route::post('finish-order/{id}', 'Finish')->name('Finish');
        Route::delete('delete-order/{id}', 'deleteOrder')->name('delete_order');
        Route::get('invoice-order/{id}', 'invoiceOrder')->name('Invoice');
    });
});



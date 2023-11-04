<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DasboardAdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'login')->name('login');
    Route::get('/registrasi', 'regist')->name('regist');
    Route::post('/post-login', 'postlogin')->name('post-login');
    Route::post('/post-regist', 'pushRegist')->name('post-regist');
    Route::get('/logout', 'logoutAdmin')->name('logout_admin');
});


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


<?php

use App\Http\Controllers\ChangeLangController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('home',function(){
    return view('admin.home');
});
Route::get('home',[HomeController::class, 'index']);
Route::get('home',[UserProductController::class, 'index']);
Route::get('changeLang/{Lang}',[ChangeLangController::class, 'index']);

Route::middleware(['auth' ,'IsAdmin'])->group(function(){

    Route::controller(ProductController::class)->group(function(){

        Route::get('products','index')->name('products');
        Route::get('product','create')->name('createProduct');
        Route::post('product','store')->name('addProduct');
        Route::get('editProduct/{id}','edit')->name('editProduct');
        Route::get('ShowProduct/{id}','show')->name('ShowProduct');
    Route::put('updateProduct/{id}','update')->name('updateProduct');
    Route::delete('deleteProduct/{id}','destroy')->name('deleteProduct');



});

});

Route::controller(UserProductController::class)->group(function(){

    Route::get('userProducts','index');
    Route::get('ShowProduct/{id}','show');





});









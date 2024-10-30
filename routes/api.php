<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::middleware('ApiAuth')->group(function(){

    Route::controller(ApiProductController::class)->group(function(){

        Route::get('products','index')->name('products');
        Route::get('product','create')->name('createProduct');
        Route::post('product','store');
        Route::put('updateProduct/{id}','update')->name('updateProduct');
        Route::delete('deleteProduct/{id}','delete')->name('deleteProduct');
        Route::get('show/{id}','show');
    });



});
Route::post('register',[AuthController::class,'register' ]);
Route::post('login',[AuthController::class,'login' ]);

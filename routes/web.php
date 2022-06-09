<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function(){
     Route::resource('/category', CategoryController::class);
     Route::resource('/product', ProductController::class);
});
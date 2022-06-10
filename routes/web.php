<?php


use Illuminate\Support\Facades\Route;

Route::get("admin/login", [App\Http\Controllers\Admin\AuthController::class, 'showLogin']);
Route::post("admin/login", [App\Http\Controllers\Admin\AuthController::class, 'postLogin']);
Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function(){
     Route::get('/dashboard', [App\Http\Controllers\Admin\AuthController::class, "dashboard"]);
     Route::resource('/category', CategoryController::class);
     Route::resource('/product', ProductController::class);
});
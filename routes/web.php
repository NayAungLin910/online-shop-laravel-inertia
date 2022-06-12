<?php

use Illuminate\Support\Facades\Route;

// User Auth
Route::get("/login", [App\Http\Controllers\AuthController::class, "showLogin"]);
Route::post("/login", [App\Http\Controllers\AuthController::class, "postLogin"]);

Route::get("/register", [App\Http\Controllers\AuthController::class, "showRegister"]);
Route::post("/register", [App\Http\Controllers\AuthController::class, "postRegister"]);

// User
Route::get("/", [App\Http\Controllers\PageController::class, "index"]); 
Route::get("product/{slug}", [App\Http\Controllers\PageController::class, "productDetail"]);
Route::get("product/category/{slug}", [App\Http\Controllers\PageController::class, "productByCategory"],);
Route::get("product/search/{search}", [App\Http\Controllers\PageController::class, "searchProduct"],);

// Admin
Route::get("admin/login", [App\Http\Controllers\Admin\AuthController::class, 'showLogin']);
Route::post("admin/login", [App\Http\Controllers\Admin\AuthController::class, 'postLogin']);
Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function(){
     Route::get('/dashboard', [App\Http\Controllers\Admin\AuthController::class, "dashboard"]);
     Route::resource('/category', CategoryController::class);
     Route::resource('/product', ProductController::class);
});

Route::get("/logout", [App\Http\Controllers\AuthController::class, "logout"]);
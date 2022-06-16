<?php

use Illuminate\Support\Facades\Route;

// User Auth
Route::get("/login", [App\Http\Controllers\AuthController::class, "showLogin"]);
Route::post("/login", [App\Http\Controllers\AuthController::class, "postLogin"]);

Route::get("/register", [App\Http\Controllers\AuthController::class, "showRegister"]);
Route::post("/register", [App\Http\Controllers\AuthController::class, "postRegister"]);

// User
Route::get("/", [App\Http\Controllers\PageController::class, "index"])->name("user_index"); 
Route::get("product/{slug}", [App\Http\Controllers\PageController::class, "productDetail"]);
Route::get("product/category/{slug}", [App\Http\Controllers\PageController::class, "productByCategory"],);
Route::get("product/search/{search}", [App\Http\Controllers\PageController::class, "searchProduct"],);

// User Auth Route
Route::middleware(["AuthUser"])->group(function(){
     Route::get("add/cart/{id}", [App\Http\Controllers\PageController::class, "addToCart"]);
     Route::get("/cart", [App\Http\Controllers\PageController::class, "viewCart"]);
     Route::get("/checkout", [App\Http\Controllers\PageController::class, "viewCheckOut"]);
     Route::post("/checkout", [App\Http\Controllers\PageController::class, "checkOut"]);
     Route::get("/order/pending", [\App\Http\Controllers\OrderController::class, "pending"]);
     Route::get("/order/complete", [\App\Http\Controllers\OrderController::class, "complete"]);
     Route::get("/profile", [\App\Http\Controllers\PageController::class, "showProfile"]);
     Route::post("/profile", [\App\Http\Controllers\PageController::class, "updateProfile"]);
});



// Admin
Route::get("admin/login", [App\Http\Controllers\Admin\AuthController::class, 'showLogin']);
Route::post("admin/login", [App\Http\Controllers\Admin\AuthController::class, 'postLogin']);
Route::middleware(['Admin'])->prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function(){
     Route::get('/dashboard', [App\Http\Controllers\Admin\AuthController::class, "dashboard"]);
     Route::resource('/category', CategoryController::class);
     Route::resource('/product', ProductController::class);
     Route::get("/order/pending", [\App\Http\Controllers\Admin\ProductController::class, "pendingOrder"]);
     Route::get("/order/success", [\App\Http\Controllers\Admin\ProductController::class, "successOrder"]);
     Route::get("/order/success/{start_date}/{end_date}", [\App\Http\Controllers\Admin\ProductController::class, "successOrderByDate"]);
     Route::get("/order/success/{id}", [\App\Http\Controllers\Admin\ProductController::class, "makeSuccess"]);
     Route::get("/order/success/{start_date}/{end_date}/{id}", [\App\Http\Controllers\Admin\ProductController::class, "makeSuccessByDate"]);
     Route::get("/order/pending/{start_date}/{end_date}", [\App\Http\Controllers\Admin\ProductController::class, "pendingOrderByDate"]);
});

Route::get("/logout", [App\Http\Controllers\AuthController::class, "logout"]);
<?php

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
Auth::routes();
Route::get('/', [\App\Http\Controllers\HomeController::class,"home"]);
Route::get('/category/{category:slug}', [\App\Http\Controllers\HomeController::class,"category"]);
Route::get("about-us",[\App\Http\Controllers\HomeController::class,"aboutUs"]);
Route::get('/detail/{product:slug}', [\App\Http\Controllers\HomeController::class,"product"]);
Route::middleware("auth")->group(function (){

Route::get('/add-to-cart/{product}', [\App\Http\Controllers\HomeController::class,"addToCart"]);
Route::get('/cart', [\App\Http\Controllers\HomeController::class,"cart"])->name('cart');
Route::get('/remove-from-cart/{product}', [\App\Http\Controllers\HomeController::class, "removeFromCart"]);
Route::post('/update-cart/{product}', [\App\Http\Controllers\HomeController::class, "updateCart"]);
Route::get('/clear-cart', [\App\Http\Controllers\HomeController::class, "clearCart"])->name('clearCart');

Route::get('/checkout', [\App\Http\Controllers\HomeController::class, "checkout"])->name('checkout');
Route::post('/checkout', [\App\Http\Controllers\HomeController::class, "placeOrder"])->name('placeOrder');
Route::get('/thank-you/{order}', [\App\Http\Controllers\HomeController::class,"thankYou"]);
Route::get('/paypal-success/{order}', [\App\Http\Controllers\HomeController::class,"paypalSuccess"]);
Route::get('/paypal-cancel/{order}', [\App\Http\Controllers\HomeController::class,"paypalCancel"]);

});

Route::middleware(["auth","is_admin"])->prefix("admin")->group(function () {
    include_once "admin.php";
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


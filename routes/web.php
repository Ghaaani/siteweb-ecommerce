<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\checkoutController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\aboutController;
use App\Http\Controllers\about_usController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\product_categoryController;

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

Route::redirect('/', '/index');

// Admin login / logout
Route::get('/login', [AdminLoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [AdminLoginController::class, 'store'])->middleware(['guest', 'throttle:5,1']);
Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout')->middleware('auth');

// Admin area: requires a logged-in admin
Route::middleware('auth')->group(function () {
    Route::resource('/product_categories' , product_categoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/aboutus', about_usController::class);
});

// Public shop pages (only the pages that actually exist)
Route::resource('/about', aboutController::class)->only('index');
Route::resource('/cart', cartController::class)->only('index');
Route::resource('/contact', contactController::class)->only('index');
Route::resource('/checkout', checkoutController::class)->only('index');

Route::get('/index', [indexController::class,'index']);
Route::get('/shop', [shopController::class,'index']);
Route::get('/cart', [cartController::class,'index']);

Route::get('get-products-by-category/{categoryId}', [shopController::class, 'getProductsByCategory']);
Route::get('insert-Poduct/{productId}', [shopController::class, 'inserProduct']);

Route::get('remove-product/{id}', [indexController::class, 'removeProduct']);

Route::get('inc-quantity/{pId}', [cartController::class, 'incQuantity']);


Route::get('/wishlist', function () {
    return view('wishlist');
});

Route::get('/single_product', function () {
    return view('single-product');
});

Route::get('/single_blog', function () {
    return view('single-blog');
});


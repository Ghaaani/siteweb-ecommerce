<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\checkoutController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\aboutController;
use App\Http\Controllers\about_usController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\shopController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/product_categories' , product_categoryController::class);
Route::resource('/products', ProductController::class);
Route::resource('/aboutus', about_usController::class);
Route::resource('/about', aboutController::class);
Route::resource('/cart', cartController::class);
Route::resource('/contact', contactController::class);
Route::resource('/checkout', checkoutController::class);

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


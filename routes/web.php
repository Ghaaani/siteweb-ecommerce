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
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\product_categoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will be
| assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/index');

// Login / logout (customers and administrators)
Route::get('/login', [AdminLoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [AdminLoginController::class, 'store'])->middleware(['guest', 'throttle:5,1']);
Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout')->middleware('auth');

// Customer registration
Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware(['guest', 'throttle:5,1']);

// Customer account area
Route::get('/account', [AccountController::class, 'index'])->name('account')->middleware('auth');

// Admin area: requires a logged-in admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/product_categories', product_categoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/aboutus', about_usController::class);
    Route::resource('/orders', OrderController::class)->only(['index', 'show', 'update']);
});

// Public shop pages (only the pages that actually exist)
Route::resource('/about', aboutController::class)->only('index');
Route::resource('/cart', cartController::class)->only('index');
Route::resource('/contact', contactController::class)->only('index');
Route::resource('/checkout', checkoutController::class)->only('index');

Route::get('/index', [indexController::class, 'index']);
Route::get('/shop', [shopController::class, 'index']);
Route::get('/cart', [cartController::class, 'index']);

// Cart actions (AJAX)
Route::get('get-products-by-category/{categoryId}', [shopController::class, 'getProductsByCategory']);
Route::get('insert-Poduct/{productId}', [shopController::class, 'inserProduct']);
Route::get('remove-product/{id}', [indexController::class, 'removeProduct']);
Route::get('/inc-quantity/{pId}', [cartController::class, 'incQuantity']);
Route::post('/update-product-quantity/{id}', [cartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{id}', [cartController::class, 'destroy'])->name('cart.remove');

// Checkout flow
Route::post('/checkout', [checkoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/{id}/payment', [checkoutController::class, 'payment'])->whereNumber('id')->name('checkout.payment');
Route::post('/checkout/{id}/payment/card', [checkoutController::class, 'createCardPayment'])->whereNumber('id')->name('checkout.card');
Route::post('/checkout/{id}/payment/paypal', [checkoutController::class, 'createPaypalOrder'])->whereNumber('id')->name('checkout.paypal');
Route::get('/checkout/success/{id}', [checkoutController::class, 'success'])->whereNumber('id')->name('checkout.success');
Route::post('/checkout/{id}/paid', [checkoutController::class, 'markPaid'])->whereNumber('id')->name('checkout.paid');
Route::get('/paypal/return', [checkoutController::class, 'paypalReturn'])->name('paypal.return');

// Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->whereNumber('productId')->name('wishlist.toggle');

Route::get('/single_product/{id?}', [shopController::class, 'singleProduct'])->name('single_product');

Route::get('/single_blog', function () {
    return view('single-blog');
});

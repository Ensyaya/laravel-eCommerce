<?php

use App\Http\Controllers\admin\AdminOrderController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\cart\CartController;
use App\Http\Controllers\main\PageController;
use App\Http\Controllers\order\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\question\ProductQuestionController;
use App\Http\Controllers\question\ProductRatingController;
use App\Http\Controllers\question\ProductRepliesController;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('products');
});

Route::middleware(['auth', 'isAdmin', 'isActiveDisc', 'isQuantity'])->prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
});
Route::middleware(['auth', 'isAdmin', 'isActiveDisc', 'isQuantity'])->prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth', 'isAdmin', 'isActiveDisc', 'isQuantity'])->prefix('admin')->group(function () {
    Route::get('order', [AdminOrderController::class, 'index'])->name('admin-order.index');
    Route::post('order/{id}', [AdminOrderController::class, 'update'])->name('admin-order.update');

    Route::post('product-reply/{id}', [ProductRepliesController::class, 'create'])->name('product-replies.create');
    Route::delete('product-question/{id}', [ProductQuestionController::class, 'destroy'])->name('product-question.destroy');
    Route::delete('product-rating/{id}', [ProductRatingController::class, 'destroy'])->name('product-rating.destroy');
    Route::delete('product-reply/{id}', [ProductRepliesController::class, 'destroy'])->name('product-reply.destroy');

    Route::get('product/{id}/ratings', [ProductRatingController::class, 'index'])->name('product-rating.index');
    Route::get('product/{id}/questions', [ProductQuestionController::class, 'index'])->name('product-question.index');
});

Route::middleware(['isActiveDisc', 'auth', 'isQuantity'])->group(function () {
    Route::get('products', [PageController::class, 'products'])->name('products');
    Route::get('products/{slug}', [PageController::class, 'product_detail'])->name('product.detail');

    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/{id}', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::delete('cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
    Route::post('cart/decrement/{id}', [CartController::class, 'removeCartItemOne'])->name('cart.removeCartItemOne');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::post('order/{id}', [OrderController::class, 'create'])->name('order.create');

    Route::post('product-question/{id}', [ProductQuestionController::class, 'create'])->name('product-question.create');
    Route::post('product-rating/{id}', [ProductRatingController::class, 'create'])->name('product-rating.create');
});




require __DIR__ . '/auth.php';

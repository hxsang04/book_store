<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PublisherController;

use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;

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

//Admin
Route::prefix('admin')->group(function () {
    //Author
    Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/author/create', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/author/edit/{author}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::post('/author/edit/{author}', [AuthorController::class, 'update'])->name('author.update');
    Route::delete('/author/delete/{author}', [AuthorController::class, 'destroy'])->name('author.destroy');

    //Publisher
    Route::get('/publisher', [PublisherController::class, 'index'])->name('publisher.index');
    Route::get('/publisher/create', [PublisherController::class, 'create'])->name('publisher.create');
    Route::post('/publisher/create', [PublisherController::class, 'store'])->name('publisher.store');
    Route::get('/publisher/edit/{publisher}', [PublisherController::class, 'edit'])->name('publisher.edit');
    Route::post('/publisher/edit/{publisher}', [PublisherController::class, 'update'])->name('publisher.update');
    Route::delete('/publisher/delete/{publisher}', [PublisherController::class, 'destroy'])->name('publisher.destroy');

    //Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/edit/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    //Product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'index'])->name('product.search');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/edit/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/show/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::delete('/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::get('/admin/dashboard', function () {
    return view('admin.index');
});


//Frontend

Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/cua-hang', [ShopController::class, 'shop'])->name('shop');
Route::get('/danh-muc/{category}', [ShopController::class, 'getProductByCategory'])->name('category');
Route::get('/san-pham/{product}', [ShopController::class, 'product'])->name('product');

Route::get('/gio-hang', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/increase/{product_id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('/cart/decrease/{product_id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/delete/{product_id}', [CartController::class, 'delete'])->name('cart.delete');


Route::get('/dat-hang', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkoutPost');
Route::get('/checkout/vnPayCheck', [CheckoutController::class, 'vnPayCheck'])->name('checkout.vnpay');
Route::get('/dat-hang/thanh-cong', [CheckoutController::class, 'notification'])->name('checkout.success');
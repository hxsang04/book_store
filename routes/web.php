<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostTypeController;
use App\Http\Controllers\Admin\PostController;

use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AuthUserController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\FavoriteController;

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
    //Auth
    Route::get('/login', [AuthController::class, 'login'])->middleware(['guest:admin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'loginPost'])->middleware(['guest:admin'])->name('admin.loginPost');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'] )->name('admin.dashboard');

        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/change-password', [AuthController::class, 'password'])->name('admin.password');
        Route::post('/change-password', [AuthController::class, 'changePassword'])->name('admin.change-password');

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

        //Order
        Route::get('/order', [OrderController::class, 'index'])->name('order.index');
        Route::get('/order/show/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::get('/order/confirm/{order}', [OrderController::class, 'confirm'])->name('order.confirm');

        //User
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/{user}', [UserController::class, 'handleStatus'])->name('user.status');
        Route::get('/user/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');

        //Staff
        Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/staff/create', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/staff/destroy/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');

        //Post Type
        Route::get('/post_type', [PostTypeController::class, 'index'])->name('post_type.index');
        Route::get('/post_type/create', [PostTypeController::class, 'create'])->name('post_type.create');
        Route::post('/post_type/create', [PostTypeController::class, 'store'])->name('post_type.store');
        Route::get('/post_type/edit/{post_type}', [PostTypeController::class, 'edit'])->name('post_type.edit');
        Route::post('/post_type/edit/{post_type}', [PostTypeController::class, 'update'])->name('post_type.update');
        Route::delete('/post_type/delete/{post_type}', [PostTypeController::class, 'destroy'])->name('post_type.destroy');

        //Post
        Route::get('/post', [PostController::class, 'index'])->name('post.index');
        Route::post('/post', [PostController::class, 'index'])->name('post.search');
        Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
        Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/post/edit/{post}', [PostController::class, 'update'])->name('post.update');
        Route::get('/post/show/{post}', [PostController::class, 'show'])->name('post.show');
        Route::delete('/post/delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    });
    
});

//Frontend

Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/cua-hang', [ShopController::class, 'shop'])->name('shop');
Route::get('/danh-muc/{category}', [ShopController::class, 'getProductByCategory'])->name('category');
Route::get('/san-pham/{product}', [ShopController::class, 'product'])->name('product');
Route::get('/lien-he', [ShopController::class, 'contact'])->name('contact');

Route::get('/gio-hang', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/increase/{product_id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('/cart/decrease/{product_id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/delete/{product_id}', [CartController::class, 'delete'])->name('cart.delete');

Route::middleware(['guest:web'])->group(function () {
    Route::get('/dang-nhap', [AuthUserController::class, 'login'])->name('login');
    Route::post('/dang-nhap', [AuthUserController::class, 'loginPost'])->name('loginPost');
    Route::get('/dang-ky', [AuthUserController::class, 'register'])->name('register');
    Route::post('/dang-ky', [AuthUserController::class, 'registerPost'])->name('registerPost');

    Route::get('/forgot-password', [AuthUserController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthUserController::class, 'forgotPasswordPost'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthUserController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthUserController::class, 'resetPasswordPost'])->name('password.update');
});


Route::middleware(['auth:web'])->group(function () {
    Route::get('/dang-xuat', [AuthUserController::class, 'logout'])->name('logout');

    Route::get('/yeu-thich', [FavoriteController::class, 'index'])->name('favorite');
    Route::get('/yeu-thich/{product}', [FavoriteController::class, 'add'])->name('favorite.add');
    Route::get('/yeu-thich/delete/{product_id}', [FavoriteController::class, 'delete'])->name('favorite.delete');
    
    Route::get('/dat-hang', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkoutPost');
    Route::get('/checkout/vnPayCheck', [CheckoutController::class, 'vnPayCheck'])->name('checkout.vnpay');
    Route::get('/dat-hang/thanh-cong', [CheckoutController::class, 'notification'])->name('checkout.success');

    Route::get('/tai-khoan', [AccountController::class, 'account'])->name('account');
    Route::post('/tai-khoan', [AccountController::class, 'updateAccount'])->name('account.update');

    Route::get('/lich-su-don-hang', [AccountController::class, 'orderHistory'])->name('account.orderHistory');
    Route::get('/chi-tiet-don-hang/{order}', [AccountController::class, 'orderDetail'])->name('order.detail');
    Route::post('/order-history/cancel/{order}', [AccountController::class, 'cancel'])->name('order.cancel');
    Route::post('/order-history/receive/{order}', [AccountController::class, 'receive'])->name('order.receive');
    Route::post('/order-history/return/{order}', [AccountController::class, 'return'])->name('order.return');

    Route::get('/doi-mat-khau', [AccountController::class, 'changePassword'])->name('account.change-password');
    Route::post('/doi-mat-khau', [AccountController::class, 'updatePassword'])->name('account.update-password');

});
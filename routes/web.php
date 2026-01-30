<?php

use Illuminate\Support\Facades\Route;

// --- CONTROLLERS KHÁCH HÀNG ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

// --- CONTROLLERS QUẢN TRỊ (ADMIN) ---
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// --- CONTROLLER NHÂN VIÊN (STAFF) ---
use App\Http\Controllers\Staff\OrderController as StaffOrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================================================
// 1. NHÓM ROUTE CÔNG KHAI
// =========================================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tin-tuc', [HomeController::class, 'news'])->name('news');
Route::get('/tin-tuc/{id}', [HomeController::class, 'newsDetail'])->name('news.detail');
Route::get('/dia-chi', [HomeController::class, 'address'])->name('address');
Route::get('/khuyen-mai', [HomeController::class, 'promotions'])->name('promotions');

// Sản phẩm (Khách xem)
Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
Route::get('/san-pham/tim-kiem', [ProductController::class, 'search'])->name('products.search');
Route::get('/san-pham/{id}', [ProductController::class, 'show'])->name('products.show');

// Xác thực (Đăng nhập/Đăng ký)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =========================================================
// 2. NHÓM ROUTE KHÁCH HÀNG (ĐÃ ĐĂNG NHẬP)
// =========================================================
Route::middleware(['auth'])->group(function () {

    // Giỏ hàng
    Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/gio-hang/them/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/gio-hang/xoa/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Đặt hàng
    Route::get('/thanh-toan', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/thanh-toan', [OrderController::class, 'store'])->name('order.store');

    // Xử lý mã giảm giá
    Route::post('/gio-hang/ma-giam-gia', [CartController::class, 'applyCoupon'])->name('cart.coupon');
    Route::get('/gio-hang/xoa-ma', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');

    // Đon hàng
    Route::get('/lich-su-don-hang', [App\Http\Controllers\OrderController::class, 'history'])->name('orders.history');
    Route::post('/don-hang/huy/{id}', [App\Http\Controllers\OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/don-hang/sua/{id}', [App\Http\Controllers\OrderController::class, 'editOrder'])->name('orders.edit');
    Route::post('/don-hang/da-nhan/{id}', [App\Http\Controllers\OrderController::class, 'confirmReceived'])->name('orders.received');
    // Trang cá nhân
    Route::get('/ca-nhan', [UserController::class, 'profile'])->name('profile');
    Route::post('/ca-nhan', [UserController::class, 'updateProfile']);
    Route::get('/ca-nhan/xoa-avatar', [UserController::class, 'removeAvatar'])->name('avatar.remove');
    Route::get('/lich-su-don-hang', [OrderController::class, 'history'])->name('orders.history');
    Route::get('/doi-mat-khau', [UserController::class, 'showChangePassword'])->name('password.change');
});


// =========================================================
// 3. NHÓM ROUTE ADMIN (CHỦ QUÁN)
// =========================================================
Route::middleware(['auth', 'CheckRole:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- QUẢN LÝ SẢN PHẨM ---
    Route::resource('products', AdminProductController::class);

    // --- QUẢN LÝ NHÂN VIÊN ---
    Route::resource('staff', StaffController::class);

    // --- QUẢN LÝ KHÁCH HÀNG ---
    Route::resource('customers', CustomerController::class);

    // --- QUẢN LÝ TIN TỨC ---
    Route::resource('news', AdminNewsController::class);

    // --- QUẢN LÝ KHUYẾN MÃI ---
    Route::resource('promotions', AdminPromotionController::class);

    // --- QUẢN LÝ ĐƠN HÀNG ---
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('orders/update/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update');
    Route::get('orders/print/{id}', [AdminOrderController::class, 'printOrder'])->name('orders.print');

    // --- ĐỔI AVATA ----
    Route::get('/doi-avatar', [App\Http\Controllers\Admin\ProfileController::class, 'changeAvatar'])->name('avatar.edit');
    Route::post('/doi-avatar', [App\Http\Controllers\Admin\ProfileController::class, 'updateAvatar'])->name('avatar.update');
});


// =========================================================
// 4. NHÓM ROUTE STAFF (NHÂN VIÊN)
// =========================================================
Route::middleware(['auth'])->prefix('staff')->group(function () {
    // Trang quản lý đơn hàng của nhân viên
    Route::get('/dashboard', [App\Http\Controllers\StaffOrderController::class, 'index'])->name('staff.orders.index');

    // Xử lý hành động: Nhận đơn & Giao đơn
    Route::post('/order/update/{id}', [App\Http\Controllers\StaffOrderController::class, 'updateStatus'])->name('staff.orders.update');

    // Xem lịch sử các đơn đã hoàn thành
    Route::get('/history', [App\Http\Controllers\StaffOrderController::class, 'history'])->name('staff.orders.history');
});

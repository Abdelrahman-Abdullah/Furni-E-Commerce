<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{BlogController,
    CartController,
    ContactController,
    CouponController,
    HomePageController,
    PaymentController,
    ProductController,
    ResetPassword,
    ServiceController,
    UserRegisterController,
    UserSessionController};

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
#region Public Routes
Route::get('/', HomePageController::class)->name('home');
Route::view('about', 'Front.about-us')->name('about');
Route::get('services', ServiceController::class)->name('services');

Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});
#endregion

#region Contact Routes
Route::controller(ContactController::class)->name('contact.')->group(function () {
    Route::get('contact', 'create')->name('create');
    Route::post('contact', 'store');
});

#endregion

#region User Routes
Route::prefix('users')->name('users.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/register', [UserRegisterController::class, 'create'])->name('register');
        Route::post('/register', [UserRegisterController::class, 'store'])->name('store');
        Route::get('/login', [UserSessionController::class, 'create'])->name('login');
        Route::post('/login', [UserSessionController::class, 'store']);
        Route::get('/forget-password', [ResetPassword::class, 'index'])->name('forget-password');
    });
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [UserSessionController::class, 'destroy'])->name('logout');
    });
});
#endregion
#region Product Routes
Route::prefix('products')->name('products.')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('index');
    Route::get('/{name}', [ProductController::class, 'show'])->name('show');
});
#endregion
#region Cart Routes
Route::prefix('cart')->middleware('auth')->name('cart.')->controller(CartController::class)->group(function () {

    Route::get('', 'index')->name('index');
    Route::post('add/{id}', 'store')->name('store');
    Route::post('update/{id}', 'update')->name('update');
    Route::delete('remove/{id}', 'destroy')->name('destroy');
});
#endregion

#region Coupon Routes
Route::post('discount', [CouponController::class, 'checkCoupon'])
    ->middleware('auth')
    ->name('coupon.check');
#endregion

#region Payment Routes
Route::controller(PaymentController::class)
    ->prefix('payment')->name('payment.')->group(function () {

        Route::post('checkout', 'pay')->middleware('auth')->name('checkout');
        Route::post('callback', 'callback')->name('callback');
        Route::get('success', 'success')->name('success');
    });
#endregion

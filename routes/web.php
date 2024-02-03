<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{BlogController,
    ContactController,
    HomePageController,
    ProductController,
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
    Route::get('', [BlogController::class,'index'])->name('index');
    Route::get('/{slug}', [BlogController::class,'show'])->name('show');
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
        Route::get('/register', [UserRegisterController::class,'create'])->name('register');
        Route::post('/register', [UserRegisterController::class,'store'])->name('store');
        Route::get('/login', [UserSessionController::class,'create'])->name('login');
        Route::post('/login', [UserSessionController::class,'store']);
    });
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [UserSessionController::class,'destroy'])->name('logout');
    });
});
#endregion
#region Product Routes
Route::prefix('products')->name('products.')->group(function () {
    Route::get('', [ProductController::class,'index'])->name('index');
    Route::get('/{name}', [ProductController::class,'show'])->name('show');
});
#endregion

<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomePageController,
    ProductController,
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
Route::get('/', HomePageController::class)->name('home');
Route::prefix('products')->name('products.')->group(function () {
    Route::get('', [ProductController::class,'index'])->name('index');
    Route::get('/{name}', [ProductController::class,'show'])->name('show');
});

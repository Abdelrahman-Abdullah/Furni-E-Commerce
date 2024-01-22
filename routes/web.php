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
});
Route::get('/', HomePageController::class)->name('home');
Route::get('/products', ProductController::class)->name('products.index');

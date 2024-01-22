<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomePageController,
    ProductController,
    UserRegisterController
};
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
        Route::view('/login', 'Front.users.login')->name('login');
    });
});
Route::get('/', HomePageController::class)->name('home');
Route::get('/products', ProductController::class)->name('products.index');

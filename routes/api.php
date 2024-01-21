<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    UserRegisterController,
    UserSessionController,
    ProductController
};


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('users')->name('users.')->group(function () {
    Route::post('register', UserRegisterController::class)->name('register');
    Route::post('login', [UserSessionController::class, 'login'])->name('login');
});
Route::prefix('products')->name('products.')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('index');
});

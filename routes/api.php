<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});
Route::prefix('products')->name('products.')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('index');
});

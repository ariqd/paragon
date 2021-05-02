<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\VisiMisiController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/keranjang', [CartController::class, 'index']);
    Route::get('/pesanan-saya', [OrdersController::class, 'index']);
    Route::get('/tentang', [AboutController::class, 'index']);
    Route::get('/visi-misi', [VisiMisiController::class, 'index']);
});

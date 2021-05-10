<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\VisiMisiController;

use App\Http\Controllers\Admin\ProductsController as AdminProductsController;
use App\Http\Controllers\Admin\OrdersController as AdminOrdersController;
use App\Http\Controllers\Admin\LogsController as AdminLogsController;

require __DIR__ . '/auth.php';
require __DIR__ . '/auth-admin.php';

Route::group(['middleware' => ['auth', 'isUser']], function () {

    Route::name('products.')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/products/{product}', [HomeController::class, 'show'])->name('show');
    });

    Route::get('/keranjang', [CartController::class, 'index']);
    Route::get('/pesanan-saya', [OrdersController::class, 'index']);
    Route::get('/tentang', [AboutController::class, 'index']);
    Route::get('/visi-misi', [VisiMisiController::class, 'index']);
});

Route::group([
    'middleware' => ['auth:admin', 'isAdmin'],
    'prefix' => 'admin'
], function () {
    Route::name('admin.')->group(function () {
        Route::resource('products', AdminProductsController::class);
        Route::resource('orders', AdminOrdersController::class);
        Route::resource('logs', AdminLogsController::class);
    });
});

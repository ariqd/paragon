<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// TAMPILAN REGISTER
Route::get('/register-admin', [RegisteredUserController::class, 'createAdmin'])
    ->middleware(['guest', 'guest:admin'])
    ->name('register-admin');

// SUBMIT REGISTER
Route::post('/register-admin', [RegisteredUserController::class, 'storeAdmin'])
    ->middleware(['guest', 'guest:admin']);

// TAMPILAN LOGIN
Route::get('/login-admin', [AuthenticatedSessionController::class, 'createAdmin'])
    ->middleware(['guest', 'guest:admin'])
    ->name('login-admin');

// SUBMIT LOGIN
Route::post('/login-admin', [AuthenticatedSessionController::class, 'storeAdmin'])
    ->middleware(['guest', 'guest:admin']);

// LOGOUT
Route::post('/logout-admin', [AuthenticatedSessionController::class, 'destroyAdmin'])
    ->middleware('auth:admin')
    ->name('logout-admin');

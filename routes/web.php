<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'registerWeb']);

Route::get('/login', function () {
    return view('login'); 
})->name('login');

Route::post('/login', [AuthController::class, 'loginWeb']);

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/update-stock', [DashboardController::class, 'updateStock']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
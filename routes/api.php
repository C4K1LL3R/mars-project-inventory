<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;


Route::post('/register', [AuthController::class, 'registerApi']); 
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    

    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::post('stock-movements', [StockMovementController::class, 'store']);
    Route::get('stock-movements/{id}', [StockMovementController::class, 'show']);
    Route::get('stock-movements', [StockMovementController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']); 
});
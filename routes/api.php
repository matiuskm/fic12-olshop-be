<?php

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

// register
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

// login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// get all categories
Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);

// get all products
Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
});

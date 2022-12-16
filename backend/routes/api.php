<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'store']);

Route::prefix('v1')->middleware('jwt.auth')->group(function(){
    // User
    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Category
    Route::get('category', [CategoryController::class, 'index']);
    Route::post('category', [CategoryController::class, 'store']);
    Route::get('category/products', [CategoryController::class, 'show']);

    // Product
    Route::post('product', [ProductController::class, 'store']);

    // Orders
    Route::post('order', [OrderController::class, 'store']);
    Route::delete('order', [OrderController::class, 'destroy']);

    Route::post('order/store', [ItemController::class, 'store']);
    Route::delete('order/destroy', [ItemController::class, 'destroy']);

    Route::put('order/update', [OrderController::class, 'update']);
    
    Route::get('orders', [OrderController::class, 'index']);
    //Route::get('order/show', [OrderController::class, 'show']);
    Route::get('order/show', [ItemController::class, 'show']);
    
    Route::put('order/finish', [OrderController::class, 'finish']);
    //Route::get('order', [ItemController::class, 'index']);

});



Route::get('/teste', function(){
    return User::all();
})->middleware('jwt.auth');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

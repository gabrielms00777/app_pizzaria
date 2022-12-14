<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'store'])->name('register');

Route::prefix('v1')->middleware('jwt.auth')->group(function(){
    // User
    Route::post('me', [AuthController::class, 'me'])->name('me');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Category
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/products', [CategoryController::class, 'show'])->name('category.show');

    // Product
    Route::post('product', [ProductController::class, 'store'])->name('product.store');

    // Orders
    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::post('order', [OrderController::class, 'store'])->name('order.store');
    Route::delete('order', [OrderController::class, 'destroy'])->name('order.destroy');
    
    // Items
    Route::get('item', [ItemController::class, 'index'])->name('item.index');
    Route::post('order/store', [ItemController::class, 'store'])->name('item.store');
    Route::delete('order/destroy', [ItemController::class, 'destroy'])->name('item.destroy');
    Route::put('order/update', [OrderController::class, 'update'])->name('item.update');
});



Route::get('/teste', function(){
    return User::all();
})->middleware('jwt.auth');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

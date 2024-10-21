<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
})->name('home');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'finance'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/get', [UserController::class, 'get'])->name('users.get');
            Route::get('/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::post('/update', [UserController::class, 'update'])->name('users.update');
            Route::delete('/delete', [UserController::class, 'destroy'])->name('users.delete');
        });

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/store', [ProductController::class, 'store'])->name('products.store');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('/update/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/delete', [ProductController::class, 'destroy'])->name('products.delete');
        });
    });

    Route::group(['prefix' => 'carts'], function () {
        Route::post('/store', [CartController::class, 'store'])->name('carts.store');
        Route::get('/count', [CartController::class, 'getCartCount'])->name('carts.count');
        Route::delete('/delete', [CartController::class, 'destroy'])->name('carts.delete');
    });
});

require __DIR__ . '/auth.php';

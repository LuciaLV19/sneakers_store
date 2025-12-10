<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
});
Route::middleware('auth')->post('checkout', [OrderController::class,'store'])->name('checkout.store');

Route::post('cart/add/{product}', [CartController::class,'add'])->name('cart.add');
Route::post('cart/remove/{product}', [CartController::class,'remove'])->name('cart.remove');
Route::get('cart', [CartController::class,'index'])->name('cart.index');

require __DIR__.'/auth.php';

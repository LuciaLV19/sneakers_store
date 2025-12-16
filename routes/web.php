<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DiscountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
 ->middleware(['auth', 'verified'])
 ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/customer/dashboard', function () {
        return view('dashboard.customer');
    })->name('dashboard.customer');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::get('dashboard', function () {
        return view('dashboard.admin');
    })->name('dashboard.admin');

    Route::resource('discounts', DiscountController::class);

    // Rutas para Envío y Tarifas
    Route::get('shipping', [SettingsController::class, 'shippingIndex'])->name('shipping.index');
    Route::post('shipping', [SettingsController::class, 'shippingStore'])->name('shipping.store');

    Route::get('orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
});
Route::middleware('auth')->post('checkout', [OrderController::class,'store'])->name('checkout.store');
Route::middleware('auth')->get('orders', [OrderController::class,'index'])->name('orders.index');


Route::post('cart/add/{product}', [CartController::class,'add'])->name('cart.add');
Route::post('cart/remove/{product}', [CartController::class,'remove'])->name('cart.remove');
Route::get('cart', [CartController::class,'index'])->name('cart.index');

require __DIR__.'/auth.php';

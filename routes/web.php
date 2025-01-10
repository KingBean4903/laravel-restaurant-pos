<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;
use App\Http\Controllers\AuthController;



// Menu route
Route::get('/', [AuthController::class, 'menuIndex'])->name('menu');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('signin');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register-user');

    // Orders route
Route::get('/orders', [DashController::class, 'ordersIndex'])->name('orders');

Route::middleware(['web'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Products route
    Route::get('/products', [DashController::class, 'productsIndex'])->name('products');

    // Products route
    Route::get('/customers', [DashController::class, 'customersIndex'])->name('customers');

    // Products route
    Route::get('/settings', [DashController::class, 'settingsIndex'])->name('settings');

    // Users route
    Route::get('/users', [DashController::class, 'usersIndex'])->name('users');

    // Inventory route
    Route::get('/inventory', [DashController::class, 'inventoryIndex'])->name('inventory');

});
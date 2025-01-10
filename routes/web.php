<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;

// Menu route
Route::get('/', [DashController::class, 'menuIndex'])->name('menu');

// Orders route
Route::get('/orders', [DashController::class, 'ordersIndex'])->name('orders');

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
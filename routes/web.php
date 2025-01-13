<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StockController;

// Menu route
Route::get('/', [DashController::class, 'menuIndex'])->name('menu');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('signin');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register-user');

    // Orders route
Route::get('/orders', [DashController::class, 'ordersIndex'])->name('orders');

Route::post('/orders', [OrdersController::class, 'placeOrder'])->name('orders-create');

Route::middleware(['auth'])->group(function () {

    Route::post('/transfer', [StockController::class, 'transfer'])->name('transfer');
    

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Products route
    Route::get('/products', [DashController::class, 'productsIndex'])->name('products');

    
    // Settings route
    Route::get('/settings', [DashController::class, 'settingsIndex'])->name('settings');

    // Inventory route
    Route::get('/inventory', [DashController::class, 'inventoryIndex'])->name('inventory');
    Route::get('/audit', [DashController::class, 'audit'])->name('audit');
    Route::post('/stock-audit', [StockController::class, 'stockAudit'])->name('stock-audit');
    Route::post('/purchase', [StockController::class, 'purchase'])->name('purchase');
    Route::put('/adjustment/{stock}', [StockController::class, 'adjust'])->name('adjust');

    // Category routes
    Route::post('/category', [CategoryController::class, 'store' ] )->name('category');
    Route::delete('/category/{category}', [CategoryController::class, 'delete' ] )->name('destroy-category');

    // Department routes
    Route::post('/department', [DepartmentController::class, 'store' ] )->name('department');
    Route::delete('/department/{department}', [DepartmentController::class, 'delete'])->name('destroy-department');

    // Products routes
    Route::post('/product', [ProductsController::class, 'store' ] )->name('product');
    Route::put('/products/{product}', [ProductsController::class, 'update' ] )->name('update-product');
    Route::delete('/products/{product}', [ProductsController::class, 'destroy' ] )->name('destroy-product');

    // Customers routes
    Route::post('/customers', [CustomersController::class, 'store' ] )->name('create-customer');
    Route::put('/customers/{customer}', [CustomersController::class, 'update' ] )->name('update-customer');
    Route::delete('/customers/{customer}', [CustomersController::class, 'destroy' ] )->name('destroy-customer');
    Route::get('/customers', [DashController::class, 'customersIndex'])->name('customers');

    // Users route
    Route::get('/users', [DashController::class, 'usersIndex'])->name('users');
    Route::post('/users', [AuthController::class, 'store'])->name('create-user');
    Route::delete('/users/{user}', [AuthController::class, 'destroy'])->name('destroy-user');
    Route::put('/users/{user}', [AuthController::class, 'updateUser'])->name('update-user');

});
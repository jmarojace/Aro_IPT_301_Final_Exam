<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('dashboard'))->name('dashboard');

Route::resources([
    'categories' => CategoryController::class,
    'suppliers'  => SupplierController::class,
    'products'   => ProductController::class,
    'sales'      => SaleController::class,
]);

Route::resource('sale-items', SaleItemController::class)->only(['index', 'show']);

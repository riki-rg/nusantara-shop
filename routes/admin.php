<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('/admin/produk', AdminProductController::class)
        ->names('admin.products')
        ->parameters(['produk' => 'product'])
        ->except(['show']);

    Route::get('/admin/pesanan', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::patch('/admin/pesanan/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');
});

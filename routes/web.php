<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tags\TagsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Transactions\TransactionsController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/todoLogin', [LoginController::class, 'todoLogin'])->name('todoLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tags
    Route::resource('tags', TagsController::class)->except(['show']);

    // Services
    Route::resource('services', ServicesController::class)->except(['show']);

    // Products
    Route::resource('products', ProductsController::class)->except(['show']);

    // Transactions
    Route::resource('transactions', TransactionsController::class)->except(['show']);
});
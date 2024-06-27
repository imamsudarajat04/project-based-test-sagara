<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tags\TagsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/todoLogin', [LoginController::class, 'todoLogin'])->name('todoLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tags
    Route::resource('tags', TagsController::class)->except(['show']);
    Route::get('tags/trash', [TagsController::class, 'trash'])->name('tags.trash');
});
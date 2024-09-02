<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\{
    DashboardController,
    UserController
};

Route::get('/', [LoginController::class, 'LoginForm'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth:web'])->group(function () {

});

/* Admin routes */
Route::middleware(['auth:admin', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    /*Users CRUD Route*/
    Route::resource('/users', UserController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

// Halaman utama / landing page
Route::get('/', [ProductController::class, 'landing'])->name('landing');

// Fitur Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Routes (Hanya untuk yang sudah Login)
|--------------------------------------------------------------------------
*/

// Route admin dashboard yang memerlukan autentikasi
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin');

Route::middleware('auth')->group(function () {
    
    // Semua fitur CRUD produk (index, create, store, edit, update, destroy)
    Route::resource('products', ProductController::class);
    
});
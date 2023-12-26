<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Melempar ke Halaman Login
Route::get('/', function () {
    return redirect(route('login'));
});

// Login
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login_store');

// Setelah Login
Route::middleware(['auth'])->group(function(){
    // Home
    Route::get('home', [\App\Http\Controllers\Admin\HomeController::class, 'home'])->name('home');

    // Departemen
    Route::resource('departemen', \App\Http\Controllers\Admin\DepartemenController::class);

    // Role
    Route::resource('role', \App\Http\Controllers\Admin\GroupController::class);

    // User
    Route::resource('account', \App\Http\Controllers\Admin\UserController::class);

    // Logout
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

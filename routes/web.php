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

    // Formulir
    Route::resource('formulir',\App\Http\Controllers\Admin\FormulirController::class);
    // Route::get('formulir/{formulir}/download',[\App\Http\Controllers\Admin\FormulirController::class, 'download'])->name('formulir.download');

    // Interaksi Kerja
    Route::resource('interaksi_kerja', \App\Http\Controllers\Admin\InteraksiKerjaController::class);
    // Route::get('interaksi_kerja/{interaksi_kerja}/download',[\App\Http\Controllers\Admin\InteraksiKerjaController::class, 'download'])->name('interaksi_kerja.download');

    // IBPR
    Route::resource('ibpr',\App\Http\Controllers\Admin\IBPRController::class);
    // Route::get('ibpr/{ibpr}/download',[\App\Http\Controllers\Admin\IBPRController::class, 'download'])->name('ibpr.download');

    // JSA
    Route::resource('jsa',\App\Http\Controllers\Admin\JSAController::class);
    // Route::get('jsa/{jsa}/download',[\App\Http\Controllers\Admin\JSAController::class, 'download'])->name('jsa.download');

    // SOP
    Route::resource('sop',\App\Http\Controllers\Admin\SOPController::class);
    // Route::get('sop/{sop}/download',[\App\Http\Controllers\Admin\SOPController::class, 'download'])->name('sop.download');

    // User
    Route::resource('account', \App\Http\Controllers\Admin\UserController::class);
    Route::get('account/{user}/change', [\App\Http\Controllers\Admin\UserController::class, 'showChangeForm'])->name('account.change');
    Route::put('account/{user}/change_password', [\App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('account.change_password');

    // Logout
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

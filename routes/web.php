<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Siswa\SiswaController;

Route::get('/', function () {
    return redirect()->route('login');
});




Route::get('/users.dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');

Route::group(['middleware' => ['admin', 'prevent-back-history']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users.create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users.store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users.edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users.update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa.create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa.store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa.edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::post('/siswa.update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa.destroy/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::get('/ekskul.create', [EkskulController::class, 'create'])->name('ekskul.create');
    Route::post('/ekskul.store', [EkskulController::class, 'store'])->name('ekskul.store');
    Route::get('/ekskul.edit/{id}', [EkskulController::class, 'edit'])->name('ekskul.edit');
    Route::post('/ekskul.update/{id}', [EkskulController::class, 'update'])->name('ekskul.update');
    Route::delete('/ekskul.destroy/{id}', [EkskulController::class, 'destroy'])->name('ekskul.destroy');
});
Route::get('/ekskul', [EkskulController::class, 'index'])->name('ekskul.index');


Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
